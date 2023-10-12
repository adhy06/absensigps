<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pelanggan;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function informasi()
    {
        return view('home.informasi');
    }

    public function produk()
    {
        return view('home.produk');
    }

    public function langganan(Request $request)
    {
        $query = Pelanggan::query();
        $query->select('pelanggan.*','nama_produk');
        $query->join('produk','pelanggan.kode_produk','=','produk.kode_produk');
        $query->orderBy('nama_pelanggan');
        if (!empty($request->nama_pelanggan)) {
            $query->where('nama_pelanggan','like','%'.$request->nama_pelanggan.'%');
        }
        
        if (!empty($request->kode_produk)) {
            $query->where('pelanggan.kode_produk', $request->kode_produk);
        }

        $pelanggan = $query->paginate(5);  
        
        // $karyawan = DB::table('karyawan')->orderBy('nik')
        // ->join('departement','karyawan.kode_dept','=','departement.kode_dept')
        // ->paginate(10);

        $produk = DB::table('produk')->get();
        return view('home.langganan', compact('pelanggan','produk'));
    }

    public function kontak()
    {
        return view('home.kontak');
    }

// Produk Function

    public function mangga()
    {
        return view('/home/produks.mangga');
    }

    public function anggur()
    {
        return view('/home/produks.anggur');
    }

    public function apel()
    {
        return view('/home/produks.apel');
    }

    public function durian()
    {
        return view('/home/produks.durian');
    }

    public function storepelanggan(Request $request){
        $nik_ktp            = $request->nik_ktp;
        $nama_pelanggan       = $request->nama_pelanggan;
        $no_hp              = $request->no_hp;
        $lokasi             = $request->lokasi;
        $kode_produk        = $request->kode_produk;
        $password           = Hash::make('12345');
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
                'nama_pelanggan'  => $nama_pelanggan,
                'no_hp'         => $no_hp,
                'lokasi'        => $lokasi,
                'kode_produk'   => $kode_produk,
                'foto_ktp'      => $foto_ktp,
                'password'      => $password,
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
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }
}
