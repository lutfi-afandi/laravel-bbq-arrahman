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
        Schema::table('informasis', function (Blueprint $table) {
            $table->dropColumn('masa_daftar'); // Hapus kolom lama
            $table->date('mulai_daftar')->nullable()->after('gelombang_id'); // Tambahkan kolom baru
            $table->date('akhir_daftar')->nullable()->after('mulai_daftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('informasis', function (Blueprint $table) {
            $table->dropColumn(['mulai_daftar', 'akhir_daftar']);
            $table->date('masa_daftar')->after('gelombang_id'); // Kembalikan jika rollback

        });
    }
};
