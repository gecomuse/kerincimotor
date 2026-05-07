<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->longText('caption');
            $table->string('media_url')->nullable();
            $table->string('media_type')->default('image');
            $table->json('target_platforms');
            $table->enum('status', ['draft', 'scheduled', 'published', 'failed'])->default('draft');
            $table->json('ai_metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_posts');
    }
};
