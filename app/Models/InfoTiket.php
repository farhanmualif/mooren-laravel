<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoTiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_gunung',
        'weekdays_lokal',
        'weekend_lokal',
        'weekdays_asing',
        'weekend_asing',
    ];

    // Relasi InfoTiket dengan Gunung
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'id_gunung');
    }

    // Relasi dengan Tiket
    // public function tikets()
    // {
    //     return $this->hasMany(Tiket::class, 'id_info');
    // }
}
