<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsCategoryController extends Controller
{
    public function index()
    {
        $categories = NewsCategory::withCount('news')->get();
        return view('admin.news-category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.news-category.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['nama' => 'required|string|max:255|unique:news_categories,nama']);
        $validated['slug'] = Str::slug($validated['nama']);
        NewsCategory::create($validated);
        return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(NewsCategory $newsCategory)
    {
        return view('admin.news-category.form', ['category' => $newsCategory]);
    }

    public function update(Request $request, NewsCategory $newsCategory)
    {
        $validated = $request->validate(['nama' => 'required|string|max:255|unique:news_categories,nama,' . $newsCategory->id]);
        $validated['slug'] = Str::slug($validated['nama']);
        $newsCategory->update($validated);
        return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(NewsCategory $newsCategory)
    {
        $newsCategory->delete();
        return redirect()->route('admin.news-category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
