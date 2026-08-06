@extends('layouts.admin')
@section('page-title', isset($ppid) ? 'Edit Informasi PPID' : 'Tambah Informasi PPID')
@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.ppid.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($ppid) ? 'Edit Informasi PPID' : 'Tambah Informasi PPID' }}</h2>
    </div>
    <form method="POST" action="{{ isset($ppid) ? route('admin.ppid.update', $ppid) : route('admin.ppid.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($ppid)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori PPID *</label>
            <select name="ppid_category_id" required class="form-input-gov">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('ppid_category_id', $ppid->ppid_category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
            <input type="text" name="judul" value="{{ old('judul', $ppid->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Isi / Keterangan</label>
            <textarea name="isi" rows="5" class="form-input-gov">{{ old('isi', $ppid->isi ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">File (PDF, DOC, XLS)</label>
                @if(isset($ppid) && $ppid->file)<p class="text-sm text-blora-blue mb-1"><a href="{{ Storage::url($ppid->file) }}" target="_blank">File saat ini</a></p>@endif
                <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', isset($ppid) && $ppid->tanggal ? $ppid->tanggal->format('Y-m-d') : '') }}" class="form-input-gov">
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($ppid) ? 'Simpan' : 'Tambah' }}</button>
            <a href="{{ route('admin.ppid.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
