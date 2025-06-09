<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kota_destinasi_id')->constrained('kota_destinasis')->cascadeOnDelete();
            
            // Info Dasar
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            
            // Konten Detail (JSON)
            $table->text('overview')->nullable();
            $table->json('destinations')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('facilities_include')->nullable();
            $table->json('facilities_exclude')->nullable();
            $table->text('remarks')->nullable();
            
            // Harga
            $table->decimal('price_without_hotel', 10, 2)->nullable();
            $table->json('foreign_prices')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};