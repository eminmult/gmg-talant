<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JuryScore extends Model
{
    protected $fillable = [
        'jury_member_id', 'video_id',
        'skill', 'originality', 'presentation', 'uniqueness', 'impact',
        'average',
    ];

    protected $casts = [
        'average' => 'decimal:2',
    ];

    protected static function booted(): void
    {
        static::saving(function (JuryScore $score) {
            $score->average = round(
                ($score->skill + $score->originality + $score->presentation + $score->uniqueness + $score->impact) / 5,
                2
            );
        });
    }

    public function juryMember(): BelongsTo
    {
        return $this->belongsTo(JuryMember::class);
    }

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
