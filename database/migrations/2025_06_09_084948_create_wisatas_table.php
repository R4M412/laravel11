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
            $table->string('judul');
            $table->string('slug')->unique();
            $table->foreignId('kota_destinasi_id')->constrained()->cascadeOnDelete();
            
            // INI KOLOM UNTUK HARGA MANUAL ANDA
            $table->string('display_price')->nullable()->comment('Teks harga untuk ditampilkan, cth: 750.000');

            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->longText('overview')->nullable();
            $table->json('destinations')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('land_tour_prices')->nullable();
            $table->json('hotel_pricings')->nullable();
            $table->json('foreign_guest_surcharges')->nullable();
            $table->json('facilities_include')->nullable();
            $table->json('facilities_exclude')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};