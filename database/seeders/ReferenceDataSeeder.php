<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HukumCategory;
use App\Models\LayananCategory;
use App\Models\PpidCategory;
use App\Models\Layanan;
use App\Models\Agenda;
use App\Models\RunningText;
use App\Models\PotensiDesa;

class ReferenceDataSeeder extends Seeder
{
    public function run(): void
    {
        // ──── Kategori Produk Hukum ────
        $hukumKategori = [
            'Peraturan Desa (Perdes)',
            'Peraturan Presiden (Perpres)',
            'Peraturan Gubernur (Pergub)',
            'Peraturan Daerah (Perda)',
            'Keputusan Kepala Desa (SK Kades)',
        ];
        foreach ($hukumKategori as $nama) {
            \App\Models\HukumCategory::updateOrCreate(['nama' => $nama]);
        }

        // ──── Kategori Layanan ────
        $layananKategori = [
            'Administrasi Kependudukan',
            'Surat Keterangan',
            'Pelayanan Sosial',
            'Perizinan',
        ];
        foreach ($layananKategori as $nama) {
            LayananCategory::updateOrCreate(['nama' => $nama]);
        }

        // ──── Layanan Desa ────
        $katAdm = LayananCategory::where('nama', 'Administrasi Kependudukan')->first();
        $katSK  = LayananCategory::where('nama', 'Surat Keterangan')->first();

        $layanans = [
            ['layanan_category_id' => $katAdm->id, 'judul' => 'Kartu Keluarga (KK)', 'deskripsi' => 'Pengurusan Kartu Keluarga baru, perubahan data, atau penambahan anggota keluarga.', 'syarat' => '<ul><li>Surat pengantar RT/RW</li><li>KTP orang tua</li><li>Akta kelahiran (jika menambah anak)</li><li>Buku nikah/akta cerai (jika ada perubahan)</li></ul>', 'urutan' => 1],
            ['layanan_category_id' => $katAdm->id, 'judul' => 'KTP Elektronik', 'deskripsi' => 'Pengurusan KTP-el baru, rusak, atau hilang.', 'syarat' => '<ul><li>Surat pengantar RT/RW</li><li>Kartu Keluarga</li><li>Akta kelahiran</li><li>Surat keterangan kehilangan (jika hilang)</li></ul>', 'urutan' => 2],
            ['layanan_category_id' => $katSK->id,  'judul' => 'Surat Keterangan Domisili', 'deskripsi' => 'Surat keterangan tempat tinggal untuk berbagai keperluan administratif.', 'syarat' => '<ul><li>Surat pengantar RT/RW</li><li>KTP</li><li>Kartu Keluarga</li></ul>', 'urutan' => 3],
            ['layanan_category_id' => $katSK->id,  'judul' => 'Pengantar SKCK', 'deskripsi' => 'Surat pengantar dari desa untuk pembuatan SKCK di Kepolisian.', 'syarat' => '<ul><li>KTP asli dan fotokopi</li><li>Kartu Keluarga</li><li>Akta kelahiran atau ijazah</li><li>Pas foto 4x6 (2 lembar)</li></ul>', 'urutan' => 4],
            ['layanan_category_id' => $katSK->id,  'judul' => 'Surat Keterangan Tidak Mampu (SKTM)', 'deskripsi' => 'Surat keterangan kondisi ekonomi untuk keperluan beasiswa, bantuan sosial, dll.', 'syarat' => '<ul><li>Surat pengantar RT/RW</li><li>KTP</li><li>Kartu Keluarga</li><li>Surat keterangan dari kelurahan/dusun</li></ul>', 'urutan' => 5],
            ['layanan_category_id' => $katAdm->id, 'judul' => 'Surat Pindah (Mutasi)', 'deskripsi' => 'Surat keterangan pindah tempat tinggal ke daerah lain.', 'syarat' => '<ul><li>KTP asli</li><li>Kartu Keluarga asli</li><li>Surat pengantar RT/RW</li></ul>', 'urutan' => 6],
            ['layanan_category_id' => $katSK->id,  'judul' => 'Kartu Indonesia Pintar (KIP)', 'deskripsi' => 'Pengantar/rekomendasi untuk pengajuan Kartu Indonesia Pintar.', 'syarat' => '<ul><li>KTP orang tua</li><li>Kartu Keluarga</li><li>Akta kelahiran anak</li><li>Surat keterangan sekolah</li></ul>', 'urutan' => 7],
        ];

        foreach ($layanans as $layanan) {
            Layanan::updateOrCreate(['judul' => $layanan['judul']], $layanan);
        }

        // ──── Kategori PPID (sesuai UU KIP) ────
        $ppidKategori = [
            ['nama' => 'Informasi Berkala', 'deskripsi' => 'Informasi yang wajib disediakan dan diumumkan secara berkala (Pasal 9 UU KIP). Meliputi profil desa, anggaran, kegiatan, dan laporan.', 'urutan' => 1],
            ['nama' => 'Informasi Serta Merta', 'deskripsi' => 'Informasi yang wajib diumumkan serta merta bila dibutuhkan masyarakat (Pasal 10 UU KIP). Meliputi keadaan darurat, bencana, dan kejadian luar biasa.', 'urutan' => 2],
            ['nama' => 'Informasi Setiap Saat', 'deskripsi' => 'Informasi yang wajib tersedia setiap saat dan dapat diakses publik (Pasal 11 UU KIP). Meliputi peraturan desa, SOP pelayanan, perjanjian dengan pihak ketiga, dll.', 'urutan' => 3],
            ['nama' => 'Informasi Dikecualikan', 'deskripsi' => 'Informasi yang dikecualikan dari akses publik sesuai ketentuan UU KIP (Pasal 17). Informasi yang jika dibuka dapat merugikan kepentingan publik atau melanggar privasi.', 'urutan' => 4],
        ];

        foreach ($ppidKategori as $kategori) {
            PpidCategory::updateOrCreate(['nama' => $kategori['nama']], $kategori);
        }

        // ──── Running Text ────
        RunningText::updateOrCreate(
            ['teks' => 'Selamat datang di website resmi Desa Sambongrejo, Kecamatan Tunjungan, Kabupaten Blora.'],
            ['aktif' => true, 'urutan' => 1]
        );
        RunningText::updateOrCreate(
            ['teks' => 'Pelayanan administrasi desa dapat dilakukan setiap hari kerja Senin - Jumat, pukul 08.00 - 15.00 WIB.'],
            ['aktif' => true, 'urutan' => 2]
        );

        // ──── Contoh Agenda ────
        Agenda::updateOrCreate(
            ['judul' => 'Posyandu Balita Rutin'],
            [
                'deskripsi'     => 'Pelayanan posyandu bulanan untuk balita dan ibu hamil di Desa Sambongrejo.',
                'tanggal_mulai' => now()->addDays(5)->toDateString(),
                'lokasi'        => 'Balai Desa Sambongrejo',
                'jam_mulai'     => '08:00',
            ]
        );

        Agenda::updateOrCreate(
            ['judul' => 'Rapat BPD Pembahasan APBDes Perubahan'],
            [
                'deskripsi'     => 'Rapat Badan Permusyawaratan Desa untuk pembahasan APBDes Perubahan Tahun 2025.',
                'tanggal_mulai' => now()->addDays(12)->toDateString(),
                'lokasi'        => 'Kantor Desa Sambongrejo',
                'jam_mulai'     => '09:00',
            ]
        );

        // ──── Potensi Desa ────
        $potensiData = [
            ['kategori' => 'umkm',       'judul' => 'Industri Kerajinan Anyaman Bambu', 'deskripsi' => 'Desa Sambongrejo memiliki pengrajin anyaman bambu yang menghasilkan berbagai produk seperti tampah, besek, dan kerajinan dekoratif yang dipasarkan ke berbagai daerah.', 'urutan' => 1],
            ['kategori' => 'pertanian',   'judul' => 'Tanaman Padi Sawah',               'deskripsi' => 'Sebagian besar lahan pertanian di Desa Sambongrejo dimanfaatkan untuk pertanian padi sawah dengan hasil yang cukup baik berkat sistem irigasi yang memadai.', 'urutan' => 1],
            ['kategori' => 'peternakan',  'judul' => 'Peternakan Sapi dan Kambing',      'deskripsi' => 'Banyak warga Desa Sambongrejo yang memiliki usaha peternakan sapi dan kambing sebagai mata pencaharian sampingan yang cukup menguntungkan.', 'urutan' => 1],
            ['kategori' => 'perkebunan',  'judul' => 'Kebun Jati',                       'deskripsi' => 'Desa Sambongrejo memiliki potensi perkebunan kayu jati yang merupakan komoditas unggulan Kabupaten Blora.', 'urutan' => 1],
        ];

        foreach ($potensiData as $potensi) {
            PotensiDesa::updateOrCreate(
                ['kategori' => $potensi['kategori'], 'judul' => $potensi['judul']],
                $potensi
            );
        }
    }
}
