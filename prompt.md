# PROMPT DAN DIRECTIVE REVISI MENYELURUH DOKUMENTASI PROYEK BLOOMÉ (v1.1)

Dokumen ini memuat ringkasan arahan, kesepakatan tim, dan panduan revisi menyeluruh untuk proyek:

**BLOOMÉ — Flowers & Stories**  
*Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web*

---

## 1. Tujuan & Konsep Inti Sistem (Revisi v1.1)

Setelah melalui evaluasi proses bisnis dan persetujuan tim bersama pemilik usaha, konsep sistem disepakati secara definitif menjadi:

> **"Website berfungsi sebagai katalog interaktif dan media personalisasi buket, sedangkan proses pemesanan, konfirmasi ketersediaan, negosiasi harga, pembayaran, dan koordinasi pengiriman dilanjutkan secara langsung melalui WhatsApp."**

Dokumentasi versi 1.0 yang sebelumnya mengasumsikan website menangani checkout mandiri, penyimpanan transaksi di database, pelacakan status pesanan internal (ST-01 s/d ST-08), payment gateway/verifikasi bukti bayar di web, dan pembatalan pesanan di web **telah direvisi secara menyeluruh** agar selaras dengan konsep operasional riil.

---

## 2. Identitas Proyek & Struktur Tim

- **Nama Brand:** BLOOMÉ — Flowers & Stories
- **Nama Proyek:** Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web
- **Pemilik Usaha / Client / Sponsor:** Nabila Febriyani
- **Lokasi Usaha:** Jl. Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda, Kalimantan Timur
- **Tim Pengembang:**
  - **Project Manager & System Analyst:** Jayanti Firdasari
  - **UI/UX Designer & Frontend Developer:** Riya Monika
  - **Backend Developer & Database Administrator:** Elsa Futri
- **Metodologi Pengembangan:** Waterfall (Analysis -> Design -> Implementation -> Testing -> Deployment)
- **Arsitektur Perangkat Lunak:** Three-Layer Architecture (Presentation Layer - Application Layer - Data Layer)
- **Teknologi Utama:** Laravel (PHP), MySQL, Blade Templating Engine, Vite, Tailwind CSS / Vanilla CSS, JavaScript
- **Periode Proyek:** 13 Oktober 2026 – 30 November 2026

---

## 3. Batasan Ruang Lingkup Sistem (Scope Boundaries)

### 3.1 Sisi Pelanggan (Public Web User)
1. Menjelajahi beranda (*homepage*), identitas brand, dan katalog buket bunga.
2. Memfilter dan melihat produk berdasarkan kategori (contoh: Buket Bunga, Buket Uang, Buket Snack, Buket Boneka).
3. Melihat halaman detail produk (foto, deskripsi, harga dasar, ketersediaan).
4. Memilih opsi personalisasi (warna kertas wrapping, pita, nuansa bunga/kertas) yang dikelola secara dinamis oleh admin.
5. Memilih opsi *add-on* (kartu ucapan, topper akrilik, boneka mini, lampu LED) beserta kalkulasi harga tambahannya.
6. Menuliskan catatan khusus (*special notes/custom request notes*).
7. Memeriksa ringkasan pilihan dan estimasi total harga secara *real-time* di antarmuka web.
8. Memilih opsi pemesanan multi-produk buket ke dalam satu pesan draft WhatsApp **[Perlu Konfirmasi Owner]**.
9. Menekan tombol tindakan (CTA) **"Pesan via WhatsApp"** yang secara otomatis mengompilasi rincian pesanan menjadi URL `https://wa.me/<nomor>?text=...`.
10. Menghubungi pemilik usaha via WhatsApp untuk konsultasi pesanan buket *custom* penuh di luar katalog standar.
11. **Pelanggan TIDAK memerlukan registrasi akun atau login.**

### 3.2 Batasan Eksplisit Website (Batas Proses)
- Website **TIDAK** menyediakan alur *checkout* mandiri.
- Website **TIDAK** menyimpan transaksi pemesanan resmi ke dalam tabel basis data.
- Website **TIDAK** mengelola atau mengubah *order status lifecycle* (ST-01 s/d ST-08 di web dieliminasi).
- Website **TIDAK** memproses transaksi pembayaran maupun integrasi *payment gateway*.
- Website **TIDAK** menyediakan formulir unggah bukti transfer pembayaran.
- Website **TIDAK** mengelola tawar-menawar / negosiasi harga.
- Website **TIDAK** mengirim pesan otomatis via WhatsApp Business API Gateway (pengiriman dilakukan manual oleh pelanggan melalui tautan URL Scheme WhatsApp).
- Website **TIDAK** menampilkan klaim "pesanan berhasil diterima" hanya karena tombol WhatsApp ditekan.
- Pemilik usaha mengonfirmasi ketersediaan slot pengerjaan, total biaya final, detail rekening pembayaran, dan jadwal pengiriman secara langsung di WhatsApp.

### 3.3 Sisi Admin (Single Store Owner Account)
1. Melakukan login terproteksi ke panel Admin Dashboard melalui satu akun pemilik.
2. Mengelola Kategori Produk (*CRUD Categories*).
3. Mengelola Produk Buket (*CRUD Products* & Ketersediaan Produk).
4. Mengelola Galeri Foto Produk (*CRUD Product Images*).
5. Mengelola Opsi Personalisasi (*CRUD Personalization Options & Values*).
6. Mengelola Opsi Tambahan / Add-on beserta harganya (*CRUD Add-ons & Product Add-ons*).
7. Mengelola Pengaturan Informasi Kontak dan Nomor WhatsApp Bisnis (*CRUD Business Settings*).
8. **Tidak ada** manajemen multi-role, tidak ada akun pelanggan, dan tidak ada tabel transaksi/pembayaran di web.

---

## 4. Struktur Database Baru (10 Entitas)

Sistem menggunakan 10 tabel terpadu pada MySQL 8.0+ (InnoDB, `utf8mb4_unicode_ci`):
1. `admins` — Kredensial akun admin tunggal (pemilik toko).
2. `categories` — Kategori buket bunga.
3. `products` — Data master produk buket.
4. `product_images` — Galeri foto pendukung produk buket.
5. `personalization_options` — Grup opsi personalisasi (contoh: Warna Wrapping, Nuansa Warna).
6. `personalization_values` — Pilihan nilai variasi spesifik beserta biaya tambahan jika ada.
7. `product_personalization_options` — Tabel relasi penetapan opsi personalisasi ke produk.
8. `add_ons` — Master item tambahan (kartu ucapan, boneka wisuda, lampu LED, topper).
9. `product_add_ons` — Tabel relasi penetapan add-on ke produk.
10. `business_settings` — Parameter konfigurasi dinamis (nomor WhatsApp bisnis, jam operasional, alamat toko).

---

## 5. Parameter Menunggu Konfirmasi Owner (`[Perlu Konfirmasi Owner]`)

Hal-hal berikut belum ditetapkan secara final oleh pemilik toko dan wajib ditandai secara konsisten:
1. Nomor WhatsApp resmi toko untuk penerimaan pesanan.
2. Daftar produk katalog final, spesifikasi, dan foto resolusi tinggi.
3. Struktur harga produk final.
4. Daftar variasi personalisasi resmi yang dapat dipilih pelanggan.
5. Daftar item add-on resmi beserta harga tambahannya.
6. Ketentuan teknis pemesanan beberapa buket dalam satu pesan WhatsApp.
7. Format data pelanggan yang wajib disertakan pada template pesan WhatsApp.
8. Format alamat lengkap dan jadwal pengiriman khusus area Samarinda.
9. Penerapan DP 50% dan batas waktu pelunasan (sebelum perakitan atau sebelum pengiriman).
10. Detail nomor rekening bank dan akun e-wallet resmi.
11. Kebijakan pembatalan pesanan dan aturan pengembalian dana (*refund policy*).
12. Tautan resmi profil media sosial (Instagram, TikTok).
13. Batas ukuran dan format unggah foto produk di dashboard admin.
14. Rencana domain, penyedia web hosting, jadwal backup, dan pemeliharaan server.