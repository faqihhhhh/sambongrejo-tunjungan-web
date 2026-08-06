@extends('layouts.admin')

@section('page-title', 'Tambah Data APBDes')

@section('admin-content')
<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden max-w-3xl">
    <div class="p-4 border-b border-gray-200 bg-gray-50">
        <h2 class="font-semibold text-gray-800">Form Tambah Data APBDes</h2>
    </div>

    <form action="{{ route('admin.apbdes.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
        @csrf

        <div>
            <label for="tahun" class="block text-sm font-medium text-gray-700 mb-1">Tahun Anggaran *</label>
            <input type="number" name="tahun" id="tahun" value="{{ old('tahun', date('Y')) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
            @error('tahun') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-medium text-gray-700 mb-4 border-b pb-2">Pendapatan</h3>
                <div class="space-y-4">
                    <div>
                        <label for="pendapatan_anggaran" class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                        <input type="number" name="pendapatan_anggaran" id="pendapatan_anggaran" value="{{ old('pendapatan_anggaran', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="pendapatan_realisasi" class="block text-sm font-medium text-gray-700 mb-1">Realisasi (Rp)</label>
                        <input type="number" name="pendapatan_realisasi" id="pendapatan_realisasi" value="{{ old('pendapatan_realisasi', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-medium text-gray-700 mb-4 border-b pb-2">Belanja</h3>
                <div class="space-y-4">
                    <div>
                        <label for="belanja_anggaran" class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                        <input type="number" name="belanja_anggaran" id="belanja_anggaran" value="{{ old('belanja_anggaran', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="belanja_realisasi" class="block text-sm font-medium text-gray-700 mb-1">Realisasi (Rp)</label>
                        <input type="number" name="belanja_realisasi" id="belanja_realisasi" value="{{ old('belanja_realisasi', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-medium text-gray-700 mb-4 border-b pb-2">Pembiayaan (Penerimaan)</h3>
                <div class="space-y-4">
                    <div>
                        <label for="pembiayaan_penerimaan_anggaran" class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                        <input type="number" name="pembiayaan_penerimaan_anggaran" id="pembiayaan_penerimaan_anggaran" value="{{ old('pembiayaan_penerimaan_anggaran', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="pembiayaan_penerimaan_realisasi" class="block text-sm font-medium text-gray-700 mb-1">Realisasi (Rp)</label>
                        <input type="number" name="pembiayaan_penerimaan_realisasi" id="pembiayaan_penerimaan_realisasi" value="{{ old('pembiayaan_penerimaan_realisasi', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <h3 class="font-medium text-gray-700 mb-4 border-b pb-2">Pembiayaan (Pengeluaran)</h3>
                <div class="space-y-4">
                    <div>
                        <label for="pembiayaan_pengeluaran_anggaran" class="block text-sm font-medium text-gray-700 mb-1">Anggaran (Rp)</label>
                        <input type="number" name="pembiayaan_pengeluaran_anggaran" id="pembiayaan_pengeluaran_anggaran" value="{{ old('pembiayaan_pengeluaran_anggaran', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                    <div>
                        <label for="pembiayaan_pengeluaran_realisasi" class="block text-sm font-medium text-gray-700 mb-1">Realisasi (Rp)</label>
                        <input type="number" name="pembiayaan_pengeluaran_realisasi" id="pembiayaan_pengeluaran_realisasi" value="{{ old('pembiayaan_pengeluaran_realisasi', 0) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blora-green focus:ring focus:ring-blora-green focus:ring-opacity-50">
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-4 border-t border-gray-200">
            <button type="submit" class="px-4 py-2 bg-blora-green text-white text-sm font-medium rounded hover:bg-blora-green-dark transition-colors">
                Simpan Data
            </button>
            <a href="{{ route('admin.apbdes.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded hover:bg-gray-200 transition-colors">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
