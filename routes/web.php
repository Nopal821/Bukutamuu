<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\TamuController;

Route::get('/', [TamuController::class, 'create']);
Route::post('/tamu', [TamuController::class, 'store'])->name('tamu.store');
Route::get('/daftar', [TamuController::class, 'index'])->name('daftar.index');
Route::get('/create', [TamuController::class, 'create'])->name('create');
Route::post('/tamu/store', [TamuController::class, 'store'])->name('tamu.store');
Route::get('/', [TamuController::class, 'index'])->name('index');

