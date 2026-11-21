# ACTIVITY DIAGRAM PEMESANAN KATALOG (CATALOG ORDERING WORKFLOW)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-003  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-002 — Use Case Description (Selesai)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pemesanan Katalog (Task ANA-003) dilakukan untuk menggambarkan aliran kerja dinamis (*dynamic workflow*), percabangan keputusan (*decision points*), serta pembagian peran (*swimlanes*) dalam proses pemesanan produk buket katalog pada website **BLOOMÉ — Flowers & Stories**.

Diagram ini memetakan koordinasi aktivitas antara tiga partisipan:
1. **Customer (Pelanggan):** Berbelanja langsung sebagai tamu (*guest checkout*) tanpa registrasi.
2. **Sistem Web BLOOMÉ:** Menangani validasi input, penyaringan produk, transaksi basis data atomik, dan perenderan antarmuka Blade.
3. **Admin (Pemilik Usaha / Nabila):** Meninjau antrean pesanan masuk dan mengonfirmasi ketersediaan pengerjaan buket.

---

## 2. Diagram Aktivitas Pemesanan Katalog (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Buka Menu Katalog Buket"]
        C2["Pilih Kategori Bunga/Uang/Snack"]
        C3["Pilih Produk & Buka Detail Buket"]
        C4["Klik Tombol 'Pesan Sekarang'"]
        C5["Isi Formulir Pemesan:<br>- Nama & WhatsApp Aktif<br>- Alamat Pengiriman Samarinda<br>- Pesan Khusus Kartu Ucapan<br>- Tanggal Kebutuhan Buket"]
        C6["Perbaiki Isian Form"]
        C7["Klik 'Kirim Pesanan'"]
        C8["Terima Ringkasan Tagihan & Petunjuk Transfer Bank"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1["Ambil Data Produk Aktif dari Basis Data"]
        S2["Tampilkan Etalase Produk Sesuai Kategori"]
        S3{"Ketersediaan Stok?"}
        S4["Nonaktifkan Tombol Pesan<br>'Stok Habis'"]
        S5["Tampilkan Formulir Checkout Katalog"]
        S6{"Validasi Input Lengkap & Valid?"}
        S7["Tampilkan Pesan Error Validasi Inline"]
        S8["Mulai Database Transaction (ACID)"]
        S9["1. Simpan Data Pelanggan ke 'customers'<br>2. Generate Kode Unik 'BLM-YYYYMM-XXXX'<br>3. Simpan Pesanan ke 'orders' (Status ST-01)<br>4. Simpan Snapshot Produk ke 'order_details'<br>5. Catat Histori Awal ke 'order_status_histories'"]
        S10["Commit Transaksi Database Berhasil"]
        S11["Tampilkan Halaman Instruksi Pembayaran"]
        S12["Update Status -> ST-03 Menunggu Pembayaran"]
    end

    %% Admin Swimlane
    subgraph Lane_Admin ["Partisipan: Admin (Pemilik Usaha)"]
        A1["Buka Antrean Pesanan Masuk di Dashboard"]
        A2["Periksa Detail Pemesan & Tanggal Kebutuhan"]
        A3{"Setujui Pesanan Katalog?"}
        A4["Admin Konfirmasi Pesanan Siap Dikerjakan"]
        A5["Admin Batalkan Pesanan / Hubungi Pemesan"]
    end

    %% Final Node
    EndNode((◎))

    %% Connections across Swimlanes
    C1 --> S1
    S1 --> S2
    S2 --> C2
    C2 --> S2
    S2 --> C3
    C3 --> S3
    
    S3 -- "Habis (0)" --> S4
    S4 --> C3
    
    S3 -- "Tersedia (1)" --> C4
    C4 --> S5
    S5 --> C5
    C5 --> C7
    C7 --> S6
    
    S6 -- "Gagal" --> S7
    S7 --> C6
    C6 --> C7
    
    S6 -- "Lolos" --> S8
    S8 --> S9
    S9 --> S10
    S10 --> A1
    
    A1 --> A2
    A2 --> A3
    A3 -- "Ya" --> A4
    A4 --> S12
    S12 --> S11
    S11 --> C8
    C8 --> EndNode

    A3 -- "Tidak (Batal)" --> A5
    A5 --> EndNode
```

---

## 3. Analisis Jalur Aktivitas (*Path Analysis*)

### 3.1 Jalur Utama (*Happy Path*)
1. Pelanggan membuka katalog buket bunga dan memfilter kategori yang diminati.
2. Sistem menyajikan produk aktif. Pelanggan membuka halaman detail produk.
3. Sistem memeriksa ketersediaan stok produk (`is_available == 1`). Tombol pemesanan aktif.
4. Pelanggan mengklik "Pesan Sekarang" dan melengkapi formulir checkout (identitas pemesan, alamat Samarinda, pesan kartu ucapan pos, tanggal kebutuhan).
5. Sistem memvalidasi seluruh isian form request di sisi server.
6. Sistem menjalankan transaksi atomik `DB::transaction()`:
   - Data pemesan tersimpan di tabel `customers`.
   - Kode transaksi unik diterbitkan (misal: `BLM-202611-0001`).
   - Master pesanan tersimpan di `orders` dengan status awal `ST-01 Menunggu Peninjauan Admin`.
   - Rincian produk dan harga satuan disalin sebagai snapshot permanen di `order_details` (BR-020).
   - Jejak audit kronologis status dicatat di `order_status_histories`.
7. Admin meninjau antrean di dashboard dan menyetujui pesanan katalog.
8. Status pesanan diperbarui menjadi `ST-03 Menunggu Pembayaran`.
9. Pelanggan menerima ringkasan tagihan beserta nomor rekening bank resmi untuk transfer manual.

### 3.2 Jalur Percabangan & Penanganan Eksepsi (*Exception Paths*)
- **Jalur E1: Stok Produk Habis:**
  - Jika ketersediaan produk bernilai 0, sistem mengubah tampilan tombol pesan menjadi tombol abu-abu nonaktif bertuliskan *"Stok Habis"*, mencegah pelanggan mengakses form checkout.
- **Jalur E2: Form Input Tidak Lengkap:**
  - Jika nomor WhatsApp atau alamat pengiriman dikosongkan, validasi server Laravel melempar kembali error inline tanpa menghilangkan isian yang sudah diketik (*flashed old input*).
- **Jalur E3: Kegagalan Transaksi Basis Data:**
  - Jika terjadi gangguan jaringan pada saat commit data pesanan, mekanisme `DB::transaction()` otomatis melakukan *rollback* total sehingga tidak ada record parsial yang tertinggal.

---

## 4. Kepatuhan Terhadap Aturan Bisnis Proyek

Alur aktivitas pemesanan katalog ini mematuhi aturan bisnis secara ketat:
- **BR-001 (Guest Checkout):** Tidak ada langkah registrasi akun, verifikasi email, atau login kata sandi bagi pelanggan.
- **BR-003 (Identitas Pemesan Lengkap):** Sistem memvalidasi nama, nomor WhatsApp aktif, dan alamat pengiriman sebelum pesanan dibuat.
- **BR-005 (Harga Katalog Tetap):** Nominal total tagihan dihitung dari harga jual tetap yang tertera pada katalog produk.
- **BR-020 (Historical Snapshot):** Tabel `order_details` mencatat kolom `product_name_snapshot` dan `unit_price_snapshot` secara independen dari tabel produk.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-003
Task **ANA-003 (Activity Diagram pemesanan katalog)** telah selesai dilaksanakan:
- Diagram aktivitas pemesanan katalog berbasis swimlane (Customer, Sistem, Admin) telah dimodelkan menggunakan format visual Mermaid.
- Alur utama, percabangan keputusan, validasi form, dan transaksi atomik database terpetakan lengkap.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task pemodelan diagram aktivitas berikutnya pada sub-fase 5.2:
- **`ANA-004 — Activity Diagram pemesanan custom.`**

