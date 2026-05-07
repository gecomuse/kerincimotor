<?php

namespace App\Jobs;

use App\Models\PostSchedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckAndDispatchScheduledPosts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        PostSchedule::query()
            ->where('status', 'pending')
            ->where('scheduled_at', '<=', now())
            ->each(function (PostSchedule $schedule) {
                PublishScheduledPost::dispatch($schedule);
            });
    }
}
