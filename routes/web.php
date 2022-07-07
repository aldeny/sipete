<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SawController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Validasi Login & Logout */

Route::post('validasi/login', [UserController::class, 'login'])->name('loginUser');
Route::post('logout', [UserController::class, 'logout'])->name('logoutUser');
/* End */

Route::group(['middleware' => 'UserCheckSession'], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => 'UserSession'], function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('beranda');

    /* User Controller */
    Route::get('user', [UserController::class, 'index'])->name('data_user');
    Route::get('user/create', [UserController::class, 'create'])->name('tambah_user');
    Route::post('user/store', [UserController::class, 'store'])->name('simpan_user');
    Route::get('user/edit/{id}', [UserController::class, 'edit']);
    Route::post('user/update', [UserController::class, 'update'])->name('user_update');
    Route::post('user/delete/{id}', [UserController::class, 'destroy']);
    /* End */

    /* Kriteria Controller*/
    Route::get('kriteria', [KriteriaController::class, 'index'])->name('data_kriteria');
    Route::get('kriteria/create', [KriteriaController::class, 'create'])->name('tambah_kriteria');
    Route::post('kriteria/store', [KriteriaController::class, 'store'])->name('simpan_kriteria');
    Route::get('kriteria/edit/{id}', [KriteriaController::class, 'edit']);
    Route::post('kriteria/update', [KriteriaController::class, 'update'])->name('update_kriteria');
    Route::post('kriteria/delete/{id}', [KriteriaController::class, 'destroy']);
    /* End */

    /* Pegawai Controller */
    Route::get('pegawai', [PegawaiController::class, 'index'])->name('data_pegawai');
    Route::get('pegawai/create', [PegawaiController::class, 'create'])->name('tambah_pegawai');
    Route::post('pegawai/store', [PegawaiController::class, 'store'])->name('simpan_pegawai');
    Route::get('pegawai/edit/{id}', [PegawaiController::class, 'edit']);
    Route::post('pegawai/update', [PegawaiController::class, 'update'])->name('update_pegawai');
    Route::post('pegawai/delete/{id}', [PegawaiController::class, 'destroy']);
    /* End */

    /* Penilaian Controller */
    Route::get('penilaian', [PenilaianController::class, 'index'])->name('data_penilaian');
    Route::get('penilaian/create/{id}', [PenilaianController::class, 'create']);
    Route::post('penilaian/store', [PenilaianController::class, 'store'])->name('simpan_penilaian');
    Route::get('penilaian/edit/{id}/{id_saw}', [PenilaianController::class, 'edit']);
    Route::post('penilaian/update', [PenilaianController::class, 'update'])->name('update_penilaian');
    Route::post('penilaian/delete/{id}/{id_saw}', [PenilaianController::class, 'destroy']);
    /* End */

    /* Saw */
    Route::get('saw', [SawController::class, 'index'])->name('data_saw');
    Route::get('saw/print/{id}', [SawController::class, 'printsaw_id']);
    /* End */

    /* Pengajuan */
    Route::get('pengajuan', [PengajuanController::class, 'index'])->name('data_pengajuan');
    Route::post('pengajuan/store', [PengajuanController::class, 'store'])->name('tambah_pengajuan');
    Route::get('pengajuan/berkas/{id}', [PengajuanController::class, 'syarat']);
    Route::post('pengajuan/upload', [PengajuanController::class, 'uploadBerkas'])->name('upload_berkas');
    Route::get('pengajuan/print/{id}', [PengajuanController::class, 'printHasil']);
    //akses admin
    Route::get('cek', [PengajuanController::class, 'adminPengajuan'])->name('pengajuanAll');
    Route::get('cek/{id}/admin', [PengajuanController::class, 'cekberkas']);
    /* End */

    /* Profil */
    Route::get('profil/{user:username}', [AdminController::class, 'getProfil']);
    Route::post('profil/update', [AdminController::class, 'updateProfil'])->name('updateProfil');
    /* End */
});
