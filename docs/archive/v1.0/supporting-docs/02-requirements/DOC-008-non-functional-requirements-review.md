# LAPORAN PENINJAUAN NON-FUNCTIONAL REQUIREMENTS (NFR SPECIFICATION REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-008  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-007 — Meninjau functional requirements (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kebutuhan Nonfungsional (Task DOC-008) dilakukan untuk menetapkan kriteria kualitas operasional, keandalan teknis, performa, keamanan, serta pengalaman pengguna (*User Experience*) sistem informasi **BLOOMÉ — Flowers & Stories**.

Berbeda dengan kebutuhan fungsional yang menjelaskan apa yang dapat dilakukan oleh sistem, kebutuhan nonfungsional menetapkan **bagaimana kualitas sistem saat beroperasi**. Standar yang ditetapkan dalam dokumen ini mengacu pada model kualitas perangkat lunak **ISO/IEC 25010** guna menjamin website tidak hanya berfungsi, namun juga cepat, aman, tangguh, dan mudah dirawat.

---

## 2. Spesifikasi Kualitas & Kebutuhan Nonfungsional

### 2.1 Usabilitas & Pengalaman Pengguna (Usability & UX)
- **Kemudahan Antarmuka:** Tata letak harus intuitif, mengedepankan identitas visual floral yang elegan (*soft pink, warm beige, botanical green*).
- **Konsistensi Navigasi:** Struktur navigasi seragam di seluruh halaman publik dan dashboard admin.
- **Formulir yang Bersahabat:** Label form wajib jelas, dilengkapi *placeholder* informatif, tanda bintang (*) untuk kolom wajib, serta validasi *inline* yang mudah dipahami pemesan.
- **Feedback Visual Multi-State:** Menyediakan indikator visual yang jelas untuk setiap kondisi: *Empty State* (katalog kosong), *Loading State* (indikator tombol memuat saat submit pesanan), *Error Alert* (notifikasi kesalahan input), dan *Success State* (konfirmasi pesanan berhasil).

### 2.2 Responsivitas & Kompatibilitas Multi-Device (Responsiveness)
- **Breakpoint Baku:**
  - **Mobile:** Lebar layar ≤ 576px (tampilan kartu produk 1 kolom, navigasi *hamburger menu* atau modal, tombol aksi sentuh yang nyaman minimum 44x44 px).
  - **Tablet:** Lebar layar 768px – 992px (tampilan kartu produk 2 kolom, tabel admin dengan scroll horizontal atau adaptif).
  - **Desktop:** Lebar layar ≥ 1024px (tampilan kartu produk 3-4 kolom, sidebar admin tetap, grid multi-kolom luas).
- **Kompatibilitas Peramban (*Cross-Browser*):** Berfungsi sempurna tanpa kerusakan tata letak pada peramban modern: Google Chrome, Mozilla Firefox, Microsoft Edge, dan Apple Safari (iOS/macOS).

### 2.3 Performa & Efisiensi Sistem (Performance & Efficiency)
- **Waktu Respons Halaman:** Waktu pemuatan halaman awal (*Initial Page Load*) ≤ 2,0 detik pada koneksi internet standar (4G/WiFi).
- **Optimasi Kueri Basis Data:** Mencegah masalah *N+1 Query Problem* pada pemanggilan data relasi (misalnya produk beserta kategorinya) menggunakan *Eager Loading* Eloquent (`Product::with('category')`).
- **Efisiensi Aset Visual:** Gambar produk dan referensi kustom dioptimasi agar tidak membebani lebar pita (*bandwidth*), memanfaatkan teknik *lazy loading* bawaan browser (`loading="lazy"`).
- **Asset Bundling:** Menggunakan Vite untuk kompilasi dan minifikasi berkas CSS dan JavaScript sehingga ukuran muatan transmisi minimal.

### 2.4 Keamanan & Perlindungan Privasi (Security & Privacy)
- **Autentikasi & Password:** Kata sandi administrator di-hash menggunakan algoritma modern standar industri (Bcrypt atau Argon2id) dengan *salt* otomatis bawaan Laravel.
- **Proteksi CSRF (Cross-Site Request Forgery):** Seluruh formulir dengan metode `POST`, `PUT`, `PATCH`, dan `DELETE` wajib menyertakan token CSRF (`@csrf`).
- **Pencegahan SQL Injection:** Seluruh interaksi basis data wajib menggunakan mekanisme *Parameter Binding* melalui Laravel Eloquent ORM atau Query Builder yang aman. Penggunaan *raw query* tanpa sanitasi dilarang keras.
- **Pencegahan XSS (Cross-Site Scripting):** Seluruh output data pengguna pada view Blade wajib menggunakan sintaks auto-escaping `{{ $data }}`. Penggunaan raw output `{!! $data !!}` hanya diizinkan untuk konten terverifikasi aman.
- **Keamanan Unggah Berkas (*File Upload Security*):**
  - Pemeriksaan ketat ekstensi dan *MIME Type* di sisi server (`image/jpeg`, `image/png`).
  - Pembatasan ukuran berkas maksimum 5 MB per gambar.
  - Nama berkas asli wajib diganti secara acak menggunakan *cryptographically secure hash* (misal: `Str::uuid() . '.' . $extension`).
  - Berkas disimpan di direktori privat penyimpanan lokal (`storage/app/public/...`) yang hanya diekspos melalui symbolic link, dan server dilarang mengeksekusi berkas pada direktori unggahan sebagai script PHP (*no script execution*).

### 2.5 Otorisasi & Kontrol Akses (Access Control)
- **Isolasi Panel Admin:** Semua rute admin (`/admin/*`) wajib dilindungi oleh middleware autentikasi (`auth:admin`). Akses publik tanpa sesi valid otomatis diarahkan kembali ke halaman login.
- **Session Management:** Regenerasi ID sesi setelah login sukses untuk mencegah serangan *Session Fixation*, serta batas *idle timeout* sesi yang wajar.

### 2.6 Integritas Data & Konsistensi Transaksi (Data Integrity)
- **Database ACID Transactions:** Transaksi pemesanan katalog (pembuatan data pelanggan, pembuatan pesanan, pembuatan rincian pesanan, dan inisiasi status awal) wajib dibungkus dalam `DB::transaction()` untuk mencegah data parsial/korup jika terjadi kegagalan jaringan atau server.
- **Integritas Relasional:** Skema basis data wajib memanfaatkan *Foreign Key Constraints* dengan aturan integritas referensial yang tepat (misal: `restrict` penghapusan kategori jika masih memiliki produk aktif).

### 2.7 Keandalan & Penanganan Error (Reliability & Fault Tolerance)
- **Penanganan Error Terpusat:** Sistem tidak boleh menampilkan pesan kesalahan mentah sistem (*technical stack trace*) kepada pengguna publik pada lingkungan *production* (`APP_DEBUG=false`).
- **Halaman Error Khusus:** Menyediakan halaman kesalahan yang ramah dan bernuansa floral untuk HTTP 404 (*Not Found*), 403 (*Forbidden*), dan 500 (*Server Error*).
- **Pencatatan Log Sistem:** Kesalahan sistem dicatat secara otomatis ke dalam berkas log `storage/logs/laravel.log` dengan tingkat keparahan (*log levels: error, warning, critical*).

### 2.8 Kemudahan Pemeliharaan & Kerapian Kode (Maintainability)
- **Arsitektur Tiga Lapis (Three-Layer Architecture):**
  1. *Presentation Layer:* Blade Templates, komponen tampilan modular.
  2. *Application Layer:* Controllers, Form Request Classes (untuk validasi terpisah), Business Services.
  3. *Data Layer:* Eloquent Models, Migrations, Database Seeders.
- **Standar Kode:** Mengikuti standar *PHP Standard Recommendations* (PSR-12) untuk kerapian dan konsistensi penulisan kode.

### 2.9 Pencadangan Data (Backup Strategy)
- Prosedur pencadangan basis data MySQL (*dump backup*) disiapkan secara berkala untuk memitigasi risiko kehilangan data transaksi pelanggan.

---

## 3. Matriks Kepatuhan & Metode Pengujian NFR

| Kategori NFR | Metrik Target | Metode Pengujian (Fase 9 QA) |
|---|---|---|
| **Performa Halaman** | Load time ≤ 2 detik | Browser DevTools Network tab & Lighthouse Audit |
| **Responsivitas** | 100% responsif pada 360px, 768px, 1280px | Chrome Device Emulation & pengujian perangkat nyata |
| **Keamanan Form** | Token CSRF valid pada seluruh aksi POST | Security penetration test manual & inspect element |
| **Keamanan Upload** | Berkas .php/.exe ditolak, berkas >5MB ditolak | Uji upload berkas ilegal & *boundary test* ukuran berkas |
| **Proteksi Admin** | Akses anonim ke `/admin/*` menghasilkan redirect | Uji navigasi tanpa session login di mode *Incognito* |
| **Integritas Transaksi** | Tidak ada *orphaned records* saat DB error | Simulasi pembatalan query di tengah eksekusi transaksi |
| **Penanganan Error** | Halaman 404/500 kustom tampil ramah | Akses URL acak dan trigger exception terkontrol |

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-008
Task **DOC-008 (Meninjau non-functional requirements)** telah selesai dilaksanakan:
- 11 kategori kebutuhan nonfungsional telah diuraikan menjadi parameter teknis yang spesifik, terukur, dan dapat diuji.
- Standar kualitas sistem selaras dengan kemampuan teknologi stack Laravel, MySQL, dan arsitektur Three-Layer.
- Kriteria penyelesaian terpenuhi.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan berikutnya pada sub-fase 4.2:
- **`DOC-009 — Meninjau business rules.`**

