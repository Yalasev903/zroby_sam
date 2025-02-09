<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Отображение страницы профиля.
     */
    public function showProfile(User $user)
    {
        // Загружаем все категории услуг с их связанными услугами (eager loading)
        $categories = ServiceCategory::with('services')->get();

        // Передаём данные в представление
        return view('my_profile', compact('user', 'categories'));
    }

    /**
     * Отображение страницы настроек профиля.
     */
    public function showProfileSettings(User $user)
{
    // Проверяем, что пользователь пытается изменить только свои настройки
    if ($user->id !== auth()->id()) {
        abort(403, 'Доступ запрещен'); // Доступ запрещен для чужих профилей
    }

    // Логика для получения данных профиля и настроек
    $cities = DB::table('cities')->get();
    $categories = DB::table('services_category')->get();
    $allServices = DB::table('services')->get();

    // Группировка услуг по категориям
    $servicesByCategory = [];
    foreach ($allServices as $service) {
        $servicesByCategory[$service->services_category_id][] = $service;
    }

    // Передача данных в представление
    return view('profile_setting', compact('user', 'cities', 'categories', 'servicesByCategory'));
}

}
