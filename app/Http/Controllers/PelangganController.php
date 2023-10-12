<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Return_;

class PelangganController extends Controller
{
    public function index(Request $request)
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

        if($request->status_approve === '0' || $request->status_approve === '1' || $request->status_approve === '2'){
            $query->where('status_approve', $request->status_approve);
           }
        $produk = DB::table('produk')->get();
        return view('pelanggan.index', compact('pelanggan','produk'));
    }

    public function store(Request $request){
        $nik_ktp            = $request->nik_ktp;
        $nama_pelanggan       = $request->nama_pelanggan;
        $no_hp              = $request->no_hp;
        $tgl_daftar         = $request->tgl_daftar;
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
                'nama_pelanggan'          => $nama_pelanggan,
                'no_hp'         => $no_hp,
                'tgl_daftar'         => $tgl_daftar,
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
                return redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }

    public function persetujuan(Request $request)
    {
        $query = Pelanggan::query();
        $query->select('nik_ktp','nama_pelanggan','no_hp','tgl_daftar','lokasi','foto_ktp','kode_produk','status_approved','password','foto');
        $query->select('pelanggan.*','nama_produk');
        $query->join('produk','pelanggan.kode_produk','=','produk.kode_produk');
        $query->orderBy('nama_pelanggan');
        if(!empty($request->dari) && !empty($request->sampai)){
            $query->whereBetween('tgl_daftar',[$request->dari,$request->sampai]);
        }
        if (!empty($request->nama_pelanggan)) {
            $query->where('nama_pelanggan','like','%'.$request->nama_pelanggan.'%');
        }

        if(!empty($request->nik_ktp)){
            $query->where('nik_ktp',$request->nik_ktp);
           }
        
        if (!empty($request->kode_produk)) {
            $query->where('pelanggan.kode_produk', $request->kode_produk);
        }

        $pelanggan = $query->paginate(5);  

        if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2' || $request->status_approved === '3'){
            $query->where('status_approved', $request->status_approved);
           }
        
        $produk = DB::table('produk')->get();
        return view('pelanggan.persetujuan', compact('pelanggan','produk'));
    }


    public function approvependaftaran(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_persetujuan_form = $request->id_persetujuan_form;
        $update = DB::table('pelanggan')->where('nik_ktp',$id_persetujuan_form)->update([
            'status_approved' => $status_approved
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['error'=>'Data Gagal Disimpan']);
        }
        return view('pelanggan.persetujuan', compact('pelanggan','produk'));
    }

    public function batalkan($nik_ktp)
    {
        // $status_approved = $request->status_approved;
        // $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pelanggan')->where('nik_ktp',$nik_ktp)->update([
            'status_approved' => 0
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['error'=>'Data Gagal Disimpan']);
        }
        return view('pelanggan.persetujuan', compact('pelanggan','produk'));
    }


    public function edit(Request $request){
        $nik_ktp = $request->nik_ktp;
        $produk = DB::table('produk')->get();
        $pelanggan = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->first();
        return view('pelanggan.edit', compact('produk','pelanggan'));
    }

    public function update($nik_ktp, Request $request){
        $nik_ktp            = $request->nik_ktp;
        $nama_pelanggan       = $request->nama_pelanggan;
        $no_hp              = $request->no_hp;
        $tgl_daftar          = $request->tgl_daftar;
        $lokasi             = $request->lokasi;
        $kode_produk        = $request->kode_produk;
        $password           = Hash::make('12345');
        $old_foto_ktp        = $request->old_foto_ktp;
        $old_foto           = $request->old_foto;
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $nik_ktp."ktp".".".$request->file('foto_ktp')->getClientOriginalExtension();
        } else {
            $foto_ktp = $old_foto_ktp;
        } 
        if ($request->hasFile('foto')) {
            $foto = $nik_ktp."profil".".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }
        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_pelanggan'  => $nama_pelanggan,
                'no_hp'         => $no_hp,
                'tgl_daftar'    => $tgl_daftar,
                'lokasi'        => $lokasi,
                'kode_produk'   => $kode_produk,
                'foto_ktp'      => $foto_ktp,
                'password'      => $password,
                'foto'          => $foto
            ];
            $update = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->update($data);
            if($update){
                if($request->hasFile('foto_ktp')){
                    $folderPath = "public/uploads/pelanggan";
                    $folderPathOld  = "public/uploads/pelanggan/".$old_foto_ktp;
                    Storage::delete($folderPathOld);
                    $request->file('foto_ktp')->storeAs($folderPath, $foto_ktp);
                }
                
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/pelanggan";
                    $folderPathOld  = "public/uploads/pelanggan/".$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            return redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($nik_ktp) {
        $delete = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    public function editprofile()
    {
        $nik_ktp = Auth::guard('pelanggan')->user()->nik_ktp;
        $pelanggan = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->first();
        return view('pelanggan.editprofile',compact('pelanggan'));
    }

    public function updateprofile(Request $request)
    {
        $nik_ktp = Auth::guard('pelanggan')->user()->nik_ktp;
        $nama_pelanggan = $request->nama_pelanggan;
        $pelanggan = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->first();
        $nik_ktp            = $request->nik_ktp;
        $nama_pelanggan       = $request->nama_pelanggan;
        $no_hp              = $request->no_hp;
        $tgl_daftar          = $request->tgl_daftar;
        $lokasi             = $request->lokasi;
        $kode_produk        = $request->kode_produk;
        $password           = Hash::make($request->password);
        $old_foto_ktp        = $request->old_foto_ktp;
        $old_foto           = $request->old_foto;
        if ($request->hasFile('foto_ktp')) {
            $foto_ktp = $nik_ktp."ktp".".".$request->file('foto_ktp')->getClientOriginalExtension();
        } else {
            $foto_ktp = $old_foto_ktp;
        } 
        if ($request->hasFile('foto')) {
            $foto = $nik_ktp."profil".".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }
        try {
            $data = [
                'nik_ktp'       => $nik_ktp,
                'nama_pelanggan'  => $nama_pelanggan,
                'no_hp'         => $no_hp,
                'lokasi'        => $lokasi,
                'foto_ktp'      => $foto_ktp,
                'password'      => $password,
                'foto'          => $foto
            ];
            $update = DB::table('pelanggan')->where('nik_ktp', $nik_ktp)->update($data);
            if($update){
                if($request->hasFile('foto_ktp')){
                    $folderPath = "public/uploads/pelanggan";
                    $folderPathOld  = "public/uploads/pelanggan/".$old_foto_ktp;
                    Storage::delete($folderPathOld);
                    $request->file('foto_ktp')->storeAs($folderPath, $foto_ktp);
                }
                
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/pelanggan";
                    $folderPathOld  = "public/uploads/pelanggan/".$old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            return redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function dashboardpelanggan(Request $request)
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

        if($request->status_approve === '0' || $request->status_approve === '1' || $request->status_approve === '2'){
            $query->where('status_approve', $request->status_approve);
           }
        $produk = DB::table('produk')->get();
        return view('pelanggan.index', compact('pelanggan','produk'));
    }

}
