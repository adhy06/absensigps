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
        // $pass = 123;
        // echo Hash::make($pass);
        if(Auth::guard('karyawan')->attempt(['nik' =>$request->nik, 'password' => $request->password])){
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning' => 'NIK / Password Salah']);
        }
    }

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);
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








}
