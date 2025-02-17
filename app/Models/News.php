<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'news_category_id',
        'image_url',
        'published_at'
    ];

    /**
     * Связь "принадлежит" с категорией новостей.
     */
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function index()
    {
        // Получите данные новостей (если требуется) – например:
        // $news = News::latest()->paginate(10);
        // return view('news.index', compact('news'));

        // Если данных пока нет, можно просто вернуть view:
        return view('news.index');
    }
}
