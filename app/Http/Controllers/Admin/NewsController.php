<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->latest()->paginate(15);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = NewsCategory::orderBy('nama')->get();
        return view('admin.news.form', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'news_category_id'  => 'required|exists:news_categories,id',
            'judul'             => 'required|string|max:500',
            'isi'               => 'required|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'penulis'           => 'nullable|string|max:255',
            'status'            => 'required|in:draft,publish',
            'tanggal_publish'   => 'nullable|date',
        ]);

        $validated['slug'] = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('news', 'public');
        }

        if ($validated['status'] === 'publish' && empty($validated['tanggal_publish'])) {
            $validated['tanggal_publish'] = now();
        }

        News::create($validated);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        $categories = NewsCategory::orderBy('nama')->get();
        return view('admin.news.form', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'news_category_id'  => 'required|exists:news_categories,id',
            'judul'             => 'required|string|max:500',
            'isi'               => 'required|string',
            'foto'              => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'penulis'           => 'nullable|string|max:255',
            'status'            => 'required|in:draft,publish',
            'tanggal_publish'   => 'nullable|date',
        ]);

        if ($request->hasFile('foto')) {
            if ($news->foto) {
                Storage::disk('public')->delete($news->foto);
            }
            $validated['foto'] = $request->file('foto')->store('news', 'public');
        }

        if ($validated['status'] === 'publish' && empty($validated['tanggal_publish'])) {
            $validated['tanggal_publish'] = now();
        }

        $news->update($validated);
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->foto) {
            Storage::disk('public')->delete($news->foto);
        }
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
