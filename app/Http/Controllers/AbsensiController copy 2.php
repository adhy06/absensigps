<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function create(){
        $hariini    = date("Y-m-d");
        $nik        = Auth::guard('karyawan')->user()->nik;
        $cek        = DB::table('absensi')->where('tgl_absensi', $hariini)->where('nik', $nik)->count();
        return view('absensi.create', compact('cek'));
    }

    public function store(Request $request){
        // $nik = Auth::guard('karyawan')->user()->nik;
        // $tgl_absensi = date("Y-m-d");
        // $jam = date("H:i:s");
        // $lokasi = $request->lokasi;
        // $image = $request->image;
        // $folderPath = "public/uploads/presensi/";
        // $formatName = $nik . "-" . $tgl_absensi;
        // $image_parts = explode(";base64", $image);
        // $image_base64 = base64_decode($image_parts[1]);
        // $fileName = $formatName . ".png";
        // $file = $folderPath . $fileName;


        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_absensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lokasi = $request->lokasi;
        $image = $request->image;

        $folderPathMasuk= "public/uploads/presensi/masuk/";
        $folderPathPulang = "public/uploads/presensi/pulang/";

        $formatName = $nik . "-" . $tgl_absensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $fileMasuk = $folderPathMasuk . $fileName;
        $filePulang = $folderPathPulang . $fileName;
        
        $cek = DB::table('absensi')->where('tgl_absensi', $tgl_absensi)->where('nik', $nik)->count();
        if($cek > 0) {
            $data_pulang = [
                'jam_pulang'     => $jam,
                'foto_pulang'    => $fileName,
                'lokasi_pulang'  => $lokasi
            ];
            $update = DB::table('absensi')->where('tgl_absensi', $tgl_absensi)->where('nik', $nik)->update($data_pulang);
            if ($update) {
                echo "success|Terimakasih Hati hati Di Jalan|out";
                Storage::put($filePulang, $image_base64);
            } else {
                echo "error|Maaf Gagal Absen Silahkan Hubungi Admin|out";
            }
        } else {
            $data_masuk = [
                'nik'           => $nik,
                'tgl_absensi'   => $tgl_absensi,
                'jam_masuk'     => $jam,
                'foto_masuk'    => $fileName,
                'lokasi_masuk'  => $lokasi
            ];
            $simpan = DB::table('absensi')->insert($data_masuk);
            if ($simpan) {
                echo "success|Terimakasih, Selamat Bekerja|in";
                Storage::put($fileMasuk, $image_base64);
            } else {
                echo "error|Maaf Gagal Absen Silahkan Hubungi Admin|out";
            }
        }    
    }


}
