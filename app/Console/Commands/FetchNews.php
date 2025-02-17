<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Str;

class FetchNews extends Command
{
    protected $signature = 'news:fetch';
    protected $description = 'Fetch news articles from external API and store in database';

    public function handle()
    {
        $apiKey = '47efe9ed60f24080baed62f4accc987c';
        $response = Http::get("https://newsapi.org/v2/everything", [
            'q'        => 'будівництво',
            'language' => 'uk',
            'apiKey'   => $apiKey
        ]);

        if ($response->failed()) {
            $this->error('Ошибка при получении данных.');
            return;
        }

        $articles = $response->json()['articles'] ?? [];

        foreach ($articles as $article) {
            News::create([
                'title'            => $article['title'],
                'slug'             => Str::slug($article['title']),
                'excerpt'          => $article['description'] ?? null,
                'content'          => $article['content'] ?? '',
                'news_category_id' => 3, // ID существующей категории
                'image_url'        => $article['urlToImage'] ?? null,
                'published_at'     => isset($article['publishedAt'])
                    ? Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s')
                    : null
            ]);
        }

        $this->info('Новости успешно загружены.');
    }
}
