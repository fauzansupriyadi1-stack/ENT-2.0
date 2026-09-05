# 📰 FZAN NEWS — Portal Berita Modern & Panel Dashboard Admin

> **Thoughts That Inspire, Stories That Connect.**  
> Platform portal berita modern, elegan, responsif, dan dinamis berbasis Laravel dengan Panel Dashboard Manajemen Artikel secara Real-Time.

---

## ✨ Fitur Utama

### 📰 1. Portal Berita (Front-End User)
- **Hero Section Featured Story**: Menampilkan cerita unggulan terbaru dari database secara otomatis.
- **Navigasi Kategori Dropdown**: Navbar desktop memiliki dropdown *Kategori* berisi (*Lifestyle, Travel, Productivity, Personal Growth, Technology*) — klik salah satu untuk memfilter artikel.
- **Filter Kategori Berita**: Halaman utama menampilkan artikel sesuai kategori yang dipilih dari navbar, lengkap dengan info jumlah artikel dan tombol *Reset Filter*.
- **Grid Artikel dengan `@forelse`**: Semua artikel (selain featured utama) ditampilkan dalam grid responsif berbasis `@forelse` Blade.
- **Halaman Detail Berita**: Halaman lengkap artikel dengan konten penuh, info penulis, kategori, dan read time.
- **Pencarian Global (Search Modal)**: Fitur pencarian artikel secara instan melalui modal overlay (`Ctrl + K`).
- **Responsif Sepenuhnya**: Desain adaptif untuk desktop, tablet, dan smartphone dengan *Mobile Drawer Navigation* termasuk daftar kategori.

### 🎛️ 2. Panel Dashboard Admin (Back-End Management)
- **Manajemen CRUD Artikel Lengkap**: Tambah artikel baru, edit isi berita, dan hapus artikel secara instan.
- **Upload File Gambar Sampul**: Formulir mendukung unggah file gambar langsung dari komputer (JPG, PNG, WEBP, GIF, SVG maks 5MB) yang tersimpan di `public/uploads/articles/`, maupun penggunaan link URL gambar secara fleksibel.
- **Live Side-by-Side Editor Preview**: Pratinjau langsung kartu berita secara real-time saat memilih file gambar, mengetik judul, excerpt, atau memasukkan URL gambar.
- **Statistik Real-Time (Auto-Sync API)**: Penghitung *Total Artikel* & *Kategori Berita* terhubung otomatis ke database via API polling setiap 3 detik.
- **Filter Kategori & Pencarian Tabel**: Filter artikel per kategori dan pencarian instan di tabel dashboard.
- **Pratinjau Modal Artikel**: Tombol *Intip* untuk membuka pratinjau artikel langsung dari tabel dashboard tanpa berpindah halaman.
- **Sidebar Responsive Drawer**: Navigasi admin dengan animasi smooth & tombol menu toggle untuk perangkat mobile.

### 🔐 3. Sistem Autentikasi Login
- Halaman Login terdedikasi pada endpoint `/login`.
- Kredensial Admin default telah tersedia untuk pengujian lokal.

---

## 🛠️ Teknologi yang Digunakan

| Komponen | Detail |
|---|---|
| **Framework Core** | PHP 8.x + Laravel 11 |
| **Database** | MySQL (Laragon / phpMyAdmin - Database: `fzannews`) / SQLite |
| **Template Engine** | Laravel Blade |
| **Styling** | Vanilla CSS3 — Flexbox, Grid, Glassmorphic UI, Micro-Animations |
| **Typography & Icons** | Playfair Display, Inter — Font Awesome 6 |
| **Scripting** | JavaScript ES6 — Fetch API, Live DOM Manipulation, FileReader API |

---

## ⚙️ Cara Penginstalan & Panduan Jalankan (Dari Awal s/d Akhir)

> **Prasyarat:** Pastikan komputer Anda sudah terpasang **PHP 8.x**, **Composer**, **Laragon / MySQL**, dan **Git**.

---

### Langkah 1 — Clone Repository

Buka terminal / Command Prompt, lalu jalankan:
```bash
git clone https://github.com/username-anda/ENT-PROJECT-V2.git
cd ENT-PROJECT-V2
```

---

### Langkah 2 — Install Dependensi PHP (Composer)

```bash
composer install
```

---

### Langkah 3 — Konfigurasi File Environment (`.env`)

Salin file `.env.example` menjadi `.env`:

```bash
# Windows PowerShell:
cp .env.example .env

# Atau salin manual: duplikat file .env.example, lalu rename menjadi .env
```

---

### Langkah 4 — Generate Application Key

```bash
php artisan key:generate
```

---

### Langkah 5 — Setup Database MySQL (Laragon)

1. Buka **Laragon** lalu pastikan service **MySQL** sudah berjalan (*Start All*).
2. Buat database baru bernama **`fzannews`** melalui phpMyAdmin atau HeidiSQL / Laragon Database Interface.
3. Pastikan konfigurasi database pada file `.env` sudah sesuai:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fzannews
DB_USERNAME=root
DB_PASSWORD=
```

---

### Langkah 6 — Jalankan Migrasi & Seeder

Perintah ini akan membuat semua tabel di database `fzannews` dan mengisi data artikel awal serta akun admin:

```bash
php artisan migrate:fresh --seed
```

---

### Langkah 7 — Jalankan Server Lokal

```bash
php artisan serve
```

Buka browser dan akses:

👉 **`http://127.0.0.1:8000`**

---

## 🔑 Kredensial Login Admin Default

Akses Panel Dashboard di [`http://127.0.0.1:8000/dashboard`](http://127.0.0.1:8000/dashboard)  
Or login terlebih dahulu di [`http://127.0.0.1:8000/login`](http://127.0.0.1:8000/login):

| Field | Value |
|---|---|
| **Email** | `admin@fzannews.com` |
| **Password** | `password` |

---

## 🗺️ Daftar Route

| Method | URL | Deskripsi |
|---|---|---|
| `GET` | `/` | Halaman beranda portal berita |
| `GET` | `/?category=Lifestyle` | Filter artikel berdasarkan kategori |
| `GET` | `/article/{slug}` | Halaman detail berita |
| `GET` | `/login` | Halaman login admin |
| `POST` | `/login` | Proses autentikasi login |
| `POST` | `/logout` | Logout admin |
| `GET` | `/dashboard` | Panel kelola artikel (CRUD) |
| `GET` | `/dashboard/articles/create` | Form tambah artikel baru + Upload Gambar |
| `POST` | `/dashboard/articles` | Simpan artikel baru |
| `GET` | `/dashboard/articles/{id}/edit` | Form edit artikel + Upload Gambar |
| `PUT` | `/dashboard/articles/{id}` | Update artikel |
| `DELETE` | `/dashboard/articles/{id}` | Hapus artikel |
| `GET` | `/api/stats` | API statistik real-time |

---

## 📁 Struktur Direktori Penting

```text
ENT-PROJECT V2/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php        # Handler Login & Logout
│   │   ├── DashboardController.php   # Handler CRUD Artikel, Upload Gambar, & Real-Time Stats API
│   │   └── HomeController.php        # Handler Beranda & Detail Berita + Filter Kategori
│   └── Models/
│       ├── Article.php               # Model Eloquent Artikel Berita
│       └── User.php                  # Model Eloquent User Admin
├── database/
│   ├── migrations/                   # Skema tabel database (articles, users, cache, jobs)
│   └── seeders/                      # Seeder data awal (ArticleSeeder & DatabaseSeeder)
├── public/
│   ├── css/style.css                 # Main Custom CSS Design System
│   ├── js/main.js                    # Script interaktif UI & Fetch API
│   └── uploads/articles/             # Direktori penyimpanan file gambar yang diunggah
├── resources/views/
│   ├── articles/show.blade.php       # Halaman Detail Berita Lengkap
│   ├── auth/login.blade.php          # Halaman Login Admin
│   ├── dashboard/
│   │   ├── layout.blade.php          # Layout sidebar panel admin
│   │   ├── index.blade.php           # Tabel kelola artikel + filter + stats
│   │   └── form.blade.php            # Form tambah/edit artikel + Drag & Drop Upload + Live Preview
│   ├── layouts/app.blade.php         # Layout utama portal (navbar, footer, search modal)
│   └── welcome.blade.php             # Halaman Beranda FZAN NEWS
└── routes/
    └── web.php                       # Semua definisi Route (Portal, Dashboard, Auth, API)
```

---

## 📝 Lisensi & Hak Cipta

© 2026 **FZAN NEWS.** Hak cipta dilindungi undang-undang.  
Lisensi di bawah [MIT License](LICENSE).
