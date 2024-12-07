<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $table = 'tikets';

    protected $fillable = [
        'kode_tiket',
        'id_user',
        'id_gunung',
        'pos_perizinan_masuk',
        'pos_perizinan_keluar',
        'tgl_masuk',
        'tgl_keluar',
        'metode_pembayaran',
        'total_harga',
        'status_pembayaran'
    ];

    // Relasi InfoTiket dengan Gunung
    public function gunung()
    {
        return $this->belongsTo(Gunung::class, 'id_gunung');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi dengan InfoTiket
    // public function infoTiket()
    // {
    //     return $this->belongsTo(InfoTiket::class, 'id_info');
    // }

    /**
     * Boot method untuk menghasilkan kode_tiket secara otomatis saat pembuatan.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->kode_tiket = $model->generateKodeTiket();
        });
    }

    /**
     * Generate kode_tiket dengan format PTGXXXX
     * dimana XXXX adalah kombinasi huruf dan angka.
     */
    public function generateKodeTiket()
    {
        // Membuat 5 karakter acak yang terdiri dari huruf besar dan angka
        $randomString = strtoupper(Str::random(5));
        return 'PTG' . $randomString;
    }

    // Tambahkan relasi dengan Midtrans
    public function midtransTransactions()
    {
        return $this->hasMany(Midtrans::class, 'order_id', 'kode_tiket');
    }
}
