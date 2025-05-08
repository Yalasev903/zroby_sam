<?php

namespace App\Http\Controllers;

use App\Models\PortfolioProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioProjectController extends Controller
{
    public function create()
    {
        // проверка, авторизован ли пользователь
        $user = Auth::user();
        return view('portfolio.create', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:2048',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        foreach ($request->file('images') as $image) {
            $path = $image->store('portfolio', 'public');

            PortfolioProject::create([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => $path,
            ]);
        }

        return redirect()->route('my_profile.show', Auth::id())->with('success', '✅ Проєкти успішно додано!');
    }
}
