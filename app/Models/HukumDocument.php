<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HukumDocument extends Model
{
    protected $fillable = [
        'hukum_category_id',
        'judul',
        'nomor_dokumen',
        'file_pdf',
        'tanggal',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(HukumCategory::class, 'hukum_category_id');
    }
}
