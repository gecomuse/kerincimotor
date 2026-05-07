<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class DeepSeekService
{
    private const BASE_URL = 'https://api.deepseek.com/v1/chat/completions';
    private const MODEL    = 'deepseek-chat';

    public function generateCaption(string $title, string $content, string $platform): string
    {
        if ($platform === 'instagram') {
            $system = <<<PROMPT
Kamu adalah social media specialist untuk dealer mobil bekas Kerinci Motor di Mustikajaya, Bekasi.
Buat caption Instagram dalam bahasa Indonesia yang casual, friendly, dan terasa lokal Bekasi.

Aturan WAJIB:
- Maksimal 150 kata
- Gunakan emoji yang relevan dan menarik
- Sertakan MINIMAL 10 hashtag otomotif dan lokal Bekasi di akhir caption
  (contoh: #KerincitMotor #MobilBekas #MobilBekasi #Bekasi #MustikajayaBekasi #DealerMobilBekasi #BeliMobilBekas #MobilBekasMurah #KreditMobil #OtomotifBekasi)
- WAJIB sebut nama bisnis: Kerinci Motor, Mustikajaya Bekasi
- WAJIB sertakan nomor WhatsApp: wa.me/6287776700009
- Akhiri dengan ajakan chat WA untuk info lebih lanjut
PROMPT;

            $user = "Buat caption Instagram untuk konten ini:\nJudul: {$title}\n\nKonten:\n" . substr($content, 0, 1000);
        } else {
            $system = <<<PROMPT
Kamu adalah social media specialist untuk dealer mobil bekas Kerinci Motor di Mustikajaya, Bekasi.
Buat caption Facebook dalam bahasa Indonesia yang deskriptif, informatif, dan terasa lokal Bekasi.

Aturan WAJIB:
- Maksimal 200 kata
- Deskriptif dan informatif, jelaskan value kepada pembaca
- Sertakan MAKSIMAL 5 hashtag di akhir caption
- WAJIB sebut nama bisnis: Kerinci Motor, Mustikajaya Bekasi
- WAJIB sertakan nomor WhatsApp: wa.me/6287776700009
- Tone: friendly dan profesional
- Akhiri dengan call-to-action untuk menghubungi via WA
PROMPT;

            $user = "Buat caption Facebook untuk konten ini:\nJudul: {$title}\n\nKonten:\n" . substr($content, 0, 1500);
        }

        return $this->call($system, $user, 800);
    }

    public function generateArticle(string $topic): string
    {
        $system = <<<PROMPT
Kamu adalah content writer SEO berpengalaman yang spesialis di industri otomotif Indonesia,
khususnya pasar mobil bekas di Bekasi. Tulis artikel dalam bahasa Indonesia yang informatif dan SEO-friendly.

Aturan penulisan:
- MINIMAL 500 kata
- Gunakan heading (## untuk H2, ### untuk H3) yang relevan dan mengandung keyword
- Sertakan keyword lokal Bekasi secara natural di seluruh artikel
  (contoh: dealer mobil bekas Bekasi, beli mobil bekas Mustikajaya, kredit mobil Bekasi, mobil bekas murah Bekasi)
- Tone: informatif, terpercaya, dan mudah dipahami masyarakat umum
- Struktur artikel: intro → pembahasan (3-4 subheading) → kesimpulan + CTA
- Akhiri dengan call-to-action ke Kerinci Motor di Mustikajaya Bekasi, WA: 0877-7670-0009
PROMPT;

        $user = "Tulis artikel SEO tentang: {$topic}";

        return $this->call($system, $user, 2500);
    }

    private function call(string $systemPrompt, string $userPrompt, int $maxTokens = 1000): string
    {
        $apiKey = env('DEEPSEEK_API_KEY');

        if (empty($apiKey)) {
            throw new RuntimeException('DEEPSEEK_API_KEY is not configured in .env');
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type'  => 'application/json',
        ])->timeout(60)->post(self::BASE_URL, [
            'model'      => self::MODEL,
            'max_tokens' => $maxTokens,
            'messages'   => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user',   'content' => $userPrompt],
            ],
        ]);

        if ($response->failed()) {
            $error = $response->json('error.message') ?? $response->body();
            throw new RuntimeException("DeepSeek API error: {$error}");
        }

        $content = $response->json('choices.0.message.content');

        if (empty($content)) {
            throw new RuntimeException('DeepSeek API returned an empty response');
        }

        return $content;
    }
}
