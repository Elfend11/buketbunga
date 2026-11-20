<<<<<<< HEAD
# SEQUENCE DIAGRAM ALUR KOORDINASI PEMBAYARAN DAN KESEPAKATAN HARGA VIA WHATSAPP
=======
# SEQUENCE DIAGRAM KOMPILASI PESAN WHATSAPP & PARAMETER PEMESANAN
>>>>>>> c202b49 (Revise documentation and initial implementation)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-008  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-005, ANA-007, ARC-001 (Three-Layer Architecture)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001, ANA-003, ANA-007 (Selesai Final)  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

<<<<<<< HEAD
Pemodelan Sequence Diagram Koordinasi Pembayaran (Task ANA-008) disusun untuk memetakan secara runtut pertukaran pesan dinamis (*dynamic message sequence*) dalam siklus kesepakatan harga final, penyampaian nomor rekening resmi, pengiriman bukti resi transfer, dan konfirmasi keabsahan dana pada **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan arsitektur (ADR-04) dan aturan bisnis (**BR-010 & BR-011**), sistem BLOOMÉ menerapkan model **pembayaran transfer manual (Bank Transfer & E-Wallet)** yang dikomunikasikan secara langsung melalui **WhatsApp** dengan **verifikasi mutasi fisik oleh pemilik usaha (Nabila Febriyani)** tanpa ketergantungan payment gateway pihak ketiga.

Diagram ini menegaskan titik transisi:
1. **Peran Sistem Web:** Menyediakan estimasi harga live di muka dan meneruskan rincian konfigurasi ke WhatsApp. Sistem web tidak mencatat tagihan, tidak memproses transaksi, dan tidak memiliki formulir pembayaran.
2. **Peran Komunikasi WhatsApp:** Seluruh siklus transaksi riil (konfirmasi ketersediaan stok bunga segar, penetapan biaya ongkir kurir Samarinda, pengiriman nomor rekening BCA/BRI/Mandiri/E-Wallet, opsi DP 50% `[Perlu Konfirmasi Owner]`, penyerahan screenshot mutasi, dan konfirmasi lunas) terjadi di dalam saluran obrolan WhatsApp antara pembeli dan pemilik butik.

---

## 2. Identifikasi Partisipan & Lifeline Objek

| Partisipan / Lifeline | Ranah Operasional | Tipe Komponen | Peran & Tanggung Jawab Utama |
|---|---|---|---|
| **Customer (Guest)** | Sisi Pengguna | Aktor Manusia | Mengirim pesan pemesanan di WhatsApp, memilih rekening tujuan, melakukan transfer dana di m-banking, dan mengirim bukti resi di chat. |
| **Sistem Web BLOOMÉ** | Ranah Web | Sistem Informasi | Menyajikan estimasi harga awal dan mengalihkan pelanggan ke tautan WhatsApp resmi toko. |
| **WhatsApp App (External)** | Saluran Komunikasi | Aplikasi Eksternal | Media percakapan langsung tempat pesan draf dikirim, berkas foto bukti bayar dipertukarkan, dan komunikasi berlangsung. |
| **Aplikasi M-Banking / E-Wallet Pelanggan** | Ranah Keuangan | Aplikasi Eksternal | Sarana eksekusi pemindahan dana perbankan di luar sistem BLOOMÉ. |
| **Florist Owner (Nabila Febriyani)** | Sisi Toko | Aktor Manusia | Menerima pesan, memastikan ketersediaan bahan, mengirim rekening resmi, memverifikasi mutasi dana masuk, dan menyepakati jadwal kurir. |
| **Aplikasi M-Banking Resmi Butik** | Ranah Keuangan Toko | Aplikasi Eksternal | Sarana pemilik usaha memeriksa mutasi rekening bank masuk secara riil. |

---

## 3. Sequence Diagram Alur Koordinasi Pembayaran via WhatsApp
=======
Pemodelan Diagram Sekuensial Kompilasi Pesan WhatsApp (Task ANA-008) mendokumentasikan mekanisme transformasi data terstruktur dari formulir antarmuka pelanggan menjadi untaian teks pesan WhatsApp terenkoding (*encoded message payload*).

Pada rancangan versi lama, berkas ini memodelkan proses verifikasi transfer bank oleh admin di dashboard (*Task ANA-008 versi lama*). Karena alur pembayaran di website telah ditiadakan total, dokumen ini direkonstruksi penuh menjadi **Sequence Diagram Kompilasi Pesan WhatsApp & Parameter Pemesanan**. Diagram ini menjadi rujukan teknis utama bagi pengembang frontend dan backend dalam merancang generator pesan instan yang akurat, terstruktur, dan tidak terpotong saat diparsing oleh WhatsApp Web maupun WhatsApp Mobile.

---

## 2. Sequence Diagram: Kompilasi Pesan WhatsApp & Ekstraksi Parameter
>>>>>>> c202b49 (Revise documentation and initial implementation)

```mermaid
sequenceDiagram
    autonumber
    actor C as Customer (Guest)
<<<<<<< HEAD
    participant Web as Sistem Web BLOOMÉ
    participant WA as WhatsApp App (External)
    participant C_Bank as M-Banking / E-Wallet Pelanggan
    actor F as Florist Owner (Nabila)
    participant F_Bank as M-Banking Resmi Butik BLOOMÉ

    %% ==========================================
    %% TAHAP 1: Transisi dari Web ke WhatsApp
    %% ==========================================
    Note over C,WA: TAHAP 1: Pengalihan Estimasi dari Web ke Obrolan WhatsApp
    C->>Web: Selesaikan Konfigurasi Buket (Estimasi Harga Live: Rp 285.000)
    activate Web
    Web->>WA: Buka URL wa.me dengan Draf Pesan Ter-encode
    deactivate Web
    activate WA
    WA-->>C: Tampilkan Chat WhatsApp dengan Draf Rincian Pesanan
    deactivate WA

    C->>WA: Tekan Tombol Kirim Pesan secara Manual
    activate WA
    WA->>F: Pesan Rincian Pemesanan Masuk di WhatsApp Butik
    deactivate WA
    activate F

    %% ==========================================
    %% TAHAP 2: Konfirmasi Stok & Kesepakatan Tagihan
    %% ==========================================
    Note over C,F: TAHAP 2: Konfirmasi Stok Fisik & Penyampaian Tagihan Resmi
    F->>F: Periksa Ketersediaan Bunga Mawar Segar & Bahan Wrapping di Butik
    F-->>WA: Balas Chat: Konfirmasi Bunga Ready & Jadwal Pengerjaan
    activate WA
    WA-->>C: Pelanggan Menerima Balasan: Pesanan Dapat Dibuat
    deactivate WA

    F-->>WA: Kirim Rincian Tagihan Final + Biaya Ongkir Samarinda [Perlu Konfirmasi Owner]
    activate WA
    F-->>WA: Kirim Rekening Resmi (BCA/BRI/Mandiri/DANA a.n. Nabila Febriyani)
    F-->>WA: Informasikan Ketentuan DP 50% atau Lunas 100% [Perlu Konfirmasi Owner]
    WA-->>C: Pelanggan Menerima Tagihan Resmi & Pilihan Rekening
    deactivate WA
    deactivate F

    %% ==========================================
    %% TAHAP 3: Eksekusi Transfer & Penyerahan Resi
    %% ==========================================
    Note over C,F_Bank: TAHAP 3: Transfer Dana Manual di Luar Sistem & Penyerahan Resi
    C->>C_Bank: Buka Aplikasi Mobile Banking / E-Wallet
    activate C_Bank
    C->>C_Bank: Input Nomor Rekening Toko & Lakukan Transfer Dana (DP 50% / Lunas)
    C_Bank-->>C: Transaksi Sukses & Terbitkan Resi / Bukti Mutasi
    deactivate C_Bank

    C->>C: Ambil Screenshot Bukti Transfer
    C->>WA: Unggah & Kirim Gambar Bukti Resi Transfer ke Chat WhatsApp
    activate WA
    WA->>F: Bukti Resi Transfer Diterima di WhatsApp Toko
    deactivate WA
    activate F

    %% ==========================================
    %% TAHAP 4: Verifikasi Mutasi Rekening & Penjadwalan
    %% ==========================================
    Note over F,F_Bank: TAHAP 4: Verifikasi Mutasi Fisik & Konfirmasi Pesanan Sah
    F->>F_Bank: Buka Aplikasi M-Banking Butik BLOOMÉ
    activate F_Bank
    F->>F_Bank: Cek Riwayat Mutasi Rekening Masuk
    F_Bank-->>F: Data Mutasi Masuk Terlihat & Nominal Cocok
    deactivate F_Bank

    F-->>WA: Kirim Pesan Konfirmasi: "Pembayaran Sah / Lunas Diterima!"
    activate WA
    F-->>WA: Informasikan: Buket Akan Dirangkai Tepat Waktu & Jadwal Pengiriman
    WA-->>C: Pelanggan Menerima Konfirmasi Resmi Pembayaran Telah Diterima
    deactivate WA
    deactivate F
=======
    participant UI as Form Interface (Blade/DOM)
    participant Parser as WhatsAppMessageParser
    participant Config as BusinessSettingProvider
    participant Encoder as UrlEncodingUtility
    participant Browser as Client Browser (Window Engine)
    actor Florist as Florist WhatsApp Inbox

    %% 1. Inisiasi Ekstraksi Data
    C->>UI: Klik Tombol "Pesan via WhatsApp"
    activate UI
    UI->>Parser: extractAndFormat(orderFormData)
    deactivate UI
    activate Parser

    %% 2. Penguraian & Validasi Komponen
    Note over Parser: 1. Baca Parameter Produk Utama
    Parser->>Parser: parseProduct(name, basePrice)
    
    Note over Parser: 2. Baca Pilihan Personalisasi
    Parser->>Parser: parsePersonalization(wrappingColor, ribbonColor)
    
    Note over Parser: 3. Baca Daftar Add-on Terpilih
    Parser->>Parser: parseAddOns(selectedItemsList, sumPrices)
    
    Note over Parser: 4. Baca Pesan Kartu Ucapan
    Parser->>Parser: parseGreetingMessage(cardMessageText)
    
    Note over Parser: 5. Baca Data Delivery
    Parser->>Parser: parseDelivery(deliveryDate, customerAddress)
    
    Note over Parser: 6. Hitung Total Estimasi Biaya
    Parser->>Parser: calculateEstimatedTotal(basePrice + addonsSubtotal)

    %% 3. Penyusunan Template Pesan Terstruktur
    Parser->>Parser: buildFormattedTemplateString()
    Note over Parser: Template Tersusun Bersih:<br>- Halo BLOOMÉ, saya ingin memesan buket:<br>- Produk: [Nama Produk] (Rp[Harga])<br>- Personalisasi: Wrapping [Warna] / Pita [Warna]<br>- Add-on: [Daftar Add-on] (+Rp[Total Addon])<br>- Pesan Kartu: "[Teks Ucapan]"<br>- Tanggal Delivery: [Tanggal]<br>- Alamat Delivery: [Alamat Samarinda]<br>- Total Estimasi: Rp[Total]<br>(*) Ongkos kirim dikonfirmasi florist.

    %% 4. Resolusi Nomor WhatsApp Tujuan
    Parser->>Config: getOfficialWhatsAppNumber()
    activate Config
    Config-->>Parser: Return "628xxxxxxxxxx" (Nomor Resmi Butik Samarinda)
    deactivate Config

    %% 5. Enkoding URL
    Parser->>Encoder: encodePayload(formattedText)
    activate Encoder
    Encoder->>Encoder: rawurlencode(text) -> Ubah enter ke %0A, spasi ke %20
    Encoder-->>Parser: Return encodedString
    deactivate Encoder

    %% 6. Pembentukan Tautan Universal
    Parser->>Parser: assembleUniversalUrl("https://wa.me/" + phone + "?text=" + encodedString)
    Parser-->>Browser: triggerRedirect(targetUrl)
    deactivate Parser

    %% 7. Peluncuran Aplikasi WhatsApp
    activate Browser
    Browser->>Browser: Evaluasi Perangkat (Mobile vs. Desktop)
    Browser->>C: Buka Aplikasi WhatsApp di Perangkat Pengguna
    deactivate Browser

    C->>Florist: Tekan Tombol Kirim di WhatsApp
    activate Florist
    Florist-->>C: Pesan Diterima Rapi di Chat Florist (Siap Dikonfirmasi)
    deactivate Florist
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

<<<<<<< HEAD
## 4. Analisis Batas Sistem & Keandalan Alur Pembayaran

### 4.1 Eliminasi Celah Keamanan Pembayaran pada Sistem Web
1. **Bebas Kerentanan Transaksi Web:** Karena website tidak memproses pembayaran, tidak ada risiko *SQL Injection* pada data transaksi, manipulasi parameter harga via HTTP request tampering, atau kebocoran kredensial pembayaran perbankan di sisi server website.
2. **Tidak Menyimpan Foto Resi di Server Web:** Bukti transfer berupa foto hanya dipertukarkan di dalam aplikasi WhatsApp yang terenkripsi secara *end-to-end* (E2EE), sehingga server web BLOOMÉ tidak memerlukan kapasitas penyimpanan besar untuk berkas pembayaran.
3. **Peniadaan Status Pesanan Fiktif:** Website tidak pernah menampilkan status *Paid* atau *Unpaid* yang dapat memicu kebingungan jika terdapat keterlambatan sinkronisasi data perbankan.

### 4.2 Prosedur Verifikasi Manual oleh Pemilik Usaha
1. **Validasi Mutasi Ganda (*Double-Check*):** Pemilik usaha tidak hanya melihat gambar resi yang dikirimkan pembeli (untuk mencegah resi palsu / editan), tetapi selalu memeriksa mutasi dana masuk secara langsung pada aplikasi perbankan resmi butik.
2. **Penanganan Kasus Transfer Kurang / Selisih:** Jika dana yang ditransfer tidak sesuai dengan kesepakatan tagihan, pemilik usaha dapat langsung memberitahukan selisih dana kepada pembeli di dalam ruang percakapan yang sama secara santun dan cepat.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-008
Task **ANA-008 (Sequence Diagram Pembayaran)** telah selesai diselaraskan:
- Seluruh objek backend pembayaran web lama (`PaymentController`, `PaymentConfirmRequest`, `PaymentVerifyRequest`, `payments`, `OrderStatusService`) telah dieliminasi.
- Interaksi pembayaran transfer bank, e-wallet, pengiriman resi, dan verifikasi mutasi rekening di WhatsApp telah dimodelkan dengan runtut.
- Kriteria penyelesaian terpenuhi 100%.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan sequence diagram untuk pengelolaan etalase produk dan pengaturan toko oleh admin:
- **`ANA-009 — Sequence Diagram pengelolaan etalase produk, galeri, dan pengaturan bisnis oleh admin.`**
=======
## 3. Spesifikasi Format Template Pesan WhatsApp

Template pesan yang dihasilkan wajib mematuhi format baku berikut agar mudah dibaca oleh florist:

```text
Halo BLOOMÉ, saya ingin memesan buket melalui website:

*Rincian Buket:*
- Produk: {product_name} (Rp{base_price})
- Warna Wrapping: {wrapping_color}
- Warna Pita: {ribbon_color}

*Add-on Tambahan:*
{list_of_addons_with_prices}

*Pesan Kartu Ucapan:*
"{greeting_message}"

*Jadwal & Tujuan Pengiriman (Delivery):*
- Tanggal Kebutuhan: {delivery_date}
- Alamat Delivery: {delivery_address}, Samarinda

*Total Estimasi Biaya:*
Rp{estimated_total}
*(Catatan: Biaya di atas belum termasuk tarif ongkos kirim kurir delivery yang akan dikonfirmasi oleh florist).*

Mohon konfirmasi ketersediaan bahan bunganya. Terima kasih!
```

---

## 4. Penanganan Karakter Khusus & Keamanan Parameter

1. **Pencegahan Teks Terpotong (*Text Truncation Defense*):**
   - Menggunakan fungsi enkoding `rawurlencode()` (standar RFC 3986) sehingga karakter tanda petik (`"`), garis miring (`/`), kurung `()`, dan simbol plus (`+`) tidak mengacaukan parameter URL.
2. **Sanitasi Masukan Pengguna (*Input Sanitization*):**
   - Teks pesan kartu ucapan yang diinputkan pengguna dibersihkan dari tag HTML (*strip tags*) dan karakter kontrol berbahaya sebelum dirangkai ke dalam template.
3. **Pemberian Label Transparan Ongkos Kirim:**
   - Parameter pesan secara eksplisit menyertakan catatan bahwa nominal total merupakan **estimasi biaya buket dan add-on**, sedangkan tarif ongkir kurir delivery dikonfirmasi manual florist sesuai jarak butik Samarinda ke alamat pemesan (`[Perlu Konfirmasi Owner]`).

---

## 5. Kesimpulan
Task **ANA-008 (Sequence Diagram Kompilasi Pesan WhatsApp)** telah selesai direvisi penuh. Mekanisme penguraian formulir, pemformatan template, dan perakitan tautan universal WhatsApp telah dimodelkan dengan presisi teknis tinggi.
>>>>>>> c202b49 (Revise documentation and initial implementation)
