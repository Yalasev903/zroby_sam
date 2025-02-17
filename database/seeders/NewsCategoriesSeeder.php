<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCategoriesSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run(): void
    {
        $categories = [
            'Будівництво/Ремонт',
            'Краса',
        ];

        foreach ($categories as $name) {
            DB::table('news_categories')->insert([
                'name'       => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
