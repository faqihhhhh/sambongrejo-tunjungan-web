@extends('layouts.admin')

@section('page-title', 'Tambah Data IDM')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden max-w-xl">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <h2 class="font-semibold text-gray-800">Form Tambah Data IDM</h2>
    </div>

    <form action="{{ route('admin.idm.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
        @csrf

        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('tahun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="skor" class="block text-sm font-medium text-gray-700 mb-1">Skor IDM *</label>
            <input type="number" step="0.0001" name="skor" id="skor" value="{{ old('skor') }}" required placeholder="Contoh: 0.7512" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('skor') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Desa *</label>
            <select name="status" id="status" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                <option value="" disabled selected>Pilih Status</option>
                <option value="Sangat Tertinggal" {{ old('status') == 'Sangat Tertinggal' ? 'selected' : '' }}>Sangat Tertinggal</option>
                <option value="Tertinggal" {{ old('status') == 'Tertinggal' ? 'selected' : '' }}>Tertinggal</option>
                <option value="Berkembang" {{ old('status') == 'Berkembang' ? 'selected' : '' }}>Berkembang</option>
                <option value="Maju" {{ old('status') == 'Maju' ? 'selected' : '' }}>Maju</option>
                <option value="Mandiri" {{ old('status') == 'Mandiri' ? 'selected' : '' }}>Mandiri</option>
            </select>
            @error('status') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="target_tahun_depan" class="block text-sm font-medium text-gray-700 mb-1">Target Tahun Depan</label>
            <input type="text" name="target_tahun_depan" id="target_tahun_depan" value="{{ old('target_tahun_depan') }}" placeholder="Contoh: Mandiri" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('target_tahun_depan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="px-4 py-2 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
                Simpan Data
            </button>
            <a href="{{ route('admin.idm.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
