# SPESIFIKASI WIREFRAME & TATA LETAK PANEL ADMIN (ADMIN WIREFRAMES SPECIFICATION)
## BLOOMÉ — Flowers & Stories
**Task ID:** UX-025 s/d UX-039  
**Fase:** Phase 3 — UI/UX Design (Sub-fase 6.3 Admin Wireframe and Mockup)  
**Penanggung Jawab:** Riya Monika (UI/UX Designer & Frontend Developer) & Jayanti Firdasari (Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** UX-001 s/d UX-013 — Design System Components, DOC-019 — User Flow  

---

## 1. Ringkasan Eksekutif & Prinsip Tata Letak Panel Admin

Dokumen spesifikasi ini menetapkan tata letak (*wireframe layouts*), komponen tabel data, formulir aksi, dan alur kontrol operasional untuk 15 antarmuka panel administrasi website **BLOOMÉ — Flowers & Stories** (Task UX-025 hingga UX-039).

Panel administrasi dirancang khusus untuk pemilik usaha sekaligus florist utama (**Nabila Febriyani**) guna memantau antrean pesanan, menetapkan harga buket custom, mengaudit bukti mutasi pembayaran bank, mengelola inventaris katalog, dan mengeksekusi transisi status pemrosesan buket secara cepat dan akurat.

---

## 2. Matriks Rincian Wireframe Panel Admin

| Task ID | Nama Halaman Admin | URI Rute | Komponen Utama Tata Letak | Status |
|---|---|---|---|---|
| **UX-025** | Login Admin | `/admin/login` | Card Login Terpusat, Proteksi Rate-limit, Logo Butik | `[x]` |
| **UX-026** | Dashboard Admin | `/admin/dashboard` | 4 Kartu Metrik, Antrean Pesanan Hari Ini, Quick Actions | `[x]` |
| **UX-027** | Manajemen Produk | `/admin/produk` | Tabel Master Produk, Toggle Stok Instan, Search & Filter | `[x]` |
| **UX-028** | Form Tambah/Edit Produk | `/admin/produk/create` | Unggah Foto Produk (3MB), Input Nama, Slug, Kategori, Harga | `[x]` |
| **UX-029** | Manajemen Kategori | `/admin/kategori` | CRUD Kategori Buket, Validasi Slug Unik, Jumlah Produk Terkait | `[x]` |
| **UX-030** | Manajemen Pesanan | `/admin/pesanan` | Tabel Transaksi Master, Filter Status Harian, Tanggal Kebutuhan | `[x]` |
| **UX-031** | Detail Pesanan | `/admin/pesanan/{id}` | Info Pemesan, WhatsApp Button, Rincian Item, Pesan Kartu Ucapan | `[x]` |
| **UX-032** | Permintaan Custom | `/admin/custom-requests` | Antrean Tiket Custom Belum Dihargai, Filter Budget, Badge Urgent | `[x]` |
| **UX-033** | Detail Permintaan Custom | `/admin/custom-requests/{id}` | Spesifikasi Bunga, Warna, Wrapping, Galeri Foto Referensi | `[x]` |
| **UX-034** | Penentuan Harga Custom | Modal / Aksi Form | Form Input Harga Final (BR-007), Generator Tautan WhatsApp | `[x]` |
| **UX-035** | Manajemen Pembayaran | `/admin/pembayaran` | Antrean Bukti Transfer Masuk, Filter Bank, Nominal Tagihan | `[x]` |
| **UX-036** | Detail Pembayaran | `/admin/pembayaran/{id}` | Modal Pratinjau Struk Transfer Zoom, Aksi Verifikasi / Tolak | `[x]` |
| **UX-037** | Pengelolaan Status | Modal Transisi Status | Dropdown Transisi FSM Legal, Input Catatan Florist, Audit Log | `[x]` |
| **UX-038** | Pengajuan Pembatalan | `/admin/pembatalan` | Tabel Evaluasi Alasan Batal, Tombol Setujui / Tolak Pembatalan | `[x]` |
| **UX-039** | Pengaturan Admin | `/admin/pengaturan` | Ganti Password Bcrypt, Konfigurasi Rekening Bank, Nomor WA Toko | `[x]` |

---

## 3. Spesifikasi Blueprint Wireframe Halaman Utama Admin

### 3.1 UX-025: Halaman Login Admin (`/admin/login`)
```
+-----------------------------------------------------------------------------------+
|                                                                                   |
|                           [ LOGO BLOOMÉ ARTISAN ]                                 |
|                                                                                   |
|                 +-----------------------------------------------+                 |
|                 |             LOGIN ADMIN BLOOMÉ                |                 |
|                 |    Masuk untuk mengelola butik dan pesanan    |                 |
|                 |                                               |                 |
|                 |  Email Administrator:                         |                 |
|                 |  [ admin@bloome.com                         ] |                 |
|                 |                                               |                 |
|                 |  Kata Sandi:                                  |                 |
|                 |  [ ******************                       ] |                 |
|                 |                                               |                 |
|                 |  [x] Ingat Sesi Saya                          |                 |
|                 |                                               |                 |
|                 |  [ Tombol Primer: Masuk ke Dashboard ]        |                 |
|                 +-----------------------------------------------+                 |
|                                                                                   |
|               Sistem Informasi Pemesanan Buket Bunga © 2026                       |
+-----------------------------------------------------------------------------------+
```

### 3.2 UX-026: Dashboard Admin (`/admin/dashboard`)
```
+-----------------------------------------------------------------------------------+
| [LOGO BLOOMÉ]  |  Dashboard  Produk  Kategori  Pesanan  Custom  Bayar  | [Nabila v] |
+-----------------------------------------------------------------------------------+
|  RINGKASAN OPERASIONAL BUTIK HARI INI (13 November 2026)                          |
|                                                                                   |
|  +------------------+  +------------------+  +------------------+  +------------+ |
|  | PESANAN BARU     |  | BUTUH VERIFIKASI |  | TIKET CUSTOM     |  | TOTAL OMZET| |
|  |       12         |  |        4         |  |        3         |  | Rp 2.850K  | |
|  | [ST-01]          |  | [ST-02]          |  | [ST-04 Harga]    |  | Bulan Ini  | |
|  +------------------+  +------------------+  +------------------+  +------------+ |
|                                                                                   |
|  PESANAN PRIORITAS PERLU PENANGANAN SEGERA:                                       |
|  +------------------------------------------------------------------------------+ |
|  | Kode Order     | Pemesan      | Kebutuhan  | Total      | Status     | Aksi  | |
|  +------------------------------------------------------------------------------+ |
|  | BLM-202611-0021| Citra Kirana | Besok H+1  | Rp 250.000 | ST-02 Verif| [Cek] | |
|  | BLM-202611-0022| Dimas Anggara| 15 Nov     | Menunggu   | ST-04 Custom| [Beri Harga]
|  | BLM-202611-0020| Rina Nose    | 14 Nov     | Rp 180.000 | ST-05 Proses| [Update Status]
|  +------------------------------------------------------------------------------+ |
+-----------------------------------------------------------------------------------+
```

### 3.3 UX-027 & UX-028: Manajemen Produk Katalog (`/admin/produk`)
- **Tabel Master Produk:**
  - Menampilkan thumbnail foto buket, nama buket, slug, kategori, harga satuan, dan switch toggle stok instan (*Tersedia / Habis*).
  - Tombol aksi: Edit produk, ubah status ketersediaan, hapus (dibatasi jika ada transaksi).
- **Formulir Tambah/Edit Produk:**
  - Area unggah foto produk (maks 3MB, pratinjau instan).
  - Input nama produk (auto-generate slug URL).
  - Dropdown pemilihan kategori buket (Bunga Asli, Bunga Kering, Uang, Snack).
  - Input harga jual dalam Rupiah.
  - Textarea deskripsi komposisi bunga dan catatan ukuran buket.

### 3.4 UX-030 & UX-031: Manajemen & Rincian Pesanan (`/admin/pesanan/{id}`)
- **Halaman Detail Pesanan Menampilkan:**
  1. **Header:** Kode pesanan `BLM-YYYYMM-XXXX`, badge status kapsul (ST-01 s/d ST-08), tanggal pesanan masuk, dan tanggal kebutuhan rangkaian.
  2. **Data Pemesan:** Nama pelanggan, nomor WhatsApp aktif dilengkapi tombol *"Hubungi via WhatsApp"*, alamat lengkap pengiriman di Kota Samarinda.
  3. **Rincian Buket:** Foto produk, nama produk/spesifikasi custom, jumlah item, harga satuan snapshot, total pembayaran.
  4. **Kartu Ucapan Khusus:** Kotak khusus menampilkan isi pesan kartu ucapan yang siap dicetak/ditulis tangan oleh florist.
  5. **Panel Transisi Status (UX-037):** Tombol aksi untuk memajukan tahapan: *[Mulai Merangkai (Diproses)]*, *[Tandai Siap Diambil/Dikirim]*, *[Selesaikan Pesanan]*.

### 3.5 UX-032 s/d UX-034: Permintaan Custom & Penentuan Harga (`/admin/custom-requests`)
- **Detail Kustomisasi:**
  - Menampilkan preferensi bunga (mawar/lily/tulip), nuansa warna (blush pink/burgundy), jenis wrapping kertas, tema acara, dan estimasi budget awal pelanggan.
  - Galeri lightbox interaktif menampilkan 1-3 foto referensi yang diunggah pelanggan.
- **Form Penetapan Harga Final (UX-034):**
  - Input angka rupiah: *Harga Penawaran Florist* (misal: *Rp 275.000*).
  - Input catatan penjelasan teknis harga untuk pelanggan.
  - Tombol *"Simpan & Kirim Penawaran"*: Otomatis mengubah status menjadi `ST-01 Menunggu Pembayaran` dan memunculkan pop-up salin tautan WhatsApp resmi toko.

### 3.6 UX-035 & UX-036: Verifikasi Bukti Pembayaran Manual (`/admin/pembayaran`)
- **Modal Audit Mutasi Rekening:**
  - Menampilkan struk transfer bank/e-wallet dalam tampilan resolusi tinggi dengan kontrol perbesaran (*zoom preview*).
  - Menampilkan rincian: Bank Tujuan, Nama Pengirim, Tanggal Bayar, Nominal Tertera vs Nominal Tagihan.
  - **Aksi Florist:**
    - Tombol Hijau: *[Setujui Pembayaran]* $\rightarrow$ Status pesanan berubah menjadi `ST-05 Diproses`.
    - Tombol Merah: *[Tolak Pembayaran]* $\rightarrow$ Memunculkan input alasan penolakan (misal: "Nominal struk tidak sesuai" atau "Dana belum masuk di mutasi m-banking") $\rightarrow$ Status berubah menjadi `ST-03 Pembayaran Ditolak`.

### 3.7 UX-038 & UX-039: Pembatalan Pesanan & Pengaturan Toko
- **Evaluasi Pembatalan:** Memeriksa alasan pembatalan pelanggan dan menyetujui pembatalan jika bunga belum dirangkai.
- **Pengaturan Profil Toko:** Pembaruan nomor rekening bank resmi toko (BCA, Mandiri, Dana), nomor WhatsApp butik, alamat toko di Samarinda, serta pembaruan kata sandi admin dengan konfirmasi kata sandi lama.

---

## 4. Kesimpulan & Rekomendasi
Seluruh spesifikasi wireframe panel admin **UX-025 hingga UX-039** telah tuntas dirancang secara menyeluruh, ergonomis bagi florist, serta siap menjadi acuan pembuatan template Blade dan stylesheet admin.

