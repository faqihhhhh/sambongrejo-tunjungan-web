<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpidCategory extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'urutan'];

    public function items()
    {
        return $this->hasMany(PpidItem::class);
    }
}
