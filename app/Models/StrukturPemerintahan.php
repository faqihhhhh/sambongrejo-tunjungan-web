<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturPemerintahan extends Model
{
    protected $fillable = ['nama', 'jabatan', 'foto', 'urutan'];
}
