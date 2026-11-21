# LAPORAN PENYUSUNAN PRODUCT REQUIREMENTS DOCUMENT (PRD COMPILATION REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-011  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.3 Product Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [prd.md](../../prd.md) (Versi 1.1 - Official Product Baseline)

---

## 1. Ringkasan Eksekutif

Penyusunan dokumen master `prd.md` (Task DOC-011) telah tuntas diselaraskan. Dokumen ini mendokumentasikan spesifikasi **Product Requirements Document (PRD)** resmi yang komprehensif, terstruktur, profesional, dan menjadi acuan utama perancangan visual UI/UX, tata letak antarmuka, serta implementasi fitur teknis sistem **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan dan persetujuan tim terbaru (Versi 1.1), sistem informasi BLOOMÉ difokuskan sebagai **website katalog interaktif dan media personalisasi buket bunga, sedangkan proses pemesanan, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**.

Dokumen ini melengkapi `requirement.md` (SRS v1.1) dengan berfokus pada visi produk, *value proposition*, pemetaan persona pengguna, *user journeys* interaktif, arsitektur informasi, spesifikasi 29 fitur produk (F-001 s/d F-029), matriks prioritisasi MoSCoW, serta kriteria keberhasilan produk (KPI).

---

## 2. Struktur & Verifikasi Komponen PRD (Versi 1.1)

Penyusunan `prd.md` mencakup seluruh aspek produk esensial:

1. **Identitas & Konteks Bisnis (Bab 1 s/d 4):**
   - Penegasan visi dan positioning BLOOMÉ sebagai butik buket bunga personal terkemuka di Samarinda (*Flowers & Stories*).
   - Analisis mendalam keterbatasan etalase media sosial manual dan peluang digitalisasi katalog interaktif 24/7.
2. **Pengguna & Persona (Bab 5 & 6):**
   - Tiga persona representatif: *Fast & Aesthetic Buyer* (Dinda Kirana), *Thoughtful Custom Gift Giver* (Reza Pratama), dan *Florist Owner / Solopreneur* (Nabila Febriyani).
   - Value Proposition Canvas yang memetakan kebutuhan pelanggan (*Customer Jobs, Pains, Gains*) dengan fitur katalog interaktif, konfigurator personalisasi, dan direct WhatsApp order dispatch.
3. **Ruang Lingkup Produk & Batasan Operasional (Bab 7):**
   - Batasan tegas in-scope vs out-of-scope (tanpa login pelanggan, tanpa checkout di web, tanpa penyimpanan transaksi di database web, tanpa payment gateway, tanpa order tracking status di web, dan tanpa bot WhatsApp API berbayar).
4. **Spesifikasi 29 Fitur Produk Terperinci (Bab 8):**
   - Pemetaan fitur fungsional lengkap (F-001 s/d F-029) yang terbagi dalam ranah publik pelanggan (katalog, personalisasi, add-on, kalkulator estimasi live, generator WhatsApp) dan ranah privat administrator (dashboard etalase, master kategori, master produk & ketersediaan stok, galeri foto multi-upload, opsi personalisasi & nilai variasi, master add-on, dan konfigurasi kontak WhatsApp).
5. **User Stories & User Journeys (Bab 9 & 10):**
   - 26 Kisah pengguna terstruktur (*Given-When-Then*) yang mencerminkan alur pemesanan langsung ke WhatsApp.
   - Diagram alur Mermaid komprehensif: *Catalog Exploration Journey*, *Personalization & Add-on Configuration Journey*, *WhatsApp Ordering Hand-off Journey*, dan *Custom Bouquet WhatsApp Consultation Journey*.
6. **Integrasi Operasional WhatsApp & Aturan Bisnis (Bab 11):**
   - Standarisasi format template pesan pemesanan dan alur interaksi chat manual (konfirmasi stok, negosiasi harga, pembayaran transfer/e-wallet, konfirmasi DP 50%, dan koordinasi kurir lokal Samarinda / pickup).
7. **Desain Sistem & Spesifikasi UI/UX (Bab 12):**
   - Token warna resmi (*Primary Pink #E99AAF, Soft Pink #F6DDE3, Burgundy #642D36, Soft Cream #FFF8F6, Dark Charcoal #333333*), tipografi *Playfair Display* & *Poppins*, serta spesifikasi komponen kartu, pemilih warna (*swatches*), dan tombol WhatsApp.
8. **Prioritisasi MoSCoW & Rencana Rilis (Bab 13 & 14):**
   - Matriks klasifikasi fitur P0 *Must Have*, P1 *Should Have*, P2 *Could Have*, dan P3 *Won't Have*.
   - Target KPI operasional dan strategi mitigasi risiko non-teknis.
9. **Log Keterbukaan & Glosarium (Bab 15 s/d 19):**
   - Log 14 parameter pending confirmation (`[Perlu Konfirmasi Owner]`) serta kamus istilah produk florikultura dan teknis.

---

## 3. Kesimpulan & Rekomendasi

### 3.1 Status Task DOC-011
Task **DOC-011 (Menyusun prd.md)** telah selesai dilaksanakan:
- Dokumen master [prd.md](../../prd.md) telah diselaraskan penuh dengan konsep website katalog & media personalisasi buket bunga dengan pemesanan via WhatsApp.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 3.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan mendalam pada sub-fase 4.3:
- **`DOC-012 — Meninjau product vision.`**
