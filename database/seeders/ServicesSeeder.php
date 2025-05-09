<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Данные: ключ – название категории, значение – массив услуг
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
            // ✅ Найдём или создадим категорию
            $categoryId = DB::table('services_category')->updateOrInsert(
                ['name' => $categoryName],
                ['updated_at' => now(), 'created_at' => now()]
            );

            // Получаем ID из категории (в updateOrInsert insertGetId не возвращает)
            $category = DB::table('services_category')->where('name', $categoryName)->first();

            // ✅ Для каждой услуги из категории найдём или создадим запись
            foreach ($services as $serviceName) {
                DB::table('services')->updateOrInsert(
                    [
                        'services_category_id' => $category->id,
                        'name' => $serviceName
                    ],
                    [
                        'created_at' => now(),
                        'updated_at' => now()
                    ]
                );
            }
        }
    }
}
