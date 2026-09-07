# 🧠 ConnectED - Platform Konseling Mahasiswa

ConnectED adalah platform layanan konseling dan kesehatan mental mahasiswa berbasis web. Codebase ini sudah dikonfigurasi **self-contained (tanpa perlu install/koneksi MySQL database server)** menggunakan SQLite dan **siap dideploy ke Vercel (Serverless PHP)**.

---

## 🔑 Informasi Akun Login (Demo Credentials)

Semua akun sudah tersedia di database lokal (`database/database.sqlite`) dengan password yang sama:

| Role | Email | Password | Akses Halaman |
| :--- | :--- | :--- | :--- |
| 🎓 **Mahasiswa (Student)** | `michael@student.umn.ac.id` | `password123` | Booking Konseling, Riwayat Jadwal, Profil & Settings |
| 🛡️ **Admin** | `admin@umn.ac.id` | `password123` | Admin Dashboard, List Booking, Kelola Jadwal, Master Data |
| 🧠 **Psikolog (Yanuar)** | `yanuar@umn.ac.id` | `password123` | Dashboard Psikolog, Jadwal Kalender, Sesi Konseling |
| 🧠 **Psikolog (Fiona)** | `fiona@umn.ac.id` | `password123` | Dashboard Psikolog, Sesi Konseling |
| 🧠 **Psikolog (Sonny)** | `sonny@umn.ac.id` | `password123` | Dashboard Psikolog, Sesi Konseling |
| 🧠 **Psikolog (Ria)** | `ria@umn.ac.id` | `password123` | Dashboard Psikolog, Sesi Konseling |

> 💡 **Fitur Tambahan:** Pada halaman login (`/login`), terdapat panel **Info Akun Demo** dengan tombol **"Pakai Ini" (1-Click Auto Fill)** untuk mengisi email & password secara instan.

---

## 🚀 Menjalankan Secara Lokal (Local Development)

Aplikasi ini tidak memerlukan instalasi MySQL atau setup database terpisah.

### 1. Salin Environment File
```bash
cp .env.example .env
```

### 2. Generate Application Key (Jika Belum Ada)
```bash
php artisan key:generate
```

### 3. (Opsional) Reset / Re-seed Database
Database `database/database.sqlite` sudah terisi data bawaan. Jika ingin me-reset ulang data:
```bash
php artisan migrate:fresh --seed
```

### 4. Jalankan Server
```bash
php artisan serve
```
Buka browser di `http://localhost:8000`.

---

## ☁️ Cara Deploy ke Vercel

Codebase ini sudah dilengkapi dengan:
- `vercel.json` (Konfigurasi Serverless Runtime `vercel-php`)
- `api/index.php` (Handler Serverless & Auto Storage Initialization di `/tmp`)
- `.vercelignore` (Mengabaikan file yang tidak dibutuhkan saat deploy)

### Langkah 1: Push ke GitHub
Pastikan semua file (termasuk `database/database.sqlite`, `vercel.json`, `api/index.php`) sudah di-commit dan di-push ke repository GitHub Anda:
```bash
git add .
git commit -m "feat: setup self-contained sqlite and vercel deployment"
git push origin main
```

### Langkah 2: Import Project di Vercel
1. Buka [Vercel Dashboard](https://vercel.com/new).
2. Pilih repository GitHub **ConnectED**.
3. Pada bagian **Environment Variables**, tambahkan:
   - `APP_KEY`: `base64:4dE1oZ2bUe58kMvF9Gv1P2m4x5y6z7A8b9c0d1e2f3g=` (atau generate key baru via `php artisan key:generate --show`)
   - `APP_ENV`: `production`
   - `APP_DEBUG`: `false`
   - `DB_CONNECTION`: `sqlite`
   - `SESSION_DRIVER`: `cookie`
4. Klik **Deploy**.

Selesai! Aplikasi Anda akan langsung online dan berfungsi penuh di Vercel tanpa perlu database server eksternal.
