<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            'Global Management',
            'Baku TV',
            'Report İnformasiya Agentliyi',
            'Oxu.Az',
            'Caliber',
            'Baku WS',
            'Media.Az',
            'Global Photo Stock',
            'Kaspi qəzeti redaksiyası',
            'Kaspiy-rus',
        ];

        foreach ($companies as $i => $name) {
            Company::create([
                'name' => $name,
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }
}
