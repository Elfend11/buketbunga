# SPESIFIKASI SKENARIO PENGUJIAN FUNGSIONAL (FUNCTIONAL TEST CASES SPECIFICATION)
## BLOOMÉ — Flowers & Stories
**Task ID:** QA-001 s/d QA-015  
**Fase:** Phase 9 — Security and Quality Assurance (Sub-fase 12.2 Functional Testing)  
**Penanggung Jawab:** Jayanti Firdasari (Lead QA & System Analyst) & Elsa Futri (Backend Developer)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-021 — Testing Plan Report, requirement.md, prd.md  

---

## 1. Ringkasan Eksekutif & Prinsip Pengujian Fungsional

Dokumen spesifikasi ini merumuskan 15 rangkaian kasus uji fungsional (*functional test cases*) menyeluruh untuk memvalidasi bahwa seluruh fitur sistem informasi **BLOOMÉ — Flowers & Stories** beroperasi sesuai dengan spesifikasi kebutuhan perangkat lunak (SRS) dan aturan bisnis (BR-001 s/d BR-025).

Setiap kasus uji memuat ID uji, skenario uji, prasyarat (*pre-conditions*), langkah-langkah pengujian, data uji, hasil yang diharapkan (*expected results*), kriteria kelulusan (*acceptance criteria*), dan status evaluasi.

---

## 2. Matriks Kasus Uji Fungsional (QA-001 s/d QA-015)

| Test ID | Fitur / Alur yang Diuji | Skenario Pengujian Utama | Kriteria Keberhasilan | Status |
|---|---|---|---|---|
| **TC-QA-001** | Homepage (UX-014) | Navigasi halaman depan, banner promo, showcase produk | Halaman termuat < 2s, tautan navigasi berfungsi | `[x]` |
| **TC-QA-002** | Katalog Produk (UX-015) | Filter kategori, filter harga, paginasi 9 produk | Produk terfilter akurat sesuai kategori | `[x]` |
| **TC-QA-003** | Detail Produk (UX-016) | Tampilan spesifikasi bunga, status stok, harga | Tombol pesan aktif jika stok tersedia | `[x]` |
| **TC-QA-004** | Form Order Katalog (UX-017) | Validasi formulir tamu, pemilih tanggal H+1, pesan kartu | Pesanan tersimpan, kode `BLM-...` terbit | `[x]` |
| **TC-QA-005** | Form Custom Bouquet (UX-018) | Pengisian preferensi custom, budget, tema acara | Tiket custom terbuat status `ST-04` | `[x]` |
| **TC-QA-006** | Unggah Foto Referensi (UX-019)| Upload 1-3 berkas foto inspirasi (Maks 5MB per berkas) | Berkas tersimpan dengan UUID, non-image ditolak | `[x]` |
| **TC-QA-007** | Alur Penentuan Harga (UX-034) | Florist menginput harga disetujui untuk tiket custom | Status berubah `ST-04` $\rightarrow$ `ST-01`, total terupdate | `[x]` |
| **TC-QA-008** | Informasi Pembayaran (UX-021) | Penyajian nomor rekening butik (BCA, Mandiri, Dana) | Rekening tampil lengkap, tombol salin berfungsi | `[x]` |
| **TC-QA-009** | Verifikasi Bayar Manual (UX-036)| Admin verifikasi transfer bank via upload bukti struk | Status beralih ke `ST-05 Diproses` (BR-014) | `[x]` |
| **TC-QA-010** | Pelacakan Status (UX-022) | Input kode order pada `/lacak-pesanan/{order_code}` | Timeline status akurat memuat 8 tahapan | `[x]` |
| **TC-QA-011** | Pembatalan Pesanan (UX-038) | Pelanggan batalkan pesanan belum bayar (ST-01) | Status menjadi `ST-08 Dibatalkan` (BR-017) | `[x]` |
| **TC-QA-012** | Otentikasi Admin (UX-025) | Login kredensial admin dan proteksi salah password | Sukses login jika kredensial cocok, throttle 5x | `[x]` |
| **TC-QA-013** | Manajemen Produk (UX-027) | Tambah produk baru, edit harga, toggle stok aktif | Data terupdate real-time pada etalase katalog | `[x]` |
| **TC-QA-014** | Manajemen Kategori (UX-029) | Tambah/Edit kategori buket, pencegahan hapus terikat | Relasi produk terlindungi (Restrict delete) | `[x]` |
| **TC-QA-015** | Dashboard Admin (UX-026) | Kalkulasi metrik pesanan baru, tiket custom, omzet | Angka metrik sinkron dengan database | `[x]` |

---

## 3. Rincian Kasus Uji Inti (*Detailed Test Procedures*)

### 3.1 TC-QA-004: Pemesanan Buket Katalog (*Guest Checkout*)
- **Prasyarat:** Tersedia produk buket dengan status `is_available = true` (contoh: *Pastel Dream, Rp 220.000*).
- **Langkah-Langkah:**
  1. Buka URL `/pesan/pastel-dream`.
  2. Kosongkan nama pemesan $\rightarrow$ Tekan kirim $\rightarrow$ Verifikasi pesan error HTML5/server muncul.
  3. Isi Nama: *"Adinda Rahma"*, WhatsApp: *"081234567890"*, Alamat: *"Jl. M. Yamin No. 12, Samarinda"*.
  4. Pilih tanggal kebutuhan: *Hari Ini* $\rightarrow$ Verifikasi pesan error: *"Tanggal kebutuhan minimal H+1"*.
  5. Pilih tanggal kebutuhan: *Besok (H+1)*.
  6. Isi kartu ucapan: *"Happy Birthday Dea! Semoga panjang umur dan bahagia selalu."*
  7. Tekan tombol *"Konfirmasi Pesanan"*.
- **Hasil yang Diharapkan:**
  - Database mencatat entitas `orders`, `order_details` (snapshot harga Rp 220.000), `customers`, dan `order_status_histories`.
  - Sistem mengarahkan ke `/pesanan/{order_code}` dengan kode pesanan unik (contoh: `BLM-202611-0001`).

### 3.2 TC-QA-006 & TC-QA-007: Alur Tiket Custom & Penetapan Harga
- **Pengujian TC-QA-006 (Upload Berkas):**
  1. Unggah berkas `.pdf` atau `.exe` ke formulir custom $\rightarrow$ Ditolak dengan respon HTTP 422: *"Hanya format JPG dan PNG yang diperbolehkan"*.
  2. Unggah berkas gambar berukuran 6.5 MB $\rightarrow$ Ditolak dengan respon HTTP 422: *"Ukuran gambar maksimal 5MB"*.
  3. Unggah 2 berkas JPG masing-masing 2MB $\rightarrow$ Berhasil diunggah dan disimpan dengan format UUID.
- **Pengujian TC-QA-007 (Penetapan Harga Admin):**
  1. Florist membuka tiket custom pada panel `/admin/custom-requests/{id}`.
  2. Memasukkan nominal: `Rp 275.000` dan catatan: *"Menggunakan mawar merah semi-holland 10 tangkai dan wrapping hitam rustic"*.
  3. Tekan *"Kirim Penawaran Harga"*.
  4. Periksa database: `orders.total_amount = 275000`, `orders.current_status = 'ST-01'`, `custom_requests.agreed_price = 275000`.

### 3.3 TC-QA-009: Verifikasi Pembayaran Manual Transfer Bank
- **Prasyarat:** Pesanan berstatus `ST-01 Menunggu Pembayaran`.
- **Langkah-Langkah:**
  1. Pelanggan membuka rute `/pembayaran/{order_code}` $\rightarrow$ Unggah struk bukti transfer BCA $\rightarrow$ Status berganti menjadi `ST-02 Menunggu Verifikasi`.
  2. Florist login ke `/admin/pembayaran` $\rightarrow$ Klik detail struk transfer.
  3. Florist mengecek mutasi rekening $\rightarrow$ Klik tombol *[Verifikasi Pembayaran]*.
- **Hasil yang Diharapkan:**
  - Status pesanan berpindah secara sah ke `ST-05 Diproses`.
  - Entitas `payments.verification_status` berubah menjadi `verified` dan `verified_at` terisi timestamp terkini.

---

## 4. Kesimpulan & Rekomendasi
Seluruh spesifikasi kasus uji fungsional **QA-001 hingga QA-015** telah didokumentasikan secara presisi, mencakup alur positif (*positive path*), pengujian batas (*boundary values*), dan penanganan galat (*negative path*).

