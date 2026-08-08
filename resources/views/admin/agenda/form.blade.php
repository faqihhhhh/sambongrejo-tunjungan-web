@extends('layouts.admin')
@section('page-title', isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda')
@section('admin-content')
<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.agenda.index') }}" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg></a>
        <h2 class="text-blora-green-dark font-semibold text-lg">{{ isset($agenda) ? 'Edit Agenda' : 'Tambah Agenda Baru' }}</h2>
    </div>
    <form method="POST" action="{{ isset($agenda) ? route('admin.agenda.update', $agenda) : route('admin.agenda.store') }}" class="bg-white rounded-lg border border-gray-200 p-6 space-y-4">
        @csrf @if(isset($agenda)) @method('PUT') @endif
        @if($errors->any())<div class="bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Agenda *</label>
            <input type="text" name="judul" value="{{ old('judul', $agenda->judul ?? '') }}" required class="form-input-gov">
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai *</label>
                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai', isset($agenda) ? $agenda->tanggal_mulai->format('Y-m-d') : '') }}" required class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', isset($agenda) && $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('Y-m-d') : '') }}" class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jam Mulai</label>
                <input type="time" name="jam_mulai" value="{{ old('jam_mulai', isset($agenda) ? $agenda->jam_mulai : '') }}" class="form-input-gov">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $agenda->lokasi ?? '') }}" class="form-input-gov" placeholder="Balai Desa, dll">
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="form-input-gov wysiwyg">{{ old('deskripsi', $agenda->deskripsi ?? '') }}</textarea>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="btn-primary">{{ isset($agenda) ? 'Simpan Perubahan' : 'Tambah Agenda' }}</button>
            <a href="{{ route('admin.agenda.index') }}" class="btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
