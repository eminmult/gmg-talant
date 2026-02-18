<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Models\RuleGroup;
use Illuminate\Database\Seeder;

class RulesSeeder extends Seeder
{
    public function run(): void
    {
        $groups = [
            [
                'title' => 'Kimlər iştirak edə bilər?',
                'sort_order' => 1,
                'rules' => [
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>',
                        'title' => 'Bütün əməkdaşlar',
                        'description' => 'Global Media Group tərkibində fəaliyyət göstərən bütün şirkətlərin əməkdaşları iştirak edə bilər',
                        'sort_order' => 1,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
                        'title' => 'Könüllü iştirak',
                        'description' => 'İştirak könüllüdür — həm fərdi, həm də komanda şəklində mümkündür (maksimum 3 nəfər)',
                        'sort_order' => 2,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg>',
                        'title' => '1 video',
                        'description' => 'Hər iştirakçı və ya komanda yalnız 1 video təqdim edə bilər',
                        'sort_order' => 3,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>',
                        'title' => 'Son tarix: 20.02.2026',
                        'description' => 'Qeydiyyat və video göndərmə üçün son müraciət tarixi',
                        'sort_order' => 4,
                    ],
                ],
            ],
            [
                'title' => 'Video üçün texniki tələblər',
                'sort_order' => 2,
                'rules' => [
                    [
                        'icon' => "3'",
                        'title' => 'Maksimum 3 dəqiqə',
                        'description' => 'Videonun müddəti 3 dəqiqədən çox olmamalıdır',
                        'sort_order' => 1,
                    ],
                    [
                        'icon' => 'HD',
                        'title' => 'Minimum HD keyfiyyət',
                        'description' => 'Video yalnız MP4 formatında, minimum HD keyfiyyətdə olmalıdır. Həcmi maksimum 500 MB',
                        'sort_order' => 2,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>',
                        'title' => 'Orijinal məzmun',
                        'description' => 'Video orijinal olmalıdır, müəllif hüquqları pozulmamalıdır',
                        'sort_order' => 3,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>',
                        'title' => 'Qadağan olunan məzmun',
                        'description' => 'Qeyri-etik, təhqiredici, diskriminasiya, siyasi və dini təbliğat xarakterli məzmun qəbul edilmir',
                        'sort_order' => 4,
                    ],
                ],
            ],
            [
                'title' => 'Səsvermə və qiymətləndirmə',
                'sort_order' => 3,
                'rules' => [
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"></path></svg>',
                        'title' => 'Əməkdaş səsverməsi',
                        'description' => 'Hər əməkdaş bəyəndiyi iştirakçıya yalnız 1 dəfə səs verə bilər. Ən çox səs toplayan 3 iştirakçı finala keçəcək',
                        'sort_order' => 1,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2z"></path></svg>',
                        'title' => 'Münsiflər Heyəti',
                        'description' => 'Münsiflər Heyəti tərəfindən ən çox səs toplayan 3 iştirakçı da finala keçəcək. Münsiflərin qərarı yekun sayılır',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Qiymətləndirmə meyarları',
                'sort_order' => 4,
                'rules' => [
                    [
                        'icon' => '1',
                        'title' => 'İstedad və bacarıq səviyyəsi',
                        'description' => 'Çıxışın peşəkarlıq dərəcəsi və bacarığın nümayişi',
                        'sort_order' => 1,
                    ],
                    [
                        'icon' => '2',
                        'title' => 'Orijinallıq və yaradıcılıq',
                        'description' => 'Yaradıcı yanaşma və fərqli ideya',
                        'sort_order' => 2,
                    ],
                    [
                        'icon' => '3',
                        'title' => 'Təqdimat bacarığı',
                        'description' => 'İdeyanın unikallığı və ümumi performans',
                        'sort_order' => 3,
                    ],
                    [
                        'icon' => '4',
                        'title' => 'Təsir gücü',
                        'description' => 'Tamaşaçıya emosional təsir və yadda qalma dərəcəsi',
                        'sort_order' => 4,
                    ],
                ],
            ],
            [
                'title' => 'Zaman cədvəli',
                'sort_order' => 5,
                'rules' => [
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>',
                        'title' => 'Qeydiyyat',
                        'description' => 'Son müraciət tarixi — 20.02.2026',
                        'sort_order' => 1,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3H14z"></path></svg>',
                        'title' => 'Şirkətdaxili səsvermə',
                        'description' => 'Tarixlər tezliklə elan ediləcək',
                        'sort_order' => 2,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M12 2L15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2z"></path></svg>',
                        'title' => 'Final səsvermə',
                        'description' => 'Münsiflər Heyətinin final qiymətləndirməsi',
                        'sort_order' => 3,
                    ],
                    [
                        'icon' => '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5C7 4 7 7 7 7"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5C17 4 17 7 17 7"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>',
                        'title' => 'Mükafatlandırma',
                        'description' => 'Qalib üçün mükafat fondu: <strong>500 AZN</strong>',
                        'sort_order' => 4,
                    ],
                ],
            ],
        ];

        foreach ($groups as $groupData) {
            $rules = $groupData['rules'];
            unset($groupData['rules']);
            $groupData['is_active'] = true;

            $group = RuleGroup::create($groupData);

            foreach ($rules as $ruleData) {
                $ruleData['is_active'] = true;
                $group->rules()->create($ruleData);
            }
        }
    }
}
