<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        $categoryMap = Category::pluck('id', 'slug');
        $defaultCompany = Company::first()->id;

        $videos = [
            ['title' => 'Gitara ile akustik ifa', 'author_first_name' => 'Elvin', 'author_last_name' => 'Mammadov', 'initials' => 'EM', 'department' => 'Marketing', 'category' => 'music', 'duration' => '3:42', 'description' => 'Elvin oz sevimli mahnilarini gitara ile akustik formatda ifa edir. Mohtesem ses ve musiqi harmoniyasi.'],
            ['title' => 'Muasir reqs performansi', 'author_first_name' => 'Aysel', 'author_last_name' => 'Huseynova', 'initials' => 'AH', 'department' => 'HR', 'category' => 'dance', 'duration' => '2:58', 'description' => 'Aysel muasir reqs terzinde hazirladigi benzersiz xoreoqrafiya ile sizi heyran qoyacaq.'],
            ['title' => 'Yagliboy ressam eseri', 'author_first_name' => 'Tural', 'author_last_name' => 'Aliyev', 'initials' => 'TA', 'department' => 'Dizayn', 'category' => 'art', 'duration' => '5:14', 'description' => 'Tural yagliboy texnikasi ile yaratdigi tablonun meydana gelme prosesini paylasmisdir.'],
            ['title' => 'Piano - Klassik ifa', 'author_first_name' => 'Nigar', 'author_last_name' => 'Kerimova', 'initials' => 'NK', 'department' => 'Finans', 'category' => 'music', 'duration' => '4:20', 'description' => 'Nigar klassik piano eserleri arasinda oz sevimli kompozisiyalarini ifa edir.'],
            ['title' => 'Stand-up komediya', 'author_first_name' => 'Ruslan', 'author_last_name' => 'Gasimov', 'initials' => 'RG', 'department' => 'IT', 'category' => 'other', 'duration' => '6:30', 'description' => 'Ruslan ofis heyatindan ilhamlanan orijinal stand-up nomresi ile gulush dalğasi yaradir.'],
            ['title' => 'Street dance battle', 'author_first_name' => 'Leyla', 'author_last_name' => 'Mammadli', 'initials' => 'LM', 'department' => 'Sales', 'category' => 'dance', 'duration' => '3:15', 'description' => 'Leyla street dance uslubunda dinamik ve enerjili performans numayis etdirir.'],
            ['title' => 'Xalq mahnisi ifasi', 'author_first_name' => 'Kamran', 'author_last_name' => 'Nabiyev', 'initials' => 'KN', 'department' => 'Operations', 'category' => 'music', 'duration' => '4:05', 'description' => 'Kamran Azerbaycan xalq mahnisini muasir aranjimanla ifa edir.'],
            ['title' => 'Dijital illustrasiya', 'author_first_name' => 'Gunel', 'author_last_name' => 'Rzayeva', 'initials' => 'GR', 'department' => 'Dizayn', 'category' => 'art', 'duration' => '7:22', 'description' => 'Gunel dijital illustrasiya prosesini ekranda canli olaraq numayis etdirir.'],
            ['title' => 'Beatbox performansi', 'author_first_name' => 'Farid', 'author_last_name' => 'Ismayilov', 'initials' => 'FI', 'department' => 'PR', 'category' => 'other', 'duration' => '2:45', 'description' => 'Farid yalniz sesi ile yaratdiqi mohtesem beatbox performansi ile sizi mat qoyacaq.'],
        ];

        foreach ($videos as $v) {
            Video::create([
                'title' => $v['title'],
                'author_first_name' => $v['author_first_name'],
                'author_last_name' => $v['author_last_name'],
                'initials' => $v['initials'],
                'company_id' => $defaultCompany,
                'department' => $v['department'],
                'category_id' => $categoryMap[$v['category']],
                'duration' => $v['duration'],
                'description' => $v['description'],
                'status' => 'approved',
                'approved_at' => now(),
            ]);
        }
    }
}
