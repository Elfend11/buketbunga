# LAPORAN PENINJAUAN FUNCTIONAL REQUIREMENTS & MATRIKS KETERTELUSURAN (RTM)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-007  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-006 — Menyusun `requirement.md` (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Kebutuhan Fungsional (Task DOC-007) dilakukan untuk memvalidasi kelayakan, kelengkapan, ketegasan batasan, serta ketertelusuran (*traceability*) dari seluruh kebutuhan fungsional sistem informasi **BLOOMÉ — Flowers & Stories**.

Hasil peninjauan mengonfirmasi terdapat **17 Kebutuhan Fungsional Utama (FR-001 s/d FR-017)** yang terbagi ke dalam dua domain:
- **8 Kebutuhan Fungsional Publik / Pelanggan (FR-001 s/d FR-008)**
- **9 Kebutuhan Fungsional Administrator (FR-009 s/d FR-017)**

Seluruh kebutuhan fungsional telah terbebas dari ambiguitas, mendukung alur operasional bisnis florist, dan telah dipetakan secara terstruktur ke dalam modul teknis, entitas basis data, serta nomor task implementasi di `task.md`.

---

## 2. Rincian Kebutuhan Fungsional Publik (Customer Interface)

| ID Kebutuhan | Nama Kebutuhan | Deskripsi Fungsional & Kriteria Validasi | Status Kelayakan |
|---|---|---|:---:|
| **FR-001** | Halaman Beranda (Homepage) | Menampilkan identitas visual BLOOMÉ, hero section, perkenalan usaha, katalog buket unggulan, banner promosi custom buket, kontak, dan footer. Mendukung aksesibilitas responsif di semua perangkat. | Layak & Jelas |
| **FR-002** | Katalog Produk | Menampilkan daftar buket aktif dalam format kartu (foto, nama, harga, kategori, ketersediaan). Dilengkapi fitur filtering berbasis kategori tanpa reload lambat. | Layak & Jelas |
| **FR-003** | Detail Produk | Halaman rincian spesifik satu buket: galeri foto resolusi tinggi, deskripsi bahan/rangkaian, harga tetap, kategori, badge ketersediaan (*Tersedia*/*Habis*), dan CTA tombol pesan langsung. | Layak & Jelas |
| **FR-004** | Navigasi Kategori | Menampilkan seluruh kategori buket aktif (Buket Bunga, Buket Uang, Buket Snack, dll.) dan memfilter produk sesuai kategori yang dipilih. | Layak & Jelas |
| **FR-005** | Pemesanan Produk Katalog | Formulir pemesanan buket katalog: input data pemesan (nama, WhatsApp/telepon, alamat pengiriman/penerima), kartu ucapan (*greeting card*), catatan tanggal kebutuhan, dan kalkulasi ringkasan subtotal. Transaksi tersimpan secara konsisten menggunakan *DB Transaction*. | Layak & Jelas |
| **FR-006** | Pengajuan Buket Custom | Formulir kustomisasi buket personal: input jenis/bahan bunga, kombinasi warna, tema buket, catatan kebutuhan, dan formulir unggah gambar referensi (format JPG/JPEG/PNG, maks 5 MB per berkas). Menghasilkan tiket permintaan kustom (*custom request*). | Layak & Jelas |
| **FR-007** | Peninjauan & Keputusan Harga Custom | Halaman konfirmasi harga bagi pemesan untuk melihat nominal yang diajukan oleh admin. Menyediakan aksi tegas: menyetujui harga (*Approve*) untuk lanjut ke pembayaran, atau menolak (*Reject*) untuk membatalkan pengajuan. | Layak & Jelas |
| **FR-008** | Informasi Pembayaran & Konfirmasi | Menampilkan instruksi pembayaran manual (nomor rekening bank dan e-wallet resmi), ringkasan tagihan pesanan, serta halaman konfirmasi pengajuan yang memberikan feedback jelas bahwa pesanan telah diterima sistem. | Layak & Jelas |

---

## 3. Rincian Kebutuhan Fungsional Administrator (Admin Dashboard)

| ID Kebutuhan | Nama Kebutuhan | Deskripsi Fungsional & Kriteria Validasi | Status Kelayakan |
|---|---|---|:---:|
| **FR-009** | Autentikasi Admin | Login satu pintu admin menggunakan email dan password terenkripsi (Bcrypt/Argon2), proteksi CSRF token, pengalihan otomatis (*middleware*) bila diakses tanpa autentikasi, dan fitur logout aman. | Layak & Jelas |
| **FR-010** | Dashboard Utama Admin | Menampilkan kartu metrik ringkasan: Total Pesanan Masuk, Pesanan Menunggu Pembayaran, Pesanan Sedang Diproses, Permintaan Custom Baru, dan tabel 5-10 aktivitas transaksi terbaru. | Layak & Jelas |
| **FR-011** | Manajemen Kategori | Operasi CRUD (Create, Read, Update, Delete) kategori produk buket, validasi keunikan nama kategori, dan pencegahan penghapusan kategori yang masih digunakan oleh produk aktif. | Layak & Jelas |
| **FR-012** | Manajemen Produk Katalog | Operasi CRUD produk buket: unggah foto produk ke local disk storage yang terproteksi, pengaturan nama, deskripsi, harga (format IDR), relasi kategori, dan toggle status ketersediaan (*In Stock* / *Out of Stock*). | Layak & Jelas |
| **FR-013** | Pengelolaan Pesanan | Menampilkan antrean seluruh pesanan masuk dengan fitur filter status (8 status), pencarian kode pesanan, rincian data pelanggan, daftar item, kartu ucapan, dan tanggal pengiriman. | Layak & Jelas |
| **FR-014** | Manajemen Permintaan Custom | Meninjau rincian spesifikasi custom dari pelanggan, pratinjau berkas foto referensi yang diunggah, formulir input penentuan harga usulan oleh admin, serta pelacakan status respon pelanggan. | Layak & Jelas |
| **FR-015** | Verifikasi Pembayaran Manual | Daftar catatan pembayaran pesanan, peninjauan metode transfer (bank / e-wallet), tombol konfirmasi verifikasi manual untuk mengubah status pembayaran menjadi lunas (*Paid*). | Layak & Jelas |
| **FR-016** | Pengelolaan Siklus Status Pesanan | Pembaruan status pesanan mematuhi aturan transisi 8 status: *Pending* → *Awaiting Payment* → *Paid* → *In Process* → *Ready* → *Delivered* → *Completed* (atau *Cancelled*). Setiap perubahan status otomatis tercatat di tabel riwayat histori (*order_status_histories*). | Layak & Jelas |
| **FR-017** | Manajemen Pengajuan Pembatalan | Menerima permohonan pembatalan dari pelanggan beserta alasannya, menyediakan aksi persetujuan (*Approve*) atau penolakan (*Reject*) dengan validasi status pesanan saat ini. | Layak & Jelas |

---

## 4. Requirements Traceability Matrix (RTM)

Matriks ketertelusuran memastikan bahwa setiap kebutuhan fungsional memiliki pemetaan konkret ke entitas basis data, layer implementasi MVC Laravel, dan task checklist di `task.md`:

| Req ID | Aktor | Entitas Database Terkait | Controller & View Terkait | Task Implementasi Backend | Task Implementasi Frontend |
|---|---|---|---|---|---|
| **FR-001** | Customer | `products`, `categories` | `HomeController` (`home.blade.php`) | BE-026, BE-039 | FE-019 |
| **FR-002** | Customer | `products`, `categories` | `CatalogController` (`catalog.blade.php`) | BE-026, BE-040 | FE-020 |
| **FR-003** | Customer | `products`, `categories` | `CatalogController` (`product-detail.blade.php`) | BE-026, BE-040 | FE-021 |
| **FR-004** | Customer | `categories` | `CatalogController` (`catalog.blade.php`) | BE-019, BE-026 | FE-011, FE-020 |
| **FR-005** | Customer | `customers`, `orders`, `order_details` | `OrderController` (`order-form.blade.php`) | BE-035, BE-041 s/d BE-046 | FE-022, FE-025 |
| **FR-006** | Customer | `customers`, `custom_requests`, `custom_references` | `CustomBouquetController` (`custom-form.blade.php`) | BE-047 s/d BE-054 | FE-023, FE-024 |
| **FR-007** | Customer | `custom_requests`, `orders` | `CustomBouquetController` (`custom-review.blade.php`) | BE-058, BE-059 | FE-025, FE-027 |
| **FR-008** | Customer | `orders`, `payments` | `PaymentController` (`payment-info.blade.php`) | BE-068, BE-069 | FE-026, FE-027 |
| **FR-009** | Admin | `admins` | `AdminAuthController` (`admin.login.blade.php`) | BE-014 s/d BE-018 | FE-030 |
| **FR-010** | Admin | `orders`, `custom_requests`, `payments` | `AdminDashboardController` (`admin.dashboard.blade.php`) | BE-061, BE-055, BE-070 | FE-034 |
| **FR-011** | Admin | `categories` | `AdminCategoryController` (`admin.categories.*`) | BE-019 s/d BE-025 | FE-037 |
| **FR-012** | Admin | `products`, `categories` | `AdminProductController` (`admin.products.*`) | BE-026 s/d BE-034 | FE-035, FE-036 |
| **FR-013** | Admin | `orders`, `order_details`, `customers` | `AdminOrderController` (`admin.orders.*`) | BE-061 s/d BE-063 | FE-038, FE-039 |
| **FR-014** | Admin | `custom_requests`, `custom_references` | `AdminCustomRequestController` (`admin.custom.*`) | BE-055 s/d BE-060 | FE-040, FE-041, FE-042 |
| **FR-015** | Admin | `payments`, `orders` | `AdminPaymentController` (`admin.payments.*`) | BE-070 s/d BE-074 | FE-043, FE-044 |
| **FR-016** | Admin | `orders`, `order_status_histories` | `AdminOrderStatusController` (`admin.orders.status`) | BE-064 s/d BE-067 | FE-045 |
| **FR-017** | Admin | `orders`, `order_status_histories` | `AdminCancellationController` (`admin.cancellations.*`) | BE-075 s/d BE-080 | FE-046 |

---

## 5. Analisis Kasus Batas (*Edge Cases*) & Penanganan Kesalahan

1. **Stok Habis Saat Transaksi Dijalankan (FR-005):** Sistem wajib memvalidasi kembali ketersediaan produk saat tombol submit ditekan. Jika status telah diubah admin menjadi *Habis*, transaksi dibatalkan dengan pesan ramah pengguna.
2. **Unggahan File Referensi Rusak / Malicious (FR-006):** Validasi *MIME-type* secara ketat (`image/jpeg`, `image/png`) di sisi server, nama berkas di-hash secara acak (*sanitized unique string*), dan disimpan di luar *root execution directory*.
3. **Penyetujuan Harga Custom Ganda (FR-007):** Jika pelanggan mengklik aksi persetujuan lebih dari satu kali, request idempotency dijaga dengan memeriksa status tiket custom saat ini.
4. **Pembatalan Pesanan yang Telah Dikirim (FR-017):** Sistem secara otomatis menolak permohonan pembatalan untuk pesanan yang telah mencapai status *Delivered* atau *Completed*.

---

## 6. Kesimpulan & Rekomendasi

### 6.1 Status Task DOC-007
Task **DOC-007 (Meninjau functional requirements)** telah selesai dilaksanakan:
- 17 Kebutuhan Fungsional telah ditinjau dan dinyatakan valid serta siap diimplementasikan.
- Matriks Ketertelusuran (RTM) telah memetakan seluruh FR ke database, backend, frontend, dan task checklist.
- Penanganan skenario batas (*edge cases*) telah terdefinisi.
- Kriteria penyelesaian terpenuhi.

### 6.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan berikutnya pada sub-fase 4.2:
- **`DOC-008 — Meninjau non-functional requirements.`**

