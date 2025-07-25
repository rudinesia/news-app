# Breakdown Tugas Pengembangan Aplikasi Berita

[cite_start]Dokumen ini merinci daftar tugas teknis berdasarkan PRD Versi 3.0. [cite: 2]
[cite_start]Tugas diurutkan berdasarkan prioritas untuk memastikan alur kerja yang logis dan efisien. [cite: 3]

## [cite_start]Phase 1: Fondasi Proyek & Otentikasi (Prioritas Sangat Tinggi) [cite: 4]

**Tujuan**: Menyiapkan struktur dasar proyek, database, dan sistem otentikasi serta hak akses. [cite_start]Ini adalah fondasi sebelum fitur lain dapat dibangun. [cite: 5]

* [cite_start]**Setup Proyek & Lingkungan** [cite: 6]
    * [cite_start]Inisialisasi proyek Laravel 12 baru. [cite: 7]
    * [cite_start]Konfigurasi file .env untuk koneksi database MySQL. [cite: 8]
    * [cite_start]Pastikan Vite, Tailwind CSS, dan Alpine.js berjalan dengan baik. [cite: 9]
* [cite_start]**Instalasi & Konfigurasi Paket Pihak Ketiga** [cite: 10]
    * [cite_start]`composer require spatie/laravel-permission` [cite: 11]
    * [cite_start]`composer require spatie/laravel-image-optimizer` [cite: 12]
    * [cite_start]Publikasikan aset dan jalankan migrasi untuk paket `laravel-permission`. [cite: 13]
    * [cite_start]Siapkan integrasi CKEditor 5 melalui NPM/Vite. [cite: 14]
* [cite_start]**Struktur Database & Model** [cite: 15]
    * [cite_start]Buat file migrasi untuk tabel: `users`, `categories`, `posts`, `pages` sesuai spesifikasi di PRD 7.3. [cite: 16]
    * [cite_start]Tambahkan kolom `role` di migrasi `users`. [cite: 17]
    * [cite_start]Buat Model Eloquent: `User`, `Category`, `Post`, `Page`. [cite: 18]
    * [cite_start]Definisikan relasi Eloquent: [cite: 19]
        * [cite_start]`User hasMany Post` [cite: 20]
        * [cite_start]`Category hasMany Post` [cite: 21]
        * [cite_start]`Post belongsTo User` [cite: 22]
        * [cite_start]`Post belongsTo Category` [cite: 23]
* [cite_start]**Sistem Hak Akses (Roles & Permissions)** [cite: 24]
    * [cite_start]Buat Seeder untuk membuat Roles: 'Super Admin' dan 'Kontributor'. [cite: 25]
    * [cite_start]Buat Seeder untuk membuat satu user 'Super Admin' pertama. [cite: 26]
    * [cite_start]Terapkan trait `HasRoles` dari Spatie pada model User. [cite: 27]
    * [cite_start]Buat Middleware untuk melindungi route-route admin (misal: `CheckRole:superadmin`). [cite: 28]
* [cite_start]**Layout & Dashboard Admin** [cite: 29]
    * [cite_start]Buat layout dasar untuk area admin (`admin.blade.php`) menggunakan Tailwind CSS. [cite: 30]
    * [cite_start]Buat route dan view untuk halaman dashboard admin yang sederhana. [cite: 31]
    * [cite_start]Buat sistem navigasi di layout admin yang akan menampilkan menu berdasarkan `role` pengguna. [cite: 32]

## [cite_start]Phase 2: Manajemen Konten Inti (Prioritas Tinggi) [cite: 33]

[cite_start]**Tujuan**: Membangun fungsionalitas utama bagi admin dan kontributor untuk mengelola konten. [cite: 34]

* [cite_start]**CRUD Manajemen Kategori (Super Admin)** [cite: 35]
    * [cite_start]Buat `CategoryController` dengan metode CRUD. [cite: 36]
    * [cite_start]Buat route untuk CRUD Kategori, lindungi dengan middleware `CheckRole:superadmin`. [cite: 37]
    * [cite_start]Buat view untuk daftar kategori (`index.blade.php`). [cite: 38]
    * [cite_start]Buat view untuk form tambah/edit kategori (`create.blade.php`, `edit.blade.php`). [cite: 39]
    * [cite_start]Implementasikan logika untuk membuat slug secara otomatis dari nama kategori. [cite: 40]
* [cite_start]**CRUD Manajemen Artikel (Semua Peran Admin)** [cite: 41]
    * [cite_start]Buat `PostController` dengan metode CRUD. [cite: 42]
    * [cite_start]Buat `PostPolicy` untuk menangani otorisasi (Kontributor hanya bisa edit/hapus artikel sendiri, Super Admin bisa semua). [cite: 43]
    * [cite_start]Daftarkan `PostPolicy` di `AuthServiceProvider`. [cite: 44]
    * [cite_start]Buat route untuk CRUD Artikel, gunakan `policy` untuk otorisasi. [cite: 45]
    * [cite_start]Buat view form tambah/edit artikel: [cite: 46]
        * [cite_start]Integrasikan CKEditor 5 pada field `content`. [cite: 47]
        * [cite_start]Buat fungsionalitas upload untuk `featured_image`. [cite: 48]
        * [cite_start]Pastikan `spatie/laravel-image-optimizer` berjalan saat gambar diunggah. [cite: 49]
    * [cite_start]Buat view daftar artikel, tampilkan tombol 'Edit'/'Hapus' hanya jika diizinkan oleh `PostPolicy`. [cite: 50]

## [cite_start]Phase 3: Tampilan Publik (Prioritas Menengah) [cite: 51]

[cite_start]**Tujuan**: Membangun antarmuka yang akan dilihat oleh pembaca. [cite: 52]

* [cite_start]**Layout & Komponen Publik** [cite: 53]
    * [cite_start]Buat layout dasar untuk tampilan publik (`app.blade.php`) termasuk header dan footer. [cite: 54]
* [cite_start]**Halaman Utama (Homepage)** [cite: 55]
    * [cite_start]Buat `HomeController` untuk menampilkan halaman utama. [cite: 56]
    * [cite_start]Implementasikan query untuk mengambil daftar artikel terbaru (paginasi). [cite: 57]
    * [cite_start]Buat view `home.blade.php` untuk menampilkan daftar artikel. [cite: 58]
* [cite_start]**Halaman Detail Artikel** [cite: 59]
    * [cite_start]Buat metode di controller (misal: `PublicPostController@show`) yang menerima slug. [cite: 60]
    * [cite_start]Implementasikan query untuk mengambil artikel berdasarkan slug. [cite: 61]
    * [cite_start]Implementasikan query untuk mengambil "Artikel Terkait" (artikel lain dari kategori yang sama). [cite: 62]
    * [cite_start]Buat view `posts/show.blade.php` untuk menampilkan konten artikel secara lengkap. [cite: 63]
* [cite_start]**Halaman Arsip & Halaman Statis** [cite: 64]
    * [cite_start]Buat metode controller dan view untuk menampilkan daftar artikel per kategori. [cite: 65]
    * [cite_start]Buat metode controller dan view untuk menampilkan konten dari halaman statis berdasarkan slug. [cite: 66]

## [cite_start]Phase 4: Manajemen Tambahan & Finalisasi (Prioritas Rendah) [cite: 67]

[cite_start]**Tujuan**: Menyelesaikan fitur-fitur admin yang tersisa dan melakukan polishing. [cite: 68]

* [cite_start]**CRUD Manajemen Halaman Statis (Super Admin)** [cite: 69]
    * [cite_start]Buat `PageController` dengan metode CRUD, lindungi dengan middleware `CheckRole:superadmin`. [cite: 70]
    * [cite_start]Buat view dan route yang diperlukan (mirip dengan Kategori/Artikel). [cite: 71]
* [cite_start]**CRUD Manajemen Pengguna (Super Admin)** [cite: 72]
    * [cite_start]Buat `UserController` dengan metode CRUD, lindungi dengan middleware `CheckRole:superadmin`. [cite: 73]
    * [cite_start]Buat view untuk daftar pengguna. [cite: 74]
    * [cite_start]Buat view form untuk menambah/mengedit pengguna, termasuk dropdown untuk memilih `role`. [cite: 75]
* [cite_start]**Pengujian & Polishing** [cite: 76]
    * [cite_start]Lakukan pengujian manual untuk semua fungsionalitas sesuai matriks hak akses. [cite: 77]
    * [cite_start]Pastikan semua form memiliki validasi input yang solid. [cite: 78]
    * [cite_start]Lakukan pengujian desain responsif di semua halaman (admin dan publik). [cite: 79]
    * [cite_start]Tulis feature test dasar jika waktu memungkinkan. [cite: 80]