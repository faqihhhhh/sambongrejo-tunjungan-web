@extends('layouts.admin')
@section('page-title', isset($hukum) ? 'Edit Dokumen Hukum' : 'Upload Dokumen Hukum')
@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.hukum.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($hukum) ? 'Edit Dokumen Hukum' : 'Upload Dokumen Hukum' }}</h2>
    </div>
    <form method="POST" action="{{ isset($hukum) ? route('admin.hukum.update', $hukum) : route('admin.hukum.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($hukum)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
            <select name="hukum_category_id" required class="form-input-gov">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('hukum_category_id', $hukum->hukum_category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumen *</label>
            <input type="text" name="judul" value="{{ old('judul', $hukum->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Dokumen</label>
                <input type="text" name="nomor_dokumen" value="{{ old('nomor_dokumen', $hukum->nomor_dokumen ?? '') }}" class="form-input-gov" placeholder="Nomor/No.">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal *</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($hukum) ? $hukum->tanggal->format('Y-m-d') : '') }}" required class="form-input-gov">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">File PDF {{ isset($hukum) ? '(opsional)' : '*' }}</label>
            @if(isset($hukum) && $hukum->file_pdf)<p class="text-sm text-blora-blue mb-2"><a href="{{ Storage::url($hukum->file_pdf) }}" target="_blank">Lihat file saat ini</a></p>@endif
            <input type="file" name="file_pdf" accept="application/pdf" {{ isset($hukum) ? '' : 'required' }} class="form-input-gov">
            <p class="text-xs text-gray-400 mt-1">Format: PDF. Maks: 10MB.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea name="keterangan" rows="2" class="form-input-gov">{{ old('keterangan', $hukum->keterangan ?? '') }}</textarea>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($hukum) ? 'Simpan Perubahan' : 'Upload Dokumen' }}</button>
            <a href="{{ route('admin.hukum.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
