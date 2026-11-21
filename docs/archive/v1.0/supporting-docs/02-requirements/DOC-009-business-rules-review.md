# LAPORAN PENINJAUAN ATURAN BISNIS (BUSINESS RULES & WORKFLOW LOGIC REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-009  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-008 — Meninjau non-functional requirements (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Aturan Bisnis (Task DOC-009) dilakukan untuk mengunci seluruh logika operasional, batasan hukum transaksi, kebijakan florist, serta matriks transisi status pesanan pada sistem informasi **BLOOMÉ — Flowers & Stories**.

Hasil peninjauan mengonfirmasi validitas **20 Aturan Bisnis Wajib (BR-001 s/d BR-020)** dan **8 Siklus Status Pesanan (ST-01 s/d ST-08)**. Dokumen ini menjadi pedoman mutlak (*mandatory guardrails*) bagi pengembang backend (Elsa Futri) dan frontend (Riya Monika) agar tidak terjadi celah logika (*business logic flaws*) dalam proses checkout, penetapan harga custom, konfirmasi transfer manual, maupun pembatalan pesanan.

---

## 2. Rincian & Evaluasi 20 Aturan Bisnis Wajib (Business Rules)

Seluruh aturan bisnis dikelompokkan ke dalam 5 domain operasional:

### 2.1 Domain Pengguna & Akun (User & Authentication)
| Kode | Pernyataan Aturan Bisnis | Implikasi Teknis & Validasi Backend |
|---|---|---|
| **BR-001** | Pelanggan tidak diwajibkan registrasi atau login akun (*guest checkout*). | Tidak ada tabel/model `users` untuk pelanggan. Formulir pemesanan menampung identitas pemesan langsung ke entitas `customers`. |
| **BR-002** | Hanya satu akun administrator yang digunakan pada tahap rilis awal. | Tabel `admins` di-seed dengan 1 akun kredensial pemilik usaha. Tidak ada modul manajemen multi-admin atau permission bertingkat. |
| **BR-019** | Pengguna publik/pelanggan dilarang keras mengakses fungsi administratif. | Rute `/admin/*` diisolasi ketat menggunakan middleware `auth:admin`. Upaya akses ilegal menghasilkan pengalihan (*redirect*) ke login. |

### 2.2 Domain Katalog & Produk (Catalog & Product Management)
| Kode | Pernyataan Aturan Bisnis | Implikasi Teknis & Validasi Backend |
|---|---|---|
| **BR-004** | Produk diorganisasikan ke dalam kategori yang dikelola oleh admin. | Tabel `products` berelasi *foreign key* `category_id` ke tabel `categories`. |
| **BR-005** | Harga produk katalog dikelola dan ditentukan secara tetap oleh admin. | Nilai numerik integer (IDR). Perubahan harga katalog tidak boleh mengubah harga pesanan lama yang sudah terbit. |
| **BR-020** | Data historis pesanan wajib terlindungi jika data produk diubah atau dihapus. | Tabel `order_details` menyimpan *historical snapshot* (kolom `product_name` dan `price` saat transaksi dibuat), bukan sekadar foreign key. |

### 2.3 Domain Personalisasi Buket Custom (Custom Bouquet Ordering)
| Kode | Pernyataan Aturan Bisnis | Implikasi Teknis & Validasi Backend |
|---|---|---|
| **BR-006** | Harga buket custom ditentukan secara manual oleh admin, tanpa kalkulator otomatis. | Controller tidak menjalankan algoritma harga. Kolom `proposed_price` diisi secara manual oleh pemilik usaha melalui dashboard. |
| **BR-007** | Pesanan custom wajib mendapat persetujuan pelanggan atas harga usulan sebelum lanjut ke pembayaran. | Status pesanan tidak dapat bergeser ke *Menunggu Pembayaran* sebelum aksi *Approve Price* dieksekusi oleh pelanggan. |
| **BR-008** | Usulan harga custom yang ditolak dapat direvisi melalui komunikasi admin atau dibatalkan. | Jika ditolak (*Reject*), status tiket custom mencatat penolakan dan admin dapat mengajukan revisi harga atau membatalkan pesanan. |
| **BR-009** | Perubahan spesifikasi custom setelah diajukan wajib dilakukan melalui kontak admin. | Pelanggan tidak memiliki akses langsung untuk mengedit rincian tiket custom yang sudah terkirim ke basis data. |
| **BR-017** | Gambar referensi kustom wajib berformat JPG, JPEG, atau PNG. | Validasi form request: `'reference_images.*' => 'image|mimes:jpg,jpeg,png'`. |
| **BR-018** | Ukuran setiap berkas gambar referensi tidak boleh melebihi 5 MB. | Validasi form request: `'reference_images.*' => 'max:5120'`. |

### 2.4 Domain Pembayaran Manual (Manual Payment Processing)
| Kode | Pernyataan Aturan Bisnis | Implikasi Teknis & Validasi Backend |
|---|---|---|
| **BR-010** | Metode pembayaran yang didukung adalah transfer bank dan e-wallet. | Menampilkan rekening bank resmi dan dompet digital pemilik usaha. Tidak menggunakan API payment gateway pihak ketiga. |
| **BR-011** | Konfirmasi pembayaran dilakukan secara verifikasi manual oleh admin. | Admin memeriksa mutasi rekening fisik/aplikasi, lalu menekan tombol konfirmasi di dashboard untuk mengubah status menjadi *Paid*. |
| **BR-012** | Syarat dan ketentuan pembayaran ditentukan oleh admin. | Admin dapat menentukan pembayaran lunas penuh (*full payment*) atau kebijakan DP sesuai jenis pesanan. |

### 2.5 Domain Pembatalan & Siklus Status (Order Lifecycle & Cancellation)
| Kode | Pernyataan Aturan Bisnis | Implikasi Teknis & Validasi Backend |
|---|---|---|
| **BR-003** | Setiap pesanan wajib memiliki data identitas pemesan dan kontak yang valid. | Validasi ketat nama lengkap pemesan, nomor telepon/WhatsApp aktif, dan alamat pengiriman/penerima. |
| **BR-013** | Pelanggan hanya dapat mengajukan permohonan pembatalan sebelum pesanan diproses. | Pengajuan pembatalan hanya dapat dilakukan saat status masih *Menunggu Peninjauan*, *Menunggu Persetujuan Harga*, atau *Menunggu Pembayaran*. |
| **BR-014** | Pembatalan pesanan memerlukan persetujuan dari admin. | Status tidak langsung berubah menjadi *Dibatalkan*; admin meninjau alasan pembatalan sebelum menyetujui (*Approve*) atau menolak (*Reject*). |
| **BR-015** | Status pesanan diperbarui secara bertahap oleh admin sesuai progres pengerjaan buket. | Transisi status wajib mengikuti mesin status (*State Machine*) yang sah. |
| **BR-016** | Perkembangan pengerjaan pesanan dikomunikasikan secara berkala oleh admin. | Admin memperbarui status di web dan dapat memberikan catatan progres kerja. |

---

## 3. Spesifikasi Siklus 8 Status Pesanan & Validasi Mesin Status (*State Machine*)

Sistem menerapkan **8 Status Baku (ST-01 s/d ST-08)**:

| Kode Status | Label Status | Deskripsi Operasional |
|---|---|---|
| **ST-01** | `Menunggu Peninjauan Admin` | Pesanan baru (katalog/custom) telah diterima sistem dan menunggu ditinjau oleh admin. |
| **ST-02** | `Menunggu Persetujuan Harga` | Admin telah menetapkan harga buket custom; menunggu persetujuan dari pemesan. |
| **ST-03** | `Menunggu Pembayaran` | Pesanan siap dibayar (katalog disetujui atau custom telah di-approve harganya). |
| **ST-04** | `Menunggu Konfirmasi Pembayaran` | Pelanggan telah menyatakan transfer; menunggu verifikasi manual mutasi oleh admin. |
| **ST-05** | `Pembayaran Dikonfirmasi` | Admin telah memvalidasi keabsahan dana yang masuk (*Lunas / Sah*). |
| **ST-06** | `Sedang Dibuat` | Perangkai bunga (*florist*) sedang merangkai buket fisik sesuai spesifikasi. |
| **ST-07** | `Selesai` | Buket telah selesai dibuat dan diserahkan / dikirimkan ke penerima (*Completed*). |
| **ST-08** | `Dibatalkan` | Pesanan dibatalkan secara sah melalui persetujuan pembatalan admin (*Cancelled*). |

---

## 4. Diagram Alur Transisi Status Pesanan

```mermaid
stateDiagram-v2
    [*] --> ST01: Pesanan Dibuat Pelanggan
    
    note right of ST01: ST-01: Menunggu Peninjauan Admin
    
    ST01 --> ST02: Admin Input Harga Custom (Khusus Custom)
    ST01 --> ST03: Admin Menyetujui Pesanan (Khusus Katalog)
    
    ST02 --> ST03: Pelanggan Setujui Usulan Harga
    ST02 --> ST08: Pelanggan Tolak Harga & Batal
    
    ST03 --> ST04: Pelanggan Konfirmasi Bayar
    ST04 --> ST05: Admin Verifikasi Pembayaran Sah
    ST04 --> ST03: Bukti Bayar Tidak Sah / Ditolak
    
    ST05 --> ST06: Admin Mulai Rangkai Buket
    ST06 --> ST07: Buket Siap & Diterima Pelanggan
    
    ST07 --> [*]: Transaksi Selesai
    
    ST01 --> ST08: Pengajuan Batal Disetujui
    ST03 --> ST08: Pengajuan Batal Disetujui
    
    ST08 --> [*]: Transaksi Selesai (Batal)
```

---

## 5. Matriks Transisi Status yang Sah (*Valid Transition Matrix*)

Untuk mencegah perpindahan status ilegal di level backend, dibuat tabel aturan transisi berikut:

| Status Asal | Transisi Status Tujuan yang Diizinkan | Transisi Terlarang (Illegal State Transition) |
|---|---|---|
| **ST-01 (Menunggu Peninjauan)** | ST-02 (Custom), ST-03 (Katalog), ST-08 (Batal) | Langsung ke ST-04, ST-05, ST-06, ST-07 |
| **ST-02 (Persetujuan Harga)** | ST-03 (Setuju), ST-08 (Tolak/Batal) | Langsung ke ST-04, ST-05, ST-06, ST-07 |
| **ST-03 (Menunggu Pembayaran)** | ST-04 (Konfirmasi Bayar), ST-08 (Batal) | Langsung ke ST-05, ST-06, ST-07 |
| **ST-04 (Menunggu Konfirmasi)** | ST-05 (Dikonfirmasi), ST-03 (Bukti Gagal) | Langsung ke ST-06, ST-07, ST-08 |
| **ST-05 (Pembayaran Dikonfirmasi)**| ST-06 (Sedang Dibuat) | Mundur ke ST-01..04, atau langsung ST-07 |
| **ST-06 (Sedang Dibuat)** | ST-07 (Selesai) | Mundur ke status pembayaran, atau ST-08 |
| **ST-07 (Selesai)** | *Terminal State* (Tidak ada transisi lanjutan) | Semua perubahan status setelah selesai dilarang |
| **ST-08 (Dibatalkan)** | *Terminal State* (Tidak ada transisi lanjutan) | Semua perubahan status setelah dibatalkan dilarang |

> **Audit Trail:** Setiap perpindahan status yang sah wajib dicatat pada tabel `order_status_histories` dengan mencatat `order_id`, `status_code`, `changed_by_admin_id`, `notes`, dan timestamp `created_at`.

---

## 6. Kesimpulan & Rekomendasi

### 6.1 Status Task DOC-009
Task **DOC-009 (Meninjau business rules)** telah selesai dilaksanakan:
- 20 Aturan Bisnis Wajib telah ditinjau dan diterjemahkan ke dalam aturan validasi backend konkret.
- Mesin transisi 8 status pesanan beserta matriks transisi sah telah terkunci rapat.
- Proteksi data historis produk (BR-020) telah terdefinisi pada level basis data.
- Kriteria penyelesaian terpenuhi.

### 6.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task penutup sub-fase 4.2:
- **`DOC-010 — Meninjau acceptance criteria.`**

