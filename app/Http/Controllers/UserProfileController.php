<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    // Отображение профиля пользователя
    public function index()
    {
        $user = auth()->user(); // Получаем данные текущего пользователя
        return view('user.profile', compact('user')); // Убедитесь, что файл user/profile.blade.php создан
    }
}
