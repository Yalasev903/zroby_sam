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

        // Массив настроек для двух категорий:
        // "q" - запрос к API, "category_id" - ID в таблице news_categories
        $queries = [
            ['q' => 'будівництво', 'category_id' => 1],
            ['q' => 'краса',       'category_id' => 2],
        ];

        foreach ($queries as $queryData) {
            // Если для категории "краса" можно уточнить запрос, то добавляем дополнительные ключевые слова
            $q = $queryData['q'];
            if ($q === 'краса') {
                $q = 'краса косметика мода бьюти';
            }

            $response = Http::get("https://newsapi.org/v2/everything", [
                'q'        => $q,
                'language' => 'uk',
                'apiKey'   => $apiKey,
            ]);

            if ($response->failed()) {
                $this->error("Ошибка при получении данных по запросу: {$queryData['q']}");
                continue;
            }

            $articles = $response->json()['articles'] ?? [];

            foreach ($articles as $article) {
                // Если заголовок отсутствует, пропускаем статью
                $title = $article['title'] ?? null;
                if (!$title) {
                    continue;
                }

                // Фильтрация в зависимости от категории
                if ($queryData['category_id'] == 1) {
                    // Фильтрация для категории "будівництво"
                    $keywords = ['будівництво', 'ремонт', 'будинок', 'квартира', 'майстерня', 'інструмент', 'меблі', 'дизайн', 'плитка', 'паркет'];
                } elseif ($queryData['category_id'] == 2) {
                    // Фильтрация для категории "краса"
                    $keywords = ['краса', 'косметика', 'мода', 'бьюти', 'макіяж', 'манікюр', 'педикюр', 'волосся', 'стріжки'];
                } else {
                    $keywords = [];
                }

                // Если набор ключевых слов задан, проверяем релевантность
                if (!empty($keywords)) {
                    $titleLower = mb_strtolower($title, 'UTF-8');
                    $descLower = mb_strtolower($article['description'] ?? '', 'UTF-8');
                    $isRelevant = false;
                    foreach ($keywords as $keyword) {
                        if (mb_strpos($titleLower, $keyword) !== false || mb_strpos($descLower, $keyword) !== false) {
                            $isRelevant = true;
                            break;
                        }
                    }
                    if (!$isRelevant) {
                        continue;
                    }
                }

                // Формирование уникального slug
                $slug = Str::slug($title);
                $originalSlug = $slug;
                $counter = 1;
                while (News::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter;
                    $counter++;
                }

                $data = [
                    'title'            => $title,
                    'slug'             => $slug,
                    'excerpt'          => $article['description'] ?? null,
                    'content'          => $article['content'] ?? '',
                    'news_category_id' => $queryData['category_id'],
                    'image_url'        => $article['urlToImage'] ?? null,
                    'published_at'     => isset($article['publishedAt'])
                        ? Carbon::parse($article['publishedAt'])->format('Y-m-d H:i:s')
                        : null,
                ];

                News::create($data);
            }

            $this->info("Новости по запросу '{$queryData['q']}' успешно загружены в категорию ID {$queryData['category_id']}.");
        }
    }
}
