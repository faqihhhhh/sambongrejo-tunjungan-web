@extends('layouts.public')
@section('title', 'Potensi Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Potensi Desa</h1>
        <p class="text-green-200 mt-2">Kekayaan dan potensi Desa Sambongrejo</p>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    {{-- Tab Kategori --}}
    <div class="flex flex-wrap gap-2 mb-8 border-b border-gray-200 pb-4">
        @foreach($allKategori as $key => $label)
        <a href="{{ route('potensi.show', $key) }}"
           class="px-4 py-2 text-sm font-semibold rounded-t border-b-2 transition-all
           {{ $kategori === $key ? 'border-blora-gold text-blora-green-dark bg-yellow-50' : 'border-transparent text-gray-500 hover:text-blora-green-dark hover:border-blora-gold' }}">
            {{ $label }}
        </a>
        @endforeach
    </div>

    @if($items->isNotEmpty())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
        <div class="bg-white rounded-lg overflow-hidden border border-gray-200 hover:shadow-md transition-shadow">
            @if($item->foto)
            <div class="h-48 overflow-hidden">
                <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->judul }}" class="w-full h-full object-cover">
            </div>
            @else
            <div class="h-48 bg-gradient-to-br from-blora-green to-blora-green-dark flex items-center justify-center">
                <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
            </div>
            @endif
            <div class="p-4">
                <h3 class="font-serif text-blora-green-dark font-semibold">{{ $item->judul }}</h3>
                @if($item->deskripsi)
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">{{ $item->deskripsi }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 text-gray-400">
        <p>Belum ada data potensi untuk kategori {{ $allKategori[$kategori] ?? $kategori }}.</p>
    </div>
    @endif
</div>
@endsection
