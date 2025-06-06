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
        Schema::create('cost_details', function (Blueprint $table) {
        $table->id();
        $table->string('hotel_name');
        $table->integer('star_rating');
        $table->integer('price_50_pax');
        $table->integer('price_11_12_pax');
        $table->integer('price_8_10_pax');
        $table->integer('price_6_7_pax');
        $table->integer('price_3_5_pax');
        $table->integer('price_2_pax');
        $table->integer('single_sup')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cost_details');
    }
};
