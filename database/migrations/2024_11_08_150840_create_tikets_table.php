<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique();
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_gunung');
            $table->foreign('id_gunung')->references('id')->on('gunungs')->onDelete('cascade');
            $table->string('pos_perizinan_masuk'); // Ubah ke string
            $table->string('pos_perizinan_keluar'); // Ubah ke string
            $table->date('tgl_masuk');
            $table->date('tgl_keluar');
            $table->enum('metode_pembayaran', [
                'bank_transfer',
                'cash_on_delivery'
            ])->default('bank_transfer');
            $table->string('total_harga');
            $table->enum('status_pembayaran', [
                'pending',
                'success',
                'failed',
                'capture',
                'settlement',
                'deny',
                'cancel',
                'expire',
                'failure'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tikets');
    }
};
