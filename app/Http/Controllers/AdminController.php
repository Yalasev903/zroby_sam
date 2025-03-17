<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Отображает панель администратора с таблицей пользователей.
     */
    public function dashboard()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    /**
     * Обновляет роль пользователя.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     */
    public function updateUserRole(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => 'required|in:customer,executor,admin',
        ]);

        $user->update(['role' => $validatedData['role']]);

        return redirect()->back()->with('success', 'Роль користувача успішно оновлена.');
    }

    /**
     * Удаляет пользователя.
     *
     * @param  \App\Models\User  $user
     */
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->back()->with('success', 'Користувача успішно видалено.');
    }
}
