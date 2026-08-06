@extends('layouts.public')
@section('title', $news->judul . ' — Berita Desa Sambongrejo')
@section('meta_description', Str::limit(strip_tags($news->isi), 160))

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    {{-- Breadcrumb --}}
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-blora-green-dark">Beranda</a>
        <span class="mx-2">›</span>
        <a href="{{ route('berita') }}" class="hover:text-blora-green-dark">Berita</a>
        <span class="mx-2">›</span>
        <span class="text-gray-700">{{ Str::limit($news->judul, 40) }}</span>
    </nav>

    <article>
        <span class="badge-kategori">{{ $news->category->nama }}</span>
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-blora-green-dark mt-3 mb-3 leading-tight">{{ $news->judul }}</h1>
        <div class="flex items-center gap-4 text-gray-500 text-sm mb-6 pb-4 border-b border-gray-100">
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                {{ $news->penulis }}
            </span>
            <span class="flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $news->tanggal_publish?->translatedFormat('l, d F Y') }}
            </span>
        </div>

        @if($news->foto)
        <div class="mb-6 rounded-lg overflow-hidden">
            <img src="{{ Storage::url($news->foto) }}" alt="{{ $news->judul }}" class="w-full max-h-80 object-cover">
        </div>
        @endif

        <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
            {!! $news->isi !!}
        </div>
    </article>

    {{-- Share --}}
    <div class="mt-8 pt-6 border-t border-gray-100 flex items-center gap-3">
        <span class="text-sm text-gray-500 font-medium">Bagikan:</span>
        <a href="https://wa.me/?text={{ urlencode($news->judul . ' ' . request()->url()) }}" target="_blank"
           class="px-3 py-1.5 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition-colors">WhatsApp</a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"
           class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 transition-colors">Facebook</a>
    </div>

    {{-- Berita Terkait --}}
    @if($related->isNotEmpty())
    <div class="mt-10">
        <h2 class="section-title">Berita Terkait</h2>
        <span class="section-title-underline"></span>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-4">
            @foreach($related as $item)
            <a href="{{ route('berita.show', $item->slug) }}" class="card-berita block group">
                <div class="h-28 bg-gray-100 overflow-hidden">
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blora-green to-blora-green-dark"></div>
                    @endif
                </div>
                <div class="p-3">
                    <h4 class="text-sm font-semibold text-blora-green-dark line-clamp-2 group-hover:text-blora-green transition-colors">{{ $item->judul }}</h4>
                    <p class="text-gray-400 text-xs mt-1">{{ $item->tanggal_publish?->translatedFormat('d F Y') }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
