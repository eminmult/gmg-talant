<?php

use App\Models\AllowedDomain;
use App\Models\RuleGroup;
use App\Models\Company;
use App\Models\JuryMember;
use App\Models\JuryScore;
use App\Models\SiteText;
use App\Models\Video;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/videos', function () {
    $videos = Video::where('status', 'approved')
        ->with('category', 'company')
        ->withCount('votes')
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(fn (Video $v) => [
            'id' => $v->id,
            'title' => $v->title,
            'author' => $v->author_full_name,
            'dept' => $v->department,
            'initials' => $v->initials,
            'category' => $v->category?->slug,
            'duration' => $v->duration,
            'votes' => $v->votes_count,
            'desc' => $v->description,
            'video_url' => $v->video_path ? Storage::disk('public')->url($v->video_path) : null,
            'thumb' => $v->thumbnail_path ? Storage::disk('public')->url($v->thumbnail_path) : null,
            'company' => $v->company?->name,
        ]);

    return response()->json($videos);
});

Route::post('/videos', function (Request $request) {
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'company_name' => 'required|string|max:255',
        'department' => 'nullable|string|max:255',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:2000',
        'duration' => 'nullable|string|max:10',
        'video' => 'required|file|mimes:mp4|max:512000',
        'recaptcha_token' => 'required|string',
    ]);

    // Verify reCAPTCHA v3
    $recaptchaResponse = Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => env('RECAPTCHA_SECRET'),
        'response' => $validated['recaptcha_token'],
        'remoteip' => $request->ip(),
    ]);
    $recaptchaData = $recaptchaResponse->json();
    if (!($recaptchaData['success'] ?? false) || ($recaptchaData['score'] ?? 0) < 0.5) {
        return response()->json(['message' => 'Robot yoxlaması uğursuz oldu. Yenidən cəhd edin.'], 422);
    }

    $company = Company::where('name', $validated['company_name'])->first();
    if (!$company) {
        return response()->json(['message' => 'Şirkət tapılmadı'], 422);
    }

    $file = $request->file('video');
    $path = $file->store('videos', 'public');

    // Generate thumbnail from video
    $thumbName = pathinfo($path, PATHINFO_FILENAME) . '.jpg';
    $thumbPath = 'thumbnails/' . $thumbName;
    $thumbFull = Storage::disk('public')->path($thumbPath);
    $videoFull = Storage::disk('public')->path($path);
    Storage::disk('public')->makeDirectory('thumbnails');
    exec("ffmpeg -y -i " . escapeshellarg($videoFull) . " -ss 00:00:01 -frames:v 1 -update 1 -q:v 2 " . escapeshellarg($thumbFull) . " 2>&1", $ffmpegOutput, $ffmpegCode);
    \Log::info('ffmpeg thumbnail', ['code' => $ffmpegCode, 'output' => implode("\n", array_slice($ffmpegOutput, -5))]);
    if (!file_exists($thumbFull)) {
        $thumbPath = null;
    }

    $initials = mb_strtoupper(
        mb_substr($validated['first_name'], 0, 1) . mb_substr($validated['last_name'], 0, 1)
    );

    Video::create([
        'title' => $validated['title'],
        'author_first_name' => $validated['first_name'],
        'author_last_name' => $validated['last_name'],
        'initials' => $initials,
        'company_id' => $company->id,
        'department' => $validated['department'],
        'description' => $validated['description'],
        'duration' => $validated['duration'] ?? null,
        'video_path' => $path,
        'thumbnail_path' => $thumbPath,
        'status' => 'pending',
    ]);

    return response()->json(['message' => 'Ərizə uğurla göndərildi'], 201);
});

Route::post('/votes', function (Request $request) {
    $validated = $request->validate([
        'video_id' => 'required|integer|exists:videos,id',
        'email' => 'required|email|max:255',
    ]);

    // Check allowed domain
    $domain = strtolower(substr(strrchr($validated['email'], '@'), 1));
    $allowed = AllowedDomain::where('domain', $domain)->where('is_active', true)->exists();
    if (!$allowed) {
        return response()->json(['message' => 'Bu e-poçt domeni ilə səs vermək mümkün deyil'], 403);
    }

    // Limit: max 3 votes per email
    $totalVotes = Vote::where('email', $validated['email'])->count();
    if ($totalVotes >= 3) {
        return response()->json(['message' => 'Səs limiti: hər e-poçt yalnız 3 videoya səs verə bilər'], 429);
    }

    $existing = Vote::where('email', $validated['email'])
        ->where('video_id', $validated['video_id'])
        ->first();

    if ($existing) {
        return response()->json(['message' => 'Bu e-poçt ilə artıq səs vermişsiniz'], 409);
    }

    Vote::create([
        'email' => $validated['email'],
        'video_id' => $validated['video_id'],
        'ip_address' => $request->ip(),
    ]);

    $count = Vote::where('video_id', $validated['video_id'])->count();

    return response()->json(['message' => 'Səsiniz qeydə alındı', 'votes' => $count], 201);
});

Route::post('/jury/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $jury = JuryMember::where('email', $validated['email'])
        ->where('is_active', true)
        ->first();

    if (!$jury || !Illuminate\Support\Facades\Hash::check($validated['password'], $jury->password)) {
        return response()->json(['message' => 'E-poçt və ya şifrə yanlışdır'], 401);
    }

    // Return jury data with their existing scores
    $scores = JuryScore::where('jury_member_id', $jury->id)
        ->get()
        ->keyBy('video_id')
        ->map(fn ($s) => [
            'scores' => [
                'skill' => $s->skill,
                'originality' => $s->originality,
                'presentation' => $s->presentation,
                'uniqueness' => $s->uniqueness,
                'impact' => $s->impact,
            ],
            'average' => (float) $s->average,
        ]);

    return response()->json([
        'id' => $jury->id,
        'name' => $jury->name,
        'email' => $jury->email,
        'scores' => $scores,
    ]);
});

Route::post('/jury/scores', function (Request $request) {
    $validated = $request->validate([
        'jury_member_id' => 'required|integer|exists:jury_members,id',
        'video_id' => 'required|integer|exists:videos,id',
        'skill' => 'required|integer|min:1|max:10',
        'originality' => 'required|integer|min:1|max:10',
        'presentation' => 'required|integer|min:1|max:10',
        'uniqueness' => 'required|integer|min:1|max:10',
        'impact' => 'required|integer|min:1|max:10',
    ]);

    $score = JuryScore::updateOrCreate(
        ['jury_member_id' => $validated['jury_member_id'], 'video_id' => $validated['video_id']],
        $validated,
    );

    return response()->json(['message' => 'Qiymət qeydə alındı', 'average' => (float) $score->average], 201);
});

Route::get('/texts', function () {
    $texts = SiteText::pluck('value', 'key')->toArray();

    // Merge timeline phases into texts so frontend data-text attributes work
    $phases = \App\Models\TimelinePhase::orderBy('sort_order')->get();
    foreach ($phases as $i => $phase) {
        $n = $i + 1;
        $texts["timeline_{$n}_title"] = $phase->title_az;
        $texts["timeline_{$n}_date"] = $phase->date_label;
        $texts["timeline_{$n}_desc"] = $phase->description_az ?? '';
        $texts["timeline_{$n}_status"] = $phase->status;
    }
    $texts['timeline_count'] = $phases->count();

    return response()->json($texts);
});

Route::get('/rules', function () {
    $groups = RuleGroup::where('is_active', true)
        ->with(['rules' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
        ->orderBy('sort_order')
        ->get()
        ->map(fn ($g) => [
            'title' => $g->title,
            'rules' => $g->rules->map(fn ($r) => [
                'icon' => $r->icon,
                'title' => $r->title,
                'description' => $r->description,
            ])->values(),
        ]);

    return response()->json($groups);
});
