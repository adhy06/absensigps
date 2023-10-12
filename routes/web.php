<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PerencanaanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProgresController;
use App\Models\Barang;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
     return view('home.index');
});

Route::get('/informasi', [HomeController::class, 'informasi']);
Route::get('/produk', [HomeController::class, 'produk']);
Route::get('/mangga', [HomeController::class, 'mangga']);
Route::get('/anggur', [HomeController::class, 'anggur']);
Route::get('/apel', [HomeController::class, 'apel']);
Route::get('/durian', [HomeController::class, 'durian']);
Route::get('/langganan', [HomeController::class, 'langganan']);
Route::get('/kontak', [HomeController::class, 'kontak']);
Route::post('/home/storepelanggan', [HomeController::class, 'storepelanggan']);

// ROT APLIKASI ABSEN
Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/panelkaryawan', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth:karyawan'])->group(function () {
    Route::get('/panelkaryawan/dashboard', [DashboardController::class, 'index']);
    Route::get('/panelkaryawan/proseslogout', [AuthController::class, 'proseslogout']);

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

     // Progres
    Route::get('/progres', [ProgresController::class, 'index']);
    Route::get('/progres/pasangbaru', [ProgresController::class, 'pasangbaru']);
    // Route::post('/departement/edit', [DepartementController::class, 'edit']);
    // Route::post('/departement/{nik}/update', [DepartementController::class, 'update']);
    // Route::post('/departement/{nik}/delete', [DepartementController::class, 'delete']);

     // Perencanaan
     Route::get('/perencanaan', [PerencanaanController::class, 'index']);
     Route::post('/perencanaan/store', [PerencanaanController::class, 'store']);
    //  Route::post('/karyawan/edit', [KaryawanController::class, 'edit']);
    //  Route::post('/karyawan/{nik}/update', [KaryawanController::class, 'update']);
    //  Route::post('/karyawan/{nik}/delete', [KaryawanController::class, 'delete']); 

    // Barang
    Route::get('/barang', [BarangController::class, 'index']);
    // Route::post('/barang', [BarangController::class, 'store']);
    // Route::post('/departement/edit', [DepartementController::class, 'edit']);
    // Route::post('/departement/{nik}/update', [DepartementController::class, 'update']);
    // Route::post('/departement/{nik}/delete', [DepartementController::class, 'delete']);

        // Pelanggan
        Route::get('/pelanggan', [PelangganController::class, 'index']);
        Route::post('/pelanggan/store', [PelangganController::class, 'store']);
        Route::get('/pelanggan/persetujuan', [PelangganController::class, 'persetujuan']);
        Route::post('/pelanggan/approvependaftaran', [PelangganController::class, 'approvependaftaran']);
        Route::get('/pelanggan/{nik_ktp}/batalkan', [PelangganController::class, 'batalkan']);
        Route::post('/pelanggan/edit', [PelangganController::class, 'edit']);
        Route::post('/pelanggan/{nik_ktp}/update', [PelangganController::class, 'update']);
        Route::post('/pelanggan/{nik_ktp}/delete', [PelangganController::class, 'delete']);
        Route::post('/pelanggan/dashbiardpelanggan', [PelangganController::class, 'dashbiardpelanggan']);
     
     
});

// END ROT PANEL ADMIN

// ROT PANEL PELANGGAN

Route::middleware(['guest:pelanggan'])->group(function(){
    Route::get('/panelpelanggan', function () {
        return view('auth.loginpelanggan');
    })->name('loginpelanggan');
    Route::post('/prosesloginpelanggan', [AuthController::class, 'prosesloginpelanggan']);
});

Route::middleware(['auth:pelanggan'])->group(function () {
    Route::get('/panelpelanggan/dashboardpelanggan', [DashboardController::class, 'dashboardpelanggan']);
    Route::get('/panelpelanggan/proseslogoutpelanggan', [AuthController::class, 'proseslogoutpelanggan']);

    //edit profile
    Route::get('/pelanggan/editprofile', [PelangganController::class, 'editprofile']);
    Route::post('/pelanggan/{nik_ktp}/updateprofile', [PelangganController::class, 'updateprofile']);
});