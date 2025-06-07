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
        Schema::create('tour_itinerary_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('tour_itinerary_id')->constrained()->onDelete('cascade');

                $table->string('type')->default('text'); // text atau checklist
                $table->text('content'); // teks deskripsi atau judul checklist
                $table->json('options')->nullable(); // kalau checklist, isi pilihan di sini

                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_itinerary_items');
    }
};
