# LAPORAN PENINJAUAN ACCEPTANCE CRITERIA & PENGESAHAN QUALITY GATE 1
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-010  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-006 s/d DOC-009 (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kriteria Keberimaan (Task DOC-010) merupakan aktivitas penutup pada sub-fase **4.2 Requirements Documentation**. Dokumen ini menetapkan kriteria pengujian terukur (*measurable acceptance criteria*) yang harus dipenuhi sebelum sistem informasi **BLOOMÉ — Flowers & Stories** dinyatakan dapat diterima (*accepted*) oleh pemilik usaha (Sponsor Nabila Febriyani).

Melalui peninjauan ini, seluruh kriteria keberimaan dikonversi ke dalam format pengujian berbasis skenario (*Given-When-Then* / skenario teruji) untuk 4 pilar utama:
1. **Customer Acceptance Criteria** (Penerimaan Pelanggan)
2. **Admin Acceptance Criteria** (Penerimaan Administrator)
3. **Design & UI/UX Acceptance Criteria** (Penerimaan Estetika & Desain)
4. **Technical & Architecture Acceptance Criteria** (Penerimaan Keandalan Teknis)

Sekaligus, dokumen ini meresmikan kelulusan **Quality Gate 1 (Requirements Approved)**.

---

## 2. Rincian Kriteria Keberimaan Berbasis Skenario (Acceptance Criteria)

### 2.1 Kriteria Penerimaan Pelanggan (Customer Acceptance)

| ID Kriteria | Skenario Pengujian | Hasil yang Diharapkan (Expected Result) |
|---|---|---|
| **AC-CUST-01** | Akses Beranda Tanpa Autentikasi | Pengguna publik dapat mengakses halaman beranda secara langsung tanpa diminta form registrasi/login. |
| **AC-CUST-02** | Eksplorasi Katalog & Filter Kategori | Pelanggan dapat melihat daftar buket bunga, buket uang, dan buket snack, serta menyaring katalog berdasarkan kategori secara akurat. |
| **AC-CUST-03** | Peninjauan Rincian Produk | Halaman detail produk menampilkan foto resolusi tajam, deskripsi rangkaian, harga resmi, status ketersediaan (*Tersedia*/*Habis*), dan tombol pemesanan. |
| **AC-CUST-04** | Pengiriman Pemesanan Katalog | Pelanggan mengisi data pemesan, alamat, kartu ucapan, dan tanggal kebutuhan. Sistem berhasil menyimpan pesanan dan menghasilkan ringkasan tagihan. |
| **AC-CUST-05** | Pengajuan Personalisasi Buket Custom | Pelanggan memilih bahan bunga, kombinasi warna, tema, catatan khusus, dan tiket permintaan custom tercatat di sistem. |
| **AC-CUST-06** | Unggah Gambar Referensi Custom | Berkas referensi berekstensi JPG/JPEG/PNG dengan ukuran ≤ 5 MB berhasil diunggah; berkas selain format tersebut atau > 5 MB otomatis ditolak dengan pesan peringatan yang jelas. |
| **AC-CUST-07** | Persetujuan / Penolakan Harga Custom | Setelah admin menetapkan harga, pelanggan dapat membuka halaman peninjauan harga dan menekan tombol *Setujui* (lanjut ke pembayaran) atau *Tolak* (batal). |
| **AC-CUST-08** | Penerimaan Instruksi Pembayaran | Pelanggan menerima rincian rekening bank dan dompet digital (e-wallet) resmi serta instruksi langkah konfirmasi pembayaran transfer manual. |
| **AC-CUST-09** | Konfirmasi Pengajuan Pesanan | Pelanggan menerima halaman konfirmasi bahwa pesanan telah berhasil masuk ke antrean admin BLOOMÉ. |

---

### 2.2 Kriteria Penerimaan Administrator (Admin Acceptance)

| ID Kriteria | Skenario Pengujian | Hasil yang Diharapkan (Expected Result) |
|---|---|---|
| **AC-ADM-01** | Autentikasi Admin Terproteksi | Admin berhasil login dengan email & password terdaftar. Percobaan login dengan kredensial salah ditolak. Akses URL admin langsung tanpa login diarahkan ke form login. |
| **AC-ADM-02** | Ringkasan Metrik Dashboard | Dashboard menampilkan total pesanan masuk, pesanan menunggu bayar, custom baru, dan antrean transaksi terkini secara tepat. |
| **AC-ADM-03** | Manajemen Kategori (CRUD) | Admin dapat menambah, mengedit, dan menghapus kategori buket. Kategori yang masih terikat produk aktif dicegah untuk dihapus. |
| **AC-ADM-04** | Manajemen Produk Katalog | Admin dapat menambah buket baru lengkap dengan unggah foto, mengubah deskripsi/harga, dan mengubah status ketersediaan produk. |
| **AC-ADM-05** | Pengelolaan & Filter Antrean Pesanan | Admin dapat melihat seluruh pesanan masuk, mencari berdasarkan kode pesanan, dan memfilter berdasarkan 8 status operasional. |
| **AC-ADM-06** | Peninjauan & Input Harga Custom | Admin dapat membuka detail permintaan custom, melihat gambar referensi, dan menginput nominal harga penawaran buket. |
| **AC-ADM-07** | Verifikasi Pembayaran Manual | Admin dapat memeriksa mutasi rekening bank/e-wallet dan menekan tombol verifikasi pembayaran untuk menandai pesanan lunas (*Paid*). |
| **AC-ADM-08** | Pembaruan Status Sesuai Workflow | Admin memperbarui status pesanan secara berurutan (*ST-01 s/d ST-07*). Perpindahan status yang melompati aturan bisnis ditolak sistem. |
| **AC-ADM-09** | Eksekusi Pengajuan Pembatalan | Admin dapat meninjau alasan pengajuan pembatalan pemesan dan memutuskan untuk menyetujui (*Dibatalkan*) atau menolaknya. |

---

### 2.3 Kriteria Penerimaan Desain & UI/UX (Design Acceptance)

| ID Kriteria | Parameter Desain | Standar Verifikasi yang Disepakati |
|---|---|---|
| **AC-DSG-01** | Palet Warna Baku | Konsistensi palet floral: *Blush Pink, Creamy Beige, Deep Rose, Botanical Green, Charcoal Text*. |
| **AC-DSG-02** | Hirarki Tipografi | Penerapan font keluarga serif/sans-serif yang elegan, rasio heading H1-H4 yang terstruktur dan mudah dibaca (*readable*). |
| **AC-DSG-03** | Komponen UI Konsisten | Bentuk tombol (*border-radius*), kartu buket, input field, dan status badges seragam di seluruh halaman. |
| **AC-DSG-04** | Tata Letak Admin Terpadu | Sidebar navigasi dan header admin memiliki posisi, kontras, dan interaktivitas yang konsisten. |
| **AC-DSG-05** | Responsivitas Tiga Layar | Seluruh halaman tampil presisi tanpa elemen terpotong (*no horizontal scroll overflow*) pada Mobile (360px), Tablet (768px), dan Desktop (1280px). |
| **AC-DSG-06** | Kejelasan Status Sistem | Halaman selalu memberikan indikator jelas saat data kosong (*empty state*), proses memuat (*loading state*), pesan kesalahan (*error alert*), dan pesan sukses (*success flash*). |

---

### 2.4 Kriteria Penerimaan Arsitektur & Teknis (Technical Acceptance)

| ID Kriteria | Aspek Teknis | Standar Pengujian Kepatuhan |
|---|---|---|
| **AC-TEC-01** | Framework & Versi | Aplikasi berjalan stabil pada Laravel 10/11 dan PHP 8.2+. |
| **AC-TEC-02** | Koneksi & Migrasi DB | Seluruh migrasi tabel basis data MySQL (10 entitas) tereksekusi tanpa galat dan foreign keys terikat sempurna. |
| **AC-TEC-03** | Three-Layer Architecture | Pemisahan Presentation (Blade), Application (Controllers/Requests/Services), dan Data Layer (Eloquent) ditaati tanpa bypass layer. |
| **AC-TEC-04** | Validasi & Keamanan Input | Form request memvalidasi tipe data dan mencegah payload XSS. Seluruh form POST memiliki proteksi token CSRF. |
| **AC-TEC-05** | Keamanan Berkas Unggahan | MIME-type divalidasi server, nama file di-hash UUID acak, dan disimpan aman di penyimpanan lokal tanpa hak eksekusi script. |
| **AC-TEC-06** | Keutuhan Transaksi (ACID) | Penyimpanan pesanan dibungkus dalam `DB::transaction()` sehingga tidak ada data menggantung jika query terputus. |

---

## 3. Evaluasi & Pengesahan Quality Gate 1 (Requirements Approved)

Berdasarkan aturan tata kelola proyek pada `task.md` (Bagian 14: Cross-Phase Quality Gates), evaluasi Gate 1 menghasilkan kesimpulan berikut:

| Syarat Kelulusan Quality Gate 1 | Status Pemenuhan | Bukti Deliverable |
|---|:---:|---|
| 1. *Requirement telah diperiksa secara menyeluruh.* | **TERPENUHI** | `requirement.md`, `DOC-006`, `DOC-007`, `DOC-008` |
| 2. *Business rules telah jelas dan tidak kontradiktif.* | **TERPENUHI** | `DOC-009` (20 Aturan Bisnis & Mesin 8 Status) |
| 3. *Ruang lingkup (in-scope & out-of-scope) telah disepakati.* | **TERPENUHI** | `DOC-002` (Project Scope Review) |
| 4. *Open questions telah diidentifikasi dan ditandai.* | **TERPENUHI** | Log 12 item `[PERLU KONFIRMASI]` di Bab 17 `requirement.md` |

> **PERNYATAAN PENGESAHAN GATE 1:**  
> Dengan terpenuhinya seluruh syarat di atas, **QUALITY GATE 1 — REQUIREMENTS APPROVED DINYATAKAN LULUS (APPROVED)**. Tim diizinkan untuk melangkah ke sub-fase berikutnya.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-010
Task **DOC-010 (Meninjau acceptance criteria)** telah selesai dilaksanakan:
- Kriteria keberimaan untuk pelanggan, admin, desain, dan teknis telah dibakukan ke dalam skenario terukur.
- Sub-fase **4.2 Requirements Documentation (DOC-006 hingga DOC-010) resmi SELESAI 100%**.
- Quality Gate 1 dinyatakan **LULUS**.

### 4.2 Rekomendasi Langkah Berikutnya:
Beralih ke sub-fase **4.3 Product Documentation**:
- **`DOC-011 — Menyusun prd.md.`**

