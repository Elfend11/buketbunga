# LAPORAN PENINJAUAN ACCEPTANCE CRITERIA & PENGESAHAN QUALITY GATE 1
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-010  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-006 s/d DOC-009 (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kriteria Keberimaan (Task DOC-010) merupakan aktivitas penutup pada sub-fase **4.2 Requirements Documentation**. Dokumen ini menetapkan kriteria pengujian terukur (*measurable acceptance criteria*) yang harus dipenuhi sebelum sistem informasi **BLOOMÉ — Flowers & Stories** dinyatakan dapat diterima (*accepted*) oleh pemilik usaha (Sponsor Nabila Febriyani).

Berdasarkan kesepakatan terbaru (Konsep Sistem v1.1), sistem informasi BLOOMÉ dirancang sebagai **katalog interaktif dan media personalisasi buket bunga berbasis web, sedangkan proses pemesanan, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**. 

Seluruh kriteria keberimaan dikonversi ke dalam format pengujian berbasis skenario (*Given-When-Then* / skenario teruji) untuk 4 pilar utama:
1. **Customer Acceptance Criteria** (Penerimaan Pelanggan Publik — Eksplorasi, Personalisasi, & Hand-off WhatsApp)
2. **Admin Acceptance Criteria** (Penerimaan Administrator — Manajemen Etalase Digital, Stok, & Pengaturan Toko)
3. **Design & UI/UX Acceptance Criteria** (Penerimaan Estetika Floral, Responsivitas, & Konsistensi Visual)
4. **Technical & Architecture Acceptance Criteria** (Penerimaan Keandalan Teknis, Three-Layer, Keamanan, & Integritas Data)

Sekaligus, dokumen ini meresmikan kelulusan **Quality Gate 1 (Requirements Approved)**.

---

## 2. Rincian Kriteria Keberimaan Berbasis Skenario (Acceptance Criteria)

### 2.1 Kriteria Penerimaan Pelanggan (Customer Acceptance)

| ID Kriteria | Skenario Pengujian | Hasil yang Diharapkan (Expected Result) |
|---|---|---|
| **AC-CUST-01** | Akses Beranda Tanpa Autentikasi | Pengguna publik dapat mengakses halaman beranda secara langsung tanpa diminta formulir registrasi/login (*frictionless guest access*). |
| **AC-CUST-02** | Eksplorasi Katalog & Filter Kategori | Pelanggan dapat melihat daftar buket bunga, buket uang, dan buket snack, serta menyaring katalog berdasarkan kategori secara akurat dan responsif. |
| **AC-CUST-03** | Peninjauan Rincian Produk & Galeri Foto | Halaman detail produk menampilkan galeri multi-sudut resolusi tajam, deskripsi rangkaian, harga dasar resmi, status ketersediaan (*Tersedia* / *Habis*), dan tombol pemesanan. |
| **AC-CUST-04** | Konfigurasi Personalisasi Buket | Pelanggan dapat memilih opsi personalisasi aktif (warna wrapping, jenis pita, dll.) melalui pemilih visual (*color swatches* / radio buttons) yang langsung memperbarui tampilan pilihan. |
| **AC-CUST-05** | Pemilihan Add-on & Catatan Khusus | Pelanggan dapat memilih satu atau beberapa item add-on (kartu ucapan khusus, cokelat, boneka, dll.) dan mengisi catatan khusus/ucapan kartu secara terstruktur. |
| **AC-CUST-06** | Kalkulasi Live Estimasi Harga | Ringkasan pilihan menghitung subtotal estimasi harga secara real-time di sisi antarmuka (*live calculation*) berdasarkan harga dasar produk, variasi personalisasi, dan add-on yang dipilih. |
| **AC-CUST-07** | Generator WhatsApp & Hand-off | Menekan tombol "Pesan via WhatsApp" memicu pembuatan URL `wa.me` yang memuat teks pesanan terstruktur rapi dan membuka aplikasi/tab WhatsApp pelanggan secara tepat tanpa menyimpan transaksi di basis data web. |
| **AC-CUST-08** | Konsultasi Custom via WhatsApp | Pada halaman custom atau produk, tersedia tautan langsung untuk konsultasi buket custom ke WhatsApp pemilik usaha untuk permintaan desain di luar katalog. |

---

### 2.2 Kriteria Penerimaan Administrator (Admin Acceptance)

| ID Kriteria | Skenario Pengujian | Hasil yang Diharapkan (Expected Result) |
|---|---|---|
| **AC-ADM-01** | Autentikasi Admin Terproteksi | Admin berhasil login dengan kredensial terdaftar (email & password terenkripsi bcrypt). Akses route `/admin/*` tanpa autentikasi otomatis diarahkan ke form login dengan pesan proteksi. |
| **AC-ADM-02** | Ringkasan Metrik Dashboard | Dashboard menampilkan kartu statistik etalase: total produk aktif, total kategori, opsi personalisasi aktif, item add-on aktif, dan nomor WhatsApp toko terdaftar. |
| **AC-ADM-03** | Manajemen Master Kategori (CRUD) | Admin dapat menambah, mengubah nama/slug, dan menghapus kategori buket. Kategori yang masih terikat produk dicegah untuk dihapus demi integritas relasi data. |
| **AC-ADM-04** | Manajemen Master Produk Buket | Admin dapat menambah buket baru lengkap dengan nama, deskripsi, harga dasar, dan mengubah status ketersediaan (*Tersedia* / *Habis*) sewaktu-waktu. |
| **AC-ADM-05** | Pengelolaan Galeri Foto Multi-Upload | Admin dapat mengunggah beberapa foto buket sekaligus (JPG/PNG ≤ 2 MB per berkas), menetapkan foto sampul utama (*primary*), dan menghapus foto lama dengan pembersihan penyimpanan fisik lokal. |
| **AC-ADM-06** | Manajemen Opsi Personalisasi Produk | Admin dapat mengonfigurasi tipe personalisasi (warna wrapping, pita) beserta nilai opsi variasi dan penyesuaian harganya (*price adjustment*) untuk setiap produk buket. |
| **AC-ADM-07** | Manajemen Master Item Add-on | Admin dapat menambah, mengedit, dan mengelola harga serta status ketersediaan item add-on (cokelat, boneka, topper, kartu ucapan premium). |
| **AC-ADM-08** | Konfigurasi Pengaturan Bisnis & WhatsApp | Admin dapat memperbarui nomor WhatsApp tujuan pemesanan dan template salam pembuka toko melalui modul `business_settings`. |

---

### 2.3 Kriteria Penerimaan Desain & UI/UX (Design Acceptance)

| ID Kriteria | Parameter Desain | Standar Verifikasi yang Disepakati |
|---|---|---|
| **AC-DSG-01** | Palet Warna Baku | Konsistensi palet floral: *Primary Pink #E99AAF, Soft Pink #F6DDE3, Burgundy #642D36, Soft Cream #FFF8F6, Dark Charcoal #333333*. |
| **AC-DSG-02** | Hirarki Tipografi | Penerapan font keluarga serif/sans-serif yang elegan (*Playfair Display* untuk headings, *Poppins* untuk body text) yang terstruktur dan nyaman dibaca (*readable*). |
| **AC-DSG-03** | Komponen UI Konsisten | Bentuk tombol (*border-radius* konsisten), kartu buket dengan efek elevasi lembut, swatch warna personalisasi, dan badge status ketersediaan seragam di seluruh halaman. |
| **AC-DSG-04** | Tata Letak Admin Terpadu | Sidebar navigasi dan header admin memiliki posisi, kontras, dan interaktivitas yang konsisten dengan transisi navigasi yang responsif. |
| **AC-DSG-05** | Responsivitas Tiga Layar | Seluruh halaman tampil presisi tanpa elemen terpotong (*no horizontal scroll overflow*) pada Mobile (360px–414px), Tablet (768px), dan Desktop (1280px+). |
| **AC-DSG-06** | Kejelasan Status Sistem | Halaman selalu memberikan indikator visual jelas saat katalog kosong (*empty state*), proses memuat (*loading state*), pesan kesalahan (*error alert*), dan konfirmasi aksi sukses (*success flash*). |

---

### 2.4 Kriteria Penerimaan Arsitektur & Teknis (Technical Acceptance)

| ID Kriteria | Aspek Teknis | Standar Pengujian Kepatuhan |
|---|---|---|
| **AC-TEC-01** | Framework & Versi | Aplikasi berjalan stabil pada Laravel 10/11 dan PHP 8.2+ dengan dukungan Vite sebagai asset bundler. |
| **AC-TEC-02** | Koneksi & Migrasi DB | Seluruh 10 migrasi tabel basis data MySQL (`users`, `categories`, `products`, `product_photos`, `personalization_types`, `personalization_values`, `product_personalization_types`, `add_ons`, `product_add_ons`, `business_settings`) tereksekusi tanpa galat dan foreign keys terikat berintegritas. |
| **AC-TEC-03** | Three-Layer Architecture | Pemisahan Presentation Layer (Blade/Vite), Application Layer (Controllers, Form Requests, Services), dan Data Layer (Eloquent Models) ditaati tanpa bypass layer. |
| **AC-TEC-04** | Validasi & Keamanan Input | Form Request memvalidasi tipe data, format teks, dan sanitasi payload XSS. Seluruh form POST/PUT/DELETE memiliki proteksi token CSRF aktif. |
| **AC-TEC-05** | Keamanan Berkas Unggahan | MIME-type divalidasi ketat pada server (`image/jpeg`, `image/png`), penamaan file di-hash UUID unik, dan disimpan pada disk lokal terisolasi tanpa hak eksekusi script. |
| **AC-TEC-06** | Keutuhan Transaksi Master Data | Operasi penambahan/pengubahan produk majemuk (produk bersama foto galeri dan relasi personalisasi/add-on) dibungkus dalam `DB::transaction()` demi integritas data ACID. |

---

## 3. Evaluasi & Pengesahan Quality Gate 1 (Requirements Approved)

Berdasarkan aturan tata kelola proyek pada `task.md` (Bagian 14: Cross-Phase Quality Gates), evaluasi Gate 1 menghasilkan kesimpulan berikut:

| Syarat Kelulusan Quality Gate 1 | Status Pemenuhan | Bukti Deliverable |
|---|:---:|---|
| 1. *Requirement telah diperiksa secara menyeluruh.* | **TERPENUHI** | `requirement.md` (v1.1), `DOC-006`, `DOC-007`, `DOC-008` |
| 2. *Business rules telah jelas dan tidak kontradiktif.* | **TERPENUHI** | `DOC-009` (20 Aturan Bisnis Alur WhatsApp & Etalase Digital) |
| 3. *Ruang lingkup (in-scope & out-of-scope) telah disepakati.* | **TERPENUHI** | `DOC-002` (Project Scope Review v1.1) |
| 4. *Open questions telah diidentifikasi dan ditandai.* | **TERPENUHI** | Log 14 item `[Perlu Konfirmasi Owner]` di `requirement.md` dan `DOC-002` |

> **PERNYATAAN PENGESAHAN GATE 1:**  
> Dengan terpenuhinya seluruh syarat di atas, **QUALITY GATE 1 — REQUIREMENTS APPROVED DINYATAKAN LULUS (APPROVED)**. Tim diizinkan untuk melangkah ke sub-fase berikutnya.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-010
Task **DOC-010 (Meninjau acceptance criteria)** telah selesai dilaksanakan:
- Kriteria keberimaan untuk pelanggan, admin, desain UI/UX, dan arsitektur teknis telah diselaraskan penuh dengan konsep website katalog & personalisasi berbasis hand-off WhatsApp.
- Seluruh sisa kriteria fiktif checkout web, manajemen status transaksi web, dan approval harga custom via web telah dieliminasi.
- Sub-fase **4.2 Requirements Documentation (DOC-006 hingga DOC-010) resmi SELESAI 100%**.
- Quality Gate 1 dinyatakan **LULUS**.

### 4.2 Rekomendasi Langkah Berikutnya:
Beralih ke sub-fase **4.3 Product Documentation**:
- **`DOC-011 — Menyusun prd.md (PRD Compilation Report).`**
