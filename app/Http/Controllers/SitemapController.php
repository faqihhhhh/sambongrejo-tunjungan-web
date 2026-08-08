<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // Ambil berita yang sudah di-publish
        $berita = News::where('status', 'publish')->orderBy('created_at', 'desc')->get();

        // Tampilkan sebagai XML
        return response()->view('sitemap', [
            'berita' => $berita
        ])->header('Content-Type', 'text/xml');
    }
}
