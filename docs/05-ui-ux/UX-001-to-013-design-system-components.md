# SPESIFIKASI TOKEN DESAIN & KOMPONEN UI (DESIGN SYSTEM COMPONENTS SPECIFICATION)
## BLOOMÉ — Flowers & Stories
**Task ID:** UX-001 s/d UX-013  
**Fase:** Phase 3 — UI/UX Design (Sub-fase 6.1 Design System)  
**Penanggung Jawab:** Riya Monika (UI/UX Designer & Frontend Developer) & Jayanti Firdasari (Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-018 — Design System Master Document, DOC-019 — User Flow  

---

## 1. Ringkasan Eksekutif

Dokumen spesifikasi ini menjabarkan implementasi teknis token desain dan pustaka komponen antarmuka pengguna (*UI Component Library*) untuk website **BLOOMÉ — Flowers & Stories**. Menerapkan tema **Elegant Floral Boutique**, spesifikasi ini mengunci token visual menjadi variabel CSS siap pakai (`:root`) untuk menjamin konsistensi 100% antara fase desain dan fase implementasi frontend (Blade & CSS).

---

## 2. Cakupan Task UI/UX Sub-fase 6.1

| Task ID | Nama Spesifikasi Komponen | Output Standar | Status |
|---|---|---|---|
| **UX-001** | Color Tokens (Palet Warna Baku) | 15 Variabel Warna CSS terstandarisasi | `[x]` |
| **UX-002** | Typography System | Konfigurasi Playfair Display & Poppins | `[x]` |
| **UX-003** | Spacing System | Skala spasi berbasis 4px & 8px grid | `[x]` |
| **UX-004** | Border Radius System | Token kelengkungan sudut organik (4px - 24px, pill) | `[x]` |
| **UX-005** | Shadow & Border System | Soft elevation shadow & subtle border line | `[x]` |
| **UX-006** | Button Components | Primary, Secondary, Outline, Danger, Disabled | `[x]` |
| **UX-007** | Form Components | Text input, textarea ucapan, select, file dropzone | `[x]` |
| **UX-008** | Card Components | Product card katalog, metric card admin | `[x]` |
| **UX-009** | Table Components | Tabel responsif pesanan & produk admin | `[x]` |
| **UX-010** | Badge & Status Components | 8 Kapsul status pesanan baku (ST-01 s/d ST-08) | `[x]` |
| **UX-011** | Navbar & Footer Pelanggan | Sticky glassmorphism header & floral footer | `[x]` |
| **UX-012** | Admin Sidebar & Header | Collapsible soft pink navigation & topbar | `[x]` |
| **UX-013** | Ilustrasi & Aksen Floral | Panduan SVG botanical ornaments & watermark | `[x]` |

---

## 3. Spesifikasi Rinci Token Desain (UX-001 s/d UX-005)

### 3.1 UX-001: Token Warna Baku (Color Tokens)
```css
:root {
  /* Brand Primary & Surfaces */
  --color-primary: #E99AAF;          /* Blush Pink: Tombol utama, aksen aktif */
  --color-primary-hover: #D98296;    /* Darker Blush: Efek hover/fokus */
  --color-primary-soft: #F6DDE3;     /* Soft Pastel: Latar badge, hover list */
  --color-bg-blush: #FFF5F6;         /* Blush Background: Latar seksi halaman */
  --color-bg-surface: #FFFCFB;       /* Warm White: Latar kartu & formulir */
  --color-burgundy: #642D36;         /* Deep Burgundy: Judul besar, aksen mewah */

  /* Neutral Typography & Borders */
  --color-text-main: #493335;        /* Deep Warm Charcoal: Badan teks utama */
  --color-text-muted: #898080;       /* Neutral Gray: Teks sekunder, label */
  --color-text-light: #B09A9C;       /* Light Muted: Placeholder, disabled text */
  --color-border: #F0E1E4;           /* Subtle Rose: Garis pemisah, border input */
  --color-accent-sage: #A8B5A0;      /* Botanical Sage: Ikon daun, aksen flora */

  /* Semantic Feedback States */
  --color-success: #6EAD70;         /* Hijau Daun: Verifikasi sukses, pesanan selesai */
  --color-warning: #E8B85B;         /* Emas Hangat: Menunggu pembayaran/konfirmasi */
  --color-danger: #D96B75;          /* Mawar Merah: Pembatalan, penolakan bukti bayar */
  --color-info: #9B83B9;            /* Lavender: Pesanan sedang diproses florist */
}
```

### 3.2 UX-002: Sistem Tipografi (Typography)
- **Heading Font:** `'Playfair Display', serif` (Memberikan karakter artisan, mewah, dan hangat).
- **Body & UI Font:** `'Poppins', -apple-system, sans-serif` (Keterbacaan teks transaksi tinggi).
- **Skala Ukuran Huruf & Line-Height:**
  - `Display / H1`: `2.5rem (40px)` / Line-height `1.2` / Weight `700` (Hero Heading).
  - `H2`: `2.0rem (32px)` / Line-height `1.3` / Weight `600` (Section Titles).
  - `H3`: `1.5rem (24px)` / Line-height `1.4` / Weight `600` (Card Titles, Subsections).
  - `Body Regular`: `1.0rem (16px)` / Line-height `1.6` / Weight `400` (Paragraf, deskripsi).
  - `Body Small / Label`: `0.875rem (14px)` / Line-height `1.5` / Weight `500` (Input label, info).
  - `Caption / Badge`: `0.75rem (12px)` / Line-height `1.4` / Weight `600` (Status capsule, timestamp).

### 3.3 UX-003: Sistem Spasi (Spacing System)
Skala spasi modular berbasis grid 4px/8px:
- `--space-1`: `4px`
- `--space-2`: `8px`
- `--space-3`: `12px`
- `--space-4`: `16px` (Default container padding)
- `--space-6`: `24px` (Card padding, form gap)
- `--space-8`: `32px` (Section sub-gap)
- `--space-12`: `48px` (Page section vertical padding)
- `--space-16`: `64px` (Hero padding)

### 3.4 UX-004: Border Radius
Menonjolkan bentuk organik lembut (*soft organic curvature*):
- `--radius-sm`: `4px` (Tag kecil, kontrol tabel)
- `--radius-md`: `8px` (Input field, button sekunder)
- `--radius-lg`: `12px` (Tombol utama, popup modal)
- `--radius-xl`: `16px` (Card produk katalog, panel dashboard)
- `--radius-2xl`: `24px` (Hero banner container)
- `--radius-full`: `9999px` (Badge kapsul status, avatar, pill buttons)

### 3.5 UX-005: Shadow & Border System
- `--shadow-sm`: `0 2px 4px rgba(100, 45, 54, 0.04)`
- `--shadow-card`: `0 8px 24px rgba(100, 45, 54, 0.08)` (Elegan, tidak tajam)
- `--shadow-hover`: `0 12px 32px rgba(100, 45, 54, 0.12)`
- `--border-subtle`: `1px solid var(--color-border)`

---

## 4. Spesifikasi Komponen Interaktif (UX-006 s/d UX-010)

### 4.1 UX-006: Button Components
- **Primary Button (`.btn-primary`):** Latar `--color-primary`, teks putih, padding `12px 24px`, radius `--radius-lg`. Hover: `--color-primary-hover`, transform `translateY(-1px)`, shadow hover.
- **Secondary / Soft Button (`.btn-secondary`):** Latar `--color-primary-soft`, teks `--color-burgundy`.
- **Outline Button (`.btn-outline`):** Latar transparan, border `1.5px solid var(--color-primary)`, teks `--color-primary`.
- **Danger Button (`.btn-danger`):** Latar `--color-danger`, teks putih (untuk aksi pembatalan/penolakan).
- **Disabled State (`:disabled`):** Latar `#E8DFE1`, teks `--color-text-light`, kursor `not-allowed`.

### 4.2 UX-007: Form Components
- **Input & Select Field (`.form-control`):** Latar `--color-bg-surface`, border `--color-border`, font Poppins 14px, padding `12px 16px`, radius `--radius-md`.
  - State Fokus: Border `--color-primary`, ring `0 0 0 3px rgba(233, 154, 175, 0.2)`.
  - State Error: Border `--color-danger`, pesan error teks merah di bawah input.
- **Kartu Ucapan Textarea (`.textarea-greeting`):** Tinggi minimal 120px, font serif/sans lembut, indikator hitungan karakter (maksimal 250 karakter).
- **File Upload Dropzone (`.file-dropzone`):** Area putus-putus (*dashed border*), ikon unggah floral, teks panduan: *"Pilih atau seret hingga 3 foto referensi (JPG/PNG, Maksimal 5MB per berkas)"*, pratinjau thumbnail instan dengan tombol hapus.

### 4.3 UX-008: Card Components
- **Product Card (`.card-product`):**
  - Rasio gambar buket: 4:3 atau 1:1 persegi dengan efek *zoom* lembut saat kursor diarahkan (*hover scale 1.03*).
  - Badge kategori melayang di pojok kiri atas.
  - Tag ketersediaan stok di pojok kanan atas (*Tersedia / Habis*).
  - Judul nama buket (Playfair Display 18px), harga terformat (contoh: *Rp 185.000*), dan tombol aksi *"Pesan Sekarang"*.
- **Admin Metric Card (`.card-metric`):** Latar putih bersih, aksen garis tepi warna status, angka total besar (32px bold), ikon representatif, dan deskripsi tren.

### 4.4 UX-009: Table Components
- **Tabel Responsif Admin (`.table-admin`):**
  - Header tabel: Latar `--color-bg-blush`, teks huruf kapital kecil (*uppercase tracking*), teks `--color-burgundy`.
  - Baris sel: Padding vertikal lapang (14px), hover effect latar `--color-bg-blush`, garis batas bawah halus.
  - Pembungkus tabel dengan `overflow-x: auto` untuk layar mobile/tablet.

### 4.5 UX-010: Badge & Status Components (8 Status Resmi)
Kapsul status menggunakan padding `4px 12px`, radius `--radius-full`, teks 12px semi-bold:

| Kode Status | Label Status Tampilan | Warna Teks | Warna Latar Kapsul | Keterangan Bisnis |
|---|---|---|---|---|
| **ST-01** | `Menunggu Pembayaran` | `#96600C` | `#FEF3C7` (Emas lembut) | Menunggu transfer pelanggan |
| **ST-02** | `Menunggu Verifikasi` | `#1E40AF` | `#DBEAFE` (Biru muda) | Bukti bayar diunggah |
| **ST-03** | `Pembayaran Ditolak` | `#991B1B` | `#FEE2E2` (Merah muda) | Bukti tidak valid |
| **ST-04** | `Menunggu Konfirmasi Harga` | `#6B21A8` | `#F3E8FF` (Ungu pastel) | Tiket custom butuh harga |
| **ST-05** | `Diproses` | `#166534` | `#DCFCE7` (Hijau pastel) | Florist merangkai buket |
| **ST-06** | `Siap Diambil / Dikirim` | `#0E7490` | `#CFFAFE` (Cyan pastel) | Rangkaian siap diserahkan |
| **ST-07** | `Selesai` | `#14532D` | `#BBF7D0` (Hijau cerah) | Transaksi tuntas |
| **ST-08** | `Dibatalkan` | `#4B5563` | `#F3F4F6` (Abu-abu lembut) | Pesanan dibatalkan |

---

## 5. Spesifikasi Navigasi & Aksen Visual (UX-011 s/d UX-013)

### 5.1 UX-011: Navbar & Footer Pelanggan
- **Sticky Glassmorphism Header:** Ketinggian 72px, latar `rgba(255, 252, 251, 0.92)` dengan efek blur `backdrop-filter: blur(8px)`, logo *BLOOMÉ*, menu: *Home, Katalog Buket, Custom Order, Lacak Pesanan, Tentang Kami, Kontak*, tombol CTA WhatsApp.
- **Floral Footer:** Latar `--color-burgundy`, teks `--color-bg-blush`, tautan navigasi, rincian alamat butik di Jl. Cipto Mangunkusumo Loa Janan Ilir, Samarinda, jam operasional, serta copyright.

### 5.2 UX-012: Admin Sidebar & Topbar
- **Sidebar Navigasi:** Latar `--color-bg-blush` bergaris tepi kanan lembut, daftar menu bernavigasi ikonik: *Dashboard, Master Produk, Kategori, Pesanan Masuk, Permintaan Custom, Verifikasi Pembayaran, Pengaturan*.
- **Topbar Header:** Menampilkan nama admin *"Nabila Febriyani (Florist)"*, jam sistem, tombol jalan pintas lihat toko publik, dan tombol logout aman.

### 5.3 UX-013: Aksen & Ornamen Floral
- Penggunaan grafis vektor SVG ilustrasi bunga sakura, mawar lembut, dan dahan daun botanikal (*sage green*) dengan transparansi 15%–25% sebagai latar belakang dekoratif di area hero dan pemisah seksi.

---

## 6. Kesimpulan & Rekomendasi
Seluruh spesifikasi task **UX-001 hingga UX-013** telah dirumuskan secara lengkap, terukur, dan siap diimplementasikan ke dalam berkas CSS dan komponen Blade Laravel.

