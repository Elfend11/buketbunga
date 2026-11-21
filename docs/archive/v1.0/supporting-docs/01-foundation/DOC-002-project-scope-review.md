# LAPORAN PEMERIKSAAN RUANG LINGKUP PROYEK (PROJECT SCOPE REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-002  
**Fase:** Phase 1 — Project Initiation and Documentation  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Pemeriksaan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-001 — Memeriksa Project Charter (Selesai)  

---

## 1. Ringkasan Eksekutif

Pemeriksaan Ruang Lingkup Proyek (Task DOC-002) bertujuan untuk menetapkan batas tegas (*scope baseline*) dari pengembangan sistem informasi **BLOOMÉ — Flowers & Stories**. Melalui analisis ini, batasan antara fitur yang harus dibangun (*In-Scope*), fitur yang sengaja tidak dikembangkan pada fase awal (*Out-of-Scope*), serta item yang masih menunggu konfirmasi operasional (*Pending Confirmation*) ditetapkan secara transparan.

Langkah ini penting untuk mencegah terjadinya *scope creep* (perluasan ruang lingkup tanpa kontrol) yang berpotensi menyebabkan pembengkakan waktu di luar target akhir (30 November 2026).

---

## 2. Dekomposisi Ruang Lingkup In-Scope

Seluruh modul dan kapabilitas fungsional yang termasuk dalam ruang lingkup proyek dikelompokkan ke dalam dua ranah aktor utama:

### 2.1 Ranah Pelanggan (Public Customer Interface)
Pelanggan berinteraksi dengan sistem sebagai *guest* (tanpa akun/login) untuk kemudahan akses dan kecepatan pemesanan:

| Kode Modul | Nama Modul | Rincian Fungsionalitas In-Scope |
|---|---|---|
| **SCP-CUST-01** | Beranda Publik (Homepage) | Hero section, pengenalan merek BLOOMÉ, sorotan produk unggulan, navigasi kategori, alur promosi buket custom, informasi lokasi/kontak, footer informatif. |
| **SCP-CUST-02** | Katalog & Kategori Produk | Menampilkan katalog produk buket siap pesan, filter berdasarkan kategori (Buket Bunga, Buket Uang, Buket Snack, dll.), badge status ketersediaan (*Tersedia* / *Habis*). |
| **SCP-CUST-03** | Halaman Detail Produk | Menampilkan galeri foto produk, deskripsi buket, harga resmi, kategori, ketersediaan, serta tombol pemesanan langsung (*Direct Order*). |
| **SCP-CUST-04** | Pemesanan Katalog (Catalog Order) | Formulir pengisian identitas pemesan (nama, nomor telepon, alamat pengiriman/penerima), ucapan kartu ucapan (*greeting card*), tanggal kebutuhan buket, serta kalkulasi total harga pesanan katalog. |
| **SCP-CUST-05** | Pengajuan Personalisasi (Custom Bouquet) | Formulir spesifikasi buket kustom: pemilihan jenis/bahan bunga, kombinasi warna, tema buket, catatan khusus pelanggan, serta modul unggah file referensi gambar (JPG/JPEG/PNG maks 5MB). |
| **SCP-CUST-06** | Peninjauan & Persetujuan Harga Custom | Mekanisme bagi pelanggan untuk melihat nominal harga yang diusulkan oleh admin atas buket custom yang diajukan, disertai aksi konfirmasi persetujuan (*Approve*) atau pembatalan (*Reject*). |
| **SCP-CUST-07** | Ringkasan & Instruksi Pembayaran | Menampilkan rincian pesanan (kode pesanan, daftar item/kustomisasi, total biaya) beserta petunjuk pembayaran manual (nomor rekening bank & nomor e-wallet resmi). |
| **SCP-CUST-08** | Konfirmasi Pengajuan & Status Pesanan | Tampilan status konfirmasi setelah pesanan berhasil terkirim ke sistem, memberi kepastian kepada pemesan bahwa data telah masuk ke antrean admin. |
| **SCP-CUST-09** | Halaman Informasi Statis | Halaman *About Us* (profil usaha BLOOMÉ di Samarinda) dan *Contact Us* (tautan media sosial dan petunjuk kontak). |

---

### 2.2 Ranah Pengelola (Admin Dashboard Interface)
Admin merupakan satu-satunya pengguna terautentikasi (pemilik usaha) yang mengelola operasional secara tersentralisasi:

| Kode Modul | Nama Modul | Rincian Fungsionalitas In-Scope |
|---|---|---|
| **SCP-ADM-01** | Autentikasi Admin | Halaman login admin yang dilindungi password hashing dan proteksi CSRF, session management aman, serta fungsi logout. |
| **SCP-ADM-02** | Dashboard Ringkasan | Kartu statistik operasional: total pesanan masuk, pesanan menunggu pembayaran, pesanan dalam proses, permintaan custom baru, dan grafik/ringkasan aktivitas terkini. |
| **SCP-ADM-03** | Manajemen Kategori | Pengelolaan kategori produk buket (Create, Read, Update, Delete) disertai validasi data unik. |
| **SCP-ADM-04** | Manajemen Produk Katalog | Pengelolaan data produk (nama, deskripsi, harga, kategori, status ketersediaan) dan pengunggahan foto produk dengan validasi ukuran & ekstensi file. |
| **SCP-ADM-05** | Manajemen Pesanan Masuk | Daftar seluruh pesanan pelanggan, filter berdasarkan status, rincian detail data pemesan, item pesanan, dan tanggal kebutuhan. |
| **SCP-ADM-06** | Penanganan Permintaan Custom | Meninjau spesifikasi personalisasi, melihat foto referensi yang diunggah pelanggan, dan input nominal penentuan harga manual oleh pemilik usaha. |
| **SCP-ADM-07** | Manajemen & Verifikasi Pembayaran | Pemeriksaan catatan pembayaran manual (metode transfer bank / e-wallet), konfirmasi keabsahan pembayaran manual, dan pencatatan status lunas (*Paid*). |
| **SCP-ADM-08** | Siklus Status Pesanan (8 Status) | Pembaruan status pesanan bertahap: *Pending*, *Awaiting Payment*, *Paid*, *In Process*, *Ready*, *Delivered*, *Cancelled*, *Completed* disertai pencatatan histori perubahan status. |
| **SCP-ADM-09** | Penanganan Pengajuan Pembatalan | Menerima permohonan pembatalan dari pelanggan, meninjau alasan, dan mengeksekusi persetujuan (*Approve*) atau penolakan (*Reject*) pembatalan. |

---

## 3. Batasan Tegas Out-of-Scope (Excluded Features)

Untuk menjaga fokus tim dan mencegah distorsi jadwal rilis, fitur-fitur berikut **secara eksplisit DIKECUALIKAN** dari ruang lingkup proyek fase ini:

1. **Registrasi & Login Pelanggan:** Tidak ada fitur pendaftaran akun, login pelanggan, profil akun, atau manajemen kata sandi pengguna umum.
2. **Payment Gateway Otomatis:** Tidak mengintegrasikan API pihak ketiga seperti Midtrans, Xendit, atau DOKU. Semua pembayaran adalah transfer manual ke rekening pemilik usaha.
3. **Notifikasi Otomatis WhatsApp (WA Gateway API):** Tidak menghubungkan API pesan otomatis WhatsApp berbayar (Fonnte, Wablas, Twilio). Komunikasi tambahan dilakukan manual bila diperlukan.
4. **Portal Pelacakan Mandiri Real-Time:** Tidak ada halaman cek resi atau pelacakan GPS kurir secara langsung oleh pelanggan.
5. **Kalkulator Harga Otomatis untuk Custom:** Tidak membangun algoritma perhitungan harga custom otomatis; penentuan harga murni hak prerogatif admin berdasarkan ketersediaan bahan dan kerumitan desain.
6. **Integrasi Ekspedisi / Kurir Otomatis:** Tidak menghubungkan plugin ongkir otomatis (RajaOngkir, JNE, Gosend, GrabExpress). Biaya dan penanganan kurir disepakati terpisah/manual.
7. **Sistem Multi-Admin / Multi-Role:** Sistem dirancang hanya untuk 1 role admin tunggal (pemilik usaha) tanpa pembagian hak akses bertingkat (*RBAC*).
8. **Modul Akuntansi & Keuangan Lanjutan:** Tidak mencakup pembukuan laba/rugi, neraca, atau laporan perpajakan otomatis.

---

## 4. Analisis Batasan & Asumsi Ruang Lingkup

1. **Asumsi Transaksi Tunggal vs Jamak:** Pada implementasi awal katalog, pesanan berfokus pada pemesanan per buket/produk (apakah satu transaksi dapat menggabungkan banyak produk berbeda masih berstatus `[PERLU KONFIRMASI]`).
2. **Kapasitas Penyimpanan Referensi:** Unggahan gambar dibatasi maksimal 5 MB per gambar dengan format `.jpg`, `.jpeg`, `.png` demi keamanan dan keandalan penyimpanan server.
3. **Penyimpanan Berkas:** Menggunakan *local disk storage* Laravel (`storage/app/public`) yang di-symlink ke folder public, disiapkan agar mudah dimigrasi jika di kemudian hari memerlukan object storage.
4. **Integritas Relasi Basis Data:** Seluruh pembatalan dan perubahan status wajib memiliki jejak histori audit (*order_status_histories*).

---

## 5. Rencana Pengendalian Perubahan Ruang Lingkup (Scope Change Control)

Jika selama fase pengembangan muncul permintaan penambahan fitur di luar dokumen ruang lingkup ini:
1. Permintaan harus diajukan secara formal kepada Project Manager (Jayanti Firdasari).
2. PM dan Technical Lead (Elsa Futri & Riya Monika) melakukan *Impact Assessment* (dampak terhadap batas akhir 30 November 2026 dan beban kerja).
3. Jika permintaan mempengaruhi jadwal atau arsitektur dasar, fitur baru harus ditunda ke rilis Fase 2 (pascauji coba) kecuali disetujui secara tertulis oleh Sponsor Nabila Febriyani dengan penyesuaian jadwal.

---

## 6. Kesimpulan & Status Penyelesaian

- Ruang lingkup proyek BLOOMÉ telah diperiksa secara menyeluruh, selaras 100% dengan `requirement.md`, `prd.md`, dan `architecture.md`.
- Batasan in-scope dan out-of-scope telah terdokumentasi dan siap dijadikan pedoman validasi bagi tim pengembang.
- Kriteria penyelesaian Task **DOC-002** terpenuhi.

### Rekomendasi Langkah Berikutnya:
- Melanjutkan ke **`DOC-003 — Memeriksa pembagian tugas tim.`**

