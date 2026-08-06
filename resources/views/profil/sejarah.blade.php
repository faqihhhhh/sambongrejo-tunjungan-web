@extends('layouts.public')
@section('title', 'Sejarah Desa Sambongrejo')
@section('content')
<div class="page-hero"><div class="max-w-7xl mx-auto px-6 text-center">
    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Sejarah Desa</h1>
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
            <h2 class="section-title">Sejarah Desa Sambongrejo</h2>
            <span class="section-title-underline"></span>
            @if($profile?->sejarah)
            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">{!! $profile->sejarah !!}</div>
            @else
            <p class="text-gray-400">Data sejarah desa belum diisi.</p>
            @endif
        </div>
    </div>
</div>
@endsection
