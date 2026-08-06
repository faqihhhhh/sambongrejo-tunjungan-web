@extends('layouts.admin')
@section('page-title', isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna')
@section('admin-content')
<div class="max-w-lg">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($user) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}</h2>
    </div>
    <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($user)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
            <input type="email" name="email" value="{{ old('email', $user->email ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Role *</label>
            <select name="role" required class="form-input-gov">
                <option value="admin" {{ old('role', $user->role ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="super_admin" {{ old('role', $user->role ?? '') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password {{ isset($user) ? '(opsional, kosongkan jika tidak ingin mengubah)' : '*' }}</label>
            <input type="password" name="password" autocomplete="new-password" class="form-input-gov" {{ isset($user) ? '' : 'required' }}>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" class="form-input-gov">
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($user) ? 'Simpan Perubahan' : 'Buat Pengguna' }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
