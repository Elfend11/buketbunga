# ACTIVITY DIAGRAM ALUR PENGAJUAN & PENANGANAN PEMBATALAN VIA WHATSAPP
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-006  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-005 — Activity Diagram alur pembayaran via WhatsApp (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pembatalan (Task ANA-006) dilakukan untuk menggambarkan alur komunikasi pengajuan pembatalan pesanan atau perubahan detail oleh pelanggan serta proses evaluasi dan keputusan oleh pemilik usaha (Nabila Febriyani) melalui saluran obrolan WhatsApp untuk pesanan buket **BLOOMÉ — Flowers & Stories**.

Sesuai dengan keputusan proses bisnis terbaru (v1.1):
- **Website TIDAK memiliki modul pembatalan atau pengubahan pesanan.**
- **Website TIDAK menyimpan status pesanan aktif atau memproses pengembalian dana (*refund*).**
- **Seluruh permohonan pembatalan, revisi ucapan kartu, maupun perubahan jadwal pengiriman dibicarakan dan dikoordinasikan secara langsung melalui WhatsApp.**

Sesuai aturan bisnis **BR-013** (*Pembatalan hanya dapat disetujui jika bunga segar belum dipotong atau dirangkai fisik*) dan **BR-014** (*Keputusan pembatalan berada penuh di tangan pemilik usaha*), diagram ini memodelkan pertimbangan florist terhadap kondisi fisik bahan baku sebelum menyetujui pembatalan.

---

## 2. Diagram Aktivitas Penanganan Pembatalan via WhatsApp (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Pelanggan Buka Chat WhatsApp Toko BLOOMÉ"]
        C2["Kirim Pesan Pengajuan Pembatalan:<br>- Sebutkan Nama & Rincian Buket Dipesan<br>- Sampaikan Alasan Pembatalan Pesanan"]
        C3["Menunggu Peninjauan oleh Pemilik Toko"]
        C4["Terima Pemberitahuan: Pembatalan Disetujui"]
        C5["Sampaikan Nomor Rekening untuk Pengembalian Dana (Refund)"]
        C6["Terima Bukti Transfer Refund dari Pemilik Usaha"]
        C7["Terima Penjelasan Santun: Pembatalan Ditolak<br>(Bunga Segar Telah Dirangkai Fisik)"]
        C8["Pesanan Tetap Diproses & Diantar Sesuai Jadwal"]
    end

    %% WhatsApp & Owner Swimlane (Outside Web)
    subgraph Lane_Owner ["Partisipan: WhatsApp & Pemilik Usaha (Nabila)"]
        W1["Terima Pesan Pengajuan Pembatalan di WhatsApp"]
        W2["Periksa Progres Fisik Pengerjaan Buket di Butik Samarinda"]
        W3{"Apakah Bunga Segar Sudah Dipotong / Dirangkai Fisik?"}
        W4["Sampaikan Penolakan Pembatalan secara Sopan:<br>'Bunga segar sudah dipotong dan tidak dapat dikembalikan'"]
        W5["Setujui Pembatalan Pesanan"]
        W6{"Apakah Sudah Ada Dana Masuk (DP 50% / Lunas)?"}
        W7["Konfirmasi Pembatalan Tuntas (Belum Ada Pembayaran)"]
        W8["Hitung Besaran Refund Sesuai Kebijakan Toko [Perlu Konfirmasi Owner]"]
        W9["Minta Rekening Bank / E-Wallet Pelanggan"]
        W10["Lakukan Transfer Pengembalian Dana via M-Banking"]
        W11["Kirim Bukti Transfer Refund di Chat WhatsApp"]
    end

    %% Final Nodes
    EndApprovedNoPay((◎))
    EndApprovedRefund((◎))
    EndRejected((◎))

    %% Connections across Swimlanes
    C1 --> C2
    C2 --> W1
    W1 --> W2
    W2 --> W3
    
    W3 -- "Sudah Dipotong / Dirangkai" --> W4
    W4 --> C7
    C7 --> C8
    C8 --> EndRejected
    
    W3 -- "Belum Dipotong (Bahan Masih Utuh)" --> W5
    W5 --> W6
    
    W6 -- "Belum Bayar" --> W7
    W7 --> C4
    C4 --> EndApprovedNoPay
    
    W6 -- "Ada Pembayaran Masuk" --> W8
    W8 --> W9
    W9 --> C4
    C4 --> C5
    C5 --> W10
    W10 --> W11
    W11 --> C6
    C6 --> EndApprovedRefund
```

---

## 3. Penjelasan Batas Sistem & Kebijakan Bunga Segar

### 3.1 Mengapa Pembatalan Tidak Dilakukan di Website?
1. **Sifat Produk yang Mudah Rusak (*Perishable Goods*):** Bunga segar (*fresh cut flowers*) yang telah dipotong dari batangnya memiliki masa simpan terbatas dan tidak dapat dijual kembali kepada pelanggan lain jika pesanan dibatalkan sepihak. Tombol pembatalan otomatis di website berisiko merugikan butik secara finansial jika ditekan saat buket sudah setengah jadi.
2. **Kebutuhan Diskusi Alternatif:** Sering kali pelanggan membatalkan pesanan bukan karena tidak ingin buketnya, melainkan karena jadwal acara wisuda yang bergeser. Melalui obrolan WhatsApp, florist Nabila dapat menawarkan solusi penjadwalan ulang (*reschedule*) waktu pengiriman alih-alih pembatalan total.

### 3.2 Ketentuan Pengembalian Dana (Refund Policy)
- **Status Kebijakan:** Kebijakan persentase pengembalian dana uang muka (DP) apabila pembatalan dilakukan jauh hari (misal: H-2 sebelum pembuatan) masih berstatus **`[Perlu Konfirmasi Owner]`**.
- **Eksekusi Pengembalian Dana:** Seluruh pengembalian dana ditransfer secara manual oleh Nabila Febriyani melalui mobile banking langsung ke rekening atau nomor e-wallet yang diberikan pelanggan di chat WhatsApp.

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task ANA-006
Task **ANA-006 (Activity Diagram Pembatalan)** telah selesai diselaraskan:
- Seluruh logika form pembatalan di website, tabel riwayat pembatalan, dan mesin status `ST-08` di web telah dieliminasi.
- Alur pengajuan pembatalan manual, verifikasi status fisik bunga segar, dan pengembalian dana via WhatsApp telah dimodelkan secara realistis.
- Kriteria penyelesaian terpenuhi 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram sekuensial (Sequence Diagrams):
- **`ANA-007 — Sequence Diagram eksplorasi katalog, konfigurasi personalisasi, dan WhatsApp hand-off.`**
