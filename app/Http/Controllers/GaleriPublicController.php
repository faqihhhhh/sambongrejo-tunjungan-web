<?php

namespace App\Http\Controllers;

use App\Models\GaleriFoto;
use App\Models\GaleriVideo;

class GaleriPublicController extends Controller
{
    public function index()
    {
        $tab    = request('tab', 'foto');
        $fotos  = GaleriFoto::orderByDesc('tanggal')->paginate(12);
        $videos = GaleriVideo::orderByDesc('tanggal')->paginate(9);
        return view('galeri.index', compact('fotos', 'videos', 'tab'));
    }
}
