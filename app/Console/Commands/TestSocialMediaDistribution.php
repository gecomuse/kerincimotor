<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Services\ContentDispatcherService;
use App\Services\DeepSeekService;
use App\Services\MetaPublisherService;
use Illuminate\Console\Command;

class TestSocialMediaDistribution extends Command
{
    protected $signature = 'social:test';

    protected $description = 'Test social media distribution services without publishing';

    public function handle(
        DeepSeekService        $deepseek,
        MetaPublisherService   $meta,
    ): int {
        $this->line('');
        $this->info('═══════════════════════════════════════');
        $this->info('  Social Media Distribution — Dry Run  ');
        $this->info('═══════════════════════════════════════');
        $this->line('');

        // ─────────────────────────────────────────────
        //  1. DeepSeekService
        // ─────────────────────────────────────────────
        $this->info('▶ [1/3] DeepSeekService — generateCaption()');
        $this->line('');

        $dummyTitle   = 'Toyota Avanza 2020 Bekas Bekasi';
        $dummyContent = 'Mobil bekas berkualitas, terawat, siap pakai';

        foreach (['instagram', 'facebook'] as $platform) {
            $this->line("  Platform: <fg=cyan>{$platform}</>");

            try {
                $caption = $deepseek->generateCaption($dummyTitle, $dummyContent, $platform);
                $this->line('  <fg=green>✓ Caption berhasil di-generate:</>');
                $this->line('  ┌─────────────────────────────────────');
                foreach (explode("\n", wordwrap($caption, 70)) as $line) {
                    $this->line("  │ {$line}");
                }
                $this->line('  └─────────────────────────────────────');
            } catch (\Throwable $e) {
                $this->error("  ✗ Error: {$e->getMessage()}");
            }

            $this->line('');
        }

        // ─────────────────────────────────────────────
        //  2. MetaPublisherService
        // ─────────────────────────────────────────────
        $this->info('▶ [2/3] MetaPublisherService — getPageInfo()');
        $this->line('');

        try {
            $pageInfo = $meta->getPageInfo();
            $this->line('  <fg=green>✓ Koneksi ke Meta API berhasil:</>');
            $this->line("  │ Name            : {$pageInfo['name']}");
            $this->line("  │ Page ID         : {$pageInfo['id']}");
            $this->line("  │ Followers       : {$pageInfo['followers_count']}");
        } catch (\Throwable $e) {
            $this->error("  ✗ Error: {$e->getMessage()}");
        }

        $this->line('');

        // ─────────────────────────────────────────────
        //  3. ContentDispatcherService — dry run
        // ─────────────────────────────────────────────
        $this->info('▶ [3/3] ContentDispatcherService — dry run (generate only, no publish)');
        $this->line('');

        try {
            $post = Post::first();

            if (! $post) {
                $this->line('  <fg=yellow>⚠ Tidak ada post di database — skip dry run.</>');
            } else {
                $this->line("  Post ID    : {$post->id}");
                $this->line("  Title      : {$post->title}");
                $this->line('');

                foreach (['facebook', 'instagram'] as $platform) {
                    $this->line("  Generating caption for <fg=cyan>{$platform}</> ...");

                    try {
                        $caption = $deepseek->generateCaption(
                            $post->title,
                            $post->content ?? '',
                            $platform
                        );
                        $this->line("  <fg=green>✓ {$platform} caption:</>");
                        $this->line('  ┌─────────────────────────────────────');
                        foreach (explode("\n", wordwrap($caption, 70)) as $line) {
                            $this->line("  │ {$line}");
                        }
                        $this->line('  └─────────────────────────────────────');
                    } catch (\Throwable $e) {
                        $this->error("  ✗ {$platform} caption error: {$e->getMessage()}");
                    }

                    $this->line('');
                }

                $this->line('  <fg=yellow>⚠ Dry run — tidak ada yang dipublish ke sosial media.</>');
            }
        } catch (\Throwable $e) {
            $this->error("  ✗ Error saat ambil post: {$e->getMessage()}");
        }

        $this->line('');
        $this->info('═══════════════════════════════════════');
        $this->info('  Selesai.                             ');
        $this->info('═══════════════════════════════════════');
        $this->line('');

        return self::SUCCESS;
    }
}
