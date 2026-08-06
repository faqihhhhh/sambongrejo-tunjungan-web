@extends('layouts.admin')
@section('page-title', 'Profil Desa')
@section('admin-content')
<div class="max-w-4xl">
    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        @if($errors->any())<div class="mb-4 bg-red-50 border border-red-200 rounded p-3 text-red-700 text-sm"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

        {{-- ── Kepala Desa ── --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-blora-green-dark mb-4 pb-2 border-b border-gray-100">Data Kepala Desa</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Kepala Desa *</label>
                    <input type="text" name="nama_kades" value="{{ old('nama_kades', $profile->nama_kades ?? '') }}" class="form-input-gov" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
                    <input type="text" name="jabatan_kades" value="{{ old('jabatan_kades', $profile->jabatan_kades ?? 'Kepala Desa') }}" class="form-input-gov">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Kepala Desa</label>
                    @if($profile?->foto_kades)<img src="{{ Storage::url($profile->foto_kades) }}" class="h-28 object-cover rounded mb-2 border" alt="Foto Kades">@endif
                    <input type="file" name="foto_kades" accept="image/*" class="form-input-gov">
                    <p class="text-xs text-gray-400 mt-1">Format JPG/PNG, maks 2MB. Orientasi potret/portrait.</p>
                </div>
            </div>
        </div>

        {{-- ── Sambutan ── --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-blora-green-dark mb-4 pb-2 border-b border-gray-100">Sambutan</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sambutan Singkat (tampil di beranda)</label>
                    <textarea name="sambutan_singkat" rows="3" class="form-input-gov">{{ old('sambutan_singkat', $profile->sambutan_singkat ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sambutan Lengkap (halaman profil)</label>
                    <textarea name="sambutan_lengkap" rows="8" class="form-input-gov" id="sambutan_lengkap">{{ old('sambutan_lengkap', $profile->sambutan_lengkap ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── Sejarah & Visi Misi ── --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-blora-green-dark mb-4 pb-2 border-b border-gray-100">Sejarah, Visi & Misi</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sejarah Desa</label>
                    <textarea name="sejarah" rows="8" class="form-input-gov" id="sejarah">{{ old('sejarah', $profile->sejarah ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                    <input type="text" name="visi" value="{{ old('visi', $profile->visi ?? '') }}" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Misi (boleh HTML list)</label>
                    <textarea name="misi" rows="6" class="form-input-gov font-mono text-xs">{{ old('misi', $profile->misi ?? '') }}</textarea>
                </div>
            </div>
        </div>

        {{-- ── Data Desa ── --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-blora-green-dark mb-4 pb-2 border-b border-gray-100">Data & Kontak Desa</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Luas Wilayah</label>
                    <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $profile->luas_wilayah ?? '') }}" placeholder="contoh: ± 524 Ha" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Penduduk</label>
                    <input type="text" name="jumlah_penduduk" value="{{ old('jumlah_penduduk', $profile->jumlah_penduduk ?? '') }}" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah KK</label>
                    <input type="text" name="jumlah_kk" value="{{ old('jumlah_kk', $profile->jumlah_kk ?? '') }}" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kode Pos</label>
                    <input type="text" name="kode_pos" value="{{ old('kode_pos', $profile->kode_pos ?? '') }}" class="form-input-gov">
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Kantor</label>
                    <textarea name="alamat_kantor" rows="2" class="form-input-gov">{{ old('alamat_kantor', $profile->alamat_kantor ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon', $profile->telepon ?? '') }}" class="form-input-gov">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" class="form-input-gov">
                </div>
            </div>
        </div>

        {{-- ── Kontak & Lokasi ── --}}
        <div class="bg-white rounded-lg border border-gray-200 p-6 mb-6">
            <h3 class="font-semibold text-blora-green-dark mb-4 pb-2 border-b border-gray-100">Kontak & Lokasi (Halaman Kontak)</h3>
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Pelayanan</label>
                        <input type="text" name="jam_pelayanan"
                            value="{{ old('jam_pelayanan', $profile->jam_pelayanan ?? 'Senin – Jumat: 08.00 – 15.00 WIB') }}"
                            placeholder="contoh: Senin – Jumat: 08.00 – 15.00 WIB"
                            class="form-input-gov">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jam Istirahat</label>
                        <input type="text" name="jam_istirahat"
                            value="{{ old('jam_istirahat', $profile->jam_istirahat ?? 'Istirahat: 12.00 – 13.00 WIB') }}"
                            placeholder="contoh: Istirahat: 12.00 – 13.00 WIB"
                            class="form-input-gov">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">URL Embed Google Maps</label>
                    <textarea name="maps_embed_url" rows="4" class="form-input-gov font-mono text-xs"
                        placeholder="Paste URL embed Google Maps di sini...">{{ old('maps_embed_url', $profile->maps_embed_url ?? '') }}</textarea>
                    <div class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded text-xs text-blue-700 space-y-1">
                        <p class="font-semibold">Cara mendapatkan URL embed Google Maps:</p>
                        <ol class="list-decimal list-inside space-y-0.5">
                            <li>Buka <a href="https://maps.google.com" target="_blank" class="underline">maps.google.com</a> dan cari lokasi kantor desa</li>
                            <li>Klik tombol <strong>"Bagikan"</strong> (Share)</li>
                            <li>Pilih tab <strong>"Sematkan peta"</strong> (Embed a map)</li>
                            <li>Klik <strong>"Salin HTML"</strong>, lalu paste <em>seluruh kode</em> <code>&lt;iframe ...&gt;&lt;/iframe&gt;</code> di sini</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Simpan Profil Desa</button>
        </div>
    </form>
</div>
@endsection
