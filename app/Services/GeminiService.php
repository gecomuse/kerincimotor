<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    private string $apiKey;
    private string $baseUrl;
    private string $model = 'gemini-1.5-flash';

    public function __construct()
    {
        $this->apiKey = config('services.gemini.key', '');
        $this->baseUrl = config('services.gemini.base_url');
    }

    public function analyzeProductImage(string $imagePath): array
    {
        try {
            if (! file_exists($imagePath)) {
                return ['error' => 'Image file not found'];
            }

            $imageData = base64_encode(file_get_contents($imagePath));
            $mimeType = mime_content_type($imagePath) ?: 'image/jpeg';

            $prompt = 'Analyze this product image. Return JSON only with these fields: product_name, category, key_features (array), color, material, suggested_price_range, target_audience, marketing_angle';

            $response = Http::timeout(45)->post(
                "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}",
                [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'inline_data' => [
                                        'mime_type' => $mimeType,
                                        'data' => $imageData,
                                    ],
                                ],
                                ['text' => $prompt],
                            ],
                        ],
                    ],
                    'generationConfig' => [
                        'responseMimeType' => 'application/json',
                    ],
                ]
            );

            if ($response->failed()) {
                $error = $response->json('error.message', 'Gemini API request failed');
                Log::error('GeminiService: Image analysis failed', ['error' => $error]);

                return ['error' => $error];
            }

            $text = $response->json('candidates.0.content.parts.0.text', '');
            $cleaned = $this->extractJson($text);
            $result = json_decode($cleaned, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::warning('GeminiService: JSON parse failed', ['raw' => $text]);

                return ['error' => 'Could not parse Gemini response', 'raw' => $text];
            }

            return $result;
        } catch (\Throwable $e) {
            Log::error('GeminiService: analyzeProductImage exception', ['message' => $e->getMessage()]);

            return ['error' => $e->getMessage()];
        }
    }

    public function generateProductCaption(array $productData, string $platform, string $tone = 'engaging'): string
    {
        try {
            $productJson = json_encode($productData, JSON_UNESCAPED_UNICODE);

            $prompt = <<<PROMPT
            Kamu adalah copywriter profesional untuk {$platform}.
            Buat caption {$tone} dalam Bahasa Indonesia berdasarkan data produk berikut:
            {$productJson}

            Sertakan 5-10 hashtag relevan di akhir caption.
            Sesuaikan gaya penulisan dengan platform {$platform} dan tone {$tone}.
            PROMPT;

            $result = $this->callText($prompt);

            return $result;
        } catch (\Throwable $e) {
            Log::error('GeminiService: generateProductCaption exception', ['message' => $e->getMessage()]);

            return '';
        }
    }

    public function generateImagePrompt(array $productData): string
    {
        try {
            $name = $productData['product_name'] ?? $productData['name'] ?? 'product';
            $category = $productData['category'] ?? '';
            $color = $productData['color'] ?? '';
            $features = is_array($productData['key_features'] ?? null)
                ? implode(', ', $productData['key_features'])
                : ($productData['key_features'] ?? '');
            $angle = $productData['marketing_angle'] ?? '';

            $prompt = "Generate a detailed image generation prompt for a product photo. Product: {$name}. Category: {$category}. Color: {$color}. Key features: {$features}. Marketing angle: {$angle}. The prompt should be optimized for AI image generation, describing studio lighting, composition, background, and product styling. Return only the image generation prompt, no explanations.";

            return $this->callText($prompt);
        } catch (\Throwable $e) {
            Log::error('GeminiService: generateImagePrompt exception', ['message' => $e->getMessage()]);

            return '';
        }
    }

    private function callText(string $prompt): string
    {
        $response = Http::timeout(30)->post(
            "{$this->baseUrl}/{$this->model}:generateContent?key={$this->apiKey}",
            [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $prompt],
                        ],
                    ],
                ],
            ]
        );

        if ($response->failed()) {
            $error = $response->json('error.message', 'Gemini API request failed');
            Log::error('GeminiService: text call failed', ['error' => $error]);

            throw new \RuntimeException($error);
        }

        return $response->json('candidates.0.content.parts.0.text', '');
    }

    private function extractJson(string $text): string
    {
        // Strip markdown code fences if present
        $text = preg_replace('/```json\s*/i', '', $text);
        $text = preg_replace('/```\s*/', '', $text);

        return trim($text);
    }
}
