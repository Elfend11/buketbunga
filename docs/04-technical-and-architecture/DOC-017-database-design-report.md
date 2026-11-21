# LAPORAN PENYUSUNAN DATABASE DESIGN & KAMUS DATA (DATABASE DESIGN REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-017  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.4 Technical Documentation)  
**Penanggung Jawab:** Elsa Futri (Backend Developer & Database Administrator)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [database-design.md](../../database-design.md) (Versi 1.0 - Official Database Baseline)

---

## 1. Ringkasan Eksekutif

Penyusunan dokumen master `database-design.md` (Task DOC-017) telah selesai dilaksanakan. Dokumen ini menjadi pedoman resmi perancangan basis data relasional MySQL untuk seluruh sistem **BLOOMÉ — Flowers & Stories**.

Dokumen ini memuat normalisasi bentuk ketiga (3NF), Entity Relationship Diagram (ERD), kamus data terperinci (*detailed data dictionary*) untuk **10 entitas**, strategi pengindeksan kueri, aturan integritas referensial, perlindungan data historis pesanan (*snapshotting*), serta panduan urutan eksekusi migrasi tabel Laravel.

---

## 2. Struktur & Verifikasi Komponen Desain Basis Data

Verifikasi mengonfirmasi bahwa seluruh kebutuhan basis data telah terpenuhi:
1. **Engine & Konfigurasi:** Menggunakan MySQL 8.0 dengan engine InnoDB (mendukung penuh transaksi ACID dan *row-level locking*), charset `utf8mb4`, dan collation `utf8mb4_unicode_ci`.
2. **Kamus Data 10 Tabel:**
   - `admins` (Kredensial login pemilik usaha terproteksi).
   - `categories` (Kategori buket: bunga, uang, snack, dll. dengan slug unik).
   - `products` (Etalase buket katalog dengan harga dan toggle stok).
   - `customers` (Identitas pemesan tamu: nama, nomor WhatsApp, alamat pengiriman).
   - `orders` (Master transaksi: kode pesanan unik, total, status, tanggal kebutuhan, ucapan kartu).
   - `order_details` (Item katalog yang dipesan dengan snapshot nama dan harga satuan - BR-020).
   - `custom_requests` (Spesifikasi personalisasi: bahan, warna, tema, catatan, harga usulan, keputusan).
   - `custom_references` (Path berkas foto referensi tersanitasi UUID ≤ 5MB).
   - `payments` (Catatan pembayaran manual transfer bank/e-wallet dan status verifikasi admin).
   - `order_status_histories` (Audit trail kronologis 8 transisi status pesanan).
3. **Strategi Indexing:** Mengoptimalkan kueri pencarian melalui Unique Key pada slug/kode pesanan dan Composite Index pada `(current_status, delivery_date)` serta `(is_available, category_id)`.
4. **Urutan Migrasi & Seeder:** Menetapkan urutan 10 berkas migrasi untuk mencegah konflik foreign key serta seeder akun admin dan kategori awal.

---

## 3. Kesimpulan & Rekomendasi

### 3.1 Status Task DOC-017
Task **DOC-017 (Menyusun database-design.md)** telah selesai dilaksanakan:
- File [database-design.md](../../database-design.md) telah tersusun lengkap, konsisten, dan memenuhi seluruh kriteria perancangan basis data profesional.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 3.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task teknis berikutnya pada sub-fase 4.4:
- **`DOC-018 — Menyusun design-system.md.`**

