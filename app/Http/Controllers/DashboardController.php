<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\If_;

class DashboardController extends Controller
{
    public function index(){
        $hariini    = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = Auth::guard('karyawan')->user()->nama_lengkap;
        $absensihariini = DB::table('absensi')->where('nik', $nik)->where('tgl_absensi', $hariini)->first();
        $historibulanini = DB::table('absensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_absensi)="'.$bulanini.'" ')
        ->whereRaw('YEAR(tgl_absensi)="'.$tahunini.'"')
        ->orderBy('tgl_absensi')
        ->get();

        
        $rekapabsensi = DB::table('absensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_masuk > "08:00",1,0)) as jmltelat')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_absensi)="'.$bulanini.'" ')
        ->whereRaw('YEAR(tgl_absensi)="'.$tahunini.'"')
        ->first();
        // dd($rekapabsensi);

        $leaderboard = DB::table('absensi')
        ->join('karyawan', 'absensi.nik', '=', 'karyawan.nik')
        ->where('tgl_absensi', $hariini)
        ->orderBy('jam_masuk')
        ->get();
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_izin)="'.$bulanini.'" ')
        ->whereRaw('YEAR(tgl_izin)="'.$tahunini.'"')
        ->where('status_approved', 1)
        ->first();
        return view('dashboard.dashboardkaryawan', compact('absensihariini','historibulanini', 'namabulan', 'bulanini', 'tahunini', 'rekapabsensi', 'leaderboard', 'rekapizin'));
    }

    public function dashboardadmin()
    {
        $hariini    = date("Y-m-d");
        $rekapabsensi = DB::table('absensi')
        ->selectRaw('COUNT(nik) as jmlhadir, SUM(IF(jam_masuk > "08:00",1,0)) as jmltelat')
        ->where('tgl_absensi', $hariini)
        ->first();
        // dd($rekapabsensi);

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit')
        ->where('tgl_izin', $hariini)
        ->where('status_approved', 1)
        ->first();

        $rekapkaryawan = DB::table('karyawan')
        ->selectRaw('COUNT(nik) as jmlkaryawan')
        ->first();


        return view('dashboard.dashboardadmin', compact('rekapabsensi','rekapizin','rekapkaryawan'));
    }

    public function dashboardpelanggan()
    {
        $hariini    = date("Y-m-d");
        $bulanini = date("m") * 1;
        $tahunini = date("Y");
        $nik_ktp = Auth::guard('pelanggan')->user()->nik_ktp;
        $nama_pendaftar = Auth::guard('pelanggan')->user()->nama_pendaftar;
        $pembayaranbulanini = DB::table('tagihan')
        ->where('nik_ktp', $nik_ktp)
        ->whereRaw('MONTH(tgl_tagihan)="'.$bulanini.'" ')
        ->whereRaw('YEAR(tgl_tagihan)="'.$tahunini.'"')
        ->orderBy('tgl_tagihan')
        ->get();

        $tagihan = DB::table('tagihan')
        ->join('pelanggan', 'tagihan.nik_ktp', '=', 'pelanggan.nik_ktp')
        ->join('produk', 'tagihan.kode_produk', '=', 'produk.kode_produk')
        ->where('tgl_tagihan')
        ->orderBy('tgl_tagihan')
        ->get();

        // $query = Pelanggan::query();
        // $query->select('pelanggan.*','nama_produk');
        // $query->join('produk','pelanggan.kode_produk','=','produk.kode_produk');
        // $query->orderBy('nama_produk');

        $produk = DB::table('produk')->get();

        $pelanggan = DB::table('pelanggan')
        ->join('produk','pelanggan.kode_produk','=','produk.kode_produk')
        ->where('nik_ktp', $nik_ktp)->first();

        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];

        return view('dashboard.dashboardpelanggan', compact('pelanggan','produk','pembayaranbulanini','tagihan', 'namabulan', 'bulanini', 'tahunini'));
    }

}
