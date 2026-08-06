<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RunningText extends Model
{
    protected $fillable = ['teks', 'aktif', 'urutan'];

    protected $casts = [
        'aktif' => 'boolean',
    ];
}
