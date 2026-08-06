@extends('layouts.admin')
@section('page-title', isset($item) ? 'Edit Running Text' : 'Tambah Running Text')
@section('admin-content')
<div class="max-w-xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.running-text.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($item) ? 'Edit Running Text' : 'Tambah Running Text' }}</h2>
    </div>
    <form method="POST" action="{{ isset($item) ? route('admin.running-text.update', $item) : route('admin.running-text.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($item)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Teks Berjalan *</label>
            <textarea name="teks" rows="3" class="form-input-gov" required placeholder="Teks yang akan tampil berjalan di header...">{{ old('teks', $item->teks ?? '') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                <input type="number" name="urutan" value="{{ old('urutan', $item->urutan ?? 0) }}" min="0" class="form-input-gov">
            </div>
            <div class="flex items-center mt-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="aktif" value="1" {{ old('aktif', $item->aktif ?? true) ? 'checked' : '' }} class="w-4 h-4 text-blora-green-dark rounded border-gray-300">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($item) ? 'Simpan Perubahan' : 'Tambah' }}</button>
            <a href="{{ route('admin.running-text.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
