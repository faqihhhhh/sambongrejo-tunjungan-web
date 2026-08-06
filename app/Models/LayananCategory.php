<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayananCategory extends Model
{
    protected $fillable = ['nama'];

    public function layanans()
    {
        return $this->hasMany(Layanan::class);
    }
}
