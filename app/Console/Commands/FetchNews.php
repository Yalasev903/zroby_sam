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
        // Получаем ключ NewsAPI из конфигурации
        $newsApiKey = config('services.newsapi.key');
        dump($newsApiKey);

        // Задаём запросы:
        // Категория 1: Стройка/ремонт в Украине через NewsAPI (everything)
        // Категория 2: Красота в Украине через GNews API (запрос изменён на "beauty Ukraine")
        $queries = [
            ['q' => 'Ukraine construction', 'category_id' => 1],
            ['q' => 'beauty', 'category_id' => 2, 'api' => 'gnews'],
        ];

        foreach ($queries as $queryData) {
            if ($queryData['category_id'] == 1) {
                // Используем NewsAPI (everything) для категории 1
                $response = Http::get("https://newsapi.org/v2/everything", [
                    'q'        => $queryData['q'],
                    'language' => 'en',
                    'from'     => now()->subDays(7)->format('Y-m-d'),
                    'sortBy'   => 'relevancy',
                    'apiKey'   => $newsApiKey,
                ]);

                if ($response->failed()) {
                    $this->error("Ошибка при получении данных по запросу: {$queryData['q']} (NewsAPI)");
                    continue;
                }
                $articles = $response->json()['articles'] ?? [];
            } elseif ($queryData['category_id'] == 2) {
                // Используем GNews API для категории 2
                $gnewsApiKey = '36737fd641cb692ee30ef3f4fc59aab2';
                $response = Http::get("https://gnews.io/api/v4/search", [
                    'q'       => $queryData['q'],
                    'lang'    => 'en',
                    'country' => null,
                    'token'   => $gnewsApiKey,
                    'max'     => 10,
                    'sortby'  => 'relevance',
                ]);
                if ($response->failed()) {
                    $this->error("Ошибка при получении данных по запросу: {$queryData['q']} (GNews API)");
                    continue;
                }
                // У GNews новости находятся в ключе "articles"
                $articles = $response->json()['articles'] ?? [];
            } else {
                continue;
            }

            dump($articles);

            foreach ($articles as $article) {
                if ($queryData['category_id'] == 1) {
                    // Маппинг для NewsAPI
                    $title       = $article['title'] ?? null;
                    $description = $article['description'] ?? null;
                    $content     = $article['content'] ?? null;
                    $imageUrl    = $article['urlToImage'] ?? null;
                    $publishedAt = $article['publishedAt'] ?? null;
                } elseif ($queryData['category_id'] == 2) {
                    // Маппинг для GNews API
                    $title       = $article['title'] ?? null;
                    $description = $article['description'] ?? null;
                    $content     = $article['content'] ?? null;
                    $imageUrl    = $article['image'] ?? null;
                    $publishedAt = $article['publishedAt'] ?? null;
                }

                // Если описания нет, используем контент как запасной вариант
                $description = $description ?? $content ?? null;

                // Пропускаем новости без заголовка или с коротким описанием
                if (!$title || mb_strlen($title, 'UTF-8') < 10 || !$description || mb_strlen($description, 'UTF-8') < 30) {
                    continue;
                }

                // Фильтрация по ключевым словам:
                if ($queryData['category_id'] == 1) {
                    $keywords = ['construction', 'building', 'renovation', 'repair'];
                } else {
                    $keywords = ['beauty', 'cosmetics', 'makeup', 'skincare', 'salon'];
                }
                $titleLower = mb_strtolower($title, 'UTF-8');
                $descLower  = mb_strtolower($description, 'UTF-8');
                if (!collect($keywords)->some(fn($keyword) => str_contains($titleLower, $keyword) || str_contains($descLower, $keyword))) {
                    continue;
                }

                // Генерация уникального slug
                $slug = Str::slug($title);
                $originalSlug = $slug;
                $counter = 1;
                while (News::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                // Сохранение новости в базу данных
                News::create([
                    'title'            => $title,
                    'slug'             => $slug,
                    'excerpt'          => $description,
                    'content'          => $content,
                    'news_category_id' => $queryData['category_id'],
                    'image_url'        => $imageUrl,
                    'published_at'     => $publishedAt ? Carbon::parse($publishedAt)->format('Y-m-d H:i:s') : null,
                ]);
            }

            $this->info("Новости по запросу '{$queryData['q']}' успешно загружены в категорию ID {$queryData['category_id']}.");
        }
    }
}
