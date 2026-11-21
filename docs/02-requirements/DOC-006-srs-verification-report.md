# LAPORAN VERIFIKASI PENYUSUNAN REQUIREMENT.MD (SRS VERIFICATION REPORT) (v1.1)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-006  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.2 Requirements Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Verifikasi Awal:** 13 November 2026  
**Tanggal Revisi Penyelarasan:** 20 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Acuan:** `requirement.md` (Versi 1.1 - Approved Requirement Baseline)  

---

## 1. Ringkasan Eksekutif

Penyusunan dan verifikasi dokumen master `requirement.md` (Task DOC-006) telah berhasil diperbarui dan diselaraskan ke baseline **v1.1**. Dokumen ini bertindak sebagai **Software Requirements Specification (SRS)** resmi yang menjadi *Single Source of Truth* kebutuhan fungsional, nonfungsional, arsitektural, dan aturan bisnis bagi seluruh anggota tim pengembang website **BLOOMÉ — Flowers & Stories**.

Berdasarkan kesepakatan final proses bisnis antara tim pengembang dan pemilik usaha (Nabila Febriyani):
> **"Website BLOOMÉ berfungsi sebagai katalog interaktif dan media personalisasi buket bunga, sedangkan proses transaksi pemesanan, konfirmasi ketersediaan bahan, negosiasi harga, pembayaran, dan koordinasi pengiriman dilanjutkan secara langsung melalui WhatsApp."**

Dokumen `requirement.md` memuat 11 bab terstruktur yang memandu perancangan sistem, desain antarmuka, pembuatan basis data 10 entitas, penulisan kode Laravel, hingga pengujian mutu.

---

## 2. Struktur & Cakupan Dokumen Master `requirement.md` (v1.1)

Verifikasi memastikan bahwa seluruh komponen standar IEEE 830 / ISO-IEC 25010 untuk Software Requirements Specification telah disesuaikan dengan arsitektur sistem katalog dan pemesanan WhatsApp:

| No. Bab | Judul Bab | Cakupan Analisis (v1.1) | Status Verifikasi |
|---|---|---|:---:|
| **Bab 1** | **Project Overview** | Deskripsi sistem etalase digital, 7 tujuan strategis, batasan tegas in-scope & out-of-scope. | Terverifikasi Lengkap |
| **Bab 2** | **System Users and Actors** | Hak akses & batasan Customer (Guest User tanpa login) dan Admin tunggal (pemilik toko). | Terverifikasi Lengkap |
| **Bab 3** | **Functional Requirements** | FR-001 s/d FR-012 (Katalog publik, personalisasi, add-on, kalkulator estimasi live, link WhatsApp, CTA custom) dan FR-013 s/d FR-025 (Admin autentikasi, kategori, produk, galeri, personalisasi, add-on, settings). | Terverifikasi Lengkap |
| **Bab 4** | **Alur Operasional Pemesanan WhatsApp** | Batas tanggung jawab web vs alur komunikasi, pembayaran DP 50%, bukti bayar, dan pengantaran via WhatsApp (Off-Web Process). | Terverifikasi Lengkap |
| **Bab 5** | **Business Rules** | 20 Aturan Bisnis Wajib (BR-001 s/d BR-020) yang mengunci logika operasional toko. | Terverifikasi Lengkap |
| **Bab 6** | **Non-Functional Requirements** | Kriteria kualitas: Usabilitas, Responsivitas mobile first, Performa load time ≤ 2s, Keamanan (Bcrypt, CSRF, XSS, sanitasi upload), dan Maintainability. | Terverifikasi Lengkap |
| **Bab 7** | **UI & Visual Identity Requirements** | Konsep *Elegant Floral Boutique*, palet warna resmi terkunci, tipografi Playfair Display & Poppins, serta border radius baku. | Terverifikasi Lengkap |
| **Bab 8** | **Struktur Halaman Website** | Inventarisasi 6 halaman publik (PAGE-C01 s/d C06) dan 9 halaman panel admin (PAGE-A01 s/d A09). | Terverifikasi Lengkap |
| **Bab 9** | **Kriteria Penerimaan Sistem** | Acceptance criteria terukur untuk pelanggan publik dan admin pengelola. | Terverifikasi Lengkap |
| **Bab 10**| **Parameter Menunggu Konfirmasi** | Matriks 14 parameter terbuka berstatus `[Perlu Konfirmasi Owner]` agar tidak diasumsikan sepihak. | Terverifikasi Lengkap |
| **Bab 11**| **Pengesahan Dokumen SRS** | Berita acara pengesahan resmi oleh Jayanti Firdasari, Riya Monika, Elsa Futri, dan Nabila Febriyani. | Terverifikasi Lengkap |

---

## 3. Penyelarasan Antar Dokumen Proyek (*Cross-Document Alignment*)

Dokumen `requirement.md` telah diaudit terhadap dokumen acuan lainnya:
1. **Penyelarasan dengan Dokumen Foundation (`DOC-001` s/d `DOC-005`):**
   - Tidak ada kontradiksi ruang lingkup: sistem mempertahankan model guest user tanpa checkout di web, mengeliminasi tabel transaksi, dan mengalihkan pemesanan ke WhatsApp.
   - Sesuai dengan jadwal 13 Oktober – 30 November 2026 dan pembagian peran tim.
2. **Penyelarasan dengan Arsitektur Teknis (`architecture.md` & `database-design.md`):**
   - Mendukung penuh Three-Layer Architecture dan relasi 10 entitas basis data etalase dan personalisasi.
3. **Penyelarasan dengan `task.md` & `testing-plan.md`:**
   - Seluruh kebutuhan fungsional (FR-001 s/d FR-025) memiliki padanan task implementasi backend/frontend dan test cases teruji.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-006
Task **DOC-006 (Menyusun requirement.md)** telah selesai diselaraskan dan diverifikasi:
- File [requirement.md](../../requirement.md) telah berstatus **Approved Requirement Baseline v1.1**.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan mendalam pada sub-fase 4.2:
- **`DOC-007 — Meninjau functional requirements.`**
