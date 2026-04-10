<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\ContentDispatcherService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    /**
     * Fire social media dispatch when:
     *   - is_published just flipped to true
     *   - AND at least one social channel is enabled
     *   - AND social_scheduled_at is null (immediate) or in the past
     */
    public function updated(Post $post): void
    {
        if (! $post->isDirty('is_published') || ! $post->is_published) {
            return;
        }

        if (! $post->publish_to_instagram && ! $post->publish_to_facebook) {
            return;
        }

        // If scheduled for the future, skip — a scheduler will handle it
        if ($post->social_scheduled_at && $post->social_scheduled_at->isFuture()) {
            return;
        }

        try {
            $post->ig_status = $post->publish_to_instagram ? 'pending' : $post->ig_status;
            $post->fb_status = $post->publish_to_facebook  ? 'pending' : $post->fb_status;
            $post->saveQuietly();

            app(ContentDispatcherService::class)->dispatch($post);
        } catch (\Throwable $e) {
            Log::error('PostObserver dispatch failed', [
                'post_id' => $post->id,
                'error'   => $e->getMessage(),
            ]);
        }
    }
}
