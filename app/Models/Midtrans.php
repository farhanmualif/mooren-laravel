<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Midtrans extends Model
{
    protected $table = 'midtrans';

    protected $fillable = [
        'order_id',
        'kode_tiket',
        'id_user',
        'total_harga',
        'status',
        'payment_type',
        'snap_token',
        'payment_url'
    ];

    // Relasi dengan Tiket
    public function tiket()
    {
        return $this->belongsTo(Tiket::class, 'kode_tiket', 'kode_tiket');
    }
}
