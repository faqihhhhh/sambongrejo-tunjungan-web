@extends('layouts.public')
@section('title', 'Layanan Desa — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Layanan Desa</h1>
        <p class="text-green-200 mt-2">Pelayanan administrasi Balai Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="bg-blora-green-dark rounded-lg p-5 sm:p-6 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-white shadow-md">
        <div>
            <h3 class="text-lg font-bold mb-1 text-white">Butuh Formulir Kosong (Blangko)?</h3>
            <p class="text-green-200 text-sm">Unduh format dokumen, surat pengantar, dan blangko isian yang Anda butuhkan sebelum mengurus layanan.</p>
        </div>
        <a href="{{ route('unduhan') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blora-gold text-blora-green-dark text-sm font-bold rounded hover:bg-yellow-500 transition-colors flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Buka Halaman Unduhan
        </a>
    </div>
    <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-lg p-4 mb-8 text-sm text-green-800">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Layanan tersedia setiap hari kerja <strong>Senin – Jumat, 08.00 – 15.00 WIB</strong>.
        Bawa dokumen persyaratan yang diperlukan.</span>
    </div>

    @if($categories->isNotEmpty())
        @foreach($categories as $cat)
        @if($cat->layanans->isNotEmpty())
        <div class="mb-10">
            <h2 class="section-title">{{ $cat->nama }}</h2>
            <span class="section-title-underline"></span>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($cat->layanans as $layanan)
                <a href="{{ route('layanan.show', $layanan->id) }}"
                   class="block bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md hover:border-blora-gold transition-all group"
                   style="border-left: 3px solid var(--blora-gold);">
                    <h3 class="font-semibold text-blora-green-dark group-hover:text-blora-green transition-colors">{{ $layanan->judul }}</h3>
                    @if($layanan->deskripsi)
                    <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $layanan->deskripsi }}</p>
                    @endif
                    <p class="text-blora-blue text-xs font-semibold mt-3">Lihat syarat →</p>
                </a>
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    @else
        @forelse($layanans as $layanan)
        <div class="mb-4 bg-white border border-gray-200 rounded-lg p-5 hover:shadow-md transition-shadow"
             style="border-left: 3px solid var(--blora-gold);">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-semibold text-blora-green-dark">{{ $layanan->judul }}</h3>
                    @if($layanan->deskripsi)<p class="text-gray-500 text-sm mt-1">{{ $layanan->deskripsi }}</p>@endif
                </div>
                <a href="{{ route('layanan.show', $layanan->id) }}" class="btn-primary text-xs py-1.5 px-3 flex-shrink-0 ml-3">Detail</a>
            </div>
        </div>
        @empty
        <div class="text-center py-16 text-gray-400"><p>Belum ada layanan yang terdaftar.</p></div>
        @endforelse
    @endif
</div>
@endsection
