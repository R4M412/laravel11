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
        Schema::create('land_tour_only_costs', function (Blueprint $table) {
            $table->id();
            $table->string('participant_range'); // e.g. "3–5 Pax"
            $table->integer('price_per_person'); // e.g. 1250
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('land_tour_only_costs');
    }
};
