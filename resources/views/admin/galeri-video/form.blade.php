@extends('layouts.admin')
@section('page-title', isset($galeriVideo) ? 'Edit Video' : 'Tambah Video')
@section('admin-content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.galeri-video.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($galeriVideo) ? 'Edit Video' : 'Tambah Video' }}</h2>
    </div>
    <form method="POST" action="{{ isset($galeriVideo) ? route('admin.galeri-video.update', $galeriVideo) : route('admin.galeri-video.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($galeriVideo)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Video *</label>
            <input type="text" name="judul" value="{{ old('judul', $galeriVideo->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">URL Video YouTube *</label>
            <input type="url" name="url_video" value="{{ old('url_video', $galeriVideo->url_video ?? '') }}" required class="form-input-gov" placeholder="https://www.youtube.com/watch?v=...">
            <p class="text-xs text-gray-400 mt-1">Tempel link YouTube. Embed akan dibuat otomatis.</p>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($galeriVideo) && $galeriVideo->tanggal ? $galeriVideo->tanggal->format('Y-m-d') : '') }}" class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                <input type="text" name="keterangan" value="{{ old('keterangan', $galeriVideo->keterangan ?? '') }}" class="form-input-gov">
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($galeriVideo) ? 'Simpan' : 'Tambah Video' }}</button>
            <a href="{{ route('admin.galeri-video.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
