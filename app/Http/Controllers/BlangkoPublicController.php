<?php

namespace App\Http\Controllers;

use App\Models\Blangko;

class BlangkoPublicController extends Controller
{
    public function index()
    {
        $blangkos = Blangko::latest()->paginate(15);
        return view('unduhan.index', compact('blangkos'));
    }
}
