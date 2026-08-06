<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotensiDesa extends Model
{
    protected $table = 'potensi_desa';

    protected $fillable = ['kategori', 'judul', 'deskripsi', 'foto', 'urutan'];

    public static array $kategoriLabels = [
        'umkm'       => 'UMKM',
        'wisata'     => 'Wisata',
        'peternakan' => 'Peternakan',
        'pertanian'  => 'Pertanian',
        'perkebunan' => 'Perkebunan',
        'perikanan'  => 'Perikanan',
    ];

    public function getKategoriLabelAttribute(): string
    {
        return self::$kategoriLabels[$this->kategori] ?? ucfirst($this->kategori);
    }
}
