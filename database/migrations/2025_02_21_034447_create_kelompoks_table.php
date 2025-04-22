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
        Schema::create('kelompoks', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('jadwal_id');
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');

            $table->integer('p1')->nullable();
            $table->integer('p2')->nullable();
            $table->integer('p3')->nullable();
            $table->integer('p4')->nullable();
            $table->integer('p5')->nullable();
            $table->integer('p6')->nullable();
            $table->integer('p7')->nullable();
            $table->integer('p8')->nullable();
            $table->integer('p9')->nullable();
            $table->integer('p10')->nullable();
            $table->integer('p11')->nullable();
            $table->integer('p12')->nullable();
            $table->integer('kehadiran')->nullable();
            $table->integer('mutabaah')->nullable();
            $table->integer('uts')->nullable();
            $table->integer('kegiatan_wajib')->nullable();
            $table->integer('wudhu')->nullable();
            $table->integer('sholat')->nullable();
            $table->integer('tilawah')->nullable();
            $table->integer('uas_tertulis')->nullable();
            $table->double('nilai_akhir')->nullable();
            $table->char('huruf_mutu')->nullable();
            $table->dateTime('updated_nilai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompoks');
    }
};
