<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::view('/', 'welcome')->name('welcome');

//--------------------------WEB Bagian Login,Logout,riset password,renew password----------------------------------------//
//LOGIN
Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'verify'])->name('login.verify');
//logout
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('login.logout');
//riset password
Route::get('/reset-password', [App\Http\Controllers\LoginController::class, 'reset'])->name('login.reset');
Route::post('/forgot', [App\Http\Controllers\LoginController::class, 'forgot'])->name('login.forgot');
//renew password
Route::get('/password/{email}/{remember_token}', [App\Http\Controllers\LoginController::class, 'password'])->name('login.password');
Route::post('/renew', [App\Http\Controllers\LoginController::class, 'renew'])->name('login.renew');


Route::group(['middleware' => 'auth:admin'], function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard.index');

        //  PENGGUNA
        Route::prefix('pengguna')->group(function () {
            Route::get('/index', [\App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('admin.pengguna.index');
            Route::get('/tambah', [\App\Http\Controllers\Admin\PenggunaController::class, 'tambah'])->name('admin.pengguna.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\PenggunaController::class, 'store'])->name('admin.pengguna.store');

            Route::get('/edit/{id_pengguna}', [App\Http\Controllers\Admin\PenggunaController::class, 'edit'])->name('admin.pengguna.edit');
            Route::post('/update/{id_pengguna}', [App\Http\Controllers\Admin\PenggunaController::class, 'update'])->name('admin.pengguna.update');
            Route::get('/hapus/{id_pengguna}', [App\Http\Controllers\Admin\PenggunaController::class, 'hapus'])->name('admin.pengguna.hapus');

            Route::get('/excel', [App\Http\Controllers\Admin\PenggunaController::class, 'excel'])->name('admin.pengguna.excel');
            Route::get('/pdf', [App\Http\Controllers\Admin\PenggunaController::class, 'cetakPdf'])->name('admin.pengguna.pdf');
        });

        // Instansi
        Route::prefix('instansi')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\InstansiController::class, 'index'])->name('admin.instansi.index');
            Route::get('/tambah', [App\Http\Controllers\Admin\InstansiController::class, 'tambah'])->name('admin.instansi.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\InstansiController::class, 'store'])->name('admin.instansi.store');

            Route::get('/edit/{id_instansi}', [App\Http\Controllers\Admin\InstansiController::class, 'edit'])->name('admin.instansi.edit');
            Route::post('/update/{id_instansi}', [App\Http\Controllers\Admin\InstansiController::class, 'update'])->name('admin.instansi.update');
            Route::get('/hapus/{id_instansi}', [App\Http\Controllers\Admin\InstansiController::class, 'hapus'])->name('admin.instansi.hapus');
        });

        // Barang
        Route::prefix('barang')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\BarangController::class, 'index'])->name('admin.barang.index');
            Route::get('/tambah', [App\Http\Controllers\Admin\BarangController::class, 'tambah'])->name('admin.barang.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\BarangController::class, 'store'])->name('admin.barang.store');

            Route::get('/edit/{id_barang}', [App\Http\Controllers\Admin\BarangController::class, 'edit'])->name('admin.barang.edit');
            Route::post('/update/{id_barang}', [App\Http\Controllers\Admin\BarangController::class, 'update'])->name('admin.barang.update');
            Route::get('/hapus/{id_barang}', [App\Http\Controllers\Admin\BarangController::class, 'hapus'])->name('admin.barang.hapus');

            Route::get('/excel', [App\Http\Controllers\Admin\BarangController::class, 'excel'])->name('admin.barang.excel');
            Route::get('/pdf', [App\Http\Controllers\Admin\BarangController::class, 'pdf'])->name('admin.barang.pdf');
        });

        // peminjaman
        Route::prefix('peminjaman')->group(function () {
            Route::get('/index', [App\Http\Controllers\Admin\PeminjamanController::class, 'index'])->name('admin.peminjaman.index');
            Route::get('/tambah', [App\Http\Controllers\Admin\PeminjamanController::class, 'tambah'])->name('admin.peminjaman.tambah');
            Route::post('/store', [App\Http\Controllers\Admin\PeminjamanController::class, 'store'])->name('admin.peminjaman.store');

            Route::get('/edit/{id_peminjaman}', [App\Http\Controllers\Admin\PeminjamanController::class, 'edit'])->name('admin.peminjaman.edit');
            Route::post('/update/{id_peminjaman}', [App\Http\Controllers\Admin\PeminjamanController::class, 'update'])->name('admin.peminjaman.update');
            Route::get('/hapus/{id_peminjaman}', [App\Http\Controllers\Admin\PeminjamanController::class, 'hapus'])->name('admin.peminjaman.hapus');
            Route::put('/kembalikan/{id_peminjaman}', [App\Http\Controllers\Admin\PeminjamanController::class, 'kembalikan'])->name('admin.peminjaman.kembalikan');
            Route::put('/cekTerlambat/{id_peminjaman}', [App\Http\Controllers\Admin\PeminjamanController::class, 'cekTerlambat'])->name('admin.peminjaman.cekTerlambat');

            Route::post('/{id_peminjaman}/setuju', [App\Http\Controllers\Admin\PeminjamanController::class, 'setuju'])->name('admin.peminjaman.setuju');
            Route::put('/{id_peminjaman}/tolak', [App\Http\Controllers\Admin\PeminjamanController::class, 'tolak'])->name('admin.peminjaman.tolak');

            Route::get('/excel', [App\Http\Controllers\Admin\PeminjamanController::class, 'excel'])->name('admin.peminjaman.excel');
            Route::get('/pdf', [App\Http\Controllers\Admin\PeminjamanController::class, 'pdf'])->name('admin.peminjaman.pdf');
        });
    });
});


Route::group(['middleware' => 'auth:staff'], function () {
    Route::prefix('staff')->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff.dashboard.index');

        //peminjaman
        Route::get('/index', [App\Http\Controllers\Staff\PeminjamanController::class, 'index'])->name('staff.peminjaman.index');
        Route::get('/tambah', [App\Http\Controllers\Staff\PeminjamanController::class, 'tambah'])->name('staff.peminjaman.tambah');
        Route::post('/store', [App\Http\Controllers\Staff\PeminjamanController::class, 'store'])->name('staff.peminjaman.store');

        Route::get('/edit/{id_peminjaman}', [App\Http\Controllers\Staff\PeminjamanController::class, 'edit'])->name('staff.peminjaman.edit');
        Route::post('/update/{id_peminjaman}', [App\Http\Controllers\Staff\PeminjamanController::class, 'update'])->name('staff.peminjaman.update');
        Route::put('/kembalikan/{id_peminjaman}', [App\Http\Controllers\Staff\PeminjamanController::class, 'kembalikan'])->name('staff.peminjaman.kembalikan');
        Route::put('/cekTerlambat/{id_peminjaman}', [App\Http\Controllers\Staff\PeminjamanController::class, 'cekTerlambat'])->name('staff.peminjaman.cekTerlambat');

        Route::get('/excel', [App\Http\Controllers\Staff\PeminjamanController::class, 'excel'])->name('staff.peminjaman.excel');
        Route::get('/pdf', [App\Http\Controllers\Staff\PeminjamanController::class, 'pdf'])->name('staff.peminjaman.pdf');
    });

    //barang

    Route::prefix('barang')->group(function () {
        Route::get('/index', [App\Http\Controllers\Staff\BarangController::class, 'index'])->name('staff.barang.index');
    });
});



Route::group(['middleware' => 'auth:atasan'], function () {
    Route::prefix('atasan')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\Atasan\DashboardController::class, 'index'])->name('atasan.dashboard.index');


        // Instansi
        Route::prefix('instansi')->group(function () {
            Route::get('/index', [App\Http\Controllers\Atasan\InstansiController::class, 'index'])->name('atasan.instansi.index');
        });

        // Barang
        Route::prefix('barang')->group(function () {
            Route::get('/index', [App\Http\Controllers\Atasan\BarangController::class, 'index'])->name('atasan.barang.index');
        });

        // peminjaman
        Route::prefix('peminjaman')->group(function () {
            Route::get('/index', [App\Http\Controllers\Atasan\PeminjamanController::class, 'index'])->name('atasan.peminjaman.index');
        });
    });
});
