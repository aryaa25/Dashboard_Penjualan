<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aplikasi sederhana ini hanya memiliki satu halaman:
| dashboard penjualan yang terbuka tanpa login.
|
*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


