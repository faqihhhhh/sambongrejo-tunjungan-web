<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    protected $table = 'galeri_video';

    protected $fillable = ['judul', 'url_video', 'thumbnail', 'keterangan', 'tanggal'];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Convert YouTube watch URL to embed URL automatically.
     */
    public function getEmbedUrlAttribute(): string
    {
        $url = $this->url_video;
        // Parse youtube.com/watch?v=ID
        if (str_contains($url, 'watch?v=')) {
            $id = explode('watch?v=', $url)[1];
            $id = explode('&', $id)[0];
            return "https://www.youtube.com/embed/{$id}";
        }
        // Parse youtu.be/ID
        if (str_contains($url, 'youtu.be/')) {
            $id = explode('youtu.be/', $url)[1];
            $id = explode('?', $id)[0]; // in case there are query parameters
            return "https://www.youtube.com/embed/{$id}";
        }
        // If it's already an embed URL or other format
        return $url;
    }
}
