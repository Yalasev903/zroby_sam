<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        return redirect()->route('ads.create')->with('success', 'Оголошення успішно створено!');
    }

    public function index()
    {
    // Загружаем объявления из базы данных, сортируя по дате добавления
    $ads = Ad::with(['user', 'comments.user'])->latest()->paginate(10);

    return view('ads.ads_card_page', compact('ads'));
    }

    public function myAds()
    {
        $ads = Ad::where('user_id', auth()->id())->latest()->get();
        return view('ads.my_ads', compact('ads'));
    }

    // Метод редактирования объявления
    public function edit(Ad $ad)
    {
        // Проверяем, является ли пользователь владельцем объявления
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'У вас немає прав для редагування цього оголошення.');
        }

        return view('ads.edit', compact('ad'));
    }

    // Метод обновления объявления
    public function update(Request $request, Ad $ad)
    {
        // Проверяем владельца объявления
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'Ви не можете редагувати це оголошення.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $data = $request->only(['title', 'description', 'city']);

        // Обновляем фото, если загружено новое
        if ($request->hasFile('photo')) {
            // Удаляем старое фото
            if ($ad->photo_path) {
                Storage::delete('public/' . $ad->photo_path);
            }

            $photoPath = $request->file('photo')->store('ads', 'public');
            $data['photo_path'] = $photoPath;
        }

        $ad->update($data);

        return redirect()->route('ads.index')->with('success', 'Оголошення успішно оновлено.');
    }

    // Метод удаления объявления
    public function destroy(Ad $ad)
    {
        // Проверяем владельца объявления
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'Ви не можете видалити це оголошення.');
        }

        // Удаляем фото
        if ($ad->photo_path) {
            Storage::delete('public/' . $ad->photo_path);
        }

        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Оголошення видалено.');
    }
}
