<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Perintah untuk MEMBUAT tabel.
     */
    public function up(): void
    {
        Schema::create('pulau_destinasis', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('judul');
            
            // Kolom ini krusial untuk membuat URL yang unik dan bersih.
            // Contoh: website.com/pulau/jawa-barat
            $table->string('slug')->unique();
            
            $table->text('deskripsi');
            $table->timestamps(); // otomatis membuat kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     * Perintah untuk MENGHAPUS tabel jika migration di-rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('pulau_destinasis');
    }
};