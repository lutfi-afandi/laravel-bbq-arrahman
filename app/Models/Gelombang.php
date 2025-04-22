<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function informasi()
    {
        return $this->hasOne(Informasi::class);
    }

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
