<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apbdes;
use App\Models\Idm;
use App\Models\StatistikPenduduk;

class DataDesaPublicController extends Controller
{
    public function apbdes()
    {
        // Get the latest APBDes data, or all if we want to show history
        $apbdesList = Apbdes::orderBy('tahun', 'desc')->get();
        return view('data-desa.apbdes', compact('apbdesList'));
    }

    public function idm()
    {
        $idms = Idm::orderBy('tahun', 'asc')->get();
        return view('data-desa.idm', compact('idms'));
    }

    public function statistik(Request $request)
    {
        // Hanya tampilkan kategori yang memiliki data di database
        $categories = StatistikPenduduk::distinct()->pluck('kategori');

        // Gunakan kategori pilihan request atau kategori pertama yang tersedia
        $kategori = $request->query('kategori', $categories->first());

        $statistik = $kategori 
            ? StatistikPenduduk::where('kategori', $kategori)->orderBy('jumlah', 'desc')->get()
            : collect();

        return view('data-desa.statistik', compact('statistik', 'kategori', 'categories'));
    }
}
