@extends('layouts.admin')
@section('page-title', 'Galeri Foto')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div><h2 class="text-blora-green-dark font-semibold text-lg">Galeri Foto</h2><p class="text-gray-500 text-sm">Total: {{ $fotos->total() }} foto</p></div>
    <a href="{{ route('admin.galeri-foto.create') }}" class="btn-primary">+ Upload Foto</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
    @forelse($fotos as $foto)
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden group hover:shadow-md transition-shadow">
        <div class="aspect-square overflow-hidden bg-gray-50">
            <img src="{{ Storage::url($foto->file) }}" alt="{{ $foto->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
        </div>
        <div class="p-3">
            <p class="text-sm font-medium text-blora-green-dark line-clamp-1">{{ $foto->judul }}</p>
            @if($foto->tanggal)<p class="text-gray-400 text-xs mt-0.5">{{ $foto->tanggal->format('d/m/Y') }}</p>@endif
            <div class="flex gap-2 mt-2">
                <a href="{{ route('admin.galeri-foto.edit', $foto) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                <form method="POST" action="{{ route('admin.galeri-foto.destroy', $foto) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-12 text-gray-400">Belum ada foto. <a href="{{ route('admin.galeri-foto.create') }}" class="text-blora-blue">Upload sekarang</a></div>
    @endforelse
</div>
@if($fotos->hasPages())<div class="mt-6">{{ $fotos->links() }}</div>@endif
@endsection
