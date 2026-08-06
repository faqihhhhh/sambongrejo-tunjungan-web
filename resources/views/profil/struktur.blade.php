@extends('layouts.public')
@section('title', 'Struktur Pemerintahan — Desa Sambongrejo')
@section('content')
<div class="page-hero"><div class="max-w-7xl mx-auto px-6 text-center">
    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Struktur Pemerintahan</h1>
    <p class="text-green-200 mt-2">Perangkat Desa Sambongrejo</p>
</div></div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="flex flex-col md:flex-row gap-8">
        <aside class="md:w-56 flex-shrink-0">
            <nav class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blora-green-dark text-blora-gold text-xs font-semibold uppercase tracking-wide px-4 py-2.5">Menu Profil</div>
                @foreach([['href'=>route('profil'),'label'=>'Sambutan Kades'],['href'=>route('profil.sejarah'),'label'=>'Sejarah Desa'],['href'=>route('profil.visimisi'),'label'=>'Visi & Misi'],['href'=>route('profil.struktur'),'label'=>'Struktur Pemerintahan']] as $link)
                <a href="{{ $link['href'] }}" class="flex items-center gap-2 px-4 py-2.5 text-sm border-l-2 transition-all {{ request()->url()===$link['href'] ? 'border-blora-gold bg-yellow-50 text-blora-green-dark font-semibold' : 'border-transparent text-gray-600 hover:border-blora-gold hover:bg-green-50' }}">{{ $link['label'] }}</a>
                @endforeach
            </nav>
        </aside>
        <div class="flex-1">
            <h2 class="section-title">Perangkat Desa</h2>
            <span class="section-title-underline"></span>

            @if($strukturs->isNotEmpty())
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5 mt-4">
                @foreach($strukturs as $perangkat)
                <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow"
                     style="border-top: 3px solid var(--blora-gold);">
                    @if($perangkat->foto)
                        <img src="{{ Storage::url($perangkat->foto) }}"
                             alt="{{ $perangkat->nama }}"
                             class="w-24 h-28 object-cover rounded mx-auto mb-3"
                             style="border: 2px solid var(--blora-gold);">
                    @else
                        <div class="w-24 h-28 bg-gray-100 rounded mx-auto mb-3 flex items-center justify-center" style="border: 2px solid var(--blora-gold);">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                    @endif
                    <p class="font-semibold text-blora-green-dark text-sm">{{ $perangkat->nama }}</p>
                    <p class="text-gray-500 text-xs mt-1 bg-yellow-50 rounded px-2 py-0.5 inline-block">{{ $perangkat->jabatan }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 mt-4">Data struktur pemerintahan belum diisi.</p>
            @endif
        </div>
    </div>
</div>
@endsection
