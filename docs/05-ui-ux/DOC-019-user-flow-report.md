# LAPORAN PENYUSUNAN USER FLOW & ARSITEKTUR NAVIGASI (USER FLOW REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-019  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.4 Technical Documentation)  
**Penanggung Jawab:** Riya Monika (UI/UX Designer) & Jayanti Firdasari (System Analyst)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026)  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [user-flow.md](file:///c:/Users/jayan/Documents/buketbunga/buketbunga/user-flow.md) (Versi 1.1 — Penyelarasan Paradigma WhatsApp Hand-off & Zero-Checkout)  

---

## 1. Ringkasan Eksekutif

Penyusunan dan audit dokumen master `user-flow.md` (Task DOC-019) telah selesai diselaraskan dengan kebutuhan sistem terbaru. Dokumen ini menjadi pedoman resmi arsitektur navigasi, peta situs (*sitemap*), serta alur interaksi pengguna (*user flow pathways*) untuk seluruh modul publik dan administratif website **BLOOMÉ — Flowers & Stories**.

Berdasarkan keputusan bisnis terbaru, seluruh alur pemesanan *e-commerce checkout*, penyimpanan transaksi di database, instruksi/verifikasi pembayaran transfer bank di website, siklus status pesanan (ST-01 s/d ST-08), serta pengajuan pembatalan melalui website telah **dihapus sepenuhnya dari sistem**.

Sebagai gantinya, arsitektur interaksi pengguna dialihkan ke paradigma **Katalog Interaktif, Personalisasi Buket, dan WhatsApp Hand-off / Zero-Checkout**. Pelanggan menelusuri katalog, memilih opsi personalisasi dan add-on, meninjau estimasi harga *real-time*, dan meneruskan rincian pesanan secara manual ke WhatsApp resmi BLOOMÉ. Seluruh transaksi moneter, konfirmasi pembayaran, dan koordinasi pengiriman delivery berlangsung langsung di dalam obrolan WhatsApp.

---

## 2. Peta Situs & Arsitektur Informasi (Sitemap & Information Architecture)

Struktur pohon halaman website BLOOMÉ memisahkan domain publik tanpa autentikasi dengan domain administratif tunggal terproteksi:

```mermaid
graph TD
    subgraph Public_Domain ["Ranah Publik (Customer — Tanpa Login / Guest)"]
        Home["1. Beranda (Home)"]
        Catalog["2. Katalog Produk"]
        Detail["3. Detail Produk & Stok"]
        Personalize["4. Personalisasi & Add-on"]
        Summary["5. Ringkasan & Estimasi Harga"]
        WAHandOff["6. WhatsApp Hand-off (wa.me)"]
        Consultation["7. Konsultasi Fleksibel (wa.me)"]
        About["8. Tentang Kami & Info Butik"]
        Contact["9. Kontak Resmi Samarinda"]

        Home --> Catalog
        Home --> About
        Home --> Contact
        Home --> Consultation
        Catalog --> Detail
        Detail --> Personalize
        Personalize --> Summary
        Summary --> WAHandOff
    end

    subgraph Admin_Domain ["Ranah Admin (Protected: auth:admin — Nabila Febriyani)"]
        Login["A. Login Admin"]
        Dashboard["B. Dashboard Statistik Katalog"]
        CatMgmt["C. Manajemen Kategori"]
        ProdMgmt["D. Manajemen Produk & Foto"]
        StockToggle["E. Toggle Ketersediaan Stok"]
        OptMgmt["F. Manajemen Opsi Personalisasi"]
        AddonMgmt["G. Manajemen Add-on"]
        Settings["H. Pengaturan Kontak & Bisnis"]

        Login --> Dashboard
        Dashboard --> CatMgmt
        Dashboard --> ProdMgmt
        Dashboard --> StockToggle
        Dashboard --> OptMgmt
        Dashboard --> AddonMgmt
        Dashboard --> Settings
    end
```

---

## 3. Rincian Alur Interaksi Pengguna (User Interaction Flows)

### 3.1 User Flow 1: Eksplorasi Katalog, Personalisasi, dan Pemesanan via WhatsApp
Alur utama pelanggan mulai dari penelusuran katalog hingga penyusunan draf pemesanan ke WhatsApp:

```mermaid
flowchart TD
    Start([Pelanggan Mengakses Website]) --> Home[Buka Beranda]
    Home --> BrowseCatalog[Akses Menu Katalog Produk]
    BrowseCatalog --> FilterCat{Filter Kategori?}
    FilterCat -- Ya --> FilteredView[Tampil Produk Kategori Terpilih]
    FilterCat -- Tidak --> AllView[Tampil Seluruh Koleksi Buket]
    FilteredView --> SelectProduct[Pilih Kartu Buket]
    AllView --> SelectProduct
    
    SelectProduct --> ViewDetail[Buka Halaman Detail Produk]
    ViewDetail --> CheckStock{Ketersediaan Produk?}
    CheckStock -- Stok Habis --> OutOfStockView[Tombol 'Stok Habis' Nonaktif]
    
    CheckStock -- Tersedia --> PersonalizeStep[Pilih Opsi Personalisasi: Kertas Wrapping & Pita]
    PersonalizeStep --> GreetingStep[Tulis Pesan Kartu Ucapan & Catatan Khusus]
    GreetingStep --> AddonStep[Pilih Item Add-on: Cokelat, Boneka, Lampu LED]
    
    AddonStep --> LiveCalc[Client-Side JS Menghitung Live Estimasi Harga]
    LiveCalc --> ReviewSummary[Tinjau Panel Ringkasan Pilihan & Estimasi Total]
    ReviewSummary --> ClickWA[Klik Tombol 'Pesan via WhatsApp']
    
    ClickWA --> BuildURL[WhatsApp URL Builder Menyusun Pesan Terstruktur & Encode RFC 3986]
    BuildURL --> RedirectWA[Arahkan Browser ke https://wa.me/628xxx]
    RedirectWA --> OpenApp[Aplikasi WhatsApp Terbuka dengan Prefilled Message]
    OpenApp --> ManualSend[Pelanggan Menekan Tombol 'Kirim' Manual di Chat]
    
    ManualSend --> WAConversation[Obrolan dengan CS/Florist BLOOMÉ]
    WAConversation --> Finalize[Konfirmasi Total Akhir Termasuk Ongkir, Transfer Bank & Jadwal Pengiriman]
    Finalize --> End([Transaksi Selesai di WhatsApp])
```

#### Karakteristik Utama Alur 1:
1. **Tanpa Akun Pengguna:** Pelanggan tidak perlu melakukan registrasi atau login untuk merancang buket dan memesan.
2. **Kalkulasi Transparan:** Estimasi harga buket dan add-on langsung terlihat di sisi klien secara interaktif sebelum pengguna beralih ke WhatsApp.
3. **Penyusunan Pesan Otomatis:** Sistem merangkai teks pemesanan terstruktur (nama produk, warna wrapping, kartu ucapan, daftar add-on, catatan, dan estimasi subtotal).
4. **Pemberitahuan Sadar (Explicit Consent):** Website menampilkan notifikasi bahwa pesanan belum resmi tercatat sebelum pelanggan menekan tombol kirim di WhatsApp.

---

### 3.2 User Flow 2: Konsultasi Personalisasi Fleksibel via WhatsApp
Alur bagi pelanggan yang menginginkan buket kustom di luar opsi standar katalog:

```mermaid
flowchart TD
    Start([Pelanggan Ingin Buket Kustom]) --> Landing[Akses Beranda / Kontak / Banner Konsultasi]
    Landing --> ClickConsult[Klik Tombol 'Konsultasi Buket Custom via WhatsApp']
    ClickConsult --> BuildConsultMsg[Sistem Membuka WhatsApp dengan Template Pertanyaan Florist]
    BuildConsultMsg --> OpenWAChat[Aplikasi WhatsApp Terbuka ke Nomor CS BLOOMÉ]
    OpenWAChat --> SendInquiry[Pelanggan Mengirim Pesan & Foto Referensi Langsung di Chat]
    SendInquiry --> FloristDiscuss[Florist Meninjau Ketersediaan Bunga & Memberikan Penawaran Harga]
    FloristDiscuss --> Deal[Persetujuan Harga & Eksekusi Pesanan di WhatsApp]
    Deal --> End([Selesai di WhatsApp])
```

#### Karakteristik Utama Alur 2:
- Menghilangkan formulir custom rumit dan fitur dropzone upload foto di website publik. Pelanggan mengirimkan foto referensi buket langsung melalui chat WhatsApp, memberikan kenyamanan percakapan natural dan fleksibilitas konsultasi artisan.

---

### 3.3 User Flow 3: Alur Kerja Harian Administrator
Alur kerja pemilik butik / administrator tunggal (Nabila Febriyani):

```mermaid
flowchart TD
    StartAdmin([Admin Akses URL Login]) --> LoginForm[Input Email & Password]
    LoginForm --> ValidateCred{Kredensial Valid?}
    ValidateCred -- Gagal --> ShowError[Pesan Error & Hitung Rate Limiting]
    ShowError --> LoginForm
    
    ValidateCred -- Berhasil --> Dashboard[Masuk Dashboard Statistik Katalog]
    
    Dashboard --> ActionChoice{Pilihan Pengelolaan?}
    
    ActionChoice -- Ketersediaan Stok --> ToggleStock[Ubah Status Stok Buket: Tersedia / Habis]
    ActionChoice -- Kelola Produk --> ProdCRUD[Tambah / Ubah / Hapus Produk & Upload Foto Buket]
    ActionChoice -- Kelola Kategori --> CatCRUD[Kelola Kategori Produk]
    ActionChoice -- Kelola Personalisasi --> OptCRUD[Kelola Pilihan Warna Wrapping & Pita]
    ActionChoice -- Kelola Add-on --> AddonCRUD[Kelola Item Add-on & Harga Tambahan]
    ActionChoice -- Pengaturan Bisnis --> SettingCRUD[Perbarui Nomor WhatsApp CS & Jam Operasional]
    
    ToggleStock --> SaveDB[(Update Database MySQL)]
    ProdCRUD --> SaveDB
    CatCRUD --> SaveDB
    OptCRUD --> SaveDB
    AddonCRUD --> SaveDB
    SettingCRUD --> SaveDB
    
    SaveDB --> FlashSuccess[Tampil Notifikasi Sukses]
    FlashSuccess --> Dashboard
    
    Dashboard --> Logout[Klik Logout Aman]
    Logout --> EndAdmin([Sesi Berakhir])
```

---

## 4. Batas Sistem yang Jelas (System Demarcation: Website vs. WhatsApp)

| Aspek Alur / Proses | Ranah Website BLOOMÉ | Ranah Ekosistem WhatsApp |
|---|---|---|
| **Katalog & Portofolio** | Menampilkan katalog produk, foto resolusi tinggi, filter kategori, dan status stok. | Tidak tersedia (hanya menerima tautan produk jika dibagikan). |
| **Personalisasi & Add-on**| Konfigurator interaktif (wrapping, pita, pesan kartu ucapan, pilihan add-on). | Ruang klarifikasi jika ada permintaan khusus tambahan. |
| **Estimasi Biaya** | Menghitung live subtotal produk + add-on di browser klien. | Mengonfirmasi total akhir resmi (termasuk ongkos kirim delivery). |
| **Penyusunan Pesan** | Merangkai draf pesan rapi dan menyematkan parameter URL `wa.me`. | Pelanggan membaca dan menekan tombol kirim manual. |
| **Transaksi & Checkout** | **TIDAK ADA.** Tidak ada form checkout atau penyimpanan order di web. | Seluruh transaksi, invoice transfer, dan instruksi rekening di WA. |
| **Pembayaran & Verifikasi**| **TIDAK ADA.** Tidak ada payment gateway atau upload bukti transfer. | Pelanggan mengirimkan bukti transfer via chat; diverifikasi langsung oleh owner. |
| **Pelacakan Pesanan** | **TIDAK ADA.** Website tidak melacak siklus pesanan. | Pelanggan mendapat update foto progres rangkaian buket langsung dari florist di WA. |
| **Koordinasi Delivery** | Menampilkan informasi area layanan kota Samarinda. | Mengatur alamat lengkap pengantaran dan konfirmasi waktu tiba kurir delivery. |

---

## 5. Protokol Penanganan Kasus Batas (Edge Cases Handling)

1. **Kasus Produk Habis Stok (`is_available = false`):**
   - Tombol *"Pesan via WhatsApp"* otomatis dinonaktifkan (`disabled`) dan digantikan teks *"Stok Habis"*.
   - Pelanggan diberikan tombol alternatif: *"Tanyakan Ketersediaan via WhatsApp"* yang mengarah ke chat CS dengan pesan otomatis menanyakan jadwal *restock*.
2. **Karakter Khusus pada Pesan Kartu Ucapan:**
   - Masukan kartu ucapan disaring dan di-*encode* menggunakan format RFC 3986 (`encodeURIComponent`) sehingga karakter baris baru (*enter*), tanda baca, dan emoji dapat terkirim sempurna ke WhatsApp tanpa tautan rusak.
3. **Kendala Aplikasi WhatsApp pada Perangkat Desktop:**
   - Jika pengguna mengakses via browser desktop dan aplikasi WhatsApp Desktop tidak terpasang, tautan diarahkan ke `https://web.whatsapp.com/send?phone=...` dengan pesan instruktif.
   - Halaman kontak selalu mencantumkan nomor WhatsApp resmi dalam bentuk teks agar pelanggan dapat menyimpan kontak secara manual.
4. **Sesi Admin Kedaluwarsa (*Session Timeout*):**
   - Jika sesi login admin kedaluwarsa saat sedang menginput data, sistem mengamankan aksi dan mengarahkan kembali ke halaman login dengan pesan notifikasi ramah tanpa menyebabkan server crash.

---

## 6. Kesimpulan & Status Verifikasi

### 6.1 Status Task DOC-019
Task **DOC-019 (Menyusun & Menyelaraskan user-flow.md)** dinyatakan **SELESAI 100%**:
- Seluruh alur pengguna telah merefleksikan model *Interactive Catalog & WhatsApp Hand-off*.
- Seluruh jejak alur *e-commerce checkout*, verifikasi pembayaran manual di website, siklus pesanan web, dan pembatalan web telah dibersihkan secara komprehensif.
- Arsitektur navigasi publik dan kontrol administratif tunggal terpetakan secara logis dan siap diimplementasikan ke dalam rute dan tampilan Blade.

### 6.2 Hal yang Memerlukan Konfirmasi Owner `[Perlu Konfirmasi Owner]`:
1. **Pola Konsultasi Buket Custom:** Format pesan template default untuk tombol "Konsultasi Buket Custom via WhatsApp" perlu disepakati dengan Nabila Febriyani agar sesuai dengan gaya komunikasi butik BLOOMÉ.
2. **Penentuan Kebijakan Delivery Samarinda:** Apakah rincian kecamatan / estimasi ongkir diinformasikan secara ringkas di website (misal: "Pengiriman khusus area Samarinda"), atau dikonfirmasi seutuhnya di chat WhatsApp.
