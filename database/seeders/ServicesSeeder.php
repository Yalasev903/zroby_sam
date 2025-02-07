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
            // Создаём категорию и получаем её ID
            $categoryId = DB::table('services_category')->insertGetId([
                'name'       => $categoryName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Для каждой услуги из категории вставляем запись в таблицу services
            foreach ($services as $serviceName) {
                DB::table('services')->insert([
                    'services_category_id' => $categoryId,
                    'name'                 => $serviceName,
                    'created_at'           => now(),
                    'updated_at'           => now(),
                ]);
            }
        }
    }
}
