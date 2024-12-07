<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gunung extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gunung',
        'gambar',
        'lokasi',
        'tinggi_gunung',
        'deskripsi',
    ];

    public function info_tiket()
    {
        return $this->hasOne(InfoTiket::class, 'id_gunung');
    }

    // Relasi dengan Tiket
    public function tikets()
    {
        return $this->hasMany(Tiket::class, 'id_gunung');
    }
}
