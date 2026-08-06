<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidCategory;
use App\Models\PpidItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PpidCategoryController extends Controller
{
    public function index()
    {
        $categories = PpidCategory::withCount('items')->orderBy('urutan')->get();
        return view('admin.ppid-category.index', compact('categories'));
    }

    public function create() { return view('admin.ppid-category.form'); }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'urutan'     => 'nullable|integer',
        ]);
        PpidCategory::create($validated);
        return redirect()->route('admin.ppid-category.index')->with('success', 'Kategori PPID berhasil ditambahkan.');
    }

    public function edit(PpidCategory $ppidCategory)
    {
        return view('admin.ppid-category.form', ['category' => $ppidCategory]);
    }

    public function update(Request $request, PpidCategory $ppidCategory)
    {
        $validated = $request->validate([
            'nama'       => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'urutan'     => 'nullable|integer',
        ]);
        $ppidCategory->update($validated);
        return redirect()->route('admin.ppid-category.index')->with('success', 'Kategori PPID berhasil diperbarui.');
    }

    public function destroy(PpidCategory $ppidCategory)
    {
        $ppidCategory->delete();
        return redirect()->route('admin.ppid-category.index')->with('success', 'Kategori PPID berhasil dihapus.');
    }
}
