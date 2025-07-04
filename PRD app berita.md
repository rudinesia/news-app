# [cite_start]Product Requirements Document (PRD): Website Aplikasi Berita [cite: 1]

* [cite_start]**Versi Dokumen**: 3.0 (Final) [cite: 2]
* [cite_start]**Tanggal**: 3 Juli 2025 [cite: 3]
* [cite_start]**Product Manager**: (Nama Anda/Saya) [cite: 4]

## [cite_start]1. Pendahuluan [cite: 5]

[cite_start]Dokumen ini mendefinisikan persyaratan produk untuk proyek pembuatan website aplikasi berita baru[cite: 6]. [cite_start]Tujuannya adalah untuk menjadi sumber kebenaran tunggal (single source of truth) bagi tim pengembang (Full-stack Programmer), desainer, dan pemangku kepentingan lainnya selama siklus hidup pengembangan produk[cite: 7].

[cite_start]**Visi Produk**: Menjadi platform berita yang kredibel, mudah diakses, dan menyediakan informasi yang relevan dan terkini bagi pembaca target[cite: 8].

## [cite_start]2. Latar Belakang dan Tujuan Proyek [cite: 9]

### 2.1. [cite_start]Latar Belakang (Masalah yang Ingin Diselesaikan) [cite: 10]

[cite_start]Saat ini, terdapat kebutuhan akan sebuah platform berita digital yang terstruktur, mudah dikelola oleh tim internal (penulis/kontributor), dan menyajikan pengalaman membaca yang bersih dan cepat bagi pengguna akhir[cite: 11]. [cite_start]Platform yang ada mungkin terlalu kompleks, lambat, atau tidak memiliki pemisahan peran yang jelas antara pengelola konten[cite: 12].

### 2.2. [cite_start]Tujuan Proyek (Objectives) [cite: 13]

[cite_start]Tujuan utama dari proyek ini adalah: [cite: 14]

* [cite_start]**Untuk Pengelola**: Membuat Content Management System (CMS) yang intuitif bagi Super Admin dan Kontributor untuk mempublikasikan dan mengelola artikel berita[cite: 15].
* [cite_start]**Untuk Pembaca**: Menyediakan website yang cepat, responsif (dapat diakses di desktop dan mobile), dan mudah dinavigasi untuk membaca berita[cite: 16].
* [cite_start]**Untuk Bisnis**: Membangun fondasi platform yang solid yang dapat dikembangkan di masa depan dengan fitur-fitur lanjutan seperti monetisasi atau interaksi pengguna[cite: 17].

## [cite_start]3. Ruang Lingkup Proyek (Scope) [cite: 18]

[cite_start]Untuk memastikan proyek berjalan sesuai jadwal dan anggaran, kita akan mendefinisikan dengan jelas apa yang termasuk dan tidak termasuk dalam rilis awal (MVP - Minimum Viable Product)[cite: 19].

### 3.1. [cite_start]In-Scope (Fitur yang Akan Dibuat) [cite: 20]

* [cite_start]**Manajemen Pengguna**: [cite: 21]
    * [cite_start]Sistem autentikasi (Login/Logout)[cite: 22].
    * [cite_start]Dua level peran: Super Admin dan Kontributor[cite: 23].
* [cite_start]**Manajemen Konten (oleh Pengguna Terautentikasi)**: [cite: 24]
    * [cite_start]CRUD (Create, Read, Update, Delete) untuk Artikel Berita[cite: 25].
    * [cite_start]Setiap artikel memiliki judul, isi (konten), gambar utama (featured image), dan kategori[cite: 26].
    * [cite_start]Isi artikel dapat memuat gambar-gambar tambahan (selain featured image)[cite: 27].
    * [cite_start]CRUD untuk Kategori Berita[cite: 28].
    * [cite_start]CRUD untuk Halaman Statis (contoh: "Tentang Kami", "Kontak", "Pedoman Media Siber")[cite: 29].
* [cite_start]**Tampilan Publik (Untuk Pembaca)**: [cite: 30]
    * [cite_start]Halaman utama (Homepage) yang menampilkan daftar artikel terbaru[cite: 31].
    * [cite_start]Halaman detail artikel untuk membaca berita secara lengkap[cite: 32].
    * [cite_start]Pada halaman detail artikel, menampilkan daftar 'artikel terkait' (berdasarkan kategori yang sama)[cite: 33].
    * [cite_start]Halaman arsip kategori yang menampilkan semua artikel dalam satu kategori[cite: 34].
    * [cite_start]Tampilan untuk halaman statis[cite: 35].

### 3.2. [cite_start]Out-of-Scope (Fitur yang TIDAK Dibuat untuk Rilis Awal) [cite: 36]

* [cite_start]Fitur komentar oleh pembaca[cite: 37].
* [cite_start]Integrasi login/registrasi dengan media sosial (Google, Facebook)[cite: 38].
* [cite_start]Fitur berbagi artikel ke media sosial[cite: 39].
* [cite_start]Sistem notifikasi (email atau push notification)[cite: 40].
* [cite_start]Monetisasi (pemasangan iklan, sistem berlangganan)[cite: 41].
* [cite_start]Fitur pencarian artikel[cite: 42].
* [cite_start]Dashboard analitik untuk admin[cite: 43].

## [cite_start]4. Definisi Pengguna dan Hak Akses (User Roles & Permissions) [cite: 44]

[cite_start]Bagian ini mendefinisikan berbagai jenis pengguna yang akan berinteraksi dengan platform dan hak akses spesifik yang mereka miliki[cite: 45].

### 4.1. [cite_start]Persona Pengguna [cite: 46]

* **Pembaca (Guest/Public)**: Siapapun yang mengunjungi website tanpa perlu login. [cite_start]Tujuannya adalah untuk mendapatkan informasi dan membaca berita[cite: 47].
* [cite_start]**Kontributor (Penulis)**: Staf internal atau penulis lepas yang bertanggung jawab untuk membuat dan mengelola konten artikel mereka sendiri[cite: 48].
* [cite_start]**Super Admin (Administrator)**: Pengguna dengan level akses tertinggi yang mengelola keseluruhan platform, termasuk konten, kategori, halaman, dan akun pengguna lain[cite: 49].

### 4.2. [cite_start]Matriks Hak Akses (Permission Matrix) [cite: 50]

| Fitur / Tindakan                  | Pembaca (Guest) | Kontributor | Super Admin |
| :-------------------------------- | :-------------- | :---------- | :---------- |
| **Manajemen Artikel** |                 |             |             |
| Melihat semua artikel (di website publik) | ✅              | ✅          | ✅          |
| Membuat artikel baru              | ❌              | ✅          | ✅          |
| Mengedit artikel sendiri          | ❌              | ✅          | ✅          |
| Menghapus artikel sendiri         | ❌              | ✅          | ✅          |
| Mengedit artikel milik orang lain | ❌              | ❌          | ✅          |
| Menghapus artikel milik orang lain | ❌              | ❌          | ✅          |
| **Manajemen Kategori** |                 |             |             |
| Melihat artikel berdasarkan kategori | ✅              | ✅          | ✅          |
| Membuat/Mengedit/Menghapus Kategori | ❌              | ❌          | ✅          |
| **Manajemen Halaman Statis** |                 |             |             |
| Melihat halaman statis (mis: Tentang Kami) | ✅              | ✅          | ✅          |
| Membuat/Mengedit/Menghapus Halaman | ❌              | ❌          | ✅          |
| **Manajemen Pengguna** |                 |             |             |
| Login / Logout                    | ❌              | ✅          | ✅          |
| Membuat/Mengedit/Menghapus Pengguna | ❌              | ❌          | ✅          |

## [cite_start]5. Persyaratan Fungsional (Functional Requirements) [cite: 52]

[cite_start]Bagian ini merinci cara kerja setiap fitur dari perspektif pengguna[cite: 53].

* [cite_start]**FR-1: Sistem Autentikasi** [cite: 54]
    * **1.1. [cite_start]Halaman Login**: Harus tersedia, memiliki kolom Email & Password, dan menangani login sukses/gagal[cite: 55].
    * **1.2. [cite_start]Logout**: Harus ada tombol logout yang mengakhiri sesi pengguna[cite: 56].
* [cite_start]**FR-2: Dashboard Admin** [cite: 57]
    * [cite_start]Menampilkan ringkasan singkat dan menu navigasi utama[cite: 58].
* [cite_start]**FR-3: Manajemen Artikel (CRUD)** [cite: 59]
    * **3.1. [cite_start]Daftar Artikel**: Menampilkan tabel artikel dengan filter berdasarkan peran (Kontributor vs Super Admin)[cite: 60].
    * **3.2. [cite_start]Form Tambah/Edit Artikel**: Memiliki input untuk Judul, Slug, Isi (dengan editor WYSIWYG), Gambar Utama, dan Kategori[cite: 61].
* [cite_start]**FR-4: Manajemen Kategori (Hanya Super Admin)** [cite: 62]
    * [cite_start]Menyediakan fungsionalitas CRUD penuh untuk kategori berita[cite: 63].
* [cite_start]**FR-5: Manajemen Halaman Statis (Hanya Super Admin)** [cite: 64]
    * [cite_start]Menyediakan fungsionalitas CRUD penuh untuk halaman statis[cite: 65].
* [cite_start]**FR-6: Tampilan Publik (Website untuk Pembaca)** [cite: 66]
    * **6.1. [cite_start]Homepage**: Menampilkan daftar artikel terbaru[cite: 67].
    * **6.2. [cite_start]Halaman Detail Artikel**: Menampilkan konten lengkap dan daftar "Artikel Terkait"[cite: 68].
    * **6.3. [cite_start]Halaman Arsip Kategori**: Menampilkan semua artikel dalam satu kategori[cite: 69].

## [cite_start]6. Persyaratan Non-Fungsional (Non-Functional Requirements) [cite: 70]

* **6.1. [cite_start]Performa**: Waktu muat halaman < 3 detik dan optimasi gambar otomatis[cite: 71].
* **6.2. [cite_start]Keamanan**: Proteksi terhadap XSS & SQL Injection, serta hashing password yang kuat[cite: 72].
* **6.3. [cite_start]Usability & Desain**: Desain responsif (Mobile-First) dan antarmuka yang konsisten[cite: 73].

## [cite_start]7. Spesifikasi Teknis & Asumsi [cite: 74]

### 7.1. [cite_start]Tumpukan Teknologi (Tech Stack): [cite: 75]

* [cite_start]**Bahasa & Framework**: PHP dengan Laravel 12[cite: 76].
* [cite_start]**Database**: MySQL[cite: 77].
* [cite_start]**Frontend**: Blade templating, dengan CSS (Tailwind CSS) dan JavaScript (Alpine.js)[cite: 78].

### 7.2. [cite_start]Asumsi Teknis: [cite: 79]

* [cite_start]Server/hosting sudah disiapkan dan memenuhi persyaratan untuk menjalankan Laravel 12[cite: 80].

### 7.3. [cite_start]Desain Awal Struktur Database: [cite: 81]

* [cite_start]`users`: `id`, `name`, `email`, `password`, `role` (enum: 'superadmin', 'kontributor'), `timestamps` [cite: 82]
* [cite_start]`categories`: `id`, `name`, `slug`, `timestamps` [cite: 83]
* [cite_start]`posts`: `id`, `user_id`, `category_id`, `title`, `slug`, `content`, `featured_image`, `status` (opsional), `timestamps` [cite: 84]
* [cite_start]`pages`: `id`, `title`, `slug`, `content`, `timestamps` [cite: 85]

### 7.4. [cite_start]Rekomendasi Paket & Library [cite: 86]

* [cite_start]**Manajemen Hak Akses**: [cite: 87]
    * [cite_start]**Paket**: `spatie/laravel-permission` [cite: 88]
    * [cite_start]**Tujuan**: Untuk mengimplementasikan sistem Peran & Hak Akses (Super Admin, Kontributor) seperti yang didefinisikan pada Bagian 4[cite: 89].
* [cite_start]**Editor Teks Kaya (WYSIWYG)**: [cite: 90]
    * [cite_start]**Library**: CKEditor 5 [cite: 91]
    * [cite_start]**Tujuan**: Untuk menyediakan fungsionalitas editor teks yang dibutuhkan pada FR-3.2 dan FR-5[cite: 92].
    * [cite_start]CKEditor 5 dipilih karena arsitekturnya yang modern, tangguh, dan memiliki tingkat keamanan yang lebih baik secara desain[cite: 93].
* [cite_start]**Optimasi Gambar Otomatis**: [cite: 94]
    * [cite_start]**Paket**: `spatie/laravel-image-optimizer` [cite: 95]
    * [cite_start]**Tujuan**: Untuk memenuhi persyaratan non-fungsional NFR 6.1 mengenai optimasi gambar[cite: 96].