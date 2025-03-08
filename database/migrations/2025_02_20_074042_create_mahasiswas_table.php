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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->string('npm', 11)->unique();
            $table->string('nama', 50);
            $table->string('nomor_wa', 14)->nullable();
            $table->enum('jk', ['laki-laki', 'perempuan'])->nullable();
            $table->string('password');

            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id')->references('id')->on('jurusans')->onDelete('cascade');

            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');

            $table->unsignedBigInteger('dosen_id');
            $table->foreign('dosen_id')->references('id')->on('dosens')->onDelete('cascade');

            $table->unsignedBigInteger('gelombang_id');
            $table->foreign('gelombang_id')->references('id')->on('gelombangs')->onDelete('cascade');

            $table->string('kelancaran_mengaji', 30)->nullable();
            $table->string('jadwal_kuliah', 255)->nullable();
            $table->string('keterangan', 255)->nullable();

            $table->string('pilgan', 10)->nullable();
            $table->string('makhroj', 10)->nullable();
            $table->string('tajwid', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
