@extends('layouts.public')
@section('title', $category->nama . ' — Produk Hukum Desa Sambongrejo')
@section('content')
<div class="page-hero">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="text-green-300 text-sm mb-3"><a href="{{ route('hukum') }}" class="hover:text-white">Produk Hukum</a> › {{ $category->nama }}</nav>
        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-white">{{ $category->nama }}</h1>
    </div>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 py-6 md:py-10">
    <div class="flex flex-wrap gap-2 mb-6">
        @foreach($categories as $cat)
        <a href="{{ route('hukum.kategori', $cat->id) }}"
           class="px-4 py-1.5 rounded-full text-sm border transition-all {{ $cat->id === $category->id ? 'bg-blora-green-dark text-white border-blora-green-dark' : 'text-gray-600 border-gray-300 hover:border-blora-green-dark' }}">
            {{ $cat->nama }}
        </a>
        @endforeach
    </div>
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <table class="table-gov">
            <thead><tr><th>#</th><th>Judul</th><th>No. Dokumen</th><th>Tanggal</th><th>Unduh</th></tr></thead>
            <tbody>
                @forelse($documents as $i => $doc)
                <tr>
                    <td class="text-gray-400 text-center">{{ ($documents->currentPage()-1)*$documents->perPage()+$i+1 }}</td>
                    <td class="font-medium text-blora-green-dark">{{ $doc->judul }}</td>
                    <td class="text-gray-500">{{ $doc->nomor_dokumen ?? '-' }}</td>
                    <td class="text-gray-500 whitespace-nowrap">{{ $doc->tanggal->translatedFormat('d M Y') }}</td>
                    <td><a href="{{ Storage::url($doc->file_pdf) }}" target="_blank" class="inline-flex items-center gap-1 px-3 py-1 bg-blora-green-dark text-white text-xs rounded hover:bg-blora-green transition-colors"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg> PDF</a></td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada dokumen.</td></tr>
                @endforelse
            </tbody>
        </table>
        @if($documents->hasPages())<div class="p-4 border-t">{{ $documents->links() }}</div>@endif
    </div>
</div>
@endsection
