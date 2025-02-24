<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Ярослав Слащев',
                'email' => 'slasev903@gmail.com',
                'phone' => '380508499639',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'executor',
                'city' => 'Харків',
                'skills' => 'Сантехнічні роботи, складські роботи',
                'services_category' => 'construction',
                'services' => json_encode([]),
                'rating' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Андрій Петренко',
                'email' => 'andrii.petrenko@example.com',
                'phone' => '380508499630',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'executor',
                'city' => 'Київ',
                'skills' => 'Ремонт квартир, електромонтаж',
                'services_category' => 'construction',
                'services' => json_encode(["ремонт", "електрика"]),
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Марія Іваненко',
                'email' => 'maria.ivanenko@example.com',
                'phone' => '380508499631',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'city' => 'Одеса',
                'company_name' => 'Будівельна компанія "Мрія"',
                'services_category' => 'construction',
                'services' => json_encode([]),
                'rating' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ігор Савченко',
                'email' => 'igor.savchenko@example.com',
                'phone' => '380508499632',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'executor',
                'city' => 'Львів',
                'skills' => 'Водопостачання, монтаж опалення',
                'services_category' => 'plumbing',
                'services' => json_encode(["монтаж труб", "установка котлів"]),
                'rating' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Олена Ковальчук',
                'email' => 'olena.kovalchuk@example.com',
                'phone' => '380508499634',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'city' => 'Дніпро',
                'company_name' => 'ТОВ "Ремонт Плюс"',
                'services_category' => 'renovation',
                'services' => json_encode([]),
                'rating' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // Если email уже есть, обновляем запись
                $user
            );
        }
    }
}
