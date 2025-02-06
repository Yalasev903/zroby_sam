<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            'Київ', 'Львів', 'Одеса', 'Харків', 'Дніпро', 'Запоріжжя', 'Кривий Ріг',
            'Миколаїв', 'Маріуполь', 'Чернігів', 'Полтава', 'Черкаси', 'Суми', 'Тернопіль',
            'Рівне', 'Вінниця', 'Хмельницький', 'Івано-Франківськ', 'Житомир', 'Кам’янець-Подільський',
            'Ужгород', 'Луцьк', 'Кіровоград', 'Біла Церква', 'Бровари'
        ];

        $citiesToInsert = [];

        foreach ($cities as $city) {
            $citiesToInsert[] = ['name' => $city];
        }

        // Выполнение вставки всех городов за один запрос
        DB::table('cities')->insert($citiesToInsert);
    }
}

