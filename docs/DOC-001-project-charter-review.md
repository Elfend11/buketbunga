# LAPORAN PEMERIKSAAN PROJECT CHARTER (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-001  
**Fase:** Phase 1 — Project Initiation and Documentation  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Pemeriksaan:** 13 November 2026  
**Tanggal Revisi Penyelarasan:** 20 November 2026  
**Status Task:** Completed (`[x]`)  

---

## 1. Ringkasan Eksekutif

Pemeriksaan Project Charter (Task DOC-001) dilakukan untuk memvalidasi dasar pijakan proyek pengembangan sistem informasi **BLOOMÉ — Flowers & Stories**. Evaluasi penyelarasan versi 1.1 ini memastikan bahwa seluruh parameter mendasar—meliputi identitas proyek, sponsor, tujuan, ruang lingkup, jadwal, tim, teknologi, serta batasan sistem—telah terdefinisi secara konsisten dan selaras dengan 10 dokumen acuan utama terbaru di root (`prompt.md`, `requirement.md`, `prd.md`, `architecture.md`, `database-design.md`, `design-system.md`, `user-flow.md`, `implementation-plan.md`, `task.md`, dan `testing-plan.md`).

Berdasarkan kesepakatan final proses bisnis antara tim pengembang dan pemilik usaha (Nabila Febriyani):
> **"Website BLOOMÉ berfungsi sebagai katalog interaktif dan media personalisasi buket bunga, sedangkan proses transaksi pemesanan, konfirmasi ketersediaan bahan, negosiasi harga, pembayaran, dan koordinasi pengiriman dilanjutkan secara langsung melalui WhatsApp."**

Baseline inisiasi proyek dinyatakan **VALID, LENGKAP, KONSISTEN, dan SIAP MENJADI LANDASAN FASE BERIKUTNYA**, dengan parameter operasional yang belum ditentukan ditandai secara konsisten sebagai `[Perlu Konfirmasi Owner]`.

---

## 2. Identitas Proyek & Entitas Bisnis

| Parameter | Rincian Dokumen Charter | Status Validasi |
|---|---|---|
| **Nama Produk / Brand** | BLOOMÉ — Flowers & Stories | Valid |
| **Nama Proyek** | Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web | Valid |
| **Jenis Sistem** | Web-Based Interactive Bouquet Catalog & Personalization System (with WhatsApp Ordering) | Valid (Diselaraskan v1.1) |
| **Project Sponsor / Owner** | Nabila Febriyani (Pemilik Usaha BLOOMÉ) | Valid |
| **Lokasi Operasional** | Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Kota Samarinda, Kalimantan Timur | Valid |
| **Model Bisnis** | Katalog buket bunga siap pesan, konfigurasi personalisasi, pemilihan add-on, dan pemesanan via WhatsApp | Valid (Diselaraskan v1.1) |

---

## 3. Latar Belakang Masalah & Justifikasi Proyek

Operasional bisnis BLOOMÉ sebelumnya mengandalkan aplikasi perpesanan WhatsApp secara manual tanpa media etalase digital. Kondisi ini menimbulkan sejumlah tantangan operasional:
1. **Katalog Tidak Terpusat:** Foto produk dan ketersediaan stok tercecer dalam obrolan chat dan media sosial.
2. **Komunikasi Berulang:** Pemilik toko harus berulang kali mengetik daftar harga, mengirim contoh warna kertas pembungkus (*wrapping*), dan menjelaskan opsi tambahan satu per satu.
3. **Format Chat Pelanggan Berantakan:** Pelanggan mengirimkan pesan yang tidak lengkap (hanya mengirim foto tanpa rincian warna pita, kartu ucapan, atau tanggal kebutuhan), sehingga memperpanjang waktu konfirmasi.
4. **Keterbatasan Waktu Pemilik:** Pemilik usaha merangkai bunga sekaligus melayani chat, sehingga membutuhkan media etalase yang mampu mengedukasi pembeli sebelum memulai percakapan pemesanan.

**Justifikasi:** Pengembangan website BLOOMÉ mendesak untuk menyentralisasi etalase katalog, memfasilitasi konfigurasi personalisasi dan add-on secara visual, menghitung estimasi harga total secara instan, serta menyusun template pesan WhatsApp otomatis yang rapi dan terstandarisasi bagi pemilik toko.

---

## 4. Tujuan Proyek (Project Objectives v1.1)

1. Menyediakan platform katalog produk buket berbasis web yang elegan, modern, responsif, dan dapat diakses publik 24/7.
2. Memfasilitasi eksplorasi produk buket dengan penyaringan berdasarkan kategori yang dikelola admin.
3. Menyediakan modul konfigurasi personalisasi buket interaktif (pilihan warna wrapping, jenis pita satin, dan nuansa buket) secara visual.
4. Menyediakan modul pemilihan item tambahan (*add-on*) seperti kartu ucapan cetak, boneka wisuda, lampu LED, dan topper akrilik.
5. Menyediakan fitur kalkulasi estimasi total harga secara *real-time* di sisi antarmuka browser sebelum pemesanan diteruskan.
6. Menyusun draf pesan pemesanan WhatsApp terstruktur secara otomatis dan menghubungkannya langsung ke WhatsApp resmi toko (`https://wa.me/...`).
7. Menyediakan saluran khusus konsultasi buket custom (*fully custom design*) langsung via WhatsApp bagi pelanggan yang menginginkan desain khusus di luar katalog.
8. Menyediakan panel dashboard admin mandiri bagi pemilik usaha untuk mengelola katalog, kategori, foto galeri, opsi variasi personalisasi, item add-on, ketersediaan stok, dan nomor WhatsApp toko.
9. Menghilangkan kompleksitas pemeliharaan modul pembayaran, modul pelacakan status pesanan internal, dan akun pelanggan di website yang tidak dibutuhkan oleh skala operasional butik saat ini.

---

## 5. Batasan Ruang Lingkup (Scope Baseline v1.1)

### 5.1 In-Scope (Termasuk dalam Sistem Web)
- **Modul Publik / Pelanggan:**
  - Halaman Beranda (*Homepage*): Identitas brand, hero banner, pengenalan usaha, produk unggulan, kategori buket, kontak, dan footer.
  - Katalog Produk & Navigasi Kategori: Grid buket interaktif dengan filter kategori (Buket Bunga, Buket Uang, Buket Snack, Buket Boneka).
  - Halaman Detail Produk: Galeri multi-foto, rincian komposisi buket, harga dasar, deskripsi, dan status ketersediaan.
  - Konfigurator Personalisasi: Pemilihan variasi warna kertas wrapping dan pita dengan swatch warna visual.
  - Pemilih Add-on: Checkbox item pelengkap (kartu ucapan, boneka, topper, lampu LED) beserta kalkulasi harga tambahan.
  - Input Catatan Khusus: Area teks untuk instruksi perangkaian dan pesan kartu ucapan.
  - Ringkasan Konfigurasi & Estimasi Harga: Tampilan rincian pilihan dan kalkulasi total harga otomatis di sisi klien.
  - Generator Pesan WhatsApp & Direct Link: Penyusunan teks draf pemesanan otomatis dan pemicuan tautan `wa.me`.
  - Halaman & Tombol Konsultasi Buket Custom via WhatsApp.
  - Halaman Informasi Profil Usaha (*About Us*) dan Kontak Resmi Samarinda (*Contact Us*).
- **Modul Admin (Dashboard):**
  - Autentikasi Admin tunggal yang aman (login/logout terproteksi hash Bcrypt dan token CSRF).
  - Dashboard Overview Metrik Etalase (jumlah produk aktif, produk habis, kategori, dan add-on).
  - Manajemen Kategori Buket (CRUD Categories & slug otomatis).
  - Manajemen Produk Katalog (CRUD Products & toggle status ketersediaan).
  - Manajemen Galeri Multi-Foto Produk (CRUD Product Images).
  - Manajemen Opsi & Nilai Variasi Personalisasi (CRUD Options & Values).
  - Penetapan Opsi Personalisasi ke Produk (*Product Personalization Assignment*).
  - Manajemen Item Add-on & Harga (CRUD Add-ons & penetapan ke produk).
  - Manajemen Pengaturan Bisnis & WhatsApp (nomor WhatsApp penerima pesanan, jam operasional, alamat toko Samarinda).

### 5.2 Out-of-Scope (Dikecualikan Secara Tegas dari Sistem Web)
- Sistem registrasi, login, dan profil akun pelanggan (pelanggan mengakses sebagai tamu / *guest user*).
- Keranjang belanja multi-langkah (*shopping cart*) dan modul *checkout* pembayaran di web.
- Penyimpanan data transaksi pemesanan resmi ke dalam basis data web.
- Pengelolaan status pesanan internal dan riwayat siklus status (ST-01 s/d ST-08 di web dieliminasi).
- Pemrosesan transaksi pembayaran dan integrasi *payment gateway* otomatis (Midtrans, Xendit, dll.).
- Formulir unggah bukti transfer pembayaran di website.
- Verifikasi mutasi pembayaran di website.
- Manajemen tawar-menawar atau negosiasi harga di website.
- Otomasi pengiriman notifikasi via WhatsApp Business API Gateway (pengiriman dilakukan manual oleh pemesan melalui skema URL WhatsApp).
- Manajemen kurir otomatis, penghitungan ongkir GPS/ekspedisi, dan live tracking pengiriman.
- Manajemen hak akses multi-admin (hanya satu akun admin pemilik usaha).
- Sistem akuntansi finansial otomatis neraca laba-rugi.

---

## 6. Susunan Tim & Matriks Tanggung Jawab (RACI)

| Anggota Tim | Peran Utama | Tanggung Jawab Utama |
|---|---|---|
| **Nabila Febriyani** | Project Sponsor & Business Owner | Persetujuan ruang lingkup, konfirmasi parameter bisnis terbuka, validasi alur operasional WhatsApp, persetujuan acceptance akhir (UAT) |
| **Jayanti Firdasari** | Project Manager & System Analyst | Perencanaan proyek, analisis kebutuhan (SRS/PRD), pemodelan sistem (UML), koordinasi tim, pengawasan timeline 7 minggu, dan QA Lead |
| **Riya Monika** | UI/UX Designer & Frontend Developer | Design system, wireframing, mockup, prototipe, implementasi Blade views, styling responsif, swatch warna personalisasi, dan script perakit pesan WhatsApp |
| **Elsa Futri** | Backend Developer & Database Administrator | Arsitektur Three-Layer, pemodelan 10 tabel basis data MySQL, Eloquent models, autentikasi admin, CRUD controllers, file storage, dan layanan pendukung |

---

## 7. Kerangka Waktu & Metodologi (Timeline & Milestones)

- **Metodologi Pengembangan:** Waterfall (berurutan dengan quality gate antar fase).
- **Periode Pelaksanaan:** 13 Oktober 2026 – 30 November 2026 (7 Minggu / 49 Hari Kalender).
- **Fase Proyek:**
  1. *Phase 1:* Project Initiation and Documentation (13 – 18 Okt 2026)
  2. *Phase 2:* System Analysis and Design (19 – 25 Okt 2026)
  3. *Phase 3:* UI/UX Design & Prototyping (26 Okt – 1 Nov 2026)
  4. *Phase 4:* Database Design and Migrations (2 – 6 Nov 2026)
  5. *Phase 5:* Laravel Project Foundation (7 – 10 Nov 2026)
  6. *Phase 6 & 7:* Backend & Frontend Development (11 – 20 Nov 2026)
  7. *Phase 8:* System Integration & WhatsApp Link Testing (21 – 24 Nov 2026)
  8. *Phase 9:* Security, Quality Assurance & UAT Sponsor (25 – 28 Nov 2026)
  9. *Phase 10:* Deployment, Finalization & Handover (29 – 30 Nov 2026)

---

## 8. Arsitektur & Fondasi Teknis (Three-Layer Architecture)

- **Presentation Layer:** Laravel Blade Templates, Custom Styling (tema Floral Boutique), JavaScript interaktif (`personalization.js` untuk live calculation & WhatsApp URL encoding), Vite Asset Bundler.
- **Application Layer:** Laravel HTTP Routing (`routes/web.php`), Middleware `auth:admin`, Form Requests, Controllers CRUD, `WhatsAppUrlBuilderService`, `ImageUploadService`.
- **Data Layer:** MySQL 8.0+ Database (InnoDB, `utf8mb4_unicode_ci`), 10 tabel terpadu (`admins`, `categories`, `products`, `product_images`, `personalization_options`, `personalization_values`, `product_personalization_options`, `add_ons`, `product_add_ons`, `business_settings`), Storage Link lokal (`storage/app/public/products`).

---

## 9. Log Informasi Menunggu Konfirmasi (`[Perlu Konfirmasi Owner]`)

Pemeriksaan mencatat hal-hal berikut yang belum ditetapkan secara final oleh Nabila Febriyani:
1. Nomor WhatsApp resmi toko untuk penerimaan pesan pesanan.
2. Daftar master produk katalog, foto asli resolusi tinggi, dan deskripsi final.
3. Struktur harga dasar produk buket final.
4. Daftar variasi personalisasi resmi dan kepastian ada/tidaknya biaya tambahan.
5. Daftar item add-on resmi beserta harga jual tambahannya.
6. Ketentuan teknis pemesanan multi-buket dalam satu pesan WhatsApp.
7. Format rincian data pelanggan yang wajib disertakan pada template pesan WhatsApp.
8. Format alamat lengkap dan jadwal pengantaran kurir di Samarinda.
9. Penerapan DP 50% dan batas waktu pelunasan (sebelum perangkaian atau sebelum pengiriman).
10. Detail nomor rekening bank (BCA/BRI) dan akun e-wallet resmi toko.
11. Kebijakan pembatalan pesanan dan aturan pengembalian dana (*refund*).
12. Tautan resmi profil media sosial (Instagram, TikTok) BLOOMÉ Samarinda.
13. Batas maksimal ukuran berkas unggahan foto produk admin (2 MB atau 5 MB).
14. Rencana pemilihan nama domain, penyedia web hosting produksi, dan jadwal backup database.

> **Peringatan Tim:** Seluruh anggota tim dilarang mengasumsikan atau mengimplementasikan kebijakan sepihak untuk poin-poin di atas sebelum konfirmasi tertulis diberikan oleh sponsor proyek.

---

## 10. Kesimpulan & Rekomendasi

### 10.1 Status Task DOC-001
Task **DOC-001 (Memeriksa Project Charter)** telah diselaraskan penuh dengan konsep sistem terbaru v1.1:
- Identitas dan batas ruang lingkup sistem katalog interaktif dan pemesanan WhatsApp telah konsisten 100% dengan dokumen acuan utama di root.
- Tanggung jawab tim, metodologi Waterfall, dan jadwal 13 Oktober – 30 November 2026 terverifikasi utuh.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 10.2 Rekomendasi Langkah Berikutnya
Melanjutkan penyelarasan deliverable berikutnya pada folder foundation:
- **`DOC-002-project-scope-review.md` — Pemeriksaan Ruang Lingkup Proyek.**
