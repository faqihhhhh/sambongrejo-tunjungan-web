@extends('layouts.public')
@section('title', $layanan->judul . ' — Layanan Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="text-green-300 text-sm mb-3">
            <a href="{{ route('layanan') }}" class="hover:text-white">Layanan</a> › {{ $layanan->judul }}
        </nav>
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white">{{ $layanan->judul }}</h1>
        @if($layanan->category)
        <span class="badge-kategori mt-2 inline-block">{{ $layanan->category->nama }}</span>
        @endif
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
        @if($layanan->deskripsi)
        <div class="mb-6">
            <h2 class="font-serif text-blora-green-dark text-lg font-semibold mb-3">Deskripsi Layanan</h2>
            <p class="text-gray-700 leading-relaxed">{{ $layanan->deskripsi }}</p>
        </div>
        @endif

        @if($layanan->syarat)
        <div class="mt-6 pt-6 border-t border-gray-100">
            <h2 class="font-serif text-blora-green-dark text-lg font-semibold mb-3">Persyaratan</h2>
            <div class="prose prose-sm max-w-none text-gray-700">{!! $layanan->syarat !!}</div>
        </div>
        @endif

        <div class="mt-8 pt-6 border-t border-gray-100 bg-gray-50 rounded-lg p-4">
            <div class="flex items-start gap-2 mb-2">
                <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <div>
                    <p class="text-sm font-semibold text-blora-green-dark">Tempat Pelayanan</p>
                    <p class="text-gray-600 text-sm">Balai Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 flex-shrink-0 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <p class="text-gray-500 text-sm">Senin – Jumat, pukul 08.00 – 15.00 WIB</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('layanan') }}" class="btn-secondary">← Kembali ke Daftar Layanan</a>
    </div>
</div>
@endsection
