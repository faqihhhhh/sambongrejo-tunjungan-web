<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class AgendaPublicController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderByDesc('tanggal_mulai')->paginate(10);
        return view('agenda.index', compact('agendas'));
    }
}
