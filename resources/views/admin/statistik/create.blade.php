@extends('layouts.admin')

@section('page-title', 'Tambah Data Statistik')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden max-w-xl">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <h2 class="font-semibold text-gray-800">Form Tambah Data Statistik</h2>
    </div>

    <form action="{{ route('admin.statistik.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
        @csrf

        @php
            $isCustom = !empty(old('kategori_custom')) || (!in_array($selectedKategori, $categories->toArray()) && !empty($selectedKategori));
            $currentVal = old('kategori', $selectedKategori);
        @endphp

        <div>
            <label for="kategori_select" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
            <select id="kategori_select" onchange="toggleCustomKategori(this.value)" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ !$isCustom && $currentVal == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
                <option value="__new__" {{ $isCustom ? 'selected' : '' }}>+ Tambah Kategori Baru...</option>
            </select>

            <div id="custom_kategori_wrapper" class="mt-2 {{ $isCustom ? '' : 'hidden' }}">
                <input type="text" id="kategori_custom" name="kategori_custom" value="{{ old('kategori_custom', $isCustom ? $currentVal : '') }}" placeholder="Ketik nama kategori baru (contoh: Golongan Darah / Dusun)..." class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50 text-sm">
            </div>

            <input type="hidden" name="kategori" id="kategori_real" value="{{ $isCustom ? old('kategori_custom', $currentVal) : $currentVal }}">
            @error('kategori') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="nama_item" class="block text-sm font-medium text-gray-700 mb-1">Item / Label *</label>
            <input type="text" name="nama_item" id="nama_item" value="{{ old('nama_item') }}" required placeholder="Contoh: Tamat SD / Petani / Laki-laki / Golongan A" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('nama_item') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-1">Jumlah (Jiwa) *</label>
            <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', 0) }}" required min="0" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('jumlah') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="warna" class="block text-sm font-medium text-gray-700 mb-1">Warna Grafik (opsional)</label>
            <div class="flex items-center gap-2">
                <input type="color" name="warna" id="warna" value="{{ old('warna', '#4ade80') }}" class="h-9 w-12 border-gray-300 rounded-md shadow-sm cursor-pointer p-0.5">
                <span class="text-xs text-gray-500">Pilih warna untuk tampilan di Pie/Bar Chart</span>
            </div>
            @error('warna') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="px-4 py-2 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
                Simpan Data
            </button>
            <a href="{{ route('admin.statistik.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>

<script>
    function toggleCustomKategori(val) {
        const wrapper = document.getElementById('custom_kategori_wrapper');
        const customInput = document.getElementById('kategori_custom');
        const realInput = document.getElementById('kategori_real');
        
        if (val === '__new__') {
            wrapper.classList.remove('hidden');
            customInput.required = true;
            realInput.value = customInput.value.trim();
            customInput.focus();
        } else {
            wrapper.classList.add('hidden');
            customInput.required = false;
            realInput.value = val;
        }
    }

    document.getElementById('kategori_custom')?.addEventListener('input', function() {
        document.getElementById('kategori_real').value = this.value.trim();
    });
</script>
@endsection
