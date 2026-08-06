@extends('layouts.admin')

@section('page-title', 'Status IDM')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
        <h2 class="font-semibold text-gray-800">Daftar Status IDM</h2>
        <a href="{{ route('admin.idm.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Data
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500">
                    <th class="p-3 font-medium">Tahun</th>
                    <th class="p-3 font-medium">Skor IDM</th>
                    <th class="p-3 font-medium">Status</th>
                    <th class="p-3 font-medium">Target Tahun Depan</th>
                    <th class="p-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @forelse($idms as $idm)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-3 font-medium text-gray-900">{{ $idm->tahun }}</td>
                    <td class="p-3">{{ number_format($idm->skor, 4) }}</td>
                    <td class="p-3">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $idm->status }}
                        </span>
                    </td>
                    <td class="p-3 text-gray-500">{{ $idm->target_tahun_depan ?? '-' }}</td>
                    <td class="p-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.idm.edit', $idm) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.idm.destroy', $idm) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-red-600 hover:bg-red-50 rounded transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">Belum ada data IDM.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
