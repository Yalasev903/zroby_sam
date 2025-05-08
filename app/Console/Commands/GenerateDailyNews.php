<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsCategory;
use App\Models\News;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class GenerateDailyNews extends Command
{
    protected $signature = 'news:generate-daily';
    protected $description = 'Генерація реальних новин з GPT-4.1 зображенням та SEO-структурою';

    public function handle()
    {
        $this->info('🚀 Починаємо генерацію новин...');
        $categories = NewsCategory::all();

        foreach ($categories as $category) {
            $this->info("✏️ Категорія: {$category->name}");

            $prompt = "Знайди реальну новину, яка з'явилася протягом останніх 24 годин, на тему '{$category->name}'. "
                . "Сформулюй її стисло, без вигадки, використовуючи перевірені джерела. "
                . "Формат: перше речення — заголовок, потім — анотація (1 абзац), потім — основний текст (2–4 абзаци). "
                . "Пиши українською мовою. Не використовуй слова 'заголовок', 'анотація' — лише зміст.";

            try {
                $response = $this->askOpenAI($prompt);
            } catch (Throwable $e) {
                Log::error("❌ GPT помилка для {$category->name}: " . $e->getMessage());
                $this->error("❌ GPT помилка: " . $e->getMessage());
                continue;
            }

            if (!isset($response->choices[0]->message->content)) {
                $this->error('⚠️ GPT не повернув зміст.');
                continue;
            }

            $text = trim($response->choices[0]->message->content);
            preg_match('/^(.+?)\n\n(.+?)\n\n(.+)$/s', $text, $matches);

            if (count($matches) !== 4) {
                $this->error("❌ Не вдалось розпарсити новину.");
                Log::warning("Парсинг невдалий: $text");
                continue;
            }

            [$_, $title, $excerpt, $content] = $matches;

            // ❗ Проверка на дубликат
            if (News::where('title', $title)->exists()) {
                $this->warn("⚠️ Новина з таким заголовком вже існує: $title");
                continue;
            }

            // Генерація зображення
            $imagePath = null;
            try {
                $imagePrompt = "Реалістичне фото до новини на тему '{$category->name}' з сучасним освітленням. "
                    . "Журналістський стиль, природне середовище, без тексту або логотипів. "
                    . "Фотографія, а не ілюстрація.";

                $imageResponse = OpenAI::images()->create([
                    'model' => 'dall-e-3',
                    'prompt' => $imagePrompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'response_format' => 'url',
                ]);

                $imageUrl = $imageResponse->data[0]->url ?? null;

                if ($imageUrl) {
                    $imageData = file_get_contents($imageUrl);
                    $filename = 'news_images/' . Str::uuid() . '.jpg';
                    Storage::disk('public')->put($filename, $imageData);
                    $imagePath = 'storage/' . $filename;
                }
            } catch (Throwable $e) {
                Log::error("❌ Не вдалося створити зображення: " . $e->getMessage());
                $this->warn("⚠️ Без зображення.");
            }

            News::create([
                'title' => $title,
                'slug' => Str::slug($title) . '-' . uniqid(),
                'excerpt' => $excerpt,
                'content' => $content,
                'news_category_id' => $category->id,
                'image_url' => $imagePath,
                'published_at' => now(),
            ]);

            $this->info("✅ Створено: $title");
        }

        $this->info('🎉 Усі категорії оброблено!');
        return Command::SUCCESS;
    }

    /**
     * Генерація тексту через GPT з fallback.
     */
    private function askOpenAI(string $prompt, int $tries = 2)
    {
        $model = 'gpt-4-1106-preview';
        $attempt = 0;

        do {
            try {
                return OpenAI::chat()->create([
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'Ти досвідчений журналіст. Створи якісну новину, орієнтовану на SEO.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                ]);
            } catch (Throwable $e) {
                $attempt++;
                Log::warning("Повтор GPT ($attempt): " . $e->getMessage());
                sleep(3);

                if ($attempt === $tries) {
                    Log::info("⏪ Fallback на gpt-3.5-turbo для prompt: $prompt");
                    return OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ['role' => 'system', 'content' => 'Ти досвідчений журналіст. Створи якісну новину, орієнтовану на SEO.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.7,
                    ]);
                }
            }
        } while ($attempt < $tries);
    }
}
