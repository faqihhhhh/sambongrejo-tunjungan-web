@extends('layouts.admin')
@section('page-title', 'Link Terkait')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-blora-green-dark font-semibold text-lg">Link Terkait</h2>
    <a href="{{ route('admin.link-terkait.create') }}" class="btn-primary">+ Tambah Link</a>
</div>
<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
    <table class="table-gov">
        <thead><tr><th>Logo</th><th>Nama</th><th>URL</th><th>Urutan</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($links as $link)
            <tr>
                <td>@if($link->logo)<img src="{{ Storage::url($link->logo) }}" class="h-10 object-contain" alt="{{ $link->nama }}">@else<span class="text-gray-300">—</span>@endif</td>
                <td class="font-medium text-blora-green-dark">{{ $link->nama }}</td>
                <td><a href="{{ $link->url }}" target="_blank" class="text-blora-blue text-sm hover:underline truncate block max-w-40">{{ $link->url }}</a></td>
                <td class="text-gray-500 text-sm text-center">{{ $link->urutan }}</td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.link-terkait.edit', $link) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                        <form method="POST" action="{{ route('admin.link-terkait.destroy', $link) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada link terkait.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
