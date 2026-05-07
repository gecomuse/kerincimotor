<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Log;

class ContentDispatcherService
{
    public function __construct(
        protected DeepSeekService      $deepseek,
        protected MetaPublisherService $meta,
    ) {}

    /**
     * Orchestrate caption generation and social media publishing for a post.
     * Skips silently if auto_distribute is false.
     */
    public function dispatch(Post $post): void
    {
        if (! $post->auto_distribute) {
            Log::info('ContentDispatcherService: skipped (auto_distribute=false)', [
                'post_id' => $post->id,
            ]);
            return;
        }

        Log::info('ContentDispatcherService: dispatch started', ['post_id' => $post->id]);

        $post->forceFill(['distribution_status' => 'pending'])->saveQuietly();

        try {
            // Resolve featured image URL
            // Uses Spatie Media Library 'featured-image' collection if HasMedia is configured,
            // otherwise falls back to the post's thumbnail field.
            $imageUrl = null;
            if (method_exists($post, 'getFirstMediaUrl')) {
                $spatieUrl = $post->getFirstMediaUrl('featured-image');
                $imageUrl  = $spatieUrl ?: null;
            }
            if (! $imageUrl) {
                $imageUrl = $post->getThumbnailUrl();
            }

            Log::info('ContentDispatcherService: image resolved', [
                'post_id'  => $post->id,
                'imageUrl' => $imageUrl,
            ]);

            // Generate captions via DeepSeek
            Log::info('ContentDispatcherService: generating Facebook caption', ['post_id' => $post->id]);
            $fbCaption = $this->deepseek->generateCaption(
                $post->title,
                $post->content ?? '',
                'facebook'
            );

            Log::info('ContentDispatcherService: generating Instagram caption', ['post_id' => $post->id]);
            $igCaption = $this->deepseek->generateCaption(
                $post->title,
                $post->content ?? '',
                'instagram'
            );

            $post->forceFill([
                'fb_caption'       => $fbCaption,
                'ig_caption'       => $igCaption,
                'gemini_generated' => false,
            ])->saveQuietly();

            Log::info('ContentDispatcherService: captions saved', ['post_id' => $post->id]);

            // Publish to Facebook
            Log::info('ContentDispatcherService: publishing to Facebook', ['post_id' => $post->id]);
            $fbPostId = $this->meta->publishToFacebook($fbCaption, $imageUrl);

            $post->forceFill([
                'fb_post_id'   => $fbPostId,
                'fb_published' => true,
            ])->saveQuietly();

            Log::info('ContentDispatcherService: Facebook published', [
                'post_id'    => $post->id,
                'fb_post_id' => $fbPostId,
            ]);

            // Publish to Instagram (requires an image URL)
            if ($imageUrl) {
                Log::info('ContentDispatcherService: publishing to Instagram', ['post_id' => $post->id]);
                $igPostId = $this->meta->publishToInstagram($igCaption, $imageUrl);

                $post->forceFill([
                    'ig_post_id'   => $igPostId,
                    'ig_published' => true,
                ])->saveQuietly();

                Log::info('ContentDispatcherService: Instagram published', [
                    'post_id'    => $post->id,
                    'ig_post_id' => $igPostId,
                ]);
            } else {
                Log::warning('ContentDispatcherService: Instagram skipped — no image available', [
                    'post_id' => $post->id,
                ]);
            }

            $post->forceFill([
                'distribution_status' => 'published',
                'distributed_at'      => now(),
                'distribution_error'  => null,
            ])->saveQuietly();

            Log::info('ContentDispatcherService: dispatch complete', ['post_id' => $post->id]);

        } catch (\Throwable $e) {
            Log::error('ContentDispatcherService: dispatch failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $post->forceFill([
                'distribution_status' => 'failed',
                'distribution_error'  => $e->getMessage(),
            ])->saveQuietly();
        }
    }

    /**
     * Convenience wrapper — look up the post by ID then dispatch.
     */
    public function dispatchById(int $postId): void
    {
        $post = Post::findOrFail($postId);
        $this->dispatch($post);
    }
}
