@extends('layouts.admin')
@section('page-title', isset($blangko) ? 'Edit Blangko' : 'Upload Blangko')
@section('admin-content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.blangko.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($blangko) ? 'Edit Blangko' : 'Upload Blangko Baru' }}</h2>
    </div>
    <form method="POST" action="{{ isset($blangko) ? route('admin.blangko.update', $blangko) : route('admin.blangko.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($blangko)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Blangko *</label>
            <input type="text" name="nama" value="{{ old('nama', $blangko->nama ?? '') }}" required class="form-input-gov" placeholder="Blangko Surat Keterangan Domisili">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">File {{ isset($blangko) ? '(opsional, biarkan kosong untuk tidak mengubah)' : '*' }}</label>
            @if(isset($blangko) && $blangko->file)<p class="text-sm text-blora-blue mb-2"><a href="{{ Storage::url($blangko->file) }}" target="_blank">Lihat file saat ini ({{ $blangko->ukuran_file }})</a></p>@endif
            <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx" {{ isset($blangko) ? '' : 'required' }} class="form-input-gov">
            <p class="text-xs text-gray-400 mt-1">Format: PDF, DOC, DOCX, XLS, XLSX. Maks: 10MB.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
            <textarea name="keterangan" rows="2" class="form-input-gov">{{ old('keterangan', $blangko->keterangan ?? '') }}</textarea>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($blangko) ? 'Simpan Perubahan' : 'Upload Blangko' }}</button>
            <a href="{{ route('admin.blangko.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
