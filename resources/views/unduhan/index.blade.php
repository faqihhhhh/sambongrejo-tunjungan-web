@extends('layouts.public')
@section('title', 'Unduhan & Blangko — Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold text-white">Unduhan & Blangko</h1>
        <p class="text-green-200 mt-2">Formulir dan blanko administrasi yang dapat diunduh</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="flex items-start gap-3 bg-green-50 border border-green-200 rounded-lg p-4 mb-8 text-sm text-green-800">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span>Unduh formulir yang dibutuhkan, isi dengan lengkap, dan bawa ke kantor desa.</span>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <table class="table-gov">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Blangko / Formulir</th>
                    <th>Keterangan</th>
                    <th>Ukuran</th>
                    <th>Unduh</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blangkos as $i => $blangko)
                <tr>
                    <td class="text-gray-400 text-center">{{ ($blangkos->currentPage()-1)*$blangkos->perPage()+$i+1 }}</td>
                    <td class="font-medium text-blora-green-dark">{{ $blangko->nama }}</td>
                    <td class="text-gray-500 text-sm">{{ $blangko->keterangan ?? '-' }}</td>
                    <td class="text-gray-400 text-sm whitespace-nowrap">{{ $blangko->ukuran_file ?? '-' }}</td>
                    <td>
                        <a href="{{ Storage::url($blangko->file) }}"
                           target="_blank"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blora-green text-white text-xs font-semibold rounded hover:bg-blora-green-dark transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                            Unduh
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 md:py-10 text-gray-400">
                        Belum ada file blangko yang tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @if($blangkos->hasPages())
        <div class="p-4 border-t border-gray-100">{{ $blangkos->links() }}</div>
        @endif
    </div>
</div>
@endsection
