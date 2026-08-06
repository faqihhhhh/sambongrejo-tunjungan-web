@extends('layouts.admin')
@section('page-title', 'Manajemen Pengguna')
@section('admin-content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-blora-green-dark font-semibold text-lg">Manajemen Pengguna</h2>
    <a href="{{ route('admin.users.create') }}" class="btn-primary">+ Tambah User</a>
</div>
<div class="bg-white rounded-lg border border-gray-200 overflow-x-auto">
    <table class="table-gov">
        <thead><tr><th>Nama</th><th>Email</th><th>Role</th><th>Bergabung</th><th>Aksi</th></tr></thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>
                    <div class="flex items-center gap-4">
                        <div class="w-7 h-7 bg-blora-gold rounded-full flex items-center justify-center text-blora-green-dark font-bold text-xs">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                        <span class="font-medium text-blora-green-dark">{{ $user->name }}</span>
                        @if($user->id === auth()->id())<span class="text-xs text-green-500 ml-1">(Anda)</span>@endif
                    </div>
                </td>
                <td class="text-gray-500">{{ $user->email }}</td>
                <td>
                    <span class="text-xs px-2 py-0.5 rounded-full {{ $user->role === 'super_admin' ? 'bg-blora-gold/20 text-amber-700' : 'bg-gray-100 text-gray-600' }} font-semibold">
                        {{ $user->role === 'super_admin' ? '⭐ Super Admin' : 'Admin' }}
                    </span>
                </td>
                <td class="text-gray-500 text-sm">{{ $user->created_at->format('d/m/Y') }}</td>
                <td>
                    <div class="flex items-center gap-4">
                        <a href="{{ route('admin.users.edit', $user) }}" class="inline-flex items-center text-sm font-medium text-blora-blue hover:text-blora-green-dark transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>Edit</a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus data ini?')" class="flex m-0 p-0">@csrf @method('DELETE')<button type="submit" class="inline-flex items-center text-sm font-medium text-blora-red hover:text-red-800 transition-colors"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>Hapus</button></form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center py-8 text-gray-400">Belum ada pengguna.</td></tr>
            @endforelse
        </tbody>
    </table>
    @if($users->hasPages())<div class="p-4 border-t">{{ $users->links() }}</div>@endif
</div>
@endsection
