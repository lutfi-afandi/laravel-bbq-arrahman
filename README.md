# Laravel BBQ New

**Laravel BBQ New** adalah aplikasi berbasis web yang dibangun menggunakan **Laravel Framework** untuk mengelola kegiatan akademik atau pelatihan secara terstruktur. Aplikasi ini mendukung tiga peran utama: **Admin, Tutor, dan Peserta (Mahasiswa)**, dengan fitur lengkap mulai dari pendaftaran, manajemen jadwal, absensi, penilaian, hingga laporan dan cetak data.

---

## ✨ Fitur Utama

-   **Autentikasi & Otorisasi**
    -   Login, logout, manajemen profil
    -   Pembatasan akses berdasarkan role (Admin/Tutor/Peserta)
-   **Admin**
    -   Manajemen user, peserta, tutor, kelas, jadwal, kelompok, dan gelombang
    -   Dashboard admin dan laporan
-   **Tutor**
    -   Melihat jadwal mengajar, absensi, input nilai, laporan tutor
-   **Peserta**
    -   Pendaftaran kegiatan dan melihat status pendaftaran
    -   Dashboard peserta

---

## 🏗️ Arsitektur Aplikasi

-   Menggunakan **MVC (Model–View–Controller)** Laravel
-   Blade Template untuk front-end
-   Eloquent ORM untuk manajemen database
-   Tailwind CSS + Vite untuk UI/asset

**Alur request:**  
Request → Route → Controller → Model → View → Response

---

## ⚙️ Instalasi & Menjalankan Project

### Prasyarat

-   PHP >= 8.x
-   Composer
-   Node.js & NPM
-   MySQL / MariaDB

### Langkah Instalasi

1. **Clone atau ekstrak project**

```bash
cd laravel-bbq-new
```

2. **Install dependency PHP**

```bash
composer install
```

3. **Install dependency frontend**

```bash
npm install
npm run build
```

4. **Copy file environment**

```bash
cp .env.example .env
```

5. **Generate application key**

```bash
php artisan key:generate
```

6. **Konfigurasi database**
   Edit file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

7. **Migrasi database**

```bash
php artisan migrate
```

8. **(Opsional) Seed database**

```bash
php artisan db:seed
```

9. **Jalankan server**

```bash
php artisan serve
```

10. **Akses aplikasi di browser:**

```bash
http://127.0.0.1:8000
```

🔗 Route & Endpoint Utama

-   `/login` → Login user
-   `/logout` → Logout
-   `/pendaftaran` → List dan pendaftaran peserta
-   `/pendaftaran/create` → Form pendaftaran
-   `/admin/dashboard` → Dashboard admin
-   `/tutor/dashboard` → Dashboard tutor
-   `/peserta/dashboard` → Dashboard peserta

Semua route dilindungi middleware sesuai role masing-masing.

⚠️ Catatan Penting
Pastikan data referensi (kelas, jurusan, gelombang) sudah tersedia sebelum melakukan pendaftaran.

Fitur update & delete di beberapa controller masih dapat dikembangkan lebih lanjut.

Aplikasi ini berbasis Web, bukan REST API, sehingga interaksi dilakukan melalui halaman HTML/Blade.

📌 Lisensi
Project ini dibuat untuk kebutuhan internal/pembelajaran. Silakan disesuaikan dengan kebutuhan masing-masing.

```

```
