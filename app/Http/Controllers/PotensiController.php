<?php

namespace App\Http\Controllers;

use App\Models\PotensiDesa;

class PotensiController extends Controller
{
    public function index()
    {
        return redirect()->route('potensi.show', 'umkm');
    }

    public function show(string $kategori)
    {
        $validKategori = array_keys(PotensiDesa::$kategoriLabels);
        if (!in_array($kategori, $validKategori)) {
            abort(404);
        }

        $items = PotensiDesa::where('kategori', $kategori)->orderBy('urutan')->get();
        $allKategori = PotensiDesa::$kategoriLabels;

        return view('potensi.show', compact('items', 'kategori', 'allKategori'));
    }
}
