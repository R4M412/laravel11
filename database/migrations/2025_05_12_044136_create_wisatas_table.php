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
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('gambar')->nullable(); // path gambar
            $table->decimal('harga_tiket', 10, 2)->nullable();
            $table->string('jam_buka')->nullable();
            $table->json('fasilitas')->nullable();
            $table->string('kategori')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
