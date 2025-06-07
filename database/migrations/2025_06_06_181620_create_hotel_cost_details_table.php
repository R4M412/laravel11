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
        Schema::create('hotel_cost_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('single_sup', 15, 2)->nullable();
            $table->timestamps();
        }); // <--- INI PERBAIKANNYA
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_cost_details');
    }
};