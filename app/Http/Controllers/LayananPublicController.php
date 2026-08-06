<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\LayananCategory;

class LayananPublicController extends Controller
{
    public function index()
    {
        $categories = LayananCategory::with(['layanans' => fn($q) => $q->orderBy('urutan')])->get();
        $layanans   = Layanan::with('category')->orderBy('urutan')->get();
        return view('layanan.index', compact('layanans', 'categories'));
    }

    public function show(int $id)
    {
        $layanan = Layanan::with('category')->findOrFail($id);
        return view('layanan.show', compact('layanan'));
    }
}
