<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotel_pricings', function (Blueprint $table) {
                $table->id();         
                $table->foreignId('wisata_id')->constrained('wisatas')->cascadeOnDelete();
                $table->string('hotel_name');
                $table->unsignedInteger('single_supplement');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_pricings');
    }
};
