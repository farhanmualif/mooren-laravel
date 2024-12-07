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
        Schema::create('info_tikets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_gunung');
            $table->foreign('id_gunung')->references('id')->on('gunungs')->onDelete('cascade');
            $table->integer('weekdays_lokal');
            $table->integer('weekend_lokal');
            $table->integer('weekdays_asing');
            $table->integer('weekend_asing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_tikets');
    }
};
