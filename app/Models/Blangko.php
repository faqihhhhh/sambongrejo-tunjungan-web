<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blangko extends Model
{
    protected $fillable = ['nama', 'file', 'keterangan', 'ukuran_file'];
}
