<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\API'],function()
{
    // --------------- register and login ----------------//
    Route::controller(AuthenticationController::class)->group(function () {
        Route::post('register', 'register')->name('register');
        Route::post('login', 'login')->name('login');
    });

    Route::controller(MenuController::class)->group(function () {
        Route::get('/guest/menu', 'index');
        Route::get('/guest/menu/{id}', 'menuById');
        Route::get('/guest/gunung', 'gunung');
        Route::get('/guest/gunung/{id}', 'gunungById');
        Route::get('/guest/gambar-tiket', 'gambarTiket');
    });
});

Route::middleware('auth:api')->group(function () {
    Route::group(['namespace' => 'App\Http\Controllers\API'],function()
    {
        Route::controller(AuthenticationController::class)->group(function () {
            Route::get('profile', 'profile')->name('profile');
            Route::patch('profile', 'update')->name('update-profile'); // Changed from 'update' to 'profile'
            Route::post('logout', 'logout')->name('logout');
        });

        Route::controller(MenuController::class)->group(function () {
            Route::get('/menu', 'index')->name('menu');
        });
        Route::controller(TiketController::class)->group(function () {
            Route::get('/tiket', 'index')->name('tiket');
            Route::post('/tiket', 'store')->name('add-tiket');
            Route::get('/tiket/{kodeTiket}', 'show')->name('show-tiket');
            Route::get('/tiket-saya', 'tiket_saya')->name('tiket-saya');
            Route::put('/ubah-tiket', 'ubah_tiket')->name('ubah-tiket');

        });
        Route::controller(MidtransController::class)->group(function () {
            Route::post('/midtrans/transaction', 'createTransaction')->name('midtrans-transaction');
            Route::get('/midtrans/status/{orderId}', 'checkStatus')->name('midtrans-status');
        });
    });

});

