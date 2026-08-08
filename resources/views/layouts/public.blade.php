<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Sambongrejo') — Kec. Tunjungan, Kab. Blora</title>
    
    {{-- Google Site Verification --}}
    <meta name="google-site-verification" content="ULrJ9fnY9qQIP5k9eu7TnpfOCTrQgIhGfj1bAhxoRo0" />

    {{-- SEO & Meta Tags --}}
    <meta name="description" content="@yield('meta_description', 'Website resmi Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora, Jawa Tengah. Pusat informasi pelayanan, potensi desa, dan berita terbaru.')">
    <meta name="keywords" content="Desa Sambongrejo, Sambongrejo Tunjungan, Blora, Desa Blora, Website Desa">
    <meta name="author" content="Pemerintah Desa Sambongrejo">

    {{-- Open Graph (WhatsApp, Facebook, dsb) --}}
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Desa Sambongrejo — Kec. Tunjungan, Kab. Blora')">
    <meta property="og:description" content="@yield('meta_description', 'Website resmi Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora, Jawa Tengah.')">
    <meta property="og:image" content="@yield('meta_image', asset('images/logo-blora.png'))">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', 'Desa Sambongrejo — Kec. Tunjungan, Kab. Blora')">
    <meta name="twitter:description" content="@yield('meta_description', 'Website resmi Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora, Jawa Tengah.')">
    <meta name="twitter:image" content="@yield('meta_image', asset('images/logo-blora.png'))">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="bg-blora-cream text-blora-text font-sans">

    {{-- ═══════════════════════════════════════ --}}
    {{-- HEADER PEMERINTAHAN                     --}}
    {{-- ═══════════════════════════════════════ --}}
    <header class="header-gov">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-2 sm:py-3">
            <div class="flex items-center gap-2 sm:gap-4">
                {{-- Logo Kab. Blora --}}
                <img src="{{ asset('images/logo-blora.png') }}"
                     alt="Logo Kabupaten Blora"
                     class="h-8 w-8 sm:h-16 sm:w-16 object-contain flex-shrink-0"
                     onerror="this.style.display='none'">

                {{-- Divider --}}
                <div class="h-6 sm:h-12 w-px bg-green-500 hidden sm:block"></div>

                {{-- Logo Desa --}}
                <img src="{{ asset('images/logo-desa.png') }}"
                     alt="Logo Desa Sambongrejo"
                     class="h-8 w-8 sm:h-14 sm:w-14 object-contain flex-shrink-0"
                     onerror="this.style.display='none'">

                {{-- Nama Instansi --}}
                <div>
                    <p class="text-green-300 text-xs uppercase tracking-widest font-semibold leading-none hidden sm:block">Pemerintah Desa</p>
                    <h1 class="text-white font-serif text-lg sm:text-2xl font-bold leading-tight">Desa Sambongrejo</h1>
                    <p class="text-green-200 text-[10px] sm:text-xs mt-0.5">Kec. Tunjungan, Kab. Blora</p>
                </div>

                {{-- PPID Button (kanan) --}}
                <div class="ml-auto hidden md:block">
                    <a href="{{ route('ppid') }}"
                       class="inline-flex items-center gap-2 px-4 py-2 border border-blora-gold text-blora-gold text-sm font-semibold rounded hover:bg-blora-gold hover:text-white transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        PPID
                    </a>
                </div>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════════════ --}}
    {{-- NAVBAR                                  --}}
    {{-- ═══════════════════════════════════════ --}}
    <nav class="bg-blora-green sticky top-0 z-50 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-12">
                {{-- Desktop Menu --}}
                <ul class="hidden md:flex items-center gap-0 h-full text-sm">
                    @php
                        $navLinks = [
                            ['href' => route('home'),        'label' => 'Beranda'],
                            ['href' => route('profil'),      'label' => 'Profil Desa',     'sub' => [
                                ['href' => route('profil'),           'label' => 'Sambutan Kades'],
                                ['href' => route('profil.sejarah'),   'label' => 'Sejarah Desa'],
                                ['href' => route('profil.visimisi'),  'label' => 'Visi & Misi'],
                                ['href' => route('profil.struktur'),  'label' => 'Struktur Pemerintahan'],
                            ]],
                            ['href' => '#', 'label' => 'Transparansi & Data', 'sub' => [
                                ['href' => route('apbdes'), 'label' => 'Transparansi APBDes'],
                                ['href' => route('idm'), 'label' => 'Status IDM'],
                                ['href' => route('statistik'), 'label' => 'Statistik Penduduk'],
                            ]],
                            ['href' => route('potensi.show', 'umkm'), 'label' => 'Potensi Desa'],
                            ['href' => route('berita'),      'label' => 'Berita'],
                            ['href' => route('agenda'),      'label' => 'Agenda'],
                            ['href' => route('hukum'),       'label' => 'Produk Hukum'],
                            ['href' => '#', 'label' => 'Layanan', 'sub' => [
                                ['href' => route('layanan'), 'label' => 'Panduan Layanan'],
                                ['href' => route('unduhan'), 'label' => 'Unduhan Blangko'],
                            ]],
                            ['href' => route('galeri'),      'label' => 'Galeri'],
                            ['href' => route('kontak'),      'label' => 'Kontak'],
                        ];
                    @endphp

                    @foreach($navLinks as $link)
                        @php
                            $isActive = false;
                            if (isset($link['sub'])) {
                                foreach ($link['sub'] as $sub) {
                                    $subPath = ltrim(parse_url($sub['href'], PHP_URL_PATH), '/');
                                    if ($subPath !== '' && request()->is($subPath . '*')) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            } else {
                                if ($link['href'] === route('home')) {
                                    $isActive = request()->is('/');
                                } else {
                                    $path = ltrim(parse_url($link['href'], PHP_URL_PATH), '/');
                                    $isActive = $path !== '' && request()->is($path . '*');
                                }
                            }
                        @endphp
                        @if(isset($link['sub']))
                            <li class="relative group h-full flex items-center">
                                <a href="{{ $link['href'] }}"
                                   class="flex items-center gap-1 px-3 h-full text-white hover:bg-blora-green-dark transition-colors {{ $isActive ? 'bg-blora-green-dark border-b-2 border-blora-gold' : '' }}">
                                    {{ $link['label'] }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </a>
                                <div class="absolute top-full left-0 bg-white border border-gray-100 shadow-lg rounded-b-md min-w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
                                    @foreach($link['sub'] as $sub)
                                        <a href="{{ $sub['href'] }}" class="block px-4 py-2.5 text-blora-text text-sm hover:bg-green-50 hover:text-blora-green-dark border-l-2 border-transparent hover:border-blora-gold transition-all">
                                            {{ $sub['label'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="h-full flex items-center">
                                <a href="{{ $link['href'] }}"
                                   class="px-3 h-full flex items-center text-white hover:bg-blora-green-dark transition-colors {{ $isActive ? 'bg-blora-green-dark border-b-2 border-blora-gold' : '' }}">
                                    {{ $link['label'] }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>

                {{-- Mobile Hamburger --}}
                <button id="mobile-menu-btn" class="md:hidden text-white p-2 rounded hover:bg-blora-green-dark">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>


            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden bg-blora-green-dark border-t border-green-700">
            <div class="px-4 py-3 space-y-0.5">
                {{-- Beranda --}}
                <a href="{{ route('home') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('/') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Beranda</a>

                {{-- Profil Desa (collapsible) --}}
                <div>
                    <button onclick="toggleMobileSubmenu('submenu-profil', this)"
                        class="w-full flex items-center justify-between py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('profil*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">
                        <span>Profil Desa</span>
                        <svg id="arrow-profil" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="submenu-profil" class="max-h-0 overflow-hidden transition-all duration-300 pl-3 space-y-0.5 border-l-2 border-green-600 ml-3">
                        <a href="{{ route('profil') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mt-1">Sambutan Kades</a>
                        <a href="{{ route('profil.sejarah') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white">Sejarah Desa</a>
                        <a href="{{ route('profil.visimisi') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white">Visi &amp; Misi</a>
                        <a href="{{ route('profil.struktur') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mb-1">Struktur Pemerintahan</a>
                    </div>
                </div>

                <a href="{{ route('potensi.show', 'umkm') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('potensi*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Potensi Desa</a>
                <a href="{{ route('berita') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('berita*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Berita</a>
                <a href="{{ route('agenda') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('agenda*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Agenda</a>

                <div class="border-t border-green-700 my-1.5"></div>

                {{-- Transparansi & Data (collapsible) --}}
                <div>
                    <button onclick="toggleMobileSubmenu('submenu-transparansi', this)"
                        class="w-full flex items-center justify-between py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('apbdes*') || request()->is('idm*') || request()->is('statistik*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">
                        <span>Transparansi &amp; Data</span>
                        <svg id="arrow-transparansi" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="submenu-transparansi" class="max-h-0 overflow-hidden transition-all duration-300 pl-3 space-y-0.5 border-l-2 border-green-600 ml-3">
                        <a href="{{ route('apbdes') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mt-1">Transparansi APBDes</a>
                        <a href="{{ route('idm') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white">Status IDM</a>
                        <a href="{{ route('statistik') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mb-1">Statistik Penduduk</a>
                    </div>
                </div>

                <a href="{{ route('hukum') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('produk-hukum*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Produk Hukum</a>
                
                {{-- Layanan (collapsible) --}}
                <div>
                    <button onclick="toggleMobileSubmenu('submenu-layanan', this)"
                        class="w-full flex items-center justify-between py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('layanan*') || request()->is('unduhan*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">
                        <span>Layanan</span>
                        <svg id="arrow-layanan" class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="submenu-layanan" class="max-h-0 overflow-hidden transition-all duration-300 pl-3 space-y-0.5 border-l-2 border-green-600 ml-3">
                        <a href="{{ route('layanan') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mt-1">Panduan Layanan</a>
                        <a href="{{ route('unduhan') }}" class="block py-2 px-2 text-green-200 text-sm hover:text-white mb-1">Unduhan Blangko</a>
                    </div>
                </div>

                <a href="{{ route('ppid') }}" class="flex items-center py-2.5 px-3 rounded text-blora-gold text-sm font-semibold hover:bg-blora-green transition-colors {{ request()->is('ppid*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">PPID</a>
                <a href="{{ route('galeri') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('galeri*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Galeri</a>
                <a href="{{ route('kontak') }}" class="flex items-center py-2.5 px-3 rounded text-white text-sm font-medium hover:bg-blora-green transition-colors {{ request()->is('kontak*') ? 'bg-blora-green border-l-4 border-blora-gold' : '' }}">Kontak</a>
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════ --}}
    {{-- RUNNING TEXT                            --}}
    {{-- ═══════════════════════════════════════ --}}
    @php $runningTexts = \App\Models\RunningText::where('aktif', true)->orderBy('urutan')->get(); @endphp
    @if($runningTexts->isNotEmpty())
    <div class="running-text-wrapper overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 flex items-center gap-3">
            <span class="flex-shrink-0 text-blora-gold font-semibold text-xs uppercase tracking-wide">INFO :</span>
            <div class="overflow-hidden flex-1">
                <div class="marquee-track">
                    @foreach($runningTexts as $rt)
                        <span class="mr-16">{{ $rt->teks }}</span>
                    @endforeach
                    {{-- Duplicate for seamless loop --}}
                    @foreach($runningTexts as $rt)
                        <span class="mr-16">{{ $rt->teks }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- ═══════════════════════════════════════ --}}
    {{-- MAIN CONTENT                            --}}
    {{-- ═══════════════════════════════════════ --}}
    <main>
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════ --}}
    {{-- FOOTER                                  --}}
    {{-- ═══════════════════════════════════════ --}}
    <footer class="site-footer mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Kolom 1: Identitas --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('images/logo-blora.png') }}" alt="Logo" class="h-12 object-contain" onerror="this.style.display='none'">
                        <div>
                            <p class="text-white font-serif font-bold leading-tight">Desa Sambongrejo</p>
                            <p class="text-green-300 text-xs">Kec. Tunjungan, Kab. Blora</p>
                        </div>
                    </div>
                    <p class="text-green-200 text-sm leading-relaxed">
                        Website resmi Pemerintah Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora, Jawa Tengah.
                    </p>
                </div>

                {{-- Kolom 2: Tautan Cepat --}}
                <div>
                    <h3 class="text-blora-gold font-semibold text-sm uppercase tracking-wide mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('profil') }}" class="text-green-200 hover:text-blora-gold transition-colors">Profil Desa</a></li>
                        <li><a href="{{ route('berita') }}" class="text-green-200 hover:text-blora-gold transition-colors">Berita Desa</a></li>
                        <li><a href="{{ route('layanan') }}" class="text-green-200 hover:text-blora-gold transition-colors">Layanan Masyarakat</a></li>
                        <li><a href="{{ route('ppid') }}" class="text-green-200 hover:text-blora-gold transition-colors">PPID</a></li>
                        <li><a href="{{ route('hukum') }}" class="text-green-200 hover:text-blora-gold transition-colors">Produk Hukum</a></li>
                        <li><a href="{{ route('unduhan') }}" class="text-green-200 hover:text-blora-gold transition-colors">Unduhan/Blangko</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak --}}
                <div>
                    <h3 class="text-blora-gold font-semibold text-sm uppercase tracking-wide mb-4">Kontak</h3>
                    @php $footerProfile = \App\Models\Profile::first(); @endphp
                    <address class="not-italic text-green-200 text-sm space-y-2">
                        @if($footerProfile?->alamat_kantor)
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 text-blora-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $footerProfile->alamat_kantor }}
                            </p>
                        @else
                            <p class="flex items-start gap-2">
                                <svg class="w-4 h-4 mt-0.5 text-blora-gold flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                Jl. Raya Sambongrejo, Kec. Tunjungan, Blora 58253
                            </p>
                        @endif
                        @if($footerProfile?->telepon)
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $footerProfile->telepon }}
                            </p>
                        @endif
                        @if($footerProfile?->email)
                            <p class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $footerProfile->email }}
                            </p>
                        @endif
                    </address>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-green-700 py-4">
            <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-green-300">
                <p>&copy; {{ date('Y') }} Pemerintah Desa Sambongrejo. Hak cipta dilindungi.</p>
                <p>Website Resmi Desa — <a href="{{ route('link-terkait') }}" class="hover:text-blora-gold transition-colors">Tautan Terkait</a></p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.getElementById('menu-icon');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            if(mobileMenu.classList.contains('hidden')) {
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16'); // Hamburger
            } else {
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12'); // Close
            }
        });

        // Mobile Submenu Toggle
        function toggleMobileSubmenu(id, btn) {
            const submenu = document.getElementById(id);
            const arrow = btn.querySelector('svg');
            
            if (submenu.style.maxHeight && submenu.style.maxHeight !== '0px') {
                submenu.style.maxHeight = '0px';
                arrow.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.maxHeight = submenu.scrollHeight + "px";
                arrow.style.transform = 'rotate(180deg)';
            }
        }
        
        // Ensure active menus are opened automatically on load
        document.addEventListener('DOMContentLoaded', () => {
            const activeMobileMenus = document.querySelectorAll('.bg-blora-green.border-l-4');
            activeMobileMenus.forEach(btn => {
                const svg = btn.querySelector('svg');
                if (svg) {
                    const id = btn.getAttribute('onclick')?.match(/'([^']+)'/)?.[1];
                    if (id) {
                        const submenu = document.getElementById(id);
                        if (submenu) {
                            submenu.style.maxHeight = submenu.scrollHeight + "px";
                            svg.style.transform = 'rotate(180deg)';
                        }
                    }
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
