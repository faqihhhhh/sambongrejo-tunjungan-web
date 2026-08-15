<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikPenduduk;

class StatistikPendudukController extends Controller
{
    private function getCategories()
    {
        $default = ['Pendidikan', 'Pekerjaan', 'Agama', 'Usia', 'Jenis Kelamin'];
        $dbCategories = StatistikPenduduk::distinct()->pluck('kategori')->toArray();
        return collect(array_values(array_unique(array_merge($default, $dbCategories))));
    }

    public function index(Request $request)
    {
        $categories = $this->getCategories();
        $kategori = $request->query('kategori', $categories->first() ?? 'Pendidikan');
        $statistik = StatistikPenduduk::where('kategori', $kategori)->orderBy('jumlah', 'desc')->get();
        return view('admin.statistik.index', compact('statistik', 'kategori', 'categories'));
    }

    public function create(Request $request)
    {
        $categories = $this->getCategories();
        $selectedKategori = $request->query('kategori', 'Pendidikan');
        return view('admin.statistik.create', compact('categories', 'selectedKategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'nama_item' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'warna' => 'nullable|string|max:7',
        ]);

        StatistikPenduduk::create($validated);
        return redirect()->route('admin.statistik.index', ['kategori' => $validated['kategori']])->with('success', 'Data Statistik berhasil ditambahkan.');
    }

    public function edit(StatistikPenduduk $statistik)
    {
        $categories = $this->getCategories();
        $selectedKategori = $statistik->kategori;
        return view('admin.statistik.edit', compact('statistik', 'categories', 'selectedKategori'));
    }

    public function update(Request $request, StatistikPenduduk $statistik)
    {
        $validated = $request->validate([
            'kategori' => 'required|string|max:255',
            'nama_item' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'warna' => 'nullable|string|max:7',
        ]);

        $statistik->update($validated);
        return redirect()->route('admin.statistik.index', ['kategori' => $validated['kategori']])->with('success', 'Data Statistik berhasil diperbarui.');
    }

    public function destroy(StatistikPenduduk $statistik)
    {
        $kategori = $statistik->kategori;
        $statistik->delete();
        return redirect()->route('admin.statistik.index', ['kategori' => $kategori])->with('success', 'Data Statistik berhasil dihapus.');
    }
}
