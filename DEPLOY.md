# Panduan Deploy ke cPanel (Domainesia Nimbus Go)

## Prasyarat Hosting
- PHP 8.2+ tersedia (aktifkan via cPanel → PHP Selector)
- MySQL tersedia (buat database via cPanel → MySQL Databases)
- Akses SSH atau File Manager cPanel

---

## Langkah 1 — Persiapan di Lokal

```bash
# Pastikan sudah build Tailwind CSS
npm run build

# Pastikan .env sudah dikonfigurasi untuk produksi (lihat .env.production.example)
```

---

## Langkah 2 — Upload File

**PENTING**: Jangan upload folder `node_modules/` dan `.git/`

### Opsi A — Via SSH (Direkomendasikan)
```bash
# Zip project (kecuali node_modules dan .git)
# Upload ke server lalu extract

# Di server:
cd ~
mkdir laravel
# extract zip ke folder ~/laravel/
```

### Opsi B — Via File Manager cPanel
1. Zip seluruh project (kecuali `node_modules/` dan `.git/`)
2. Upload zip ke `~/laravel/` via File Manager
3. Extract

---

## Langkah 3 — Konfigurasi public_html

**Tujuan**: Folder `public_html` harus mengarah ke folder `public` milik Laravel.

### Opsi A — Symlink (jika SSH tersedia)
```bash
# Backup public_html yang ada
mv ~/public_html ~/public_html_backup

# Buat symlink
ln -s ~/laravel/public ~/public_html
```

### Opsi B — Pindah isi public_html (jika tidak ada SSH)
1. Di cPanel File Manager, masuk ke `~/laravel/public/`
2. Copy semua isinya ke `~/public_html/`
3. Edit `~/public_html/index.php`:
   ```php
   // Ubah path ini:
   require __DIR__.'/../vendor/autoload.php';
   // Menjadi path absolut ke laravel:
   require __DIR__.'/../../laravel/vendor/autoload.php';
   
   // Ubah juga:
   $app = require_once __DIR__.'/../bootstrap/app.php';
   // Menjadi:
   $app = require_once __DIR__.'/../../laravel/bootstrap/app.php';
   ```

---

## Langkah 4 — Konfigurasi .env Produksi

Edit file `~/laravel/.env`:

```env
APP_NAME="Desa Sambongrejo"
APP_ENV=production
APP_KEY=   # WAJIB diisi! (lihat langkah 5)
APP_DEBUG=false
APP_URL=https://[domain-kamu.com]

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=   # nama database yang dibuat di cPanel
DB_USERNAME=   # username MySQL dari cPanel
DB_PASSWORD=   # password MySQL dari cPanel

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
```

---

## Langkah 5 — Setup via SSH

```bash
cd ~/laravel

# Generate APP_KEY
php artisan key:generate

# Jalankan migration
php artisan migrate --force

# Jalankan seeder (data awal)
php artisan db:seed --force

# Buat symlink storage
php artisan storage:link

# Cache config & routes untuk performa
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set permission folder
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

---

## Langkah 6 — Aktifkan PHP 8.2+

Di cPanel → **MultiPHP Manager** atau **PHP Selector**:
1. Pilih domain/subdomain
2. Set PHP version ke `8.2` atau `8.3`
3. Aktifkan extension: `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `gd`, `curl`, `zip`

---

## Langkah 7 — Verifikasi

1. Buka `https://[domain-kamu.com]` → harus muncul halaman beranda desa
2. Buka `https://[domain-kamu.com]/admin/login` → halaman login admin
3. Login dengan kredensial dari seeder (default: `admin@sambongrejo.desa.id` / `password123`)
4. **GANTI PASSWORD segera setelah login pertama!**

---

## Troubleshooting

| Error | Solusi |
|-------|--------|
| 500 Internal Server Error | Cek `storage/logs/laravel.log`, pastikan `.env` benar |
| Halaman putih kosong | Set `APP_DEBUG=true` sementara, lihat error |
| Storage/foto tidak muncul | Jalankan `php artisan storage:link` |
| CSS tidak load | Pastikan `public/build/` sudah ter-upload |
| Database error | Cek kredensial MySQL di `.env` |

---

## Akun Admin Default

> ⚠️ Segera ganti setelah pertama deploy!

- **Email**: `admin@sambongrejo.desa.id`
- **Password**: `Admin@Sambongrejo2025`
- **Role**: Super Admin

---

## Pembaruan (Update)

```bash
cd ~/laravel

# Upload file yang diubah
# Lalu:
php artisan migrate --force    # jika ada migration baru
php artisan config:cache
php artisan view:cache
php artisan route:cache
```
