# LAPORAN VALIDASI SELURUH DIAGRAM SISTEM (SYSTEM DIAGRAM VALIDATION REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-010  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Acuan:** ANA-001 s/d ANA-009, `requirement.md`, `architecture.md`, `database-design.md`, `prd.md`  

---

## 1. Ringkasan Eksekutif & Tujuan Validasi

Validasi Seluruh Diagram Sistem (Task ANA-010) merupakan tahapan gerbang kendali mutu (*quality gate audit*) penutup pada sub-fase **5.2 System Modeling**. Evaluasi ini dilakukan secara komprehensif oleh Lead System Analyst bersama tim pengembang untuk memverifikasi bahwa seluruh artefak diagram pemodelan sistem (Use Case, Activity Diagram, dan Sequence Diagram) memiliki:
1. **Kelengkapan Ruang Lingkup (*Completeness*):** Memetakan seluruh 20 Use Cases, 17 Kebutuhan Fungsional (FR-001 s/d FR-017), dan 20 Aturan Bisnis (BR-001 s/d BR-020).
2. **Konsistensi Semantik & Alur (*Internal & Cross-Diagram Consistency*):** Tidak ada kontradiksi status pesanan (ST-01 s/d ST-08), entitas data, peranan aktor, maupun batasan teknologi antar-diagram.
3. **Ketertelusuran Persyaratan (*Requirements Traceability*):** Setiap keputusan bisnis dan kebutuhan pengguna dapat ditelusuri ke komponen interaksi objek di sisi arsitektur dan kode program Laravel.
4. **Validitas Sintaksis Visual (*Syntax Integrity*):** Seluruh visualisasi diagram berbasis standar resmi Mermaid terbebas dari kesalahan parsing (*render-safe*).

---

## 2. Inventarisasi & Status Artefak Pemodelan Sistem (Sub-fase 5.2)

Berikut adalah daftar lengkap 9 artefak diagram yang telah disusun dan diverifikasi dalam sub-fase 5.2:

| Task ID | Nama Dokumen | Tipe Diagram | Fokus Alur Sistem | Status Audit |
|---|---|---|---|:---:|
| **ANA-001** | `ANA-001-use-case-diagram.md` | Use Case Diagram | Pemetaan 20 use cases terhadap aktor Customer (Guest) dan Admin (Florist). | **Valid & Konsisten** |
| **ANA-002** | `ANA-002-use-case-descriptions.md` | Use Case Specification | Rincian prakondisi, alur utama, alur alternatif, dan pascakondisi 20 use cases. | **Valid & Konsisten** |
| **ANA-003** | `ANA-003-activity-diagram-catalog-order.md` | Swimlane Activity Diagram | Alur dinamis checkout produk jadi katalog dengan harga tetap & form validation. | **Valid & Konsisten** |
| **ANA-004** | `ANA-004-activity-diagram-custom-order.md` | Swimlane Activity Diagram | Alur negosiasi buket custom, upload foto referensi, dan keputusan harga pemesan. | **Valid & Konsisten** |
| **ANA-005** | `ANA-005-activity-diagram-payment.md` | Swimlane Activity Diagram | Alur pembayaran manual transfer/e-wallet & verifikasi mutasi oleh admin. | **Valid & Konsisten** |
| **ANA-006** | `ANA-006-activity-diagram-cancellation.md` | Swimlane Activity Diagram | Alur pengajuan pembatalan pemesan & evaluasi persetujuan/penolakan admin. | **Valid & Konsisten** |
| **ANA-007** | `ANA-007-sequence-diagram-ordering.md` | Object Sequence Diagram | Interaksi temporal Three-Layer untuk pemesanan katalog & buket custom. | **Valid & Konsisten** |
| **ANA-008** | `ANA-008-sequence-diagram-payment.md` | Object Sequence Diagram | Interaksi pesan konfirmasi bayar dan eksekusi transaksi verifikasi mutasi bank. | **Valid & Konsisten** |
| **ANA-009** | `ANA-009-sequence-diagram-order-management.md` | Object Sequence Diagram | Interaksi pengelolaan siklus status (ST-05 $\rightarrow$ ST-06 $\rightarrow$ ST-07) dan pembatalan (ST-08). | **Valid & Konsisten** |

---

## 3. Matriks Konsistensi Antar-Diagram (*Cross-Diagram Consistency Matrix*)

Audit konsistensi silang dilakukan untuk memeriksa apakah terminologi, status, objek, dan transisi identik di seluruh diagram:

### 3.1 Penyelarasan Siklus Status Pesanan (FSM Lifecycle Alignment)
Konsistensi kode dan nama status pesanan diuji silang antara Dokumen SRS (`requirement.md`), Arsitektur (`architecture.md`), Activity Diagrams (ANA-003 s/d ANA-006), dan Sequence Diagrams (ANA-007 s/d ANA-009):

| Kode Status | Label Resmi Status | Muncul di Activity Diagram | Muncul di Sequence Diagram | Keselarasan State Machine |
|---|---|---|---|:---:|
| **ST-01** | Menunggu Peninjauan Admin | ANA-003, ANA-004 | ANA-007 (Pesan 12 & 38) | **100% Sinkron** |
| **ST-02** | Menunggu Persetujuan Harga | ANA-004 | ANA-007 (Pesan 48) | **100% Sinkron** |
| **ST-03** | Menunggu Pembayaran | ANA-003, ANA-004, ANA-005 | ANA-007 (Pesan 53), ANA-008 (Pesan 1) | **100% Sinkron** |
| **ST-04** | Menunggu Konfirmasi Pembayaran | ANA-005 | ANA-008 (Pesan 14) | **100% Sinkron** |
| **ST-05** | Pembayaran Dikonfirmasi | ANA-005, ANA-006 | ANA-008 (Pesan 26), ANA-009 (Pesan 1) | **100% Sinkron** |
| **ST-06** | Pesanan Diproses (Bunga Dirangkai)| ANA-005, ANA-006 | ANA-009 (Pesan 10) | **100% Sinkron** |
| **ST-07** | Pesanan Dikirim / Siap Diambil | ANA-006 | ANA-009 (Pesan 23) | **100% Sinkron** |
| **ST-08** | Dibatalkan (*Cancelled*) | ANA-004, ANA-006 | ANA-007 (Pesan 58), ANA-009 (Pesan 40) | **100% Sinkron** |

### 3.2 Penyelarasan Komponen & Lapisan Arsitektur
Interaksi objek pada Sequence Diagram telah divalidasi terhadap rancangan komponen Laravel:
- **Presentation Layer:** Seluruh view yang dipanggil (`catalog.order-form`, `custom-order`, `payment-info`, `admin.orders`, `admin.cancellations`) selaras dengan struktur view Blade pada `architecture.md`.
- **Application Layer:**
  - Form Requests (`CatalogOrderRequest`, `CustomOrderRequest`, `PaymentConfirmRequest`, `PaymentVerifyRequest`, `OrderStatusUpdateRequest`, `CancellationDecisionRequest`) divalidasi selalu bertindak sebagai gerbang pertama sebelum controller.
  - Domain Services (`OrderCodeGenerator`, `OrderStatusService`) secara konsisten memegang tanggung jawab penerbitan kode unik dan mutasi status.
  - Penanganan berkas unggahan foto referensi mematuhi penyimpanan sanitasi UUID melalui `Storage::disk('public')`.
- **Data Layer:** Seluruh pemanggilan model Eloquent (`Customer`, `Order`, `OrderDetail`, `CustomRequest`, `CustomReference`, `Payment`, `OrderStatusHistory`) telah terbukti identik dengan skema DDL di `database-design.md`.

---

## 4. Matriks Ketertelusuran Persyaratan (*Requirements Traceability Matrix - RTM*)

Tabel berikut membuktikan bahwa seluruh Aturan Bisnis (*Business Rules*) dan Kebutuhan Fungsional inti telah diwadahi secara visual dalam pemodelan sistem:

| Kode Kebutuhan / Aturan Bisnis | Deskripsi Kebutuhan | Direfleksikan Pada Diagram | Bukti Validasi Desain |
|---|---|---|---|
| **BR-001 (Guest Checkout)** | Pelanggan memesan tanpa registrasi akun | ANA-001, ANA-002, ANA-003, ANA-007 | Tidak ada lifelines `Auth` atau session login pada alur customer. |
| **BR-003 (Identitas Pemesan)** | Nama, no WA, dan alamat wajib lengkap | ANA-003, ANA-007 | Validasi form request dan pemanggilan `Customer::firstOrCreate`. |
| **BR-004 (Tanggal Kebutuhan)** | Jadwal pengiriman wajib diisi & masa depan | ANA-003, ANA-004, ANA-007 | Aturan validasi `delivery_date >= today` di Form Request. |
| **BR-005 (Harga Katalog Tetap)** | Harga katalog mengikat dan tidak ditawar | ANA-003, ANA-007 | Total tagihan dihitung dari harga jual tetap produk aktif. |
| **BR-008 (Foto Referensi ≤ 5MB)** | Format JPG/PNG maksimal 5MB | ANA-004, ANA-007 | Validasi mime:jpeg,png dan max:5120 pada `CustomOrderRequest`. |
| **BR-009 (Usulan Harga Admin)** | Admin menetapkan harga buket custom | ANA-004, ANA-007 | Alur negosiasi harga (Fase B) di `Admin\CustomBouquetController`. |
| **BR-010 (Persetujuan Harga)** | Pelanggan berhak setuju atau tolak | ANA-004, ANA-007 | Percabangan keputusan `approve` (ke ST-03) atau `reject` (ke ST-08). |
| **BR-011 (Pembayaran Manual)** | Transfer manual BCA, BRI, Mandiri, E-Wallet| ANA-005, ANA-008 | Instruksi rekening dan input metode transfer di `PaymentController`. |
| **BR-012 (Verifikasi Admin)** | Florist mencocokkan mutasi rekening | ANA-005, ANA-008 | Percabangan `verified` vs `rejected` di `Admin\PaymentController`. |
| **BR-013 (Batas Pembatalan)** | Batal hanya sebelum pesanan diproses | ANA-006, ANA-009 | *Guard condition* memeriksa status < ST-06 sebelum membuka form pembatalan. |
| **BR-014 (Persetujuan Admin Batal)**| Pembatalan tidak dapat sepihak | ANA-006, ANA-009 | Perubahan ke ST-08 memerlukan input keputusan dari admin. |
| **BR-018 (Audit Trail Riwayat)** | Setiap transisi dicatat permanen | ANA-003 s/d ANA-009 | Pemanggilan konsisten ke `OrderStatusHistory::create`. |
| **BR-020 (Snapshot Produk)** | Nama & harga dicatat permanen di detail | ANA-003, ANA-007 | Kolom `product_name_snapshot` dan `unit_price_snapshot` di `order_details`. |

---

## 5. Analisis Integritas Transaksional & Mitigasi Risiko

Hasil penelaahan terhadap skenario eksepsi dan kegagalan (*Exception Handling*) pada seluruh sequence diagram:
1. **Integritas ACID Transaksi Database:**
   - Semua operasi multi-tabel (`orders`, `order_details`, `custom_requests`, `payments`, `order_status_histories`) diwajibkan terbungkus di dalam blok `DB::beginTransaction()` dan `DB::commit()`.
   - Jika terjadi kegagalan jaringan atau query database terputus, `DB::rollBack()` otomatis dipicu sehingga mencegah adanya data kotor (*dirty/orphaned rows*).
2. **Pencegahan Kondisi Balapan (*Race Conditions*) pada Transisi Status:**
   - Metode `canTransition()` pada `OrderStatusService` memvalidasi status pesanan saat ini secara ketat dari basis data sebelum mengizinkan pembaruan, mencegah admin secara tidak sengaja melompati status atau memproses pesanan yang telah dibatalkan secara bersamaan.
3. **Penyimpanan Berkas Terisolasi (*File Upload Security*):**
   - Berkas referensi buket custom disimpan dengan nama hash acak (UUID) di folder `storage/app/public/custom_references/`, mencegah eksekusi skrip berbahaya (*remote code execution*) atau penimpaan file (*file overwrite*).

---

## 6. Pernyataan Validasi & Keputusan Akhir

Berdasarkan audit teknis mendalam yang dilakukan terhadap seluruh model sistem:

> **PERNYATAAN RESMI:**  
> Seluruh diagram pemodelan sistem (**ANA-001 hingga ANA-009**) dinyatakan **VALID, LENGKAP, KONSISTEN, DAN SIAP DIJADIKAN ACUAN IMPLEMENTASI ARSITEKTUR SERTA PENGKODEAN LARAVEL**. Tidak ditemukan anomali perancangan, celah aturan bisnis yang terlewat, maupun konflik semantik antar-diagram.

Dengan demikian:
- **Sub-fase 5.2 System Modeling dinyatakan RESMI DITUTUP (100% Selesai).**
- Tahapan proyek dapat segera dinaikkan ke **Sub-fase 5.3 System Architecture**.

---

## 7. Kesimpulan & Rekomendasi Langkah Berikutnya

### 7.1 Status Penyelesaian Task ANA-010
Task **ANA-010 (Validasi seluruh diagram)** telah selesai dilaksanakan:
- Laporan validasi menyeluruh telah disusun dengan matriks konsistensi silang, verifikasi mesin status FSM, dan matriks ketertelusuran persyaratan (RTM).
- Seluruh 10 task pada Sub-fase 5.2 telah rampung 100% (`[x]`).

### 7.2 Rekomendasi Langkah Berikutnya:
Memulai pengerjaan pada **Sub-fase 5.3 System Architecture**:
- **`ARC-001 — Menentukan Three-Layer Architecture.`**

