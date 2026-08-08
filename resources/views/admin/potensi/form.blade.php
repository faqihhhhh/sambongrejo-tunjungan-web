@extends('layouts.admin')
@section('page-title', isset($potensi) ? 'Edit Potensi Desa' : 'Tambah Potensi Desa')
@section('admin-content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.potensi.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($potensi) ? 'Edit Potensi Desa' : 'Tambah Potensi Desa' }}</h2>
    </div>
    <form method="POST" action="{{ isset($potensi) ? route('admin.potensi.update', $potensi) : route('admin.potensi.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($potensi)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
            <select name="kategori" required class="form-input-gov">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategoriList as $key => $label)
                <option value="{{ $key }}" {{ old('kategori', $potensi->kategori ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
            <input type="text" name="judul" value="{{ old('judul', $potensi->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-input-gov wysiwyg">{{ old('deskripsi', $potensi->deskripsi ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                @if(isset($potensi) && $potensi->foto)<img src="{{ Storage::url($potensi->foto) }}" class="h-20 object-cover rounded mb-2 border" alt="">@endif
                <input type="file" name="foto" accept="image/*" class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $potensi->urutan ?? 0) }}" min="0" class="form-input-gov">
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($potensi) ? 'Simpan' : 'Tambah' }}</button>
            <a href="{{ route('admin.potensi.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
