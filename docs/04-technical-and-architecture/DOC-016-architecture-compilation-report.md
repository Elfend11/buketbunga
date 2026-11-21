# LAPORAN PENYUSUNAN SYSTEM ARCHITECTURE DOCUMENT (ARCHITECTURE COMPILATION REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-016  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.4 Technical Documentation)  
**Penanggung Jawab:** Elsa Futri (Backend Developer & Lead Architect) & Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [architecture.md](../../architecture.md) (Versi 1.0 - Official Technical Architecture Baseline)

---

## 1. Ringkasan Eksekutif

Penyusunan dokumen master `architecture.md` (Task DOC-016) telah tuntas dilaksanakan. Dokumen ini mengubah instruksi master prompt awal menjadi sebuah dokumen **System Architecture Document (SAD)** resmi yang komprehensif, terstruktur, mendalam, dan siap dijadikan cetak biru teknis perancangan basis data, penulisan kode Laravel, integrasi antarmodul, serta strategi penggelaran website **BLOOMÉ — Flowers & Stories**.

Dokumen ini membedah arsitektur sistem menggunakan pola **Three-Layer Architecture** (Presentation, Application, Data Layer) pada kerangka kerja **Laravel (PHP)** dan basis data relasional **MySQL**, dilengkapi 7 diagram visual Mermaid terstandarisasi.

---

## 2. Struktur & Verifikasi Komponen Arsitektur Teknis

Penyusunan `architecture.md` memuat 22 bagian arsitektur esensial:
1. **Gambaran Arsitektur & Prinsip (Bab 1 s/d 5):**
   - Penegasan arsitektur monolitik modern dengan prinsip KISS, pertahanan berlapis (*Defense in Depth*), dan database sebagai *Single Source of Truth*.
2. **Three-Layer Architecture & High-Level System Diagram (Bab 6 & 7):**
   - Pemisahan tegas Presentation (Blade/Vite), Application (Controllers/Requests/Services), dan Data Layer (Eloquent/MySQL).
   - Diagram arsitektur sistem tingkat tinggi yang menghubungkan klien publik/admin, web server, runtime PHP-FPM, disk storage lokal, dan basis data MySQL.
3. **Komponen Aplikasi & Alur Data Sekuensial (Bab 8 & 9):**
   - Component diagram 6 modul fungsional utama.
   - Sequence diagram pemesanan katalog dan sequence diagram pengajuan buket custom beserta penentuan harga usulan dan keputusan persetujuan.
4. **Mesin Transisi Status & Skema Database ERD (Bab 10 & 11):**
   - Diagram mesin status 8 siklus transaksi (*ST-01 s/d ST-08*).
   - Entity Relationship Diagram (ERD) 10 entitas relasional lengkap dengan primary keys, foreign keys, dan field data historis (*snapshot*).
5. **Struktur Proyek Laravel & Arsitektur Routing (Bab 12 s/d 14):**
   - Struktur direktori modular (Controllers, Requests, Models, Services, Blade views).
   - Pengelompokan rute web: Public routes, Guest checkout routes, Admin authentication, dan Protected Admin routes (`auth:admin`).
6. **Keamanan Berkas, Keamanan Siber, & Error Handling (Bab 15 s/d 18):**
   - Penyimpanan gambar di `storage/app/public/` dengan symbolic link publik, validasi MIME JPG/PNG ≤ 5MB, hashing UUID acak, dan larangan eksekusi skrip PHP.
   - Proteksi CSRF, enkripsi kata sandi Bcrypt, mitigasi SQL Injection via PDO parameter binding, dan sanitasi XSS Blade.
   - Halaman error kustom floral (404, 403, 500) dan pencatatan log terpusat di `laravel.log`.
7. **Arsitektur Deployment & Architectural Decision Records (ADR) (Bab 19 s/d 22):**
   - Diagram arsitektur deployment web hosting / VPS Linux.
   - 4 Rekaman keputusan arsitektur (ADR-01 Monolith, ADR-02 SSR Blade, ADR-03 Local Disk, ADR-04 Manual Payment Verification).

---

## 3. Kesimpulan & Rekomendasi

### 3.1 Status Task DOC-016
Task **DOC-016 (Menyusun architecture.md)** telah selesai dilaksanakan:
- File [architecture.md](../../architecture.md) telah tersusun lengkap, konsisten, dan memenuhi seluruh kriteria arsitektur teknis standar industri.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 3.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task teknis berikutnya pada sub-fase 4.4:
- **`DOC-017 — Menyusun database-design.md.`**

