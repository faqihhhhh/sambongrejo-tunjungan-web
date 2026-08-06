@extends('layouts.public')
@section('title', 'Agenda Kegiatan — Desa Sambongrejo')
@section('content')
<div class="page-hero"><div class="max-w-7xl mx-auto px-6 text-center">
    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Agenda Kegiatan</h1>
    <p class="text-green-200 mt-2">Jadwal kegiatan Desa Sambongrejo</p>
</div></div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    @forelse($agendas as $agenda)
    <div class="bg-white border border-gray-100 shadow-sm rounded-xl p-5 mb-4 flex gap-6 hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
        <div class="text-center flex-shrink-0 flex flex-col items-center justify-center min-w-16 border-r border-gray-100 pr-6">
            <span class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-1.5">{{ $agenda->tanggal_mulai->translatedFormat('M Y') }}</span>
            <span class="block text-4xl font-extrabold text-blora-text leading-none">{{ $agenda->tanggal_mulai->format('d') }}</span>
        </div>
        <div class="flex-1">
            <h3 class="font-serif font-semibold text-blora-green-dark text-lg">{{ $agenda->judul }}</h3>
            <div class="flex flex-wrap gap-3 mt-1 text-sm text-gray-500">
                @if($agenda->lokasi) <span class="flex items-center gap-1"><svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>{{ $agenda->lokasi }}</span> @endif
                @if($agenda->jam_mulai) <span class="flex items-center gap-1"><svg class="w-3 h-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>{{ \Carbon\Carbon::parse($agenda->jam_mulai)->format('H:i') }} WIB</span> @endif
                @if($agenda->tanggal_selesai && $agenda->tanggal_selesai != $agenda->tanggal_mulai)
                    <span>s/d {{ $agenda->tanggal_selesai->translatedFormat('d F Y') }}</span>
                @endif
            </div>
            @if($agenda->deskripsi) <p class="text-gray-600 text-sm mt-2">{{ $agenda->deskripsi }}</p> @endif
        </div>
    </div>
    @empty
    <div class="text-center py-16 text-gray-400"><p>Belum ada agenda yang terdaftar.</p></div>
    @endforelse
    @if($agendas->hasPages()) <div class="mt-6">{{ $agendas->links() }}</div> @endif
</div>
@endsection
