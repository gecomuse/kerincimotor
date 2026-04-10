<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * ContentDispatcherService — orchestrates caption generation and social media publishing.
 *
 * Flow:
 *   1. Resolve caption  → use social_caption if set, else generate via GroqService
 *   2. Resolve image URL → use thumbnail (or meta_image for feed/fb)
 *   3. Dispatch to Instagram if publish_to_instagram = true
 *   4. Dispatch to Facebook  if publish_to_facebook  = true
 *   5. Update post ig_status / fb_status / social_error_message
 *
 * Call this from:
 *   - An Observer on Post::updated (when is_published flips to true)
 *   - A queued Job if social_scheduled_at is set
 */
class ContentDispatcherService
{
    public function __construct(
        protected GroqService          $groq,
        protected MetaPublisherService $meta,
    ) {}

    /**
     * Dispatch a published post to all enabled social channels.
     */
    public function dispatch(Post $post): void
    {
        $caption = $this->resolveCaption($post);
        $errors  = [];

        if ($post->publish_to_instagram) {
            $result = $this->dispatchInstagram($post, $caption);
            $post->ig_status = $result['success'] ? 'published' : 'failed';
            if (! $result['success']) {
                $errors[] = 'IG: ' . $result['error'];
            }
        }

        if ($post->publish_to_facebook) {
            $result = $this->dispatchFacebook($post, $caption);
            $post->fb_status = $result['success'] ? 'published' : 'failed';
            if (! $result['success']) {
                $errors[] = 'FB: ' . $result['error'];
            }
        }

        $post->social_error_message = $errors ? implode("\n", $errors) : null;
        $post->saveQuietly(); // avoid re-triggering observers
    }

    // ─────────────────────────────────────────────
    //  Instagram dispatch
    // ─────────────────────────────────────────────

    protected function dispatchInstagram(Post $post, string $caption): array
    {
        $format = $post->social_format ?? 'feed';

        try {
            return match ($format) {
                'carousel' => $this->dispatchIgCarousel($post, $caption),
                'reel'     => $this->dispatchIgReel($post, $caption),
                default    => $this->dispatchIgFeed($post, $caption),
            };
        } catch (\Throwable $e) {
            Log::error('ContentDispatcher IG exception', ['post' => $post->id, 'error' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    protected function dispatchIgFeed(Post $post, string $caption): array
    {
        $imageUrl = $this->publicUrl($post->thumbnail ?? $post->meta_image);
        if (! $imageUrl) {
            return ['success' => false, 'error' => 'No thumbnail for IG feed'];
        }
        return $this->meta->publishInstagramFeed($post, $caption, $imageUrl);
    }

    protected function dispatchIgCarousel(Post $post, string $caption): array
    {
        $paths = $post->carousel_images ?? [];
        if (count($paths) < 2) {
            return ['success' => false, 'error' => 'Carousel requires at least 2 images'];
        }
        $urls = array_map(fn($p) => $this->publicUrl($p), $paths);
        $urls = array_filter($urls); // drop any nulls
        return $this->meta->publishInstagramCarousel($post, $caption, array_values($urls));
    }

    protected function dispatchIgReel(Post $post, string $caption): array
    {
        $videoUrl = $this->publicUrl($post->reel_video_path);
        if (! $videoUrl) {
            return ['success' => false, 'error' => 'No reel video path set'];
        }
        return $this->meta->publishInstagramReel($post, $caption, $videoUrl);
    }

    // ─────────────────────────────────────────────
    //  Facebook dispatch
    // ─────────────────────────────────────────────

    protected function dispatchFacebook(Post $post, string $caption): array
    {
        $imageUrl = $this->publicUrl($post->thumbnail ?? $post->meta_image);
        if (! $imageUrl) {
            return ['success' => false, 'error' => 'No thumbnail for Facebook post'];
        }

        try {
            return $this->meta->publishFacebookPage($post, $caption, $imageUrl);
        } catch (\Throwable $e) {
            Log::error('ContentDispatcher FB exception', ['post' => $post->id, 'error' => $e->getMessage()]);
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // ─────────────────────────────────────────────
    //  Helpers
    // ─────────────────────────────────────────────

    protected function resolveCaption(Post $post): string
    {
        if (! empty($post->social_caption)) {
            return $post->social_caption;
        }

        $generated = $this->groq->generateCaption($post->title, $post->excerpt ?? '');
        if (! empty($generated)) {
            // Persist so the admin can review/edit it next time
            $post->social_caption = $generated;
        }

        return $generated ?: $post->title;
    }

    /**
     * Convert a storage path to a fully qualified public URL.
     * Returns null if path is empty.
     */
    protected function publicUrl(?string $storagePath): ?string
    {
        if (empty($storagePath)) {
            return null;
        }
        return Storage::url($storagePath);
    }
}
