<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\LayananCategory;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::with('category')->orderBy('urutan')->paginate(15);
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        $categories = LayananCategory::all();
        return view('admin.layanan.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'layanan_category_id' => 'nullable|exists:layanan_categories,id',
            'judul'               => 'required|string|max:500',
            'deskripsi'           => 'nullable|string',
            'syarat'              => 'nullable|string',
            'ikon'                => 'nullable|string|max:100',
            'urutan'              => 'nullable|integer',
        ]);
        Layanan::create($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        $categories = LayananCategory::all();
        return view('admin.layanan.form', compact('layanan', 'categories'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $validated = $request->validate([
            'layanan_category_id' => 'nullable|exists:layanan_categories,id',
            'judul'               => 'required|string|max:500',
            'deskripsi'           => 'nullable|string',
            'syarat'              => 'nullable|string',
            'ikon'                => 'nullable|string|max:100',
            'urutan'              => 'nullable|integer',
        ]);
        $layanan->update($validated);
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus.');
    }
}
