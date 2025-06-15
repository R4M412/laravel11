<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wisatas', function (Blueprint $table) {
            // Langsung TAMBAHKAN kolom-kolom baru, jangan rename
            $table->string('duration_text')->nullable()->after('display_price');
            $table->integer('duration_days')->unsigned()->default(1)->after('duration_text');
        });
    }

    public function down(): void
    {
        Schema::table('wisatas', function (Blueprint $table) {
            // Logika untuk membatalkan jika di-rollback
            $table->dropColumn(['duration_text', 'duration_days']);
        });
    }
};