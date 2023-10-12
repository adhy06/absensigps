<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $nama_barang = $request->nama_barang;
        $query = Barang::query();
        $query->select('*');
        if (!empty($nama_barang)) {
            $query->where('nama_barang','like','%'.$request->nama_barang.'%');
        }
        $barang = $query->get();

        return view('barang.index', compact('barang'));
    }
}
