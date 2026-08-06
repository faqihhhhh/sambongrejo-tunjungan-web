<?php

namespace App\Http\Controllers;

use App\Models\LinkTerkait;

class LinkTerkaitPublicController extends Controller
{
    public function index()
    {
        $links = LinkTerkait::orderBy('urutan')->get();
        return view('link-terkait.index', compact('links'));
    }
}
