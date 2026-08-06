<?php

namespace App\Http\Controllers;

use App\Models\HukumCategory;
use App\Models\HukumDocument;

class HukumPublicController extends Controller
{
    public function index()
    {
        $categories = HukumCategory::with('documents')->get();
        return view('hukum.index', compact('categories'));
    }

    public function byKategori(int $kategori)
    {
        $category  = HukumCategory::findOrFail($kategori);
        $documents = HukumDocument::where('hukum_category_id', $kategori)->orderByDesc('tanggal')->paginate(15);
        $categories = HukumCategory::all();
        return view('hukum.kategori', compact('category', 'documents', 'categories'));
    }
}
