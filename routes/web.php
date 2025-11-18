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

Route::middleware(['member'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logoutM');
    Route::get('/kelola/toko/{id}', [PageController::class, 'tokoM'])->name('tokoM');
    Route::post('/kelola/toko/update/{id}', [TokoController::class, 'tkUpdate'])->name('tokoUpdate');
    
    Route::post('/kelola/toko/tambahproduk', [ProdukController::class, 'store'])->name('ProdukStore');
    Route::post('/kelola/toko/produk/updatestok/{id}', [ProdukController::class, 'updateStock'])->name('produk.updateStock');
    Route::get('/back', [PageController::class, 'back'])->name('back');
});
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
    Route::get('/logout/admin', [UserController::class, 'logout'])->name('logoutA');
    Route::get('/admin/kategori', [PageController::class, 'kategori'])->name('kategori');
    Route::post('/admin/kategori', [KategoriController::class, 'index'])->name('katStore');
    Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
});
