<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function gelombang()
    {
        return $this->belongsTo(Gelombang::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }
}
