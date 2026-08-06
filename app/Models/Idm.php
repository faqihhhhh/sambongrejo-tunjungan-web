<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idm extends Model
{
    protected $fillable = [
        'tahun',
        'skor',
        'status',
        'target_tahun_depan',
    ];
}
