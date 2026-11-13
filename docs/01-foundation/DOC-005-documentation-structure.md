# STANDAR STRUKTUR DIREKTORI DOKUMENTASI (DOCUMENTATION DIRECTORY STRUCTURE)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-005  
**Fase:** Phase 1 — Project Initiation and Documentation  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penetapan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-001 s/d DOC-004 (Selesai)  

---

## 1. Ringkasan Eksekutif

Penetapan Struktur Direktori Dokumentasi (Task DOC-005) bertujuan untuk menstandarisasi tata kelola berkas, konvensi penamaan (*naming conventions*), serta arsitektur informasi seluruh artefak proyek **BLOOMÉ — Flowers & Stories**.

Sebagai proyek yang menerapkan metodologi Waterfall dengan alur pengerjaan lintas peran (PM/SA, UI/UX/FE, BE/DBA, dan Sponsor), repositori dokumentasi yang terstruktur rapi menjamin:
1. Kemudahan penelusuran (*traceability*) antara kebutuhan bisnis, desain sistem, implementasi kode, dan pengujian.
2. Pencegahan duplikasi atau inkonsistensi versi berkas (*version drift*).
3. Transparansi progres proyek yang siap diaudit pada setiap *Quality Gate*.

---

## 2. Arsitektur Direktori Dokumentasi Proyek

Dokumentasi BLOOMÉ diorganisasikan ke dalam hirarki berkas terstandarisasi sebagai berikut:

```
buketbunga/
├── task.md                         # Master Task Management & Checklist Proyek
├── requirement.md                  # Master Software Requirements Specification (SRS)
├── prd.md                          # Master Product Requirements Document (PRD)
├── architecture.md                 # Master System Architecture Document
├── docs/                           # Direktori Utama Artefak Dokumentasi & Deliverables
│   ├── 01-foundation/              # Deliverable Inisiasi & Fondasi Proyek
│   │   ├── DOC-001-project-charter-review.md
│   │   ├── DOC-002-project-scope-review.md
│   │   ├── DOC-003-team-assignment-review.md
│   │   ├── DOC-004-project-schedule-verification.md
│   │   └── DOC-005-documentation-structure.md
│   │
│   ├── 02-requirements/            # Dokumen Analisis Kebutuhan & Aturan Bisnis
│   │   ├── functional-requirements.md
│   │   ├── non-functional-requirements.md
│   │   ├── business-rules.md
│   │   └── pending-confirmation-log.md
│   │
│   ├── 03-analysis-and-design/     # Pemodelan Analisis Sistem & UML
│   │   ├── use-case-specifications.md
│   │   ├── activity-diagrams.md
│   │   └── sequence-diagrams.md
│   │
│   ├── 04-technical-and-architecture/ # Rancang Bangun Teknis & Desain Database
│   │   ├── three-layer-architecture-guide.md
│   │   ├── database-design.md
│   │   ├── data-dictionary.md
│   │   ├── security-architecture.md
│   │   └── api-data-contracts.md
│   │
│   ├── 05-ui-ux/                   # Rancangan Desain Visual & Pengalaman Pengguna
│   │   ├── design-system.md
│   │   ├── user-flow.md
│   │   ├── wireframes-catalog.md
│   │   └── mockups-and-prototype-links.md
│   │
│   ├── 06-testing-and-qa/          # Rencana Pengujian, Test Cases & Hasil UAT
│   │   ├── testing-plan.md
│   │   ├── test-cases-functional.md
│   │   ├── test-cases-security.md
│   │   ├── bug-and-defect-log.md
│   │   └── uat-sign-off-report.md
│   │
│   └── 07-deployment-and-guides/   # Panduan Instalasi, Manual Pengguna & Handover
│       ├── installation-guide.md
│       ├── customer-user-guide.md
│       ├── admin-operations-manual.md
│       └── final-project-report.md
```

---

## 3. Konvensi Penamaan Berkas (*File Naming Conventions*)

Seluruh berkas dokumentasi wajib mematuhi aturan penamaan berikut:
1. **Format Huruf:** Gunakan huruf kecil (*lowercase*) dengan pemisah tanda hubung (*kebab-case*), contoh: `business-rules.md`.
2. **Prefix Deliverable Task:** Untuk deliverable yang terikat langsung pada task checklist, gunakan format: `<TASK-ID>-<nama-deskriptif>.md`, contoh: `DOC-001-project-charter-review.md`.
3. **Ekstensi:** Semua dokumen utama disimpan dalam format Markdown (`.md`) yang valid dan kompatibel dengan GitHub Flavored Markdown (GFM).
4. **Diagram:** Diagram sistem wajib dibuat langsung menggunakan format kode Mermaid (````mermaid ... ````) di dalam dokumen Markdown untuk memastikan kemudahan pemeliharaan (*version-controllable*).

---

## 4. Metadata Wajib Setiap Dokumen

Setiap dokumen deliverable yang dibuat dalam direktori `docs/` wajib mencantumkan header informasi standar:

```markdown
# [JUDUL DOKUMEN / DELIVERABLE]
## BLOOMÉ — Flowers & Stories
**Task ID:** [Contoh: DOC-005]  
**Fase:** [Contoh: Phase 1 — Project Initiation and Documentation]  
**Penanggung Jawab:** [Nama Anggota Tim & Peran]  
**Tanggal Pembuatan:** [DD MMMM YYYY]  
**Status Dokumen:** [Draft / Under Review / Approved]  
**Versi:** [1.0 / 1.1]  
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
| `docs/07-deployment-and-guides/` | Jayanti Firdasari & Elsa Futri | Sponsor |

---

## 6. Prosedur Pembaruan Dokumen (*Change Procedure*)

1. Dokumen yang telah berstatus *Approved* tidak boleh diubah secara sepihak tanpa pencatatan pada riwayat perubahan (*Revision History / Change Log*).
2. Jika terjadi perubahan keputusan teknis atau bisnis, nomor versi dokumen dinaikkan (misal dari `v1.0` ke `v1.1`) dan alasan perubahan dicantumkan di akhir dokumen.
3. Keterkaitan silang antar dokumen wajib menggunakan tautan markdown lokal yang dapat diklik (*clickable links*).

---

## 7. Kesimpulan & Rekomendasi

### 7.1 Status Task DOC-005
Task **DOC-005 (Menentukan struktur direktori dokumentasi)** telah selesai dilaksanakan:
- Arsitektur hirarki direktori dokumentasi telah ditetapkan secara komprehensif.
- Konvensi penamaan berkas dan standar metadata telah dibakukan.
- Seluruh sub-fase **4.1 Project Foundation (DOC-001 hingga DOC-005) kini resmi SELESAI 100%**.

### 7.2 Rekomendasi Langkah Berikutnya:
Beralih ke sub-fase **4.2 Requirements Documentation**:
- **`DOC-006 — Menyusun requirement.md.`**
