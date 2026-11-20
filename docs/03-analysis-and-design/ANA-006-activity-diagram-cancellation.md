<<<<<<< HEAD
# ACTIVITY DIAGRAM ALUR PENGAJUAN & PENANGANAN PEMBATALAN VIA WHATSAPP
=======
# ACTIVITY DIAGRAM PENGELOLAAN KATALOG DAN ADD-ON OLEH ADMIN
>>>>>>> c202b49 (Revise documentation and initial implementation)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-006  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-005 — Activity Diagram alur pembayaran via WhatsApp (Selesai dan Diselaraskan)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram, ANA-002 — Use Case Descriptions  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

<<<<<<< HEAD
Pemodelan Diagram Aktivitas Pembatalan (Task ANA-006) dilakukan untuk menggambarkan alur komunikasi pengajuan pembatalan pesanan atau perubahan detail oleh pelanggan serta proses evaluasi dan keputusan oleh pemilik usaha (Nabila Febriyani) melalui saluran obrolan WhatsApp untuk pesanan buket **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan proses bisnis terbaru (v1.1):
- **Website TIDAK memiliki modul pembatalan atau pengubahan pesanan.**
- **Website TIDAK menyimpan status pesanan aktif atau memproses pengembalian dana (*refund*).**
- **Seluruh permohonan pembatalan, revisi ucapan kartu, maupun perubahan jadwal pengiriman dibicarakan dan dikoordinasikan secara langsung melalui WhatsApp.**

Sesuai aturan bisnis **BR-013** (*Pembatalan hanya dapat disetujui jika bunga segar belum dipotong atau dirangkai fisik*) dan **BR-014** (*Keputusan pembatalan berada penuh di tangan pemilik usaha*), diagram ini memodelkan pertimbangan florist terhadap kondisi fisik bahan baku sebelum menyetujui pembatalan.

---

## 2. Diagram Aktivitas Penanganan Pembatalan via WhatsApp (Swimlane Activity Diagram)
=======
Pemodelan Diagram Aktivitas Pengelolaan Katalog dan Add-on (Task ANA-006) menggambarkan alur kerja administratif pemilik usaha (**Nabila Febriyani**) dalam mengelola seluruh konten website **BLOOMÉ — Flowers & Stories**.

Pada rancangan versi lama, file ini memodelkan proses peninjauan permohonan pembatalan pesanan pelanggan di website (*Task ANA-006 versi lama*). Karena sistem baru tidak lagi memuat pesanan transaksi maupun pembatalan di website, dokumen ini direkonstruksi penuh menjadi pemodelan **Alur Kerja Pengelolaan Master Katalog, Produk, Kategori, Opsi Add-on, dan Pengaturan Bisnis oleh Admin**.

---

## 2. Diagram Aktivitas Pengelolaan Konten oleh Admin (Swimlane Activity Diagram)
>>>>>>> c202b49 (Revise documentation and initial implementation)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> A1

<<<<<<< HEAD
    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Pelanggan Buka Chat WhatsApp Toko BLOOMÉ"]
        C2["Kirim Pesan Pengajuan Pembatalan:<br>- Sebutkan Nama & Rincian Buket Dipesan<br>- Sampaikan Alasan Pembatalan Pesanan"]
        C3["Menunggu Peninjauan oleh Pemilik Toko"]
        C4["Terima Pemberitahuan: Pembatalan Disetujui"]
        C5["Sampaikan Nomor Rekening untuk Pengembalian Dana (Refund)"]
        C6["Terima Bukti Transfer Refund dari Pemilik Usaha"]
        C7["Terima Penjelasan Santun: Pembatalan Ditolak<br>(Bunga Segar Telah Dirangkai Fisik)"]
        C8["Pesanan Tetap Diproses & Diantar Sesuai Jadwal"]
    end

    %% WhatsApp & Owner Swimlane (Outside Web)
    subgraph Lane_Owner ["Partisipan: WhatsApp & Pemilik Usaha (Nabila)"]
        W1["Terima Pesan Pengajuan Pembatalan di WhatsApp"]
        W2["Periksa Progres Fisik Pengerjaan Buket di Butik Samarinda"]
        W3{"Apakah Bunga Segar Sudah Dipotong / Dirangkai Fisik?"}
        W4["Sampaikan Penolakan Pembatalan secara Sopan:<br>'Bunga segar sudah dipotong dan tidak dapat dikembalikan'"]
        W5["Setujui Pembatalan Pesanan"]
        W6{"Apakah Sudah Ada Dana Masuk (DP 50% / Lunas)?"}
        W7["Konfirmasi Pembatalan Tuntas (Belum Ada Pembayaran)"]
        W8["Hitung Besaran Refund Sesuai Kebijakan Toko [Perlu Konfirmasi Owner]"]
        W9["Minta Rekening Bank / E-Wallet Pelanggan"]
        W10["Lakukan Transfer Pengembalian Dana via M-Banking"]
        W11["Kirim Bukti Transfer Refund di Chat WhatsApp"]
    end

    %% Final Nodes
    EndApprovedNoPay((◎))
    EndApprovedRefund((◎))
    EndRejected((◎))

    %% Connections across Swimlanes
    C1 --> C2
    C2 --> W1
    W1 --> W2
    W2 --> W3
    
    W3 -- "Sudah Dipotong / Dirangkai" --> W4
    W4 --> C7
    C7 --> C8
    C8 --> EndRejected
    
    W3 -- "Belum Dipotong (Bahan Masih Utuh)" --> W5
    W5 --> W6
    
    W6 -- "Belum Bayar" --> W7
    W7 --> C4
    C4 --> EndApprovedNoPay
    
    W6 -- "Ada Pembayaran Masuk" --> W8
    W8 --> W9
    W9 --> C4
    C4 --> C5
    C5 --> W10
    W10 --> W11
    W11 --> C6
    C6 --> EndApprovedRefund
=======
    %% Admin Swimlane
    subgraph Lane_Admin ["Partisipan: Admin (Owner: Nabila Febriyani)"]
        A1["Buka URL Login Admin (/admin/login)"]
        A2["Masukkan Email & Kata Sandi Terdaftar"]
        A3["Lihat Metrik Ringkasan pada Dashboard"]
        A4{"Pilih Menu Pengelolaan Konten?"}
        
        %% Menu Kategori
        A5["Menu Kategori: Tambah/Edit/Hapus Kategori"]
        %% Menu Produk
        A6["Menu Produk: Tambah Buket Baru, Upload Foto & Set Harga"]
        A7["Toggle Ketersediaan Stok (Tersedia / Habis)"]
        %% Menu Add-on
        A8["Menu Add-on: Tambah Item Pelengkap & Tentukan Tarif"]
        %% Menu Profil
        A9["Menu Pengaturan: Update Nomor WhatsApp & Alamat Butik"]
        
        A10["Klik Tombol 'Simpan Perubahan'"]
        A11["Klik Tombol 'Keluar / Logout'"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Website BLOOMÉ"]
        S1["Tampilkan Halaman Login Admin"]
        S2{"Verifikasi Kredensial & Token CSRF?"}
        S3["Tampilkan Error: 'Email atau kata sandi tidak cocok'"]
        S4["Inisialisasi Sesi Admin (auth:admin) & Buka Dashboard"]
        S5["Ambil & Tampilkan Metrik Jumlah Produk, Kategori & Add-on"]
        
        %% Validasi Form & Gambar
        S6{"Validasi Input & Berkas Gambar (≤ 5MB)?"}
        S7["Tampilkan Pesan Error Validasi Form"]
        S8["Sanitasi Nama Berkas -> Simpan ke storage/app/public/products/"]
        S9["Simpan Perubahan ke Basis Data (MySQL)"]
        S10["Perbarui Etalase Publik Secara Instan"]
        S11["Tampilkan Notifikasi Sukses (Flash Message)"]
        S12["Hapus Sesi Admin & Redirect ke /admin/login"]
    end

    %% Final Node
    EndNode((◎))

    %% Connections
    A1 --> S1
    S1 --> A2
    A2 --> S2
    
    S2 -- "Gagal" --> S3
    S3 --> A2
    
    S2 -- "Berhasil" --> S4
    S4 --> S5
    S5 --> A3
    A3 --> A4
    
    A4 -- "Kategori" --> A5
    A4 -- "Produk" --> A6
    A4 -- "Stok" --> A7
    A4 -- "Add-on" --> A8
    A4 -- "Profil & WA" --> A9
    
    A5 --> A10
    A6 --> A10
    A7 --> S9
    A8 --> A10
    A9 --> A10
    
    A10 --> S6
    S6 -- "Gagal" --> S7
    S7 --> A4
    
    S6 -- "Lolos" --> S8
    S8 --> S9
    S9 --> S10
    S10 --> S11
    S11 --> A4
    
    A4 -- "Selesai" --> A11
    A11 --> S12
    S12 --> EndNode
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

## 3. Penjelasan Batas Sistem & Kebijakan Bunga Segar

<<<<<<< HEAD
### 3.1 Mengapa Pembatalan Tidak Dilakukan di Website?
1. **Sifat Produk yang Mudah Rusak (*Perishable Goods*):** Bunga segar (*fresh cut flowers*) yang telah dipotong dari batangnya memiliki masa simpan terbatas dan tidak dapat dijual kembali kepada pelanggan lain jika pesanan dibatalkan sepihak. Tombol pembatalan otomatis di website berisiko merugikan butik secara finansial jika ditekan saat buket sudah setengah jadi.
2. **Kebutuhan Diskusi Alternatif:** Sering kali pelanggan membatalkan pesanan bukan karena tidak ingin buketnya, melainkan karena jadwal acara wisuda yang bergeser. Melalui obrolan WhatsApp, florist Nabila dapat menawarkan solusi penjadwalan ulang (*reschedule*) waktu pengiriman alih-alih pembatalan total.

### 3.2 Ketentuan Pengembalian Dana (Refund Policy)
- **Status Kebijakan:** Kebijakan persentase pengembalian dana uang muka (DP) apabila pembatalan dilakukan jauh hari (misal: H-2 sebelum pembuatan) masih berstatus **`[Perlu Konfirmasi Owner]`**.
- **Eksekusi Pengembalian Dana:** Seluruh pengembalian dana ditransfer secara manual oleh Nabila Febriyani melalui mobile banking langsung ke rekening atau nomor e-wallet yang diberikan pelanggan di chat WhatsApp.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task ANA-006
Task **ANA-006 (Activity Diagram Pembatalan)** telah selesai diselaraskan:
- Seluruh logika form pembatalan di website, tabel riwayat pembatalan, dan mesin status `ST-08` di web telah dieliminasi.
- Alur pengajuan pembatalan manual, verifikasi status fisik bunga segar, dan pengembalian dana via WhatsApp telah dimodelkan secara realistis.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram sekuensial (Sequence Diagrams):
- **`ANA-007 — Sequence Diagram eksplorasi katalog, konfigurasi personalisasi, dan WhatsApp hand-off.`**
=======
### 3.1 Alur Pengelolaan Produk & Unggah Foto
1. Admin mengakses menu "Produk" dan memilih "Tambah Produk".
2. Admin mengisi nama buket, memilih kategori relasi, menginput harga dasar (IDR), mengetikkan deskripsi komposisi bunga, dan memilih foto buket resmi.
3. Sistem memvalidasi bahwa berkas adalah gambar valid (JPG, JPEG, PNG) dengan ukuran tidak melebihi 5 MB (5.120 KB).
4. Sistem menyimpan berkas foto ke media penyimpanan lokal `storage/app/public/products/` dan mencatat record baru pada tabel `products`.
5. Produk baru langsung tampil di etalase katalog publik pelanggan.

### 3.2 Alur Pembaruan Status Ketersediaan Stok (*Stock Toggle*)
1. Admin melihat antrean produk pada tabel dashboard.
2. Saat bunga segar habis di butik, admin mengklik sakelar (*toggle*) status buket bersangkutan.
3. Sistem secara asinkron memperbarui kolom `is_available = 0`.
4. Tombol pemesanan produk tersebut di katalog publik langsung dinonaktifkan, mencegah pelanggan memesan bunga yang sedang tidak tersedia.

### 3.3 Alur Pengelolaan Opsi Add-on & Personalisasi
1. Admin membuka menu "Add-on & Personalisasi".
2. Admin menambahkan item add-on pelengkap baru (misal: *Topper Akrilik Happy Birthday* seharga *Rp15.000*).
3. Data tersimpan; item baru secara otomatis muncul pada form checklist personalisasi di sisi pelanggan.

### 3.4 Alur Pembaruan Nomor WhatsApp Resmi
1. Admin membuka menu "Pengaturan Profil Usaha".
2. Admin memperbarui nomor WhatsApp tujuan pemesanan (misal jika terjadi pergantian nomor ponsel operasional butik).
3. Seluruh tautan pemesanan WhatsApp yang digenerate oleh sistem di halaman publik otomatis terarah ke nomor baru tanpa perlu mengubah kode sumber (*hardcoded*).

---

## 4. Kesimpulan
Task **ANA-006 (Activity Diagram Pengelolaan Katalog dan Add-on)** telah selesai direvisi. Seluruh proses administratif berfokus murni pada pemeliharaan konten etalase, manajemen foto, stok, dan add-on tanpa memuat antrean transaksi atau pembatalan di website.
>>>>>>> c202b49 (Revise documentation and initial implementation)
