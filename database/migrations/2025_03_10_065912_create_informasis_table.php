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
        Schema::create('informasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gelombang_id');
            $table->date('masa_daftar');
            $table->enum('status_pendaftaran', ['dibuka', 'ditutup'])->default('dibuka');
            $table->integer('biaya')->nullable();
            $table->string('wa_konfirmasi')->nullable();
            $table->date('mulai_kbm')->nullable();
            $table->date('launching')->nullable();
            $table->date('mabit')->nullable();
            $table->date('jalasah')->nullable();
            $table->date('talkshow')->nullable();
            $table->string('cp1')->nullable();
            $table->string('nama_cp1')->nullable();
            $table->string('cp2')->nullable();
            $table->string('nama_cp2')->nullable();
            $table->string('pamflet')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();

            // Foreign key ke tabel gelombangs
            $table->foreign('gelombang_id')->references('id')->on('gelombangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasis');
    }
};
