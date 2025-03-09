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
        $user = User::findOrFail($id); // Получаем пользователя по ID

        // Получаем категорию услуг пользователя
        $userCategory = ServiceCategory::find($user->services_category);

        // Получаем список услуг пользователя (предполагаем, что это JSON)
        $userServices = json_decode($user->services, true) ?? [];

        return view('my_profile', compact('user', 'userCategory', 'userServices'));
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

        // Получаем необходимые данные
        $cities = DB::table('cities')->get();
        $categories = ServiceCategory::all();
        $allServices = DB::table('services')->get();

        // Группировка услуг по категориям
        $servicesByCategory = [];
        foreach ($allServices as $service) {
            $servicesByCategory[$service->services_category_id][] = $service;
        }

        return view('profile_setting', compact('user', 'cities', 'categories', 'servicesByCategory'));
    }
}
