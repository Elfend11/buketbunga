# LAPORAN PENINJAUAN USER STORIES & SKENARIO PENERIMAAN (USER STORIES REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-014  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.3 Product Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-013 — Meninjau user personas (Selesai)  

---

## 1. Ringkasan Eksekutif

Peninjauan Cerita Pengguna (Task DOC-014) dilakukan untuk memvalidasi kelengkapan, ketajaman nilai, serta keterujian (*testability*) dari seluruh **User Stories** yang menjadi jembatan antara kebutuhan bisnis pengguna (*Customer* dan *Admin*) dengan implementasi kode teknis website **BLOOMÉ — Flowers & Stories**.

Hasil peninjauan mengonfirmasi terdapat **26 User Stories Terstruktur (US-001 s/d US-026)** yang mencakup seluruh alur fungsional produk. Seluruh cerita pengguna telah diaudit menggunakan kriteria kualitas internasional **INVEST** (*Independent, Negotiable, Valuable, Estimable, Small, Testable*) dan dilengkapi skenario penerimaan berformat *Given-When-Then*.

---

## 2. Katalog Lengkap User Stories & Skenario Keberimaan

### 2.1 Klaster 1: Eksplorasi Katalog & Informasi Produk (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-001** | *Sebagai pelanggan, saya ingin melihat halaman beranda yang memuat identitas butik dan produk unggulan, agar saya dapat mengenal BLOOMÉ dan menemukan inspirasi kado.* | **Given** pelanggan membuka URL utama, **When** halaman selesai dimuat, **Then** tampil hero banner estetik, sorotan buket favorit, navigasi kategori, dan informasi lokasi Samarinda. |
| **US-002** | *Sebagai pelanggan, saya ingin menelusuri katalog buket bunga berdasarkan kategori, agar saya dapat menemukan buket yang sesuai tema acara.* | **Given** pelanggan di halaman katalog, **When** memilih filter "Buket Bunga", **Then** daftar produk hanya menampilkan buket bunga dengan harga dan status ketersediaan. |
| **US-003** | *Sebagai pelanggan, saya ingin melihat halaman detail produk dengan foto resolusi tajam dan deskripsi rangkaian, agar saya yakin dengan komposisi bunga sebelum membeli.* | **Given** pelanggan mengklik kartu buket, **When** detail terbuka, **Then** tampil galeri foto, rincian bahan/bunga, harga pas, dan tombol CTA "Pesan Sekarang". |
| **US-004** | *Sebagai pelanggan, saya ingin melihat badge ketersediaan produk (Tersedia / Habis), agar saya tidak memesan buket yang stok bunganya sedang kosong.* | **Given** sebuah produk buket berstatus stok habis, **When** pelanggan membuka produk, **Then** tombol pesan dinonaktifkan dengan label "Stok Habis". |

---

### 2.2 Klaster 2: Pemesanan Buket Katalog (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-005** | *Sebagai pelanggan, saya ingin mengisi formulir pemesanan katalog tanpa registrasi akun, agar saya dapat memesan dengan cepat dalam hitungan menit.* | **Given** pelanggan menekan tombol pesan pada buket katalog, **When** mengisi nama, WhatsApp, dan alamat, **Then** form berhasil disubmit tanpa permintaan password/login. |
| **US-006** | *Sebagai pelanggan, saya ingin menyertakan teks pesan kartu ucapan saat checkout, agar penerima buket membaca pesan personal saya.* | **Given** form pemesanan terbuka, **When** pelanggan mengetik pesan ucapan, **Then** pesan tersimpan utuh dan tertera pada ringkasan pesanan. |
| **US-007** | *Sebagai pelanggan, saya ingin menentukan tanggal kebutuhan buket, agar pesanan saya siap tepat pada hari perayaan.* | **Given** form pemesanan terbuka, **When** pelanggan memilih tanggal kalender, **Then** sistem memvalidasi tanggal (minimal H+1 atau sesuai ketentuan) dan mencatat tanggal pengiriman. |

---

### 2.3 Klaster 3: Pengajuan & Personalisasi Buket Custom (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-008** | *Sebagai pelanggan, saya ingin mengisi formulir kustomisasi buket (pilihan bahan, palet warna, dan tema), agar florist memahami konsep buket impian saya.* | **Given** pelanggan membuka halaman Custom Bouquet, **When** memilih preferensi bunga dan skema warna, **Then** data kustomisasi terekam ke tiket permintaan custom. |
| **US-009** | *Sebagai pelanggan, saya ingin mengunggah foto referensi buket (JPG/PNG ≤ 5MB), agar florist memiliki acuan visual yang presisi.* | **Given** form custom terbuka, **When** pelanggan mengunggah berkas gambar valid, **Then** sistem menampilkan pratinjau thumbnail dan menyimpan berkas di storage aman. |
| **US-010** | *Sebagai pelanggan, saya ingin meninjau usulan harga custom dari florist, agar saya mengetahui nominal resmi sebelum membayar.* | **Given** admin telah menginput harga usulan, **When** pelanggan membuka halaman peninjauan harga, **Then** tampil nominal harga, rincian custom, dan tombol keputusan. |
| **US-011** | *Sebagai pelanggan, saya ingin menyetujui usulan harga custom (*Approve*), agar pesanan saya dapat dilanjutkan ke tahap pembayaran.* | **Given** pelanggan di halaman peninjauan harga, **When** mengklik "Setujui Harga", **Then** status pesanan bergeser ke *Menunggu Pembayaran* dan tampil rekening bank. |
| **US-012** | *Sebagai pelanggan, saya ingin menolak harga custom (*Reject*) jika melampaui bujet saya, agar saya tidak terikat komitmen biaya.* | **Given** pelanggan di halaman peninjauan harga, **When** mengklik "Tolak", **Then** sistem mencatat penolakan dan memberi opsi kontak revisi atau pembatalan. |

---

### 2.4 Klaster 4: Pembayaran & Verifikasi Manual (Customer & Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-013** | *Sebagai pelanggan, saya ingin melihat instruksi nomor rekening bank dan e-wallet resmi, agar saya dapat mentransfer pembayaran dengan benar.* | **Given** pesanan berstatus *Menunggu Pembayaran*, **When** pelanggan membuka petunjuk bayar, **Then** tampil nomor rekening BCA/BRI/Mandiri & e-wallet resmi atas nama BLOOMÉ. |
| **US-014** | *Sebagai pelanggan, saya ingin mengonfirmasi bahwa saya telah melakukan transfer, agar admin segera memeriksa mutasi pembayaran saya.* | **Given** pelanggan telah mentransfer dana, **When** menekan tombol konfirmasi bayar, **Then** status pesanan bergeser menjadi *Menunggu Konfirmasi Pembayaran*. |
| **US-015** | *Sebagai admin, saya ingin melihat daftar pembayaran pesanan yang masuk, agar saya dapat mengecek mutasi rekening secara teratur.* | **Given** admin login di dashboard, **When** membuka menu Pembayaran, **Then** tampil tabel transaksi dengan rincian kode pesanan, nama pemesan, dan nominal. |
| **US-016** | *Sebagai admin, saya ingin memverifikasi keabsahan transfer secara manual, agar perangkaian bunga hanya dimulai setelah dana dipastikan masuk.* | **Given** admin mencocokkan mutasi rekening, **When** menekan "Verifikasi Pembayaran", **Then** status transaksi berubah menjadi *Pembayaran Dikonfirmasi*. |

---

### 2.5 Klaster 5: Manajemen Pesanan, Status, & Pembatalan (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-017** | *Sebagai admin, saya ingin melihat antrean seluruh pesanan masuk dengan filter status, agar saya dapat memprioritaskan pengerjaan buket harian.* | **Given** admin di menu Pesanan, **When** memfilter status "Sedang Dibuat", **Then** daftar pesanan terurut rapi berdasarkan tanggal pengiriman terdekat. |
| **US-018** | *Sebagai admin, saya ingin meninjau rincian tiket custom dan foto referensi, agar saya dapat menaksir harga bahan baku secara akurat.* | **Given** ada pesanan custom baru, **When** admin membuka detail custom, **Then** foto referensi tampil jelas dan tersedia form input nominal harga. |
| **US-019** | *Sebagai admin, saya ingin memperbarui status pesanan menjadi "Sedang Dibuat" dan "Selesai", agar riwayat kerja florist tercatat rapi.* | **Given** buket mulai dirangkai/tuntas, **When** admin memilih status baru, **Then** status pesanan terupdate dan riwayat tercatat di audit trail histori. |
| **US-020** | *Sebagai pelanggan, saya ingin mengajukan pembatalan pesanan sebelum buket dirangkai, agar pesanan saya tidak diteruskan jika terjadi keadaan darurat.* | **Given** pesanan masih dalam status awal, **When** pelanggan mengajukan permohonan pembatalan beserta alasan, **Then** permohonan masuk ke antrean review admin. |
| **US-021** | *Sebagai admin, saya ingin meninjau alasan pembatalan dan menyetujui atau menolaknya, agar keputusan pembatalan tetap berada di kendali pemilik usaha.* | **Given** ada permohonan pembatalan, **When** admin menekan "Approve Batal", **Then** status pesanan beralih ke *Dibatalkan*; jika ditolak, status aktif dipertahankan. |

---

### 2.6 Klaster 6: Autentikasi Admin & Manajemen Master Data (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-022** | *Sebagai admin, saya ingin login menggunakan email dan password terenkripsi, agar panel admin aman dari akses pihak luar.* | **Given** admin di halaman login, **When** memasukkan kredensial valid, **Then** diarahkan ke dashboard; jika password salah, muncul peringatan kesalahan. |
| **US-023** | *Sebagai admin, saya ingin melihat kartu statistik ringkasan di dashboard, agar saya dapat memantau denyut operasional usaha secara cepat.* | **Given** admin berhasil login, **When** dashboard terbuka, **Then** tampil kartu metrik pesanan baru, pesanan belum bayar, custom baru, dan grafik ringkas. |
| **US-024** | *Sebagai admin, saya ingin menambah, mengubah, dan menghapus kategori buket, agar pengelompokan produk tetap fleksibel.* | **Given** admin di menu Kategori, **When** menyimpan kategori baru, **Then** kategori tersimpan dan langsung muncul pada filter katalog publik. |
| **US-025** | *Sebagai admin, saya ingin menambah produk buket baru lengkap dengan unggah foto dan harga, agar etalase katalog selalu terbarui.* | **Given** admin di form Tambah Produk, **When** mengunggah foto dan mengisi harga, **Then** berkas tersimpan di storage dan produk tayang di katalog. |
| **US-026** | *Sebagai admin, saya ingin mengubah status ketersediaan buket (*In Stock* / *Out of Stock*), agar pelanggan tahu ketersediaan bunga secara real-time.* | **Given** bahan bunga habis di butik, **When** admin mengubah toggle ketersediaan menjadi habis, **Then** status di katalog otomatis berubah menjadi "Habis". |

---

## 3. Evaluasi Kualitas User Stories (Audit Kriteria INVEST)

| Kriteria INVEST | Analisis Kepatuhan Cerita Pengguna BLOOMÉ | Status Kepatuhan |
|---|---|:---:|
| **Independent (Mandiri)** | Setiap cerita dapat dikembangkan dan diuji secara terisolasi tanpa dependensi sirkular antar modul. | **Lolos 100%** |
| **Negotiable (Dapat Dinegosiasikan)** | Rincian implementasi teknis (seperti tata letak form) terbuka untuk penyesuaian selama tidak melanggar aturan bisnis. | **Lolos 100%** |
| **Valuable (Bernilai Nyata)** | Setiap cerita memberikan nilai langsung bagi kenyamanan pembeli atau efisiensi pemilik usaha. | **Lolos 100%** |
| **Estimable (Dapat Diestimasi)** | Ruang lingkup setiap cerita jelas sehingga Elsa Futri dan Riya Monika dapat memperkirakan jam kerja coding. | **Lolos 100%** |
| **Small (Ukuran Tepat)** | Tidak ada cerita bertipe "Epic raksasa"; seluruh cerita dirancang selesai dalam 1-3 hari kerja per task. | **Lolos 100%** |
| **Testable (Dapat Diuji)** | Setiap cerita memiliki skenario penerimaan eksplisit berformat *Given-When-Then* yang dapat diverifikasi saat QA. | **Lolos 100%** |

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-014
Task **DOC-014 (Meninjau user stories)** telah selesai dilaksanakan:
- 26 User Stories terstruktur lengkap dengan skenario penerimaan (*Acceptance Criteria*) telah ditinjau dan divalidasi.
- Seluruh cerita memenuhi standar kualitas INVEST dan selaras dengan 29 fitur produk (F-001 s/d F-029).
- Kriteria penyelesaian terpenuhi.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task penutup sub-fase 4.3:
- **`DOC-015 — Meninjau product priorities.`**

