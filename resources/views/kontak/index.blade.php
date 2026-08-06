@extends('layouts.public')
@section('title', 'Kontak — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Kontak Kami</h1>
        <p class="text-green-200 mt-2">Hubungi Pemerintah Desa Sambongrejo</p>
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-12">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Info Kontak --}}
        <div>
            <h2 class="section-title">Informasi Kontak</h2>
            <span class="section-title-underline"></span>

            <div class="space-y-5 mt-4">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blora-green-dark rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-blora-green-dark">Alamat Kantor</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $profile?->alamat_kantor ?? 'Jl. Raya Sambongrejo, Kec. Tunjungan, Kab. Blora 58253' }}</p>
                    </div>
                </div>

                @if($profile?->telepon)
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blora-green-dark rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-blora-green-dark">Telepon</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $profile->telepon }}</p>
                    </div>
                </div>
                @endif

                @if($profile?->email)
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blora-green-dark rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-blora-green-dark">Email</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $profile->email }}</p>
                    </div>
                </div>
                @endif

                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-blora-green-dark rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-blora-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-blora-green-dark">Jam Pelayanan</p>
                        <p class="text-gray-600 text-sm mt-1">{{ $profile?->jam_pelayanan ?? 'Senin – Jumat: 08.00 – 15.00 WIB' }}</p>
                        <p class="text-gray-400 text-xs">{{ $profile?->jam_istirahat ?? 'Istirahat: 12.00 – 13.00 WIB' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Google Maps embed --}}
        <div>
            <h2 class="section-title">Lokasi Kantor Desa</h2>
            <span class="section-title-underline"></span>
            <div class="rounded-lg overflow-hidden border border-gray-200 mt-4" style="height: 320px;">
                @if($profile?->maps_embed_url)
                    {!! $profile->maps_embed_url !!}
                @else
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1981.88!2d111.35!3d-6.87!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwNTInMDQuMCJTIDExMcKwMjEnMDAuMCJF!5e0!3m2!1sid!2sid!4v1!5m2!1sid!2sid"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi Kantor Desa Sambongrejo"></iframe>
                @endif
            </div>
            <p class="text-gray-400 text-xs mt-2">* Koordinat peta disesuaikan dengan lokasi aktual desa.</p>
        </div>
    </div>
</div>
@endsection
