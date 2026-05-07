<?php

namespace App\Observers;

use App\Models\Post;
use App\Services\ContentDispatcherService;
use Illuminate\Support\Facades\Log;

class PostObserver
{
    public function __construct(
        protected ContentDispatcherService $dispatcher,
    ) {}

    public function updated(Post $post): void
    {
        if (! $post->auto_distribute) {
            return;
        }

        $distributionReady = $post->distribution_status === null
            || $post->distribution_status === 'failed';

        if (! $distributionReady) {
            return;
        }

        if ($post->status !== 'published') {
            return;
        }

        // defer() runs after the HTTP response is sent — won't block Filament's save action
        defer(function () use ($post) {
            try {
                $this->dispatcher->dispatch($post);
            } catch (\Throwable $e) {
                Log::error('PostObserver: dispatch failed', [
                    'post_id' => $post->id,
                    'error'   => $e->getMessage(),
                ]);
            }
        });
    }
}
