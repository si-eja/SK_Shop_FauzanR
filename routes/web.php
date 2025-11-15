<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [PageController::class, 'login']);

Route::get('/', [PageController::class, 'index']);
Route::get('/admin', [PageController::class, 'admin']);