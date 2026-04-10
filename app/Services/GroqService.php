<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * GroqService — generates social media captions using the Groq API.
 *
 * Required .env:
 *   GROQ_API_KEY=
 *   GROQ_MODEL=llama3-8b-8192   (or any supported Groq model)
 */
class GroqService
{
    protected const API_URL = 'https://api.groq.com/openai/v1/chat/completions';

    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = config('services.groq.key', '');
        $this->model  = config('services.groq.model', 'llama3-8b-8192');
    }

    /**
     * Generate an Instagram/Facebook caption for a post.
     *
     * Returns empty string if API key is not configured or on failure.
     */
    public function generateCaption(string $title, string $excerpt): string
    {
        if (empty($this->apiKey)) {
            return '';
        }

        $prompt = <<<PROMPT
Kamu adalah social media copywriter untuk Kerinci Motor, dealer mobil bekas terpercaya di Bekasi.

Tulis caption Instagram/Facebook untuk artikel berikut:

Judul: {$title}
Ringkasan: {$excerpt}

Aturan:
- Bahasa Indonesia yang natural dan engaging
- Mulai dengan hook yang menarik (bukan "Hai" atau "Halo")
- Maksimal 5 baris paragraf
- Sertakan 3–5 hashtag relevan di baris terakhir (#mobilbekas #bekasi #kerincimotor wajib ada)
- Akhiri dengan ajakan bertindak (tanya via WA, link di bio, dll)
- Jangan sertakan emoji berlebihan, maksimal 3

Tulis hanya caption-nya saja, tanpa penjelasan tambahan.
PROMPT;

        try {
            $response = Http::withToken($this->apiKey)
                ->timeout(30)
                ->post(self::API_URL, [
                    'model'       => $this->model,
                    'messages'    => [
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens'  => 400,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                return trim($response->json('choices.0.message.content', ''));
            }

            Log::warning('GroqService: non-200 response', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (\Throwable $e) {
            Log::error('GroqService: exception', ['message' => $e->getMessage()]);
        }

        return '';
    }
}
