<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidItem extends Model
{
    protected $fillable = [
        'ppid_category_id',
        'judul',
        'isi',
        'file',
        'tanggal',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function category()
    {
        return $this->belongsTo(PpidCategory::class, 'ppid_category_id');
    }
}
