<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apbdes extends Model
{
    protected $fillable = [
        'tahun',
        'pendapatan_anggaran',
        'pendapatan_realisasi',
        'belanja_anggaran',
        'belanja_realisasi',
        'pembiayaan_penerimaan_anggaran',
        'pembiayaan_penerimaan_realisasi',
        'pembiayaan_pengeluaran_anggaran',
        'pembiayaan_pengeluaran_realisasi',
    ];
}
