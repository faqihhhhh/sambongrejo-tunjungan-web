@extends('layouts.admin')
@section('page-title', 'Struktur Pemerintahan')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-blora-green-dark font-semibold text-lg">Struktur Pemerintahan</h2>
    <a href="{{ route('admin.struktur.create') }}" class="btn-primary">+ Tambah</a>
</div>
<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($items as $item)
    <div class="bg-white border border-gray-200 rounded-lg p-4 text-center hover:shadow-md transition-shadow" style="border-top: 3px solid var(--blora-gold);">
        @if($item->foto)
            <img src="{{ Storage::url($item->foto) }}" alt="{{ $item->nama }}" class="w-20 h-24 object-cover rounded mx-auto mb-2" style="border:2px solid var(--blora-gold);">
        @else
            <div class="w-20 h-24 bg-gray-100 rounded mx-auto mb-2 flex items-center justify-center" style="border:2px solid var(--blora-gold);"><svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
        @endif
        <p class="font-semibold text-blora-green-dark text-sm">{{ $item->nama }}</p>
        <p class="text-gray-500 text-xs mt-0.5">{{ $item->jabatan }}</p>
        <div class="flex justify-center gap-2 mt-2">
            <a href="{{ route('admin.struktur.edit', $item) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
            <form method="POST" action="{{ route('admin.struktur.destroy', $item) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
        </div>
    </div>
    @empty
    <div class="col-span-4 text-center py-12 text-gray-400">Belum ada data. <a href="{{ route('admin.struktur.create') }}" class="text-blora-blue">Tambah sekarang</a></div>
    @endforelse
</div>
@endsection
