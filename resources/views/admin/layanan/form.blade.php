@extends('layouts.admin')
@section('page-title', isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan')
@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.layanan.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($layanan) ? 'Edit Layanan' : 'Tambah Layanan Baru' }}</h2>
    </div>
    <form method="POST" action="{{ isset($layanan) ? route('admin.layanan.update', $layanan) : route('admin.layanan.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($layanan)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
            <select name="layanan_category_id" class="form-input-gov">
                <option value="">-- Tanpa Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('layanan_category_id', $layanan->layanan_category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Layanan *</label>
            <input type="text" name="judul" value="{{ old('judul', $layanan->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Layanan</label>
            <textarea name="deskripsi" rows="3" class="form-input-gov">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Persyaratan (boleh HTML &lt;ul&gt;&lt;li&gt;)</label>
            <textarea name="syarat" rows="6" class="form-input-gov font-mono text-xs">{{ old('syarat', $layanan->syarat ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Ikon (emoji)</label>
                <input type="text" name="ikon" value="{{ old('ikon', $layanan->ikon ?? '') }}" class="form-input-gov" placeholder="">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $layanan->urutan ?? 0) }}" min="0" class="form-input-gov">
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($layanan) ? 'Simpan Perubahan' : 'Tambah Layanan' }}</button>
            <a href="{{ route('admin.layanan.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
