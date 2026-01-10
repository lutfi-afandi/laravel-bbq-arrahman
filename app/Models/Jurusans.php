<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurusans extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['kode', 'nama'];


    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
}
