@extends('layouts.public')
@section('title', 'Profil Desa Sambongrejo')

@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-blora-gold text-xs font-semibold uppercase tracking-widest mb-2">Pemerintah Desa Sambongrejo</p>
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Profil Desa</h1>
        <p class="text-green-200 mt-2">Mengenal lebih dekat Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="flex flex-col md:flex-row gap-8">
        {{-- Sidebar sub-navigasi --}}
        <aside class="md:w-56 flex-shrink-0">
            <nav class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="bg-blora-green-dark text-blora-gold text-xs font-semibold uppercase tracking-wide px-4 py-2.5">
                    Menu Profil
                </div>
                @foreach([
                    ['href' => route('profil'),          'label' => 'Sambutan Kades'],
                    ['href' => route('profil.sejarah'),  'label' => 'Sejarah Desa'],
                    ['href' => route('profil.visimisi'), 'label' => 'Visi & Misi'],
                    ['href' => route('profil.struktur'), 'label' => 'Struktur Pemerintahan'],
                ] as $link)
                <a href="{{ $link['href'] }}"
                   class="flex items-center gap-2 px-4 py-2.5 text-sm border-l-2 transition-all
                   {{ request()->url() === $link['href'] ? 'border-blora-gold bg-yellow-50 text-blora-green-dark font-semibold' : 'border-transparent text-gray-600 hover:border-blora-gold hover:text-blora-green-dark hover:bg-green-50' }}">
                    {{ $link['label'] }}
                </a>
                @endforeach
            </nav>
        </aside>

        {{-- Content --}}
        <div class="flex-1 min-w-0">
            @if($profile)
            <div class="flex flex-col sm:flex-row gap-6 items-start">
                @if($profile->foto_kades)
                <div class="flex-shrink-0 text-center">
                    <img src="{{ Storage::url($profile->foto_kades) }}" alt="{{ $profile->nama_kades }}"
                         class="w-40 h-52 object-cover rounded-lg"
                         style="border: 3px solid var(--blora-gold); box-shadow: 4px 4px 0 var(--blora-green-dark);">
                    <p class="font-semibold text-blora-green-dark font-serif mt-3">{{ $profile->nama_kades }}</p>
                    <p class="text-sm text-gray-500">{{ $profile->jabatan_kades }}</p>
                </div>
                @endif

                <div class="flex-1">
                    <h2 class="section-title">Sambutan Kepala Desa</h2>
                    <span class="section-title-underline"></span>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        {!! $profile->sambutan_lengkap ?? '<p>Konten sambutan belum diisi.</p>' !!}
                    </div>
                </div>
            </div>

            {{-- Info Singkat Desa --}}
            <div class="mt-10 bg-blora-green-dark rounded-lg p-6 text-white">
                <h3 class="font-serif text-blora-gold text-lg font-semibold mb-4">Data Singkat Desa</h3>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm">
                    @foreach([
                        ['label' => 'Luas Wilayah',   'value' => $profile->luas_wilayah ?? '-'],
                        ['label' => 'Jumlah Penduduk', 'value' => $profile->jumlah_penduduk ?? '-'],
                        ['label' => 'Jumlah KK',       'value' => $profile->jumlah_kk ?? '-'],
                        ['label' => 'Kode Pos',        'value' => $profile->kode_pos ?? '-'],
                        ['label' => 'Telepon',         'value' => $profile->telepon ?? '-'],
                        ['label' => 'Email',           'value' => $profile->email ?? '-'],
                    ] as $info)
                    <div>
                        <p class="text-green-300 text-xs">{{ $info['label'] }}</p>
                        <p class="text-white font-semibold mt-0.5">{{ $info['value'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-16 text-gray-400">
                <p>Data profil belum diisi. Silakan login ke panel admin untuk mengisi profil desa.</p>
                <a href="{{ route('login') }}" class="btn-primary mt-4">Login Admin</a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
