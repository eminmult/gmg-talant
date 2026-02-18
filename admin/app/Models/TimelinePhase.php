<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelinePhase extends Model
{
    protected $fillable = [
        'title_az', 'title_en', 'date_label', 'actual_date',
        'description_az', 'description_en', 'status', 'sort_order',
    ];

    protected $casts = [
        'actual_date' => 'date',
    ];
}
