<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Perencanaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PerencanaanController extends Controller
{


    public function index(Request $request){
        $judul_perencanaan = $request->judul_perencanaan;
        $query = Perencanaan::query();
        $query->select('*');
        if (!empty($judul_perencanaan)) {
            $query->where('judul_perencanaan','like','%'.$request->judul_perencanaan.'%');
        }
        $perencanaan = $query->get();
        $perencanaan = $query->paginate(5);  

        return view('perencanaan.index', compact('perencanaan'));

        
    }
    
    // public function index(Request $request)
    // {
    //     $query = Perencanaan::query();
    //     $query->select('perencanaan');
    //     // $query->join('departement','karyawan.kode_dept','=','departement.kode_dept');
    //     $query->orderBy('kode_perencanaan', 'desc');
    //     $query->where('judul_perencanaan','like','%'.$request->judul_perencanaan.'%');

    //     $perencanaan = $query->paginate(5);  

    //     return view('perencanaan.index', compact('perencanaan'));
    // }

    public function store(Request $request){
        $kode_perencanaan            = $request->kode_perencanaan;
        $judul_perencanaan   = $request->judul_perencanaan;
        $tgl_perencanaan        = $request->tgl_perencanaan;
        $isi_perencanaan          = $request->isi_perencanaan;
        if ($request->hasFile('foto')) {
            $foto = $kode_perencanaan.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }
        try {
            $data = [
                'kode_perencanaan'      => $kode_perencanaan,
                'judul_perencanaan'     => $judul_perencanaan,
                'tgl_perencanaan'       => $tgl_perencanaan,
                'isi_perencanaan'       => $isi_perencanaan,
                'foto'                  => $foto

            ];
            $simpan = DB::table('perencanaan')->insert($data);
            if($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/perencanaan/";
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
