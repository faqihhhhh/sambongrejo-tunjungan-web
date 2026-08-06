<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HukumCategory extends Model
{
    protected $fillable = ['nama'];

    public function documents()
    {
        return $this->hasMany(HukumDocument::class);
    }
}
