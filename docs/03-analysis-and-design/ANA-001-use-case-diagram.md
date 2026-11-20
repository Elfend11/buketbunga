# USE CASE DIAGRAM & SYSTEM INTERACTION SPECIFICATION
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-001  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-006 s/d DOC-015 (Phase 1 Requirements Selesai dan Diselaraskan)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dokumen Acuan:** `requirement.md`, `prd.md`, `docs/01-foundation/`, `docs/02-requirements/`  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Batasan Sistem

Dokumen pemodelan Diagram Use Case (Task ANA-001) menetapkan batas sistem (*system boundary*), mendefinisikan aktor pengguna, serta memetakan seluruh kapabilitas fungsional yang dapat dieksekusi oleh pengguna pada website **BLOOMÉ — Flowers & Stories**.

<<<<<<< HEAD
Sesuai dengan keputusan final tim (Konsep Sistem v1.1), sistem informasi BLOOMÉ dirancang sebagai **katalog interaktif dan media konfigurasi personalisasi buket bunga, sedangkan proses pemesanan resmi, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**.

Diagram use case ini memodelkan interaksi antara dua aktor utama dan satu sistem eksternal:
1. **Customer (Pelanggan):** Aktor publik tanpa login (*guest*) yang berinteraksi untuk menelusuri katalog, melihat galeri foto, memilih variasi personalisasi (*color swatches*), memilih add-on, mengisi catatan khusus/ucapan, melihat kalkulasi estimasi harga secara real-time, meneruskan pemesanan ke WhatsApp (*hand-off*), atau berkonsultasi mengenai buket custom di luar katalog melalui WhatsApp.
2. **Admin (Pemilik Usaha):** Aktor terautentikasi tunggal (Nabila Febriyani) yang mengendalikan etalase digital melalui dashboard: mengelola produk & kategori, mengunggah galeri multi-foto, mengatur variasi personalisasi & add-on, mengubah status ketersediaan stok produk, serta mengonfigurasi nomor WhatsApp dan informasi bisnis toko.
3. **Aplikasi WhatsApp (External Communication Channel):** Media komunikasi di luar sistem web tempat pelanggan mengirim pesan pesanan secara manual, mendiskusikan ketersediaan bunga riil, melakukan pembayaran transfer bank / e-wallet, menyepakati DP 50%, dan mengoordinasikan jadwal pengiriman di Samarinda.
=======
Sesuai dengan arahan perancangan terbaru:
1. **Hakikat Sistem:** Website BLOOMÉ berfungsi sebagai **katalog interaktif dan media personalisasi buket bunga** yang memfasilitasi eksplorasi visual, pemilihan kustomisasi, pemilihan *add-on*, dan penghitungan estimasi harga.
2. **Batas Transaksi & Alur WhatsApp:** Website **TIDAK** menyediakan keranjang belanja checkout, penyimpanan transaksi pesanan resmi di basis data, *payment gateway*, unggah bukti transfer, manajemen status pesanan, maupun pelacakan pengiriman. Titik akhir dari proses pemesanan di website adalah **pengalihan pemesanan ke WhatsApp (*WhatsApp Order Hand-off*)** dengan pesan terformat otomatis (*pre-filled message*).
3. **Kesepakatan & Pembayaran Luar Sistem (*Out-of-Band*):** Konfirmasi ketersediaan bahan, finalisasi harga, pertukaran foto referensi custom, instruksi transfer perbankan, verifikasi pembayaran manual oleh florist, serta koordinasi pengiriman (*delivery*) berlangsung sepenuhnya secara manual di WhatsApp.
4. **Peran Administrator Tunggal:** Admin hanya memiliki **satu akun** yang difokuskan untuk mengelola master data katalog, kategori, produk buket, opsi personalisasi, add-on, ketersediaan stok, dan informasi kontak bisnis.
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 2. Identifikasi Aktor Sistem (System Actors)

```mermaid
graph LR
<<<<<<< HEAD
    subgraph Actors ["Aktor Sistem BLOOMÉ v1.1"]
        C["👤 Customer (Guest)<br>- Akses publik tanpa registrasi/login<br>- Eksplorasi katalog & konfigurasi buket<br>- Hand-off pemesanan ke WhatsApp"]
        A["🔐 Admin (Owner: Nabila Febriyani)<br>- Terautentikasi via login tunggal<br>- Mengelola etalase produk, galeri, stok,<br>  opsi personalisasi, & kontak toko"]
        WA["💬 WhatsApp App (External Channel)<br>- Penerima pesan draf terformat<br>- Media transaksi, bayar & pengiriman"]
=======
    subgraph Actors ["Aktor Sistem BLOOMÉ"]
        C["👤 Customer (Guest)<br>- Akses publik tanpa registrasi/login<br>- Eksplorasi katalog & personalisasi buket<br>- Mengalihkan pesanan ke WhatsApp"]
        A["🔐 Admin (Owner: Nabila Febriyani)<br>- Terautentikasi satu akun via login<br>- Mengelola produk, kategori, add-on & profil bisnis"]
>>>>>>> c202b49 (Revise documentation and initial implementation)
    end
```

| Nama Aktor | Tipe Aktor | Deskripsi Peran & Hak Akses |
|---|---|---|
<<<<<<< HEAD
| **Customer** | Primer (*Human User*) | Pengguna umum/pelanggan yang mengakses website secara bebas tanpa perlu mendaftar atau login (*zero-login*). Berhak melihat katalog, menyaring kategori, melihat detail & galeri multi-foto, memilih opsi variasi personalisasi (wrapping, pita), memilih add-on, menuliskan kartu ucapan, melihat ringkasan estimasi harga live, menekan tombol "Pesan via WhatsApp", dan menekan tombol "Konsultasi Buket Custom via WhatsApp". Tidak memiliki akses ke panel admin. |
| **Admin** | Primer (*Human User*) | Pemilik usaha BLOOMÉ (Nabila Febriyani) yang memiliki akses administratif penuh melalui otentikasi login aman (Bcrypt & token CSRF). Berhak mengelola master kategori, master produk, galeri multi-foto, toggle ketersediaan stok, opsi personalisasi & nilai variasi, master add-on & penautannya, serta pengaturan nomor WhatsApp dan profil butik di tabel `business_settings`. |
| **WhatsApp App** | Eksternal (*External App*) | Saluran komunikasi obrolan mandiri di luar sistem web yang menerima pesan teks pesanan terformat otomatis dari website melalui URL protocol `wa.me`. Seluruh interaksi lanjutan (konfirmasi stok, negosiasi, bukti transfer manual, update pembuatan buket, dan pengiriman) dilakukan di dalam saluran ini. |
=======
| **Customer** | Primer (*Human User*) | Pengguna umum/pelanggan yang mengakses website tanpa perlu mendaftar atau masuk (*zero login*). Berhak melihat profil butik, menelusuri katalog, memfilter kategori, melihat detail produk, memilih variasi personalisasi & add-on, melihat estimasi total harga, serta mengklik tombol pemesanan untuk mengirimkan rincian pesanan ke WhatsApp resmi BLOOMÉ. |
| **Admin** | Primer (*Human User*) | Pemilik usaha BLOOMÉ (Nabila Febriyani) yang mengendalikan konten website melalui dashboard terproteksi. Berhak mengelola kategori buket, menambah/mengubah/menghapus produk buket beserta foto, mengelola ketersediaan stok (*is_available*), mengelola opsi personalisasi & add-on beserta tarif dasarnya, serta memperbarui informasi profil usaha dan nomor WhatsApp resmi. |
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 3. Diagram Use Case Sistem Lengkap (Mermaid Use Case Diagram)

```mermaid
flowchart LR
    %% Actors
    Cust(["👤 Customer (Guest)"])
<<<<<<< HEAD
    Adm(["🔐 Admin (Nabila)"])
    WAApp(["💬 WhatsApp App (External)"])

    %% System Boundary
    subgraph SystemBoundary ["Sistem Informasi Web BLOOMÉ — Flowers & Stories"]
        %% Customer Domain
        subgraph PublicFlow ["Ranah Publik (Customer Domain)"]
            UC01["UC-01: Melihat Beranda & Profil Butik Samarinda"]
            UC02["UC-02: Menjelajahi Katalog & Filter Kategori"]
            UC03["UC-03: Melihat Detail Buket & Galeri Multi-Foto"]
            UC04["UC-04: Mengonfigurasi Personalisasi Buket (Wrapping & Pita)"]
            UC05["UC-05: Memilih Item Add-on & Mengisi Catatan Ucapan"]
            UC06["UC-06: Melihat Ringkasan Pilihan & Kalkulasi Estimasi Harga Live"]
            UC07["UC-07: Mengarahkan Pemesanan ke WhatsApp (Generator Pesan)"]
            UC08["UC-08: Mengakses Konsultasi Buket Custom via WhatsApp"]
        end

        %% Admin Domain
        subgraph AdminFlow ["Ranah Administratif (Admin Dashboard)"]
            UC09["UC-09: Login Administrator (Single Admin Account)"]
            UC10["UC-10: Melihat Dashboard & Ringkasan Etalase Digital"]
            UC11["UC-11: Mengelola Kategori Produk (CRUD & Proteksi Relasi)"]
            UC12["UC-12: Mengelola Master Produk Buket (CRUD & Toggle Stok)"]
            UC13["UC-13: Mengelola Galeri Multi-Foto Produk (Upload & Primary Flag)"]
            UC14["UC-14: Mengelola Opsi Personalisasi & Nilai Variasi (Penyesuaian Harga)"]
            UC15["UC-15: Mengelola Master Item Add-on & Relasi Produk"]
            UC16["UC-16: Mengelola Pengaturan Bisnis & WhatsApp Toko (business_settings)"]
            UC17["UC-17: Logout Administrator"]
        end
    end

    %% External Operational Process (Outside Web)
    subgraph ExternalOps ["Operasional Luar Web (WhatsApp Direct Chat)"]
        OP01["Kirim Pesan Pemesanan Manual ke WhatsApp Toko"]
        OP02["Diskusi Ketersediaan Bunga, Kesepakatan Harga & DP 50%"]
        OP03["Kirim Bukti Pembayaran Transfer Bank / E-Wallet di Chat"]
        OP04["Koordinasi Pengiriman / Pengantaran Kurir di Samarinda"]
=======
    Adm(["🔐 Admin (Owner: Nabila)"])

    %% System Boundary
    subgraph SystemBoundary ["Sistem Informasi Website BLOOMÉ — Flowers & Stories"]
        %% Customer Use Cases
        subgraph CustomerDomain ["Ranah Pelanggan (Customer Domain)"]
            UC01["UC-01: Melihat Beranda & Informasi Usaha"]
            UC02["UC-02: Menjelajahi Katalog & Filter Kategori"]
            UC03["UC-03: Melihat Detail Produk Buket"]
            UC04["UC-04: Mengonfigurasi Personalisasi & Add-on"]
            UC05["UC-05: Melihat Ringkasan & Estimasi Harga"]
            UC06["UC-06: Mengalihkan Pemesanan ke WhatsApp"]
            UC07["UC-07: Memulai Konsultasi Custom via WhatsApp"]
        end

        %% Admin Use Cases
        subgraph AdminDomain ["Ranah Administratif (Admin Dashboard)"]
            UC08["UC-08: Login Administrator"]
            UC09["UC-09: Melihat Dashboard & Ringkasan Katalog"]
            UC10["UC-10: Mengelola Kategori Produk (CRUD)"]
            UC11["UC-11: Mengelola Produk Buket & Foto (CRUD)"]
            UC12["UC-12: Mengelola Opsi Personalisasi & Add-on (CRUD)"]
            UC13["UC-13: Mengelola Informasi Bisnis & Kontak WhatsApp"]
            UC14["UC-14: Logout Administrator"]
        end
    end

    %% External System Boundary (WhatsApp)
    subgraph ExternalApp ["Luar Lingkup Website (External Boundary)"]
        WAApp["📱 Aplikasi WhatsApp (Pesan Manual, Negosiasi, Pembayaran, Delivery)"]
>>>>>>> c202b49 (Revise documentation and initial implementation)
    end

    %% Customer Associations
    Cust --> UC01
    Cust --> UC02
    Cust --> UC03
    Cust --> UC04
    Cust --> UC05
    Cust --> UC06
    Cust --> UC07
<<<<<<< HEAD
    Cust --> UC08

    %% Includes inside Customer Domain
    UC07 -.->|<<include>>| UC04
    UC07 -.->|<<include>>| UC05
    UC07 -.->|<<include>>| UC06

    %% Admin Associations
=======

    %% Admin Associations
    Adm --> UC08
>>>>>>> c202b49 (Revise documentation and initial implementation)
    Adm --> UC09
    Adm --> UC10
    Adm --> UC11
    Adm --> UC12
    Adm --> UC13
    Adm --> UC14
<<<<<<< HEAD
    Adm --> UC15
    Adm --> UC16
    Adm --> UC17

    %% Hand-off to External Channel
    UC07 ==>|Buka Tautan wa.me| WAApp
    UC08 ==>|Buka Tautan wa.me| WAApp
    Cust -.->|Kirim Manual| OP01
    WAApp --- OP01
    OP01 --> OP02
    OP02 --> OP03
    OP03 --> OP04
    Adm -.->|Komunikasi Chat| OP02
    Adm -.->|Verifikasi Manual| OP03
=======

    %% Hand-off Associations
    UC06 -.->|Hand-off Link| WAApp
    UC07 -.->|Hand-off Link| WAApp
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

## 4. Rincian Paket Use Case Sistem

<<<<<<< HEAD
### 4.1 Paket 1: Eksplorasi Katalog & Personalisasi (Customer Domain)
1. **UC-01: Melihat Beranda & Profil Butik Samarinda:** Mengakses informasi profil butik BLOOMÉ di Samarinda, hero banner floral, sorotan produk unggulan, dan alamat fisik butik tanpa form login.
2. **UC-02: Menjelajahi Katalog & Filter Kategori:** Menampilkan kartu produk buket aktif dan menyaring katalog berdasarkan kategori (Buket Bunga, Buket Uang, Buket Snack, dll.).
3. **UC-03: Melihat Detail Buket & Galeri Multi-Foto:** Menampilkan komposisi rangkaian buket, galeri foto resolusi tajam dari berbagai sudut, deskripsi bahan, harga dasar resmi, dan badge ketersediaan stok (*Tersedia* / *Habis*).
4. **UC-04: Mengonfigurasi Personalisasi Buket (Wrapping & Pita):** Memilih kombinasi warna kertas pembungkus (*wrapping paper*) dan pita satin melalui pemilih visual (*color swatches* / radio buttons) yang langsung memperbarui pilihan.
5. **UC-05: Memilih Item Add-on & Mengisi Catatan Ucapan:** Memilih satu atau lebih item pelengkap (kartu ucapan premium, boneka wisuda, cokelat, lampu LED) dan mengetikkan pesan ucapan khusus bagi penerima buket.
6. **UC-06: Melihat Ringkasan Pilihan & Kalkulasi Estimasi Harga Live:** Meninjau rangkuman seluruh pilihan buket, variasi, dan add-on beserta kalkulasi total estimasi biaya secara otomatis di antarmuka web.
7. **UC-07: Mengarahkan Pemesanan ke WhatsApp (Generator Pesan):** Menekan tombol "Pesan via WhatsApp" yang menyusun pesan teks draf terstruktur rapi dan membuka tautan protokol `wa.me` ke nomor resmi toko tanpa menyimpan transaksi di basis data web.
8. **UC-08: Mengakses Konsultasi Buket Custom via WhatsApp:** Menekan tombol tautan khusus untuk memulai percakapan WhatsApp dengan florist guna mendiskusikan rancangan buket di luar katalog.

### 4.2 Paket 2: Pengelolaan Etalase Digital & Pengaturan Toko (Admin Domain)
1. **UC-09: Login Administrator:** Memasukkan email dan password terdaftar pada tabel `admins` untuk mendapatkan token sesi akses dashboard yang terenkripsi dan terlindungi CSRF.
2. **UC-10: Melihat Dashboard & Ringkasan Etalase Digital:** Memantau metrik statistik katalog: jumlah produk aktif, jumlah kategori, opsi personalisasi aktif, item add-on aktif, dan nomor WhatsApp toko yang sedang aktif.
3. **UC-11: Mengelola Kategori Produk (CRUD & Proteksi Relasi):** Menambah, mengubah nama/slug kategori, dan menghapus kategori dengan proteksi integritas agar kategori yang masih memuat produk aktif tidak terhapus.
4. **UC-12: Mengelola Master Produk Buket (CRUD & Toggle Stok):** Menambah buket baru lengkap dengan nama, deskripsi, harga dasar, dan sakelar cepat toggle ketersediaan (*In Stock* / *Out of Stock*).
5. **UC-13: Mengelola Galeri Multi-Foto Produk:** Mengunggah beberapa berkas foto produk (JPG/PNG ≤ 2MB), menetapkan urutan tampil (*sort order*), menandai foto sampul utama (*primary flag*), dan menghapus foto lama pada tabel `product_images`.
6. **UC-14: Mengelola Opsi Personalisasi & Nilai Variasi:** Mengonfigurasi tipe opsi personalisasi (pada tabel `personalization_options`), menautkannya ke produk, serta menetapkan nilai variasi, kode warna HEX swatch, dan nominal penyesuaian harga tambahan pada tabel `personalization_values`.
7. **UC-15: Mengelola Master Item Add-on & Relasi Produk:** Menambah dan mengedit master add-on (tabel `add_ons`) beserta harga satuan dan fotonya, serta menautkannya ke produk buket tertentu pada tabel pivot `product_add_ons`.
8. **UC-16: Mengelola Pengaturan Bisnis & WhatsApp Toko:** Memperbarui parameter kontak dinamis toko pada tabel `business_settings` (nomor WhatsApp tujuan pesanan, template pesan pembuka, jam operasional, dan alamat butik di Samarinda).
9. **UC-17: Logout Administrator:** Mengakhiri sesi login secara aman dengan menginvalidasi token sesi server.
=======
### 4.1 Paket 1: Ranah Pelanggan (Customer Domain)
1. **UC-01: Melihat Beranda & Informasi Usaha:** Mengakses profil butik BLOOMÉ Samarinda, nilai keunggulan (*Flowers & Stories*), showcase produk favorit, pengumuman promo, jam buka butik, alamat fisik di Samarinda, serta ketentuan awal layanan delivery.
2. **UC-02: Menjelajahi Katalog & Filter Kategori:** Menampilkan etalase buket aktif dalam tampilan grid responsif dan memfilter produk berdasarkan kategori bunga segar (*fresh flowers*), bunga tiruan (*artificial*), buket uang (*money bouquet*), atau buket makanan ringan (*snack bouquet*).
3. **UC-03: Melihat Detail Produk Buket:** Membuka lembar detail produk untuk memeriksa galeri foto beresolusi tinggi, nama varian, harga dasar katalog, deskripsi bahan/rangkaian bunga, dan status ketersediaan (*Tersedia / Stok Habis*).
4. **UC-04: Mengonfigurasi Personalisasi & Add-on:** Memilih opsi kustomisasi buket yang disediakan (pilihan warna kertas pembungkus/wrapping, warna pita satin), memilih item pelengkap/add-on berbayar (kartu ucapan khusus, boneka wisuda, cokelat, lampu LED), serta mengisi teks pesan kartu ucapan.
5. **UC-05: Melihat Ringkasan & Estimasi Harga:** Meninjau rangkuman rincian buket yang telah dikonfigurasi, mencakup harga dasar produk, total biaya add-on tambahan, estimasi total belanja, tanggal kebutuhan, dan alamat tujuan delivery di Samarinda.
6. **UC-06: Mengalihkan Pemesanan ke WhatsApp:** Sistem mengompilasi seluruh konfigurasi pesanan ke dalam format teks pesan terstruktur (*pre-filled message*), kemudian membuka aplikasi WhatsApp melalui skema URL universal (`https://wa.me/`) langsung ke nomor resmi florist.
7. **UC-07: Memulai Konsultasi Custom via WhatsApp:** Menghubungi florist secara langsung melalui tombol konsultasi cepat WhatsApp pada halaman khusus personalisasi fleksibel untuk mendiskusikan anggaran, pengiriman foto referensi custom, dan ide desain unik.

### 4.2 Paket 2: Ranah Administratif (Admin Domain)
1. **UC-08: Login Administrator:** Memasukkan email dan kata sandi terenkripsi (Bcrypt) untuk mendapatkan sesi akses panel kontrol admin tunggal.
2. **UC-09: Melihat Dashboard & Ringkasan Katalog:** Memantau metrik ringkasan konten website, seperti total kategori aktif, total produk terdaftar, produk berstatus habis, dan total opsi add-on.
3. **UC-10: Mengelola Kategori Produk (CRUD):** Menambah, melihat, mengubah nama dan deskripsi kategori, serta menghapus kategori buket dengan proteksi integritas jika masih memuat produk.
4. **UC-11: Mengelola Produk Buket & Foto (CRUD):** Menambah produk buket baru, mengunggah foto produk ke media penyimpanan lokal (`storage/app/public/products/`), mengubah harga dasar, menyunting deskripsi, dan mengaktifkan/menonaktifkan ketersediaan stok (*In Stock* / *Out of Stock*).
5. **UC-12: Mengelola Opsi Personalisasi & Add-on (CRUD):** Mengelola daftar opsi kustomisasi dan add-on yang tampil di halaman pelanggan, termasuk nama add-on, tarif harga tambahan, dan status ketersediaan item.
6. **UC-13: Mengelola Informasi Bisnis & Kontak WhatsApp:** Memperbarui nomor telepon WhatsApp resmi butik yang menjadi tujuan redirect pemesanan, alamat fisik butik Samarinda, tautan media sosial, dan catatan kebijakan operasional.
7. **UC-14: Logout Administrator:** Mengakhiri sesi administrasi secara aman dan menginvalidasi token sesi peramban.
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 5. Matriks Ketertelusuran Kebutuhan Fungsional ke Use Case (Traceability Matrix)

<<<<<<< HEAD
| Kebutuhan Fungsional (SRS v1.1) | ID Use Case | Deskripsi Use Case Terkait |
|---|---|---|
| **FR-001 (Homepage Display)** | `UC-01` | Melihat Beranda & Profil Butik Samarinda |
| **FR-002 (Catalog Browsing & Category Filter)** | `UC-02` | Menjelajahi Katalog & Filter Kategori |
| **FR-003 (Product Detail & Multi-Image Gallery)** | `UC-03` | Melihat Detail Buket & Galeri Multi-Foto |
| **FR-004 (Stock Availability Badge)** | `UC-03` | Melihat Detail Buket & Galeri Multi-Foto |
| **FR-005 (Interactive Personalization Configurator)** | `UC-04` | Mengonfigurasi Personalisasi Buket (Wrapping & Pita) |
| **FR-006 (Add-on Selector)** | `UC-05` | Memilih Item Add-on & Mengisi Catatan Ucapan |
| **FR-007 (Custom Note & Greeting Card Input)** | `UC-05` | Memilih Item Add-on & Mengisi Catatan Ucapan |
| **FR-008 (Live Price Estimation Summary)** | `UC-06` | Melihat Ringkasan Pilihan & Kalkulasi Estimasi Harga Live |
| **FR-009 (Multi-Item Bouquet Selection Draft)** | `UC-06` | Melihat Ringkasan Pilihan & Kalkulasi Estimasi Harga Live `[Perlu Konfirmasi Owner]` |
| **FR-010 (WhatsApp Order Message Generator)** | `UC-07` | Mengarahkan Pemesanan ke WhatsApp (Generator Pesan) |
| **FR-011 (Direct WhatsApp Ordering Hand-off)** | `UC-07` | Mengarahkan Pemesanan ke WhatsApp (Generator Pesan) |
| **FR-012 (Direct Custom Bouquet Consultation Link)** | `UC-08` | Mengakses Konsultasi Buket Custom via WhatsApp |
| **FR-013 (Single Admin Secure Authentication)** | `UC-09`, `UC-17` | Login & Logout Administrator |
| **FR-014 (Admin Dashboard Catalog Overview)** | `UC-10` | Melihat Dashboard & Ringkasan Etalase Digital |
| **FR-015 (Category Management - CRUD)** | `UC-11` | Mengelola Kategori Produk (CRUD & Proteksi Relasi) |
| **FR-016 (Product Management - CRUD)** | `UC-12` | Mengelola Master Produk Buket (CRUD & Toggle Stok) |
| **FR-017 (Product Stock Availability Toggle)** | `UC-12` | Mengelola Master Produk Buket (CRUD & Toggle Stok) |
| **FR-018 (Product Multi-Photo Gallery Management)** | `UC-13` | Mengelola Galeri Multi-Foto Produk (Upload & Primary Flag) |
| **FR-019 (Personalization Type Management)** | `UC-14` | Mengelola Opsi Personalisasi & Nilai Variasi |
| **FR-020 (Personalization Values & Price Adjustment)** | `UC-14` | Mengelola Opsi Personalisasi & Nilai Variasi |
| **FR-021 (Product-Personalization Association)** | `UC-14` | Mengelola Opsi Personalisasi & Nilai Variasi |
| **FR-022 (Add-on Items Management - CRUD)** | `UC-15` | Mengelola Master Item Add-on & Relasi Produk |
| **FR-023 (Product-Add-on Association)** | `UC-15` | Mengelola Master Item Add-on & Relasi Produk |
| **FR-024 (WhatsApp Store Number Configuration)** | `UC-16` | Mengelola Pengaturan Bisnis & WhatsApp Toko |
| **FR-025 (Store Profile & Message Template Settings)** | `UC-16` | Mengelola Pengaturan Bisnis & WhatsApp Toko |
=======
| Kebutuhan Fungsional (SRS Baseline) | ID Use Case | Deskripsi Use Case Terkait | Keterangan Batas Sistem |
|---|---|---|---|
| **Eksplorasi Beranda & Profil** | `UC-01` | Melihat Beranda & Informasi Usaha | Sisi Website (Publik) |
| **Katalog & Penapisan Kategori** | `UC-02` | Menjelajahi Katalog & Filter Kategori | Sisi Website (Publik) |
| **Detail Produk & Komposisi** | `UC-03` | Melihat Detail Produk Buket | Sisi Website (Publik) |
| **Personalisasi & Add-on Buket** | `UC-04` | Mengonfigurasi Personalisasi & Add-on | Sisi Website (Interaktif) |
| **Kalkulasi Estimasi Harga** | `UC-05` | Melihat Ringkasan & Estimasi Harga | Sisi Website (Client/Server Calc) |
| **Hand-off Pemesanan WhatsApp** | `UC-06` | Mengalihkan Pemesanan ke WhatsApp | Jembatan Website $\rightarrow$ WhatsApp |
| **Konsultasi Custom Eksternal** | `UC-07` | Memulai Konsultasi Custom via WhatsApp | Jembatan Website $\rightarrow$ WhatsApp |
| **Otentikasi Admin Tunggal** | `UC-08`, `UC-14` | Login & Logout Administrator | Sisi Website (Admin Guard) |
| **Ringkasan Metrik Katalog** | `UC-09` | Melihat Dashboard & Ringkasan Katalog | Sisi Website (Admin Back-Office) |
| **Manajemen Kategori Buket** | `UC-10` | Mengelola Kategori Produk (CRUD) | Sisi Website (Admin Back-Office) |
| **Manajemen Produk & Foto** | `UC-11` | Mengelola Produk Buket & Foto (CRUD) | Sisi Website (Admin Back-Office) |
| **Manajemen Add-on & Personalisasi**| `UC-12` | Mengelola Opsi Personalisasi & Add-on | Sisi Website (Admin Back-Office) |
| **Manajemen Kontak & Profil Bisnis**| `UC-13` | Mengelola Informasi Bisnis & WhatsApp | Sisi Website (Admin Back-Office) |
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 6. Penegasan Batas Alur Transaksi & Kebijakan Operasional

<<<<<<< HEAD
### 6.1 Status Task ANA-001
Task **ANA-001 (Use Case Diagram)** telah selesai diselaraskan:
- Batas sistem (*system boundary*) secara tegas memisahkan peranan website (katalog interaktif & konfigurator) dengan peranan aplikasi WhatsApp (transaksi, pembayaran, dan koordinasi pengiriman).
- 17 Use Case resmi (UC-01 s/d UC-17) telah dipetakan secara presisi menghubungkan aktor *Customer (Guest)* dan *Admin (Nabila)* ke seluruh 25 kebutuhan fungsional (FR-001 s/d FR-025).
- Seluruh Use Case usang yang menggambarkan checkout web, mutasi transfer di web, dan approval status transaksi web telah dieliminasi.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 6.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task pemodelan deskripsi rincian:
- **`ANA-002 — Use Case Descriptions.`**
=======
1. **Peniadaan Transaksi pada Website:**
   - Tidak ada entitas `orders`, `payments`, atau `order_status_histories` yang dibuat atau dimutasi melalui website.
   - Website berfungsi murni sebagai etalase pintar dan kalkulator konfigurasi buket bunga yang mempermudah pembeli merangkai pesanannya sebelum diteruskan ke kasir/florist.
2. **Kebijakan Layanan Pengiriman (Delivery):**
   - Keputusan awal layanan disepakati berbentuk **delivery** ke alamat penerima di Samarinda dan sekitarnya (bukan *self-pickup* di butik).
   - Penentuan kurir dan rincian ongkos kirim: `[Perlu Konfirmasi Owner]`.
3. **Penyelesaian Transaksi:**
   - Negosiasi harga khusus, transfer uang ke rekening bank, bukti mutasi, dan pelacakan kurir diselesaikan langsung antara pembeli dan Nabila Febriyani di ruang obrolan WhatsApp.

---

## 7. Kesimpulan
Task **ANA-001 (Use Case Diagram)** telah selesai direkonstruksi penuh. Diagram dan batasan sistem 100% konsisten dengan paradigma katalog interaktif dan pengalihan pemesanan ke WhatsApp.
>>>>>>> c202b49 (Revise documentation and initial implementation)
