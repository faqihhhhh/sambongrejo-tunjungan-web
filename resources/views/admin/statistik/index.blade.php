@extends('layouts.admin')

@section('page-title', 'Statistik Penduduk')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-gray-50">
        <div class="flex items-center gap-3">
            <h2 class="font-semibold text-gray-800">Data Statistik</h2>
            <form action="{{ route('admin.statistik.index') }}" method="GET" class="flex items-center gap-2">
                <select name="kategori" onchange="this.form.submit()" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $kategori == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <a href="{{ route('admin.statistik.create') }}" class="inline-flex items-center gap-2 px-3 py-1.5 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
            Tambah Data
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-xs uppercase text-gray-500">
                    <th class="p-3 font-medium">Item / Label</th>
                    <th class="p-3 font-medium">Jumlah</th>
                    <th class="p-3 font-medium">Warna Grafik</th>
                    <th class="p-3 font-medium text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-gray-200">
                @php $total = 0; @endphp
                @forelse($statistik as $stat)
                @php $total += $stat->jumlah; @endphp
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="p-3 font-medium text-gray-900">{{ $stat->nama_item }}</td>
                    <td class="p-3">{{ number_format($stat->jumlah, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <div class="flex items-center gap-2">
                            <div class="w-4 h-4 rounded shadow-sm" style="background-color: {{ $stat->warna ?? '#cccccc' }}"></div>
                            <span class="text-xs text-gray-500">{{ $stat->warna ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="p-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.statistik.edit', $stat) }}" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.statistik.destroy', $stat) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
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
                    <td colspan="4" class="p-4 text-center text-gray-500">Belum ada data untuk kategori {{ $kategori }}.</td>
                </tr>
                @endforelse
            </tbody>
            @if($statistik->count() > 0)
            <tfoot class="bg-gray-50 font-semibold text-gray-800 text-sm">
                <tr>
                    <td class="p-3">TOTAL</td>
                    <td class="p-3">{{ number_format($total, 0, ',', '.') }}</td>
                    <td colspan="2" class="p-3"></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>
@endsection
