<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->foreignId('financing_car_id')->nullable()->after('car_id')->constrained('cars')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('hero_settings', function (Blueprint $table) {
            $table->dropForeign(['financing_car_id']);
            $table->dropColumn('financing_car_id');
        });
    }
};
