<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    protected $fillable = ['email', 'video_id', 'ip_address'];

    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }
}
