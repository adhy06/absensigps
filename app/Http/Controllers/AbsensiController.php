<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PHPUnit\Framework\MockObject\OriginalConstructorInvocationRequiredException;
use Symfony\Component\HttpFoundation\File\Exception\ExtensionFileException;

class AbsensiController extends Controller
{
    public function create(){
        $hariini    = date("Y-m-d");
        $nik        = Auth::guard('karyawan')->user()->nik;
        $cek        = DB::table('absensi')->where('tgl_absensi', $hariini)->where('nik', $nik)->count();
        $lok_kantor  = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view('absensi.create', compact('cek','lok_kantor'));
    }

    public function store(Request $request){
        $nik = Auth::guard('karyawan')->user()->nik;
        $tgl_absensi = date("Y-m-d");
        $jam = date("H:i:s");

        // script Lokasi Kantor
        $lok_kantor  = DB::table('konfigurasi_lokasi')->where('id',1)->first();
        $lok = explode(",",$lok_kantor->lokasi_kantor);
        $latitudekantor = $lok[0];
        $longitudkantor = $lok[1];
        // $latitudekantor = -7.5123401400230705;
        // $longitudkantor = 110.63880137513144;

        // script Lokasi user
        
        $lokasi = $request->lokasi;
        $lokasiuser = explode(",", $lokasi);
        $latitudeuser = $lokasiuser[0];
        $longituduser = $lokasiuser[1];
        $jarak = $this->distance($latitudekantor,$longitudkantor,$latitudeuser,$longituduser);
        $radius = round($jarak["meters"]);


        $cek = DB::table('absensi')->where('tgl_absensi', $tgl_absensi)->where('nik', $nik)->count();
        if($cek > 0){
            $ket = "keluar";
        } else {
            $ket = "masuk";
        }

        // script gambar foto
        $image = $request->image;
        $folderPath= "public/uploads/presensi/";
        $formatName = $nik . "-" . $tgl_absensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        
       
        if ($radius > $lok_kantor->radius) {
            echo "error|Maaf Anda Berada Di Luar Radius, Jarak Anda ". $radius ." Meter dari kantor|radius";
        } else {
            if($cek > 0) {
                $data_pulang = [
                    'jam_pulang'     => $jam,
                    'foto_pulang'    => $fileName,
                    'lokasi_pulang'  => $lokasi
                ];
                $update = DB::table('absensi')->where('tgl_absensi', $tgl_absensi)->where('nik', $nik)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih Hati hati Di Jalan|out";
                    Storage::put($file, $image_base64);
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
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal Absen Silahkan Hubungi Admin|out";
                }
            }
        }    
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }
  

    public function editprofile()
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        return view('absensi.editprofile',compact('karyawan'));
    }

    public function updateprofile(Request $request)
    {
        $nik = Auth::guard('karyawan')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $jabatan = $request->jabatan;
        $foto = $request->foto;
        $password = Hash::make($request->password);
        $karyawan = DB::table('karyawan')->where('nik', $nik)->first();
        if ($request->hasFile('foto')) {
            $foto = $nik.".".$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $karyawan->foto;
        }
        if (empty($request->password)) {
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'jabatan'       => $jabatan,
                'foto'         => $foto,
                'no_hp'         => $no_hp
                
            ];
        } else { 
            $data = [
                'nama_lengkap'  => $nama_lengkap,
                'jabatan'       => $jabatan,
                'no_hp'         => $no_hp,
                'foto'          => $foto,
                'password'      => $password
            ];
        }
        $update = DB::table('karyawan')->where('nik', $nik)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/karyawan/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil di Update']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal di Update']);
        }
        
    }

    public function histori()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];
        return view('absensi.histori',compact('namabulan'));   
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik = Auth::guard('karyawan')->user()->nik;

        $histori = DB::table('absensi')
        ->whereRaw('MONTH(tgl_absensi)="'.$bulan.'" ')
        ->whereRaw('YEAR(tgl_absensi)="'.$tahun.'"')
        ->where('nik', $nik)
        ->orderBy('tgl_absensi')
        ->get();

        return view('absensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nik        = Auth::guard('karyawan')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik',$nik)
        ->orderBy('tgl_izin', 'desc')
        ->get();

         return view('absensi.izin', compact('dataizin'));   
    }

    public function buatizin()
    {
        
         return view('absensi.buatizin');   
    }

    public function storeizin(Request $request)
    {
        $nik        = Auth::guard('karyawan')->user()->nik;
        $tgl_izin   = $request->tgl_izin;
        $status     = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nik'           => $nik,
            'tgl_izin'      => $tgl_izin,
            'status'        => $status,
            'keterangan'    => $keterangan,
            ];

        $simpan = DB::table('pengajuan_izin')->insert($data);
    
        if ($simpan) {
            return redirect('absensi/izin')->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return redirect('absensi/izin')->with(['error'=>'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {
        return view('absensi.monitoring');
    }
    
    public function getabsensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $absensi = DB::table('absensi')
        ->select('absensi.*','nama_lengkap','jabatan','nama_dept')
        ->join('karyawan','absensi.nik','=','karyawan.nik')
        ->join('departement','karyawan.kode_dept','=','departement.kode_dept')
        ->where('tgl_absensi', $tanggal)
        ->get();

        return view('absensi.getabsensi',compact('absensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $absensi = DB::table('absensi')->where('id', $id)
        ->join('karyawan','absensi.nik', '=', 'karyawan.nik')
        ->first();

        return view('absensi.showmap',compact('absensi'));
    }

    public function laporan()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];
        $karyawan = DB::table('karyawan')->orderBy('nama_lengkap')->get();
        return view('absensi.laporan',compact('namabulan','karyawan'));
    }

    public function cetaklaporan(Request $request)
    {
        $nik = $request->nik;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];
        $karyawan = DB::table('karyawan')->where('nik', $nik)
        ->join('departement','karyawan.kode_dept','=','departement.kode_dept')
        ->first();

        $absensi = DB::table('absensi')
        ->where('nik', $nik)
        ->whereRaw('MONTH(tgl_absensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_absensi)="'.$tahun.'"')
        ->orderBy('tgl_absensi')
        ->get();
        return view('absensi.cetaklaporan', compact('bulan','tahun','namabulan','karyawan','absensi'));
    }

    public function rekap()
    {
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];
        return view('absensi.rekap',compact('namabulan',));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $rekap = DB::table('absensi')
        ->selectRaw('absensi.nik,nama_lengkap,
            MAX(IF(DAY(tgl_absensi)= 1,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_1,
            MAX(IF(DAY(tgl_absensi)= 2,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_2,
            MAX(IF(DAY(tgl_absensi)= 3,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_3,
            MAX(IF(DAY(tgl_absensi)= 4,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_4,
            MAX(IF(DAY(tgl_absensi)= 5,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_5,
            MAX(IF(DAY(tgl_absensi)= 6,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_6,
            MAX(IF(DAY(tgl_absensi)= 7,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_7,
            MAX(IF(DAY(tgl_absensi)= 8,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_8,
            MAX(IF(DAY(tgl_absensi)= 9,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_9,
            MAX(IF(DAY(tgl_absensi)= 10,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_10,
            MAX(IF(DAY(tgl_absensi)= 11,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_11,
            MAX(IF(DAY(tgl_absensi)= 12,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_12,
            MAX(IF(DAY(tgl_absensi)= 13,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_13,
            MAX(IF(DAY(tgl_absensi)= 14,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_14,
            MAX(IF(DAY(tgl_absensi)= 15,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_15,
            MAX(IF(DAY(tgl_absensi)= 16,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_16,
            MAX(IF(DAY(tgl_absensi)= 17,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_17,
            MAX(IF(DAY(tgl_absensi)= 18,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_18,
            MAX(IF(DAY(tgl_absensi)= 19,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_19,
            MAX(IF(DAY(tgl_absensi)= 20,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_20,
            MAX(IF(DAY(tgl_absensi)= 21,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_21,
            MAX(IF(DAY(tgl_absensi)= 22,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_22,
            MAX(IF(DAY(tgl_absensi)= 23,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_23,
            MAX(IF(DAY(tgl_absensi)= 24,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_24,
            MAX(IF(DAY(tgl_absensi)= 25,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_25,
            MAX(IF(DAY(tgl_absensi)= 26,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_26,
            MAX(IF(DAY(tgl_absensi)= 27,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_27,
            MAX(IF(DAY(tgl_absensi)= 28,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_28,
            MAX(IF(DAY(tgl_absensi)= 29,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_29,
            MAX(IF(DAY(tgl_absensi)= 30,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_30,
            MAX(IF(DAY(tgl_absensi)= 31,CONCAT(jam_masuk,"-",IFNULL(jam_pulang,"00:00:00")),"")) AS tgl_31')
        ->join('karyawan','absensi.nik','=','karyawan.nik')
        ->whereRaw('MONTH(tgl_absensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_absensi)="'.$tahun.'"')
        ->groupByRaw('absensi.nik, nama_lengkap')
        ->get();
        $namabulan = ["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember",];
        return view('absensi.cetakrekap',compact('namabulan','bulan','tahun','rekap'));

    }

    public function izinsakit(Request $request)
    {
       $query = Pengajuanizin::query();
       $query->select('id','tgl_izin','pengajuan_izin.nik','nama_lengkap','jabatan','status','status_approved','keterangan');
       $query->join('karyawan','pengajuan_izin.nik','=','karyawan.nik');
       if(!empty($request->dari) && !empty($request->sampai)){
        $query->whereBetween('tgl_izin',[$request->dari,$request->sampai]);
       }

       if(!empty($request->nik)){
        $query->where('pengajuan_izin.nik',$request->nik);
       }

       if(!empty($request->nama_lengkap)){
        $query->where('nama_lengkap','like', '%'. $request->nama_lengkap.'%');
       }

       if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2'){
        $query->where('status_approved', $request->status_approved);
       }

       $query->orderBy('tgl_izin', 'desc');
       $izinsakit = $query->paginate(10);
       $izinsakit->appends($request->all()); 
       return view('absensi.izinsakit',compact('izinsakit'));
    }

    public function approveizinskit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id',$id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['error'=>'Data Gagal Disimpan']);
        }
        return view('absensi.izinsakit',compact('izinsakit'));
    }

    public function batalkanizinsakit($id)
    {
        // $status_approved = $request->status_approved;
        // $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('pengajuan_izin')->where('id',$id)->update([
            'status_approved' => 0
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['error'=>'Data Gagal Disimpan']);
        }
        return view('absensi.izinsakit',compact('izinsakit'));
    }



}
