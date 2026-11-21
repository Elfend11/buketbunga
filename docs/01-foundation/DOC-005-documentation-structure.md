# STANDAR STRUKTUR DIREKTORI DOKUMENTASI (DOCUMENTATION DIRECTORY STRUCTURE) (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-005  
**Fase:** Phase 1 — Project Initiation and Documentation  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penetapan:** 13 November 2026  
**Tanggal Revisi Penyelarasan:** 20 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-001 s/d DOC-004 (Selesai)  

---

## 1. Ringkasan Eksekutif

Penetapan Struktur Direktori Dokumentasi (Task DOC-005) bertujuan untuk menstandarisasi tata kelola berkas, konvensi penamaan (*naming conventions*), serta arsitektur informasi seluruh artefak proyek **BLOOMÉ — Flowers & Stories**.

Evaluasi penyelarasan versi 1.1 ini memastikan bahwa hierarki dokumentasi selaras penuh dengan 10 dokumen utama terbaru di root (`prompt.md`, `requirement.md`, `prd.md`, `architecture.md`, `database-design.md`, `design-system.md`, `user-flow.md`, `implementation-plan.md`, `task.md`, dan `testing-plan.md`) yang mengunci konsep sistem: **website sebagai katalog interaktif dan media personalisasi buket bunga, dengan alur pemesanan dialihkan langsung ke WhatsApp**.

Sebagai proyek yang menerapkan metodologi Waterfall lintas peran (PM/SA, UI/UX/FE, BE/DBA, dan Sponsor), repositori dokumentasi yang terstruktur rapi menjamin:
1. Kemudahan penelusuran (*traceability*) antara kebutuhan bisnis, arsitektur sistem, implementasi kode, dan pengujian.
2. Pencegahan duplikasi atau inkonsistensi versi berkas (*version drift*).
3. Transparansi progres proyek yang siap diaudit pada setiap *Quality Gate*.

---

## 2. Arsitektur Direktori Dokumentasi Proyek

Dokumentasi BLOOMÉ diorganisasikan ke dalam hierarki berkas terstandarisasi sebagai berikut:

```
buketbunga/
├── README.md
├── requirement.md
├── prd.md
├── architecture.md
├── database-design.md
├── implementation-plan.md
├── task.md
├── design-system.md
├── user-flow.md
├── testing-plan.md
├── prompt.md
├── docs/
│   ├── 01-foundation/
│   ├── 02-requirements/
│   ├── 03-analysis-and-design/
│   ├── 04-technical-and-architecture/
│   ├── 05-ui-ux/
│   ├── 06-testing-and-qa/
│   ├── 07-deployment-and-guides/
│   └── archive/
│       └── v1.0/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── routes/
├── storage/
├── tests/
├── composer.json
├── composer.lock
├── package.json
└── vite.config.js
```

---

## 3. Konvensi Penamaan Berkas (*File Naming Conventions*)

Seluruh berkas dokumentasi wajib mematuhi aturan penamaan berikut:
1. **Format Huruf:** Gunakan huruf kecil (*lowercase*) dengan pemisah tanda hubung (*kebab-case*), contoh: `DOC-001-project-charter-review.md`.
2. **Prefix Deliverable Task:** Untuk deliverable yang terikat langsung pada task checklist, gunakan format: `<TASK-ID>-<nama-deskriptif>.md`.
3. **Format Berkas:** Semua dokumen disimpan dalam format Markdown (`.md`) yang valid dan kompatibel dengan GitHub Flavored Markdown (GFM).
4. **Diagram:** Diagram sistem wajib dibuat langsung menggunakan format kode Mermaid (````mermaid ... ````) di dalam dokumen Markdown untuk menjamin kemudahan pemeliharaan (*version-controllable*).

---

## 4. Metadata Wajib Setiap Dokumen

Setiap dokumen deliverable yang dibuat dalam direktori `docs/` wajib mencantumkan header informasi standar:

```markdown
# [JUDUL DOKUMEN / DELIVERABLE] (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** [Contoh: DOC-005]  
**Fase:** [Contoh: Phase 1 — Project Initiation and Documentation]  
**Penanggung Jawab:** [Nama Anggota Tim & Peran]  
**Tanggal Penetapan:** [DD MMMM YYYY]  
**Tanggal Revisi Penyelarasan:** [DD MMMM YYYY]  
**Status Dokumen:** [Approved Baseline]  
**Versi:** [1.1]  
```

---

## 5. Matriks Tanggung Jawab Pengelolaan Direktori

| Direktori Dokumentasi | Penanggung Jawab Utama | Peninjau (*Reviewer*) |
|---|---|---|
| `docs/01-foundation/` | Jayanti Firdasari | Seluruh Tim |
| `docs/02-requirements/` | Jayanti Firdasari | Sponsor (Nabila Febriyani) |
| `docs/03-analysis-and-design/` | Jayanti Firdasari | Elsa Futri |
| `docs/04-technical-and-architecture/` | Elsa Futri | Jayanti Firdasari |
| `docs/05-ui-ux/` | Riya Monika | Jayanti Firdasari & Sponsor |
| `docs/06-testing-and-qa/` | Jayanti Firdasari | Elsa Futri & Riya Monika |

---

## 6. Prosedur Pembaruan Dokumen (*Change Procedure*)

1. **Sumber Kebenaran Tunggal (*Single Source of Truth*):** Dokumen aktif di root workspace (`requirement.md`, `prd.md`, `architecture.md`, `database-design.md`, dan dokumen terkait) merupakan acuan spesifikasi teknis dan bisnis sistem BLOOMÉ. `README.md` menjadi titik masuk navigasi.
2. Seluruh file laporan pendukung di direktori `docs/` wajib mencerminkan konsep sistem terbaru: **katalog interaktif, konfigurator personalisasi, item add-on, dan pemesanan dialihkan ke WhatsApp**.
3. Jika terdapat parameter operasional yang belum ditetapkan oleh pemilik usaha, dokumen wajib mencantumkan penanda baku **`[Perlu Konfirmasi Owner]`** tanpa membuat asumsi sepihak.

---

## 7. Kesimpulan & Rekomendasi

### 7.1 Status Task DOC-005
Task **DOC-005 (Menentukan struktur direktori dokumentasi)** telah diselaraskan penuh dengan versi 1.1:
- Dokumentasi historis v1.0 ditempatkan di `docs/archive/v1.0/`; salinan identik yang sudah memiliki dokumen aktif tidak dipertahankan.
- Struktur aktif mencakup kategori analisis hingga panduan deployment dan arsip.
- Konvensi penamaan berkas dan standar metadata telah dibakukan.
- Seluruh sub-fase **Phase 1 — Project Foundation (DOC-001 hingga DOC-005 pada `docs/01-foundation/`) resmi SELESAI 100%**.

### 7.2 Rekomendasi Langkah Berikutnya:
Setelah folder `docs/01-foundation/` tuntas diselaraskan, tim menunggu instruksi dari pengguna (*User Request*) sebelum melanjutkan pekerjaan ke sub-fase berikutnya (`docs/02-requirements/`).
