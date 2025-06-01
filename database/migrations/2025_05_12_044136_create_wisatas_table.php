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
            $table->string('gambar_thumbnail')->nullable();
            $table->json('gambar_wisata')->nullable(); // untuk multiple images
            $table->string('judul');
            $table->text('deskripsi');
            $table->decimal('harga_paket', 15, 2);
            $table->string('transportasi')->nullable();
            $table->string('itenary')->nullable();
            $table->text('fasilitas')->nullable();
            $table->string('remarks')->nullable();
            $table->string('additional')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
