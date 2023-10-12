<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pelanggan extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "pelanggan";
    protected $primaryKey = "nik_ktp";
    protected $fillable = [
        'nik_ktp',
        'nama_pelanggan',
        'no_hp',
        'lokasi',
        'tgl_daftar',
        'foto_ktp',
        'kode_produk',
        'status_approve',
        'password',
        'foto',
        'keatifan'

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
