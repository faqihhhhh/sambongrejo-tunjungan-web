<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'news_category_id',
        'judul',
        'slug',
        'isi',
        'foto',
        'penulis',
        'status',
        'tanggal_publish',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish')->orderByDesc('tanggal_publish');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->judul) . '-' . time();
            }
        });
    }
}
