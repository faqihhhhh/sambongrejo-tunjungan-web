<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'nama_kades'       => 'Nama Kepala Desa',
                'jabatan_kades'    => 'Kepala Desa',
                'sambutan_singkat' => 'Dengan mengucap syukur kepada Tuhan Yang Maha Esa, kami menyambut kehadiran Anda di website resmi Desa Sambongrejo. Melalui website ini, kami berharap dapat memberikan informasi yang transparan dan akuntabel kepada seluruh warga Desa Sambongrejo dan masyarakat luas.',
                'sambutan_lengkap' => '<p>Assalamu\'alaikum Warahmatullahi Wabarakatuh,</p><p>Puji syukur kami panjatkan kepada Tuhan Yang Maha Esa atas segala limpahan rahmat dan nikmat-Nya. Kami menyambut kehadiran Anda di website resmi Pemerintah Desa Sambongrejo.</p><p>Desa Sambongrejo merupakan salah satu desa yang terletak di Kecamatan Tunjungan, Kabupaten Blora. Dengan potensi alam dan sumber daya manusia yang dimiliki, kami terus berupaya untuk mewujudkan desa yang maju, mandiri, dan sejahtera.</p><p>Melalui website ini, kami berkomitmen untuk memberikan informasi yang transparan, akurat, dan terpercaya kepada seluruh warga dan masyarakat luas. Kami juga membuka selebar-lebarnya partisipasi aktif masyarakat dalam pembangunan desa.</p><p>Semoga kehadiran website ini dapat bermanfaat bagi kita semua. Amin.</p><p>Wassalamu\'alaikum Warahmatullahi Wabarakatuh.</p>',
                'sejarah'          => '<p>Desa Sambongrejo merupakan salah satu desa tua yang ada di wilayah Kecamatan Tunjungan, Kabupaten Blora. Nama "Sambongrejo" berasal dari kata bahasa Jawa yang memiliki makna tersendiri bagi masyarakat setempat.</p><p>Desa ini telah ada sejak zaman penjajahan Belanda dan telah mengalami berbagai perubahan kepemimpinan serta perkembangan dari waktu ke waktu. Masyarakat Desa Sambongrejo dikenal sebagai masyarakat yang ramah, gotong royong, dan menjunjung tinggi nilai-nilai adat istiadat Jawa.</p><p>Sejalan dengan perkembangan zaman, Desa Sambongrejo terus berbenah diri untuk meningkatkan kesejahteraan warganya melalui berbagai program pembangunan fisik maupun pemberdayaan masyarakat.</p>',
                'visi'             => 'Terwujudnya Desa Sambongrejo yang Maju, Mandiri, Sejahtera, dan Berbudaya Berlandaskan Iman dan Taqwa.',
                'misi'             => '<ul><li>Meningkatkan kualitas pelayanan publik yang transparan, akuntabel, dan partisipatif.</li><li>Mengoptimalkan potensi sumber daya alam dan sumber daya manusia untuk kesejahteraan masyarakat.</li><li>Mengembangkan ekonomi masyarakat berbasis potensi lokal dan UMKM.</li><li>Meningkatkan infrastruktur desa yang merata dan berkualitas.</li><li>Melestarikan nilai-nilai budaya, tradisi, dan kearifan lokal.</li><li>Meningkatkan kualitas pendidikan dan kesehatan masyarakat.</li></ul>',
                'luas_wilayah'     => '± 524 Ha',
                'jumlah_penduduk'  => '± 2.800 jiwa',
                'jumlah_kk'        => '± 850 KK',
                'kode_pos'         => '58253',
                'alamat_kantor'    => 'Jl. Raya Sambongrejo No. 1, Kec. Tunjungan, Kab. Blora, Jawa Tengah 58253',
                'telepon'          => '-',
                'email'            => 'desasambongrejo@gmail.com',
            ]
        );
    }
}
