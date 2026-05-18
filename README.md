# StudyPlan AI

StudyPlan AI adalah sistem manajemen tugas mahasiswa berbasis web yang dibangun menggunakan Laravel. Sistem ini membantu mahasiswa mencatat tugas kuliah, menghitung prioritas pengerjaan, memantau progress, serta mendapatkan rekomendasi pengerjaan berbasis AI.

Sistem ini menggunakan pendekatan hybrid, yaitu perhitungan skor prioritas secara rule-based dan rekomendasi berbasis AI menggunakan Gemini API.

---

## Fitur Utama

### Autentikasi Pengguna
- Register akun
- Login
- Logout
- Edit profil
- Ubah password
- Hapus akun

### Manajemen Mata Kuliah
- Tambah mata kuliah
- Edit mata kuliah
- Hapus mata kuliah
- Mata kuliah digunakan sebagai kategori tugas

### Manajemen Tugas
- Tambah tugas kuliah
- Edit tugas
- Hapus tugas
- Detail tugas
- Quick update status tugas
- Riwayat perubahan status tugas

### Priority Scoring
Sistem menghitung skor prioritas tugas berdasarkan beberapa parameter:

- Deadline
- Tingkat kesulitan
- Estimasi waktu pengerjaan
- Bobot nilai tugas

Hasil perhitungan akan menghasilkan:

- Skor prioritas
- Level prioritas: rendah, sedang, tinggi, sangat tinggi

### Search, Filter, dan Sorting
Pada halaman daftar tugas, user dapat melakukan:

- Pencarian berdasarkan judul atau deskripsi
- Filter berdasarkan mata kuliah
- Filter berdasarkan status
- Filter berdasarkan prioritas
- Sorting berdasarkan deadline, skor prioritas, atau data terbaru

### Rekomendasi AI per Tugas
AI digunakan untuk memberikan rekomendasi pengerjaan pada setiap tugas, meliputi:

- Alasan prioritas
- Tingkat risiko keterlambatan
- Langkah pengerjaan
- Rekomendasi jadwal
- Tips manajemen waktu

### AI Daily Summary
AI juga dapat membuat ringkasan harian berdasarkan tugas aktif user, meliputi:

- Overview kondisi tugas
- Fokus utama hari ini
- Rencana pengerjaan
- Tips manajemen waktu

### Proteksi Penggunaan AI
Untuk mencegah penggunaan API berlebihan, sistem dilengkapi dengan:

- Rate limiting request AI
- Cooldown generate ulang rekomendasi AI
- Cooldown generate ulang daily summary
- Penyimpanan hasil AI ke database

### UI/UX
- Responsive layout
- Dark mode
- Landing page
- Dashboard insight
- Smooth scrolling menggunakan Lenis
- Halaman tentang sistem
- Halaman panduan penggunaan

---

## Teknologi yang Digunakan

- Laravel
- Laravel Breeze
- Blade Template
- Tailwind CSS
- Alpine.js
- MySQL
- Gemini API
- Lenis Smooth Scroll

---

## Struktur Fitur Sistem

### Dashboard
Dashboard menampilkan ringkasan informasi seperti:

- Total tugas
- Tugas selesai
- Tugas belum selesai
- Progress pengerjaan
- Deadline hari ini
- Deadline 7 hari ke depan
- Tugas prioritas sangat tinggi
- Tugas terlambat
- AI Daily Summary
- Tugas prioritas

### Mata Kuliah
Menu mata kuliah digunakan untuk mengelola data kategori akademik.

### Tugas
Menu tugas digunakan untuk mencatat dan mengelola seluruh tugas mahasiswa.

### Detail Tugas
Halaman detail tugas menampilkan:

- Informasi tugas
- Skor prioritas
- Rekomendasi AI
- Quick update status
- Riwayat aktivitas
- Aksi edit dan hapus tugas

---

## Instalasi Project

### 1. Clone Repository

```bash
git clone https://github.com/username/studyplan-ai.git
cd studyplan-ai
```

> Ganti URL repository sesuai repository project kamu.

### 2. Install Dependency Laravel

```bash
composer install
```

### 3. Install Dependency Frontend

```bash
npm install
```

### 4. Copy File Environment

```bash
cp .env.example .env
```

Jika menggunakan Windows dan command di atas tidak tersedia, copy manual file `.env.example` lalu rename menjadi `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

---

## Konfigurasi Database

Atur konfigurasi database pada file `.env`.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studyplan_ai
DB_USERNAME=root
DB_PASSWORD=
```

Buat database sesuai nama yang digunakan pada `.env`.

---

## Konfigurasi Gemini AI

Tambahkan konfigurasi Gemini API pada file `.env`.

```env
GEMINI_API_KEY=isi_api_key_gemini_kamu
GEMINI_MODEL=gemini-2.5-flash
```

Lalu pastikan file `config/services.php` memiliki konfigurasi:

```php
'gemini' => [
    'api_key' => env('GEMINI_API_KEY'),
    'model' => env('GEMINI_MODEL', 'gemini-2.5-flash'),
],
```

Catatan:

- Jangan upload API key ke GitHub.
- Jika project dikumpulkan dalam bentuk repository, kosongkan API key pada `.env.example`.
- User lain harus mengisi API key masing-masing.

---

## Migrasi Database

Jalankan migration:

```bash
php artisan migrate
```

Jika ingin reset database dan mengisi data demo:

```bash
php artisan migrate:fresh --seed
```

---

## Seeder Data Demo

Project ini menyediakan data demo untuk kebutuhan testing dan presentasi.

Akun demo:

```txt
Email    : demo@studyplan.test
Password : password
```

Mata kuliah demo:

- Jaringan Syaraf Tiruan
- Manajemen Proyek
- Technopreneurship
- Sistem Pendukung Keputusan
- Testing & Implementasi Sistem Informasi
- Aplikasi Mobile Lanjutan

Jalankan seeder:

```bash
php artisan db:seed --class=DemoDataSeeder
```

Atau reset semua database sekaligus:

```bash
php artisan migrate:fresh --seed
```

---

## Menjalankan Project

Jalankan server Laravel:

```bash
php artisan serve
```

Jalankan Vite:

```bash
npm run dev
```

Akses aplikasi melalui:

```txt
http://127.0.0.1:8000
```

---

## Menjalankan Auto Mark Overdue

Sistem memiliki command untuk menandai tugas yang melewati deadline sebagai terlambat.

Jalankan manual:

```bash
php artisan tasks:mark-overdue
```

Untuk menjalankan scheduler saat development:

```bash
php artisan schedule:work
```

Jika ingin scheduler berjalan otomatis di production, konfigurasi cron Laravel sesuai kebutuhan server.

---

## Alur Penggunaan Sistem

1. User melakukan register atau login.
2. User menambahkan data mata kuliah.
3. User menambahkan tugas kuliah.
4. Sistem menghitung skor prioritas otomatis.
5. User melihat daftar tugas berdasarkan prioritas.
6. User dapat melakukan search, filter, dan sorting tugas.
7. User membuka detail tugas.
8. User dapat generate rekomendasi AI.
9. User dapat mengubah status tugas.
10. Sistem mencatat perubahan status pada riwayat aktivitas.
11. User dapat membuat AI Daily Summary pada dashboard.

---

## Status Tugas

Sistem memiliki beberapa status tugas:

- Belum dikerjakan
- Sedang dikerjakan
- Selesai
- Terlambat

---

## Level Prioritas

Sistem menghasilkan level prioritas:

- Rendah
- Sedang
- Tinggi
- Sangat tinggi

---

## Penggunaan AI dalam Sistem

AI digunakan sebagai fitur pendukung, bukan untuk mengerjakan tugas mahasiswa secara penuh.

AI membantu user dalam:

- Menentukan fokus pengerjaan
- Memahami alasan prioritas tugas
- Menyusun langkah pengerjaan
- Membuat rencana waktu
- Mengurangi risiko keterlambatan

---

## Batasan Penggunaan AI

Gemini API memiliki batasan penggunaan seperti request per menit, token per menit, dan request per hari.

Untuk mengurangi penggunaan API berlebihan, sistem menerapkan:

- Penyimpanan hasil AI ke database
- Rate limit request AI
- Cooldown generate ulang rekomendasi AI
- Cooldown generate ulang daily summary
- Disable button saat proses generate berjalan

---

## Struktur Database Utama

Tabel utama dalam sistem:

- users
- subjects
- tasks
- ai_recommendations
- ai_daily_summaries
- task_histories

Relasi utama:

- User memiliki banyak mata kuliah
- User memiliki banyak tugas
- Mata kuliah memiliki banyak tugas
- Tugas memiliki satu rekomendasi AI
- Tugas memiliki banyak riwayat aktivitas
- User memiliki banyak AI daily summary

---

## Testing Fitur

Beberapa skenario testing yang dapat dilakukan:

| No | Fitur | Skenario | Hasil yang Diharapkan |
|---:|---|---|---|
| 1 | Login | User memasukkan email dan password benar | User masuk ke dashboard |
| 2 | Register | User mengisi data akun valid | Akun berhasil dibuat |
| 3 | Tambah Mata Kuliah | User mengisi nama dan deskripsi | Data mata kuliah tersimpan |
| 4 | Tambah Tugas | User mengisi form tugas lengkap | Tugas tersimpan dan skor prioritas muncul |
| 5 | Edit Tugas | User mengubah deadline atau bobot tugas | Data tugas berubah dan skor diperbarui |
| 6 | Quick Status | User mengubah status tugas | Status berubah dan riwayat tercatat |
| 7 | Generate AI | User klik generate rekomendasi AI | Rekomendasi AI muncul |
| 8 | Generate Daily Summary | User klik generate summary | Ringkasan harian muncul |
| 9 | Search Tugas | User mencari tugas tertentu | Data tugas sesuai pencarian tampil |
| 10 | Filter Tugas | User memilih status/prioritas | Data tugas sesuai filter tampil |
| 11 | Hapus Tugas | User menghapus tugas | Data tugas terhapus |
| 12 | Dark Mode | User mengganti mode tema | Tampilan berubah ke dark/light mode |
| 13 | Rate Limit AI | User spam generate AI | Sistem membatasi request AI |

---

## Catatan Deployment

Sebelum deploy, pastikan konfigurasi `.env` sudah disesuaikan:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-kamu.com
```

Lalu jalankan:

```bash
composer install --optimize-autoloader --no-dev
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Pastikan juga:

- Database production sudah dikonfigurasi.
- API key Gemini sudah diatur di `.env`.
- Folder storage memiliki permission yang benar.
- Scheduler Laravel aktif jika ingin menjalankan auto mark overdue otomatis.

---

## Akun Demo

```txt
Email    : mahasiswa@gmail.com
Password : password
```

---

## Kesimpulan

StudyPlan AI adalah aplikasi manajemen tugas akademik mahasiswa yang tidak hanya mencatat daftar tugas, tetapi juga membantu menentukan prioritas dan memberikan rekomendasi pengerjaan berbasis AI.

Sistem ini dirancang untuk membantu mahasiswa mengatur tugas kuliah secara lebih terarah, mengurangi risiko keterlambatan, dan meningkatkan manajemen waktu.
