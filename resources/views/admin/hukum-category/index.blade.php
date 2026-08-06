@extends('layouts.admin')
@section('page-title', 'Kategori Produk Hukum')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-blora-green-dark font-semibold text-lg">Kategori Produk Hukum</h2>
    <a href="{{ route('admin.hukum-category.create') }}" class="btn-primary">+ Tambah</a>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    @forelse($categories as $cat)
    <div class="bg-white border border-gray-200 rounded-lg p-4 flex items-center justify-between">
        <div><p class="font-semibold text-blora-green-dark">{{ $cat->nama }}</p><p class="text-gray-400 text-xs">{{ $cat->documents_count }} dokumen</p></div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.hukum-category.edit', $cat) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
            <form method="POST" action="{{ route('admin.hukum-category.destroy', $cat) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
        </div>
    </div>
    @empty
    <p class="col-span-2 text-center py-8 text-gray-400">Belum ada kategori.</p>
    @endforelse
</div>
@endsection
