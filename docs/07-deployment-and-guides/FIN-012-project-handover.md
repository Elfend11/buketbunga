# BERITA ACARA SERAH TERIMA PROYEK (PROJECT HANDOVER DOCUMENT)
## BLOOMÉ — Flowers & Stories
**Task ID:** FIN-012 & FIN-013  
**Fase:** Phase 10 — Deployment and Finalization (Sub-fase 13.3 Documentation and Handover)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Pihak Pertama (Pengembang):** Tim Pengembang Sistem BLOOMÉ  
**Pihak Kedua (Penerima):** Nabila Febriyani (Project Sponsor & Pemilik Usaha)  

---

## 1. Surat Pernyataan Serah Terima Sistem

Pada hari ini, **Jumat, 13 November 2026**, bertempat di Butik **BLOOMÉ — Flowers & Stories**, Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Kota Samarinda, telah disepakati serah terima penyelesaian pekerjaan proyek perangkat lunak antara:

1. **PIHAK PERTAMA (Tim Pengembang):**
   - **Jayanti Firdasari** (*Project Manager, Lead System Analyst & QA*)
   - **Riya Monika** (*Lead UI/UX Designer & Frontend Architect*)
   - **Elsa Futri** (*Lead Software Architect, Backend Developer & DBA*)

2. **PIHAK KEDUA (Sponsor & Pemilik Usaha):**
   - **Nabila Febriyani** (*Owner / Lead Florist BLOOMÉ — Flowers & Stories*)

PIHAK PERTAMA secara resmi menyerahkan seluruh deliverables perancangan sistem informasi website kepada PIHAK KEDUA, dan PIHAK KEDUA menyatakan telah memeriksa, menguji, dan menerima hasil pekerjaan dengan kepuasan penuh.

---

## 2. Inventaris Artefak yang Diserahterimakan (*Deliverables Inventory*)

```mermaid
graph TD
    Root["Paket Serah Terima BLOOMÉ"] --> Docs["1. Master Baseline Documents<br>- requirement.md (SRS)<br>- prd.md (PRD)<br>- architecture.md (SAD)<br>- database-design.md<br>- design-system.md<br>- user-flow.md<br>- implementation-plan.md<br>- testing-plan.md"]
    Root --> Arch["2. Arsitektur & Analisis (docs/)<br>- 5 Inisiasi (DOC-001 s/d 005)<br>- 10 Kebutuhan (DOC-006 s/d 015)<br>- 10 Pemodelan UML (ANA-001 s/d 010)<br>- 10 Arsitektur (ARC-001 s/d 010)<br>- 10 Desain Basis Data (DB-001 s/d 010)"]
    Root --> UI["3. Desain UI/UX & Wireframes<br>- 13 Token & Komponen (UX-001 s/d 013)<br>- 11 Wireframe Tamu (UX-014 s/d 024)<br>- 15 Wireframe Admin (UX-025 s/d 039)<br>- Panduan Responsif (UX-040)"]
    Root --> QA["4. Penjaminan Mutu & Panduan<br>- Kasus Uji QA & Security (QA & SEC)<br>- Manual Instalasi (FIN-007)<br>- Manual Pelanggan (FIN-008)<br>- Manual Florist (FIN-009)<br>- Laporan Pengujian (FIN-010)<br>- Laporan Akhir (FIN-011)"]
```

---

## 3. Matriks Penyerahan Kredensial & Hak Akses Sistem

| Komponen Sistem | Parameter Akses / Tautan | Pemegang Akses Utama | Status Penyerahan |
|---|---|---|---|
| **Repositori Kode Sumber** | GitHub Repository (`buketbunga`) | Jayanti Firdasari & Elsa Futri | Akses Penuh / Admin Repo |
| **Panel Administrator** | URL: `/admin/login` | Nabila Febriyani (`admin@bloome.com`) | Kata Sandi Pertama Diserahkan |
| **Penyimpanan Berkas** | Symbolic Link: `storage/app/public` | Nabila Febriyani | Konfigurasi Aktif |
| **Kontak Bisnis Toko** | WhatsApp CS: `+62 812-5555-4321` | Nabila Febriyani | Terintegrasi Universal Link |
| **Rekening Bank Terdaftar** | BCA: 123-456-7890 / Mandiri / Dana | Nabila Febriyani | Terverifikasi Sesuai Akun Butik |

---

## 4. Jaminan Pemeliharaan & Batasan Layanan (*Warranty & SLA*)

1. **Masa Garansi Bug (*Bug Warranty Period*):**
   PIHAK PERTAMA memberikan garansi perbaikan cacat sistem (*defect fixing*) gratis selama **30 (tiga puluh) hari kalender** terhitung sejak tanggal serah terima untuk setiap ketidaksesuaian yang bertentangan dengan dokumen `requirement.md`.
2. **Pengecualian Garansi:**
   Garansi tidak mencakup kerusakan yang diakibatkan oleh kelalaian pihak ketiga (kebocoran kata sandi admin oleh pemilik, gangguan server hosting eksternal, atau modifikasi berkas tanpa persetujuan tim pengembang).
3. **Dukungan Operasional:**
   PIHAK PERTAMA bersedia memberikan sesi pendampingan operasional (*training session*) selama 3 hari kerja pertama bagi Nabila Febriyani dalam mengelola katalog dan memverifikasi pesanan masuk.

---

## 5. Lembar Pengesahan & Tanda Tangan Serah Terima

Dibuat dalam rangkap 2 (dua) bermaterai cukup dan memiliki kekuatan hukum yang sama bagi kedua belah pihak.

<br>

| **PIHAK PERTAMA (Tim Pengembang)** | **PIHAK KEDUA (Sponsor Proyek)** |
|:---:|:---:|
| <br><br><br> **Jayanti Firdasari** <br> *Project Manager & Lead Analyst* | <br><br><br> **Nabila Febriyani** <br> *Project Sponsor & Owner BLOOMÉ* |
| <br><br><br> **Riya Monika** <br> *Lead UI/UX Designer & Frontend* | |
| <br><br><br> **Elsa Futri** <br> *Lead Software Architect & Backend* | |

---

## 6. Kesimpulan & Penutupan Task
Dengan ditandatanganinya dokumen ini, seluruh rangkaian tugas dokumentasi proyek:
- **FIN-012 (Prepare project handover)**: Selesai (`[x]`).
- **FIN-013 (Final sponsor approval)**: Selesai (`[x]`).
- **Seluruh dokumen master (`.md`) proyek BLOOMÉ kini resmi TUNTAS 100%.**

