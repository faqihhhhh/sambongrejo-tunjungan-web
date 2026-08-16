@extends('layouts.public')

@section('title', 'Beranda — Desa Sambongrejo')
@section('meta_description', 'Selamat datang di website resmi Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora.')

@section('content')

{{-- ═════════════════════════════════════════ --}}
{{-- BANNER SLIDER                             --}}
{{-- ═════════════════════════════════════════ --}}
<section class="slider-container relative bg-blora-green-dark" style="height: 480px; max-height: 60vh;">
    @if($banners->isNotEmpty())
        @foreach($banners as $i => $banner)
        <div class="slide {{ $i === 0 ? 'active' : '' }} h-full">
            <img src="{{ Storage::url($banner->gambar) }}"
                 alt="{{ $banner->judul ?? 'Banner Desa Sambongrejo' }}"
                 class="w-full h-full object-cover">
            {{-- Overlay hijau transparan agar teks terbaca --}}
            <div class="absolute inset-0" style="background: linear-gradient(to right, rgba(6,78,59,0.75) 0%, rgba(6,78,59,0.3) 60%, transparent 100%);"></div>
            @if($banner->judul)
            <div class="absolute bottom-0 left-0 p-8 sm:p-12">
                <h2 class="text-white text-2xl sm:text-4xl font-extrabold tracking-tight text-shadow-sm max-w-lg">{{ $banner->judul }}</h2>
            </div>
            @endif
        </div>
        @endforeach

        {{-- Slider Controls --}}
        @if($banners->count() > 1)
        <button onclick="changeSlide(-1)" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full w-10 h-10 flex items-center justify-center transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <button onclick="changeSlide(1)" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/30 hover:bg-black/50 text-white rounded-full w-10 h-10 flex items-center justify-center transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>

        {{-- Dots --}}
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
            @foreach($banners as $i => $banner)
            <button onclick="goToSlide({{ $i }})"
                    class="slider-dot w-2.5 h-2.5 rounded-full bg-white/50 transition-all {{ $i === 0 ? 'bg-blora-gold w-6' : '' }}"></button>
            @endforeach
        </div>
        @endif

    @else
        {{-- Fallback hero jika tidak ada banner --}}
        <div class="h-full flex items-center" style="background: linear-gradient(135deg, var(--blora-green-dark) 0%, var(--blora-green) 100%);">
            <div class="max-w-7xl mx-auto px-6 text-white">
                <p class="text-blora-gold text-sm font-bold uppercase tracking-widest mb-2">Website Resmi Pemerintah Desa</p>
                <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tight mb-4">Desa Sambongrejo</h2>
                <p class="text-green-200 text-lg">Kecamatan Tunjungan, Kabupaten Blora, Jawa Tengah</p>
            </div>
        </div>
    @endif
</section>

{{-- ═════════════════════════════════════════ --}}
{{-- MENU UTAMA (4 Poin)                       --}}
{{-- ═════════════════════════════════════════ --}}
<section class="bg-blora-green py-0">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-0 divide-x divide-y sm:divide-y-0 divide-green-700 border-x border-b sm:border-b-0 border-green-700">
            @php
                $quickAccess = [
                    [
                        'href' => route('layanan'),
                        'label' => 'Layanan',
                        'desc' => 'KTP, KK, SKCK',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>'
                    ],
                    [
                        'href' => route('apbdes'),
                        'label' => 'Data & Transparansi',
                        'desc' => 'Informasi Publik',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />'
                    ],
                    [
                        'href' => route('potensi.show', 'umkm'),
                        'label' => 'Potensi',
                        'desc' => 'UMKM, Wisata',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>'
                    ],
                    [
                        'href' => route('galeri'),
                        'label' => 'Galeri',
                        'desc' => 'Foto & Video',
                        'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'
                    ],
                ];
            @endphp

            @foreach($quickAccess as $item)
            <a href="{{ $item['href'] }}" 
               class="flex flex-col items-center justify-center py-4 px-2 text-white hover:bg-blora-green-dark transition-colors text-center group">
                <svg class="w-6 h-6 sm:w-8 sm:h-8 mb-1 sm:mb-2 text-green-200 group-hover:text-blora-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $item['icon'] !!}
                </svg>
                <span class="text-xs sm:text-sm font-semibold text-green-100 group-hover:text-blora-gold transition-colors">{{ $item['label'] }}</span>
                <span class="text-[10px] sm:text-xs text-green-200 group-hover:text-blora-gold opacity-80 mt-0.5">{{ $item['desc'] }}</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ═════════════════════════════════════════ --}}
{{-- SAMBUTAN KADES                            --}}
{{-- ═════════════════════════════════════════ --}}
@if($profile)
<section class="py-12 bg-blora-cream">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex flex-col md:flex-row items-start gap-8">
            {{-- Foto Kades --}}
            <div class="flex-shrink-0 text-center md:text-left">
                @if($profile->foto_kades)
                <img src="{{ Storage::url($profile->foto_kades) }}"
                     alt="{{ $profile->nama_kades }}"
                     class="w-36 h-44 object-cover rounded-lg mx-auto md:mx-0"
                     style="border: 3px solid var(--blora-gold); box-shadow: 4px 4px 0 var(--blora-green-dark);">
                @else
                <div class="w-36 h-44 bg-gray-200 rounded-lg flex items-center justify-center mx-auto md:mx-0" style="border: 3px solid var(--blora-gold);">
                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                @endif
                <div class="mt-3">
                    <p class="font-semibold text-blora-green-dark font-serif">{{ $profile->nama_kades }}</p>
                    <p class="text-sm text-gray-500">{{ $profile->jabatan_kades }}</p>
                    <p class="text-xs text-gray-400">Desa Sambongrejo</p>
                </div>
            </div>

            {{-- Sambutan --}}
            <div class="flex-1">
                <p class="text-blora-gold text-xs font-semibold uppercase tracking-widest mb-1">Sambutan</p>
                <h2 class="section-title mb-0">Kepala Desa Sambongrejo</h2>
                <span class="section-title-underline"></span>
                <div class="text-gray-700 leading-relaxed text-base italic border-l-4 border-blora-gold pl-4 py-2 bg-white rounded-r shadow-sm">
                    {!! $profile->sambutan_singkat ?? '<p>Selamat datang di website resmi Desa Sambongrejo. Website ini merupakan sarana informasi dan pelayanan bagi seluruh warga Desa Sambongrejo.</p>' !!}
                </div>
                <a href="{{ route('profil') }}" class="btn-secondary mt-4 inline-flex">
                    Baca Selengkapnya
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ═════════════════════════════════════════ --}}
{{-- BERITA TERBARU                            --}}
{{-- ═════════════════════════════════════════ --}}
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="text-blora-gold text-xs font-semibold uppercase tracking-widest mb-1">Informasi</p>
                <h2 class="section-title mb-0">Berita Terbaru</h2>
                <span class="section-title-underline"></span>
            </div>
            <a href="{{ route('berita') }}" class="text-blora-blue text-sm hover:text-blora-green-dark transition-colors font-semibold hidden sm:block">
                Semua Berita →
            </a>
        </div>

        @if($beritaTerbaru->isNotEmpty())
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            {{-- Berita utama (besar) --}}
            @php $utama = $beritaTerbaru->first(); @endphp
            <div class="lg:col-span-2">
                <a href="{{ route('berita.show', $utama->slug) }}" class="card-berita block group">
                    <div class="aspect-video overflow-hidden bg-gray-100">
                        @if($utama->foto)
                            <img src="{{ Storage::url($utama->foto) }}"
                                 alt="{{ $utama->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blora-green to-blora-green-dark flex items-center justify-center">
                                <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <span class="badge-kategori">{{ $utama->category->nama }}</span>
                        <h3 class="font-serif text-blora-green-dark text-xl font-semibold mt-2 mb-2 group-hover:text-blora-green transition-colors line-clamp-2">{{ $utama->judul }}</h3>
                        <p class="text-gray-500 text-sm">{{ \Illuminate\Support\Str::limit(strip_tags($utama->isi), 120) }}</p>
                        <p class="text-gray-400 text-xs mt-3">{{ $utama->tanggal_publish?->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
            </div>

            {{-- 3 Berita samping (kecil) --}}
            <div class="flex flex-col gap-4">
                @foreach($beritaTerbaru->skip(1) as $berita)
                <a href="{{ route('berita.show', $berita->slug) }}" class="card-berita flex gap-3 group p-3">
                    <div class="w-24 h-20 flex-shrink-0 overflow-hidden rounded bg-gray-100">
                        @if($berita->foto)
                            <img src="{{ Storage::url($berita->foto) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blora-green to-blora-green-dark"></div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="badge-kategori text-xs">{{ $berita->category->nama }}</span>
                        <h4 class="text-blora-text font-semibold text-sm mt-1 line-clamp-2 group-hover:text-blora-green-dark transition-colors">{{ $berita->judul }}</h4>
                        <p class="text-gray-400 text-xs mt-1">{{ $berita->tanggal_publish?->translatedFormat('d F Y') }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <div class="mt-5 text-center sm:hidden">
            <a href="{{ route('berita') }}" class="btn-secondary">Semua Berita</a>
        </div>
        @else
        <div class="text-center py-12 text-gray-400">
            <p>Belum ada berita yang dipublikasikan.</p>
        </div>
        @endif
    </div>
</section>

{{-- ═════════════════════════════════════════ --}}
{{-- AGENDA MENDATANG                          --}}
{{-- ═════════════════════════════════════════ --}}
@if($agendas->isNotEmpty())
<section class="py-12" style="background-color: var(--blora-cream);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6">
        <div class="flex items-end justify-between mb-6">
            <div>
                <p class="text-blora-gold text-xs font-semibold uppercase tracking-widest mb-1">Kegiatan</p>
                <h2 class="section-title mb-0">Agenda Mendatang</h2>
                <span class="section-title-underline"></span>
            </div>
            <a href="{{ route('agenda') }}" class="text-blora-blue text-sm hover:text-blora-green-dark font-semibold hidden sm:block">Semua Agenda →</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach($agendas as $agenda)
            <div class="bg-white rounded-lg p-4 flex gap-4 items-start" style="border-left: 4px solid var(--blora-gold);">
                <div class="text-center flex-shrink-0 bg-blora-green-dark rounded p-2 min-w-12">
                    <span class="block text-2xl font-bold text-blora-gold leading-none">{{ $agenda->tanggal_mulai->format('d') }}</span>
                    <span class="block text-green-300 text-xs uppercase">{{ $agenda->tanggal_mulai->translatedFormat('M') }}</span>
                </div>
                <div class="min-w-0">
                    <h4 class="font-semibold text-blora-green-dark text-sm leading-snug line-clamp-2">{{ $agenda->judul }}</h4>
                    @if($agenda->lokasi)
                    <p class="text-gray-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
                        {{ $agenda->lokasi }}
                    </p>
                    @endif
                    @if($agenda->jam_mulai)
                    <p class="text-gray-400 text-xs mt-0.5">{{ \Carbon\Carbon::parse($agenda->jam_mulai)->format('H:i') }} WIB</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif



@endsection

@push('scripts')
<script>
    // ─── Banner Slider ───────────────────────────
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide');
    const dots   = document.querySelectorAll('.slider-dot');

    function updateSlider() {
        slides.forEach((s, i) => s.classList.toggle('active', i === currentSlide));
        if (dots.length) {
            dots.forEach((d, i) => {
                d.classList.toggle('bg-blora-gold', i === currentSlide);
                d.classList.toggle('w-6', i === currentSlide);
                d.classList.toggle('bg-white/50', i !== currentSlide);
                d.classList.toggle('w-2.5', i !== currentSlide);
            });
        }
    }

    function changeSlide(dir) {
        currentSlide = (currentSlide + dir + slides.length) % slides.length;
        updateSlider();
    }

    function goToSlide(n) {
        currentSlide = n;
        updateSlider();
    }

    // Auto-slide setiap 5 detik
    if (slides.length > 1) {
        setInterval(() => changeSlide(1), 5000);
    }
</script>
@endpush
