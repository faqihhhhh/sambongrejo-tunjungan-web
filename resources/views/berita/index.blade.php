@extends('layouts.public')
@section('title', 'Berita Desa Sambongrejo')

@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Berita Desa</h1>
        <p class="text-green-200 mt-2">Informasi terkini seputar Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    {{-- Filter Kategori --}}
    <div class="flex flex-wrap gap-2 mb-8">
        <a href="{{ route('berita') }}"
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ !$kategori ? 'bg-blora-text text-white shadow-md shadow-blora-text/20' : 'bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-blora-text' }}">
            Semua
        </a>
        @foreach($categories as $cat)
        <a href="{{ route('berita', ['kategori' => $cat->slug]) }}"
           class="px-4 py-2 rounded-lg text-sm font-semibold transition-all {{ $kategori === $cat->slug ? 'bg-blora-text text-white shadow-md shadow-blora-text/20' : 'bg-gray-50 text-gray-500 hover:bg-gray-100 hover:text-blora-text' }}">
            {{ $cat->nama }}
        </a>
        @endforeach
    </div>

    @if($news->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($news as $item)
        <a href="{{ route('berita.show', $item->slug) }}" class="card-berita block group">
            <div class="aspect-video bg-gray-100 overflow-hidden">
                @if($item->foto)
                    <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-blora-green to-blora-green-dark flex items-center justify-center">
                        <svg class="w-12 h-12 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                @endif
            </div>
            <div class="p-4">
                <span class="badge-kategori">{{ $item->category->nama }}</span>
                <h3 class="font-serif text-blora-green-dark font-semibold mt-2 mb-2 group-hover:text-blora-green transition-colors line-clamp-2">{{ $item->judul }}</h3>
                <p class="text-gray-500 text-sm line-clamp-2">{{ Str::limit(strip_tags($item->isi), 100) }}</p>
                <div class="flex items-center justify-between mt-3">
                    <p class="text-gray-400 text-xs">{{ $item->tanggal_publish?->translatedFormat('d F Y') }}</p>
                    <p class="text-blora-blue text-xs font-medium">{{ $item->penulis }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $news->links() }}
    </div>
    @else
    <div class="text-center py-16 text-gray-400">
        <p>Belum ada berita untuk kategori ini.</p>
    </div>
    @endif
</div>
@endsection
