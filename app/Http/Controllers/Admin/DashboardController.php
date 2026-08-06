<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\GaleriFoto;
use App\Models\HukumDocument;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'berita'         => News::count(),
            'berita_publish' => News::where('status', 'publish')->count(),
            'agenda_mendatang' => Agenda::upcoming()->count(),
            'banner_aktif'   => Banner::where('aktif', true)->count(),
            'galeri_foto'    => GaleriFoto::count(),
            'dokumen_hukum'  => HukumDocument::count(),
            'layanan'        => Layanan::count(),
        ];

        $berita_terbaru = News::with('category')->latest()->take(5)->get();
        $agenda_mendatang = Agenda::upcoming()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'berita_terbaru', 'agenda_mendatang'));
    }
}
