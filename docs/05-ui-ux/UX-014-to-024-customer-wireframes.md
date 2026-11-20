# SPESIFIKASI WIREFRAME & TATA LETAK HALAMAN PELANGGAN (CUSTOMER WIREFRAMES SPECIFICATION)
## BLOOMÉ — Flowers & Stories
**Task ID:** UX-014 s/d UX-024  
**Fase:** Phase 3 — UI/UX Design (Sub-fase 6.2 Customer Wireframe and Mockup)  
**Penanggung Jawab:** Riya Monika (UI/UX Designer & Frontend Developer) & Jayanti Firdasari (Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** UX-001 s/d UX-013 — Design System Components, DOC-019 — User Flow  

---

## 1. Ringkasan Eksekutif & Prinsip Tata Letak Pelanggan

Dokumen spesifikasi ini menetapkan rancangan tata letak (*wireframe layouts*), hierarki visual informasi, dan elemen interaksi untuk 11 antarmuka publik website **BLOOMÉ — Flowers & Stories** (Task UX-014 hingga UX-024).

### 1.1 Prinsip Desain Tata Letak Pelanggan
1. **Pemesanan Tanpa Registrasi (*Frictionless Guest Experience*):** Tidak ada proses pendaftaran (*sign-up*) atau login yang memperlambat pembeli. Pembeli langsung memesan dan melacak pesanan cukup dengan memasukkan kode unik `BLM-YYYYMM-XXXX`.
2. **Keterbukaan Informasi (*Clear Visual Affirmation*):** Setiap tahap pemesanan menyajikan rincian biaya yang transparan, estimasi tanggal penyelesaian (minimal H+1), serta rekening bank resmi toko.
3. **Sentuhan Emosional (*Storytelling & Sentiments*):** Menempatkan formulir kartu ucapan (*greeting card*) sebagai fitur premium yang ramah pengguna, mendukung makna emosional setiap rangkaian bunga.

---

## 2. Matriks Rincian Wireframe Halaman Pelanggan

| Task ID | Nama Halaman | Route Name | Komponen Utama Tata Letak | Status |
|---|---|---|---|---|
| **UX-014** | Homepage | `home` | Hero Banner, Value Proposition, Unggulan Katalog, Custom CTA, Testimoni, Footer | `[x]` |
| **UX-015** | Katalog Produk | `catalog.index` | Filter Kategori, Pengurutan Harga, Grid 9 Produk, Paginasi | `[x]` |
| **UX-016** | Detail Produk | `catalog.show` | Galeri Foto Buket, Badge Stok, Deskripsi Bunga, Tombol Pesan, Buket Serupa | `[x]` |
| **UX-017** | Form Pemesanan Katalog | `order.create` | Ringkasan Produk Terpilih, Form Tamu, Pemilih Tanggal H+1, Textarea Kartu Ucapan | `[x]` |
| **UX-018** | Form Custom Bouquet | `custom.create` | Preferensi Bunga, Skema Warna, Gaya Wrapping, Estimasi Budget, Catatan Florist | `[x]` |
| **UX-019** | Upload Gambar Referensi | (Komponen Custom) | Dropzone Drag & Drop (Maks 3 Foto, ≤5MB), Pratinjau Thumbnail & Tombol Hapus | `[x]` |
| **UX-020** | Ringkasan Pesanan | `order.summary` | Kode Pesanan `BLM-...`, Rincian Item, Total Bayar, Opsi Metode Transfer | `[x]` |
| **UX-021** | Informasi Pembayaran | `payment.create` | Nomor Rekening Butik (BCA, Mandiri, Dana), Panduan Salin Rekening, Form Bukti | `[x]` |
| **UX-022** | Konfirmasi Pesanan | `custom.success` / `tracking.show` | Lencana Sukses, Tautan Lacak Langsung, Tombol WhatsApp Universal Link | `[x]` |
| **UX-023** | Tentang Usaha | `static.about` | Kisah Artisan Nabila Febriyani, Lokasi Samarinda, Filosofi Mawar & Cerita | `[x]` |
| **UX-024** | Kontak & Lokasi | `static.contact` | Peta Lokasi Jl. Cipto Mangunkusumo, Jam Operasional Butik, Form Tanya Cepat | `[x]` |

---

## 3. Spesifikasi Blueprint Wireframe Halaman Inti

### 3.1 UX-014: Homepage (`/`)
```
+-----------------------------------------------------------------------------------+
|  [LOGO: BLOOMÉ]      Home   Katalog   Custom Order   Lacak   Tentang   [WhatsApp] |
+-----------------------------------------------------------------------------------+
|                                                                                   |
|  [HERO SECTION: Latar Blush Pink + Ilustrasi Floral Halus]                        |
|                                                                                   |
|      "Setiap Rangkaian Memiliki Cerita Indah."                                    |
|      Buket artisan premium untuk merayakan setiap momen berharga di Samarinda.   |
|                                                                                   |
|      [ Tombol: Jelajahi Katalog ]      [ Tombol Outline: Buat Custom Buket ]      |
|                                                                                   |
|      [ Foto Showcase Buket Bestseller ]                                           |
|                                                                                   |
+-----------------------------------------------------------------------------------+
|  KEUNGGULAN KAMI:                                                                 |
|  [ * Artisan Florist ]      [ * Fresh & Preserved ]      [ * Personalized Card ]  |
+-----------------------------------------------------------------------------------+
|  BUKET PILIHAN MINGGU INI (Featured Catalog)                                      |
|  +------------------+  +------------------+  +------------------+                 |
|  | [Foto Buket A]   |  | [Foto Buket B]   |  | [Foto Buket C]   |                 |
|  | Mawar Merona     |  | Pastel Dream     |  | Golden Delight   |                 |
|  | Rp 175.000       |  | Rp 220.000       |  | Rp 150.000       |                 |
|  | [Pesan Sekarang] |  | [Pesan Sekarang] |  | [Pesan Sekarang] |                 |
|  +------------------+  +------------------+  +------------------+                 |
|                                                                                   |
|                            [ Lihat Semua 24+ Buket ]                              |
+-----------------------------------------------------------------------------------+
|  BANNER KUSTOMISASI:                                                              |
|  "Punya Konsep Sendiri? Wujudkan Buket Impian Anda Bersama Florist Kami"          |
|  [ Tombol: Konsultasi & Pesan Custom ]                                            |
+-----------------------------------------------------------------------------------+
|  [FOOTER: Burgundy Background - Jl. Cipto Mangunkusumo, Samarinda - © 2026]      |
+-----------------------------------------------------------------------------------+
```

### 3.2 UX-015 & UX-016: Katalog Produk & Detail Produk
- **Halaman Katalog (`/katalog`):**
  - **Filter Navigasi Kategori:** Tab kapsul interaktif (*Semua, Buket Bunga Segar, Buket Uang, Buket Snack, Buket Boneka/Graduation*).
  - **Dropdown Pengurutan:** *Terbaru, Harga Terendah, Harga Tertinggi*.
  - **Grid Produk Responsif:** 3 kolom (Desktop), 2 kolom (Tablet), 1 kolom (Mobile) menampilkan foto rasio 1:1, badge stok (*Tersedia / Habis*), dan tombol aksi.
- **Halaman Detail Produk (`/katalog/{slug}`):**
  - **Sisi Kiri:** Foto utama produk berkualitas tinggi dengan zoom modal pratinjau.
  - **Sisi Kanan:** Judul produk (Playfair Display), kategori bunga, tag harga (contoh: *Rp 250.000*), status ketersediaan (*Ready Stock*), rincian komposisi bunga (jenis mawar, baby's breath, kertas wrapping), catatan waktu pengerjaan (minimal H+1), dan tombol primer *"Pesan Buket Ini"*.
  - **Bagian Bawah:** Rekomendasi 3 buket dari kategori serupa.

### 3.3 UX-017 & UX-018: Formulir Pemesanan Katalog & Custom Bouquet
- **Pemesanan Katalog (`/pesan/{slug}`):**
  - **Panel Kiri (Identitas & Pengiriman):** Input Nama Pemesan, Nomor WhatsApp aktif (format `08...`), Alamat Lengkap Pengiriman di Kota Samarinda, Tanggal Kebutuhan (Datepicker dibatasi minimal besok / H+1).
  - **Panel Tengah (Personalisasi Kartu):** Textarea pesan kartu ucapan dengan ucapan default atau custom (maksimal 250 karakter).
  - **Panel Kanan (Ringkasan Tagihan):** Thumbnail buket terpilih, harga satuan, ongkos kirim standar butik Samarinda, total pembayaran, dan tombol konfirmasi *"Lanjut ke Pembayaran"*.
- **Pemesanan Custom Bouquet (`/custom-bouquet`):**
  - Input Estimasi Anggaran (Budget) dalam Rupiah.
  - Pilihan Preferensi Bunga (Bunga Asli Segar, Bunga Artificial, Bunga Kering/Preserved, Buket Uang, Buket Snack).
  - Pilihan Palet Warna (Pastel Pink, Burgundy Bold, Earthy Sage, Monochrome White, Colorful).
  - Pilihan Jenis Kertas Wrapping (Korean Cellophane Matte, Brown Craft Rustic, Silk Ribbon).
  - Textarea Catatan Permintaan Khusus (tema wisuda, ulang tahun, anniversary).
  - **Dropzone Foto Referensi (UX-019):** Area upload interaktif untuk 1-3 foto inspirasi bunga (JPG/PNG, maks 5MB per foto) dengan preview thumbnail.

### 3.4 UX-020 & UX-021: Ringkasan Pesanan & Pembayaran
```
+-----------------------------------------------------------------------------------+
|  RINGKASAN PESANAN & PETUNJUK PEMBAYARAN                                          |
|                                                                                   |
|  Kode Pesanan: [ BLM-202611-0012 ]               Status: [ Menunggu Pembayaran ]  |
+-----------------------------------------------------------------------------------+
|  Rincian Transaksi:                                                               |
|  - Produk: Buket Mawar Blush Pink (x1)                          Rp 185.000        |
|  - Tanggal Pengambilan/Kebutuhan: 15 November 2026                                |
|  - Pemesan: Adinda Rahma (+6281234567890)                                         |
|  - Kartu Ucapan: "Happy Graduation Sarah, S.Kom! Proud of you!"                   |
|                                                                                   |
|  TOTAL TAGIHAN:                                                 Rp 185.000        |
+-----------------------------------------------------------------------------------+
|  REKENING TRANSFER BUTIK RESMI:                                                   |
|  [BCA]     123-456-7890   a.n. Nabila Febriyani         [ Salin Rekening ]        |
|  [Mandiri] 987-654-3210   a.n. Nabila Febriyani         [ Salin Rekening ]        |
|  [Dana]    0812-5555-4321 a.n. Nabila Febriyani         [ Salin Nomor ]           |
+-----------------------------------------------------------------------------------+
|  FORMULIR KONFIRMASI PEMBAYARAN:                                                  |
|  Pilih Bank Pengirim: [ Bank BCA         v ]                                      |
|  Nominal yang Ditransfer: [ 185.000        ]                                      |
|  Unggah Bukti Struk/Screenshot Transfer:                                          |
|  +-----------------------------------------------------------------------------+  |
|  | [ Ikon Unggah ]  Pilih berkas struk transfer bank (JPG/PNG, Maks 5MB)       |  |
|  +-----------------------------------------------------------------------------+  |
|                                                                                   |
|  [ Tombol: Kirim Konfirmasi Pembayaran ]                                          |
+-----------------------------------------------------------------------------------+
```

### 3.5 UX-022: Lacak Pesanan & Status Timeline (`/lacak-pesanan/{order_code}`)
- Visualisasi tahapan pesanan menggunakan komponen **Timeline Pelacakan Vertikal / Horizontal**:
  1. *Pesanan Dibuat* $\rightarrow$ 2. *Menunggu Verifikasi Pembayaran* $\rightarrow$ 3. *Buket Diproses Florist* $\rightarrow$ 4. *Siap Diambil/Dikirim* $\rightarrow$ 5. *Pesanan Selesai*.
- Dilengkapi tombol satu klik: *"Hubungi Florist via WhatsApp"* dengan pesan otomatis yang sudah menyertakan kode pesanan untuk konfirmasi kilat.

### 3.6 UX-023 & UX-024: Profil Usaha & Kontak Butik
- **Tentang BLOOMÉ:** Kisah pendirian oleh Nabila Febriyani, komitmen terhadap estetika bunga segar berkualitas, dan sentuhan artisan personal di Samarinda.
- **Kontak & Lokasi:** Peta petunjuk arah tersemat (*Google Maps link*), alamat butik di Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda, jam operasional: Senin–Minggu 08.00–20.00 WITA.

---

## 4. Kesimpulan & Rekomendasi
Seluruh spesifikasi wireframe halaman pelanggan **UX-014 hingga UX-024** telah tuntas dirancang dengan tata letak visual terstruktur, ramah seluler (*mobile-first*), dan mematuhi seluruh alur pemesanan tamu BLOOMÉ.

