<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('auto_distribute')->default(false)->after('id');
            $table->string('distribution_status')->nullable()->after('auto_distribute');
            $table->string('fb_post_id')->nullable()->after('distribution_status');
            $table->string('ig_post_id')->nullable()->after('fb_post_id');
            $table->text('gemini_caption')->nullable()->after('ig_post_id');
            $table->text('fb_caption')->nullable()->after('gemini_caption');
            $table->text('ig_caption')->nullable()->after('fb_caption');
            $table->timestamp('distributed_at')->nullable()->after('ig_caption');
            $table->text('distribution_error')->nullable()->after('distributed_at');
            $table->boolean('gemini_generated')->default(false)->after('distribution_error');
            $table->boolean('fb_published')->default(false)->after('gemini_generated');
            $table->boolean('ig_published')->default(false)->after('fb_published');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn([
                'auto_distribute',
                'distribution_status',
                'fb_post_id',
                'ig_post_id',
                'gemini_caption',
                'fb_caption',
                'ig_caption',
                'distributed_at',
                'distribution_error',
                'gemini_generated',
                'fb_published',
                'ig_published',
            ]);
        });
    }
};
