@extends('layouts.public')
@section('title', 'PPID — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="badge-penting mb-3">UU KIP No. 14 Tahun 2008</span>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white mt-2">PPID Desa Sambongrejo</h1>
        <p class="text-green-200 mt-2">Pejabat Pengelola Informasi dan Dokumentasi</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-8 text-sm text-green-800">
        <div class="flex gap-3">
            <svg class="w-5 h-5 flex-shrink-0 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <div>
                Informasi publik desa ini dikelola sesuai dengan <strong>Undang-Undang No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik (UU KIP)</strong>.
                Untuk permohonan informasi, silakan hubungi kantor desa.
            </div>
        </div>
    </div>

    @foreach($categories as $cat)
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-8 h-8 bg-blora-green-dark rounded flex items-center justify-center text-white text-sm font-bold">{{ $cat->urutan }}</div>
            <div>
                <h2 class="section-title mb-0 text-xl">{{ $cat->nama }}</h2>
                @if($cat->deskripsi)
                <p class="text-gray-500 text-sm mt-0.5">{{ $cat->deskripsi }}</p>
                @endif
            </div>
        </div>
        <span class="section-title-underline"></span>

        @if($cat->items->isNotEmpty())
        <div class="space-y-3 mt-4">
            @foreach($cat->items as $item)
            <div class="bg-white border border-gray-200 rounded-lg p-4">
                <div class="flex items-start justify-between gap-3">
                    <div class="flex-1">
                        <h3 class="font-semibold text-blora-green-dark">{{ $item->judul }}</h3>
                        @if($item->tanggal)
                        <p class="text-gray-400 text-xs mt-1">{{ $item->tanggal->translatedFormat('d F Y') }}</p>
                        @endif
                        @if($item->isi)
                        <div class="text-gray-600 text-sm mt-2 leading-relaxed">{!! $item->isi !!}</div>
                        @endif
                    </div>
                    @if($item->file)
                    <a href="{{ Storage::url($item->file) }}" target="_blank"
                       class="flex-shrink-0 btn-secondary text-xs py-1.5 px-3">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> Unduh
                    </a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-gray-400 text-sm py-4 pl-4">Belum ada informasi untuk kategori ini.</div>
        @endif
    </div>
    @endforeach
</div>
@endsection
