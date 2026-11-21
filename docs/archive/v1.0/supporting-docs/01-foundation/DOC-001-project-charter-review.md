# LAPORAN PEMERIKSAAN PROJECT CHARTER
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-001  
**Fase:** Phase 1 — Project Initiation and Documentation  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Pemeriksaan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  

---

## 1. Ringkasan Eksekutif

Pemeriksaan Project Charter (Task DOC-001) dilakukan untuk memvalidasi dasar pijakan proyek pengembangan sistem informasi **BLOOMÉ — Flowers & Stories**. Evaluasi ini memastikan bahwa seluruh parameter mendasar—meliputi identitas proyek, sponsor, tujuan, ruang lingkup, jadwal, tim, teknologi, serta batasan—telah terdefinisi secara konsisten dan selaras dengan dokumen acuan proyek lainnya (`requirement.md`, `prd.md`, `architecture.md`, dan `task.md`).

Berdasarkan hasil pemeriksaan dokumen, baseline inisiasi proyek dinyatakan **VALID, LENGKAP, dan SIAP MENJADI LANDASAN FASE BERIKUTNYA**, dengan beberapa catatan operasional yang memerlukan konfirmasi lanjutan dari sponsor proyek.

---

## 2. Identitas Proyek & Entitas Bisnis

| Parameter | Rincian Dokumen Charter | Status Validasi |
|---|---|---|
| **Nama Produk** | BLOOMÉ — Flowers & Stories | Valid |
| **Nama Proyek** | Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web | Valid |
| **Jenis Sistem** | Web-Based Bouquet Ordering and Customization Information System | Valid |
| **Project Sponsor** | Nabila Febriyani (Pemilik Usaha BLOOMÉ) | Valid |
| **Lokasi Operasional** | Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Kota Samarinda | Valid |
| **Model Bisnis** | Pemesanan buket bunga siap pesan (katalog) dan pesanan personalisasi (custom) | Valid |

---

## 3. Latar Belakang Masalah & Justifikasi Proyek

Operasional bisnis BLOOMÉ sebelumnya mengandalkan aplikasi perpesanan WhatsApp secara manual. Kondisi ini menimbulkan sejumlah tantangan operasional:
1. **Katalog Tidak Terpusat:** Foto produk dan ketersediaan stok tercecer dalam obrolan chat dan media sosial.
2. **Komunikasi Berulang:** Pelanggan harus menanyakan detail harga, ketersediaan bahan, dan opsi buket secara berulang.
3. **Pencatatan Rawan Tercecer:** Data pemesanan dicatat secara manual di buku/catatan terpisah tanpa basis data terstruktur.
4. **Alur Custom Memakan Waktu:** Permintaan personalisasi buket memerlukan negosiasi manual yang tidak terstandarisasi.
5. **Verifikasi Pembayaran Manual Tanpa Sistem:** Bukti transfer dicek tanpa pencatatan status transaksi yang terintegrasi.
6. **Keterbatasan Waktu Pemilik:** Pemilik usaha memiliki aktivitas usaha lain sehingga membutuhkan sistem informasi yang otomatis merapikan data transaksi.

**Justifikasi:** Pengembangan website BLOOMÉ mendesak untuk menyentralisasi katalog, menstandarisasi formulir pemesanan katalog dan custom, serta menyediakan dashboard admin terpadu bagi pemilik usaha.

---

## 4. Tujuan Proyek (Project Objectives)

1. Menyediakan platform katalog produk buket berbasis web yang dapat diakses publik 24/7.
2. Memfasilitasi alur pemesanan produk katalog secara terstruktur tanpa mengharuskan registrasi/login akun.
3. Menyediakan modul pengajuan personalisasi buket (*custom bouquet*) lengkap dengan opsi spesifikasi dan unggah gambar referensi.
4. Memfasilitasi pemilik usaha/admin untuk meninjau permintaan custom dan menetapkan harga secara manual di sistem.
5. Mengintegrasikan pencatatan seluruh pesanan pelanggan ke dalam basis data terpusat.
6. Mengelola informasi pembayaran manual (transfer bank & e-wallet) dan verifikasi bukti bayar oleh admin.
7. Memfasilitasi pengelolaan dan pembaruan 8 status transisi pesanan secara konsisten.
8. Menyediakan mekanisme pengajuan dan persetujuan/penolakan pembatalan pesanan.
9. Membangun antarmuka yang estetis, responsif (desktop, tablet, mobile), dan ramah pengguna sesuai design system floral.
10. Membantu pemilik usaha memantau kinerja operasional melalui dashboard admin.

---

## 5. Batasan Ruang Lingkup (Scope Baseline)

### 5.1 In-Scope (Termasuk dalam Proyek)
- **Modul Publik/Pelanggan:**
  - Halaman Beranda (Hero, Produk Unggulan, Kategori, Cerita/Tentang Usaha).
  - Katalog Produk & Navigasi Kategori (Buket Bunga, Buket Uang, Buket Snack, dll.).
  - Halaman Detail Produk.
  - Formulir Pemesanan Katalog (Data pemesan, alamat, catatan kartu ucapan).
  - Formulir Personalisasi Buket Custom (Bahan bunga, skema warna, tema, catatan, serta unggah referensi foto).
  - Halaman Ringkasan Pesanan & Petunjuk Pembayaran Manual.
  - Halaman Konfirmasi Penerimaan / Pengajuan Pesanan.
  - Halaman Tentang Kami & Kontak.
- **Modul Admin (Dashboard):**
  - Autentikasi Admin tunggal yang aman.
  - Manajemen Kategori & Produk (CRUD, upload foto, status ketersediaan).
  - Manajemen Pesanan Katalog & Detail Pesanan.
  - Manajemen Permintaan Custom & Peninjauan Gambar Referensi.
  - Formulir Penetapan Harga Custom oleh Admin.
  - Manajemen Pembayaran & Verifikasi Manual Bukti Pembayaran.
  - Pengelolaan 8 Siklus Status Pesanan (*Pending*, *Awaiting Payment*, *Paid*, *In Process*, *Ready*, *Delivered*, *Cancelled*, *Completed*).
  - Penanganan Pengajuan Pembatalan Pesanan.

### 5.2 Out-of-Scope (Di Luar Ruang Lingkup)
- Sistem registrasi, login, dan profil akun pelanggan (pelanggan memesan sebagai guest).
- Integrasi payment gateway otomatis (Midtrans, Xendit, dll.).
- Integrasi bot notifikasi WhatsApp otomatis via API berbayar.
- Halaman pelacakan mandiri real-time pelanggan (order tracking portal).
- Perhitungan kalkulator harga otomatis untuk custom bouquet.
- Manajemen kurir otomatis / integrasi logistik API (JNE, Gosend, dll.).
- Manajemen multi-role admin (tahap awal hanya satu akun admin utama).
- Sistem akuntansi finansial otomatis dan pembukuan neraca laba-rugi.

---

## 6. Susunan Tim & Matriks Tanggung Jawab (RACI)

| Anggota Tim | Peran Utama | Tanggung Jawab Utama |
|---|---|---|
| **Nabila Febriyani** | Project Sponsor & Business Owner | Persetujuan ruang lingkup, verifikasi kebutuhan bisnis, validasi alur operasional, persetujuan acceptance akhir |
| **Jayanti Firdasari** | Project Manager & System Analyst | Perencanaan proyek, analisis kebutuhan (SRS/PRD), diagram sistem (UML), koordinasi tim, pengawasan timeline, UAT & pelaporan |
| **Riya Monika** | UI/UX Designer & Frontend Developer | Design system, wireframing, high-fidelity mockup, prototipe interaktif, implementasi Blade views, styling responsif, integrasi antarmuka |
| **Elsa Futri** | Backend Developer & Database Administrator | Desain arsitektur teknis, pemodelan database (ERD & Migrations), business logic Laravel, controller, model Eloquent, autentikasi & keamanan sistem |

---

## 7. Kerangka Waktu & Metodologi (Timeline & Milestones)

- **Metodologi Pengembangan:** Waterfall (berurutan dengan quality gate antar fase).
- **Periode Pelaksanaan:** 13 Oktober 2026 – 30 November 2026 (~7 Minggu).
- **Fase Proyek:**
  1. *Phase 1:* Project Initiation and Documentation (13 – 18 Okt 2026)
  2. *Phase 2:* System Analysis and Design (19 – 25 Okt 2026)
  3. *Phase 3:* UI/UX Design (26 Okt – 1 Nov 2026)
  4. *Phase 4:* Database Design and Implementation (2 – 6 Nov 2026)
  5. *Phase 5:* Laravel Project Foundation (7 – 10 Nov 2026)
  6. *Phase 6 & 7:* Backend & Frontend Development (11 – 20 Nov 2026)
  7. *Phase 8:* System Integration (21 – 24 Nov 2026)
  8. *Phase 9:* Security and Quality Assurance / UAT (25 – 28 Nov 2026)
  9. *Phase 10:* Deployment, Finalization & Handover (29 – 30 Nov 2026)

---

## 8. Arsitektur & Fondasi Teknis

- **Pola Arsitektur:** Three-Layer Architecture:
  1. *Presentation Layer:* Laravel Blade Templates, Vanilla CSS / Component Styling, JavaScript, Vite Asset Bundler.
  2. *Application Layer:* Laravel Routing, Controllers, Form Requests, Middleware, Services (jika diperlukan), Eloquent ORM.
  3. *Data Layer:* MySQL Database, Laravel Migrations, Storage Link untuk media/gambar.
- **Batasan File:** Gambar produk dan referensi custom berformat JPG, JPEG, atau PNG dengan ukuran maksimal 5 MB per file.

---

## 9. Log Informasi Tertunda / Memerlukan Konfirmasi (`[PERLU KONFIRMASI]`)

Pemeriksaan mencatat hal-hal berikut yang belum final dalam charter dan menunggu keputusan sponsor:
1. Batas maksimal jumlah gambar referensi yang boleh diunggah per permintaan custom.
2. Kewajiban unggah file bukti transfer di website vs konfirmasi manual via admin.
3. Rincian field data pemesan (misal apakah diperlukan nomor telepon alternatif/akun media sosial).
4. Nomor rekening bank dan akun e-wallet resmi milik usaha.
5. Kebijakan operasional pengambilan (*self pick-up*) vs pengantaran (*delivery*) lokal Samarinda.
6. Pemilihan nama domain dan penyedia hosting production.
7. Kesepakatan SLA dukungan purnajual (*post-launch warranty*).

> **Peringatan Tim:** Seluruh anggota tim dilarang mengasumsikan atau mengimplementasikan kebijakan sepihak untuk poin-poin di atas sebelum konfirmasi tertulis diberikan oleh sponsor proyek.

---

## 10. Kesimpulan & Rekomendasi

### 10.1 Status Task DOC-001
Task **DOC-001 (Memeriksa Project Charter)** telah selesai dilaksanakan dengan hasil:
- Parameter identitas dan tujuan proyek konsisten di seluruh dokumen acuan.
- Ruang lingkup batasan in-scope dan out-of-scope jelas dan disepakati.
- Struktur tim dan jadwal 13 Oktober – 30 November 2026 telah terverifikasi.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 10.2 Rekomendasi Langkah Berikutnya
Melanjutkan ke task berikutnya pada sub-fase 4.1 Project Foundation:
- **DOC-002 — Memeriksa ruang lingkup proyek.**

