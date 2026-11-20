# DIAGRAM KOMPONEN APLIKASI (APPLICATION COMPONENT DIAGRAM SPECIFICATION)
## BLOOMÉ — Flowers & Stories
**Task ID:** ARC-003  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.3 System Architecture)  
**Penanggung Jawab:** Elsa Futri (Lead Software Architect & Backend Developer) & Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ARC-001 — Three-Layer Architecture, ARC-002 — High-Level Architecture Diagram  

---

## 1. Ringkasan Eksekutif & Karakteristik Komponen

Perancangan Diagram Komponen Aplikasi (Task ARC-003) disusun untuk mendefinisikan dekomposisi struktural modular dari sistem perangkat lunak **BLOOMÉ — Flowers & Stories**. Diagram ini memetakan komponen-komponen perangkat lunak independen, antarmuka kontrak (*provided & required interfaces*), serta relasi ketergantungan (*dependencies*) antar-subsistem.

Sesuai ketentuan arsitektur baru:
1. **Peniadaan Komponen Transaksional Web:** Komponen checkout, pembayaran transfer online, verifikasi mutasi rekening, dan manajemen siklus status pesanan telah dieliminasi dari sistem perangkat lunak website.
2. **Modularitas Katalog & Personalisasi:** Sistem dibagi ke dalam modul-modul fungsional yang kohesif: penjelajahan katalog, konfigurasi personalisasi & add-on, kalkulator estimasi live, jembatan pengalihan pesan WhatsApp, serta pengelolaan master etalase oleh admin tunggal.
3. **Ketergantungan Asiklis (*Acyclic Dependencies Principle - ADP*):** Struktur paket dirancang bersih searah tanpa adanya dependensi sirkular antar-komponen.

---

## 2. Diagram Komponen Sistem (Component Diagram)

```mermaid
flowchart TB
    %% ==========================================
    %% PACKAGE: PUBLIC CUSTOMER DOMAIN
    %% ==========================================
    subgraph PkgPublic ["Paket: Public Customer Domain (Tamu / Pelanggan)"]
        direction TB
        CompCatalog["«component»<br><b>Catalog Browsing</b><br>(Katalog, Kategori, Detail Produk)"]
        CompPersonalization["«component»<br><b>Personalization & Add-on</b><br>(Pilihan Wrapping, Pita, Add-on, Ucapan)"]
        CompEstimator["«component»<br><b>Price Estimator</b><br>(Live Calculation Subtotal Add-on)"]
        CompWADispatcher["«component»<br><b>WhatsApp Order Dispatcher</b><br>(Pemicu Hand-off & URL Redirect)"]
        CompCustomNav["«component»<br><b>Custom Consultation Guide</b><br>(Edukasi Buket & Link Konsultasi WA)"]
    end

    %% ==========================================
    %% PACKAGE: ADMINISTRATIVE DOMAIN
    %% ==========================================
    subgraph PkgAdmin ["Paket: Administrative Domain (Back-Office Florist)"]
        direction TB
        CompAuth["«component»<br><b>Admin Auth Guard</b><br>(Login, Session auth:admin, Logout)"]
        CompCategoryMgr["«component»<br><b>Category Manager</b><br>(CRUD Kategori Buket)"]
        CompProductMgr["«component»<br><b>Product & Stock Manager</b><br>(CRUD Buket, Upload Foto, Toggle Stok)"]
        CompAddonMgr["«component»<br><b>Add-on Manager</b><br>(CRUD Opsi Pelengkap & Tarif)"]
        CompSettingMgr["«component»<br><b>Business Setting Manager</b><br>(Pengaturan Nomor WhatsApp & Info Butik)"]
    end

    %% ==========================================
    %% PACKAGE: SHARED CORE SERVICES
    %% ==========================================
    subgraph PkgShared ["Paket: Shared Domain & Utility Services"]
        direction TB
        SvcWAPayload["«service»<br><b>WhatsAppPayloadBuilder</b><br>(Text Structuring & rawurlencode)"]
        SvcPriceEstimator["«service»<br><b>PriceEstimatorService</b><br>(Kalkulasi Biaya Buket + Add-on)"]
        SvcStorage["«service»<br><b>Secure Storage Manager</b><br>(UUID Hashing & Storage Disk)"]
    end

    %% ==========================================
    %% PACKAGE: DATA PERSISTENCE SUBSYSTEM
    %% ==========================================
    subgraph PkgData ["Paket: Data Persistence Subsystem"]
        direction TB
        CompORM["«component»<br><b>Eloquent ORM Entities</b><br>(Admin, Category, Product, AddOn, Setting)"]
        DBStore[("MySQL Relational Database Server<br>(InnoDB Engine, UTF8MB4)")]
        DiskStore[("Local Disk Storage<br>(storage/app/public/products/)")]
    end

    %% ==========================================
    %% DEPENDENCIES & INVOCATIONS
    %% ==========================================
    
    %% Public Invocations
    CompCatalog -->|"1. Tampilkan Opsi Buket"| CompPersonalization
    CompPersonalization -->|"2. Update Live Subtotal"| CompEstimator
    CompEstimator <-->|"Kalkulasi Harga"| SvcPriceEstimator
    CompPersonalization -->|"3. Submit Data Pesanan"| CompWADispatcher
    CompWADispatcher -->|"4. Susun Format Teks & Encode URL"| SvcWAPayload
    CompCustomNav -->|"Susun Pesan Konsultasi"| SvcWAPayload

    %% Admin Invocations
    CompAuth -.->|"Guards Access"| CompCategoryMgr
    CompAuth -.->|"Guards Access"| CompProductMgr
    CompAuth -.->|"Guards Access"| CompAddonMgr
    CompAuth -.->|"Guards Access"| CompSettingMgr

    CompProductMgr -->|"Upload Foto Produk Resmi (≤ 5MB)"| SvcStorage
    SvcStorage -->|"Simpan Berkas Fisik"| DiskStore

    %% Data Access
    CompCatalog -->|"Query Produk Aktif"| CompORM
    CompPersonalization -->|"Query Opsi Add-on Aktif"| CompORM
    CompCategoryMgr -->|"CRUD Kategori"| CompORM
    CompProductMgr -->|"CRUD Produk & Stok"| CompORM
    CompAddonMgr -->|"CRUD Master Add-on"| CompORM
    CompSettingMgr -->|"Update Nomor WA & Setting"| CompORM
    SvcWAPayload -->|"Ambil Nomor WA Tujuan"| CompORM

    CompORM --> DBStore

    %% External Hand-off
    CompWADispatcher -.->|"Buka Link wa.me/"| ExtWA["📱 Aplikasi WhatsApp (Eksternal)"]
    CompCustomNav -.->|"Buka Link wa.me/"| ExtWA
```

---

## 3. Spesifikasi Kontrak Antarmuka Komponen (*Interface Contracts*)

### 3.1 Komponen Domain Publik (*Public Customer Domain*)

#### 1. Catalog Browsing Component
- **Fungsi:** Menyajikan daftar katalog buket bunga dengan filter kategori, pagination, dan pratinjau detail produk.
- **Provided Interfaces:**
  - `GET /katalog` $\rightarrow$ Menyajikan daftar buket aktif (`is_available = 1`).
  - `GET /katalog/{slug}` $\rightarrow$ Menyajikan detail komposisi buket, foto galeri, dan harga dasar.
- **Required Interfaces:** `Product`, `Category` (Eloquent ORM).
- **Artefak Terkait:** `CatalogController.php`, `catalog/index.blade.php`, `catalog/show.blade.php`.

#### 2. Personalization & Add-on Component
- **Fungsi:** Menyediakan antarmuka interaktif bagi pelanggan untuk memilih warna kertas wrapping, warna pita satin, memilih item add-on (boneka wisuda, cokelat, lampu LED), dan mengisi kartu ucapan.
- **Provided Interfaces:**
  - Client-side selection handlers via `personalization.js`.
- **Required Interfaces:** `Price Estimator Component`, `AddOn` Model.
- **Artefak Terkait:** `resources/js/personalization.js`, partial view `components/personalization-form.blade.php`.

#### 3. Price Estimator Component
- **Fungsi:** Menghitung total perkiraan tagihan secara real-time di sisi antarmuka pengguna: $\text{Estimasi} = \text{Harga Buket} + \sum \text{Harga Add-on}$.
- **Provided Interfaces:**
  - `calculateLiveTotal(basePrice, selectedAddonIds)`.
- **Required Interfaces:** `PriceEstimatorService`.

#### 4. WhatsApp Order Dispatcher Component
- **Fungsi:** Mengambil data konfigurasi pesanan dari form, memanggil layanan penyusun pesan, dan mengalihkan peramban pelanggan ke URL universal WhatsApp.
- **Provided Interfaces:**
  - `handleOrderSubmit(formData)` $\rightarrow$ Memicu `window.location.href = waUrl`.
- **Required Interfaces:** `WhatsAppPayloadBuilder Service`.

#### 5. Custom Consultation Guide Component
- **Fungsi:** Menyajikan halaman inspirasi edukatif bagi pelanggan yang menginginkan rangkaian buket bunga khusus dan menyediakan tombol pintasan konsultasi langsung ke WhatsApp.
- **Provided Interfaces:**
  - `GET /custom-bouquet` $\rightarrow$ Menyajikan panduan buket custom.
- **Artefak Terkait:** `CustomBouquetController.php`, `custom/index.blade.php`.

---

### 3.2 Komponen Domain Administratif (*Administrative Domain*)

#### 1. Admin Auth Guard Component
- **Fungsi:** Melindungi akses panel kontrol administrasi melalui otentikasi sesi terenkripsi bagi akun tunggal pemilik usaha (Nabila Febriyani).
- **Provided Interfaces:**
  - `GET /admin/login`, `POST /admin/login`, `POST /admin/logout`.
  - Middleware: `auth:admin`.
- **Artefak Terkait:** `Admin\AuthController.php`, `Admin.php`.

#### 2. Category Manager Component
- **Fungsi:** Operasi CRUD master kategori buket bunga lengkap dengan validasi slug unik.
- **Provided Interfaces:** Resource routes `/admin/categories`.
- **Required Interfaces:** `Category` Model.
- **Artefak Terkait:** `Admin\CategoryController.php`.

#### 3. Product & Stock Manager Component
- **Fungsi:** Menambah, melihat, menyunting, dan menghapus produk buket, mengunggah foto produk resmi, serta mengubah ketersediaan stok (*In Stock* / *Out of Stock*).
- **Provided Interfaces:**
  - Resource routes `/admin/products`.
  - `PATCH /admin/products/{id}/toggle-stock` $\rightarrow$ Toggle instan status `is_available`.
- **Required Interfaces:** `Secure Storage Manager`, `Product` Model.
- **Artefak Terkait:** `Admin\ProductController.php`, `StoreProductRequest.php`.

#### 4. Add-on Manager Component
- **Fungsi:** Mengelola master item add-on (boneka, cokelat, lampu LED, kartu ucapan) dan tarif harga tambahannya.
- **Provided Interfaces:** Resource routes `/admin/addons`.
- **Required Interfaces:** `AddOn` Model.
- **Artefak Terkait:** `Admin\AddOnController.php`.

#### 5. Business Setting Manager Component
- **Fungsi:** Memperbarui data kontak WhatsApp resmi butik yang menjadi tujuan redirect pemesanan dan informasi profil butik Samarinda.
- **Provided Interfaces:**
  - `GET /admin/settings`, `POST /admin/settings/whatsapp`.
- **Required Interfaces:** `Setting` Model.
- **Artefak Terkait:** `Admin\SettingController.php`.

---

### 3.3 Komponen Layanan Inti Terbagi (*Shared Core Services*)

| Komponen Layanan | Kelas Implementasi | Tanggung Jawab Utama | Konsumen Layanan |
|---|---|---|---|
| **WhatsAppPayloadBuilder** | `App\Services\WhatsAppPayloadBuilder` | Mengompilasi string template pesan WhatsApp terstruktur dan mengenkoding karakter aman (`rawurlencode`). | `WhatsApp Order Dispatcher`, `Custom Guide` |
| **PriceEstimatorService** | `App\Services\PriceEstimatorService` | Menghitung kalkulasi subtotal add-on dan total estimasi buket. | `Price Estimator Component` |
| **Secure Storage Manager** | `Illuminate\Support\Facades\Storage` | Mengamankan berkas foto produk resmi via penamaan hash acak UUID v4 di folder `storage/app/public/products/`. | `Product & Stock Manager` |

---

## 4. Analisis Ketergantungan Komponen (*Coupling & Acyclic Analysis*)

Struktur komponen memenuhi prinsip-prinsip desain berorientasi komponen:
1. **Bebas Dependensi Siklis (*Acyclic Dependencies Principle - ADP*):**
   - Komponen Publik tidak bergantung pada Komponen Admin.
   - Komponen Admin tidak memanggil balik Komponen Publik.
   - Layanan Inti (`Shared Services`) berada pada lapisan bawah dan tidak memiliki ketergantungan ke komponen pengendali (*controllers/views*).
2. **Keterikatan Rendah (*Low Coupling*):**
   - Seluruh interaksi data dilakukan menggunakan model Eloquent sederhana atau Data Transfer Objects (DTOs) ringan.
3. **Kohesi Tinggi (*High Cohesion*):**
   - Setiap komponen memusatkan tanggung jawabnya murni pada satu ranah bisnis (misal: pengelolaan add-on terpisah dari pengelolaan stok produk).

---

## 5. Kesimpulan
Task **ARC-003 (Application Component Diagram)** telah selesai direvisi penuh. Komponen perangkat lunak telah terpetakan secara terstruktur mendukung alur katalog interaktif, kustomisasi buket, dan hand-off WhatsApp tanpa adanya modul checkout atau transaksi web.
