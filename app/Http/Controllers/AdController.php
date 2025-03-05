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
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'city'        => 'required|string',
            'photo'       => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('ads', 'public');
        }

        Ad::create([
            'user_id'    => Auth::id(),
            'title'      => $validatedData['title'],
            'description'=> $validatedData['description'],
            'city'       => $validatedData['city'],
            'photo_path' => $photoPath,
            'posted_at'  => now(),
        ]);

        return redirect()->route('ads.create')->with('success', 'Оголошення успішно створено!');
    }

    /**
     * Отображение активных объявлений (без завершённых заказов).
     */
    public function index()
    {
        $ads = Ad::with(['user', 'comments.user', 'order'])
                 ->whereDoesntHave('order', function ($q) {
                     $q->where('status', 'completed');
                 })
                 ->latest()
                 ->paginate(10);

        return view('ads.ads_card_page', compact('ads'));
    }

    /**
     * Отображение объявлений, для которых заказ выполнен (завершенные).
     */
    public function completedAds()
    {
        $ads = Ad::with(['user', 'comments.user', 'order'])
                 ->whereHas('order', function ($q) {
                     $q->where('status', 'completed');
                 })
                 ->latest()
                 ->paginate(10);

        return view('ads.completed_ads', compact('ads'));
    }

    // Остальные методы (myAds, edit, update, destroy) остаются без изменений

    public function myAds()
    {
        $ads = Ad::where('user_id', auth()->id())->latest()->get();
        return view('ads.my_ads', compact('ads'));
    }

    public function edit(Ad $ad)
    {
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'У вас немає прав для редагування цього оголошення.');
        }

        return view('ads.edit', compact('ad'));
    }

    public function update(Request $request, Ad $ad)
    {
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

        if ($request->hasFile('photo')) {
            if ($ad->photo_path) {
                Storage::delete('public/' . $ad->photo_path);
            }

            $photoPath = $request->file('photo')->store('ads', 'public');
            $data['photo_path'] = $photoPath;
        }

        $ad->update($data);

        return redirect()->route('ads.index')->with('success', 'Оголошення успішно оновлено.');
    }

    public function destroy(Ad $ad)
    {
        if (auth()->id() !== $ad->user_id) {
            abort(403, 'Ви не можете видалити це оголошення.');
        }

        if ($ad->photo_path) {
            Storage::delete('public/' . $ad->photo_path);
        }

        $ad->delete();

        return redirect()->route('ads.index')->with('success', 'Оголошення видалено.');
    }
}
