<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'music', 'name_az' => 'Musiqi', 'name_en' => 'Music', 'color' => '#cb2b36', 'sort_order' => 1],
            ['slug' => 'dance', 'name_az' => 'Rəqs', 'name_en' => 'Dance', 'color' => '#8b5cf6', 'sort_order' => 2],
            ['slug' => 'art', 'name_az' => 'İncəsənət', 'name_en' => 'Art', 'color' => '#f59e0b', 'sort_order' => 3],
            ['slug' => 'other', 'name_az' => 'Digər', 'name_en' => 'Other', 'color' => '#10b981', 'sort_order' => 4],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
