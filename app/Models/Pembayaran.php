<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_tiket',
        'tgl_pembayaran',
        'jumlah',
        'metode_pembayaran',
        'status',
    ];

    // Tipe data casting
    protected $casts = [
        'tgl_pembayaran' => 'datetime',
        'jumlah' => 'decimal:2',
        'status' => 'string',
    ];

    /**
     * Relasi dengan model Tiket
     */
    public function tikets()
    {
        return $this->belongsTo(Tiket::class, 'id_tiket');
    }
}
