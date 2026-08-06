<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LayananCategory;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananCategoryController extends Controller
{
    public function index()
    {
        $categories = LayananCategory::withCount('layanans')->get();
        return view('admin.layanan-category.index', compact('categories'));
    }

    public function create() { return view('admin.layanan-category.form'); }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255|unique:layanan_categories,nama']);
        LayananCategory::create($request->only('nama'));
        return redirect()->route('admin.layanan-category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(LayananCategory $layananCategory)
    {
        return view('admin.layanan-category.form', ['category' => $layananCategory]);
    }

    public function update(Request $request, LayananCategory $layananCategory)
    {
        $request->validate(['nama' => 'required|string|max:255|unique:layanan_categories,nama,' . $layananCategory->id]);
        $layananCategory->update($request->only('nama'));
        return redirect()->route('admin.layanan-category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(LayananCategory $layananCategory)
    {
        $layananCategory->delete();
        return redirect()->route('admin.layanan-category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
