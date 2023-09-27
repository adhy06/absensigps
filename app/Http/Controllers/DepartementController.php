<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class DepartementController extends Controller
{
    public function index(Request $request){
        $nama_dept = $request->nama_dept;
        $query = Departement::query();
        $query->select('*');
        if (!empty($nama_dept)) {
            $query->where('nama_dept','like','%'.$request->nama_dept.'%');
        }
        $departement = $query->get();

        return view('departement.index', compact('departement'));

        
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
            return redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }

    }

    public function edit(Request $request){
        $kode_dept = $request->kode_dept;
        $departement = DB::table('departement')->where('kode_dept', $kode_dept)->first();
        return view('departement.edit', compact('departement'));
    }

    public function update($kode_dept, Request $request){
        $kode_dept      = $request->kode_dept;
        $nama_dept      = $request->nama_dept;
        $data = [
                'kode_dept'       => $kode_dept,
                'nama_dept'       => $nama_dept,
            ];
            $update = DB::table('departement')->where('kode_dept', $kode_dept)->update($data);
            if($update){
                return redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } else {
            return redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($kode_dept) {
        $delete = DB::table('departement')->where('kode_dept', $kode_dept)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }

    
}
