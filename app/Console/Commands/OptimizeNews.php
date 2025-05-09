<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class OptimizeNews extends Command
{
    protected $signature = 'news:optimize';
    protected $description = 'Переклад, SEO-оптимізація, зображення для новин';

    public function handle()
    {
        $this->info('🚀 Оптимізація новин...');

        $newsList = News::where('processed', false)->orderBy('created_at')->limit(20)->get();

        if ($newsList->isEmpty()) {
            $this->info('✅ Новини для обробки відсутні.');
            return Command::SUCCESS;
        }

        foreach ($newsList as $news) {
            $this->info("✏️ Обробка ID {$news->id}: {$news->title}");

            $prompt = "Переклади і адаптуй цю англомовну новину українською мовою з урахуванням SEO. "
                . "Структура: заголовок (1 речення), анотація (1 абзац), основний текст (2–4 абзаци). "
                . "Без слів 'заголовок', 'анотація'. "
                . "Title: {$news->title}\n"
                . "Excerpt: {$news->excerpt}\n"
                . "Content: {$news->content}";

            try {
                $response = $this->askOpenAI($prompt);
            } catch (Throwable $e) {
                $this->warn("❌ GPT помилка: " . $e->getMessage());
                Log::error("GPT помилка [ID {$news->id}]: " . $e->getMessage());
                $news->delete();
                continue;
            }

            $text = trim($response->choices[0]->message->content ?? '');

            if (mb_strlen($text) < 150) {
                $this->warn("🗑 Короткий текст GPT [ID {$news->id}]");
                $news->delete();
                continue;
            }

            $garbage = ['я не можу', 'не маю доступу', 'на жаль', 'не можу надати', 'керівництво'];
            if (collect($garbage)->some(fn($g) => str_contains(mb_strtolower($text), $g))) {
                $this->warn("🗑 GPT згенерував некорисний текст [ID {$news->id}]");
                $news->delete();
                continue;
            }

            preg_match('/^(.+?)\n\n(.+?)\n\n(.+)$/s', $text, $matches);
            if (count($matches) !== 4) {
                $this->warn("❌ Неможливо розпарсити [ID {$news->id}]");
                Log::warning("GPT format issue [ID {$news->id}]: $text");
                $news->delete();
                continue;
            }

            [$_, $title, $excerpt, $content] = $matches;

            if (News::where('title', $title)->exists()) {
                $this->warn("🚫 Дублікат заголовка: {$title}");
                $news->delete();
                continue;
            }

            // Генерація зображення
            $imagePath = null;
            try {
                $imagePrompt = "Журналістське фото до теми: '{$title}'. Без тексту, без логотипів, денне освітлення.";
                Log::info("📤 DALL-E prompt for ID {$news->id}: {$imagePrompt}");

                $imgResponse = OpenAI::images()->create([
                    'model' => 'dall-e-3',
                    'prompt' => $imagePrompt,
                    'n' => 1,
                    'size' => '1024x1024',
                    'response_format' => 'url',
                ]);

                $imgUrl = $imgResponse->data[0]->url ?? null;
                Log::info("📥 DALL-E response for ID {$news->id}: " . ($imgUrl ?? 'NO URL'));

                if ($imgUrl) {
                    $imgData = file_get_contents($imgUrl);
                    $filename = 'news_images/' . Str::uuid() . '.jpg';
                    Storage::disk('public')->put($filename, $imgData);
                    $imagePath = 'storage/' . $filename;
                    $this->info("🖼 Зображення збережено: {$imagePath}");
                } else {
                    $imagePath = 'images/default-news.jpg';
                    $this->warn("⚠️ DALL-E не повернув URL. Встановлено заглушку.");
                }

            } catch (Throwable $e) {
                $this->warn("⚠️ Помилка зображення для ID {$news->id}: " . $e->getMessage());
                Log::error("DALL-E помилка [ID {$news->id}]: " . $e->getMessage());
                $imagePath = 'images/default-news.jpg';
            }

            // Оновлення запису
            $news->update([
                'title'     => $title,
                'excerpt'   => $excerpt,
                'content'   => $content,
                'image_url' => $imagePath ?? $news->image_url,
                'processed' => true,
            ]);

            $this->info("✅ Збережено ID {$news->id}: {$title}");
        }

        $this->info('🎉 Оптимізація завершена');
        return Command::SUCCESS;
    }

    private function askOpenAI(string $prompt, int $tries = 2)
    {
        $model = 'gpt-4-1106-preview';
        $attempt = 0;

        do {
            try {
                return OpenAI::chat()->create([
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => 'Ти український журналіст. Переклади і оптимізуй для публікації.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'temperature' => 0.7,
                ]);
            } catch (Throwable $e) {
                Log::warning("GPT спроба $attempt не вдалася: " . $e->getMessage());
                $attempt++;
                sleep(3);

                if ($attempt === $tries) {
                    Log::info("⏪ Перехід на gpt-3.5 для backup");
                    return OpenAI::chat()->create([
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ['role' => 'system', 'content' => 'Ти український журналіст. Переклади і оптимізуй для публікації.'],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.7,
                    ]);
                }
            }
        } while ($attempt < $tries);

        throw new \Exception("GPT не відповів після $tries спроб.");
    }
}
