<?php

namespace App\Http\Controllers;

use App\Models\PpidCategory;

class PpidPublicController extends Controller
{
    public function index()
    {
        $categories = PpidCategory::with('items')->orderBy('urutan')->get();
        return view('ppid.index', compact('categories'));
    }
}
