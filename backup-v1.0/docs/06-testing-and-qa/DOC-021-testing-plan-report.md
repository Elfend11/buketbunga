# LAPORAN PENYUSUNAN RENCANA PENGUJIAN PERANGKAT LUNAK (TESTING PLAN REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-021  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.4 Technical Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Lead QA & PM) didukung Elsa Futri & Riya Monika  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [testing-plan.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/testing-plan.md) (Versi 1.0 - Official Testing Plan Baseline)  

---

## 1. Ringkasan Eksekutif

Penyusunan dokumen master `testing-plan.md` (Task DOC-021) telah selesai dilaksanakan. Dokumen ini menjadi pedoman strategi penjaminan mutu (*Quality Assurance*), metodologi pengujian fungsional dan keamanan siber, matriks kasus uji (*test cases*), serta protokol *User Acceptance Testing* (UAT) untuk sistem informasi **BLOOMÉ — Flowers & Stories**.

Tuntasnya dokumen ini menandai penyelesaian penuh **100% dari seluruh 21 task pada Phase 1 — Project Initiation and Documentation (DOC-001 s/d DOC-021)**, sekaligus memenuhi seluruh prasyarat **Quality Gate 1 (Requirements Approved)** dan **Quality Gate 2 Readiness**.

---

## 2. Struktur & Verifikasi Komponen Rencana Pengujian

Verifikasi memastikan bahwa seluruh pilar pengujian telah dibakukan:
1. **Ruang Lingkup Pengujian (In-Scope vs Out-of-Scope):** Mencakup modul pemesanan katalog, kustomisasi buket personal & upload foto referensi, instruksi bayar transfer bank/e-wallet, verifikasi manual mutasi rekening oleh admin, mesin 8 status pesanan, penanganan pembatalan, serta audit keamanan siber.
2. **6 Tingkat Pengujian Terstruktur:**
   - Unit Testing (Otomasi fungsi pembantu dan kalkulasi).
   - Feature & HTTP Testing (Request-response, routing, dan validasi form).
   - Security Penetration Testing (Bypass admin, CSRF, XSS, SQL Injection, upload berkas ilegal).
   - UI/UX & Responsive Testing (Verifikasi visual 360px, 768px, 1280px dan uji cross-browser).
   - Integration Testing (Sinkronisasi antarmuka Blade dengan basis data MySQL).
   - User Acceptance Testing (Skenario nyata terpandu bersama Sponsor Nabila Febriyani).
3. **Matriks 24 Kasus Uji Utama:** Dilengkapi langkah uji konkret, prasyarat, hasil yang diharapkan, serta penanda prioritas kelulusan (P0 Must Have).
4. **Klasifikasi Cacat & Exit Criteria:** Standarisasi tingkat keparahan (P0 Critical, P1 Major, P2 Minor, P3 Cosmetic) dengan aturan 0 toleransi bug kritis sebelum rilis produksi.
5. **Protokol UAT Sponsor:** Rencana walkthrough pengujian langsung di butik BLOOMÉ Samarinda pada 27-28 November 2026.

---

## 3. Kesimpulan & Penutupan Phase 1

### 3.1 Status Task DOC-021
Task **DOC-021 (Menyusun testing-plan.md)** telah selesai dilaksanakan:
- File [testing-plan.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/testing-plan.md) telah tersusun lengkap, konsisten, dan memenuhi seluruh kriteria strategi pengujian perangkat lunak standar industri.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 3.2 Pencapaian Besar: PHASE 1 RESMI SELESAI 100%
Seluruh 21 task pada Phase 1 telah tuntas dikerjakan dan diverifikasi:
- **4.1 Project Foundation:** DOC-001, DOC-002, DOC-003, DOC-004, DOC-005 `[SELESAI]`
- **4.2 Requirements Documentation:** DOC-006, DOC-007, DOC-008, DOC-009, DOC-010 `[SELESAI]`
- **4.3 Product Documentation:** DOC-011, DOC-012, DOC-013, DOC-014, DOC-015 `[SELESAI]`
- **4.4 Technical Documentation:** DOC-016, DOC-017, DOC-018, DOC-019, DOC-020, DOC-021 `[SELESAI]`

### 3.3 Rekomendasi Langkah Berikutnya:
Proyek kini siap melangkah ke **PHASE 2 — SYSTEM ANALYSIS AND DESIGN**:
- **`ANA-001 — Use Case Diagram.`**

