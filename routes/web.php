<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbsensiController;

Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'index']);

Route::get('/absensi',[AbsensiController::class,'absensi']);
Route::get('/tambah-absensi',[AbsensiController::class,'tambah_absensi']);
Route::get('/cek-jam',[AbsensiController::class,'cek_jam']);
Route::get('/riwayat-absensi',[AbsensiController::class,'riwayat_absensi']);
Route::get('/izin',[AbsensiController::class,'izin']);
Route::get('/riwayat-ketidakhadiran',[AbsensiController::class,'riwayat_ketidakhadiran']);
Route::post('/tambah-izin',[AbsensiController::class,'tambah_izin']);
Route::get('/profil',[UserController::class,'data_profil']);
Route::get('/edit-profil{id}',[UserController::class,'edit_profil']);
Route::get('/lengkapi-profil{id}',[UserController::class,'lengkapi_profil']);
Route::post('/update-lengkap-profil{id}',[UserController::class,'update_lengkap_profil']);
Route::post('/update-profil{id}',[UserController::class,'update_profil']);
Route::get('/tatib',[HomeController::class,'tatib']);

Route::group(['middleware' => 'manajer' ],function(){
    Route::get('/absensi-pegawai-today',[AbsensiController::class,'absensi_pegawai_today']);
    Route::get('/izin-pegawai',[AbsensiController::class,'izin_pegawai']);
    Route::get('/detail-izin{id}',[HomeController::class,'detail_izin']);
    Route::get('/approve-izin{id}',[HomeController::class,'approve_izin']);
    Route::get('/tolak-izin{id}',[HomeController::class,'tolak_izin']);
    Route::get('/histori-absensi-pegawai',[AbsensiController::class,'histori_absensi_pegawai']);
    // Route::post('/laporan-absensi{id}',[UserController::class,'tambah']);
    // Route::post('/laporan-ketidakhadiran',[UserController::class,'tambah']);
    // Route::post('/laporan-ketidakhadiran{id}',[UserController::class,'tambah']);
    // Route::post('/daftar-pengajuan-cuti',[UserController::class,'tambah']);
    // Route::post('/terima-cuti',[UserController::class,'tambah']);
    // Route::post('/tolak-cuti',[UserController::class,'tambah']);
});

Route::group(['middleware' => 'hrd' ],function(){
    Route::post('/laporan-absensi',[UserController::class,'tambah']);
    Route::post('/laporan-absensi{id}',[UserController::class,'tambah']);
    Route::post('/laporan-ketidakhadiran',[UserController::class,'tambah']);
    Route::post('/laporan-ketidakhadiran{id}',[UserController::class,'tambah']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
