<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosens::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusans::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function kelompok()
    {
        return $this->hasOne(Kelompok::class);
    }

    public function jadwal()
    {
        return $this->hasOneThrough(Jadwal::class, Kelompok::class, 'mahasiswa_id', 'id', 'id', 'jadwal_id');
    }

    public function tutor()
    {
        return $this->hasOneThrough(Tutor::class, Kelompok::class, 'mahasiswa_id', 'id', 'id', 'tutor_id');
    }
}
