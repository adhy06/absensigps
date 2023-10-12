<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perencanaan extends Model
{
    use HasFactory;
    protected $table = "perencanaan";
    // protected $primaryKey = "kode_perencanaan";
    protected $fillable = [
        'kode_perencanaan',
        'judul_perencanaan',
        'tgl_perencanaan',
        'isi_perencanaan',
        'foto',
        'status_approve',
    ];
}
