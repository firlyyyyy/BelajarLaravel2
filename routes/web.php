<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\PinjamController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

// route data buku
Route::get('/buku', 'BukuController@bukutampil');
Route::post('/buku/tambah', 'BukuController@bukutambah');
Route::get('/buku/hapus/{id_buku}', 'BukuController@bukuhapus');
Route::put('/buku/edit/{id_buku}', 'BukuController@bukuedit');

Route::get('/buku', function () {
    return view('view_home');
});

// route data anggota
Route::get('/anggota', [AnggotaController::class, 'anggotatampil']);
// Route::get('/anggota', 'AnggotaController@anggotatampil');

// route data petugas
// Route::get('/petugas', 'PetugasController@petugastampil');
Route::get('/petugas', [PetugasController::class, 'petugastampil']);

// route data peminjam
// Route::get('/pinjam', 'PinjamController@peminjamtampil');
Route::get('/pinjam', [PinjamController::class,  'pinjamtampil']);
