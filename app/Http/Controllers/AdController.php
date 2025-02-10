<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    /**
     * Отображение формы создания объявления.
     */
    public function create()
    {
        // Получаем уникальные города из таблицы users, исключая пустые значения
        $cities = User::whereNotNull('city')
                      ->distinct()
                      ->pluck('city')
                      ->toArray();

        return view('ads.create', compact('cities'));
    }

    /**
     * Сохранение объявления.
     */
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'city'        => 'required|string',
            'photo'       => 'nullable|image|max:2048',
        ]);

        // Обработка загрузки фото (если загружено)
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('ads', 'public');
        }

        // Создание записи объявления в базе данных
        Ad::create([
            'user_id'    => Auth::id(),
            'title'      => $validatedData['title'],
            'description'=> $validatedData['description'],
            'city'       => $validatedData['city'],
            'photo_path' => $photoPath,
            'posted_at'  => now(), // Можно использовать created_at, если не требуется отдельное поле
        ]);

        return redirect()->route('ads.create')->with('success', 'Объявление успешно создано!');
    }

    public function index()
    {
    // Загружаем объявления из базы данных, сортируя по дате добавления
    $ads = Ad::with(['user', 'comments.user'])->latest()->paginate(10);

    return view('ads.ads_card_page', compact('ads'));
    }
}
