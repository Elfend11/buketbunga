# ACTIVITY DIAGRAM ALUR PEMBAYARAN & KONFIRMASI VIA WHATSAPP
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-005  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-003 & ANA-004 (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pembayaran (Task ANA-005) dilakukan untuk menggambarkan alur penyelesaian transaksi pembayaran, pengiriman bukti transfer, dan konfirmasi keabsahan dana oleh pemilik usaha (Nabila Febriyani) melalui saluran komunikasi WhatsApp untuk pesanan buket **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan arsitektur (ADR-04) dan aturan bisnis (**BR-010 & BR-011**), website BLOOMÉ:
- **TIDAK menyediakan payment gateway otomatis.**
- **TIDAK menyimpan mutasi atau rekaman pembayaran di basis data web.**
- **TIDAK menyediakan formulir unggah bukti transfer di dalam website.**

Sebaliknya, website hanya memberikan estimasi total harga di muka melalui kalkulator live. Seluruh penyampaian nomor rekening bank resmi, akun e-wallet, kesepakatan uang muka (DP 50%) `[Perlu Konfirmasi Owner]`, penyerahan bukti transfer, dan verifikasi mutasi riil diselesaikan secara personal melalui **WhatsApp**.

---

## 2. Diagram Aktivitas Pembayaran & Verifikasi via WhatsApp (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Dapatkan Ringkasan Estimasi Biaya di Website"]
        C2["Alihkan Pemesanan ke WhatsApp dengan Pesan Terformat"]
        C3["Kirim Pesan Pemesanan ke WhatsApp Resmi Toko"]
        C4["Terima Rincian Tagihan Final & Nomor Rekening dari Pemilik Toko"]
        C5["Pilih Metode Pembayaran:<br>- Transfer Bank (BCA / BRI / Mandiri)<br>- E-Wallet (DANA / GoPay)"]
        C6{"Pilih Skema Pembayaran?<br>[Perlu Konfirmasi Owner]"}
        C7["Lakukan Pembayaran DP 50% via M-Banking / E-Wallet"]
        C8["Lakukan Pembayaran Penuh (100% Lunas) via M-Banking"]
        C9["Ambil Tangkapan Layar (Screenshot) Resi Transfer"]
        C10["Kirimkan Berkas Resi Bukti Transfer ke Chat WhatsApp"]
        C11["Terima Konfirmasi Pembayaran Sah & Jadwal Pengiriman"]
        C12["Kirim Ulang Bukti Sah / Selesaikan Selisih Dana"]
    end

    %% System Swimlane (Boundary Line)
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1["Hitung Subtotal Estimasi Harga Real-Time"]
        S2["Sertakan Rincian Estimasi pada Parameter URL wa.me"]
        S3["Arahkan Pelanggan ke WhatsApp<br>*Batas Sistem Web Berakhir di Sini*"]
    end

    %% WhatsApp & Owner Swimlane (Outside Web)
    subgraph Lane_Owner ["Partisipan: WhatsApp & Pemilik Usaha (Nabila)"]
        W1["Terima Pesan Pemesanan Terformat di WhatsApp"]
        W2["Konfirmasi Ketersediaan Bahan Bunga & Jadwal Pengerjaan"]
        W3["Kirim Rincian Tagihan Resmi & Rekening Bank / E-Wallet"]
        W4["Sampaikan Aturan DP 50% & Waktu Pelunasan [Perlu Konfirmasi Owner]"]
        W5["Terima Berkas Foto / Screenshot Bukti Transfer di Chat"]
        W6["Buka Aplikasi Mobile Banking / E-Wallet Butik"]
        W7["Periksa Riwayat Mutasi Dana Masuk di M-Banking"]
        W8{"Apakah Dana Masuk & Nominal Sesuai?"}
        W9["Kirim Pesan Pembayaran Belum Masuk / Nominal Kurang"]
        W10["Kirim Pesan Konfirmasi: 'Pembayaran Sah / Lunas'"]
        W11["Catat Jadwal Pengerjaan & Siapkan Bunga Segar di Butik"]
    end

    %% Final Nodes
    EndSuccess((◎))
    EndRetry((◎))

    %% Connections across Swimlanes
    C1 --> S1
    S1 --> S2
    S2 --> S3
    S3 --> C2
    C2 --> C3
    C3 --> W1
    
    W1 --> W2
    W2 --> W3
    W3 --> W4
    W4 --> C4
    
    C4 --> C5
    C5 --> C6
    
    C6 -- "Opsi DP 50%" --> C7
    C6 -- "Opsi Lunas 100%" --> C8
    
    C7 --> C9
    C8 --> C9
    C9 --> C10
    C10 --> W5
    
    W5 --> W6
    W6 --> W7
    W7 --> W8
    
    W8 -- "Tidak Cocok / Belum Masuk" --> W9
    W9 --> C12
    C12 --> EndRetry
    
    W8 -- "Dana Masuk Sesuai" --> W10
    W10 --> W11
    W10 --> C11
    C11 --> EndSuccess
```

---

## 3. Penjelasan Keputusan Arsitektur & Operasional Pembayaran

### 3.1 Peniadaan Payment Gateway di Web
1. **Biaya & Kelayakan Skala Usaha:** Penggunaan payment gateway pihak ketiga (seperti Midtrans/Xendit) membebankan biaya transaksi tetap (*fixed fee*) per transaksi dan biaya penarikan berkala yang kurang efisien bagi butik artisan lokal beromzet UMKM di Samarinda.
2. **Kesesuaian dengan Sifat Bunga Segar:** Transaksi bunga segar tidak dapat diproses secara *instant auto-capture*. Florist wajib memastikan bunga mawar atau aster segar masih tersedia di pendingin butik sebelum menerima uang pelanggan. Jika uang terlanjur ditarik otomatis oleh gateway sementara bunga habis, proses *refund* resmi gateway memakan waktu berhari-hari dan mengecewakan pembeli.
3. **Kepercayaan Pelanggan Lokal:** Di Samarinda, pelanggan butik bunga personal terbiasa dan lebih merasa aman mentransfer langsung ke rekening bank lokal (BCA, BRI, Mandiri) atau dompet digital (DANA, GoPay) yang dipegang langsung oleh pemilik usaha.

### 3.2 Penanganan Bukti Transfer Manual di WhatsApp
1. **Verifikasi Humanis:** Pemilik usaha memeriksa mutasi rekening langsung melalui smartphone secara cepat tanpa birokrasi sistem.
2. **Fleksibilitas Uang Muka (DP 50%):** Memungkinkan pelanggan membayar uang muka terlebih dahulu untuk mengunci tanggal pengiriman pada musim wisuda atau hari perayaan, dengan pelunasan dilakukan sebelum buket diantar `[Perlu Konfirmasi Owner]`.
3. **Pemberian Tanda Terima:** Pemilik usaha dapat langsung memberikan konfirmasi penerimaan dana secara ramah melalui balasan chat WhatsApp.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task ANA-005
Task **ANA-005 (Activity Diagram Alur Pembayaran)** telah selesai diselaraskan:
- Seluruh gambaran transaksi pembayaran di website, tabel `payments`, dan tombol verifikasi di web admin telah dieliminasi.
- Alur pembayaran transfer manual, pengiriman bukti resi, dan verifikasi fisik di WhatsApp telah dimodelkan dengan batas sistem yang jelas.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram aktivitas pembatalan pesanan via WhatsApp:
- **`ANA-006 — Activity Diagram alur pengajuan & penanganan pembatalan via WhatsApp.`**
