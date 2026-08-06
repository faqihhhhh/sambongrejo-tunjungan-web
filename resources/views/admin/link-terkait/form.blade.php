@extends('layouts.admin')
@section('page-title', isset($linkTerkait) ? 'Edit Link' : 'Tambah Link Terkait')
@section('admin-content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.link-terkait.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($linkTerkait) ? 'Edit Link Terkait' : 'Tambah Link Terkait' }}</h2>
    </div>
    <form method="POST" action="{{ isset($linkTerkait) ? route('admin.link-terkait.update', $linkTerkait) : route('admin.link-terkait.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($linkTerkait)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Instansi *</label>
            <input type="text" name="nama" value="{{ old('nama', $linkTerkait->nama ?? '') }}" required class="form-input-gov">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">URL Website *</label>
            <input type="url" name="url" value="{{ old('url', $linkTerkait->url ?? '') }}" required class="form-input-gov" placeholder="https://...">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Logo</label>
                @if(isset($linkTerkait) && $linkTerkait->logo)<img src="{{ Storage::url($linkTerkait->logo) }}" class="h-16 object-contain mb-2" alt="Logo saat ini">@endif
                <input type="file" name="logo" accept="image/*" class="form-input-gov">
                <p class="text-xs text-gray-400 mt-1">PNG/SVG transparan. Maks 1MB.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $linkTerkait->urutan ?? 0) }}" min="0" class="form-input-gov">
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($linkTerkait) ? 'Simpan' : 'Tambah Link' }}</button>
            <a href="{{ route('admin.link-terkait.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
