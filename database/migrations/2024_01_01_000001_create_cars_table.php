<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('make_model');
            $table->enum('body_type', ['sedan', 'suv', 'mpv', 'city_car', 'pickup', 'hatchback', 'minibus', 'jeep', 'van']);
            $table->smallInteger('year')->unsigned();
            $table->bigInteger('price')->unsigned();
            $table->integer('mileage')->unsigned();
            $table->enum('transmission', ['manual', 'automatic']);
            $table->enum('fuel_type', ['petrol', 'diesel', 'hybrid', 'electric']);
            $table->string('color', 100);
            $table->text('description')->nullable();
            $table->string('tax_status', 50)->nullable();
            $table->text('condition_notes')->nullable();
            $table->text('whatsapp_message')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->nullable();
            $table->timestamps();

            $table->index(['is_available', 'is_featured']);
            $table->index(['body_type', 'transmission', 'fuel_type']);
            $table->index(['year', 'price', 'mileage']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
