# ACTIVITY DIAGRAM KATALOG, PERSONALISASI, DAN PEMESANAN VIA WHATSAPP
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-003  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-002 — Use Case Description (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pemesanan Katalog dan Personalisasi (Task ANA-003) dilakukan untuk menggambarkan aliran kerja dinamis (*dynamic workflow*), percabangan keputusan (*decision points*), serta pembagian peran (*swimlanes*) dalam proses eksplorasi katalog, konfigurasi personalisasi, kalkulasi estimasi harga, hingga pengalihan pemesanan ke WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Sesuai dengan konsep sistem terbaru (v1.1), sistem informasi BLOOMÉ difokuskan sebagai **katalog interaktif dan media konfigurasi personalisasi buket, sedangkan pencatatan pesanan resmi, verifikasi pembayaran, negosiasi harga, dan koordinasi pengiriman dilakukan secara langsung melalui WhatsApp**. 

Diagram ini memetakan koordinasi aktivitas antara tiga partisipan:
1. **Customer (Pelanggan):** Berbelanja langsung tanpa login (*zero-login*), memilih buket, mengonfigurasi variasi, dan mengirimkan pesan pemesanan secara manual di WhatsApp.
2. **Sistem Web BLOOMÉ:** Menangani penyajian katalog dari database, validasi stok produk, konfigurator visual (*color swatches*), kalkulasi harga live di antarmuka pengguna, pembuatan pesan terstruktur otomatis, dan pengalihan ke WhatsApp.
3. **WhatsApp & Pemilik Usaha (Di Luar Sistem Web):** Menerima pesan pemesanan di aplikasi WhatsApp toko, mengonfirmasi stok fisik bunga segar di butik, menyepakati harga final & pembayaran (transfer bank / e-wallet, DP 50%), serta mengatur jadwal pengiriman di Samarinda.

---

## 2. Diagram Aktivitas Pemesanan Katalog & Personalisasi (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Buka Halaman Katalog Buket"]
        C2["Pilih Filter Kategori (Buket Bunga/Uang/Snack)"]
        C3["Pilih Produk & Buka Halaman Detail Buket"]
        C4["Pilih Opsi Personalisasi:<br>- Warna Kertas Wrapping via Swatch<br>- Variasi Pita Satin"]
        C5["Pilih Item Add-on Pelengkap:<br>- Kartu Ucapan / Boneka / Cokelat"]
        C6["Ketik Pesan Khusus Kartu Ucapan & Catatan"]
        C7["Tinjau Ringkasan Pilihan & Estimasi Total Harga"]
        C8["Klik Tombol 'Pesan via WhatsApp'"]
        C9["Aplikasi WhatsApp Terbuka dengan Draf Pesan Terisi"]
        C10["Tekan Tombol 'Kirim' Manual di WhatsApp"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1["Ambil Data Produk Aktif & Kategori dari Database"]
        S2["Tampilkan Etalase Produk Sesuai Kategori Terpilih"]
        S3{"Ketersediaan Stok Produk?<br>(is_available == 1)"}
        S4["Tampilkan Badge 'Stok Habis'<br>Nonaktifkan Tombol Pemesanan"]
        S5["Render Halaman Detail & Galeri Multi-Foto<br>Tampilkan Opsi Personalisasi & Add-on"]
        S6["Perbarui Tampilan Pilihan pada Ringkasan"]
        S7["Hitung Estimasi Subtotal Real-Time (Live Calculation):<br>Harga Dasar + Penyesuaian Variasi + Biaya Add-on"]
        S8["Tampilkan Ringkasan & Estimasi Harga di Antarmuka"]
        S9["Susun Draf Teks Pesanan Pemesanan Terstruktur Rapi"]
        S10["Ambil Nomor WhatsApp Toko dari 'business_settings'"]
        S11["Buat URL wa.me dengan Parameter Pesan Ter-encode"]
        S12["Buka Tautan WhatsApp (Hand-off)<br>*Tanpa Menyimpan Transaksi di Basis Data Web*"]
    end

    %% WhatsApp & Owner Swimlane (Outside Web)
    subgraph Lane_WhatsApp ["Partisipan: WhatsApp & Pemilik Usaha (Di Luar Sistem Web)"]
        W1["Pesan Pemesanan Diterima di WhatsApp Resmi Toko"]
        W2["Pemilik Usaha (Nabila) Tinjau Rincian Pesanan & Cek Stok Bunga Segar di Butik"]
        W3{"Bahan Bunga & Slot Tersedia?"}
        W4["Konfirmasi Penolakan / Tawarkan Alternatif Bunga via Chat"]
        W5["Konfirmasi Ketersediaan & Sampaikan Rincian Tagihan Final"]
        W6["Sampaikan Nomor Rekening Bank / E-Wallet & Ketentuan DP 50%"]
        W7["Pelanggan Kirim Bukti Transfer Pembayaran di Chat"]
        W8["Pemilik Usaha Verifikasi Mutasi Bank & Jadwalkan Perangkaian Bunga"]
        W9["Koordinasikan Layanan Pengiriman Kurir Samarinda"]
    end

    %% Final Nodes
    EndSuccess((◎))
    EndAlternate((◎))

    %% Connections across Swimlanes
    C1 --> S1
    S1 --> S2
    S2 --> C2
    C2 --> S2
    S2 --> C3
    C3 --> S3
    
    S3 -- "Habis (0)" --> S4
    S4 --> C3
    
    S3 -- "Tersedia (1)" --> S5
    S5 --> C4
    C4 --> S6
    S6 --> S7
    S7 --> S8
    
    C5 --> S6
    C6 --> S6
    S8 --> C7
    C7 --> C8
    
    C8 --> S9
    S9 --> S10
    S10 --> S11
    S11 --> S12
    S12 --> C9
    
    C9 --> C10
    C10 --> W1
    W1 --> W2
    W2 --> W3
    
    W3 -- "Tidak Tersedia" --> W4
    W4 --> EndAlternate
    
    W3 -- "Tersedia" --> W5
    W5 --> W6
    W6 --> W7
    W7 --> W8
    W8 --> W9
    W9 --> EndSuccess
```

---

## 3. Penjelasan Batas Sistem & Tanggung Jawab Alur

### 3.1 Ranah Sistem Web (Presentation & Calculation)
1. **Navigasi & Visualisasi:** Menampilkan katalog produk, galeri multi-foto, dan filter kategori secara cepat.
2. **Konfigurasi Interaktif:** Memungkinkan pelanggan memilih swatch warna kertas wrapping, pita, serta mencentang item add-on (kartu ucapan, boneka, cokelat).
3. **Kalkulasi Live:** Menghitung total estimasi biaya secara otomatis di antarmuka pengguna tanpa memuat ulang halaman (*zero page reload*).
4. **Generator Pesan:** Menyusun draf pesan pemesanan yang rapi dan baku berdasarkan pilihan pelanggan.
5. **Hand-off Murni:** Mengalihkan pengguna ke tautan `https://wa.me/{nomor_toko}?text={encoded_message}`. Website **tidak menyimpan record transaksi atau membuat invoice resmi** di basis data.

### 3.2 Ranah WhatsApp (Transaction & Fulfillment)
1. **Pengiriman Pesan Mandiri:** Pelanggan menekan tombol "Kirim" secara manual di aplikasi WhatsApp mereka.
2. **Konfirmasi Stok Riil:** Pemilik usaha memeriksa ketersediaan bunga segar riil dan kesiapan slot perangkaian sebelum menyetujui pesanan.
3. **Penyelesaian Pembayaran:** Rincian rekening bank resmi (BCA/BRI/Mandiri) atau e-wallet (DANA/GoPay), persetujuan pembayaran uang muka (DP 50%) `[Perlu Konfirmasi Owner]`, serta verifikasi mutasi transfer dilakukan langsung di WhatsApp.
4. **Pengiriman Lokal Samarinda:** Jadwal pengantaran kurir di wilayah Samarinda dikoordinasikan secara fleksibel melalui obrolan chat.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task ANA-003
Task **ANA-003 (Activity Diagram Pemesanan Katalog)** telah selesai diselaraskan:
- Alur kerja checkout web fiktif telah dieliminasi dan digantikan dengan alur katalog interaktif, konfigurator personalisasi, live calculation, dan WhatsApp hand-off.
- Batasan sistem antara website dan aplikasi WhatsApp digambarkan secara tegas dan terukur.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram aktivitas konsultasi buket custom:
- **`ANA-004 — Activity Diagram konsultasi buket custom via WhatsApp.`**
