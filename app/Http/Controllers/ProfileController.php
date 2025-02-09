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
    public function showProfile($id)
    {
        // Получаем пользователя по id
        $user = User::findOrFail($id);

        // Загружаем все категории услуг с их связанными услугами (eager loading)
        $categories = ServiceCategory::with('services')->get();

        // Передаём данные в представление
        return view('my_profile', compact('user', 'categories'));
    }

    /**
     * Отображение страницы настроек профиля.
     */
    public function showProfileSettings($id)
    {
        // Получаем пользователя по id
        $user = User::findOrFail($id);

        // Проверяем, что пользователь пытается изменить только свои настройки
        if ($user->id !== auth()->id()) {
            abort(403); // Доступ запрещен
        }

        // Получаем данные для селектов и чекбоксов
        $cities = DB::table('cities')->get();
        $categories = DB::table('services_category')->get();
        $allServices = DB::table('services')->get();

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

    /**
     * Проверка прав доступа и отображение настроек пользователя.
     */
    public function settings(User $user)
    {
        // Если пользователь пытается изменить чужие настройки
        if ($user->id !== auth()->id()) {
            abort(403); // Страница запрещена
        }

        // Возвращаем представление с настройками пользователя
        return view('profile_setting', compact('user'));
    }
}
