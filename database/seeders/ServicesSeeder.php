<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Будівництво/Ремонт' => [
                'Будівництво',
                'Ремонт',
                'Муж на годину',
                'Електромонтаж',
                'Сантехніка',
                'Укладка плитки',
                'Гіпсокартон',
                'Малярні роботи'
            ],
            'Краса' => [
                'Перукар',
                'Манікюр',
                'Педикюр',
                'Ресниці',
                'Брови',
                'Татуаж',
                'Масаж',
                'Косметологія',
                'Чистка обличчя',
                'SPA-процедури'
            ]
        ];

        foreach ($data as $categoryName => $services) {
            // Найдём или создадим категорию
            DB::table('services_category')->updateOrInsert(
                ['name' => $categoryName],
                ['updated_at' => now(), 'created_at' => now()]
            );

            // Получаем ID созданной/найденной категории
            $category = DB::table('services_category')->where('name', $categoryName)->first();

            foreach ($services as $serviceName) {
                DB::table('services')->updateOrInsert(
                    [
                        'services_category_id' => $category->id,
                        'name' => $serviceName,
                    ],
                    [
                        'updated_at' => now(),
                        'created_at' => now(),
                    ]
                );
            }
        }
    }
}
