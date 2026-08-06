@extends('layouts.admin')

@section('page-title', 'Edit Data Statistik')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden max-w-xl">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <h2 class="font-semibold text-gray-800">Form Edit Data Statistik</h2>
    </div>

    <form action="{{ route('admin.statistik.update', $statistik) }}" method="POST" class="p-4 sm:p-6 space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
            <select name="kategori" id="kategori" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                <option value="Pendidikan" {{ old('kategori', $statistik->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                <option value="Pekerjaan" {{ old('kategori', $statistik->kategori) == 'Pekerjaan' ? 'selected' : '' }}>Pekerjaan</option>
                <option value="Agama" {{ old('kategori', $statistik->kategori) == 'Agama' ? 'selected' : '' }}>Agama</option>
                <option value="Usia" {{ old('kategori', $statistik->kategori) == 'Usia' ? 'selected' : '' }}>Usia</option>
                <option value="Jenis Kelamin" {{ old('kategori', $statistik->kategori) == 'Jenis Kelamin' ? 'selected' : '' }}>Jenis Kelamin</option>
            </select>
            @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="nama_item" class="block text-sm font-medium text-gray-700 mb-1">Item / Label *</label>
            <input type="text" name="nama_item" id="nama_item" value="{{ old('nama_item', $statistik->nama_item) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('nama_item') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Jiwa) *</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $statistik->jumlah) }}" required min="0" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="warna" class="block text-sm font-medium text-gray-700 mb-1">Warna Grafik (opsional)</label>
            <div class="flex items-center gap-2">
                <input type="color" name="warna" id="warna" value="{{ old('warna', $statistik->warna ?? '#4ade80') }}" class="h-9 w-12 border-gray-300 rounded-md shadow-sm cursor-pointer p-0.5">
                <span class="text-xs text-gray-500">Pilih warna untuk tampilan di Pie/Bar Chart</span>
            </div>
            @error('warna') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="px-4 py-2 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
                Simpan Perubahan
            </button>
            <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
