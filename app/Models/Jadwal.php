<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kelompok()
    {
        return $this->hasMany(Kelompok::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function waktu()
    {
        return $this->belongsTo(Waktu::class);
    }
}
