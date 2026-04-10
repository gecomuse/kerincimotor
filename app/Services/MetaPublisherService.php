<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * MetaPublisherService — publishes content to Instagram and Facebook via the Meta Graph API.
 *
 * Required .env:
 *   META_ACCESS_TOKEN=    Long-lived Page access token
 *   META_IG_USER_ID=      Instagram Business Account ID
 *   META_FB_PAGE_ID=      Facebook Page ID
 *
 * Docs:
 *   https://developers.facebook.com/docs/instagram-api/guides/content-publishing
 *   https://developers.facebook.com/docs/pages/managing
 */
class MetaPublisherService
{
    protected const GRAPH_URL = 'https://graph.facebook.com/v19.0';

    protected string $accessToken;
    protected string $igUserId;
    protected string $fbPageId;

    public function __construct()
    {
        $this->accessToken = config('services.meta.access_token', '');
        $this->igUserId    = config('services.meta.ig_user_id', '');
        $this->fbPageId    = config('services.meta.fb_page_id', '');
    }

    // ─────────────────────────────────────────────
    //  Instagram
    // ─────────────────────────────────────────────

    /**
     * Publish a single-image feed post to Instagram.
     * Flow: create container → publish
     */
    public function publishInstagramFeed(Post $post, string $caption, string $imageUrl): array
    {
        if (! $this->isConfigured()) {
            return $this->err('Meta credentials not configured');
        }

        // 1. Create media container
        $container = $this->graphPost("/{$this->igUserId}/media", [
            'image_url'  => $imageUrl,
            'caption'    => $caption,
            'media_type' => 'IMAGE',
        ]);

        if (! $container['success']) {
            return $container;
        }

        // 2. Publish
        return $this->graphPost("/{$this->igUserId}/media_publish", [
            'creation_id' => $container['id'],
        ]);
    }

    /**
     * Publish a carousel post to Instagram (2–10 images).
     * Flow: create item container for each image → create carousel container → publish
     */
    public function publishInstagramCarousel(Post $post, string $caption, array $imageUrls): array
    {
        if (! $this->isConfigured()) {
            return $this->err('Meta credentials not configured');
        }

        if (count($imageUrls) < 2) {
            return $this->err('Carousel requires at least 2 images');
        }

        // 1. Create a container for each image
        $childIds = [];
        foreach ($imageUrls as $url) {
            $item = $this->graphPost("/{$this->igUserId}/media", [
                'image_url'        => $url,
                'is_carousel_item' => true,
            ]);

            if (! $item['success']) {
                return $this->err("Failed to create carousel item: {$item['error']}");
            }

            $childIds[] = $item['id'];
        }

        // 2. Create carousel container
        $container = $this->graphPost("/{$this->igUserId}/media", [
            'media_type' => 'CAROUSEL',
            'caption'    => $caption,
            'children'   => implode(',', $childIds),
        ]);

        if (! $container['success']) {
            return $container;
        }

        // 3. Publish
        return $this->graphPost("/{$this->igUserId}/media_publish", [
            'creation_id' => $container['id'],
        ]);
    }

    /**
     * Publish a Reel to Instagram.
     * Flow: create container → poll until FINISHED (up to 60s) → publish
     */
    public function publishInstagramReel(Post $post, string $caption, string $videoUrl): array
    {
        if (! $this->isConfigured()) {
            return $this->err('Meta credentials not configured');
        }

        // 1. Create media container
        $container = $this->graphPost("/{$this->igUserId}/media", [
            'video_url'  => $videoUrl,
            'caption'    => $caption,
            'media_type' => 'REELS',
        ]);

        if (! $container['success']) {
            return $container;
        }

        $containerId = $container['id'];

        // 2. Poll until status = FINISHED (max 12 attempts × 5s = 60s)
        for ($i = 0; $i < 12; $i++) {
            sleep(5);

            $status = $this->graphGet("/{$containerId}", ['fields' => 'status_code']);

            if (! $status['success']) {
                return $status;
            }

            if ($status['status_code'] === 'FINISHED') {
                break;
            }

            if ($status['status_code'] === 'ERROR') {
                return $this->err('Reel processing failed (status: ERROR)');
            }
        }

        // 3. Publish
        return $this->graphPost("/{$this->igUserId}/media_publish", [
            'creation_id' => $containerId,
        ]);
    }

    // ─────────────────────────────────────────────
    //  Facebook
    // ─────────────────────────────────────────────

    /**
     * Publish a photo post to a Facebook Page.
     */
    public function publishFacebookPage(Post $post, string $caption, string $imageUrl): array
    {
        if (! $this->isConfigured()) {
            return $this->err('Meta credentials not configured');
        }

        return $this->graphPost("/{$this->fbPageId}/photos", [
            'url'     => $imageUrl,
            'caption' => $caption,
        ]);
    }

    // ─────────────────────────────────────────────
    //  HTTP helpers
    // ─────────────────────────────────────────────

    protected function graphPost(string $endpoint, array $params): array
    {
        try {
            $response = Http::timeout(30)
                ->post(self::GRAPH_URL . $endpoint, array_merge(
                    $params,
                    ['access_token' => $this->accessToken]
                ));

            $body = $response->json();

            if ($response->successful() && isset($body['id'])) {
                return ['success' => true, 'id' => $body['id'], 'error' => null];
            }

            $error = $body['error']['message'] ?? $response->body();
            Log::warning('MetaPublisherService POST failed', ['endpoint' => $endpoint, 'error' => $error]);
            return $this->err($error);

        } catch (\Throwable $e) {
            Log::error('MetaPublisherService exception', ['endpoint' => $endpoint, 'message' => $e->getMessage()]);
            return $this->err($e->getMessage());
        }
    }

    protected function graphGet(string $endpoint, array $params = []): array
    {
        try {
            $response = Http::timeout(15)
                ->get(self::GRAPH_URL . $endpoint, array_merge(
                    $params,
                    ['access_token' => $this->accessToken]
                ));

            $body = $response->json();

            if ($response->successful()) {
                return array_merge(['success' => true, 'error' => null], $body);
            }

            $error = $body['error']['message'] ?? $response->body();
            return $this->err($error);

        } catch (\Throwable $e) {
            return $this->err($e->getMessage());
        }
    }

    protected function isConfigured(): bool
    {
        return ! empty($this->accessToken)
            && ! empty($this->igUserId)
            && ! empty($this->fbPageId);
    }

    protected function err(string $message): array
    {
        return ['success' => false, 'id' => null, 'error' => $message];
    }
}
