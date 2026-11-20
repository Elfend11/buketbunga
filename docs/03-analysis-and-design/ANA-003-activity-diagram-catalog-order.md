<<<<<<< HEAD
# ACTIVITY DIAGRAM KATALOG, PERSONALISASI, DAN PEMESANAN VIA WHATSAPP
=======
# ACTIVITY DIAGRAM ALUR KATALOG, PERSONALISASI, DAN PEMESANAN VIA WHATSAPP
>>>>>>> c202b49 (Revise documentation and initial implementation)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-003  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-002 — Use Case Description (Selesai dan Diselaraskan)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram, ANA-002 — Use Case Descriptions  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

<<<<<<< HEAD
Pemodelan Diagram Aktivitas Pemesanan Katalog dan Personalisasi (Task ANA-003) dilakukan untuk menggambarkan aliran kerja dinamis (*dynamic workflow*), percabangan keputusan (*decision points*), serta pembagian peran (*swimlanes*) dalam proses eksplorasi katalog, konfigurasi personalisasi, kalkulasi estimasi harga, hingga pengalihan pemesanan ke WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Sesuai dengan konsep sistem terbaru (v1.1), sistem informasi BLOOMÉ difokuskan sebagai **katalog interaktif dan media konfigurasi personalisasi buket, sedangkan pencatatan pesanan resmi, verifikasi pembayaran, negosiasi harga, dan koordinasi pengiriman dilakukan secara langsung melalui WhatsApp**. 

Diagram ini memetakan koordinasi aktivitas antara tiga partisipan:
1. **Customer (Pelanggan):** Berbelanja langsung tanpa login (*zero-login*), memilih buket, mengonfigurasi variasi, dan mengirimkan pesan pemesanan secara manual di WhatsApp.
2. **Sistem Web BLOOMÉ:** Menangani penyajian katalog dari database, validasi stok produk, konfigurator visual (*color swatches*), kalkulasi harga live di antarmuka pengguna, pembuatan pesan terstruktur otomatis, dan pengalihan ke WhatsApp.
3. **WhatsApp & Pemilik Usaha (Di Luar Sistem Web):** Menerima pesan pemesanan di aplikasi WhatsApp toko, mengonfirmasi stok fisik bunga segar di butik, menyepakati harga final & pembayaran (transfer bank / e-wallet, DP 50%), serta mengatur jadwal pengiriman di Samarinda.
=======
Pemodelan Diagram Aktivitas Pemesanan Katalog dan Personalisasi (Task ANA-003) menggambarkan aliran kerja dinamis (*dynamic workflow*), percabangan keputusan (*decision points*), serta pembagian peran (*swimlanes*) dalam proses eksplorasi produk, konfigurasi personalisasi, pemilihan add-on, hingga pengalihan pemesanan ke WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Sesuai ketentuan arsitektur baru:
- Website berfungsi sebagai etalase visual interaktif dan media perangkai spesifikasi buket.
- Website **tidak memproses checkout, tidak menyimpan rekaman transaksi di basis data, dan tidak mengelola pembayaran**.
- Seluruh data yang dikonfigurasi oleh pelanggan dirangkum menjadi **tautan pesan WhatsApp (*pre-filled message*)** yang secara otomatis dialihkan ke aplikasi WhatsApp resmi florist untuk penyelesaian transaksi secara manual.
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 2. Diagram Aktivitas Pemesanan Katalog & Personalisasi (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
<<<<<<< HEAD
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
=======
        C1["Buka Menu Katalog Buket"]
        C2["Pilih Kategori (Bunga Segar/Artificial/Uang/Snack)"]
        C3["Pilih Produk & Buka Halaman Detail Buket"]
        C4["Klik Tombol 'Personalisasi & Pesan'"]
        C5["Konfigurasi Personalisasi:<br>- Pilih Warna Wrapping & Pita<br>- Pilih Item Add-on (Boneka, Cokelat, LED)<br>- Tulis Pesan Kartu Ucapan<br>- Masukkan Tanggal Kebutuhan & Alamat Delivery"]
        C6["Periksa Panel Ringkasan & Estimasi Harga"]
        C7["Klik Tombol 'Pesan via WhatsApp'"]
        C8["Aplikasi WhatsApp Terbuka Otomatis dengan Teks Siap Kirim"]
        C9["Kirim Pesan WhatsApp ke Florist BLOOMÉ"]
    end

    %% Website System Swimlane
    subgraph Lane_Website ["Partisipan: Sistem Website BLOOMÉ"]
        S1["Ambil Data Produk Aktif dari Basis Data"]
        S2["Tampilkan Etalase Produk Sesuai Kategori"]
        S3{"Ketersediaan Stok Produk?"}
        S4["Tampilkan Badge 'Stok Habis'<br>Tawarkan Tombol Konsultasi Alternatif"]
        S5["Tampilkan Formulir Personalisasi & Add-on"]
        S6["Hitung Dinamis Estimasi Biaya (Live Calculator):<br>Harga Dasar Buket + Total Harga Add-on"]
        S7["Tampilkan Rincian Ringkasan & Total Estimasi"]
        S8["Ekstrak Seluruh Data Konfigurasi Pemesan"]
        S9["Kompilasi String Pesan Rapi & URL Encoding:<br>'https://wa.me/{nomor}?text={encoded_text}'"]
        S10["Alihkan Peramban ke Tautan WhatsApp (Redirect)"]
    end

    %% External WhatsApp / Florist Swimlane
    subgraph Lane_WhatsApp ["Luar Sistem: Florist (WhatsApp Chat)"]
        W1["Florist Menerima Pesan Terformat di WhatsApp"]
        W2["Periksa Ketersediaan Bunga Segar di Butik"]
        W3["Konfirmasi Ongkos Kirim Kurir Delivery Samarinda"]
        W4["Kirim Nomor Rekening Bank / E-Wallet Resmi"]
        W5["Pelanggan Transfer & Kirim Bukti Pembayaran"]
        W6["Florist Verifikasi Dana & Rangkai Buket Fisik"]
        W7["Kurir Kirim Buket ke Alamat Penerima (Delivery)"]
>>>>>>> c202b49 (Revise documentation and initial implementation)
    end

    %% Final Nodes
    EndSuccess((◎))
    EndAlternate((◎))

    %% Connections
    C1 --> S1
    S1 --> S2
    S2 --> C2
    C2 --> S2
    S2 --> C3
    C3 --> S3

    S3 -- "Stok Habis (is_available == 0)" --> S4
    S4 --> C3
<<<<<<< HEAD
    
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
=======

    S3 -- "Tersedia (is_available == 1)" --> C4
    C4 --> S5
    S5 --> C5
    C5 --> S6
    S6 --> S7
    S7 --> C6
    C6 --> C7
    C7 --> S8
    S8 --> S9
    S9 --> S10
    S10 --> C8
    C8 --> C9
    C9 --> W1
    W1 --> W2
    W2 --> W3
    W3 --> W4
    W4 --> W5
    W5 --> W6
    W6 --> W7
    W7 --> EndNode
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

## 3. Penjelasan Batas Sistem & Tanggung Jawab Alur

<<<<<<< HEAD
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
=======
### 3.1 Jalur Utama (*Happy Path*)
1. Pelanggan membuka katalog buket bunga dan memfilter kategori yang diminati.
2. Sistem menyajikan produk aktif; pelanggan memilih salah satu buket dan membuka detail produk.
3. Sistem memverifikasi stok tersedia (`is_available == 1`), lalu pelanggan menekan tombol "Personalisasi & Pesan".
4. Pelanggan menentukan warna wrapping, warna pita, memilih add-on tambahan (boneka, cokelat, lampu LED), mengetikkan pesan kartu ucapan, serta memasukkan alamat delivery Samarinda.
5. Sistem secara *real-time* menghitung estimasi biaya: $\text{Total Estimasi} = \text{Harga Buket} + \sum \text{Harga Add-on}$.
6. Pelanggan memeriksa panel ringkasan pesanan dan mengklik tombol "Pesan via WhatsApp".
7. Sistem mengompilasi seluruh isian menjadi format pesan teks yang rapi dan memicu pengalihan peramban ke URL universal WhatsApp (`https://wa.me/`).
8. Aplikasi WhatsApp terbuka di perangkat pelanggan; pelanggan mengirim pesan konfirmasi ke nomor resmi florist BLOOMÉ.
9. Di WhatsApp, florist mengonfirmasi ketersediaan bahan, menghitung tarif ongkos kirim delivery, memberikan nomor rekening transfer, memverifikasi pembayaran manual, dan merangkai buket hingga dikirim kurir.

### 3.2 Jalur Percabangan & Penanganan Alternatif
- **Jalur A1: Stok Produk Habis:**
  - Jika `is_available == 0`, tombol personalisasi dinonaktifkan dengan label *"Stok Habis"*, mencegah pelanggan masuk ke form konfigurasi. Sistem menyediakan opsi tombol alternatif *"Konsultasikan Alternatif via WhatsApp"*.
- **Jalur A2: Pemesanan Tanpa Add-on:**
  - Pelanggan dapat melewati pemilihan item add-on; kalkulator sistem hanya memperhitungkan harga dasar buket katalog.
- **Jalur A3: Informasi Pengiriman & Kurir Delivery:**
  - Pelanggan mengisi alamat di formulir web, namun nominal ongkos kirim diberi label transparan: *"Ongkir akan dikonfirmasi florist melalui WhatsApp"*. Hal ini mematuhi kebijakan bahwa jenis kurir dan tarif pengiriman masih `[Perlu Konfirmasi Owner]`.
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 4. Kesimpulan & Rekomendasi

<<<<<<< HEAD
### 4.1 Status Task ANA-003
Task **ANA-003 (Activity Diagram Pemesanan Katalog)** telah selesai diselaraskan:
- Alur kerja checkout web fiktif telah dieliminasi dan digantikan dengan alur katalog interaktif, konfigurator personalisasi, live calculation, dan WhatsApp hand-off.
- Batasan sistem antara website dan aplikasi WhatsApp digambarkan secara tegas dan terukur.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram aktivitas konsultasi buket custom:
- **`ANA-004 — Activity Diagram konsultasi buket custom via WhatsApp.`**
=======
1. **Zero-Checkout Architecture:** Tidak ada form pengisian data kartu kredit/rekening, tidak ada integrasi payment gateway, dan tidak ada penyimpanan transaksi di tabel `orders` website.
2. **Delivery-First Service:** Alur secara konsisten mengarahkan pemesanan ke moda pengiriman *delivery* ke alamat penerima di Samarinda (bukan *self-pickup* di butik).
3. **Penyusunan Pesan Otomatis Transparan:** Sistem menyusun teks pesan yang detail dan jelas sehingga florist tidak perlu menanyakan ulang rincian pesanan dari awal di WhatsApp.

---

## 5. Kesimpulan
Task **ANA-003 (Activity Diagram Katalog & WhatsApp)** telah selesai direvisi penuh. Alur dinamis sistem telah memisahkan secara tegas wilayah interaksi website dengan ranah transaksi di WhatsApp.
>>>>>>> c202b49 (Revise documentation and initial implementation)
