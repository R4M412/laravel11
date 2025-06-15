<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisatas', function (Blueprint $table) {
            // Tambah kolom buat fasilitas INCLUDE
            $table->text('facilities_include_text')->nullable();
            
            // Tambah kolom buat fasilitas EXCLUDE
            $table->text('facilities_exclude_text')->nullable();

            // Hapus kolom JSON yang lama
            $table->dropColumn(['facilities_include', 'facilities_exclude']);
        });
    }

    public function down(): void
    {
        Schema::table('wisatas', function (Blueprint $table) {
            // Balikin kalo ada apa-apa
            $table->dropColumn(['facilities_include_text', 'facilities_exclude_text']);
            $table->json('facilities_include')->nullable();
            $table->json('facilities_exclude')->nullable();
        });
    }
};