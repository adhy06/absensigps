<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Progres;
use App\Models\Pelanggan;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProgresController extends Controller
{
    public function index(Request $request){
        $judul_progres = $request->judul_progres;
        $query = Progres::query();
        $query->select('*');
        if (!empty($judul_progres)) {
            $query->where('judul_progres','like','%'.$request->judul_progres.'%');
        }
        $progres = $query->get();

        return view('/progres/perencanaan.index', compact('progres'));        
    }

    public function store(Request $request)
    {
        $kode_dept      = $request->kode_dept;
        $nama_dept      = $request->nama_dept;
        $data = [
                'kode_dept'  => $kode_dept,
                'nama_dept'  => $nama_dept
            ];
        $simpan = DB::table('departement')->insert($data);
        if($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }

    public function pasangbaru(Request $request)
    {
        $query = Pelanggan::query();
        $query->orderBy('nama_lengkap');
        if (!empty($request->nama_lengkap)) {
            $query->where('nama_lengkap','like','%'.$request->nama_lengkap.'%');
        }

        $pelanggan = $query->paginate(5);  
        
        if($request->status_approve === '0' || $request->status_approve === '1' || $request->status_approve === '2'){
            $query->where('status_approve', $request->status_approve);
           }

           $query = Karyawan::query();
        $produk = DB::table('produk')->get();
        $karyawan = DB::table('karyawan')->get();
        return view('progres.pasangbaru', compact('pelanggan','produk', 'karyawan'));
    }

    public function storepasangbaru(Request $request){
        $nik_ktp            = $request->nik_ktp;
        $nama_lengkap       = $request->nama_lengkap;
        $no_hp              = $request->no_hp;
        $tgl_daftar         = $request->tgl_daftar;
        $lokasi             = $request->lokasi;
        $kode_produk        = $request->kode_produk;
        // $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $nik_ktp."ktp".".".$request->file('foto_ktp')->getClientOriginalExtension();
        } else {
            $foto_ktp = null;
        } 
        
        if ($request->hasFile('foto')) {
            $foto = $nik_ktp."profil".".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_lengkap'          => $nama_lengkap,
                'no_hp'         => $no_hp,
                'tgl_daftar'         => $tgl_daftar,
                'lokasi'        => $lokasi,
                'kode_produk'   => $kode_produk,
                'foto_ktp'      => $foto_ktp,
                'foto'          => $foto
            ];
            $simpan = DB::table('pelanggan')->insert($data);
            if($simpan){
                if($request->hasFile('foto_ktp')){
                    $folderPath = "public/uploads/pelanggan";
                    $request->file('foto_ktp')->storeAs($folderPath, $foto_ktp);
                }
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/pelanggan";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }
}
