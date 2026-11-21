# USER FLOW & NAVIGATION ARCHITECTURE SPECIFICATION
# BLOOMÉ — Flowers & Stories

## 1. Document Information

- **Nama Dokumen:** User Flow & Navigation Architecture Specification
- **Nama Produk:** BLOOMÉ — Flowers & Stories
- **Nama Proyek:** Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web
- **Lead UI/UX Designer & Frontend Developer:** Riya Monika
- **Lead System Analyst & Project Manager:** Jayanti Firdasari
- **Backend Developer & Database Administrator:** Elsa Futri
- **Project Sponsor:** Nabila Febriyani
- **Versi Dokumen:** 1.0 (Official User Flow Baseline)
- **Tanggal Efektif:** 13 November 2026
- **Status Dokumen:** Approved Baseline

---

## 2. Overview & Navigation Objectives

Dokumen **User Flow & Navigation Architecture** ini mendefinisikan seluruh jalur interaksi pengguna (*user interaction pathways*), percabangan keputusan (*decision nodes*), penanganan kondisi khusus (*alternative & error flows*), serta arsitektur informasi halaman website **BLOOMÉ — Flowers & Stories**.

Tujuan utama penyusunan user flow:
1. **Frictionless Experience:** Mengeliminasi hambatan langkah belanja dengan menerapkan *guest checkout* instan tanpa registrasi.
2. **Transparent Custom Workflow:** Memetakan alur tawar-menawar harga buket custom secara visual agar pemesan dan pemilik usaha memiliki ekspektasi yang sama.
3. **Clarity for Developers:** Menjadi panduan presisi bagi Riya Monika dalam merancang wireframe/Blade views dan bagi Elsa Futri dalam mengonfigurasi rute controller Laravel.

---

## 3. Sitemap & Information Architecture

Struktur pohon halaman website BLOOMÉ terbagi ke dalam dua ranah terpisah:

```mermaid
graph TD
    subgraph Public_Domain ["Ranah Publik (Customer - Guest)"]
        Home["1. Beranda (Home)"]
        Catalog["2. Katalog Produk"]
        Detail["3. Detail Produk"]
        OrderForm["4. Form Pemesanan Katalog"]
        CustomPage["5. Halaman Custom Bouquet"]
        CustomForm["6. Form Personalisasi & Upload"]
        CustomReview["7. Peninjauan Harga Custom"]
        PaymentInfo["8. Instruksi Pembayaran"]
        OrderConfirm["9. Konfirmasi Pesanan"]
        About["10. Tentang Kami (About)"]
        Contact["11. Kontak Kami"]

        Home --> Catalog
        Home --> CustomPage
        Home --> About
        Home --> Contact
        Catalog --> Detail
        Detail --> OrderForm
        OrderForm --> PaymentInfo
        CustomPage --> CustomForm
        CustomForm --> CustomReview
        CustomReview --> PaymentInfo
        PaymentInfo --> OrderConfirm
    end

    subgraph Admin_Domain ["Ranah Admin (Protected: auth:admin)"]
        Login["A. Login Admin"]
        Dashboard["B. Dashboard Utama"]
        CatMgmt["C. Manajemen Kategori"]
        ProdMgmt["D. Manajemen Produk"]
        OrderMgmt["E. Antrean Pesanan Masuk"]
        OrderDetail["F. Detail Pesanan"]
        CustomMgmt["G. Permintaan Custom & Harga"]
        PayMgmt["H. Verifikasi Pembayaran"]
        CancelMgmt["I. Manajemen Pembatalan"]

        Login --> Dashboard
        Dashboard --> CatMgmt
        Dashboard --> ProdMgmt
        Dashboard --> OrderMgmt
        OrderMgmt --> OrderDetail
        Dashboard --> CustomMgmt
        Dashboard --> PayMgmt
        Dashboard --> CancelMgmt
    end
```

---

## 4. User Flow 1: Pemesanan Produk Katalog (Catalog Ordering Flow)

Alur belanja buket siap pesan oleh pelanggan tanpa login:

```mermaid
flowchart TD
    Start([Pelanggan Akses Web]) --> Home[Buka Beranda]
    Home --> BrowseCat[Buka Menu Katalog]
    BrowseCat --> FilterCat{Pilih Filter Kategori?}
    FilterCat -- Ya --> FilteredList[Tampil Produk Sesuai Kategori]
    FilterCat -- Tidak --> AllList[Tampil Seluruh Katalog]
    FilteredList --> SelectProduct[Pilih Kartu Buket]
    AllList --> SelectProduct
    SelectProduct --> ViewDetail[Buka Halaman Detail Produk]
    
    ViewDetail --> CheckStock{Stok Tersedia?}
    CheckStock -- Habis --> AlertOutOfStock[Tombol Pesan Nonaktif 'Stok Habis']
    CheckStock -- Tersedia --> ClickOrder[Klik Tombol 'Pesan Sekarang']
    
    ClickOrder --> FillForm[Isi Form: Nama, WhatsApp, Alamat Pengiriman, Pesan Kartu Ucapan, Tanggal Kebutuhan]
    FillForm --> ValidateForm{Validasi Form Lengkap?}
    ValidateForm -- Gagal --> ShowError[Muncul Pesan Validasi Inline]
    ShowError --> FillForm
    
    ValidateForm -- Lolos --> SubmitOrder[Klik 'Kirim Pesanan']
    SubmitOrder --> SaveDB[(DB::transaction - Buat Customer & Order)]
    SaveDB --> ShowSummary[Tampil Ringkasan Pesanan & Petunjuk Transfer Bank]
    ShowSummary --> Done([Menunggu Pembayaran Transfer])
```

### Rincian Interaksi Alur Katalog:
1. **Layar Asal:** `resources/views/catalog/index.blade.php`
2. **Kondisi Keputusan:** Jika `is_available == 0`, tombol "Pesan Sekarang" berganti menjadi badge abu-abu nonaktif.
3. **Penyimpanan:** Data nama dan WhatsApp disimpan ke tabel `customers`, pesanan dibuat di tabel `orders` dengan kode acak `BLM-YYYYMM-XXXX`, dan rincian produk disalin sebagai snapshot di `order_details`.
4. **Status Awal:** `ST-01 Menunggu Peninjauan Admin`.

---

## 5. User Flow 2: Pengajuan Personalisasi Buket Custom (Custom Bouquet Flow)

Alur pengajuan buket kustom dengan negosiasi harga terstruktur:

```mermaid
flowchart TD
    Start([Pelanggan Buka Halaman Custom]) --> Guide[Baca Panduan Personalisasi]
    Guide --> FillCustom[Pilih Jenis Bunga, Palet Warna, Tema Acara & Catatan Khusus]
    FillCustom --> UploadRef[Unggah Foto Referensi]
    
    UploadRef --> ValidateFile{Format JPG/PNG & Ukuran <= 5MB?}
    ValidateFile -- Tidak Sesuai --> AlertFile[Tolak Berkas & Tampil Pesan Error Ukuran/Format]
    AlertFile --> UploadRef
    
    ValidateFile -- Sesuai --> FillContact[Isi Identitas Pemesan & Tanggal Kebutuhan]
    FillContact --> SubmitCustom[Klik 'Ajukan Buket Custom']
    SubmitCustom --> SaveCustomDB[(Simpan Tiket Custom - Status: ST-01)]
    SaveCustomDB --> WaitNotice[Tampil Halaman: Pengajuan Berhasil Diterima Admin]
    
    WaitNotice --> AdminReviews[Admin Buka Dashboard & Meninjau Spesifikasi & Foto]
    AdminReviews --> AdminSetPrice[Admin Input Nominal Harga Penawaran di Sistem]
    AdminSetPrice --> StatusToST02[(Status Berubah -> ST-02 Menunggu Persetujuan Harga)]
    
    StatusToST02 --> CustDecisionPage[Pelanggan Buka Halaman Peninjauan Harga]
    CustDecisionPage --> CustomerChoice{Keputusan Pelanggan?}
    
    CustomerChoice -- Setuju (Approve) --> ApprovePrice[Klik 'Setujui Harga']
    ApprovePrice --> StatusToST03[(Status Berubah -> ST-03 Menunggu Pembayaran)]
    StatusToST03 --> ShowPayPage[Tampil Rincian Rekening Bank & Instruksi Transfer]
    
    CustomerChoice -- Tolak (Reject) --> RejectPrice[Klik 'Tolak Usulan Harga']
    RejectPrice --> StatusToST08[(Status Berubah -> ST-08 Dibatalkan / Opsi Revisi)]
    RejectPrice --> RejectNotice[Tampil Opsi Kontak Chat Admin untuk Revisi Bujet]
```

---

## 6. User Flow 3: Pembayaran Manual & Verifikasi Mutasi (Payment Flow)

Alur transfer dana manual oleh pembeli dan verifikasi keabsahan oleh admin:

```mermaid
flowchart TD
    Start([Pesanan Siap Dibayar - ST-03]) --> ViewPayInfo[Buka Halaman Instruksi Pembayaran]
    ViewPayInfo --> ReadBank[Lihat Nomor Rekening Bank BCA/BRI/Mandiri & E-Wallet Resmi]
    ReadBank --> TransferPhysical[Pelanggan Melakukan Transfer via M-Banking / ATM]
    TransferPhysical --> ClickConfirmPay[Klik Tombol 'Saya Sudah Transfer']
    ClickConfirmPay --> StatusToST04[(Status Berubah -> ST-04 Menunggu Konfirmasi Pembayaran)]
    StatusToST04 --> WaitingNotice[Tampil Pesan: Pembayaran Sedang Diverifikasi Admin]
    
    WaitingNotice --> AdminOpensPay[Admin Membuka Menu Pembayaran di Dashboard]
    AdminOpensPay --> CheckMutation[Admin Memeriksa Mutasi Dana di Aplikasi M-Banking Butik]
    CheckMutation --> MutationMatch{Dana Masuk & Sesuai Tagihan?}
    
    MutationMatch -- Ya (Sah) --> ClickVerify[Admin Klik 'Verifikasi Pembayaran']
    ClickVerify --> StatusToST05[(Status Berubah -> ST-05 Pembayaran Dikonfirmasi)]
    StatusToST05 --> ReadyForCraft[Florist Siap Merangkai Bunga -> ST-06]
    
    MutationMatch -- Tidak Ada / Kurang --> ClickRejectPay[Admin Tolak / Hubungi Pemesan]
    ClickRejectPay --> StatusBackST03[(Status Kembali -> ST-03 Menunggu Pembayaran)]
```

---

## 7. User Flow 4: Pengajuan & Penanganan Pembatalan (Cancellation Flow)

Alur permohonan pembatalan oleh pelanggan dan peninjauan oleh pemilik usaha:

```mermaid
flowchart TD
    Start([Pelanggan Ingin Membatalkan]) --> CheckStage{Status Pesanan Saat Ini?}
    CheckStage -- Sedang Dibuat / Selesai --> RejectAuto[Tolak: Bunga Sudah Dirangkai, Tidak Dapat Dibatalkan]
    
    CheckStage -- ST-01 / ST-02 / ST-03 --> OpenCancelForm[Buka Form Pengajuan Pembatalan]
    OpenCancelForm --> InputReason[Isi Alasan Pembatalan]
    InputReason --> SubmitCancel[Kirim Permohonan Pembatalan]
    SubmitCancel --> AdminReviewCancel[Admin Meninjau Alasan di Menu Pembatalan]
    
    AdminReviewCancel --> AdminDecision{Keputusan Admin?}
    AdminDecision -- Setujui (Approve) --> ConfirmCancel[Admin Klik 'Setujui Pembatalan']
    ConfirmCancel --> StatusST08[(Status Menjadi -> ST-08 Dibatalkan - Terminal)]
    
    AdminDecision -- Tolak (Reject) --> RejectCancel[Admin Klik 'Tolak Pembatalan']
    RejectCancel --> KeepStatus[(Status Aktif Sebelumnya Tetap Dipertahankan)]
```

---

## 8. User Flow 5: Alur Kerja Administrator (Admin Operations Flow)

Rutinitas harian pemilik usaha mengelola operasional butik:

```mermaid
flowchart TD
    AdminStart([Buka /admin]) --> CheckSession{Sudah Ada Sesi Login?}
    CheckSession -- Belum --> ShowLogin[Tampil Halaman Login Admin]
    ShowLogin --> SubmitAuth[Input Email & Password]
    SubmitAuth --> ValidateAuth{Kredensial Cocok?}
    ValidateAuth -- Salah --> ErrorLogin[Tampil Peringatan Akun Salah]
    ErrorLogin --> ShowLogin
    
    ValidateAuth -- Benar --> SessionCreate[Regenerasi Sesi Aman]
    CheckSession -- Sudah --> SessionCreate
    SessionCreate --> OpenDashboard[Tampil Dashboard Utama]
    
    OpenDashboard --> MenuChoice{Pilih Menu Operasional}
    MenuChoice -- 1. Produk --> ProductOps[Tambah/Edit/Hapus Buket & Toggle Stok]
    MenuChoice -- 2. Kategori --> CategoryOps[CRUD Kategori Buket Bunga/Uang/Snack]
    MenuChoice -- 3. Custom Baru --> ReviewCustom[Buka Detail Custom -> Input Usulan Harga]
    MenuChoice -- 4. Verifikasi Bayar --> VerifyPayment[Cek Mutasi Rekening -> Klik Verifikasi]
    MenuChoice -- 5. Antrean Pesanan --> UpdateOrder[Lihat Jadwal Tanggal Kebutuhan -> Ubah Status Sedang Dibuat -> Selesai]
```

---

## 9. Penanganan Kasus Batas (*Edge Cases & Exception Flows*)

| Skenario Khusus | Jalur Alternatif & Penanganan Sistem |
|---|---|
| **Koneksi Terputus saat Submit Pesanan** | Mekanisme `DB::transaction()` otomatis membatalkan kueri parsial (*rollback*). Pengguna menerima alert ramah untuk mencoba kembali. |
| **Unggahan Berkas Gambar Rusak / Format Ilegal** | Validasi form request menolak berkas sebelum tersimpan ke disk dan memberikan notifikasi: *"Format berkas hanya boleh JPG, JPEG, atau PNG dan ukuran maksimal 5 MB."* |
| **Sesi Login Admin Kedaluwarsa (*Session Timeout*)** | Middleware `auth:admin` menangkap request, menyimpan URL tujuan (*intended URL*), dan mengarahkan kembali ke halaman login dengan pesan: *"Sesi Anda telah berakhir, silakan login kembali."* |
| **Percobaan Pembatalan pada Pesanan Selesai** | Tombol pembatalan dihilangkan dari antarmuka; jika endpoint diakses via URL langsung, controller melempar respon HTTP 403 (*Action Forbidden*). |

---

## 10. Kesimpulan & Pengesahan

Arsitektur alur pengguna (*User Flow*) ini telah diselaraskan dengan kebutuhan fungsional (`requirement.md`), rancangan produk (`prd.md`), dan panduan desain sistem (`design-system.md`). Dokumen ini siap menjadi acuan langsung penyusunan wireframe, mockup antarmuka, dan implementasi routing Laravel.

**Disahkan Oleh:**  
**Riya Monika** (UI/UX Designer & Frontend Developer)  
**Jayanti Firdasari** (Project Manager & System Analyst)  
Tanggal: 13 November 2026
