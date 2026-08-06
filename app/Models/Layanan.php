<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'layanan_category_id',
        'judul',
        'deskripsi',
        'syarat',
        'ikon',
        'urutan',
    ];

    public function category()
    {
        return $this->belongsTo(LayananCategory::class, 'layanan_category_id');
    }
}
