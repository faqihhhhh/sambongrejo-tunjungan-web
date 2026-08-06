<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;

class NewsPublicController extends Controller
{
    public function index()
    {
        $kategori    = request('kategori');
        $categories  = NewsCategory::all();
        $news        = News::with('category')
            ->published()
            ->when($kategori, fn($q) => $q->whereHas('category', fn($q2) => $q2->where('slug', $kategori)))
            ->paginate(9);

        return view('berita.index', compact('news', 'categories', 'kategori'));
    }

    public function show(string $slug)
    {
        $news = News::with('category')->where('slug', $slug)->where('status', 'publish')->firstOrFail();
        $related = News::with('category')
            ->published()
            ->where('news_category_id', $news->news_category_id)
            ->where('id', '!=', $news->id)
            ->take(3)->get();

        return view('berita.show', compact('news', 'related'));
    }
}
