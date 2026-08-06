@extends('layouts.admin')
@section('page-title', isset($banner) ? 'Edit Banner' : 'Tambah Banner')

@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.banner.index') }}" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        </a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($banner) ? 'Edit Banner' : 'Tambah Banner Baru' }}</h2>
    </div>

    <form method="POST"
          action="{{ isset($banner) ? route('admin.banner.update', $banner) : route('admin.banner.store') }}"
          enctype="multipart/form-data"
          class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf
        @if(isset($banner)) @method('PUT') @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul <span class="text-gray-400">(opsional)</span></label>
            <input type="text" name="judul" value="{{ old('judul', $banner->judul ?? '') }}"
                   class="form-input-gov" placeholder="Judul banner (tampil di overlay)">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Gambar <span class="{{ isset($banner) ? 'text-gray-400' : 'text-red-500' }}">{{ isset($banner) ? '(opsional, biarkan kosong untuk tidak mengubah)' : '*' }}</span>
            </label>
            @if(isset($banner) && $banner->gambar)
            <div class="mb-3">
                <img src="{{ Storage::url($banner->gambar) }}" alt="Banner saat ini" class="w-64 h-36 object-cover rounded border">
                <p class="text-gray-400 text-xs mt-1">Gambar saat ini</p>
            </div>
            @endif
            <input type="file" name="gambar" accept="image/jpeg,image/png,image/webp" class="form-input-gov">
            <p class="text-gray-400 text-xs mt-1">Format: JPG, PNG, WEBP. Maks: 3MB. Rekomendasi: 1920×600px</p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan Tampil</label>
                <input type="number" name="urutan" value="{{ old('urutan', $banner->urutan ?? 0) }}" min="0"
                       class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $banner->aktif ?? true) ? 'checked' : '' }}
                           class="w-4 h-4 text-blora-green-dark rounded border-gray-300 focus:ring-blora-green">
                    <span class="text-sm text-gray-700">Aktif (tampil di beranda)</span>
                </label>
            </div>
        </div>

        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">
                {{ isset($banner) ? 'Simpan Perubahan' : 'Tambah Banner' }}
            </button>
            <a href="{{ route('admin.banner.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
