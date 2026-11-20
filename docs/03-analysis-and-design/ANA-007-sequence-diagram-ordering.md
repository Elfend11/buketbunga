<<<<<<< HEAD
# SEQUENCE DIAGRAM EKSPLORASI KATALOG, PERSONALISASI, DAN HAND-OFF PEMESANAN WHATSAPP
=======
# SEQUENCE DIAGRAM KATALOG, PERSONALISASI, DAN WHATSAPP URL BUILDER
>>>>>>> c202b49 (Revise documentation and initial implementation)
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-007  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
<<<<<<< HEAD
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-003, ANA-004, ARC-001 (Three-Layer Architecture), ARC-005 (Routing Architecture)  
=======
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001, ANA-002, ANA-003 (Selesai Final)  
>>>>>>> c202b49 (Revise documentation and initial implementation)

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

<<<<<<< HEAD
Pemodelan Sequence Diagram Alur Pemesanan dan Personalisasi (Task ANA-007) disusun untuk memetakan interaksi temporal antar-objek (*message exchange lifecycle*) secara runut dan presisi pada website **BLOOMÉ — Flowers & Stories**. Pemodelan ini menerapkan pendekatan *Object-Oriented Analysis and Design* (OOAD) yang disinkronkan dengan arsitektur tiga lapis (*Three-Layer Architecture*: Presentation, Application, dan Data Layer) berbasis framework Laravel.

Berdasarkan kesepakatan final tim (Konsep Sistem v1.1), **website BLOOMÉ berfungsi sebagai katalog interaktif dan media konfigurasi personalisasi buket bunga, sedangkan proses pemesanan resmi, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**. 

Dengan demikian, diagram sekuensial ini memodelkan tiga siklus interaksi inti:
1. **Eksplorasi Katalog & Filter Kategori:** Alur penelusuran buket aktif berdasarkan kategori bunga, uang, atau snack dari basis data.
2. **Detail Buket, Konfigurasi Personalisasi & Live Price Estimation:** Pemuatan galeri multi-foto, pemilih visual warna (*color swatches*), penambahan item add-on, dan kalkulasi subtotal otomatis di antarmuka pengguna tanpa pemuatan ulang halaman.
3. **Penyusunan Pesan Otomatis & Direct WhatsApp Hand-off:** Mekanisme pembentukan draf teks pemesanan terstruktur rapi, pengambilan nomor kontak toko dari `business_settings`, dan pengalihan ke WhatsApp melalui protokol `wa.me`, di mana pelanggan menekan tombol kirim secara manual. **Website tidak menyimpan transaksi pesanan di basis data web.**

---

## 2. Identifikasi Partisipan & Lifeline Objek

| Partisipan / Lifeline | Layer Arsitektur | Tipe Komponen | Peran & Tanggung Jawab Utama |
|---|---|---|---|
| **Customer (Guest)** | Aktor Eksternal | Pengguna | Mengakses katalog tanpa login, memilih buket, memilih warna wrapping/pita, memilih add-on, mengetik pesan ucapan, menekan tombol pesan, dan mengirim pesan manual di WhatsApp. |
| **Blade Views (`resources/views/`)** | Presentation Layer | UI / View | Merender antarmuka katalog (`catalog.blade.php`), halaman detail produk (`product-detail.blade.php`), komponen swatch warna, dan kartu ringkasan estimasi live. |
| **Frontend Script (Live Calc & WA Builder)** | Presentation Layer | JavaScript Module | Menghitung estimasi subtotal secara real-time di browser pengguna dan merangkai teks pesan draf pemesanan terformat rapi. |
| **Web Router (`routes/web.php`)** | Application Layer | HTTP Routing | Menerima request HTTP GET publik untuk rute beranda, katalog, dan detail buket. |
| **Catalog / Product Controllers** | Application Layer | Controllers | Mengorkestrasi pemanggilan data kategori, produk aktif, galeri foto, opsi personalisasi, dan add-on dari Eloquent models. |
| **Eloquent Models (`App\Models\`)** | Data Layer | ORM Entities | Model entitas: `Category`, `Product`, `ProductImage`, `PersonalizationOption`, `PersonalizationValue`, `AddOn`, dan `BusinessSetting`. |
| **MySQL Database Engine** | Data Layer | RDBMS | Menyediakan data master etalase terindeks secara cepat (*response time* < 1 detik). |
| **WhatsApp App (External)** | Saluran Eksternal | External Channel | Menerima tautan `wa.me` dan menampilkan draf pesan pemesanan di antarmuka chat WhatsApp pelanggan. |
| **Florist (Nabila Febriyani)** | Aktor Eksternal | Pemilik Usaha | Menerima pesan pemesanan di ponsel butik, mengecek stok fisik bunga, menyepakati harga final, menerima transfer bayar, dan mengatur pengiriman. |

---

## 3. Sequence Diagram Alur Eksplorasi Katalog & Personalisasi Buket
=======
Pemodelan Diagram Sekuensial Katalog, Personalisasi, dan WhatsApp URL Builder (Task ANA-007) memetakan interaksi temporal antar-objek (*message sequence*) dalam proses pemilihan buket bunga, konfigurasi personalisasi, pemilihan add-on, kalkulasi estimasi harga di sisi klien, hingga perakitan URL WhatsApp pada website **BLOOMÉ — Flowers & Stories**.

Pada versi lama, dokumen ini memodelkan transaksi database `DB::transaction()` yang membuat record pada tabel `orders` dan `order_details`. Pada revisi final ini, pemodelan disesuaikan dengan arsitektur **Zero-Checkout & WhatsApp Hand-off**:
- Seluruh konfigurasi diproses secara interaktif di sisi klien (didukung data produk dan add-on dari server).
- Sistem tidak menerbitkan transaksi basis data resmi pada website.
- Akhir dari alur adalah kompilasi parameter pesan terformat dan eksekusi tautan `https://wa.me/`.

---

## 2. Sequence Diagram: Eksplorasi, Personalisasi & Pembangkitan URL WhatsApp
>>>>>>> c202b49 (Revise documentation and initial implementation)

```mermaid
sequenceDiagram
    autonumber
    actor C as Customer (Guest)
<<<<<<< HEAD
    participant V as Blade View (catalog/detail)
    participant JS as Frontend Live Calculator & WA Builder
    participant R as Web Router (routes/web.php)
    participant Ctrl as ProductController
    participant Mod as Eloquent Models (Product, Category, Options, AddOns)
    participant DB as MySQL Database
    participant WA as WhatsApp App (External)
    actor F as Florist Owner (Nabila)

    %% ==========================================
    %% FASE 1: Eksplorasi Katalog & Filter Produk
    %% ==========================================
    Note over C,DB: FASE 1: Menjelajahi Katalog & Filter Kategori
    C->>V: Buka Halaman Katalog (/katalog?kategori=buket-bunga)
    activate V
    V->>R: GET /katalog?kategori=buket-bunga
    activate R
    R->>Ctrl: index(Request $request)
    activate Ctrl
    Ctrl->>Mod: Category::where('slug', 'buket-bunga')->first()
    activate Mod
    Mod->>DB: SELECT * FROM categories WHERE slug = ?
    activate DB
    DB-->>Mod: Record Category
    deactivate DB
    Mod-->>Ctrl: Category instance
    deactivate Mod

    Ctrl->>Mod: Product::with('primaryImage')->where('is_available', 1)->get()
    activate Mod
    Mod->>DB: SELECT * FROM products JOIN product_images ...
    activate DB
    DB-->>Mod: Recordset Products
    deactivate DB
    Mod-->>Ctrl: Collection $products
    deactivate Mod

    Ctrl-->>V: Render View 'catalog.index' ($products, $categories)
    deactivate Ctrl
    V-->>C: Tampilkan grid kartu buket bunga siap pesan
    deactivate V

    %% ==========================================
    %% FASE 2: Detail Produk & Konfigurasi Visual
    %% ==========================================
    Note over C,DB: FASE 2: Buka Detail Buket, Konfigurasi Personalisasi & Add-on
    C->>V: Klik salah satu buket (e.g. "Rose Romance Deluxe")
    activate V
    V->>R: GET /produk/rose-romance-deluxe
    activate R
    R->>Ctrl: show($slug)
    activate Ctrl
    Ctrl->>Mod: Product::with(['images', 'personalizationOptions.values', 'addOns'])->where('slug', $slug)->firstOrFail()
    activate Mod
    Mod->>DB: Eager load product, product_images, options, values, add_ons
    activate DB
    DB-->>Mod: Data lengkap produk & relasi
    deactivate DB
    Mod-->>Ctrl: Product instance lengkap
    deactivate Mod

    Ctrl-->>V: Render View 'products.show' ($product)
    deactivate Ctrl
    V-->>C: Tampilkan slider galeri foto, harga dasar (e.g. Rp 250.000), swatch warna, & add-on
    deactivate V

    %% ==========================================
    %% FASE 3: Interaksi Konfigurasi & Live Calc
    %% ==========================================
    Note over C,JS: FASE 3: Interaksi Personalisasi & Live Price Calculation
    C->>V: Pilih Swatch Warna Wrapping ("Blush Pink")
    V->>JS: updateOption('wrapping', 'Blush Pink', price=0)
    activate JS
    JS->>V: Update badge pilihan variasi pada kartu ringkasan
    deactivate JS

    C->>V: Centang Add-on "Kartu Ucapan Premium" (+Rp 10.000) & "Boneka Mini" (+Rp 25.000)
    V->>JS: addAddOn(['Kartu Ucapan', 'Boneka Mini'], totalAddon=35000)
    activate JS
    JS->>V: Update daftar add-on pada kartu ringkasan
    deactivate JS

    C->>V: Ketik teks ucapan ("Happy Graduation Sahabatku!")
    V->>JS: setGreetingMessage("Happy Graduation Sahabatku!")

    activate JS
    JS->>JS: calculateTotal() => Rp 250.000 + Rp 0 + Rp 35.000 = Rp 285.000
    JS->>V: Tampilkan estimasi subtotal live: "Rp 285.000"
    deactivate JS
    V-->>C: Pelanggan melihat ringkasan lengkap & estimasi harga live

    %% ==========================================
    %% FASE 4: WhatsApp Generator & Hand-off
    %% ==========================================
    Note over C,F: FASE 4: Generator Pesan Otomatis & Direct WhatsApp Hand-off
    C->>V: Klik tombol "Pesan via WhatsApp"
    activate V
    V->>JS: triggerWhatsAppOrder()
    activate JS

    Note over JS: Susun pesan draf baku: Produk, Variasi, Add-on, Ucapan, Estimasi
    JS->>JS: buildOrderMessage(product, options, addons, message, estimatedTotal)
    JS->>JS: encodeURIComponent(message)
    JS->>V: window.open("https://wa.me/6281234567890?text=" + encodedText, "_blank")
    deactivate JS
    deactivate V

    Note over V,WA: *TIDAK ADA penyimpanan pesanan ke basis data web (Hand-off Murni)*

    V->>WA: Buka tab / aplikasi WhatsApp dengan draf pesan siap kirim
    activate WA
    WA-->>C: Tampilkan obrolan chat BLOOMÉ dengan draf pesan lengkap
    deactivate WA

    C->>WA: Tekan tombol "Kirim" (*Send*) secara manual
    activate WA
    WA->>F: Pesan pemesanan diterima di ponsel pemilik butik
    deactivate WA
    activate F
    F-->>C: Balas chat WhatsApp: Konfirmasi ketersediaan bunga segar, nomor rekening transfer, & jadwal kurir Samarinda
    deactivate F
=======
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
>>>>>>> c202b49 (Revise documentation and initial implementation)
```

---

<<<<<<< HEAD
## 4. Analisis Alur & Penegasan Batas Sistem (System Demarcation)

### 4.1 Peniadaan Transaksi Basis Data Web pada Alur Pemesanan
1. **Zero Database Write on Order:** Pada alur pemesanan pelanggan, sistem web hanya melakukan operasi baca (`SELECT`) terhadap tabel `products`, `product_images`, `personalization_options`, `personalization_values`, `add_ons`, dan `business_settings`.
2. **Tidak Ada Tabel `orders` atau `customers`:** Data konfigurasi buket dan identitas pelanggan diolah secara murni di sisi memori antarmuka (*client-side state*) dan diteruskan ke WhatsApp melalui parameter URL `wa.me`. Hal ini menjamin privasi pengguna tanpa risiko kebocoran data transaksi di web.
3. **Penyusunan Pesan Terformat:** Teks pesan yang dihasilkan memuat struktur lengkap:
   ```text
   Halo BLOOMÉ Flowers & Stories, saya ingin memesan buket:
   - Produk: Rose Romance Deluxe
   - Kertas Wrapping: Blush Pink
   - Pita: Satin Burgundy
   - Add-on: Kartu Ucapan Premium, Boneka Wisuda Mini
   - Ucapan Kartu: "Happy Graduation Sahabatku!"
   - Estimasi Harga Web: Rp 285.000
   Mohon konfirmasi ketersediaan bahan, total harga final, dan rekening pembayarannya. Terima kasih!
   ```

### 4.2 Alur di Luar Sistem Web (WhatsApp Operational Hand-off)
1. **Pengiriman Manual:** Pelanggan memiliki kendali penuh untuk meninjau kembali isi pesan di WhatsApp sebelum menekan tombol kirim. Website tidak mengklaim bahwa pesanan telah diterima hanya karena WhatsApp berhasil terbuka.
2. **Konfirmasi Personal oleh Florist:** Florist Nabila menanggapi pesan, memastikan bahan bunga segar siap dirangkai di butik Samarinda, menyampaikan nomor rekening resmi (BCA/BRI/Mandiri/E-Wallet), menyepakati opsi DP 50% `[Perlu Konfirmasi Owner]`, serta mengoordinasikan kurir pengantaran.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-007
Task **ANA-007 (Sequence Diagram Pemesanan Katalog & Personalisasi)** telah selesai diselaraskan:
- Seluruh objek transaksi backend lama (`CatalogOrderRequest`, `OrderController`, `OrderCodeGenerator`, `orders`, `order_details`, `order_status_histories`) telah dieliminasi.
- Interaksi Three-Layer difokuskan pada penyajian katalog, konfigurasi variasi visual swatch, kalkulasi harga live di frontend, dan WhatsApp hand-off murni.
- Kriteria penyelesaian terpenuhi 100%.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan sequence diagram alur koordinasi pembayaran via WhatsApp:
- **`ANA-008 — Sequence Diagram koordinasi pembayaran & verifikasi via WhatsApp.`**
=======
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
>>>>>>> c202b49 (Revise documentation and initial implementation)
