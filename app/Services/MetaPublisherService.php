<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

class MetaPublisherService
{
    private const GRAPH_URL = 'https://graph.facebook.com/v19.0';

    private string $pageAccessToken;
    private string $pageId;
    private string $igAccountId;

    public function __construct()
    {
        $this->pageAccessToken = env('META_PAGE_ACCESS_TOKEN', '');
        $this->pageId          = env('META_PAGE_ID', '');
        $this->igAccountId     = env('META_IG_ACCOUNT_ID', '');
    }

    /**
     * Publish a post to Facebook Page.
     * With image → photo post. Without image → text-only feed post.
     *
     * @return string Facebook post ID (fb_post_id)
     */
    public function publishToFacebook(string $message, ?string $imageUrl = null): string
    {
        if ($imageUrl) {
            $endpoint = "/{$this->pageId}/photos";
            $payload  = [
                'url'          => $imageUrl,
                'caption'      => $message,
                'access_token' => $this->pageAccessToken,
            ];
        } else {
            $endpoint = "/{$this->pageId}/feed";
            $payload  = [
                'message'      => $message,
                'access_token' => $this->pageAccessToken,
            ];
        }

        Log::info('MetaPublisherService: publishToFacebook request', [
            'endpoint'  => $endpoint,
            'has_image' => (bool) $imageUrl,
        ]);

        $response = Http::timeout(30)->post(self::GRAPH_URL . $endpoint, $payload);
        $body     = $response->json();

        Log::info('MetaPublisherService: publishToFacebook response', ['body' => $body]);

        if (isset($body['error'])) {
            throw new RuntimeException(
                "Facebook API error [{$body['error']['code']}]: {$body['error']['message']}"
            );
        }

        if (! $response->successful() || empty($body['id'])) {
            throw new RuntimeException('Facebook API failed: ' . $response->body());
        }

        return $body['id'];
    }

    /**
     * Publish a single-image post to Instagram Business Account.
     * Step 1: create media container.
     * Step 2: publish container.
     *
     * @return string Instagram post ID (ig_post_id)
     */
    public function publishToInstagram(string $caption, string $imageUrl): string
    {
        Log::info('MetaPublisherService: publishToInstagram step 1 — create container', [
            'ig_account_id' => $this->igAccountId,
            'image_url'     => $imageUrl,
        ]);

        $containerResponse = Http::timeout(30)->post(
            self::GRAPH_URL . "/{$this->igAccountId}/media",
            [
                'image_url'    => $imageUrl,
                'caption'      => $caption,
                'access_token' => $this->pageAccessToken,
            ]
        );

        $containerBody = $containerResponse->json();
        Log::info('MetaPublisherService: Instagram container response', ['body' => $containerBody]);

        if (isset($containerBody['error'])) {
            throw new RuntimeException(
                "Instagram container error [{$containerBody['error']['code']}]: {$containerBody['error']['message']}"
            );
        }

        if (empty($containerBody['id'])) {
            throw new RuntimeException('Instagram container creation failed: ' . $containerResponse->body());
        }

        $containerId = $containerBody['id'];

        Log::info('MetaPublisherService: publishToInstagram step 2 — publish container', [
            'creation_id' => $containerId,
        ]);

        $publishResponse = Http::timeout(30)->post(
            self::GRAPH_URL . "/{$this->igAccountId}/media_publish",
            [
                'creation_id'  => $containerId,
                'access_token' => $this->pageAccessToken,
            ]
        );

        $publishBody = $publishResponse->json();
        Log::info('MetaPublisherService: Instagram publish response', ['body' => $publishBody]);

        if (isset($publishBody['error'])) {
            throw new RuntimeException(
                "Instagram publish error [{$publishBody['error']['code']}]: {$publishBody['error']['message']}"
            );
        }

        if (empty($publishBody['id'])) {
            throw new RuntimeException('Instagram publish failed: ' . $publishResponse->body());
        }

        return $publishBody['id'];
    }

    /**
     * Fetch basic page info. Use this to test API connectivity.
     *
     * @return array{name: string, id: string, followers_count: int}
     */
    public function getPageInfo(): array
    {
        Log::info('MetaPublisherService: getPageInfo request', ['page_id' => $this->pageId]);

        $response = Http::timeout(15)->get(self::GRAPH_URL . "/{$this->pageId}", [
            'fields'       => 'name,id,fan_count',
            'access_token' => $this->pageAccessToken,
        ]);

        $body = $response->json();
        Log::info('MetaPublisherService: getPageInfo response', ['body' => $body]);

        if (isset($body['error'])) {
            throw new RuntimeException(
                "Facebook Page info error [{$body['error']['code']}]: {$body['error']['message']}"
            );
        }

        if (! $response->successful()) {
            throw new RuntimeException('Failed to get page info: ' . $response->body());
        }

        return [
            'name'            => $body['name'] ?? '',
            'id'              => $body['id'] ?? '',
            'followers_count' => $body['fan_count'] ?? 0,
        ];
    }
}
