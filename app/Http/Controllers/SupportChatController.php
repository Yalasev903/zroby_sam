<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;
class SupportChatController extends Controller
{
    public function handle(Request $request)
    {
        $request->validate(['question' => 'required|string']);

        $policy = File::exists(base_path('policy.md')) ? File::get(base_path('policy.md')) : '';
        $terms = File::exists(base_path('terms.md')) ? File::get(base_path('terms.md')) : '';

        $systemPrompt = "Ти — чат підтримки платформи ZrobySam. Відповідай ввічливо, коротко, зрозуміло, спираючись на Політику конфіденційності та Умови користування:";
        $context = $policy . "\n\n" . $terms;

        $models = ['gpt-4o', 'gpt-4', 'gpt-3.5-turbo'];

        foreach ($models as $i => $model) {
            try {
                $response = OpenAI::chat()->create([
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt . "\n\n" . $context],
                        ['role' => 'user', 'content' => $request->question],
                    ],
                ]);

                return response()->json([
                    'answer' => $response->choices[0]->message->content,
                ]);
            } catch (\Exception $e) {
                Log::warning("GPT спроба $i не вдалася: " . $e->getMessage());
            }
        }

        return response()->json([
            'answer' => '❌ Сервіс тимчасово недоступний. Спробуйте пізніше.',
        ]);
    }
}

