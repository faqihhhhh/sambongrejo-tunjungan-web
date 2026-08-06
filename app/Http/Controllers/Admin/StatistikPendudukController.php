<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatistikPenduduk;

class StatistikPendudukController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori', 'Pendidikan');
        $statistik = StatistikPenduduk::where('kategori', $kategori)->orderBy('jumlah', 'desc')->get();
        return view('admin.statistik.index', compact('statistik', 'kategori'));
    }

    public function create()
    {
        return view('admin.statistik.create');
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
        return view('admin.statistik.edit', compact('statistik'));
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
