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
├── prompt.md                               # Master Prompt & Directive Revisi Menyeluruh v1.1
├── requirement.md                          # Master Software Requirements Specification (SRS) v1.1
├── prd.md                                  # Master Product Requirements Document (PRD) v1.1
├── architecture.md                         # Master System Architecture Document (SAD) v1.1
├── database-design.md                      # Master Database Design & Data Dictionary (10 Tabel) v1.1
├── design-system.md                        # Master Design System & UI Components v1.1
├── user-flow.md                            # Master User Flow & Navigasi WhatsApp v1.1
├── implementation-plan.md                  # Master Technical Implementation Plan & Roadmap v1.1
├── task.md                                 # Master Project Task Management & Checklist v1.1
├── testing-plan.md                         # Master Software Testing Plan & QA Strategy v1.1
│
├── backup-v1.0/                            # Arsip Cadangan Utuh Dokumentasi Baseline Awal v1.0
│
└── docs/                                   # Direktori Laporan Analisis & Artefak Pendukung
    ├── 01-foundation/                      # Deliverable Inisiasi & Fondasi Proyek
    │   ├── DOC-001-project-charter-review.md
    │   ├── DOC-002-project-scope-review.md
    │   ├── DOC-003-team-assignment-review.md
    │   ├── DOC-004-project-schedule-verification.md
    │   └── DOC-005-documentation-structure.md
    │
    ├── 02-requirements/                    # Laporan Verifikasi Kebutuhan & Aturan Bisnis
    │   ├── DOC-006-srs-verification-report.md
    │   ├── DOC-007-functional-requirements-review.md
    │   ├── DOC-008-non-functional-requirements-review.md
    │   ├── DOC-009-business-rules-review.md
    │   ├── DOC-010-acceptance-criteria-review.md
    │   ├── DOC-011-prd-compilation-report.md
    │   ├── DOC-012-product-vision-review.md
    │   ├── DOC-013-user-personas-review.md
    │   ├── DOC-014-user-stories-review.md
    │   └── DOC-015-product-priorities-review.md
    │
    ├── 03-analysis-and-design/             # Pemodelan Analisis Sistem & Diagram UML
    │   ├── ANA-001-use-case-diagram.md
    │   ├── ANA-002-use-case-descriptions.md
    │   ├── ANA-003-activity-diagram-catalog-order.md
    │   ├── ANA-004-activity-diagram-custom-order.md
    │   ├── ANA-005-activity-diagram-payment.md
    │   ├── ANA-006-activity-diagram-cancellation.md
    │   ├── ANA-007-sequence-diagram-ordering.md
    │   ├── ANA-008-sequence-diagram-payment.md
    │   ├── ANA-009-sequence-diagram-order-management.md
    │   └── ANA-010-diagram-validation-report.md
    │
    ├── 04-technical-and-architecture/     # Rancang Bangun Teknis & Arsitektur Database
    │   ├── ARC-001-three-layer-architecture.md
    │   ├── ARC-002-high-level-architecture-diagram.md
    │   ├── ARC-003-component-diagram.md
    │   ├── ARC-004-application-modules.md
    │   ├── DOC-016-architecture-compilation-report.md
    │   ├── DOC-017-database-design-report.md
    │   └── DOC-020-implementation-plan-report.md
    │
    ├── 05-ui-ux/                           # Laporan Desain Visual & Pengalaman Pengguna
    │   ├── DOC-018-design-system-report.md
    │   └── DOC-019-user-flow-report.md
    │
    └── 06-testing-and-qa/                  # Laporan Rencana Pengujian & Kualitas
        └── DOC-021-testing-plan-report.md
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

1. **Sumber Kebenaran Tunggal (*Single Source of Truth*):** 10 file dokumen utama di root workspace (`requirement.md`, `prd.md`, `architecture.md`, `database-design.md`, dll.) merupakan acuan hukum tertinggi dari seluruh spesifikasi teknis dan bisnis sistem BLOOMÉ.
2. Seluruh file laporan pendukung di direktori `docs/` wajib mencerminkan konsep sistem terbaru: **katalog interaktif, konfigurator personalisasi, item add-on, dan pemesanan dialihkan ke WhatsApp**.
3. Jika terdapat parameter operasional yang belum ditetapkan oleh pemilik usaha, dokumen wajib mencantumkan penanda baku **`[Perlu Konfirmasi Owner]`** tanpa membuat asumsi sepihak.

---

## 7. Kesimpulan & Rekomendasi

### 7.1 Status Task DOC-005
Task **DOC-005 (Menentukan struktur direktori dokumentasi)** telah diselaraskan penuh dengan versi 1.1:
- Arsitektur hierarki direktori dokumentasi telah mencakup 10 dokumen utama di root dan seluruh laporan pendukung di `docs/`.
- Konvensi penamaan berkas dan standar metadata telah dibakukan.
- Seluruh sub-fase **Phase 1 — Project Foundation (DOC-001 hingga DOC-005 pada `docs/01-foundation/`) resmi SELESAI 100%**.

### 7.2 Rekomendasi Langkah Berikutnya:
Setelah folder `docs/01-foundation/` tuntas diselaraskan, tim menunggu instruksi dari pengguna (*User Request*) sebelum melanjutkan pekerjaan ke sub-fase berikutnya (`docs/02-requirements/`).
