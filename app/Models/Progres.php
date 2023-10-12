<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;
    protected $table = "progres";
    protected $primaryKey = "kode_progres";
    protected $fillable = [
        'kode_progres',
        'judul_progres',
        'tgl_progres',
        'isi_progres',
        'total_barang',
        'status_approved',
    ];
}
