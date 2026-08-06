@extends('layouts.public')
@section('title', 'Tautan Terkait — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl font-bold text-white">Tautan Terkait</h1>
        <p class="text-green-200 mt-2">Portal dan website instansi terkait</p>
    </div>
</div>
<div class="max-w-5xl mx-auto px-4 sm:px-6 py-12">
    @if($links->isNotEmpty())
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach($links as $link)
        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
           class="flex flex-col items-center justify-center p-5 bg-white border border-gray-200 rounded-lg hover:border-blora-gold hover:shadow-md transition-all text-center group">
            @if($link->logo)
                <img src="{{ Storage::url($link->logo) }}" alt="{{ $link->nama }}"
                     class="h-14 object-contain mb-3 group-hover:scale-105 transition-transform">
            @else
                <div class="w-14 h-14 bg-blora-green-dark rounded-full flex items-center justify-center mb-3">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                </div>
            @endif
            <p class="font-semibold text-blora-green-dark text-sm group-hover:text-blora-green transition-colors">{{ $link->nama }}</p>
        </a>
        @endforeach
    </div>
    @else
    <div class="text-center py-16 text-gray-400"><p>Belum ada tautan terkait yang ditambahkan.</p></div>
    @endif
</div>
@endsection
