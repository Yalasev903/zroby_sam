<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login'); // Если пользователь не авторизован, отправляем его на страницу входа
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'У вас немає доступа до цієї сторінки'); // Ошибка 403 вместо редиректа
        }

        return $next($request);
    }
}

