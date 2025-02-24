<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ExecutorController extends Controller
{
    public function index()
    {
        $executors = User::where('role', 'executor')->get(); // Получаем всех исполнителей
        return view('executors.index', compact('executors'));
    }
}

