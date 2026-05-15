<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->foreignId('car_id')->nullable()->constrained('cars')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\Car::class);
            $table->dropColumn('car_id');
        });
    }
};
