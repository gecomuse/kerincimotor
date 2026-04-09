<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('publish_to_instagram')->default(false)->after('meta_keywords');
            $table->boolean('publish_to_facebook')->default(false)->after('publish_to_instagram');
            $table->string('social_format')->nullable()->after('publish_to_facebook');     // feed|carousel|reel
            $table->text('social_caption')->nullable()->after('social_format');
            $table->json('carousel_images')->nullable()->after('social_caption');
            $table->string('reel_video_path')->nullable()->after('carousel_images');
            $table->timestamp('social_scheduled_at')->nullable()->after('reel_video_path');
            $table->string('ig_status')->default('idle')->after('social_scheduled_at');    // idle|pending|published|failed
            $table->string('fb_status')->default('idle')->after('ig_status');              // idle|pending|published|failed
            $table->text('social_error_message')->nullable()->after('fb_status');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'publish_to_instagram',
                'publish_to_facebook',
                'social_format',
                'social_caption',
                'carousel_images',
                'reel_video_path',
                'social_scheduled_at',
                'ig_status',
                'fb_status',
                'social_error_message',
            ]);
        });
    }
};
