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
    protected $description = 'Fetch news articles from external APIs and store in database';

    public function handle()
    {
        $newsApiKey = config('services.newsapi.key');
        $gnewsApiKey = '36737fd641cb692ee30ef3f4fc59aab2';

        $queries = [
            ['q' => 'Ukraine construction', 'category_id' => 1],
            ['q' => 'beauty', 'category_id' => 2, 'api' => 'gnews'],
        ];

        foreach ($queries as $queryData) {
            if ($queryData['category_id'] == 1) {
                $response = Http::get("https://newsapi.org/v2/everything", [
                    'q'        => $queryData['q'],
                    'language' => 'en',
                    'from'     => now()->subDays(7)->format('Y-m-d'),
                    'sortBy'   => 'relevancy',
                    'apiKey'   => $newsApiKey,
                ]);
                if ($response->failed()) {
                    $this->error("Ошибка: {$queryData['q']} (NewsAPI)");
                    continue;
                }
                $articles = $response->json()['articles'] ?? [];
            } elseif ($queryData['category_id'] == 2) {
                $response = Http::get("https://gnews.io/api/v4/search", [
                    'q'       => $queryData['q'],
                    'lang'    => 'en',
                    'token'   => $gnewsApiKey,
                    'max'     => 10,
                    'sortby'  => 'relevance',
                ]);
                if ($response->failed()) {
                    $this->error("Ошибка: {$queryData['q']} (GNews)");
                    continue;
                }
                $articles = $response->json()['articles'] ?? [];
            } else {
                continue;
            }

            foreach ($articles as $article) {
                $title       = $article['title'] ?? null;
                $description = $article['description'] ?? null;
                $content     = $article['content'] ?? null;
                $imageUrl    = $article['urlToImage'] ?? ($article['image'] ?? null);
                $publishedAt = $article['publishedAt'] ?? null;
                $sourceName  = strtolower($article['source']['name'] ?? '');

                $description = $description ?? $content ?? null;

                // Явная фильтрация — только английский язык
                if (!isset($article['language']) && $queryData['category_id'] == 1) {
                    // NewsAPI не указывает язык, проверяем по title
                    if (!preg_match('/[a-z]{3,}/i', $title)) continue;
                }

                // Фильтрация по длине
                if (
                    !$title || mb_strlen($title, 'UTF-8') < 10 ||
                    !$description || mb_strlen($description, 'UTF-8') < 50 ||
                    !$content || mb_strlen($content, 'UTF-8') < 100
                ) {
                    continue;
                }

                // Фильтрация по источнику
                $tabloidSources = ['the sun', 'buzzfeed', 'mirror', 'coupon', 'promo', 'newsletter'];
                if (collect($tabloidSources)->some(fn($name) => str_contains($sourceName, $name))) {
                    continue;
                }

                // Фильтрация по ключевым словам
                $keywords = $queryData['category_id'] == 1
                    ? ['ukraine', 'kyiv', 'construction', 'repair', 'renovation']
                    : ['beauty', 'skincare', 'cosmetics', 'makeup', 'ukraine', 'україна'];

                $textToSearch = mb_strtolower($title . ' ' . $description, 'UTF-8');
                if (!collect($keywords)->some(fn($kw) => str_contains($textToSearch, $kw))) {
                    continue;
                }

                // Уникальный slug
                $slug = Str::slug($title);
                $originalSlug = $slug;
                $counter = 1;
                while (News::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                // Сохранение
                News::create([
                    'title'            => $title,
                    'slug'             => $slug,
                    'excerpt'          => $description,
                    'content'          => $content,
                    'news_category_id' => $queryData['category_id'],
                    'image_url'        => $imageUrl,
                    'published_at'     => $publishedAt ? Carbon::parse($publishedAt)->format('Y-m-d H:i:s') : null,
                    'processed'        => false,
                ]);
            }

            $this->info("✅ Новости по '{$queryData['q']}' загружены (категория ID {$queryData['category_id']}).");
        }
    }
}
