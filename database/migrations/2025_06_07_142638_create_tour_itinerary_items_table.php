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

            // Kolom untuk relasi ke tabel induk.
            // Akan otomatis terhapus jika induknya dihapus (cascadeOnDelete).
            $table->foreignId('tour_itinerary_id')->constrained()->cascadeOnDelete();
            
            // Kolom-kolom yang sesuai dengan form di Repeater
            $table->unsignedInteger('day');
            $table->unsignedInteger('sort_order')->default(0); // Untuk fitur re-order
            $table->string('type'); // Tipe konten: 'description' atau 'checklist'
            
            // Kolom-kolom yang sifatnya bisa null, tergantung 'type'
            $table->string('title')->nullable(); // Untuk instruksi checklist
            $table->text('description')->nullable(); // Untuk tipe description
            $table->json('options')->nullable(); // Untuk menyimpan opsi checklist
            
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