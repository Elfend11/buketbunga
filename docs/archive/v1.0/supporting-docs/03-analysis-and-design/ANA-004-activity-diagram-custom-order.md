# ACTIVITY DIAGRAM PEMESANAN BUKET CUSTOM (CUSTOM BOUQUET WORKFLOW)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-004  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-003 — Activity Diagram pemesanan katalog (Selesai)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pemesanan Buket Custom (Task ANA-004) dilakukan untuk memetakan alur kolaborasi dinamis (*collaborative workflow*) antara pembeli dan pemilik usaha dalam layanan personalisasi buket bunga pada website **BLOOMÉ — Flowers & Stories**.

Berbeda dengan alur katalog yang berharga tetap, alur pesanan custom melibatkan siklus peninjauan foto referensi, penentuan harga penawaran secara manual oleh pemilik usaha (Nabila Febriyani), serta gerbang persetujuan harga (*Price Approval Gate*) oleh pelanggan sebelum transaksi dapat berlanjut ke pembayaran.

---

## 2. Diagram Aktivitas Pemesanan Buket Custom (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Buka Menu 'Custom Bouquet'"]
        C2["Baca Panduan Personalisasi"]
        C3["Pilih Spesifikasi:<br>- Jenis Bunga (Segar/Artificial)<br>- Palet Warna Favorit<br>- Tema Acara & Catatan Khusus"]
        C4["Unggah Foto Referensi dari Perangkat"]
        C5["Pilih Ulang Berkas Foto"]
        C6["Isi Identitas Pemesan:<br>- Nama & WhatsApp Aktif<br>- Alamat Pengiriman Samarinda<br>- Tanggal Kebutuhan Buket"]
        C7["Klik 'Ajukan Buket Custom'"]
        C8["Terima Konfirmasi: Pengajuan Sedang Ditinjau Admin"]
        C9["Buka Halaman Peninjauan Harga Custom"]
        C10{"Keputusan Terhadap Harga Usulan?"}
        C11["Klik Tombol 'Setujui Harga' (Approve)"]
        C12["Klik Tombol 'Tolak Usulan' (Reject)"]
        C13["Terima Petunjuk Pembayaran Transfer Bank"]
        C14["Dapat Menghubungi Admin via WA untuk Diskusi Ulang"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1["Tampilkan Halaman Panduan & Formulir Custom"]
        S2{"Validasi Berkas Foto:<br>Format JPG/PNG & Ukuran <= 5MB?"}
        S3["Tampilkan Error Validasi Berkas"]
        S4["Tampilkan Pratinjau Thumbnail Foto"]
        S5{"Validasi Formulir Identitas Lengkap?"}
        S6["Tampilkan Error Validasi Form Inline"]
        S7["Sanitasi Berkas Foto -> Simpan UUID ke Storage"]
        S8["DB Transaction:<br>1. Simpan Data Pelanggan<br>2. Simpan Tiket 'custom_requests'<br>3. Simpan Relasi Path Foto 'custom_references'<br>4. Buat Order (Status ST-01)"]
        S9["Tampilkan Pesan Pengajuan Berhasil Masuk Antrean"]
        S10["Simpan Nominal Harga 'proposed_price'<br>Update Status -> ST-02 Menunggu Persetujuan Harga"]
        S11["Tampilkan Rincian Tiket & Nominal Harga Penawaran"]
        S12["Update Status -> ST-03 Menunggu Pembayaran<br>Catat Persetujuan di Histori Audit"]
        S13["Tampilkan Rekening Bank Resmi & Total Tagihan"]
        S14["Update Status -> ST-08 Dibatalkan<br>Catat Penolakan di Histori Audit"]
        S15["Sajikan Opsi Kontak Chat Admin untuk Revisi"]
    end

    %% Admin Swimlane
    subgraph Lane_Admin ["Partisipan: Admin (Pemilik Usaha)"]
        A1["Buka Menu 'Permintaan Custom' di Dashboard"]
        A2["Buka Detail Tiket Custom Baru (Status ST-01)"]
        A3["Periksa Spesifikasi Bunga, Warna & Foto Referensi"]
        A4["Taksir Biaya Bahan Baku & Kerumitan Merangkai"]
        A5["Input Nominal Harga Penawaran di Sistem"]
        A6["Klik 'Kirim Penawaran Harga'"]
    end

    %% Final Node
    EndNodeSuccess((◎))
    EndNodeReject((◎))

    %% Connections across Swimlanes
    C1 --> S1
    S1 --> C2
    C2 --> C3
    C3 --> C4
    C4 --> S2
    
    S2 -- "Tidak Valid" --> S3
    S3 --> C5
    C5 --> C4
    
    S2 -- "Valid" --> S4
    S4 --> C6
    C6 --> C7
    C7 --> S5
    
    S5 -- "Gagal" --> S6
    S6 --> C6
    
    S5 -- "Lolos" --> S7
    S7 --> S8
    S8 --> S9
    S9 --> C8
    C8 --> A1
    
    A1 --> A2
    A2 --> A3
    A3 --> A4
    A4 --> A5
    A5 --> A6
    A6 --> S10
    
    S10 --> C9
    C9 --> S11
    S11 --> C10
    
    C10 -- "Setuju (Approve)" --> C11
    C11 --> S12
    S12 --> S13
    S13 --> C13
    C13 --> EndNodeSuccess

    C10 -- "Tolak (Reject)" --> C12
    C12 --> S14
    S14 --> S15
    S15 --> C14
    C14 --> EndNodeReject
```

---

## 3. Analisis Jalur Aktivitas (*Path Analysis*)

### 3.1 Jalur Utama (*Happy Path: Selesai Disetujui*)
1. Pelanggan membuka form buket custom, memilih preferensi bunga/warna, mengunggah foto referensi (JPG/PNG ≤ 5MB), mengisi identitas dan tanggal kebutuhan buket.
2. Sistem memvalidasi berkas dan formulir, mengacak nama berkas dengan UUID unik di storage lokal, dan menyimpan tiket pesanan dengan status `ST-01 Menunggu Peninjauan Admin`.
3. Admin (Nabila) membuka detail tiket custom di dashboard, memeriksa foto referensi, dan menaksir biaya bahan baku.
4. Admin menginput nominal harga penawaran (misal: Rp285.000) dan menekan "Kirim Penawaran Harga".
5. Sistem memperbarui status transaksi menjadi `ST-02 Menunggu Persetujuan Harga`.
6. Pelanggan membuka halaman peninjauan harga, membaca nominal usulan, dan mengklik tombol "Setujui Harga".
7. Sistem memperbarui status menjadi `ST-03 Menunggu Pembayaran` dan mencatat audit persetujuan di tabel histori.
8. Pelanggan menerima rincian rekening bank resmi untuk transfer manual.

### 3.2 Jalur Penolakan Harga & Revisi (*Alternative Flow: Price Rejection*)
1. Jika pelanggan merasa harga usulan melebihi bujet yang dimiliki, pelanggan menekan tombol "Tolak Usulan".
2. Sistem mencatat keputusan `customer_decision = 'rejected'` dan menggeser status menjadi `ST-08 Dibatalkan`.
3. Sistem menyajikan informasi kontak chat WhatsApp pemilik usaha apabila pelanggan ingin berkonsultasi untuk mengurangi kuantitas bunga atau menyederhanakan jenis pembungkus (*wrapping*) agar bujet sesuai.

### 3.3 Jalur Penolakan Berkas Unggahan (*Exception Flow: Invalid File*)
1. Jika pelanggan mengunggah berkas melebihi 5 MB atau berekstensi ilegal (misal `.pdf` atau `.exe`), sistem menolak berkas di sisi klien dan server.
2. Sistem menampilkan pesan galat: *"Berkas gagal diunggah. Pastikan format berupa JPG, JPEG, atau PNG dan ukuran maksimal 5 MB."*
3. Pelanggan memilih ulang berkas yang sesuai ketentuan.

---

## 4. Kepatuhan Terhadap Aturan Bisnis Proyek

Alur aktivitas ini menjamin penerapan aturan bisnis secara mutlak:
- **BR-006 (Penetapan Harga Manual):** Tidak ada algoritma otomatis; nominal harga 100% ditentukan oleh florist pemilik usaha.
- **BR-007 (Persetujuan Harga Pelanggan):** Transaksi diblokir dari tahap pembayaran sebelum pemesan menekan tombol *Setujui Harga*.
- **BR-008 (Penanganan Penolakan Harga):** Penolakan harga tercatat secara formal dan pesanan dialihkan ke opsi revisi kontak/batal.
- **BR-017 & BR-018 (Keamanan Unggah Berkas):** Ekstensi berkas dibatasi pada format gambar murni dan ukuran maksimal dibatasi 5 MB per berkas.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-004
Task **ANA-004 (Activity Diagram pemesanan custom)** telah selesai dilaksanakan:
- Diagram aktivitas pemesanan buket custom berbasis swimlane (Customer, Sistem, Admin) telah dimodelkan menggunakan format visual Mermaid.
- Alur pengajuan, validasi upload foto referensi, penentuan harga usulan florist, serta gerbang persetujuan pelanggan terpetakan lengkap.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task pemodelan diagram aktivitas berikutnya pada sub-fase 5.2:
- **`ANA-005 — Activity Diagram pembayaran.`**

