<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login/auth', [UserController::class, 'authLogin'])->name('authLogin');
Route::get('/regis', [PageController::class, 'regis']);
Route::post('/regis/post', [UserController::class, 'regPost'])->name('regPost');

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/back', [PageController::class, 'back'])->name('back');

Route::get('/kunjungi/toko/{id}', [PageController::class, 'ktoko'])->name('TokoK');

Route::get('/produk/{id}/wa', [ProdukController::class, 'kirimWA'])->name('produk.wa');

Route::middleware(['member'])->group(function () {
    //logout member
    Route::get('/logout', [UserController::class, 'logout'])->name('logoutM');

    //akses toko member
    Route::get('/kelola/toko/{id}', [PageController::class, 'tokoM'])->name('tokoM');
    //update toko member
    Route::post('/kelola/toko/update/{id}', [TokoController::class, 'tkUpdate'])->name('tokoUpdate');
    
    //produk
    Route::post('/kelola/toko/tambah/produk', [ProdukController::class, 'store'])->name('ProdukStore');
    //update stok produk
    Route::post('/kelola/toko/produk/updatestok/{id}', [ProdukController::class, 'updateStock'])->name('produk.updateStock');
    //edit produk
    Route::put('/kelola/toko/produk/update/{id}', [ProdukController::class, 'update'])->name('ProdukUpdate');
    //hapus produk
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('ProdukDestroy');

});
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
    Route::get('/logout/admin', [UserController::class, 'logout'])->name('logoutA');

    // akses toko admin
    Route::get('/admin/toko/', [PageController::class, 'tokoA'])->name('tokoA');
    Route::post('/admin/toko/{id}/status', [TokoController::class, 'changeStatus'])->name('TokoStatus');

    // akses kategori admin
    Route::get('/admin/kategori', [PageController::class, 'kategori'])->name('kategori');
    Route::post('/admin/kategori', [KategoriController::class, 'index'])->name('katStore');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('KategoriDestroy');
});
