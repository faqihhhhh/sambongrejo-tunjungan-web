<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    protected $fillable = [
        'kategori',
        'nama_item',
        'jumlah',
        'warna',
    ];
}
