<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Вывод списка новостей.
     */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    /**
     * Форма создания новости.
     */
    public function create()
    {
        $categories = NewsCategory::all();
        return view('news.create', compact('categories'));
    }

    /**
     * Сохранение новой новости.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'image_url'        => 'nullable|url',
            'published_at'     => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['title']);

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Новина успішно додана.');
    }

    /**
     * Отображение конкретной новости.
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Форма редактирования новости.
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::all();
        return view('news.edit', compact('news', 'categories'));
    }

    /**
     * Обновление новости.
     */
    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'excerpt'          => 'nullable|string',
            'content'          => 'required|string',
            'news_category_id' => 'required|exists:news_categories,id',
            'image_url'        => 'nullable|url',
            'published_at'     => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['title']);

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Новина успішно оновлена.');
    }

    /**
     * Удаление новости.
     */
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index')->with('success', 'Новина успішно видалена.');
    }
}
