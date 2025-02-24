<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ad;

class AdsSeeder extends Seeder
{
    /**
     * Запуск сидера.
     */
    public function run(): void
    {
        Ad::create([
            'user_id'    => 1,
            'title'      => 'Тестовое объявление',
            'description'=> 'Это тестовое объявление для проверки сидеров.',
            'city'       => 'Киев',
            'photo_path' => 'ads/test.jpg',
            'posted_at'  => now(),
        ]);
    }
}
