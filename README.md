## Dashboard Penjualan (Laravel 12 + Vite + Chart.js)

Aplikasi ini menampilkan tabel penjualan, ringkasan total transaksi, grafik tren, serta filter tanggal dengan format `yyyy/mm/dd`.

---

## 1. Persyaratan

- PHP 8.2
- Composer 2.x
- Node.js 18+ & npm
- MySQL 8 (atau kompatibel)

---

## 2. Menjalankan Secara Lokal

```bash
cp .env.example .env
composer install
php artisan key:generate

# sesuaikan DB_* di .env lalu jalankan migrasi + seeder
php artisan migrate --seed

# jalankan Vite & Laravel (dua terminal)
npm install
npm run dev
php artisan serve
```

Buka `http://127.0.0.1:8000`.

---

## 3. Deploy ke Railway

Railway sudah didukung dengan file `Procfile`. Langkah singkatnya:

1. **Push repository** ke GitHub.
2. **Railway** → New Project → Deploy from GitHub repo.
3. **Tambahkan Database** → MySQL.
4. Pada service Laravel, set environment variables:
   ```
   APP_NAME=DashboardPenjualan
   APP_ENV=production
   APP_KEY=<diisi setelah generate>
   APP_DEBUG=false
   APP_URL=https://<subdomain>.up.railway.app

   DB_CONNECTION=mysql
   DB_HOST=<MYSQLHOST>
   DB_PORT=<MYSQLPORT>
   DB_DATABASE=<MYSQLDATABASE>
   DB_USERNAME=<MYSQLUSER>
   DB_PASSWORD=<MYSQLPASSWORD>

   CACHE_DRIVER=file
   SESSION_DRIVER=file
   QUEUE_CONNECTION=sync
   ```
5. **Generate APP_KEY** lewat Railway Shell:
   ```bash
   php artisan key:generate --show
   ```
   Salin hasilnya ke variable `APP_KEY`.
6. Build/Start command (Railway otomatis membaca `Procfile`):
   - Build: `composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader`
   - Start: `php artisan migrate --force && php artisan serve --host 0.0.0.0 --port $PORT`
7. Setelah deployment sukses, jalankan:
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```
   melalui Shell Railway (jika belum dijalankan otomatis).

---

## 4. Struktur Fitur

- `app/Http/Controllers/DashboardController.php`  
  Mengambil data penjualan, menghitung total, dan menyiapkan data Chart.js.
- `resources/views/dashboard.blade.php`  
  Halaman utama dengan tabel, filter tanggal, ringkasan total, dan grafik.
- `database/seeders/DatabaseSeeder.php`  
  Mengisi contoh data penjualan.

---

## 5. Lisensi

MIT License.
