@extends('layouts.admin')
@section('page-title', 'Banner Slider')

@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-blora-green-dark font-semibold text-lg">Kelola Banner Slider</h2>
        <p class="text-gray-500 text-sm">Gambar yang tampil di halaman beranda</p>
    </div>
    <a href="{{ route('admin.banner.create') }}" class="btn-primary">+ Tambah Banner</a>
</div>

<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
    <table class="table-gov">
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Judul</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($banners as $banner)
            <tr>
                <td>
                    <img src="{{ Storage::url($banner->gambar) }}" alt="{{ $banner->judul }}"
                         class="w-24 h-14 object-cover rounded">
                </td>
                <td>{{ $banner->judul ?? '-' }}</td>
                <td>{{ $banner->urutan }}</td>
                <td>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $banner->aktif ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                        {{ $banner->aktif ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.banner.edit', $banner) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                        <form method="POST" action="{{ route('admin.banner.destroy', $banner) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-8 text-gray-400">Belum ada banner. <a href="{{ route('admin.banner.create') }}" class="text-blora-blue hover:underline">Tambah sekarang</a></td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($banners->hasPages())
    <div class="p-4 border-t border-gray-100">{{ $banners->links() }}</div>
    @endif
</div>
@endsection
