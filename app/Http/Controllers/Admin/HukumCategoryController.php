<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HukumCategory;
use App\Models\HukumDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HukumCategoryController extends Controller
{
    public function index()
    {
        $categories = HukumCategory::withCount('documents')->get();
        return view('admin.hukum-category.index', compact('categories'));
    }

    public function create() { return view('admin.hukum-category.form'); }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:255|unique:hukum_categories,nama']);
        HukumCategory::create($request->only('nama'));
        return redirect()->route('admin.hukum-category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(HukumCategory $hukumCategory)
    {
        return view('admin.hukum-category.form', ['category' => $hukumCategory]);
    }

    public function update(Request $request, HukumCategory $hukumCategory)
    {
        $request->validate(['nama' => 'required|string|max:255|unique:hukum_categories,nama,' . $hukumCategory->id]);
        $hukumCategory->update($request->only('nama'));
        return redirect()->route('admin.hukum-category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(HukumCategory $hukumCategory)
    {
        $hukumCategory->delete();
        return redirect()->route('admin.hukum-category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
