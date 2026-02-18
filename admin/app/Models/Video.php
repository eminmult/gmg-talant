<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'author_first_name', 'author_last_name', 'initials',
        'company_id', 'department', 'category_id', 'duration',
        'description', 'video_path', 'thumbnail_path', 'status', 'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function juryScores(): HasMany
    {
        return $this->hasMany(JuryScore::class);
    }

    public function application(): HasOne
    {
        return $this->hasOne(Application::class);
    }

    public function getAuthorFullNameAttribute(): string
    {
        return "{$this->author_first_name} {$this->author_last_name}";
    }

    public function getVoteCountAttribute(): int
    {
        return $this->votes()->count();
    }

    public function getJuryAverageAttribute(): ?float
    {
        $avg = $this->juryScores()->avg('average');
        return $avg ? round($avg, 2) : null;
    }
}
