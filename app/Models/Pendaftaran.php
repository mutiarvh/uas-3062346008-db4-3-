<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nama_panggilan',
        'tempat_tanggal_lahir',
        'alamat_asal',
        'alamat_asal_phone',
        'alamat_di_malang',
        'alamat_di_malang_phone',
        'email',
        'motivasi',
        'pengalaman_berorganisasi',
        'pengalaman_kepanitiaan',
        'motto_hidup',
        'divisi_yang_diinginkan',
        'foto',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'divisi_yang_diinginkan' => 'array',
        'latitude' => 'float',
        'longitude' => 'float',
    ];

    protected $attributes = [
        'divisi_yang_diinginkan' => '[]',
    ];
}
