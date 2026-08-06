<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsCategory;
use App\Models\News;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['nama' => 'Ekonomi',                                           'slug' => 'ekonomi'],
            ['nama' => 'Pemerintahan Desa',                                 'slug' => 'pemerintahan-desa'],
            ['nama' => 'Budaya',                                            'slug' => 'budaya'],
            ['nama' => 'Kesehatan',                                         'slug' => 'kesehatan'],
            ['nama' => 'Pertanian, Peternakan, Perkebunan & Pertambangan',  'slug' => 'pertanian-peternakan-perkebunan-pertambangan'],
            ['nama' => 'Sosial, Keagamaan & Pendidikan',                    'slug' => 'sosial-keagamaan-pendidikan'],
        ];

        foreach ($categories as $cat) {
            NewsCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Contoh berita
        $cat1 = NewsCategory::where('slug', 'pemerintahan-desa')->first();
        $cat2 = NewsCategory::where('slug', 'ekonomi')->first();

        News::updateOrCreate(
            ['slug' => 'musdes-rkpdes-2025'],
            [
                'news_category_id' => $cat1->id,
                'judul'            => 'Musyawarah Desa Pembahasan RKPDes Tahun 2025',
                'slug'             => 'musdes-rkpdes-2025',
                'isi'              => '<p>Pemerintah Desa Sambongrejo menyelenggarakan Musyawarah Desa (Musdes) dalam rangka penyusunan Rencana Kerja Pemerintah Desa (RKPDes) Tahun 2025. Musyawarah ini dihadiri oleh seluruh perangkat desa, Badan Permusyawaratan Desa (BPD), tokoh masyarakat, dan perwakilan warga dari setiap dusun.</p><p>Dalam musyawarah tersebut, disepakati berbagai program prioritas pembangunan desa untuk tahun 2025, antara lain pembangunan infrastruktur jalan, peningkatan layanan kesehatan, dan pengembangan potensi ekonomi warga.</p>',
                'penulis'          => 'Admin Desa',
                'status'           => 'publish',
                'tanggal_publish'  => now()->subDays(3),
            ]
        );

        News::updateOrCreate(
            ['slug' => 'pelatihan-umkm-sambongrejo-2025'],
            [
                'news_category_id' => $cat2->id,
                'judul'            => 'Pelatihan Kewirausahaan untuk UMKM Desa Sambongrejo',
                'slug'             => 'pelatihan-umkm-sambongrejo-2025',
                'isi'              => '<p>Dinas Koperasi dan UMKM Kabupaten Blora bekerja sama dengan Pemerintah Desa Sambongrejo menyelenggarakan pelatihan kewirausahaan bagi pelaku usaha mikro dan kecil di Desa Sambongrejo.</p><p>Pelatihan yang berlangsung selama dua hari ini diikuti oleh 30 peserta dari berbagai bidang usaha, termasuk pertanian, kerajinan tangan, dan kuliner. Peserta mendapatkan materi tentang manajemen usaha, pemasaran digital, dan akses permodalan.</p>',
                'penulis'          => 'Admin Desa',
                'status'           => 'publish',
                'tanggal_publish'  => now()->subDays(7),
            ]
        );
    }
}
