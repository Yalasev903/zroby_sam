<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Вывод списка новостей с возможностью фильтрации.
     */
    public function index(Request $request)
    {
        $query = News::latest();
        $breadcrumbs = [
            ['title' => 'Головна', 'url' => route('home')],
            ['title' => 'Новини', 'url' => route('news.index')],
        ];

        // Фильтрация по категории
        $selectedCategory = null;
        if ($request->has('category') && $request->category) {
            $selectedCategory = NewsCategory::find($request->category);
            if ($selectedCategory) {
                $query->where('news_category_id', $selectedCategory->id);
                $breadcrumbs[] = ['title' => $selectedCategory->name, 'url' => route('news.index', ['category' => $selectedCategory->id])];
            }
        }

        $news = $query->paginate(10)->appends($request->except('page'));
        $categories = NewsCategory::all();

        // SEO
        $title = $selectedCategory
            ? "Новини категорії: {$selectedCategory->name} | Zroby_Sam"
            : "Останні новини | Zroby_Sam";

        $description = $selectedCategory
            ? "Читайте свіжі новини з категорії «{$selectedCategory->name}» на платформі Zroby_Sam."
            : "Читайте актуальні новини на платформі Zroby_Sam: поради, інновації, історії успіху та більше.";

        return view('news.index', compact('news', 'categories', 'breadcrumbs', 'title', 'description'));
    }


    /**
     * Форма создания новости.
     */
    // public function create()
    // {
    //     $categories = NewsCategory::all();

    //     $breadcrumbs = [
    //         ['title' => 'Головна', 'url' => route('home')],
    //         ['title' => 'Новини', 'url' => route('news.index')],
    //         ['title' => 'Додати новину', 'url' => route('news.create')],
    //     ];

    //     return view('news.create', compact('categories', 'breadcrumbs'));
    // }

    /**
     * Отображение конкретной новости.
     */
    public function show($slug)
    {
        $news = News::with('category')->where('slug', $slug)->firstOrFail();
        $category = $news->category;

        $breadcrumbs = [
            ['title' => 'Головна', 'url' => route('home')],
            ['title' => 'Новини', 'url' => route('news.index')],
        ];

        if ($category) {
            $breadcrumbs[] = ['title' => $category->name, 'url' => route('news.index', ['category' => $category->id])];
        }

        $breadcrumbs[] = ['title' => $news->title, 'url' => route('news.show', $news->slug)];

        // SEO
        $title = "{$news->title} | Zroby_Sam";
        $description = Str::limit(strip_tags($news->text), 160); // обрезаем до 160 символов

        return view('news.show', compact('news', 'breadcrumbs', 'title', 'description'));
    }


    /**
     * Форма редактирования новости.
     */
    public function edit(News $news)
    {
        $categories = NewsCategory::all();

        $breadcrumbs = [
            ['title' => 'Головна', 'url' => route('home')],
            ['title' => 'Новини', 'url' => route('news.index')],
            ['title' => 'Відредагувати: ' . $news->title, 'url' => route('news.edit', $news->id)],
        ];

        return view('news.edit', compact('news', 'categories', 'breadcrumbs'));
    }

    /**
     * Вывод новостей по категории.
     */
    public function byCategory($id)
    {
        $category = NewsCategory::findOrFail($id);
        $news = News::where('news_category_id', $id)->latest()->paginate(10);

        $breadcrumbs = [
            ['title' => 'Головна', 'url' => route('home')],
            ['title' => 'Новини', 'url' => route('news.index')],
            ['title' => $category->name, 'url' => route('news.byCategory', $category->id)],
        ];

        // SEO
        $title = "Новини: {$category->name} | Zroby_Sam";
        $description = "Читайте найактуальніші новини з категорії {$category->name} на платформі Zroby_Sam.";

        return view('news.index', compact('news', 'breadcrumbs', 'title', 'description'));
    }
}
