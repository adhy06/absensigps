<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
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
// ROT APLIKASI ABSEN
Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //Absensi
    Route::get('/absensi/create', [AbsensiController::class, 'create']);
    Route::post('/absensi/store', [AbsensiController::class, 'store']);

    //edit profile
    Route::get('/editprofile', [AbsensiController::class, 'editprofile']);
    Route::post('/absensi/{nik}/updateprofile', [AbsensiController::class, 'updateprofile']);

    //Histori
    Route::get('/absensi/histori', [AbsensiController::class, 'histori']);
    Route::post('/gethistori', [AbsensiController::class, 'gethistori']);

     //izin
     Route::get('/absensi/izin', [AbsensiController::class, 'izin']);
     Route::get('/absensi/buatizin', [AbsensiController::class, 'buatizin']);
     Route::post('/absensi/storeizin', [AbsensiController::class, 'storeizin']);


});
// END ROT APLIKASI ABSEN


// ROT PANEL ADMIN

Route::middleware(['guest:user'])->group(function(){
    Route::get('/panel', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});

Route::middleware(['auth:user'])->group(function () {
    Route::get('/panel/dashboardadmin', [DashboardController::class, 'dashboardadmin']);
    Route::get('/panel/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);

    // Karyawan
    Route::get('/karyawan', [KaryawanController::class, 'index']);
    Route::post('/karyawan/store', [KaryawanController::class, 'store']);
    Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']);

    // Departement
    Route::get('/departement', [DepartementController::class, 'index']);
    Route::post('/departement/store', [DepartementController::class, 'store']);
    Route::post('/departement/edit', [DepartementController::class, 'edit']);
    Route::post('/departement/{nik}/update', [DepartementController::class, 'update']);
    Route::post('/departement/{nik}/delete', [DepartementController::class, 'delete']);

    // Absensi Monitoring
    Route::get('/absensi/monitoring', [AbsensiController::class, 'monitoring']);
    Route::post('/getabsensi', [AbsensiController::class, 'getabsensi']);
    Route::post('/tampilkanpeta', [AbsensiController::class, 'tampilkanpeta']);
    Route::get('/absensi/laporan', [AbsensiController::class, 'laporan']);
    Route::get('/absensi/rekapabsensi', [AbsensiController::class, 'rekapabsensi']);
    Route::post('/absensi/cetaklaporan', [AbsensiController::class, 'cetaklaporan']);
    Route::get('/absensi/rekap', [AbsensiController::class, 'rekap']);
    Route::post('/absensi/cetakrekap', [AbsensiController::class, 'cetakrekap']);
    Route::get('/absensi/izinsakit', [AbsensiController::class, 'izinsakit']);
    Route::post('/absensi/approveizinskit', [AbsensiController::class, 'approveizinskit']);
    Route::get('/absensi/{id}/batalkanizinsakit', [AbsensiController::class, 'batalkanizinsakit']);

    // Konfigurasi
     // Absensi Monitoring
     Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
     Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);
     
     
});

// END ROT PANEL ADMIN
