<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kota_destinasis', function (Blueprint $table) {
            $table->id();
            
            // INI KUNCINYA: Kolom untuk menghubungkan ke tabel induk (Pulau)
            $table->foreignId('pulau_destinasi_id')->constrained('pulau_destinasis')->cascadeOnDelete();
            
            // Kolom-kolom lain untuk data kota
            $table->string('gambar')->nullable();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kota_destinasis');
    }
};