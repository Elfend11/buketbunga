<<<<<<< HEAD
# ACTIVITY DIAGRAM KONSULTASI BUKET CUSTOM VIA WHATSAPP
=======
# ACTIVITY DIAGRAM ALUR KONSULTASI PERSONALISASI FLEKSIBEL
>>>>>>> c202b49 (Revise documentation and initial implementation)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-004  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-003 — Activity Diagram pemesanan katalog (Selesai dan Diselaraskan)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram, ANA-003 — Activity Diagram Katalog  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

<<<<<<< HEAD
Pemodelan Diagram Aktivitas Konsultasi Buket Custom (Task ANA-004) dilakukan untuk memetakan alur kolaborasi (*collaborative workflow*) antara pembeli yang menginginkan rancangan buket di luar katalog dengan pemilik usaha (Nabila Febriyani) melalui integrasi tautan WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan arsitektur dan bisnis terbaru (v1.1), sistem informasi BLOOMÉ tidak menyediakan formulir kustomisasi bertingkat di web, tidak menyimpan tiket permintaan custom di basis data web, dan tidak menyediakan antarmuka negosiasi harga di dalam web. Sebagai gantinya, **website menyediakan panduan inspirasi dan tombol langsung (*Direct WhatsApp Action*) yang mengarahkan pelanggan untuk berkonsultasi secara manusiawi, mengirimkan gambar acuan, menegosiasikan harga, serta menyepakati pesanan secara fleksibel langsung melalui WhatsApp**.

---

## 2. Diagram Aktivitas Konsultasi Buket Custom (Swimlane Activity Diagram)
=======
Pemodelan Diagram Aktivitas Konsultasi Personalisasi Fleksibel (Task ANA-004) menggambarkan alur kerja bagi pelanggan yang menginginkan buket bunga khusus (*fully-customized bouquet*) di luar varian katalog tetap pada website **BLOOMÉ — Flowers & Stories**.

Berbeda dengan alur versi lama yang memaksakan unggah berkas foto ke basis data website dan penetapan harga melalui dashboard admin, alur terkini memindahkan negosiasi custom langsung ke **ruang percakapan interaktif WhatsApp**:
1. Website menyediakan panduan perangkaian bunga, inspirasi galeri, dan tombol pintasan konsultasi WhatsApp.
2. Pelanggan mengirimkan berkas foto referensi dari perangkatnya langsung ke dalam obrolan chat WhatsApp dengan florist.
3. Diskusi mengenai ketersediaan tangkai bunga musiman, penyesuaian anggaran (*budget fitting*), dan kesepakatan harga dilakukan secara luwes dan personal langsung dengan pemilik butik (Nabila Febriyani).

---

## 2. Diagram Aktivitas Konsultasi Custom (Swimlane Activity Diagram)
>>>>>>> c202b49 (Revise documentation and initial implementation)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
<<<<<<< HEAD
        C1["Buka Menu / Halaman Panduan 'Buket Custom'"]
        C2["Baca Informasi & Ketentuan Konsultasi Desain Custom"]
        C3["Klik Tombol 'Konsultasi Buket Custom via WhatsApp'"]
        C4["Aplikasi WhatsApp Terbuka dengan Template Salam Konsultasi"]
        C5["Kirim Pesan Salam Pembuka secara Manual"]
        C6["Kirim Berkas Foto Referensi dari Galeri Ponsel di Chat"]
        C7["Sampaikan Preferensi:<br>- Jenis Bunga (Segar/Artificial)<br>- Nuansa Warna & Tema Perayaan<br>- Anggaran / Tanggal Kebutuhan"]
        C8{"Menerima Penawaran Harga dari Florist?"}
        C9["Diskusikan Penyesuaian Bahan / Negosiasi Harga"]
        C10["Setujui Kesepakatan Desain & Harga Final"]
        C11["Batalkan Rencana Pesanan Custom"]
        C12["Lakukan Pembayaran Transfer Bank / E-Wallet (DP 50% / Lunas)"]
        C13["Kirim Bukti Transfer di Chat WhatsApp"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1["Tampilkan Panduan Kustomisasi & Banner Inspirasi"]
        S2["Ambil Nomor WhatsApp Toko dari 'business_settings'"]
        S3["Susun Template Salam Pembuka Konsultasi Buket Custom"]
        S4["Buka Tautan wa.me dengan Parameter Salam Ter-encode<br>*Tanpa Membuat Tiket di Basis Data Web*"]
    end

    %% WhatsApp & Florist Swimlane (Outside Web)
    subgraph Lane_Florist ["Partisipan: WhatsApp & Florist (Nabila Febriyani)"]
        W1["Terima Pesan Konsultasi Custom dari Pelanggan di WhatsApp"]
        W2["Tinjau Foto Referensi & Spesifikasi yang Diinginkan"]
        W3["Periksa Ketersediaan Stok Bunga Segar & Bahan di Samarinda"]
        W4{"Apakah Bahan Tersedia & Dapat Dirangkai?"}
        W5["Tawarkan Alternatif Bunga / Variasi Warna yang Serupa"]
        W6["Taksir Biaya Bahan Baku & Kerumitan Perangkaian"]
        W7["Kirim Usulan Harga Resmi & Estimasi Waktu Pengerjaan"]
        W8["Terima Keputusan Pelanggan & Catat Kesepakatan Final"]
        W9["Kirim Nomor Rekening Resmi (BCA/BRI/Mandiri/E-Wallet)"]
        W10["Verifikasi Mutasi Transfer Dana Masuk"]
        W11["Konfirmasi Pesanan Custom Sah & Jadwalkan Pembuatan"]
=======
        C1["Buka Menu 'Custom Bouquet' di Website"]
        C2["Pelajari Panduan Bahan Bunga & Tips Personalisasi"]
        C3["Klik Tombol 'Konsultasi Custom via WhatsApp'"]
        C4["Aplikasi WhatsApp Terbuka Otomatis"]
        C5["Kirim Pesan Pembuka Konsultasi"]
        C6["Kirim Berkas Foto Referensi dari Galeri Perangkat"]
        C7["Sampaikan Informasi Tambahan:<br>- Anggaran Biaya yang Diinginkan<br>- Tema Acara (Wisuda/Anniversary/Ulang Tahun)<br>- Tanggal Kebutuhan & Alamat Delivery Samarinda"]
        C8{"Menerima Usulan Komposisi & Penawaran Harga Florist?"}
        C9["Sepakati Pesanan & Minta Rekening Pembayaran"]
        C10["Diskusikan Penyesuaian Bahan/Budget atau Batalkan"]
    end

    %% Website System Swimlane
    subgraph Lane_Website ["Partisipan: Sistem Website BLOOMÉ"]
        S1["Tampilkan Halaman Edukasi Custom Bouquet:<br>- Galeri Inspirasi Rangkaian<br>- Penjelasan Karakter Bunga Segar vs. Artificial<br>- Tombol Call-to-Action WhatsApp"]
        S2["Generate Link Konsultasi Khusus WhatsApp:<br>'https://wa.me/{nomor}?text={pesan_pembuka_custom}'"]
        S3["Alihkan Peramban ke Aplikasi WhatsApp Pelanggan"]
    end

    %% Florist / WhatsApp Swimlane
    subgraph Lane_WhatsApp ["Luar Sistem: Florist (WhatsApp Chat)"]
        W1["Florist Menerima Permintaan Konsultasi Custom di WhatsApp"]
        W2["Periksa Berkas Foto Referensi yang Dikirim Pelanggan"]
        W3["Cek Ketersediaan Stok Bahan Bunga Segar di Butik Samarinda"]
        W4["Tawarkan Solusi Komposisi & Taksir Nominal Harga Penawaran"]
        W5["Kirim Rincian Rekening Bank Resmi (BCA/BRI/Mandiri/E-Wallet)"]
        W6["Verifikasi Bukti Transfer Manual Pelanggan"]
        W7["Rangkai Buket Fisik Sesuai Kesepakatan"]
        W8["Kirim Foto Hasil Rangkaian ke Pelanggan Sebelum Berangkat"]
        W9["Serahkan Paket Buket ke Kurir Delivery"]
>>>>>>> c202b49 (Revise documentation and initial implementation)
    end

    %% Final Nodes
    EndSuccess((◎))
    EndCancelled((◎))

    %% Connections
    C1 --> S1
    S1 --> C2
    C2 --> C3
    C3 --> S2
    S2 --> S3
<<<<<<< HEAD
    S3 --> S4
    S4 --> C4
    
    C4 --> C5
    C5 --> W1
    C5 --> C6
    C6 --> C7
    C7 --> W2
    
    W1 --> W2
    W2 --> W3
    W3 --> W4
    
    W4 -- "Bahan Kosong / Sulit" --> W5
    W5 --> C7
    
    W4 -- "Bahan Siap" --> W6
    W6 --> W7
    W7 --> C8
    
    C8 -- "Ingin Nego / Ubah Desain" --> C9
    C9 --> W6
    
    C8 -- "Tidak Cocok" --> C11
    C11 --> EndCancelled
    
    C8 -- "Setuju" --> C10
    C10 --> W8
    W8 --> W9
    W9 --> C12
    C12 --> C13
    C13 --> W10
    W10 --> W11
    W11 --> EndSuccess
=======
    S3 --> C4
    C4 --> C5
    C5 --> W1
    C5 --> C6
    C6 --> W2
    C6 --> C7
    C7 --> W3
    W3 --> W4
    W4 --> C8

    C8 -- "Setuju" --> C9
    C9 --> W5
    W5 --> W6
    W6 --> W7
    W7 --> W8
    W8 --> W9
    W9 --> EndSuccess

    C8 -- "Batal / Tidak Sepakat" --> C10
    C10 --> EndCancelled
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

## 3. Penjelasan Batas Sistem & Keunggulan Alur WhatsApp

<<<<<<< HEAD
### 3.1 Peran Sistem Web BLOOMÉ
1. **Media Edukasi & Inspirasi:** Website menyediakan galeri inspirasi, tips memilih buket, dan panduan jelas mengenai apa saja yang perlu disiapkan pelanggan sebelum berkonsultasi.
2. **Penyambung Komunikasi Langsung:** Website tidak membatasi format foto atau membebani server dengan penyimpanan tiket pesanan kustom. Sistem cukup menyediakan tombol `wa.me` yang terhubung dengan nomor WhatsApp aktif di tabel `business_settings`.
3. **Peniadaan Biaya Infrastruktur:** Dengan mengandalkan saluran WhatsApp, BLOOMÉ tidak memerlukan modul perpesanan (*in-app chat*) yang rumit atau penyimpanan foto berukuran besar di server web.

### 3.2 Keunggulan Komunikasi WhatsApp bagi Butik Bunga
1. **Sentuhan Personal & Fleksibel:** Perangkaian buket kustom adalah seni yang membutuhkan dialog dua arah. Percakapan chat WhatsApp memungkinkan florist Nabila memahami nuansa emosional dan ekspektasi pelanggan secara utuh.
2. **Pengiriman Foto Tanpa Hambatan:** Pelanggan dapat leluasa mengirimkan banyak foto referensi, video singkat, atau tangkapan layar dari media sosial langsung di chat WhatsApp tanpa batasan ukuran ketat dari web.
3. **Penetapan Harga Dinamis:** Harga buket bunga segar sangat bergantung pada fluktuasi harga lelang bunga dan ketersediaan musiman. Diskusi langsung di WhatsApp memberi ruang bagi florist untuk menyesuaikan penawaran harga secara adil dan transparan.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task ANA-004
Task **ANA-004 (Activity Diagram Pemesanan Buket Custom)** telah selesai diselaraskan:
- Alur pengajuan kustomisasi web lama (tabel `custom_requests`, upload berkas ke web server, tombol approve/reject harga di web) telah digantikan dengan alur konsultasi interaktif via WhatsApp.
- Koordinasi pertukaran foto, negosiasi harga, dan pembayaran DP/lunas di luar web telah dimodelkan dengan runtut.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram aktivitas alur pembayaran via WhatsApp:
- **`ANA-005 — Activity Diagram alur pembayaran & konfirmasi via WhatsApp.`**
=======
### 3.1 Jalur Utama (*Happy Path*)
1. Pelanggan membuka menu "Custom Bouquet" pada website BLOOMÉ.
2. Sistem menyajikan panduan inspirasi visual dan informasi tips pemilihan bunga (perbedaan bunga segar vs bunga tiruan).
3. Pelanggan mengklik tombol "Konsultasi Custom via WhatsApp".
4. Sistem menyusun tautan universal WhatsApp dengan pesan pembuka khusus konsultasi dan mengalihkan peramban pelanggan.
5. WhatsApp terbuka; pelanggan mengirimkan pesan pembuka dan melampirkan berkas foto referensi rangkaian bunga dari galeri ponselnya.
6. Pelanggan menginfokan preferensi warna, perkiraan budget, tanggal acara, dan alamat delivery di Samarinda.
7. Florist meninjau foto referensi, memeriksa ketersediaan tangkai bunga di butik fisik, dan menawarkan rincian komposisi beserta penawaran harga.
8. Pelanggan menyetujui penawaran harga dan meminta nomor rekening resmi.
9. Florist memberikan nomor rekening, pelanggan mentransfer dan mengirimkan bukti transfer di chat.
10. Florist memverifikasi mutasi rekening, merangkai buket bunga, memotret hasil akhir untuk konfirmasi pelanggan, dan mengirimkan pesanan via kurir delivery.

### 3.2 Keunggulan Model Konsultasi WhatsApp Dibandingkan Web Upload
- **Kenyamanan Pengguna:** Pelanggan tidak dibatasi oleh batasan ukuran berkas form web atau batas format gambar kaku.
- **Interaktivitas Dua Arah:** Rangkaian buket bunga custom membutuhkan konsultasi dinamis (misal: alternatif warna mawar jika warna tertentu kosong). Diskusi via chat jauh lebih cepat dan humanis dibanding formulir web kaku.
- **Beban Infrastruktur Ringan:** Server website tidak dibebani oleh penyimpanan ribuan berkas foto referensi berukuran besar yang tidak menjadi aset resmi produk.

---

## 4. Kesimpulan
Task **ANA-004 (Activity Diagram Konsultasi Personalisasi Fleksibel)** telah selesai direvisi. Alur menempatkan website sebagai media kurasi informasi dan pengantar konsultasi, sedangkan negosiasi kreatif dan penetapan harga diselesaikan secara luwes di WhatsApp.
>>>>>>> c202b49 (Revise documentation and initial implementation)
