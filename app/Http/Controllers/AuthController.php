<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        if(Auth::guard('karyawan')->attempt(['nik' =>$request->nik, 'password' => $request->password])){
            return redirect('/panelkaryawan/dashboard');
        } else {
            return redirect('/panelkaryawan')->with(['warning' => 'NIK / Password Salah']);
        }
    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/panelkaryawan');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        if(Auth::guard('user')->attempt(['email' =>$request->email, 'password' => $request->password])){
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning' => 'Email / Password Salah']);
        }
    }

    public function proseslogoutadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginpelanggan(Request $request)
    {
        if(Auth::guard('pelanggan')->attempt(['nik_ktp' =>$request->nik_ktp, 'password' => $request->password])){
            return redirect('/panelpelanggan/dashboardpelanggan');
        } else {
            return redirect('/panelpelanggan')->with(['warning' => 'NIK / Password Salah']);
        }
    }

    public function proseslogoutpelanggan(){
        if(Auth::guard('pelanggan')->check()){
            Auth::guard('pelanggan')->logout();
            return redirect('/panelpelanggan');
        }
    }

}
