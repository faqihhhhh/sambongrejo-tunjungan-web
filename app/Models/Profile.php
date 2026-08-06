<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_kades',
        'jabatan_kades',
        'foto_kades',
        'sambutan_singkat',
        'sambutan_lengkap',
        'sejarah',
        'visi',
        'misi',
        'luas_wilayah',
        'jumlah_penduduk',
        'jumlah_kk',
        'kode_pos',
        'alamat_kantor',
        'telepon',
        'email',
        'maps_embed_url',
        'jam_pelayanan',
        'jam_istirahat',
    ];
}
