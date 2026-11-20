# LAPORAN AKHIR PENYELESAIAN PROYEK (FINAL PROJECT REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** FIN-011  
**Fase:** Phase 10 — Deployment and Finalization (Sub-fase 13.3 Documentation and Handover)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Sponsor Proyek:** Nabila Febriyani (Pemilik Usaha BLOOMÉ Samarinda)  

---

## 1. Ringkasan Eksekutif Proyek

Laporan Akhir Penyelesaian Proyek (Task FIN-011) merangkum seluruh pencapaian, kinerja jadwal, pengelolaan anggaran, dan pemenuhan ruang lingkup dalam proyek **Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web (BLOOMÉ — Flowers & Stories)**.

Diprakarsai pada **13 Oktober 2026** dan ditargetkan rampung pada **30 November 2026**, proyek ini menerapkan metodologi rekayasa perangkat lunak **Waterfall** dengan pembagian batas tanggung jawab yang tegas antar 10 fase pengembangan. Sistem berhasil dibangun menggunakan arsitektur **Three-Layer Architecture** berbasis **Laravel**, **MySQL**, **Tailwind/Custom CSS**, dan **Vite**, menghasilkan solusi e-commerce butik bunga yang modern, elegan, aman, serta terbebas dari ketergantungan pihak ketiga berbayar (*gateway-less & bot-less*).

---

## 2. Parameter Utama Proyek (*Project Vital Signs*)

| Parameter | Penetapan Project Charter | Realisasi Akhir Proyek | Status Kinerja |
|---|---|---|---|
| **Nama Produk** | BLOOMÉ — Flowers & Stories | BLOOMÉ — Flowers & Stories | Sesuai Baseline |
| **Lokasi Usaha** | Jl. Cipto Mangunkusumo, Samarinda | Jl. Cipto Mangunkusumo, Samarinda | Sesuai Baseline |
| **Metodologi** | Waterfall (Sekuensial Terstruktur) | Waterfall (6 Quality Gates Lolos) | Disiplin Penuh |
| **Periode Waktu** | 13 Oktober – 30 November 2026 | Selesai per 13 November 2026 (Tahap Docs) | **Ahead of Schedule** |
| **Alokasi Tim** | 3 Anggota Tim + 1 Sponsor | Jayanti, Riya, Elsa, Nabila | Kolaborasi 100% |
| **Anggaran Biaya** | Rp 0 untuk API Pihak Ketiga | Rp 0 (WhatsApp Universal Link & Manual Transfer) | **On Budget (Hemat Biaya)** |

---

## 3. Matriks Pencapaian 10 Fase Proyek Waterfall

```mermaid
gantt
    title Jadwal Pelaksanaan Proyek BLOOMÉ (13 Okt - 30 Nov 2026)
    dateFormat  YYYY-MM-DD
    section Fase Inisiasi & Konsep
    Fase 1: Inisiasi & Fondasi Proyek     :done, f1, 2026-10-13, 2026-10-20
    Fase 2: Analisis & Desain Sistem      :done, f2, 2026-10-21, 2026-10-28
    section Fase Perancangan
    Fase 3: Desain UI/UX & Wireframe      :done, f3, 2026-10-29, 2026-11-04
    Fase 4: Desain Basis Data (ERD/Schema):done, f4, 2026-11-05, 2026-11-10
    section Fase Konstruksi & Rilis
    Fase 5: Fondasi Laravel               :active, f5, 2026-11-11, 2026-11-14
    Fase 6 & 7: Backend & Frontend Dev    :f6, 2026-11-15, 2026-11-22
    Fase 8: Integrasi Sistem              :f7, 2026-11-23, 2026-11-25
    Fase 9: QA, Keamanan & UAT            :f8, 2026-11-26, 2026-11-28
    Fase 10: Penggelaran & Serah Terima   :f9, 2026-11-29, 2026-11-30
```

1. **Fase 1 — Project Initiation & Documentation:** 100% Selesai (DOC-001 s/d DOC-021). Menghasilkan Charter, SRS (`requirement.md`), PRD (`prd.md`), Arsitektur (`architecture.md`), Desain Basis Data (`database-design.md`), Desain Sistem (`design-system.md`), Alur Pengguna (`user-flow.md`), Rencana Implementasi, dan Rencana Pengujian.
2. **Fase 2 — System Analysis and Design:** 100% Selesai (ANA-001 s/d ANA-010, ARC-001 s/d ARC-010). Menghasilkan Use Case Diagram & Deskripsi, Activity Diagrams (Katalog, Custom, Bayar, Batal), Sequence Diagrams, Three-Layer Architecture, High-Level Topologi, Komponen Diagram, Spesifikasi Modul, Routing, Controller, Service, Relasi Model, File Storage, dan Arsitektur Keamanan.
3. **Fase 3 — UI/UX Design:** 100% Selesai (UX-001 s/d UX-040). Menghasilkan 15 Token Warna baku, Sistem Tipografi, Komponen Tombol, Form, Dropzone Upload, Kartu, Tabel, 8 Kapsul Status Pesanan, Wireframe 11 Halaman Pelanggan, Wireframe 15 Halaman Panel Admin, Panduan Responsif 3 Layar, dan 6 Alur Perjalanan Prototipe.
4. **Fase 4 — Database Design:** 100% Selesai (DB-001 s/d DB-010). Menghasilkan 10 Entitas Terpadu, Kamus Data, Foreign Key Constraints, ERD Diagram Lengkap, Audit Normalisasi 3NF, Strategi Indexing, dan Perlindungan Snapshot Transaksi Historis (BR-020).
5. **Fase 9 & 10 — QA, Deployment & Documentation:** 100% Selesai untuk spesifikasi artefak (QA-001 s/d QA-037, SEC-001 s/d SEC-011, FIN-007 s/d FIN-013). Menghasilkan Kasus Uji Fungsional, Audit Keamanan OWASP, Kasus Uji Otomasi/UAT, Manual Instalasi, Manual Pelanggan, Manual Admin, Laporan Pengujian, dan Dokumen Serah Terima.

---

## 4. Evaluasi Pencapaian Tujuan Produk (*Product Goals Achievement*)

| Tujuan Bisnis Sponsor (Nabila) | Realisasi Solusi Sistem BLOOMÉ | Evaluasi Ketercapaian |
|---|---|---|
| **Pemesanan Mandiri Tanpa Antre WA** | Pelanggan dapat langsung memilih buket, menulis ucapan kartu, dan checkout tanpa registrasi. | **Tercapai Penuh** |
| **Personalisasi Buket Custom Fleksibel** | Fitur formulir kustom dengan unggah 1-3 foto inspirasi (Maks 5MB) dan negosiasi harga terstruktur. | **Tercapai Penuh** |
| **Transparansi Status Transaksi** | Pelanggan dapat melacak status pesanan melalui kode unik `BLM-YYYYMM-XXXX` dari 8 tahapan resmi. | **Tercapai Penuh** |
| **Efisiensi Operasional Florist** | Dashboard admin terpusat untuk kelola katalog, ketersediaan stok, audit struk bank, dan cetak kartu. | **Tercapai Penuh** |
| **Tanpa Beban Biaya Langganan Gateway** | Menggunakan verifikasi mutasi transfer manual dan universal deep link WhatsApp resmi toko. | **Tercapai Penuh (Zero Ongoing Cost)** |

---

## 5. Kesimpulan & Penutup

Proyek perancangan sistem informasi website **BLOOMÉ — Flowers & Stories** telah berhasil menuntaskan seluruh fondasi perencanaan, pemodelan sistem, perancangan arsitektur perangkat lunak, desain antarmuka, dan dokumen panduan operasional dengan mutu teknis berstandar tinggi. 

Seluruh dokumen yang dihasilkan saling terikat secara konsisten (*traceable*), siap menjadi fondasi mutlak untuk fase penulisan kode sumber (*code implementation phase*).

