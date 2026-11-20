# LAPORAN VALIDASI SELURUH DIAGRAM SISTEM (SYSTEM DIAGRAM VALIDATION REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-010  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dokumen Acuan:** ANA-001 s/d ANA-009, `requirement.md` (v1.1), `architecture.md` (v1.1), `database-design.md` (v1.1), `prd.md` (v1.1)  

---

## 1. Ringkasan Eksekutif & Tujuan Validasi

Validasi Seluruh Diagram Sistem (Task ANA-010) merupakan tahapan kendali mutu (*quality gate audit*) penutup pada sub-fase **5.2 System Modeling**. Evaluasi ini dilakukan secara komprehensif oleh Lead System Analyst bersama tim pengembang untuk memverifikasi bahwa seluruh artefak diagram pemodelan sistem (Use Case Diagram, Use Case Descriptions, Activity Diagrams, dan Sequence Diagrams) memiliki:

1. **Kelengkapan Ruang Lingkup (*Completeness*):** Memetakan seluruh 17 Use Cases resmi (UC-01 s/d UC-17), 25 Kebutuhan Fungsional (FR-001 s/d FR-025), dan 20 Aturan Bisnis (BR-001 s/d BR-020).
2. **Konsistensi Batas Sistem (*System Boundary Consistency*):** Menegakkan batas pemisah yang tegas antara peranan sistem website (katalog interaktif, konfigurator personalisasi, live calculation, dan generator WhatsApp) dengan saluran komunikasi eksternal WhatsApp (pemesanan manual, konfirmasi harga final, pembayaran transfer bank/e-wallet, uang muka DP 50%, dan pengiriman lokal Samarinda).
3. **Pembersihan Logika Transaksi Web Lama:** Memverifikasi bahwa seluruh diagram terbebas dari artefak fiktif transaksi web lama: tidak ada checkout di web, tidak ada mesin status pesanan web (`ST-01 s/d ST-08`), tidak ada tabel pesanan/pembayaran di web, dan tidak ada approval harga/pembatalan di antarmuka web.
4. **Ketertelusuran Persyaratan (*Requirements Traceability*):** Setiap use case dan alur aktivitas dapat ditelusuri ke komponen arsitektur Three-Layer Laravel dan skema 10 entitas pada `database-design.md` v1.1.
5. **Validitas Sintaksis Visual (*Syntax Integrity*):** Seluruh diagram berbasis Mermaid telah divalidasi terbebas dari kesalahan parsing (*render-safe*).

---

## 2. Inventarisasi & Status Artefak Pemodelan Sistem (Sub-fase 5.2)

Daftar lengkap 9 artefak diagram yang telah disusun, direvisi, dan diverifikasi dalam sub-fase 5.2:

| Task ID | Nama Dokumen | Tipe Diagram | Fokus Alur Sistem (v1.1) | Status Audit |
|---|---|---|---|:---:|
| **ANA-001** | [ANA-001-use-case-diagram.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-001-use-case-diagram.md) | Use Case Diagram | Pemetaan 17 use cases terhadap Customer (Guest), Admin (Nabila), dan saluran eksternal WhatsApp. | **Valid & Konsisten** |
| **ANA-002** | [ANA-002-use-case-descriptions.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-002-use-case-descriptions.md) | Use Case Specification | Spesifikasi lengkap prakondisi, alur utama, alur alternatif, dan pascakondisi 17 use cases. | **Valid & Konsisten** |
| **ANA-003** | [ANA-003-activity-diagram-catalog-order.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-003-activity-diagram-catalog-order.md) | Swimlane Activity Diagram | Alur dinamis katalog, personalisasi swatch, live estimation, dan hand-off WhatsApp. | **Valid & Konsisten** |
| **ANA-004** | [ANA-004-activity-diagram-custom-order.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-004-activity-diagram-custom-order.md) | Swimlane Activity Diagram | Alur konsultasi desain buket custom via WhatsApp, kirim referensi foto di chat, & penawaran harga. | **Valid & Konsisten** |
| **ANA-005** | [ANA-005-activity-diagram-payment.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-005-activity-diagram-payment.md) | Swimlane Activity Diagram | Alur pembayaran transfer manual/e-wallet, DP 50%, penyerahan resi, dan verifikasi di WhatsApp. | **Valid & Konsisten** |
| **ANA-006** | [ANA-006-activity-diagram-cancellation.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-006-activity-diagram-cancellation.md) | Swimlane Activity Diagram | Alur pengajuan pembatalan manual di WhatsApp, evaluasi status fisik bunga segar, & refund. | **Valid & Konsisten** |
| **ANA-007** | [ANA-007-sequence-diagram-ordering.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-007-sequence-diagram-ordering.md) | Object Sequence Diagram | Interaksi Three-Layer untuk katalog, swatch personalisasi, live calc di frontend, & URL wa.me. | **Valid & Konsisten** |
| **ANA-008** | [ANA-008-sequence-diagram-payment.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-008-sequence-diagram-payment.md) | Object Sequence Diagram | Interaksi pertukaran pesan kesepakatan harga, transfer m-banking, dan verifikasi di WhatsApp. | **Valid & Konsisten** |
| **ANA-009** | [ANA-009-sequence-diagram-order-management.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/docs/03-analysis-and-design/ANA-009-sequence-diagram-order-management.md) | Object Sequence Diagram | Interaksi admin: login tunggal, manajemen master produk, upload galeri, toggle stok, & business settings. | **Valid & Konsisten** |

---

## 3. Matriks Konsistensi Antar-Diagram (*Cross-Diagram Consistency Matrix*)

### 3.1 Penyelarasan Batas Sistem (System Demarcation Alignment)
Audit konsistensi silang mengonfirmasi tidak ada lagi ketidaksesuaian mengenai apa yang dikerjakan oleh website dan apa yang dikerjakan melalui WhatsApp:

| Komponen Operasional | Peran Sistem Web BLOOMÉ | Peran WhatsApp (Di Luar Web) | Konsistensi Antar-Diagram |
|---|---|---|:---:|
| **Eksplorasi Katalog & Detail** | Menampilkan buket aktif, galeri foto multi-sudut, filter kategori | Tidak terlibat | **100% Sinkron** (ANA-001, 002, 003, 007) |
| **Personalisasi & Add-on** | Menyediakan pemilih visual (*color swatches*), centang add-on, input teks ucapan | Tidak terlibat | **100% Sinkron** (ANA-001, 002, 003, 007) |
| **Perhitungan Harga** | Menghitung estimasi subtotal live di antarmuka (*client-side*) | Menyepakati harga final, diskon, & biaya ongkir kurir | **100% Sinkron** (ANA-003, 005, 007, 008) |
| **Pemesanan Buket** | Menyusun draf pesan terformat otomatis & membuka tautan `wa.me` | Pelanggan menekan tombol kirim manual di WhatsApp | **100% Sinkron** (ANA-001, 002, 003, 007) |
| **Penyimpanan Transaksi** | **TIDAK menyimpan record transaksi pesanan di basis data** | Pencatatan pesanan dilakukan manual oleh pemilik toko | **100% Sinkron** (Seluruh Diagram) |
| **Pembayaran & Verifikasi** | Memberikan estimasi total harga di kartu ringkasan | Pengiriman rekening resmi, kirim bukti resi, cek mutasi bank | **100% Sinkron** (ANA-005, 008) |
| **Status Pembuatan Buket** | **TIDAK mengelola mesin status FSM (ST-01 s/d ST-08)** | Pemilik mengabari progres perangkaian & kurir via chat | **100% Sinkron** (Seluruh Diagram) |
| **Pembatalan & Refund** | **TIDAK menyediakan modul pembatalan di website** | Diajukan via chat, dievaluasi berdasarkan potongan bunga riil | **100% Sinkron** (ANA-006) |
| **Manajemen Admin** | Mengelola etalase produk, galeri, variasi, stok, & pengaturan toko | Menangani percakapan pelanggan dan eksekusi perangkaian | **100% Sinkron** (ANA-001, 002, 009) |

---

## 4. Audit Konsistensi Skema Basis Data (Database Design Alignment)

Evaluasi silang antara pemodelan sistem (Sequence & Use Case) terhadap `database-design.md` v1.1 menghasilkan konfirmasi berikut:

1. **Jumlah & Daftar Entitas Basis Data:**  
   Tepat mencakup **10 Entitas Terpadu**:
   - `admins` (Tabel otentikasi admin tunggal Nabila Febriyani)
   - `categories` (Master kategori buket)
   - `products` (Master produk buket aktif/nonaktif)
   - `product_images` (Galeri foto multi-sudut buket)
   - `personalization_options` (Kelompok opsi variasi)
   - `personalization_values` (Nilai variasi, hex color, dan harga penyesuaian)
   - `product_personalization_options` (Tabel pivot opsi ke produk)
   - `add_ons` (Master item pelengkap buket)
   - `product_add_ons` (Tabel pivot add-on ke produk)
   - `business_settings` (Konfigurasi nomor WhatsApp toko, alamat Samarinda, template pesan)
2. **Pemeriksaan Khusus Tabel Akun (`admins` vs `users`):**  
   - Dokumen perancangan database `database-design.md` secara eksplisit mendefinisikan tabel: `admins`.
   - Pada beberapa dokumen SRS awal dan konvensi bawaan Laravel, tabel akun autentikasi sering dinamai `users`.
   - **Keputusan:** Dalam implementasi Laravel, tabel ini dapat menggunakan nama `admins` (dengan model `App\Models\Admin` dan guard `admin`) atau tabel `users` (dengan guard default) dengan **hanya memuat 1 akun admin (Nabila Febriyani)**. **TIDAK ADA AKUN PELANGGAN.** Hal ini telah konsisten di seluruh diagram ANA-001 s/d ANA-009.
3. **Peniadaan Tabel Transaksi:**  
   Tidak ada satupun diagram yang memanggil atau mengasumsikan keberadaan tabel `orders`, `order_details`, `custom_requests`, `custom_references`, `payments`, atau `order_status_histories`.

---

## 5. Matriks Ketertelusuran Persyaratan (*Requirements Traceability Matrix - RTM*)

Tabel berikut membuktikan keterpenuhan seluruh 25 Kebutuhan Fungsional (FR-001 s/d FR-025) pada artefak pemodelan sistem:

| Kode SRS v1.1 | Kebutuhan Fungsional | Direfleksikan Pada Diagram | Bukti Validasi Desain |
|---|---|---|---|
| **FR-001** | Halaman Utama / Homepage | ANA-001, ANA-002, ANA-003 | Rute `/` merender hero banner, profil butik, & kategori. |
| **FR-002** | Penelusuran Katalog & Filter Kategori | ANA-001, ANA-002, ANA-003, ANA-007 | Rute `/katalog` dengan kueri kategori dan grid produk aktif. |
| **FR-003** | Halaman Detail & Galeri Multi-Foto | ANA-001, ANA-002, ANA-003, ANA-007 | Eager loading relasi `images`, slider foto tajam, dan harga. |
| **FR-004** | Badge Ketersediaan Stok | ANA-001, ANA-002, ANA-003, ANA-007 | Kondisi `is_available == 0` menonaktifkan tombol pemesanan. |
| **FR-005** | Konfigurator Personalisasi Interaktif | ANA-001, ANA-002, ANA-003, ANA-007 | Pemilih warna visual (*color swatches*) & radio variasi pita. |
| **FR-006** | Pemilih Add-on | ANA-001, ANA-002, ANA-003, ANA-007 | Checkbox add-on terikat relasi pivot `product_add_ons`. |
| **FR-007** | Input Catatan & Kartu Ucapan | ANA-001, ANA-002, ANA-003, ANA-007 | Textarea kartu ucapan dengan counter karakter real-time. |
| **FR-008** | Kalkulasi Live Estimasi Total Harga | ANA-001, ANA-002, ANA-003, ANA-007 | Live calculator frontend: base + personalisasi + add-on. |
| **FR-009** | Pemesanan Multi-Item dalam Satu Pesan WA | ANA-002, ANA-003 | Opsi draf buket gabungan `[Perlu Konfirmasi Owner]`. |
| **FR-010** | Generator Teks Pesanan WhatsApp Otomatis | ANA-001, ANA-002, ANA-003, ANA-007 | Pembangun draf teks terstruktur dan URL encoding. |
| **FR-011** | Direct WhatsApp Ordering Hand-off | ANA-001, ANA-002, ANA-003, ANA-007 | Pengalihan ke tautan `wa.me` tanpa simpan data di DB web. |
| **FR-012** | Tombol Konsultasi Buket Custom Langsung | ANA-001, ANA-002, ANA-004 | Tombol wa.me khusus konsultasi desain custom ke florist. |
| **FR-013** | Autentikasi Admin Tunggal Terproteksi | ANA-001, ANA-002, ANA-009 | Login Bcrypt pada tabel `admins`, sesi aman, & CSRF. |
| **FR-014** | Dashboard Ringkasan Etalase Digital | ANA-001, ANA-002, ANA-009 | Kartu metrik total produk, kategori, opsi, dan no WA toko. |
| **FR-015** | Manajemen Kategori (CRUD) | ANA-001, ANA-002, ANA-009 | CRUD kategori dengan proteksi hapus jika berelasi produk. |
| **FR-016** | Manajemen Master Produk Buket (CRUD) | ANA-001, ANA-002, ANA-009 | Form produk dengan nama, slug, deskripsi, & harga dasar. |
| **FR-017** | Toggle Ketersediaan Stok Produk | ANA-001, ANA-002, ANA-009 | Endpoint PATCH toggle `is_available` secara instan. |
| **FR-018** | Manajemen Galeri Multi-Foto Produk | ANA-001, ANA-002, ANA-009 | Multi-upload JPG/PNG ≤ 2MB, penanda `is_primary`. |
| **FR-019** | Manajemen Tipe Opsi Personalisasi | ANA-001, ANA-002, ANA-009 | Tabel `personalization_options` (wrapping, pita). |
| **FR-020** | Manajemen Nilai Variasi & Harga Penyesuaian| ANA-001, ANA-002, ANA-009 | Tabel `personalization_values` (swatch hex & harga). |
| **FR-021** | Relasi Produk-Personalisasi | ANA-001, ANA-002, ANA-009 | Tabel pivot `product_personalization_options`. |
| **FR-022** | Manajemen Master Item Add-on (CRUD) | ANA-001, ANA-002, ANA-009 | Tabel `add_ons` (nama, harga, thumbnail foto). |
| **FR-023** | Relasi Produk-Add-on | ANA-001, ANA-002, ANA-009 | Tabel pivot `product_add_ons`. |
| **FR-024** | Konfigurasi Nomor WhatsApp Resmi Toko | ANA-001, ANA-002, ANA-009 | Update key `whatsapp_number` pada `business_settings`. |
| **FR-025** | Pengaturan Profil Toko & Template Salam | ANA-001, ANA-002, ANA-009 | Update jam operasional, alamat, & template salam di DB. |

---

## 6. Pernyataan Validasi & Keputusan Akhir

Berdasarkan audit evaluasi menyeluruh terhadap seluruh model analisis dan desain sistem:

> **PERNYATAAN RESMI KELULUSAN:**  
> Seluruh artefak diagram pemodelan sistem (**ANA-001 hingga ANA-009**) dinyatakan **VALID, LENGKAP, KONSISTEN, DAN SELARAS 100% DENGAN KONSEP SISTEM KATALOG & PERSONALISASI BERBASIS WHATSAPP HAND-OFF (v1.1)**. Seluruh model bebas dari konflik semantik, tidak memuat logika transaksi web usang, dan siap dijadikan acuan langsung perancangan arsitektur teknis lanjutan serta pengkodean Laravel.

Dengan demikian:
- **Sub-fase 5.2 System Modeling dinyatakan RESMI SELESAI 100% (`[x]`).**
- **Quality Gate 2 (System Modeling & Architecture Review) Memenuhi Syarat Kelulusan.**

---

## 7. Kesimpulan & Rekomendasi

### 7.1 Status Task ANA-010
Task **ANA-010 (Laporan Validasi Seluruh Diagram Sistem)** telah selesai dilaksanakan:
- Matriks konsistensi silang, audit batas sistem, penegasan 10 tabel basis data, dan matriks ketertelusuran persyaratan (RTM) lengkap telah didokumentasikan.
- Kriteria penyelesaian terpenuhi 100%.

### 7.2 Rekomendasi Langkah Berikutnya:
Beralih ke sub-fase berikutnya sesuai instruksi pengembang:
- **Phase 2 Sub-fase 5.3 System Architecture (Folder `docs/04-technical-and-architecture/` diawali dengan task `ARC-001`).**
