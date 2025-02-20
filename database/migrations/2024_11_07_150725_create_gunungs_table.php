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
        Schema::create('gunungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gunung');
            $table->string('gambar');
            $table->string('lokasi');
            $table->integer('tinggi_gunung');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gunungs');
    }
};
