@extends('layouts.admin')
@section('page-title', isset($news) ? 'Edit Berita' : 'Tulis Berita Baru')
@section('admin-content')
<div class="max-w-4xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($news) ? 'Edit Berita' : 'Tulis Berita Baru' }}</h2>
    </div>

    <form method="POST" action="{{ isset($news) ? route('admin.news.update', $news) : route('admin.news.store') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf @if(isset($news)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

        <div class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita *</label>
                <input type="text" name="judul" value="{{ old('judul', $news->judul ?? '') }}" required class="form-input-gov text-base" placeholder="Judul berita...">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="news_category_id" required class="form-input-gov">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('news_category_id', $news->news_category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Penulis</label>
                    <input type="text" name="penulis" value="{{ old('penulis', $news->penulis ?? auth()->user()->name) }}" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                    <select name="status" required class="form-input-gov">
                        <option value="draft" {{ old('status', $news->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="publish" {{ old('status', $news->status ?? '') === 'publish' ? 'selected' : '' }}>Publish</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publish</label>
                    <input type="date" name="tanggal_publish" value="{{ old('tanggal_publish', isset($news->tanggal_publish) ? $news->tanggal_publish->format('Y-m-d') : '') }}" class="form-input-gov">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan untuk otomatis menggunakan tanggal hari ini saat publish.</p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Berita</label>
                @if(isset($news) && $news->foto)<img src="{{ Storage::url($news->foto) }}" class="h-32 object-cover rounded mb-2 border" alt="">@endif
                <input type="file" name="foto" accept="image/*" class="form-input-gov">
                <p class="text-xs text-gray-400 mt-1">Rekomendasi: 16:9, min 800px lebar. Maks 3MB.</p>
            </div>
        </div>

        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">Isi Berita *</label>
            <textarea name="isi" rows="16" class="form-input-gov wysiwyg" id="isi" required>{{ old('isi', $news->isi ?? '') }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">{{ isset($news) ? 'Simpan Perubahan' : 'Simpan Berita' }}</button>
            <a href="{{ route('admin.news.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
