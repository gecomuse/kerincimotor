<?php

namespace App\Jobs;

use App\Models\PostSchedule;
use App\Services\PublishingService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class PublishScheduledPost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public PostSchedule $schedule) {}

    public function handle(PublishingService $publishing): void
    {
        $publishing->publishToAccount($this->schedule);
    }

    public function failed(Throwable $exception): void
    {
        $this->schedule->update([
            'status' => 'failed',
            'error_message' => $exception->getMessage(),
        ]);
    }
}
