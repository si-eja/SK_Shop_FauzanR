<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [PageController::class, 'login'])->name('login');
Route::post('/login/auth', [UserController::class, 'authLogin'])->name('authLogin');
Route::get('/regis', [PageController::class, 'regis']);
Route::post('/regis/post', [UserController::class, 'regPost'])->name('regPost');

Route::get('/', [PageController::class, 'index'])->name('home');
Route::middleware(['member'])->group(function () {

});
Route::middleware(['admin'])->group(function () {
    Route::get('/admin', [PageController::class, 'admin'])->name('admin');
});
