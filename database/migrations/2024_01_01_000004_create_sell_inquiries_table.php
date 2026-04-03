<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sell_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('phone', 20);
            $table->string('car_make', 100);
            $table->string('car_model', 150);
            $table->smallInteger('year')->unsigned();
            $table->integer('mileage')->unsigned();
            $table->enum('transmission', ['manual', 'automatic'])->nullable();
            $table->string('color', 100)->nullable();
            $table->string('plate_number', 20)->nullable();
            $table->string('condition', 50)->nullable();
            $table->string('asking_price', 100);
            $table->text('notes')->nullable();
            $table->enum('status', ['new', 'contacted', 'closed'])->default('new');
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sell_inquiries');
    }
};
