@extends('layouts.admin')
@section('page-title', 'Dashboard')

@section('admin-content')
<div class="space-y-6">

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        @php
            $cards = [
                [
                    'label' => 'Total Berita',
                    'value' => $stats['berita'],
                    'sub'   => $stats['berita_publish'] . ' terpublikasi',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
                ],
                [
                    'label' => 'Agenda',
                    'value' => $stats['agenda_mendatang'],
                    'sub'   => 'kegiatan mendatang',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                ],
                [
                    'label' => 'Banner Aktif',
                    'value' => $stats['banner_aktif'],
                    'sub'   => 'di halaman beranda',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
                ],
                [
                    'label' => 'Galeri Foto',
                    'value' => $stats['galeri_foto'],
                    'sub'   => 'foto diunggah',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>',
                ],
                [
                    'label' => 'Produk Hukum',
                    'value' => $stats['dokumen_hukum'],
                    'sub'   => 'dokumen tersedia',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                ],
                [
                    'label' => 'Layanan Desa',
                    'value' => $stats['layanan'],
                    'sub'   => 'layanan aktif',
                    'icon'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>',
                ],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="bg-white rounded-lg border border-gray-200 p-4">
            <div class="flex items-start justify-between mb-2">
                <p class="text-gray-500 text-xs font-medium uppercase tracking-wide leading-tight">{{ $card['label'] }}</p>
                <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $card['icon'] !!}
                </svg>
            </div>
            <p class="text-2xl font-bold text-blora-green-dark">{{ $card['value'] }}</p>
            <p class="text-gray-400 text-xs mt-0.5">{{ $card['sub'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Berita Terbaru --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <h2 class="font-semibold text-blora-green-dark">Berita Terbaru</h2>
                <a href="{{ route('admin.news.create') }}" class="btn-primary text-xs py-1.5 px-3">+ Tambah</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($berita_terbaru as $berita)
                <div class="p-4 flex items-start gap-3 hover:bg-gray-50">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $berita->judul }}</p>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="badge-kategori">{{ $berita->category->nama }}</span>
                            <span class="text-gray-400 text-xs">{{ $berita->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    <span class="flex-shrink-0 text-xs px-2 py-0.5 rounded-full {{ $berita->status === 'publish' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $berita->status === 'publish' ? 'Publish' : 'Draft' }}
                    </span>
                </div>
                @empty
                <p class="p-4 text-gray-400 text-sm">Belum ada berita.</p>
                @endforelse
            </div>
            <div class="p-3 border-t border-gray-100 text-center">
                <a href="{{ route('admin.news.index') }}" class="text-blora-blue text-xs hover:text-blora-green-dark">Lihat semua berita →</a>
            </div>
        </div>

        {{-- Agenda Mendatang --}}
        <div class="bg-white rounded-lg border border-gray-200">
            <div class="flex items-center justify-between p-4 border-b border-gray-100">
                <h2 class="font-semibold text-blora-green-dark">Agenda Mendatang</h2>
                <a href="{{ route('admin.agenda.create') }}" class="btn-primary text-xs py-1.5 px-3">+ Tambah</a>
            </div>
            <div class="divide-y divide-gray-50">
                @forelse($agenda_mendatang as $agenda)
                <div class="p-4 flex items-center gap-3 hover:bg-gray-50">
                    <div class="text-center bg-blora-green-dark rounded p-2 flex-shrink-0 min-w-12">
                        <p class="text-blora-gold font-bold text-lg leading-none">{{ $agenda->tanggal_mulai->format('d') }}</p>
                        <p class="text-green-300 text-xs">{{ $agenda->tanggal_mulai->translatedFormat('M') }}</p>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">{{ $agenda->judul }}</p>
                        @if($agenda->lokasi)
                        <p class="text-gray-400 text-xs mt-0.5 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            {{ $agenda->lokasi }}
                        </p>
                        @endif
                    </div>
                </div>
                @empty
                <p class="p-4 text-gray-400 text-sm">Tidak ada agenda mendatang.</p>
                @endforelse
            </div>
            <div class="p-3 border-t border-gray-100 text-center">
                <a href="{{ route('admin.agenda.index') }}" class="text-blora-blue text-xs hover:text-blora-green-dark">Lihat semua agenda →</a>
            </div>
        </div>
    </div>

    {{-- Quick Links --}}
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <h2 class="font-semibold text-blora-green-dark mb-4">Akses Cepat</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-3">
            @php
                $quickLinks = [
                    ['href' => route('admin.banner.create'),       'label' => 'Upload Banner'],
                    ['href' => route('admin.news.create'),         'label' => 'Tulis Berita'],
                    ['href' => route('admin.agenda.create'),       'label' => 'Tambah Agenda'],
                    ['href' => route('admin.galeri-foto.create'),  'label' => 'Upload Foto'],
                    ['href' => route('admin.hukum.create'),        'label' => 'Upload Dokumen'],
                    ['href' => route('admin.blangko.create'),      'label' => 'Upload Blangko'],
                ];
            @endphp
            @foreach($quickLinks as $link)
            <a href="{{ $link['href'] }}" class="block text-center p-3 rounded-lg bg-gray-50 hover:bg-blora-green-dark hover:text-white text-sm text-gray-700 font-medium transition-all border border-gray-200 hover:border-transparent">
                {{ $link['label'] }}
            </a>
            @endforeach
        </div>
    </div>

</div>
@endsection
