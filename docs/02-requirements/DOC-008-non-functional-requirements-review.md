# LAPORAN PENINJAUAN NON-FUNCTIONAL REQUIREMENTS (NFR SPECIFICATION REVIEW) (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-008  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan Awal:** 13 November 2026  
**Tanggal Revisi Penyelarasan:** 20 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-007 — Meninjau functional requirements (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kebutuhan Nonfungsional (Task DOC-008) dilakukan untuk menetapkan kriteria kualitas operasional, keandalan teknis, performa, keamanan, serta pengalaman pengguna (*User Experience*) sistem informasi **BLOOMÉ — Flowers & Stories**.

Berdasarkan kesepakatan baseline **v1.1**, sistem web difokuskan sebagai **katalog interaktif dan media personalisasi buket bunga, dengan alur pemesanan dialihkan langsung ke WhatsApp**.

Standar kualitas nonfungsional yang ditetapkan dalam dokumen ini mengacu pada model kualitas perangkat lunak **ISO/IEC 25010** guna menjamin website tidak hanya berfungsi, namun juga cepat diakses, aman dari celah siber, sangat responsif di perangkat mobile smartphone, dan mudah dirawat oleh pemilik usaha.

---

## 2. Spesifikasi Kualitas & Kebutuhan Nonfungsional (v1.1)

### 2.1 Usabilitas & Pengalaman Pengguna (Usability & UX)
- **Kemudahan Antarmuka:** Tata letak mengedepankan identitas visual butik floral elegan bernuansa feminin lembut (*Primary Pink #E99AAF, Soft Pink #F6DDE3, Warm White #FFFCFB, Burgundy #642D36*).
- **Interaktivitas Tanpa Beban:** Antarmuka pemilihan personalisasi buket (warna wrapping dan pita) menggunakan visual color swatch lingkaran yang mudah disentuh jempol pada layar smartphone.
- **Transparansi Kalkulasi Harga:** Kartu ringkasan pesanan menampilkan rincian harga dasar, biaya tambahan variasi jika ada, dan item add-on secara gamblang dengan total estimasi yang otomatis diperbarui di browser.
- **Feedback Visual Multi-State:** Menyediakan indikator visual yang jelas untuk setiap kondisi: *Empty State* (katalog kategori kosong), *Loading State* (animasi shimmer saat memuat data produk), *Error Alert* (notifikasi kesalahan form admin), dan *Success State* (notifikasi simpan data berhasil).

### 2.2 Responsivitas & Pendekatan Mobile-First (Responsiveness)
- **Pendekatan Mobile-First:** Mengingat mayoritas pelanggan akan mengakses web dan membuka aplikasi WhatsApp melalui ponsel, seluruh tata letak diprioritaskan agar nyaman dioperasikan satu tangan pada smartphone.
- **Breakpoint Baku:**
  - **Mobile:** Lebar layar ≤ 576px (tampilan kartu produk 1 kolom penuh lebar 100%, sticky bottom bar untuk tombol WhatsApp, tombol aksi sentuh minimum 44×44 px).
  - **Tablet:** Lebar layar 768px – 992px (tampilan kartu produk 2 kolom simetris).
  - **Desktop:** Lebar layar ≥ 1024px (tampilan kartu katalog 3–4 kolom, tampilan halaman detail 2 kolom: galeri foto di kiri dan konfigurator personalisasi di kanan, panel sidebar admin selebar 260px).
- **Kompatibilitas Peramban (*Cross-Browser*):** Berfungsi mulus tanpa kerusakan visual pada Google Chrome, Mozilla Firefox, Microsoft Edge, dan Apple Safari (iOS/macOS).

### 2.3 Performa & Efisiensi Sistem (Performance & Efficiency)
- **Waktu Muat Halaman (Page Load Time):** Waktu render awal (*Initial Page Load*) katalog ≤ 2,0 detik pada jaringan seluler 4G.
- **Kalkulasi Sisi Klien Instan:** Perhitungan estimasi harga variasi dan add-on dijalankan secara lokal di browser melalui JavaScript (`personalization.js`) sehingga memberikan respon *zero latency* tanpa request bolak-balik ke server.
- **Optimasi Kueri Basis Data:** Mencegah masalah *N+1 Query Problem* pada pemanggilan data katalog menggunakan *Eager Loading* Eloquent (`Product::with(['category', 'personalizationOptions.values', 'addOns'])`).
- **Kompresi & Minifikasi Aset:** Menggunakan Vite untuk kompilasi dan minifikasi berkas CSS dan JavaScript, serta menerapkan atribut `loading="lazy"` pada gambar katalog buket.

### 2.4 Keamanan & Perlindungan Siber (Security & Privacy)
- **Autentikasi Admin Tunggal:** Kata sandi administrator di-hash menggunakan algoritma modern standar industri (Bcrypt/Argon2id) dengan *salt* adaptif bawaan Laravel.
- **Proteksi CSRF (Cross-Site Request Forgery):** Seluruh formulir dengan metode `POST`, `PUT`, `PATCH`, dan `DELETE` wajib menyertakan token CSRF (`@csrf`).
- **Pencegahan SQL Injection:** Seluruh manipulasi basis data wajib menggunakan mekanisme *Parameter Binding* melalui Eloquent ORM atau Query Builder yang aman. Penggunaan *raw query* tanpa sanitasi dilarang mutlak.
- **Pencegahan XSS (Cross-Site Scripting):** Seluruh output data dinamis pada template Blade wajib menggunakan sintaks auto-escaping `{{ $data }}`.
- **Keamanan Unggah Berkas Foto (*File Upload Security*):**
  - Pemeriksaan ketat ekstensi dan *MIME Type* di sisi server (`image/jpeg`, `image/png`, `image/webp`).
  - Pembatasan ukuran berkas foto maksimal **[Perlu Konfirmasi Owner]** (standar: 2–5 MB).
  - Nama berkas asli dibuang dan diganti dengan hash UUID acak (`Str::uuid() . '.' . $extension`) untuk mencegah eksploitasi penimpaan berkas (*file overwrite*).
  - Berkas disimpan di direktori privat penyimpanan lokal (`storage/app/public/products/`) yang diekspos melalui symbolic link, dan server dilarang mengeksekusi berkas pada direktori tersebut sebagai script PHP.

### 2.5 Otorisasi & Kontrol Akses (Access Control)
- **Isolasi Rute Admin:** Seluruh rute admin (`/admin/*`) wajib dilindungi middleware `auth:admin`. Akses publik anonim otomatis dialihkan ke formulir login `/admin/login`.
- **Session Management:** Regenerasi ID sesi secara otomatis saat admin login sukses untuk mencegah serangan *Session Fixation*, serta batas waktu *session timeout* 120 menit.

### 2.6 Integritas Data & Konsistensi Master Data (Data Integrity)
- **Database ACID Transactions:** Operasi multi-tabel pada manajemen master data admin (misalnya penambahan produk baru beserta multi-foto galeri dan relasi opsi personalisasi/add-on) dibungkus dalam `DB::transaction()` untuk mencegah data parsial jika terjadi gangguan kueri.
- **Integritas Relasional:** Skema MySQL InnoDB menerapkan aturan *Foreign Key Constraints* yang tepat:
  - Aturan `RESTRICT` pada relasi produk terhadap kategori (mencegah kategori terhapus jika masih memiliki produk aktif).
  - Aturan `CASCADE` pada relasi galeri foto, pivot personalisasi, dan pivot add-on terhadap produk (otomatis terhapus bersih jika produk dihapus).

### 2.7 Keandalan & Penanganan Error (Reliability)
- **Penanganan Error Terpusat:** Sistem tidak boleh menampilkan pesan kesalahan teknis mentah (*stack trace*) kepada pengunjung pada lingkungan produksi (`APP_DEBUG=false`).
- **Halaman Error Khusus:** Menyediakan halaman kesalahan bertema floral boutique yang ramah untuk HTTP 404 (*Halaman Tidak Ditemukan*), 403 (*Akses Ditolak*), dan 500 (*Kesalahan Server*).
- **Pencatatan Log Sistem:** Kesalahan sistem dicatat secara otomatis ke dalam berkas log `storage/logs/laravel.log`.

### 2.8 Kemudahan Pemeliharaan & Kerapian Kode (Maintainability)
- **Three-Layer Architecture:**
  1. *Presentation Layer:* Blade Templates, komponen tampilan modular, JavaScript perakit pesan WhatsApp.
  2. *Application Layer:* Controllers, Form Request Classes (validasi terpisah), Domain Services (`WhatsAppUrlBuilderService`, `ImageUploadService`).
  3. *Data Layer:* Eloquent Models, Migrations (10 tabel), Database Seeders.
- **Standar Kode:** Mengikuti kaidah *PHP Standard Recommendations* (PSR-12).

### 2.9 Pencadangan Data (Backup Strategy)
- Prosedur pencadangan berkala basis data MySQL disiapkan guna melindungi data master katalog, konfigurasi variasi personalisasi, dan pengaturan nomor kontak bisnis.

---

## 3. Matriks Kepatuhan & Metode Pengujian NFR

| Kategori NFR | Metrik Target | Metode Pengujian (Fase 9 QA) |
|---|---|---|
| **Performa Halaman** | Initial Page Load ≤ 2 detik | Browser DevTools Network tab & Lighthouse Audit |
| **Responsivitas Layar** | 100% responsif pada 360px, 768px, 1280px | Chrome Device Emulation & pengujian perangkat smartphone nyata |
| **Keamanan Form** | Token CSRF valid pada seluruh aksi POST/PATCH/DELETE | Security penetration test manual & inspect element |
| **Keamanan Upload** | Berkas .php/.exe ditolak, berkas melebihi batas kuota ditolak | Uji upload berkas terlarang & uji batas ukuran berkas |
| **Proteksi Admin** | Akses anonim ke `/admin/*` dialihkan ke login | Uji navigasi URL admin tanpa sesi login di mode penyamaran |
| **Akurasi Live Calc** | Total harga = harga dasar + variasi + add-on | Uji kombinasi klik swatch dan checkbox add-on di browser |
| **Penanganan Error** | Halaman 404/500 kustom tampil ramah | Akses URL acak dan trigger exception terkontrol |

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-008
Task **DOC-008 (Meninjau non-functional requirements)** telah selesai diselaraskan ke baseline **v1.1**:
- Seluruh spesifikasi kebutuhan nonfungsional telah diharmonisasikan dengan arsitektur katalog interaktif dan pemesanan WhatsApp.
- Standar kualitas sistem selaras dengan Three-Layer Architecture Laravel dan MySQL InnoDB.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan berikutnya pada sub-fase 4.2:
- **`DOC-009 — Meninjau business rules.`**
