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
        Schema::create('midtrans', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('kode_tiket');
            $table->string('id_user');
            $table->string('total_harga');
            $table->string('status');
            $table->string('payment_type')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamps();

            $table->foreign('kode_tiket')
                  ->references('kode_tiket')
                  ->on('tikets')
                  ->onDelete('cascade');

            $table->index('order_id');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('midtrans');
    }
};
