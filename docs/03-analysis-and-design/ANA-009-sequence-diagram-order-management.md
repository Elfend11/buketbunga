# SEQUENCE DIAGRAM PENGELOLAAN MASTER KATALOG, KATEGORI, DAN ADD-ON OLEH ADMIN
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-009  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001, ANA-002, ANA-006 (Selesai Final)  

---

## 1. Ringkasan Eksekutif & Karakteristik Alur

Pemodelan Diagram Sekuensial Pengelolaan Master Katalog, Kategori, dan Add-on (Task ANA-009) memetakan interaksi temporal antar-objek dalam eksekusi operasional administrasi oleh pemilik usaha (**Nabila Febriyani**) pada dashboard terproteksi **BLOOMÉ — Flowers & Stories**.

Pada versi lama, berkas ini memodelkan siklus hidup transisi status transaksi pesanan (*ST-05 $\rightarrow$ ST-06 $\rightarrow$ ST-07*) dan persetujuan pembatalan pesanan di website (*Task ANA-009 versi lama*). Karena alur pesanan resmi, pelacakan, dan pembatalan telah dipindahkan sepenuhnya ke WhatsApp, dokumen ini direkonstruksi penuh menjadi **Sequence Diagram Pengelolaan Master Konten Etalase oleh Admin**, mencakup penambahan produk buket, unggah foto, pengubahan ketersediaan stok, dan manajemen tarif add-on.

---

## 2. Sequence Diagram: Pengelolaan Produk Buket, Foto, & Status Stok

Diagram berikut memodelkan dua interaksi utama: (A) Penambahan produk buket baru beserta unggah foto beresolusi tinggi, dan (B) Pembaruan cepat ketersediaan stok produk:

```mermaid
sequenceDiagram
    autonumber
    actor A as Admin (Nabila Febriyani)
    participant V as Blade View (admin/products)
    participant R as Web Router (routes/web.php)
    participant Mdw as AdminAuthMiddleware (auth:admin)
    participant Req as StoreProductRequest
    participant Ctrl as Admin\ProductController
    participant Stor as File Storage (Storage::disk)
    participant Mod as Eloquent Models (Product, Category)
    participant DB as MySQL Database

    %% ==========================================
    %% BAGIAN 1: Penambahan Produk & Unggah Foto
    %% ==========================================
    Note over A,DB: BAGIAN 1: Penambahan Produk Katalog Baru & Unggah Foto
    A->>V: Buka Form Tambah Produk & Isi Data (Nama, Kategori, Harga, Komposisi)
    A->>V: Unggah Berkas Foto Buket Resmi (JPG/PNG ≤ 5MB)
    A->>V: Klik Tombol "Simpan Produk"
    activate V
    V->>R: POST /admin/products (FormData Multipart Payload)
    deactivate V
    activate R
    R->>Mdw: Verifikasi Sesi Admin Aktif
    activate Mdw
    Mdw-->>R: Sesi Sah (Authenticated as Admin)
    deactivate Mdw
    R->>Req: Validasi Input & Berkas Foto
    deactivate R
    activate Req

    alt Validasi Gagal (Ukuran > 5MB atau Format Bukan Gambar)
        Req-->>V: 302 Redirect Back with Error Messages
        activate V
        V-->>A: Tampilkan pesan galat inline pada form
        deactivate V
    else Validasi Berhasil
        Req->>Ctrl: Form data valid & berkas gambar terverifikasi
        deactivate Req
        activate Ctrl

        Ctrl->>Stor: Simpan foto: putFile('products', $imageFile)
        activate Stor
        Stor-->>Ctrl: Return $imagePath (UUID sanitized filename)
        deactivate Stor

        Ctrl->>DB: DB::beginTransaction()
        activate DB

        Ctrl->>Mod: Product::create(category_id, name, slug, price, description, image_path, is_available=1)
        activate Mod
        Mod->>DB: INSERT INTO products
        DB-->>Mod: Record Produk Baru
        Mod-->>Ctrl: Instance $product
        deactivate Mod

        Ctrl->>DB: DB::commit()
        deactivate DB

        Ctrl-->>V: 302 Redirect with Flash: "Produk buket berhasil ditambahkan ke etalase"
        deactivate Ctrl
        activate V
        V-->>A: Produk baru tampil di daftar tabel dashboard & langsung aktif di katalog
        deactivate V
    end

    %% ==========================================
    %% BAGIAN 2: Toggle Ketersediaan Stok
    %% ==========================================
    Note over A,DB: BAGIAN 2: Pengubahan Cepat Status Stok Produk (In Stock / Out of Stock)
    A->>V: Klik Sakelar Toggle Ketersediaan pada Baris Produk
    activate V
    V->>R: PATCH /admin/products/{id}/toggle-stock
    activate R
    R->>Ctrl: toggleStock($id)
    deactivate R
    activate Ctrl

    Ctrl->>Mod: Product::findOrFail($id)
    activate Mod
    Mod->>DB: SELECT * FROM products WHERE id = ?
    activate DB
    DB-->>Mod: Instance $product
    deactivate DB
    Mod-->>Ctrl: Return $product
    deactivate Mod

    Ctrl->>Mod: $product->update(['is_available' => !$product->is_available])
    activate Mod
    Mod->>DB: UPDATE products SET is_available = 0/1 WHERE id = ?
    Mod-->>Ctrl: Success
    deactivate Mod

    Ctrl-->>V: JSON Response: {success: true, is_available: new_status}
    deactivate Ctrl
    V-->>A: Indikator status stok berubah secara instan (Badge Merah/Hijau)
    deactivate V
```

---

## 3. Sequence Diagram: Pengelolaan Opsi Add-on & Pembaruan Nomor WhatsApp

Diagram berikut memodelkan penambahan master add-on serta pembaruan nomor kontak WhatsApp butik:

```mermaid
sequenceDiagram
    autonumber
    actor A as Admin (Nabila Febriyani)
    participant V as Blade View (admin/addons & settings)
    participant R as Web Router (routes/web.php)
    participant CtrlAddon as Admin\AddOnController
    participant CtrlSetting as Admin\SettingController
    participant Mod as Eloquent Models (AddOn, Setting)
    participant DB as MySQL Database

    %% ==========================================
    %% BAGIAN 1: Penambahan Item Add-on Baru
    %% ==========================================
    Note over A,DB: BAGIAN 1: Penambahan Opsi Pelengkap / Add-on
    A->>V: Buka Menu Add-on & Input Data (Nama: "Boneka Teddy", Harga: 35000)
    A->>V: Klik "Simpan Add-on"
    activate V
    V->>R: POST /admin/addons
    deactivate V
    activate R
    R->>CtrlAddon: store(Request $request)
    deactivate R
    activate CtrlAddon

    CtrlAddon->>Mod: AddOn::create(name, price, is_active=1)
    activate Mod
    Mod->>DB: INSERT INTO add_ons
    DB-->>Mod: Record Add-on Tersimpan
    Mod-->>CtrlAddon: Instance $addOn
    deactivate Mod

    CtrlAddon-->>V: 302 Redirect with Flash: "Item add-on berhasil ditambahkan"
    deactivate CtrlAddon
    activate V
    V-->>A: Item baru langsung muncul di checklist personalisasi pelanggan
    deactivate V

    %% ==========================================
    %% BAGIAN 2: Pembaruan Nomor WhatsApp Resmi
    %% ==========================================
    Note over A,DB: BAGIAN 2: Pembaruan Nomor WhatsApp Resmi Butik Samarinda
    A->>V: Buka Pengaturan Bisnis & Input Nomor WhatsApp Baru ("6281234567890")
    A->>V: Klik "Perbarui Kontak WhatsApp"
    activate V
    V->>R: POST /admin/settings/whatsapp
    deactivate V
    activate R
    R->>CtrlSetting: updateWhatsApp(Request $request)
    deactivate R
    activate CtrlSetting

    CtrlSetting->>Mod: Setting::updateOrCreate(['key' => 'official_whatsapp'], ['value' => '6281234567890'])
    activate Mod
    Mod->>DB: UPDATE / INSERT INTO settings
    DB-->>Mod: Setting Updated
    Mod-->>CtrlSetting: Success
    deactivate Mod

    CtrlSetting-->>V: 302 Redirect with Flash: "Nomor WhatsApp pemesanan berhasil diperbarui"
    deactivate CtrlSetting
    activate V
    V-->>A: Nomor baru aktif di seluruh tautan redirect website pelanggan
    deactivate V
```

---

## 4. Rincian Teknis Komponen & Integritas Data

1. **Keamanan Berkas Foto Produk (`storage/app/public/products/`):**
   - Foto produk divalidasi ketat (ekstensi gambar `.jpg`, `.jpeg`, `.png`, batas ukuran $\le$ 5MB).
   - Penamaan berkas menggunakan string hash acak untuk mencegah penimpaan berkas (*file overwrite*).
2. **Ketersediaan Stok Real-Time:**
   - Perubahan status `is_available` langsung memengaruhi logika tampilan antarmuka publik secara deterministik (jika 0, tombol pemesanan langsung nonaktif).
3. **Penyimpanan Terpusat Nomor WhatsApp:**
   - Nomor WhatsApp tujuan tidak di-hardcode pada template Blade, melainkan dimuat secara dinamis dari tabel pengaturan (`settings`), memastikan fleksibilitas operasional jika butik mengganti nomor ponsel.

---

## 5. Kesimpulan
Task **ANA-009 (Sequence Diagram Pengelolaan Katalog, Kategori & Add-on Admin)** telah selesai direvisi penuh. Seluruh interaksi objek di ranah admin memodelkan manajemen konten etalase murni tanpa adanya antrean pesanan atau proses pembatalan di website.
