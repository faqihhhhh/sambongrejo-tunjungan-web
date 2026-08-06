@extends('layouts.admin')
@section('page-title', 'Kelola Agenda')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <div><h2 class="text-blora-green-dark font-semibold text-lg">Kelola Agenda</h2></div>
    <a href="{{ route('admin.agenda.create') }}" class="btn-primary">+ Tambah Agenda</a>
</div>
<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
    <table class="table-gov">
        <thead><tr><th>Tanggal</th><th>Judul Agenda</th><th>Lokasi</th><th>Jam</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($agendas as $agenda)
            <tr>
                <td class="whitespace-nowrap font-medium">
                    <div class="text-center bg-blora-green-dark rounded p-1.5 inline-block min-w-12">
                        <span class="block text-blora-gold font-bold text-base leading-none">{{ $agenda->tanggal_mulai->format('d') }}</span>
                        <span class="block text-green-300 text-xs">{{ $agenda->tanggal_mulai->translatedFormat('M Y') }}</span>
                    </div>
                </td>
                <td class="font-medium text-blora-green-dark">{{ $agenda->judul }}</td>
                <td class="text-gray-500 text-sm">{{ $agenda->lokasi ?? '-' }}</td>
                <td class="text-gray-500 text-sm">{{ $agenda->jam_mulai ? \Carbon\Carbon::parse($agenda->jam_mulai)->format('H:i') : '-' }}</td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.agenda.edit', $agenda) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                        <form method="POST" action="{{ route('admin.agenda.destroy', $agenda) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada agenda.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($agendas->hasPages())<div class="p-4 border-t">{{ $agendas->links() }}</div>@endif
</div>
@endsection
