# ACTIVITY DIAGRAM ALUR PENGAJUAN & PENANGANAN PEMBATALAN
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-006  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-005 — Activity Diagram pembayaran (Selesai)  

---

## 1. Ringkasan Eksekutif

Pemodelan Diagram Aktivitas Pembatalan (Task ANA-006) dilakukan untuk memetakan alur kerja pengajuan permohonan pembatalan pesanan oleh pelanggan serta proses evaluasi dan keputusan persetujuan oleh pemilik usaha pada website **BLOOMÉ — Flowers & Stories**.

Sesuai aturan bisnis **BR-013** (*Pembatalan hanya dapat diajukan sebelum pesanan diproses*) dan **BR-014** (*Pembatalan wajib memerlukan persetujuan admin*), sistem menerapkan aturan pembatas (*guard conditions*) ketat agar pembeli tidak dapat membatalkan pesanan secara sepihak setelah bunga segar dipotong atau dirangkai fisik di butik.

---

## 2. Diagram Aktivitas Pembatalan Pesanan (Swimlane Activity Diagram)

```mermaid
flowchart TD
    %% Initial Node
    StartNode((●)) --> C1

    %% Customer Swimlane
    subgraph Lane_Customer ["Partisipan: Customer (Guest)"]
        C1["Pelanggan Buka Halaman Rincian Pesanan"]
        C2["Klik Tombol 'Ajukan Pembatalan'"]
        C3["Ketik Alasan Pembatalan di Formulir"]
        C4["Klik 'Kirim Permohonan Pembatalan'"]
        C5["Menunggu Peninjauan Admin"]
        C6["Menerima Notifikasi Pesanan Telah Dibatalkan (ST-08)"]
        C7["Menerima Notifikasi Permohonan Ditolak<br>(Pesanan Tetap Diproses)"]
    end

    %% System Swimlane
    subgraph Lane_System ["Partisipan: Sistem Web BLOOMÉ"]
        S1{"Validasi Status Pesanan:<br>Masih ST-01, ST-02, atau ST-03?"}
        S2["Tolak Pengajuan:<br>Tombol Pembatalan Dinonaktifkan<br>'Pesanan Sudah Masuk Tahap Produksi'"]
        S3["Tampilkan Formulir Alasan Pembatalan"]
        S4{"Validasi Alasan Pembatalan Diisi?"}
        S5["Tampilkan Error: 'Alasan pembatalan wajib diisi'"]
        S6["Simpan Permohonan Pembatalan ke Antrean Admin"]
        S7["Tampilkan Notifikasi: 'Permohonan Sedang Ditinjau Admin'"]
        S8["Notifikasi Permohonan Pembatalan Baru di Dashboard"]
        S9["DB Transaction:<br>1. Update Status Pesanan -> ST-08 Dibatalkan<br>2. Catat Keputusan & Admin ID ke 'order_status_histories'<br>3. Kunci Status (Terminal State)"]
        S10["Tampilkan Status Dibatalkan pada Halaman Pesanan"]
        S11["Pertahankan Status Aktif Pesanan Sebelumnya<br>Catat Penolakan Pembatalan di Histori Audit"]
        S12["Tampilkan Status Aktif & Catatan Penolakan ke Pemesan"]
    end

    %% Admin Swimlane
    subgraph Lane_Admin ["Partisipan: Admin (Nabila Febriyani)"]
        A1["Buka Menu 'Pembatalan' di Dashboard"]
        A2["Baca Alasan Pembatalan dari Pemesan"]
        A3["Periksa Progres Fisik Bunga di Butik"]
        A4{"Apakah Pembatalan Disetujui?"}
        A5["Klik Tombol 'Setujui Pembatalan' (Approve)"]
        A6["Klik Tombol 'Tolak Pembatalan' (Reject)"]
        A7{"Apakah Ada Dana Transfer yang Perlu Di-refund?"}
        A8["Admin Lakukan Refund Manual via M-Banking ke Rekening Pemesan"]
        A9["Selesai Tanpa Refund (Belum Ada Pembayaran)"]
    end

    %% Final Nodes
    EndBlocked((◎))
    EndCancelled((◎))
    EndRejected((◎))

    %% Connections across Swimlanes
    C1 --> C2
    C2 --> S1
    
    S1 -- "Tidak (Sudah ST-05 / ST-06 / ST-07)" --> S2
    S2 --> EndBlocked
    
    S1 -- "Ya (Status Awal)" --> S3
    S3 --> C3
    C3 --> C4
    C4 --> S4
    
    S4 -- "Kosong" --> S5
    S5 --> C3
    
    S4 -- "Valid" --> S6
    S6 --> S7
    S6 --> S8
    S7 --> C5
    S8 --> A1
    
    A1 --> A2
    A2 --> A3
    A3 --> A4
    
    A4 -- "Setuju (Approve)" --> A5
    A5 --> S9
    S9 --> S10
    S10 --> A7
    
    A7 -- "Ada Dana" --> A8
    A8 --> C6
    A7 -- "Belum Bayar" --> A9
    A9 --> C6
    C6 --> EndCancelled
    
    A4 -- "Tolak (Reject)" --> A6
    A6 --> S11
    S11 --> S12
    S12 --> C7
    C7 --> EndRejected
```

---

## 3. Analisis Jalur Aktivitas (*Path Analysis*)

### 3.1 Jalur Utama: Pembatalan Disetujui (*Approved Cancellation*)
1. Pelanggan membuka rincian pesanan dan mengklik "Ajukan Pembatalan".
2. Sistem memeriksa status pesanan saat ini. Karena pesanan masih berada pada status awal (`ST-01`, `ST-02`, atau `ST-03`), sistem mengizinkan pembatalan dan membuka formulir alasan.
3. Pelanggan mengetikkan alasan (misal: *"Acara wisuda diundur bulan depan"*) dan mengirimkan permohonan.
4. Sistem mencatat permohonan ke antrean admin dan menampilkan notifikasi *"Permohonan pembatalan Anda sedang ditinjau"*.
5. Admin (Nabila) membuka menu Pembatalan di dashboard, membaca alasan, dan memeriksa bahwa bahan bunga belum dirangkai.
6. Admin mengklik tombol *"Setujui Pembatalan"*.
7. Sistem memperbarui status pesanan menjadi `ST-08 Dibatalkan` (*Terminal State*), mencatat riwayat audit, dan mengunci transaksi dari perubahan lanjutan.
8. Jika pemesan sempat mentransfer dana (status sebelumnya `ST-04` atau `ST-05`), admin melakukan pengembalian dana (*refund*) secara manual melalui transfer bank ke rekening pemesan.
9. Pelanggan menerima pembaruan bahwa pesanan resmi dibatalkan.

### 3.2 Jalur Alternatif: Pembatalan Ditolak (*Rejected Cancellation*)
1. Admin memeriksa permohonan pembatalan, namun mendapati bahwa bunga segar khusus pesanan custom tersebut telah dipotong atau dirangkai sebagian.
2. Admin mengklik tombol *"Tolak Pembatalan"* dan menginput catatan alasan penolakan (misal: *"Mohon maaf, bunga pesanan custom Anda telah dipotong dan sedang dalam tahap perangkaian"*).
3. Sistem mempertahankan status aktif pesanan sebelumnya (misal tetap `ST-03` atau status relevan) dan mencatat jejak penolakan di audit trail.
4. Pelanggan menerima notifikasi bahwa permohonan ditolak dan pesanan buket tetap akan diselesaikan sesuai jadwal.

### 3.3 Jalur Pemblokiran Sistem (*Guard Condition Blocked*)
1. Jika pelanggan mencoba membatalkan pesanan yang telah mencapai status `ST-06 Sedang Dibuat` atau `ST-07 Selesai`, sistem secara otomatis menyembunyikan tombol pembatalan.
2. Jika endpoint diakses langsung via URL, controller backend melempar respon HTTP 403 (*Action Forbidden*) dengan penjelasan bahwa pesanan yang telah diproduksi tidak dapat dibatalkan.

---

## 4. Kepatuhan Terhadap Aturan Bisnis Proyek

Alur aktivitas pembatalan ini menjamin penerapan aturan bisnis secara mutlak:
- **BR-013 (Batas Waktu Pengajuan):** Pengajuan dibatasi ketat sebelum pesanan masuk tahap perangkaian fisik florist.
- **BR-014 (Kewenangan Pembatalan):** Pelanggan tidak memiliki wewenang membatalkan transaksi secara mandiri; keputusan final murni hak prerogatif admin pemilik usaha.
- **Terminal State Guard:** Pesanan yang berstatus `ST-08 Dibatalkan` tidak dapat diaktifkan kembali secara sepihak untuk mencegah kekacauan data inventaris dan keuangan.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-006
Task **ANA-006 (Activity Diagram pembatalan)** telah selesai dilaksanakan:
- Diagram aktivitas alur pengajuan pembatalan, peninjauan admin, eksekusi persetujuan/penolakan, serta penanganan refund manual telah dimodelkan menggunakan format visual Mermaid.
- Aturan pembatas (*guard condition*) dan pencatatan audit histori terpetakan lengkap.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task pemodelan diagram sekuensial berikutnya pada sub-fase 5.2:
- **`ANA-007 — Sequence Diagram pemesanan.`**

