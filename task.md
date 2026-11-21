# MASTER PROMPT & PROJECT TASK MANAGEMENT (v1.1)
# BLOOMÉ — Flowers & Stories

## 1. PROJECT INFORMATION & ARCHITECTURE CONTEXT

- **Nama Produk:** BLOOMÉ — Flowers & Stories
- **Nama Proyek:** Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web
- **Project Sponsor / Owner:** Nabila Febriyani
- **Lokasi Usaha:** Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda
- **Metodologi Pengembangan:** Waterfall
- **Arsitektur Sistem:** Three-Layer Architecture (Presentation, Application, Data Layer)
- **Teknologi Utama:** Laravel 13.43.0 (PHP 8.5.5; Composer constraint `^8.3`), MySQL 8.0+, Blade Templating, Vite, Vanilla JavaScript / Tailwind CSS
- **Periode Pelaksanaan:** 13 Oktober – 30 November 2026 (7 Minggu)

### 1.1 Konsep Sistem Terbaru (Revisi v1.1)
> **"Website berfungsi sebagai katalog interaktif dan media personalisasi buket bunga, sedangkan proses transaksi pemesanan, konfirmasi ketersediaan bahan, negosiasi harga, pembayaran DP 50%, dan koordinasi pengiriman dilanjutkan secara langsung melalui WhatsApp."**

Website **tidak** melakukan checkout, **tidak** menyimpan transaksi di database, **tidak** mengelola status pesanan internal, dan **tidak** menyediakan payment gateway/upload bukti transfer.

### 1.2 Struktur Tim Pengembang

| Anggota Tim | Peran Utama | Tanggung Jawab Teknis |
|---|---|---|
| **Jayanti Firdasari** | Project Manager & System Analyst | Perencanaan proyek, spesifikasi SRS/PRD, diagram UML, pengawasan jadwal, dan QA Lead |
| **Riya Monika** | UI/UX Designer & Frontend Developer | Design system, wireframing, mockup Blade views, komponen interaktif personalisasi, dan integrasi WhatsApp link |
| **Elsa Futri** | Backend Developer & DBA | Arsitektur Three-Layer, migrasi 10 tabel database, Eloquent models, admin authentication, CRUD controllers, dan domain services |

---

# 2. STATUS TRACKING CONVENTION

Format penandaan status checklist:
- `[ ]` Not Started (Belum Dikerjakan)
- `[~]` In Progress (Sedang Dikerjakan)
- `[x]` Completed (Selesai dan Terverifikasi)
- `[!]` Blocked (Tertahan Kendala / Menunggu Konfirmasi Owner)

---

# 3. PHASE 1 — FOUNDATION & DOCUMENTATION

Tujuan: Menetapkan landasan ruang lingkup, jadwal, dan spesifikasi kebutuhan v1.1.

- [x] DOC-001 — Meninjau dan menyelaraskan Project Charter.
- [x] DOC-002 — Meninjau dan menyelaraskan ruang lingkup proyek (*Scope Boundaries*).
- [x] DOC-003 — Meninjau pembagian peran dan tanggung jawab tim.
- [x] DOC-004 — Meninjau jadwal dan timeline 7 minggu.
- [x] DOC-005 — Menyusun struktur dokumentasi proyek.
- [x] DOC-006 — Menyusun Software Requirements Specification (SRS) v1.1 di `requirement.md`.
- [x] DOC-007 — Meninjau Functional Requirements (FR-001 s/d FR-029).
- [x] DOC-008 — Meninjau Non-Functional Requirements.
- [x] DOC-009 — Meninjau Business Rules (BR-001 s/d BR-020).
- [x] DOC-010 — Meninjau Acceptance Criteria.
- [x] DOC-011 — Menyusun Product Requirements Document (PRD) v1.1 di `prd.md`.
- [x] DOC-012 — Meninjau visi dan positioning produk.
- [x] DOC-013 — Meninjau user personas (Customer & Admin).
- [x] DOC-014 — Meninjau user stories dan skenario penerimaan.
- [x] DOC-015 — Meninjau prioritas fitur MoSCoW.

---

# 4. PHASE 2 — SYSTEM ANALYSIS AND DESIGN

Tujuan: Memodelkan proses bisnis visual menggunakan diagram UML.

- [x] ANA-001 — Menyusun Use Case Diagram katalog interaktif dan pemesanan WhatsApp.
- [x] ANA-002 — Menyusun Use Case Descriptions untuk Customer & Admin.
- [x] ANA-003 — Menyusun Activity Diagram penjelajahan katalog & personalisasi buket.
- [x] ANA-004 — Menyusun Activity Diagram konsultasi buket custom via WhatsApp.
- [x] ANA-005 — Menyusun Activity Diagram transaksi off-web via WhatsApp.
- [x] ANA-006 — Menyusun Sequence Diagram katalog ke direct link WhatsApp.
- [x] ANA-007 — Menyusun Sequence Diagram admin master data management.
- [x] ANA-008 — Menyusun laporan validasi keselarasan diagram UML.

---

# 5. PHASE 3 — UI/UX DESIGN & PROTOTYPING

Tujuan: Merancang panduan visual, wireframe, dan prototipe interaktif.

- [x] UX-001 — Menetapkan Design System BLOOMÉ di `design-system.md`.
- [x] UX-002 — Menetapkan Locked Color Tokens (#E99AAF, #642D36, #FFF5F6, #A8B5A0, dll.).
- [x] UX-003 — Menetapkan tipografi (Playfair Display & Poppins).
- [x] UX-004 — Menetapkan border radius, spacing tokens, dan soft shadows.
- [x] UX-005 — Merancang komponen kartu produk dan badge ketersediaan (*Tersedia / Habis*).
- [x] UX-006 — Merancang komponen swatch warna personalisasi (wrapping paper & pita).
- [x] UX-007 — Merancang komponen checkbox card add-on pelengkap buket.
- [x] UX-008 — Merancang kartu ringkasan estimasi harga interaktif (*sticky summary*).
- [x] UX-009 — Merancang tombol utama WhatsApp Order CTA.
- [x] UX-010 — Merancang wireframe beranda, katalog, detail buket, custom page, about, dan contact.
- [x] UX-011 — Merancang wireframe panel admin (login, dashboard, produk, kategori, variasi, add-on, settings).
- [x] UX-012 — Menguji responsivitas mobile (≤ 576px), tablet, dan desktop.
- [x] UX-013 — Menyusun User Flow & Navigation Architecture di `user-flow.md`.

---

# 6. PHASE 4 — TECHNICAL ARCHITECTURE & DATABASE DESIGN

Tujuan: Menetapkan cetak biru arsitektur Three-Layer dan skema 10 tabel basis data.

- [x] ARC-001 — Menyusun System Architecture Document (SAD) v1.1 di `architecture.md`.
- [x] ARC-002 — Memodelkan Three-Layer Architecture (Presentation, Application, Data Layer).
- [x] ARC-003 — Menyusun High-Level Architecture Diagram & Component Diagram.
- [x] ARC-004 — Menetapkan spesifikasi berkas storage lokal dan sanitasi upload.
- [x] DB-001 — Menyusun Database Design Specification & Data Dictionary di `database-design.md`.
- [x] DB-002 — Merancang Entity Relationship Diagram (ERD) 10 tabel.
- [x] DB-003 — Menulis kamus data tabel `admins`.
- [x] DB-004 — Menulis kamus data tabel `categories`.
- [x] DB-005 — Menulis kamus data tabel `products`.
- [x] DB-006 — Menulis kamus data tabel `product_images`.
- [x] DB-007 — Menulis kamus data tabel `personalization_options`.
- [x] DB-008 — Menulis kamus data tabel `personalization_values`.
- [x] DB-009 — Menulis kamus data tabel `product_personalization_options`.
- [x] DB-010 — Menulis kamus data tabel `add_ons`.
- [x] DB-011 — Menulis kamus data tabel `product_add_ons`.
- [x] DB-012 — Menulis kamus data tabel `business_settings`.
- [ ] DB-013 — Menulis 10 berkas migrasi Laravel resmi.
- [ ] DB-014 — Mengeksekusi migrasi ke MySQL lokal dan memverifikasi foreign keys.
- [ ] DB-015 — Menulis 10 Eloquent Models beserta relasi (`hasMany`, `belongsTo`, `belongsToMany`).
- [ ] DB-016 — Menyiapkan Seeder: Admin, Category, Personalization, AddOn, BusinessSetting.

---

# 7. PHASE 5 — LARAVEL PROJECT FOUNDATION

Tujuan: Menyiapkan scaffolding framework dan konfigurasi dasar.

- [ ] BE-001 — Menyiapkan proyek Laravel dan konfigurasi `.env`.
- [ ] BE-002 — Menghubungkan basis data MySQL 8.0+.
- [ ] BE-003 — Menyiapkan guard otentikasi admin (`auth:admin`) pada `config/auth.php`.
- [ ] BE-004 — Menyiapkan struktur controller, form requests, dan domain services.
- [ ] BE-005 — Mengonfigurasi symbolic link berkas penyimpanan (`php artisan storage:link`).
- [ ] BE-006 — Menyiapkan penanganan error kustom floral (404, 403, 500).
- [ ] BE-007 — Menyiapkan bundler aset Vite dan pustaka styling.

---

# 8. PHASE 6 — BACKEND DEVELOPMENT

Tujuan: Mengimplementasikan seluruh logika bisnis dan API internal.

### 8.1 Otentikasi Admin
- [ ] BE-008 — Implementasi form login admin dan verifikasi password Bcrypt.
- [ ] BE-009 — Implementasi proteksi sesi admin dan regenerasi token sesi.
- [ ] BE-010 — Implementasi fungsi logout aman.
- [ ] BE-011 — Implementasi route middleware guard (`auth:admin`).

### 8.2 Manajemen Kategori Buket
- [ ] BE-012 — Controller daftar kategori (`CategoryController@index`).
- [ ] BE-013 — Form dan logika simpan kategori baru dengan slug otomatis.
- [ ] BE-014 — Logika update kategori.
- [ ] BE-015 — Logika hapus kategori dengan proteksi *foreign key restrict*.

### 8.3 Manajemen Produk & Ketersediaan
- [ ] BE-016 — Controller daftar produk katalog (`ProductController@index`).
- [ ] BE-017 — Form dan logika simpan produk baru (nama, kategori, harga dasar, deskripsi).
- [ ] BE-018 — Logika upload dan kompresi foto utama produk ke storage.
- [ ] BE-019 — Logika update rincian produk buket.
- [ ] BE-020 — Logika hapus produk buket beserta foto fisiknya.
- [ ] BE-021 — Toggle ketersediaan produk (*Tersedia / Habis*) via AJAX/PATCH.

### 8.4 Manajemen Galeri Multi-Foto Produk
- [ ] BE-022 — Controller galeri foto pendukung produk (`ProductGalleryController`).
- [ ] BE-023 — Logika upload multi-foto dengan penamaan UUID acak.
- [ ] BE-024 — Logika hapus foto galeri dari storage dan database.

### 8.5 Manajemen Variasi Personalisasi
- [ ] BE-025 — Controller opsi personalisasi (Warna Wrapping, Pita, dll.).
- [ ] BE-026 — Controller nilai variasi (nama variasi, hex color swatch, biaya tambahan).
- [ ] BE-027 — Logika penautan opsi personalisasi ke produk buket tertentu.

### 8.6 Manajemen Item Add-on
- [ ] BE-028 — Controller master item add-on (nama, harga satuan, thumbnail, deskripsi).
- [ ] BE-029 — Logika toggle ketersediaan item add-on.
- [ ] BE-030 — Logika penautan item add-on ke produk buket tertentu.

### 8.7 Manajemen Pengaturan Bisnis & WhatsApp URL Builder
- [ ] BE-031 — Controller pengelolaan nomor WhatsApp toko, jam kerja, dan alamat Samarinda.
- [ ] BE-032 — Domain service `WhatsAppUrlBuilderService` untuk menyusun template teks pesan pemesanan terstandarisasi dan encoding URL `wa.me`.

---

# 9. PHASE 7 — FRONTEND DEVELOPMENT

Tujuan: Mengimplementasikan tampilan antarmuka Blade yang elegan, interaktif, dan responsif.

### 9.1 Fondasi UI & Komponen Bersama
- [ ] FE-001 — Implementasi tema global CSS dan palet warna BLOOMÉ.
- [ ] FE-002 — Integrasi font Playfair Display & Poppins via Google Fonts / lokal.
- [ ] FE-003 — Master layout publik (`resources/views/layouts/app.blade.php`).
- [ ] FE-004 — Master layout panel admin (`resources/views/layouts/admin.blade.php`).
- [ ] FE-005 — Komponen Navbar mengambang (*sticky floating header*).
- [ ] FE-006 — Komponen Footer informasi butik Samarinda dan tautan medsos.
- [ ] FE-007 — Komponen kartu buket katalog dengan badge ketersediaan.
- [ ] FE-008 — Komponen tombol pemesanan WhatsApp CTA.

### 9.2 Antarmuka Publik Pelanggan
- [ ] FE-009 — Halaman Beranda (*Homepage*): Hero banner, filosofi butik, kategori, produk unggulan, kontak.
- [ ] FE-010 — Halaman Katalog Produk: Grid buket interaktif dengan tombol filter kategori instan.
- [ ] FE-011 — Halaman Detail Produk: Slider foto buket, deskripsi bunga, label ketersediaan, dan harga dasar.
- [ ] FE-012 — Komponen Konfigurator Personalisasi: Swatch visual warna wrapping & radio pita satin.
- [ ] FE-013 — Komponen Pemilih Add-on: Checkbox card kartu ucapan, boneka wisuda, lampu LED, topper akrilik.
- [ ] FE-014 — Input catatan khusus & teks ucapan kartu buket.
- [ ] FE-015 — Kartu ringkasan interaktif: Rincian item terpilih dan kalkulasi estimasi total harga dinamis.
- [ ] FE-016 — Script JavaScript `personalization.js`: Menghitung total harga secara *real-time* dan memicu link `wa.me`.
- [ ] FE-017 — Halaman Custom Bouquet: Panduan pemesanan khusus & tombol chat konsultasi via WhatsApp.
- [ ] FE-018 — Halaman Tentang Kami (*About Us*) & Halaman Kontak (*Contact Us*).

### 9.3 Antarmuka Panel Admin
- [ ] FE-019 — Halaman login admin bernuansa floral elegan.
- [ ] FE-020 — Dashboard admin: Kartu metrik jumlah produk aktif, stok habis, kategori, dan add-on.
- [ ] FE-021 — Tampilan tabel dan formulir kelola kategori buket.
- [ ] FE-022 — Tampilan tabel katalog buket dan tombol toggle ketersediaan instan.
- [ ] FE-023 — Formulir tambah/edit buket, input harga dasar, deskripsi, dan upload foto utama.
- [ ] FE-024 — Tampilan antarmuka pengelola galeri multi-foto buket.
- [ ] FE-025 — Tampilan antarmuka kelola opsi personalisasi, nilai variasi, swatch warna, dan relasi produk.
- [ ] FE-026 — Tampilan antarmuka kelola item add-on, harga tambahan, dan relasi produk.
- [ ] FE-027 — Halaman pengaturan kontak toko, alamat Samarinda, dan nomor WhatsApp pemesanan.

### 9.4 Audit Responsivitas
- [ ] FE-028 — Uji dan perbaiki tampilan mobile smartphone (≤ 576px).
- [ ] FE-029 — Uji dan perbaiki tampilan tablet (768px – 992px).
- [ ] FE-030 — Uji tampilan desktop (≥ 1024px).

---

# 10. PHASE 8 — SYSTEM INTEGRATION

Tujuan: Menghubungkan antarmuka Blade, logika backend, database, dan URL WhatsApp.

- [ ] INT-001 — Menghubungkan etalase katalog publik dengan data Eloquent MySQL.
- [ ] INT-002 — Menghubungkan filter kategori publik dengan kueri database.
- [ ] INT-003 — Menghubungkan konfigurator personalisasi dan add-on dengan tabel relasi dinamis.
- [ ] INT-004 — Menguji generator teks pesan WhatsApp pada berbagai kombinasi pilihan buket.
- [ ] INT-005 — Menguji pembukaan tautan WhatsApp resmi toko dari tombol "Pesan via WhatsApp".
- [ ] INT-006 — Menghubungkan formulir login admin dan middleware proteksi rute.
- [ ] INT-007 — Menghubungkan CRUD kategori, produk, personalisasi, add-on, dan pengaturan kontak admin.
- [ ] INT-008 — Memverifikasi penyimpanan dan pemanggilan berkas foto produk pada public storage link.

---

# 11. PHASE 9 — SECURITY, QA & USER ACCEPTANCE TESTING

Tujuan: Memastikan sistem aman, bebas bug, dan disetujui sponsor.

- [ ] SEC-001 — Uji coba percobaan bypass akses rute admin tanpa login.
- [ ] SEC-002 — Uji coba keamanan token CSRF pada seluruh form POST/PATCH/DELETE.
- [ ] SEC-003 — Uji sanitasi input teks untuk pencegahan XSS.
- [ ] SEC-004 — Uji validasi berkas upload foto produk (larangan ekstensi terlarang `.php`, `.exe`, dll.).
- [ ] QA-001 — Uji fungsional filter kategori pada katalog publik.
- [ ] QA-002 — Uji keakuratan kalkulasi estimasi harga di browser saat variasi dan add-on dipilih.
- [ ] QA-003 — Uji kelengkapan draf teks pesan yang terkirim ke WhatsApp toko.
- [ ] QA-004 — Uji toggle ketersediaan buket dan pengaruhnya pada tombol pesan WhatsApp.
- [ ] QA-005 — Uji kompatibilitas cross-browser (Chrome, Firefox, Safari, Edge).
- [ ] QA-006 — Pelaksanaan User Acceptance Testing (UAT) bersama Sponsor Nabila Febriyani.
- [ ] QA-007 — Penandatanganan Berita Acara UAT.

---

# 12. PHASE 10 — DEPLOYMENT & PROJECT FINALIZATION

Tujuan: Peluncuran ke lingkungan produksi dan penyerahan sistem.

- [ ] DEP-001 — Persiapan web hosting / cPanel / VPS dan basis data MySQL produksi.
- [ ] DEP-002 — Migrasi database produksi dan seeding data awal.
- [ ] DEP-003 — Konfigurasi kredensial login resmi admin Nabila Febriyani.
- [ ] DEP-004 — Konfigurasi nomor WhatsApp bisnis resmi di pengaturan toko.
- [ ] DEP-005 — Konfigurasi symbolic link storage dan optimasi cache Laravel (`config:cache`, `route:cache`, `view:cache`).
- [ ] DEP-006 — Verifikasi keamanan akhir (`APP_DEBUG=false`, sertifikat SSL HTTPS aktif).
- [ ] FIN-001 — Penyusunan User Manual Penggunaan Panel Admin bagi Nabila Febriyani.
- [ ] FIN-002 — Penyerahan seluruh file dokumentasi proyek final.
- [ ] FIN-003 — Serah terima resmi proyek BLOOMÉ sebelum batas akhir **30 November 2026**.

---

# 13. LOG PARAMETER MENUNGGU KONFIRMASI (`[Perlu Konfirmasi Owner]`)

Task yang bergantung pada keputusan pemilik usaha ditandai secara konsisten:
1. `[!]` Konfirmasi Nomor WhatsApp Resmi Toko untuk pemesanan.
2. `[!]` Konfirmasi Daftar Master Produk & Foto Asli Resolusi Tinggi.
3. `[!]` Konfirmasi Struktur Harga Dasar Produk Final.
4. `[!]` Konfirmasi Daftar Resmi Variasi Warna Wrapping & Pita.
5. `[!]` Konfirmasi Daftar Item Add-on & Harga Tambahannya.
6. `[!]` Konfirmasi Ketentuan Pemesanan Multi-Buket dalam Satu Pesan.
7. `[!]` Konfirmasi Format Rincian Data Pelanggan yang Diperlukan di Chat WA.
8. `[!]` Konfirmasi Cakupan Wilayah & Jam Pengantaran Kurir di Samarinda.
9. `[!]` Konfirmasi Ketentuan DP 50% dan Waktu Pelunasan.
10. `[!]` Konfirmasi Nomor Rekening Bank BCA/BRI & Akun E-Wallet Toko.
11. `[!]` Konfirmasi Kebijakan Pembatalan & Pengembalian Dana (*Refund*).
12. `[!]` Konfirmasi Tautan Akun Instagram & TikTok Resmi Toko.
13. `[!]` Konfirmasi Batas Ukuran Maksimal Upload Foto Produk (2 MB / 5 MB).
14. `[!]` Konfirmasi Pemilihan Domain, Hosting Produksi, dan Jadwal Backup.

---

# 14. PENGESAHAN DOKUMEN TASK MANAGEMENT

Dokumen Master Task Management v1.1 ini disahkan sebagai pedoman operasional seluruh anggota tim:

- **Disusun Oleh:** Jayanti Firdasari (Project Manager & System Analyst)
- **Ditinjau Bersama:** Riya Monika (UI/UX & Frontend) & Elsa Futri (Backend & DBA)
- **Disetujui Oleh:** Nabila Febriyani (Project Sponsor / Owner BLOOMÉ)
- **Tanggal:** 20 November 2026
