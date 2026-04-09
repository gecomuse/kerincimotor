<?php

namespace App\Services;

use App\Models\Post;

/**
 * ContentDispatcherService — orchestrates caption generation and social media publishing.
 *
 * Flow:
 *   1. If social_caption is empty → call GroqService to generate one
 *   2. Dispatch to Instagram (if publish_to_instagram)
 *   3. Dispatch to Facebook  (if publish_to_facebook)
 *   4. Update post ig_status / fb_status / social_error_message
 */
class ContentDispatcherService
{
    public function __construct(
        protected GroqService          $groq,
        protected MetaPublisherService $meta,
    ) {}

    /**
     * Dispatch a published post to all enabled social channels.
     *
     * @param  Post  $post
     * @return void
     */
    public function dispatch(Post $post): void
    {
        // TODO: implement dispatch logic
    }
}
