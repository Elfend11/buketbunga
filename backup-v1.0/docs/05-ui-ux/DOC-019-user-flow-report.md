# LAPORAN PENYUSUNAN USER FLOW & ARSITEKTUR NAVIGASI (USER FLOW REPORT)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-019  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.4 Technical Documentation)  
**Penanggung Jawab:** Riya Monika (UI/UX Designer) & Jayanti Firdasari (System Analyst)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dokumen Hasil:** [user-flow.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/user-flow.md) (Versi 1.0 - Official User Flow Baseline)  

---

## 1. Ringkasan Eksekutif

Penyusunan dokumen master `user-flow.md` (Task DOC-019) telah tuntas dilaksanakan. Dokumen ini menjadi pedoman resmi arsitektur navigasi, peta situs (*sitemap*), serta alur interaksi pengguna (*user flow pathways*) untuk seluruh modul publik dan administratif website **BLOOMÉ — Flowers & Stories**.

Dipimpin bersama oleh Riya Monika dan Jayanti Firdasari, dokumen ini memetakan 5 alur interaksi ujung-ke-ujung (*end-to-end flows*) lengkap dengan 6 diagram alur visual Mermaid, mendefinisikan titik percabangan keputusan (*decision nodes*), serta protokol penanganan kasus batas (*edge cases*).

---

## 2. Struktur & Verifikasi Komponen Alur Pengguna

Verifikasi memastikan bahwa seluruh skenario interaksi sistem telah terdefinisi secara presisi:
1. **Sitemap & Arsitektur Informasi:** Memisahkan 11 halaman domain publik (beranda, katalog, detail, checkout katalog, custom form, review harga, instruksi bayar, konfirmasi, about, kontak) dengan 9 modul domain admin terproteksi (`auth:admin`).
2. **User Flow 1: Pemesanan Katalog (*Direct Checkout*):**
   - Penelusuran katalog dan filter kategori → Halaman detail → Form checkout identitas, alamat, ucapan kartu pos, dan tanggal kebutuhan → Transaksi atomik database → Halaman instruksi transfer bank.
3. **User Flow 2: Personalisasi Buket Custom (*Boutique Custom Flow*):**
   - Pengisian form spesifikasi bunga/warna/tema → Unggah berkas referensi foto (JPG/PNG ≤ 5MB) → Tiket custom tersimpan (ST-01) → Admin review & input harga usulan di sistem (ST-02) → Pelanggan meninjau harga: *Approve* (lanjut bayar ST-03) atau *Reject* (batal / revisi chat).
4. **User Flow 3: Pembayaran Manual & Verifikasi Mutasi:**
   - Pelanggan melihat rekening bank/e-wallet resmi → Pelanggan transfer dana dan klik "Saya Sudah Transfer" (ST-04) → Admin mengecek mutasi m-banking di butik → Admin klik "Verifikasi Pembayaran" (ST-05) → Status pesanan siap dirangkai florist (ST-06).
5. **User Flow 4: Pengajuan & Eksekusi Pembatalan:**
   - Validasi status awal pesanan (sebelum bunga dipotong/dirangkai) → Pelanggan input alasan pembatalan → Admin review di dashboard → Keputusan *Approve* (ST-08 Dibatalkan) atau *Reject* (status aktif dipertahankan).
6. **User Flow 5: Alur Kerja Harian Administrator:**
   - Login aman dengan session guard → Dashboard statistik operasional harian → Manajemen produk & kategori → Antrean pesanan terurut tanggal kebutuhan → Pembaruan status berkala (*Sedang Dibuat* → *Selesai*).
7. **Penanganan Kasus Batas (*Edge Cases*):** Transaksi gagal jaringan (DB rollback otomatis), format berkas ilegal ditolak, sesi admin kedaluwarsa diarahkan login, serta blokir aksi pembatalan ilegal.

---

## 3. Kesimpulan & Rekomendasi

### 3.1 Status Task DOC-019
Task **DOC-019 (Menyusun user-flow.md)** telah selesai dilaksanakan:
- File [user-flow.md](file:///c:/Users/Lenovo/OneDrive/ドキュメント/buketbunga/user-flow.md) telah tersusun lengkap, konsisten, dan memenuhi seluruh kriteria arsitektur interaksi pengguna standar industri.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 3.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task teknis berikutnya pada sub-fase 4.4:
- **`DOC-020 — Menyusun implementation-plan.md.`**

