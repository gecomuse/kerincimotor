<?php

namespace App\Services;

use App\Models\ContentPost;
use App\Models\PostSchedule;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Log;

class PublishingService
{
    public function __construct(
        private MetaService $meta,
    ) {}

    public function publishPost(ContentPost $post): array
    {
        $schedules = $post->postSchedules()->where('status', 'pending')->get();
        $results = [];

        foreach ($schedules as $schedule) {
            $this->publishToAccount($schedule);
            $results[] = [
                'schedule_id' => $schedule->id,
                'platform' => $schedule->socialAccount->platform,
                'status' => $schedule->fresh()->status,
            ];
        }

        return $results;
    }

    public function publishToAccount(PostSchedule $schedule): void
    {
        $schedule->update(['status' => 'processing']);

        $account = $schedule->socialAccount;
        $post = $schedule->contentPost;

        try {
            $result = match ($account->platform) {
                'facebook' => $this->meta->postToFacebookPage(
                    message: $post->caption,
                    imageUrl: $post->media_url,
                    pageAccessToken: $account->access_token,
                    pageId: $account->account_id,
                ),
                'instagram' => $this->meta->postToInstagram(
                    caption: $post->caption,
                    imageUrl: $post->media_url ?? '',
                    accessToken: $account->access_token,
                    instagramAccountId: $account->account_id,
                ),
                default => ['success' => false, 'error' => "Platform {$account->platform} not supported yet"],
            };

            if ($result['success']) {
                $schedule->update([
                    'status' => 'done',
                    'published_at' => now(),
                    'platform_response' => $result,
                ]);
            } else {
                $schedule->update([
                    'status' => 'failed',
                    'error_message' => $result['error'] ?? 'Unknown error',
                    'platform_response' => $result,
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('PublishingService::publishToAccount failed', [
                'schedule_id' => $schedule->id,
                'error' => $e->getMessage(),
            ]);

            $schedule->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
        }
    }

    public function publishNow(ContentPost $post, array $accountIds): array
    {
        $results = [];

        $accounts = SocialAccount::whereIn('id', $accountIds)->get();

        foreach ($accounts as $account) {
            try {
                $result = match ($account->platform) {
                    'facebook' => $this->meta->postToFacebookPage(
                        message: $post->caption,
                        imageUrl: $post->media_url,
                        pageAccessToken: $account->access_token,
                        pageId: $account->account_id,
                    ),
                    'instagram' => $this->meta->postToInstagram(
                        caption: $post->caption,
                        imageUrl: $post->media_url ?? '',
                        accessToken: $account->access_token,
                        instagramAccountId: $account->account_id,
                    ),
                    default => ['success' => false, 'error' => "Platform {$account->platform} not supported yet"],
                };

                $results[$account->id] = [
                    'account_name' => $account->account_name,
                    'platform' => $account->platform,
                    'success' => $result['success'],
                    'error' => $result['error'] ?? null,
                ];

                if ($result['success']) {
                    PostSchedule::create([
                        'content_post_id' => $post->id,
                        'social_account_id' => $account->id,
                        'scheduled_at' => now(),
                        'published_at' => now(),
                        'status' => 'done',
                        'platform_response' => $result,
                    ]);
                }
            } catch (\Throwable $e) {
                Log::error('PublishingService::publishNow failed', [
                    'account_id' => $account->id,
                    'error' => $e->getMessage(),
                ]);

                $results[$account->id] = [
                    'account_name' => $account->account_name,
                    'platform' => $account->platform,
                    'success' => false,
                    'error' => $e->getMessage(),
                ];
            }
        }

        return $results;
    }
}
