# LAPORAN PENINJAUAN FUNCTIONAL REQUIREMENTS & MATRIKS KETERTELUSURAN (RTM) (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-007  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan Awal:** 13 November 2026  
**Tanggal Revisi Penyelarasan:** 20 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-006 — Menyusun `requirement.md` (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kebutuhan Fungsional (Task DOC-007) dilakukan untuk memvalidasi kelayakan, kelengkapan, ketegasan batasan, serta ketertelusuran (*traceability*) dari seluruh kebutuhan fungsional sistem informasi **BLOOMÉ — Flowers & Stories**.

Berdasarkan kesepakatan baseline **v1.1**, sistem web difokuskan sebagai **katalog interaktif dan media konfigurasi personalisasi buket bunga, dengan alur pemesanan dialihkan langsung ke WhatsApp**.

Hasil peninjauan mengonfirmasi terdapat **25 Kebutuhan Fungsional Terpadu (FR-001 s/d FR-025)** yang terbagi ke dalam dua domain:
- **12 Kebutuhan Fungsional Pelanggan Publik (FR-001 s/d FR-012)**
- **13 Kebutuhan Fungsional Administrator (FR-013 s/d FR-025)**

Seluruh kebutuhan fungsional telah terbebas dari konsep transaksi checkout dan status order di web yang usang, serta telah dipetakan secara terstruktur ke dalam modul teknis, entitas basis data (10 tabel), dan task implementasi pada `task.md`.

---

## 2. Rincian Kebutuhan Fungsional Publik (Customer Interface)

| ID Kebutuhan | Nama Kebutuhan | Deskripsi Fungsional & Kriteria Validasi | Status Kelayakan |
|---|---|---|:---:|
| **FR-001** | Halaman Beranda (Homepage) | Menampilkan identitas visual BLOOMÉ, hero section, perkenalan usaha, etalase buket unggulan, banner promosi buket custom, informasi galeri Samarinda, dan footer. Mendukung aksesibilitas responsif di semua perangkat. | Layak & Jelas |
| **FR-002** | Katalog Produk Interaktif | Menampilkan daftar buket aktif dalam format kartu grid (foto, nama, harga dasar, kategori, status ketersediaan). Dilengkapi fitur filtering berbasis kategori tanpa reload lambat. | Layak & Jelas |
| **FR-003** | Filter Kategori Katalog | Menyediakan navigasi tombol/tab kategori (Buket Bunga, Buket Uang, Buket Snack, Buket Boneka) untuk menyaring produk secara cepat di sisi klien/server. | Layak & Jelas |
| **FR-004** | Halaman Detail Produk | Menampilkan galeri multi-foto buket, deskripsi komposisi bunga/kertas, dimensi perkiraan, harga dasar, badge ketersediaan (*Tersedia*/*Habis*), dan panel konfigurator personalisasi. | Layak & Jelas |
| **FR-005** | Pemilih Personalisasi Buket | Antarmuka interaktif bagi pelanggan untuk memilih variasi personalisasi buket (warna kertas wrapping, jenis pita satin, dll.) lengkap dengan visual color swatch dan penambahan biaya variasi jika ada. | Layak & Jelas |
| **FR-006** | Pemilih Item Add-on | Daftar pilihan item tambahan buket (kartu ucapan cetak, boneka wisuda, topper akrilik, lampu LED) beserta rincian penambahan harga satuan yang jelas. | Layak & Jelas |
| **FR-007** | Input Catatan Khusus & Ucapan | Area teks (*textarea*) bagi pelanggan untuk mencantumkan teks ucapan kartu dan instruksi khusus perangkaian atau tanggal kebutuhan buket di Samarinda. | Layak & Jelas |
| **FR-008** | Ringkasan Pilihan & Estimasi Harga | Kartu ringkasan interaktif yang menghitung estimasi total harga secara *real-time* di browser ($Total = Base + Variations + AddOns$) dengan teks disclaimer yang transparan. | Layak & Jelas |
| **FR-009** | Generator Pesan Pemesanan WhatsApp | Menyusun seluruh preferensi buket pilihan pelanggan menjadi draf teks terstruktur dan membuka tautan URL Scheme resmi toko (`https://wa.me/...`) saat tombol "Pesan via WhatsApp" diklik. | Layak & Jelas |
| **FR-010** | Ketentuan Pemesanan Multi-Buket | Opsi penampungan beberapa jenis buket ke dalam satu pesan pemesanan WhatsApp **[Perlu Konfirmasi Owner]**. | Menunggu Konfirmasi |
| **FR-011** | Konsultasi Buket Custom via WhatsApp | Halaman/seksi khusus Custom Bouquet yang menjelaskan layanan rancang bebas beserta tombol CTA "Konsultasi Desain Custom via WhatsApp" dengan template teks pembuka. | Layak & Jelas |
| **FR-012** | Informasi Kontak & Profil Usaha | Menampilkan profil butik, jam operasional, alamat fisik Jalan Cipto Mangunkusumo Samarinda, dan tautan media sosial resmi. | Layak & Jelas |

---

## 3. Rincian Kebutuhan Fungsional Administrator (Admin Dashboard)

| ID Kebutuhan | Nama Kebutuhan | Deskripsi Fungsional & Kriteria Validasi | Status Kelayakan |
|---|---|---|:---:|
| **FR-013** | Otentikasi Login Admin | Login satu pintu admin menggunakan email dan password terenkripsi (Bcrypt/Argon2id), proteksi CSRF token, dan middleware guard `auth:admin`. | Layak & Jelas |
| **FR-014** | Logout Admin | Mengakhiri sesi otentikasi admin secara aman, meregenerasi session ID, dan mengarahkan kembali ke formulir login. | Layak & Jelas |
| **FR-015** | Dashboard Overview Etalase | Menampilkan kartu metrik ringkasan: Total Produk Aktif, Produk Habis/Slot Penuh, Total Kategori, dan Total Add-on Aktif. | Layak & Jelas |
| **FR-016** | Manajemen Kategori (CRUD) | Operasi Create, Read, Update, Delete kategori buket, generator slug otomatis, dan proteksi penghapusan kategori yang masih menaungi produk aktif. | Layak & Jelas |
| **FR-017** | Manajemen Produk Katalog (CRUD) | Operasi Create, Read, Update, Delete master produk buket: upload foto utama, penetapan nama, slug, harga dasar, deskripsi, dan relasi kategori. | Layak & Jelas |
| **FR-018** | Toggle Ketersediaan Produk | Mengubah status ketersediaan buket (*Tersedia* / *Habis/Slot Penuh*) secara instan yang langsung berdampak pada tampilan lencana dan tombol pesan di katalog publik. | Layak & Jelas |
| **FR-019** | Manajemen Galeri Multi-Foto | Mengunggah multi-foto pendukung produk buket ke storage lokal, mengatur urutan tampil (*sort order*), dan menghapus foto galeri. | Layak & Jelas |
| **FR-020** | Manajemen Opsi Personalisasi | Operasi CRUD grup opsi personalisasi (misal: *Warna Kertas Wrapping*, *Warna Pita*) dan penentuan tipe kontrol UI (`select`, `radio`, `color_swatch`). | Layak & Jelas |
| **FR-021** | Manajemen Nilai Variasi Personalisasi | Operasi CRUD nilai variasi spesifik, penetapan kode warna HEX untuk swatch, biaya tambahan variasi jika ada, dan status ketersediaan variasi. | Layak & Jelas |
| **FR-022** | Penetapan Personalisasi ke Produk | Antarmuka pemilihan opsi personalisasi mana saja yang aktif dan berlaku untuk produk buket tertentu. | Layak & Jelas |
| **FR-023** | Manajemen Item Add-on (CRUD) | Operasi CRUD master item tambahan buket (nama, harga satuan, deskripsi, thumbnail) dan pengaturan status ketersediaan item. | Layak & Jelas |
| **FR-024** | Penetapan Add-on ke Produk | Mengonfigurasi pilihan item add-on yang diizinkan untuk dipilih pada produk buket tertentu. | Layak & Jelas |
| **FR-025** | Manajemen Pengaturan Bisnis & WhatsApp | Mengelola data konfigurasi dinamis toko pada basis data: nomor WhatsApp resmi tujuan pemesanan, jam kerja operasional, dan alamat toko di Samarinda. | Layak & Jelas |

---

## 4. Requirements Traceability Matrix (RTM v1.1)

Matriks ketertelusuran memastikan bahwa setiap kebutuhan fungsional memiliki pemetaan konkret ke entitas basis data (10 tabel), controller/view Blade Laravel, serta nomor task implementasi di `task.md`:

| Req ID | Aktor | Entitas Database Terkait | Controller & View Terkait | Task Backend | Task Frontend |
|---|---|---|---|---|---|
| **FR-001** | Customer | `products`, `categories` | `HomeController@index` (`home.blade.php`) | BE-001, BE-016 | FE-009 |
| **FR-002** | Customer | `products`, `categories` | `CatalogController@index` (`catalog/index.blade.php`) | BE-016, BE-021 | FE-010 |
| **FR-003** | Customer | `categories` | `CatalogController@index` (`catalog/index.blade.php`) | BE-012, BE-016 | FE-010 |
| **FR-004** | Customer | `products`, `product_images`, `categories` | `CatalogController@show` (`catalog/show.blade.php`) | BE-016, BE-022 | FE-011 |
| **FR-005** | Customer | `personalization_options`, `personalization_values` | `CatalogController@show` (`catalog/show.blade.php`) | BE-025, BE-026 | FE-012 |
| **FR-006** | Customer | `add_ons`, `product_add_ons` | `CatalogController@show` (`catalog/show.blade.php`) | BE-028, BE-030 | FE-013 |
| **FR-007** | Customer | *(State Klien JS)* | `CatalogController@show` (`catalog/show.blade.php`) | - | FE-014 |
| **FR-008** | Customer | *(State Klien JS)* | `CatalogController@show` (`catalog/show.blade.php`) | - | FE-015, FE-016 |
| **FR-009** | Customer | `business_settings` | `personalization.js` (`wa.me` generator) | BE-031, BE-032 | FE-008, FE-016 |
| **FR-010** | Customer | *(Pending Confirmation)* | `personalization.js` | BE-032 | FE-016 |
| **FR-011** | Customer | `business_settings` | `CustomBouquetController@index` (`custom-bouquet.blade.php`) | BE-031 | FE-017 |
| **FR-012** | Customer | `business_settings` | `HomeController@about`, `contact` | BE-031 | FE-018 |
| **FR-013** | Admin | `admins` | `Admin\LoginController` (`admin/login.blade.php`) | BE-008 s/d BE-011 | FE-019 |
| **FR-014** | Admin | `admins` | `Admin\LoginController@logout` | BE-010 | FE-019 |
| **FR-015** | Admin | `products`, `categories`, `add_ons` | `Admin\DashboardController` (`admin/dashboard.blade.php`) | BE-016, BE-012 | FE-020 |
| **FR-016** | Admin | `categories` | `Admin\CategoryController` (`admin/categories/*`) | BE-012 s/d BE-015 | FE-021 |
| **FR-017** | Admin | `products`, `categories` | `Admin\ProductController` (`admin/products/*`) | BE-016 s/d BE-020 | FE-022, FE-023 |
| **FR-018** | Admin | `products` | `Admin\ProductController@toggleAvailability` | BE-021 | FE-022 |
| **FR-019** | Admin | `product_images`, `products` | `Admin\ProductGalleryController` (`admin/gallery/*`) | BE-022 s/d BE-024 | FE-024 |
| **FR-020** | Admin | `personalization_options` | `Admin\PersonalizationController` (`admin/personalizations/*`) | BE-025, BE-027 | FE-025 |
| **FR-021** | Admin | `personalization_values` | `Admin\PersonalizationController` (`admin/personalizations/*`) | BE-026 | FE-025 |
| **FR-022** | Admin | `product_personalization_options` | `Admin\PersonalizationController@assign` | BE-027 | FE-025 |
| **FR-023** | Admin | `add_ons` | `Admin\AddOnController` (`admin/add-ons/*`) | BE-028, BE-029 | FE-026 |
| **FR-024** | Admin | `product_add_ons` | `Admin\AddOnController@assign` | BE-030 | FE-026 |
| **FR-025** | Admin | `business_settings` | `Admin\BusinessSettingController` (`admin/settings/*`) | BE-031 | FE-027 |

---

## 5. Analisis Kasus Batas (*Edge Cases*) & Penanganan Kesalahan

1. **Produk Ditandai Habis Saat Dilihat Pelanggan (FR-002, FR-004):** Sistem menampilkan badge merah "Habis / Slot Penuh". Tombol "Pesan via WhatsApp" otomatis dinonaktifkan (*disabled*) dan berganti menjadi tombol alternatif "Tanyakan Ketersediaan Bahan via WhatsApp".
2. **Perangkat Pelanggan Tidak Memiliki Aplikasi WhatsApp (FR-009):** Tautan menggunakan format standar `https://wa.me/...` yang otomatis membuka WhatsApp Web di peramban komputer atau meminta konfirmasi instalasi di ponsel. Disediakan tombol cadangan untuk menyalin draf teks pesan (*copy to clipboard*).
3. **Admin Menghapus Kategori yang Memiliki Produk Aktif (FR-016):** Database InnoDB menerapkan relasi *Foreign Key Restrict*. Controller menangkap exception dan menampilkan pesan peringatan: *"Kategori tidak dapat dihapus karena masih menaungi produk buket aktif."*
4. **Unggahan Foto Melebihi Batas Ukuran / Format Terlarang (FR-017, FR-019):** Form Request memvalidasi berkas di server: format wajib JPG, PNG, atau WebP dengan ukuran maksimal **[Perlu Konfirmasi Owner]** (standar: 2-5 MB). Berkas ilegal (.php, .exe) otomatis ditolak sebelum masuk ke disk.

---

## 6. Kesimpulan & Rekomendasi

### 6.1 Status Task DOC-007
Task **DOC-007 (Meninjau functional requirements)** telah selesai diselaraskan ke baseline **v1.1**:
- 25 Kebutuhan Fungsional telah disesuaikan secara konsisten dengan konsep katalog interaktif dan pemesanan WhatsApp.
- Matriks Ketertelusuran (RTM) telah memetakan seluruh FR ke 10 tabel basis data MySQL, komponen Blade, dan task implementasi di `task.md`.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 6.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan berikutnya pada sub-fase 4.2:
- **`DOC-008 — Meninjau non-functional requirements.`**
