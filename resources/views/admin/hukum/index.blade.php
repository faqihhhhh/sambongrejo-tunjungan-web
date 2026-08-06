@extends('layouts.admin')
@section('page-title', 'Produk Hukum')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div><h2 class="text-blora-green-dark font-semibold text-lg">Produk Hukum Desa</h2></div>
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.hukum-category.index') }}" class="btn-secondary text-sm">Kelola Kategori</a>
        <a href="{{ route('admin.hukum.create') }}" class="btn-primary">+ Upload Dokumen</a>
    </div>
</div>
<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
    <table class="table-gov">
        <thead><tr><th>Judul</th><th>Kategori</th><th>No. Dokumen</th><th>Tanggal</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($documents as $doc)
            <tr>
                <td class="font-medium text-blora-green-dark max-w-xs"><p class="truncate">{{ $doc->judul }}</p></td>
                <td><span class="badge-kategori">{{ $doc->category->nama }}</span></td>
                <td class="text-gray-500 text-sm">{{ $doc->nomor_dokumen ?? '-' }}</td>
                <td class="whitespace-nowrap text-gray-500 text-sm">{{ $doc->tanggal->format('d/m/Y') }}</td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ Storage::url($doc->file_pdf) }}" target="_blank" class="text-blora-red text-sm hover:underline">PDF</a>
                        <a href="{{ route('admin.hukum.edit', $doc) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                        <form method="POST" action="{{ route('admin.hukum.destroy', $doc) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada dokumen. <a href="{{ route('admin.hukum.create') }}" class="text-blora-blue">Upload sekarang</a></td></tr>
            @endforelse
        </tbody>
    </table>
    @if($documents->hasPages())<div class="p-4 border-t">{{ $documents->links() }}</div>@endif
</div>
@endsection
