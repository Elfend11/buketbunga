# SEQUENCE DIAGRAM KATALOG, PERSONALISASI, DAN WHATSAPP URL BUILDER
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-007  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001, ANA-002, ANA-003 (Selesai Final)  

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

Pemodelan Diagram Sekuensial Katalog, Personalisasi, dan WhatsApp URL Builder (Task ANA-007) memetakan interaksi temporal antar-objek (*message sequence*) dalam proses pemilihan buket bunga, konfigurasi personalisasi, pemilihan add-on, kalkulasi estimasi harga di sisi klien, hingga perakitan URL WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Pada versi lama, dokumen ini memodelkan transaksi database `DB::transaction()` yang membuat record pada tabel `orders` dan `order_details`. Pada revisi final ini, pemodelan disesuaikan dengan arsitektur **Zero-Checkout & WhatsApp Hand-off**:
- Seluruh konfigurasi diproses secara interaktif di sisi klien (didukung data produk dan add-on dari server).
- Sistem tidak menerbitkan transaksi basis data resmi pada website.
- Akhir dari alur adalah kompilasi parameter pesan terformat dan eksekusi tautan `https://wa.me/`.

---

## 2. Sequence Diagram: Eksplorasi, Personalisasi & Pembangkitan URL WhatsApp

```mermaid
sequenceDiagram
    autonumber
    actor C as Customer (Guest)
    participant V as Blade View (product-detail.blade.php)
    participant JS as Frontend Script (personalization.js)
    participant R as Web Router (routes/web.php)
    participant Ctrl as CatalogController
    participant Svc as WhatsAppPayloadBuilder
    participant Mod as Eloquent Models (Product, AddOn, Setting)
    participant DB as MySQL Database
    actor W as Florist (Aplikasi WhatsApp)

    %% 1. Eksplorasi Produk
    C->>V: Buka Halaman Detail Produk (/katalog/{slug})
    activate V
    V->>R: GET /katalog/{slug}
    deactivate V
    activate R
    R->>Ctrl: show($slug)
    deactivate R
    activate Ctrl
    
    Ctrl->>Mod: Product::with('category')->where('slug', $slug)->firstOrFail()
    activate Mod
    Mod->>DB: SELECT * FROM products WHERE slug = ?
    activate DB
    DB-->>Mod: Record Produk Aktif
    deactivate DB
    Mod-->>Ctrl: Instance $product
    deactivate Mod

    Ctrl->>Mod: AddOn::where('is_active', true)->get()
    activate Mod
    Mod->>DB: SELECT * FROM add_ons WHERE is_active = 1
    activate DB
    DB-->>Mod: Daftar Opsi Add-on
    deactivate DB
    Mod-->>Ctrl: Collection $addOns
    deactivate Mod

    Ctrl-->>V: Render View detail produk lengkap ($product, $addOns)
    deactivate Ctrl
    activate V
    V-->>C: Tampilkan Galeri Foto, Harga Dasar, dan Form Personalisasi
    deactivate V

    %% 2. Interaksi Personalisasi & Live Calculator
    Note over C,JS: Pelanggan Mengonfigurasi Buket di Antarmuka
    C->>JS: 1. Pilih Warna Wrapping (e.g. "Soft Pink") & Pita ("Cream")
    C->>JS: 2. Centang Add-on: "Boneka Wisuda" (+Rp35.000) & "Lampu LED" (+Rp15.000)
    C->>JS: 3. Tulis Pesan Kartu: "Happy Graduation, Sarah!"
    C->>JS: 4. Masukkan Tanggal Kebutuhan & Alamat Delivery Samarinda
    activate JS
    JS->>JS: Hitung Total Estimasi = Harga Dasar + Subtotal Add-on
    JS-->>V: Update Tampilan Ringkasan & Total Estimasi (e.g. Rp 300.000)
    deactivate JS
    activate V
    V-->>C: Panel Ringkasan Menampilkan Estimasi Biaya Terbaru
    deactivate V

    %% 3. Pemicuan Pemesanan ke WhatsApp
    C->>V: Klik Tombol "Pesan via WhatsApp"
    activate V
    V->>JS: Trigger handleOrderSubmit(formData)
    deactivate V
    activate JS

    JS->>JS: Validasi Kelengkapan Isian (Pesan kartu & Alamat delivery)
    
    alt Form Belum Lengkap (Alamat Kosong)
        JS-->>V: Tampilkan Alert Validasi: "Mohon lengkapi alamat pengiriman delivery"
        activate V
        V-->>C: Indikator merah pada kolom alamat
        deactivate V
    else Form Lengkap & Valid
        Note over JS,Svc: Susun Teks Pesan Terformat & URL Hand-off
        JS->>Svc: buildWhatsAppUrl(product, personalization, addons, address)
        activate Svc
        Svc->>Svc: Format Teks Pesan Rapi (Baris baru, nama buket, add-on, estimasi)
        Svc->>Svc: rawurlencode(formatted_text)
        Svc->>Mod: Ambil Nomor WhatsApp Resmi Butik dari Setting
        activate Mod
        Mod-->>Svc: Nomor Telepon (e.g. 6281234567890)
        deactivate Mod
        Svc-->>JS: Return full URL: "https://wa.me/6281234567890?text=..."
        deactivate Svc

        JS->>C: Redirect Peramban / Buka Aplikasi WhatsApp (window.open)
        deactivate JS

        %% 4. Hand-off ke Florist
        C->>W: Kirim Pesan Terformat Otomatis via WhatsApp
        activate W
        W-->>C: Florist Membalas di WhatsApp: Konfirmasi Ketersediaan & Ongkos Kirim
        deactivate W
    end
```

---

## 3. Rincian Teknis Komponen & Tanggung Jawab Objek

1. **`personalization.js` (Frontend State Manager):**
   - Mengelola status lokal antarmuka (*client-side reactive state*) saat pelanggan memilih kertas wrapping, warna pita, dan item add-on.
   - Menghitung secara instan nilai estimasi total tagihan sehingga pelanggan mendapatkan kepastian biaya sebelum berpindah ke WhatsApp.
2. **`WhatsAppPayloadBuilder`:**
   - Bertanggung jawab mengubah objek data formulir menjadi susunan pesan teks yang humanis dan terstruktur rapi.
   - Mengenkoding karakter khusus (`%0A` untuk enter/baris baru, `%20` untuk spasi) agar pesan tampil sempurna di aplikasi WhatsApp pelanggan.
3. **Peniadaan Transaksi Basis Data:**
   - Diagram ini membuktikan bahwa tidak ada operasi `INSERT INTO orders` atau manipulasi tabel pembayaran saat pelanggan mengklik tombol pesan. Integritas sistem tetap ringan dan bebas dari data transaksi menggantung (*abandoned checkout records*).

---

## 4. Kesimpulan
Task **ANA-007 (Sequence Diagram Katalog, Personalisasi & WhatsApp URL Builder)** telah selesai direvisi penuh. Interaksi objek secara eksplisit mengalirkan data pelanggan menuju gerbang hand-off WhatsApp tanpa melalui checkout database internal.
