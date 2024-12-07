<?php

use Illuminate\Support\Facades\Route;

// Midtrans notification webhook (public route)
Route::post('/midtrans/notification', 'App\Http\Controllers\API\MidtransController@handleNotification')
    ->name('midtrans-notification');

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::controller(AuthenticationController::class)->group(function () {
        // ---------------------login----------------------//
        Route::get('login', 'login')->name('login')->middleware('guest');
        Route::post('login/account', 'loginAccount')->name('login/account');
        // ---------------------profile----------------------//
        Route::get('profile', 'getAdminProfile')->name('profile');
        Route::patch('profile-update', 'updateProfile')->name('profile-update');
        // ---------------------logout----------------------//
        Route::post('logout', 'logout')->name('logout');
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index');
    });

    // Apply middleware for protected routes
    Route::group(['middleware' => ['auth']], function () {

        // -------------------------- main dashboard ----------------------//

        Route::controller(HomeController::class)->group(function () {
            Route::get('/dashboard', 'dashboard')->name('home');

            Route::get('/dashboard/gunung', 'gunung')->name('gunung');
            Route::get('/dashboard/tambah-gunung', 'tambah_gunung')->name('tambah-gunung');
            Route::get('/dashboard/edit-gunung/{id}', 'edit_gunung')->name('edit-gunung');
            Route::get('/dashboard/hapus-gunung/{id}', 'hapus_gunung')->name('hapus-gunung');

            Route::get('/dashboard/panduan', 'panduan')->name('panduan');
            Route::get('/dashboard/tambah-panduan', 'tambah_panduan')->name('tambah-panduan');
            Route::get('/dashboard/edit-panduan/{id}', 'edit_panduan')->name('edit-panduan');
            Route::get('/dashboard/hapus-panduan/{id}', 'hapus_panduan')->name('hapus-panduan');

            Route::get('/dashboard/info-tiket', 'info_tiket')->name('info-tiket');
            Route::get('/dashboard/tambah-info-tiket', 'tambah_info_tiket')->name('tambah-info-tiket');
            Route::get('/dashboard/edit-info-tiket/{id}', 'edit_info_tiket')->name('edit-info-tiket');
            Route::get('/dashboard/hapus-info-tiket/{id}', 'hapus_info_tiket')->name('hapus-info-tiket');

            Route::get('/dashboard/pesanan', 'pesanan')->name('pesanan');
            Route::get('/dashboard/pembayaran', 'pembayaran')->name('pembayaran');
            Route::get('/dashboard/tambah-pembayaran', 'tambah_pembayaran')->name('tambah-pembayaran');

            Route::get('/dashboard/info-user', 'user')->name('info-user');
            Route::get('/dashboard/hapus-user/{id}', 'hapus_user')->name('hapus-user');

            Route::get('/dashboard/gambar-tiket', 'gambar_tiket')->name('gambar-tiket');
            Route::get('/dashboard/edit-gambar-tiket', 'edit_gambar_tiket')->name('edit-gambar-tiket');
        });
    });
});
