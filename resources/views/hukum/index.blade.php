@extends('layouts.public')
@section('title', 'Produk Hukum — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Produk Hukum</h1>
        <p class="text-green-200 mt-2">Peraturan dan keputusan Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    @foreach($categories as $cat)
    @if($cat->documents->isNotEmpty())
    <div class="mb-10">
        <h2 class="section-title">{{ $cat->nama }}</h2>
        <span class="section-title-underline"></span>

        <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
            <table class="table-gov">
                <thead>
                    <tr>
                        <th style="width:50px">#</th>
                        <th>Judul Dokumen</th>
                        <th>No. Dokumen</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cat->documents->sortByDesc('tanggal') as $i => $doc)
                    <tr>
                        <td class="text-gray-400 text-center">{{ $i + 1 }}</td>
                        <td class="font-medium text-blora-green-dark">{{ $doc->judul }}</td>
                        <td class="text-gray-500">{{ $doc->nomor_dokumen ?? '-' }}</td>
                        <td class="text-gray-500 whitespace-nowrap">{{ $doc->tanggal->translatedFormat('d M Y') }}</td>
                        <td>
                            <a href="{{ Storage::url($doc->file_pdf) }}" target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blora-red text-white text-xs font-semibold rounded hover:opacity-90 transition-opacity">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                PDF
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endforeach

    @if($categories->every(fn($c) => $c->documents->isEmpty()))
    <div class="text-center py-16 text-gray-400">
        <p>Belum ada produk hukum yang diunggah.</p>
    </div>
    @endif
</div>
@endsection
