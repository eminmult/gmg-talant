<?php

namespace Database\Seeders;

use App\Models\TimelinePhase;
use Illuminate\Database\Seeder;

class TimelinePhaseSeeder extends Seeder
{
    public function run(): void
    {
        $phases = [
            [
                'title_az' => 'Qeydiyyat',
                'title_en' => 'Registration',
                'date_label' => '20 fevral, 2026',
                'actual_date' => '2026-02-20',
                'description_az' => 'Ərizələrin qəbulu və videoların yüklənməsi',
                'description_en' => 'Accepting applications and video uploads',
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'title_az' => 'Səsvermə',
                'title_en' => 'Voting',
                'date_label' => 'Tezliklə',
                'actual_date' => null,
                'description_az' => 'Şirkətdaxili səsvermə və Münsiflər Heyətinin qiymətləndirməsi',
                'description_en' => 'Internal voting and jury evaluation',
                'status' => 'upcoming',
                'sort_order' => 2,
            ],
            [
                'title_az' => 'Final',
                'title_en' => 'Finals',
                'date_label' => 'Tezliklə',
                'actual_date' => null,
                'description_az' => 'Münsiflər Heyətinin final səsverməsi, finalistlərin seçilməsi',
                'description_en' => 'Jury final voting and finalist selection',
                'status' => 'upcoming',
                'sort_order' => 3,
            ],
            [
                'title_az' => 'Mükafatlandırma',
                'title_en' => 'Awards',
                'date_label' => 'Tezliklə',
                'actual_date' => null,
                'description_az' => 'Qalibin elan olunması. Mükafat fondu: 500 AZN',
                'description_en' => 'Winner announcement. Prize fund: 500 AZN',
                'status' => 'upcoming',
                'sort_order' => 4,
            ],
        ];

        foreach ($phases as $phase) {
            TimelinePhase::create($phase);
        }
    }
}
