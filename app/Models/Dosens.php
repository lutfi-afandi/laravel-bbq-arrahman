<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosens extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'dosens';
    protected $fillable = [
        'kode',
        'nama',
        'foto'
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
