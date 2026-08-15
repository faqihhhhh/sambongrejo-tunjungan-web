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
        $default = ['Pendidikan', 'Pekerjaan', 'Agama', 'Usia', 'Jenis Kelamin'];
        $dbCategories = StatistikPenduduk::distinct()->pluck('kategori')->toArray();
        $categories = collect(array_values(array_unique(array_merge($default, $dbCategories))));

        $kategori = $request->query('kategori', 'Pendidikan');
        $statistik = StatistikPenduduk::where('kategori', $kategori)->orderBy('jumlah', 'desc')->get();
        return view('data-desa.statistik', compact('statistik', 'kategori', 'categories'));
    }
}
