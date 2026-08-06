@extends('layouts.admin')
@section('page-title', isset($category) ? 'Edit Kategori Hukum' : 'Tambah Kategori Hukum')
@section('admin-content')
<div class="max-w-md">
    <div class="flex items-center gap-3 mb-6"><a href="{{ route('admin.hukum-category.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a><h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($category) ? 'Edit Kategori Hukum' : 'Tambah Kategori Hukum' }}</h2></div>
    <form method="POST" action="{{ isset($category) ? route('admin.hukum-category.update', $category) : route('admin.hukum-category.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($category)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div><label class="block text-sm font-medium text-gray-700 mb-1">Nama Kategori *</label><input type="text" name="nama" value="{{ old('nama', $category->nama ?? '') }}" required class="form-input-gov"></div>
        <div class="flex gap-3 pt-4 border-t border-gray-100"><button type="submit" class="btn-primary">{{ isset($category) ? 'Simpan' : 'Tambah' }}</button><a href="{{ route('admin.hukum-category.index') }}" class="btn-secondary">Batal</a></div>
    </form>
</div>
@endsection
