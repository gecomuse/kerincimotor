<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaService
{
    private string $graphUrl;
    private string $pageAccessToken;
    private string $pageId;
    private string $instagramAccountId;

    public function __construct()
    {
        $this->graphUrl = config('services.meta.graph_url');
        $this->pageAccessToken = config('services.meta.page_access_token', '');
        $this->pageId = config('services.meta.page_id', '');
        $this->instagramAccountId = config('services.meta.instagram_account_id', '');
    }

    public function postToFacebookPage(string $message, ?string $imageUrl = null): array
    {
        try {
            if ($imageUrl) {
                $response = Http::timeout(30)->post(
                    "{$this->graphUrl}/{$this->pageId}/photos",
                    [
                        'message' => $message,
                        'url' => $imageUrl,
                        'access_token' => $this->pageAccessToken,
                    ]
                );
            } else {
                $response = Http::timeout(30)->post(
                    "{$this->graphUrl}/{$this->pageId}/feed",
                    [
                        'message' => $message,
                        'access_token' => $this->pageAccessToken,
                    ]
                );
            }

            if ($response->failed()) {
                $error = $response->json('error.message', 'Unknown error');
                Log::error('MetaService: Facebook post failed', ['error' => $error, 'status' => $response->status()]);

                return ['success' => false, 'post_id' => null, 'error' => $error];
            }

            $postId = $response->json('id') ?? $response->json('post_id');

            return ['success' => true, 'post_id' => $postId, 'error' => null];
        } catch (\Throwable $e) {
            Log::error('MetaService: Facebook post exception', ['message' => $e->getMessage()]);

            return ['success' => false, 'post_id' => null, 'error' => $e->getMessage()];
        }
    }

    public function postToInstagram(string $caption, string $imageUrl): array
    {
        try {
            // Step 1 — create media container
            $containerResponse = Http::timeout(30)->post(
                "{$this->graphUrl}/{$this->instagramAccountId}/media",
                [
                    'image_url' => $imageUrl,
                    'caption' => $caption,
                    'access_token' => $this->pageAccessToken,
                ]
            );

            if ($containerResponse->failed()) {
                $error = $containerResponse->json('error.message', 'Container creation failed');
                Log::error('MetaService: Instagram container creation failed', ['error' => $error]);

                return ['success' => false, 'post_id' => null, 'error' => $error];
            }

            $containerId = $containerResponse->json('id');

            if (! $containerId) {
                return ['success' => false, 'post_id' => null, 'error' => 'No container ID returned'];
            }

            // Step 2 — publish container
            $publishResponse = Http::timeout(30)->post(
                "{$this->graphUrl}/{$this->instagramAccountId}/media_publish",
                [
                    'creation_id' => $containerId,
                    'access_token' => $this->pageAccessToken,
                ]
            );

            if ($publishResponse->failed()) {
                $error = $publishResponse->json('error.message', 'Publish failed');
                Log::error('MetaService: Instagram publish failed', ['error' => $error]);

                return ['success' => false, 'post_id' => null, 'error' => $error];
            }

            $postId = $publishResponse->json('id');

            return ['success' => true, 'post_id' => $postId, 'error' => null];
        } catch (\Throwable $e) {
            Log::error('MetaService: Instagram post exception', ['message' => $e->getMessage()]);

            return ['success' => false, 'post_id' => null, 'error' => $e->getMessage()];
        }
    }

    public function getPageInsights(string $metric = 'page_impressions'): array
    {
        try {
            $response = Http::timeout(30)->get(
                "{$this->graphUrl}/{$this->pageId}/insights",
                [
                    'metric' => $metric,
                    'period' => 'day',
                    'access_token' => $this->pageAccessToken,
                ]
            );

            if ($response->failed()) {
                Log::error('MetaService: Insights fetch failed', ['status' => $response->status()]);

                return [];
            }

            return $response->json('data', []);
        } catch (\Throwable $e) {
            Log::error('MetaService: Insights exception', ['message' => $e->getMessage()]);

            return [];
        }
    }

    public function validateToken(): bool
    {
        try {
            $response = Http::timeout(10)->get(
                "{$this->graphUrl}/me",
                ['access_token' => $this->pageAccessToken]
            );

            return $response->successful() && filled($response->json('id'));
        } catch (\Throwable $e) {
            Log::error('MetaService: Token validation exception', ['message' => $e->getMessage()]);

            return false;
        }
    }
}
