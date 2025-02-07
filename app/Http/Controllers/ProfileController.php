<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Отображение страницы профиля.
     */
    public function showProfile()
    {
        // Загружаем все категории услуг с их связанными услугами (eager loading)
        $categories = ServiceCategory::with('services')->get();

        // Передаём данные в представление
        return view('my_profile', compact('categories'));
    }

    /**
     * Отображение страницы настроек профиля.
     */
    public function showProfileSettings()
    {
        // Текущий пользователь
        $user = Auth::user();

        // Получаем данные для селектов и чекбоксов
        $cities = \DB::table('cities')->get();
        $categories = \DB::table('services_category')->get();
        $allServices = \DB::table('services')->get();

        // Группируем услуги по категориям
        $servicesByCategory = [];
        foreach ($allServices as $service) {
            $servicesByCategory[$service->services_category_id][] = $service;
        }

        // Если у пользователя уже выбраны услуги (хранятся в JSON)
        $userServices = json_decode($user->services, true) ?? [];

        // Передаём данные в представление
        return view('profile_setting', compact('user', 'cities', 'categories', 'servicesByCategory', 'userServices'));
    }
}

