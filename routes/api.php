<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('mahasiswa', [MahasiswaController::class, 'index']);
Route::get('mahasiswa/{nim}', [MahasiswaController::class, 'tampil']);
Route::post('mahasiswa/tambah', [MahasiswaController::class, 'tambah']);
Route::put('mahasiswa/edit/{nim}', [MahasiswaController::class, 'edit']);
Route::delete('mahasiswa/hapus/{nim}', [MahasiswaController::class, 'hapus']);