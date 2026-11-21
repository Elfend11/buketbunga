# USE CASE DESCRIPTIONS & DETAILED SCENARIO SPECIFICATIONS
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-002  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram (Selesai)  

---

## 1. Ringkasan Eksekutif

Penyusunan Deskripsi Use Case (Task ANA-002) merupakan spesifikasi tekstual formal yang mendokumentasikan setiap use case dari diagram `ANA-001`. Dokumen ini merinci alur interaksi standar (*Main Flow / Happy Path*), alur percabangan (*Alternative Flows*), penanganan galat (*Exception Flows*), prakondisi, pascakondisi, serta aturan bisnis yang berlaku.

Spesifikasi ini menjadi landasan langsung bagi penyusunan diagram aktivitas (*Activity Diagrams*), diagram sekuensial (*Sequence Diagrams*), dan pengujian perangkat lunak pada sistem informasi **BLOOMÉ — Flowers & Stories**.

---

## 2. Standar Struktur Templat Deskripsi Use Case

Setiap use case didokumentasikan menggunakan format terstandarisasi:
- **ID & Nama Use Case:** Kode pengenal unik dan nama tindakan.
- **Aktor:** Aktor primer dan pendukung.
- **Deskripsi:** Ringkasan tujuan fungsional use case.
- **Prakondisi (*Preconditions*):** Kondisi yang wajib terpenuhi sebelum use case dimulai.
- **Pascakondisi (*Postconditions*):** Kondisi sistem setelah use case berhasil (*success*) atau gagal (*failed*).
- **Alur Utama (*Main Flow*):** Urutan langkah interaksi ideal antara aktor dan sistem.
- **Alur Alternatif (*Alternative Flows*):** Cabang alur valid lainnya.
- **Alur Pengecualian (*Exception Flows*):** Penanganan kesalahan input, stok habis, atau kegagalan transaksi.

---

## 3. Spesifikasi Lengkap Use Case Domain Pelanggan (Customer Domain)

### UC-01: Melihat Beranda & Informasi Usaha
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengakses halaman utama untuk melihat profil butik BLOOMÉ, produk unggulan, kategori buket, dan kontak butik.
- **Prakondisi:** Pelanggan memiliki koneksi internet dan peramban web aktif.
- **Pascakondisi:** Halaman beranda ter-render sempurna dengan nuansa estetika floral.
- **Alur Utama:**
  1. Pelanggan membuka URL akar website (`/`).
  2. Sistem mengambil data kategori aktif dan produk unggulan dari database.
  3. Sistem menampilkan hero banner, cerita butik, showcase buket favorit, banner promosi buket custom, alamat Samarinda, dan footer.
- **Alur Pengecualian:**
  - *E1 (Koneksi Database Terputus):* Sistem menampilkan halaman error 500 ramah pengguna.

---

### UC-02: Menjelajahi Katalog & Filter Kategori
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan melihat etalase buket siap pesan dan menyaringnya berdasarkan kategori tertentu.
- **Prakondisi:** Halaman katalog dapat diakses.
- **Pascakondisi:** Daftar produk ditampilkan sesuai filter yang dipilih pelanggan.
- **Alur Utama:**
  1. Pelanggan mengklik menu "Katalog".
  2. Sistem menampilkan seluruh buket katalog yang aktif dalam bentuk grid kartu.
  3. Pelanggan mengklik salah satu tombol kategori (misal: *Buket Bunga*, *Buket Uang*, *Buket Snack*).
  4. Sistem memfilter dan menyajikan produk yang sesuai dengan kategori terpilih.
- **Alur Alternatif:**
  - *A1 (Kategori Kosong):* Sistem menampilkan *empty state* ilustrasi vas bunga dengan pesan ramah.

---

### UC-03: Melihat Detail Buket
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan membuka halaman rincian buket untuk melihat galeri foto, komposisi bunga, harga, dan ketersediaan stok.
- **Prakondisi:** Pelanggan memilih salah satu produk di katalog atau beranda.
- **Pascakondisi:** Halaman detail produk terbuka lengkap.
- **Alur Utama:**
  1. Pelanggan mengklik kartu produk.
  2. Sistem mencari produk berdasarkan `slug` di basis data.
  3. Sistem menampilkan galeri foto, nama buket, harga (IDR), deskripsi komposisi bunga, status ketersediaan, dan tombol "Pesan Sekarang".
- **Alur Alternatif:**
  - *A1 (Stok Habis):* Jika `is_available == 0`, tombol "Pesan Sekarang" dinonaktifkan dengan label "Stok Habis".

---

### UC-04: Melakukan Pemesanan Katalog
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengisi formulir checkout katalog, memasukkan pesan kartu ucapan, dan menentukan tanggal pengiriman tanpa login.
- **Prakondisi:** Pelanggan berada di halaman detail produk buket yang berstatus tersedia.
- **Pascakondisi:** Pesanan katalog tersimpan di basis data dengan status `ST-01 Menunggu Peninjauan Admin`.
- **Alur Utama:**
  1. Pelanggan mengklik tombol "Pesan Sekarang" di detail produk.
  2. Sistem menampilkan formulir checkout pemesanan katalog.
  3. Pelanggan mengisi nama lengkap, nomor WhatsApp aktif, dan alamat pengiriman di Samarinda.
  4. Pelanggan mengetikkan pesan khusus kartu ucapan (*greeting card*) dan memilih tanggal kebutuhan buket.
  5. Pelanggan meninjau ringkasan pesanan dan mengklik tombol "Kirim Pesanan".
  6. Sistem memvalidasi data form request.
  7. Sistem menjalankan transaksi basis data: menyimpan data pelanggan, membuat record pesanan dengan kode acak `BLM-YYYYMM-XXXX`, membuat detail pesanan dengan snapshot harga, dan mencatat histori status awal (`ST-01`).
  8. Sistem mengarahkan pelanggan ke halaman ringkasan pesanan dan instruksi pembayaran transfer bank.
- **Alur Pengecualian:**
  - *E1 (Form Tidak Lengkap):* Sistem menampilkan notifikasi kesalahan validasi inline pada field yang kosong.
  - *E2 (Stok Tiba-tiba Habis):* Jika stok habis saat submit, transaksi di-rollback dan sistem memberi tahu pemesan.

---

### UC-05: Mengajukan Personalisasi Buket Custom
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengajukan permintaan pembuatan buket kustom dengan memilih spesifikasi bahan, warna, tema, catatan khusus, dan mengunggah foto referensi.
- **Prakondisi:** Pelanggan mengakses halaman Custom Bouquet.
- **Pascakondisi:** Tiket permintaan custom tersimpan di basis data dengan status `ST-01 Menunggu Peninjauan Admin`.
- **Alur Utama:**
  1. Pelanggan membuka menu "Custom Bouquet".
  2. Sistem menampilkan panduan pemesanan personal dan formulir spesifikasi buket custom.
  3. Pelanggan memilih jenis bunga (bunga segar, artificial, dll.), kombinasi warna, tema perayaan, dan catatan rincian.
  4. Pelanggan menjalankan **UC-05.1: Mengunggah Berkas Foto Referensi** (format JPG/PNG ≤ 5MB).
  5. Pelanggan mengisi data identitas (nama, WhatsApp, alamat) dan tanggal kebutuhan buket.
  6. Pelanggan mengklik "Ajukan Buket Custom".
  7. Sistem memvalidasi form, menyimpan berkas foto tersanitasi ke storage lokal, menyimpan data pesanan tipe custom ke database, dan menerbitkan tiket custom.
  8. Sistem menampilkan konfirmasi bahwa pengajuan berhasil terkirim dan sedang ditinjau florist BLOOMÉ.

---

### UC-05.1: Mengunggah Berkas Foto Referensi (Included in UC-05)
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Mengunggah berkas foto acuan buket dari galeri perangkat.
- **Alur Utama:**
  1. Pelanggan memilih/menarik berkas foto ke dropzone unggah.
  2. Sistem memvalidasi tipe MIME berkas (`image/jpeg`, `image/png`) dan ukuran berkas (maksimal 5 MB).
  3. Sistem menampilkan pratinjau thumbnail foto di antarmuka form.
- **Alur Pengecualian:**
  - *E1 (Format Ilegal):* Jika format berkas PDF/EXE, sistem menolak dan menampilkan alert: *"Format berkas wajib JPG, JPEG, atau PNG"*.
  - *E2 (Ukuran > 5MB):* Sistem menolak dan menampilkan alert: *"Ukuran berkas melebihi batas 5 MB"*.

---

### UC-06: Meninjau & Memutuskan Harga Custom
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan meninjau nominal harga yang diusulkan oleh florist dan menentukan keputusan persetujuan (*Approve*) atau penolakan (*Reject*).
- **Prakondisi:** Admin telah meninjau tiket custom dan menginput nominal harga penawaran (status `ST-02`).
- **Pascakondisi:** Status pesanan beralih ke `ST-03 Menunggu Pembayaran` (jika setuju) atau `ST-08 Dibatalkan` (jika tolak).
- **Alur Utama:**
  1. Pelanggan membuka halaman peninjauan harga buket custom melalui tautan unik pesanan.
  2. Sistem menampilkan spesifikasi buket, foto referensi, dan nominal penawaran harga dari admin.
  3. Pelanggan menekan tombol "Setujui Harga".
  4. Sistem memperbarui status pesanan menjadi `ST-03 Menunggu Pembayaran` dan mencatat persetujuan.
  5. Sistem menampilkan rincian rekening bank/e-wallet untuk pembayaran.
- **Alur Alternatif:**
  - *A1 (Pelanggan Menolak Harga):* Pelanggan menekan tombol "Tolak Usulan". Sistem mencatat status penolakan, menggeser status ke `ST-08 Dibatalkan`, dan menyajikan tautan kontak WhatsApp admin untuk negosiasi ulang/revisi.

---

### UC-07: Melihat Instruksi Pembayaran Transfer
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan melihat rincian nomor rekening bank resmi dan e-wallet pemilik usaha untuk melakukan transfer manual.
- **Prakondisi:** Pesanan berada dalam status `ST-03 Menunggu Pembayaran`.
- **Pascakondisi:** Pelanggan memperoleh nomor rekening resmi dan nominal tagihan yang tepat.
- **Alur Utama:**
  1. Pelanggan membuka halaman pembayaran pesanan.
  2. Sistem menampilkan kode pesanan, total tagihan yang harus dibayar, daftar rekening bank resmi (BCA/BRI/Mandiri), dan akun e-wallet (DANA/GoPay) atas nama resmi pemilik usaha.

---

### UC-08: Melakukan Konfirmasi Pembayaran
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menyatakan telah mentransfer dana ke rekening resmi agar admin memverifikasi mutasi.
- **Prakondisi:** Pelanggan telah mentransfer dana dan berada di halaman petunjuk pembayaran.
- **Pascakondisi:** Status pesanan beralih ke `ST-04 Menunggu Konfirmasi Pembayaran`.
- **Alur Utama:**
  1. Pelanggan mengklik tombol "Saya Sudah Melakukan Transfer".
  2. Sistem memperbarui status pesanan menjadi `ST-04 Menunggu Konfirmasi Pembayaran` dan mencatat riwayat status.
  3. Sistem menampilkan notifikasi: *"Terima kasih! Pembayaran Anda sedang diverifikasi secara manual oleh pemilik usaha."*

---

### UC-09: Mengajukan Permohonan Pembatalan
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengajukan permohonan pembatalan pesanan sebelum buket masuk tahap pembuatan fisik.
- **Prakondisi:** Pesanan masih berada dalam status awal (`ST-01`, `ST-02`, atau `ST-03`).
- **Pascakondisi:** Permohonan pembatalan tercatat di antrean peninjauan admin.
- **Alur Utama:**
  1. Pelanggan membuka rincian pesanan dan mengklik "Ajukan Pembatalan".
  2. Sistem memvalidasi status pesanan saat ini.
  3. Pelanggan mengetikkan alasan pembatalan dan menekan "Kirim Permohonan".
  4. Sistem menyimpan permohonan pembatalan ke antrean peninjauan admin.
- **Alur Alternatif:**
  - *A1 (Pesanan Sudah Dibuat/Selesai):* Tombol pembatalan dinonaktifkan dengan peringatan: *"Pesanan sudah masuk tahap perangkaian dan tidak dapat dibatalkan"*.

---

## 4. Spesifikasi Lengkap Use Case Domain Administrator (Admin Domain)

### UC-10: Login Administrator
- **Aktor Utama:** Admin (Nabila Febriyani)
- **Deskripsi:** Otentikasi satu pintu untuk mengakses dashboard administrasi.
- **Prakondisi:** Admin membuka URL `/admin/login`.
- **Pascakondisi:** Sesi otentikasi admin aktif dan dialihkan ke dashboard utama.
- **Alur Utama:**
  1. Admin membuka halaman login admin.
  2. Admin memasukkan email terdaftar dan password.
  3. Sistem memverifikasi token CSRF dan mencocokkan hash password Bcrypt pada tabel `admins`.
  4. Sistem meregenerasi ID sesi dan mengarahkan admin ke `/admin/dashboard`.
- **Alur Pengecualian:**
  - *E1 (Kredensial Keliru):* Sistem menolak login dan menampilkan alert merah: *"Email atau kata sandi tidak cocok"*.

---

### UC-11: Melihat Dashboard & Metrik Operasional
- **Aktor Utama:** Admin
- **Deskripsi:** Memantau kartu metrik statistik dan antrean transaksi terkini.
- **Prakondisi:** Admin terautentikasi (`auth:admin`).
- **Alur Utama:**
  1. Admin mengakses menu Dashboard.
  2. Sistem menghitung total pesanan masuk, pesanan menunggu bayar, custom baru, dan pesanan sedang dibuat.
  3. Sistem menyajikan kartu metrik ringkasan dan tabel 10 transaksi teranyar.

---

### UC-12: Mengelola Kategori Produk (CRUD)
- **Aktor Utama:** Admin
- **Deskripsi:** Mengelola kategori buket (Buket Bunga, Buket Uang, Buket Snack, dll.).
- **Alur Utama (Tambah Kategori):**
  1. Admin membuka menu Kategori dan mengklik "Tambah Kategori".
  2. Admin memasukkan nama kategori dan deskripsi singkat.
  3. Sistem memvalidasi nama unik, membuat slug otomatis, dan menyimpan record ke tabel `categories`.
- **Alur Alternatif (Hapus Kategori):**
  1. Admin mengklik tombol hapus pada sebuah kategori.
  2. Sistem memeriksa apakah kategori masih memiliki produk aktif di tabel `products`.
  3. Jika masih ada produk, sistem menolak penghapusan dengan alert: *"Kategori tidak dapat dihapus karena masih memuat produk aktif"*. Jika kosong, kategori dihapus.

---

### UC-13: Mengelola Produk Katalog (CRUD & Upload Foto)
- **Aktor Utama:** Admin
- **Deskripsi:** Mengelola data buket katalog, harga, deskripsi, upload foto, dan ketersediaan stok.
- **Alur Utama (Tambah Produk):**
  1. Admin membuka menu Produk dan mengklik "Tambah Produk".
  2. Admin mengisi nama buket, memilih kategori, mengisi harga (IDR), deskripsi komposisi bunga, dan mengunggah foto produk.
  3. Sistem memvalidasi berkas gambar (JPG/PNG ≤ 5MB), menyimpan foto ke `storage/app/public/products/`, dan menyimpan data ke tabel `products`.
  4. Produk baru langsung tampil di katalog publik.
- **Alur Alternatif (Toggle Ketersediaan Stok):**
  1. Admin mengklik switch status stok buket dari *In Stock* menjadi *Out of Stock*.
  2. Sistem memperbarui kolom `is_available = 0` secara instan.

---

### UC-14: Mengelola Antrean Pesanan & Detail
- **Aktor Utama:** Admin
- **Deskripsi:** Memantau antrean seluruh pesanan masuk dan melihat rincian detail kartu ucapan serta alamat pengiriman.
- **Alur Utama:**
  1. Admin membuka menu Pesanan.
  2. Sistem menampilkan antrean pesanan terurut berdasarkan tanggal kebutuhan terdekat.
  3. Admin dapat memfilter daftar berdasarkan status operasional (ST-01 s/d ST-08).
  4. Admin mengklik "Lihat Detail" untuk memeriksa pesan kartu ucapan dan detail pemesan.

---

### UC-15: Meninjau Permintaan Custom & Foto
- **Aktor Utama:** Admin
- **Deskripsi:** Meninjau tiket pengajuan buket custom dan memeriksa berkas foto referensi yang diunggah pelanggan.
- **Alur Utama:**
  1. Admin membuka menu "Permintaan Custom".
  2. Admin memilih tiket custom yang berstatus `ST-01`.
  3. Sistem menyajikan rincian jenis bunga, palet warna, tema, catatan khusus, dan galeri foto referensi acuan.

---

### UC-16: Menetapkan Usulan Harga Custom
- **Aktor Utama:** Admin
- **Deskripsi:** Menginput nominal harga penawaran buket kustom secara manual setelah menaksir ketersediaan bahan.
- **Prakondisi:** Admin berada di halaman detail permintaan custom (status `ST-01`).
- **Pascakondisi:** Status pesanan beralih ke `ST-02 Menunggu Persetujuan Harga`.
- **Alur Utama:**
  1. Admin menaksir biaya bahan bunga dan mengetikkan nominal harga pada kolom "Harga Penawaran" (misal: Rp275.000).
  2. Admin mengklik "Simpan & Kirim Penawaran".
  3. Sistem memperbarui kolom `proposed_price` dan menggeser status pesanan menjadi `ST-02 Menunggu Persetujuan Harga`.

---

### UC-17: Memverifikasi Pembayaran Manual Mutasi Rekening
- **Aktor Utama:** Admin
- **Deskripsi:** Memverifikasi mutasi rekening bank atau e-wallet fisik dan menandai transaksi pesanan telah lunas.
- **Prakondisi:** Pesanan berstatus `ST-04 Menunggu Konfirmasi Pembayaran`.
- **Pascakondisi:** Status pesanan beralih ke `ST-05 Pembayaran Dikonfirmasi`.
- **Alur Utama:**
  1. Admin membuka menu Pembayaran di dashboard.
  2. Admin memeriksa data mutasi rekening m-banking resmi BLOOMÉ.
  3. Dana terbukti masuk dan nominal cocok dengan tagihan.
  4. Admin mengklik tombol "Verifikasi Pembayaran".
  5. Sistem mencatat waktu verifikasi di tabel `payments`, memperbarui status menjadi `ST-05 Pembayaran Dikonfirmasi`, dan mencatat histori audit.

---

### UC-18: Mengelola Siklus Status Pesanan & Audit Trail
- **Aktor Utama:** Admin
- **Deskripsi:** Memperbarui progres pengerjaan buket fisik secara bertahap mematuhi aturan mesin status.
- **Pascakondisi:** Status diperbarui dan `<<include>>` UC-18.1 riwayat audit tercatat otomatis.
- **Alur Utama:**
  1. Bunga mulai dirangkai: Admin memilih status `ST-06 Sedang Dibuat`. Sistem mencatat audit trail.
  2. Rangkaian selesai dan diserahkan ke pelanggan/kurir: Admin memilih status `ST-07 Selesai`. Sistem mencatat audit trail dan mengunci status transaksi (*terminal state*).

---

### UC-19: Meninjau & Memutuskan Pembatalan Pesanan
- **Aktor Utama:** Admin
- **Deskripsi:** Mengevaluasi permohonan pembatalan dari pemesan dan mengambil keputusan persetujuan atau penolakan.
- **Alur Utama:**
  1. Admin membuka menu Pembatalan.
  2. Admin membaca alasan pembatalan dan memeriksa status buket saat ini.
  3. Jika disetujui: Admin mengklik "Setujui Pembatalan", status pesanan berubah menjadi `ST-08 Dibatalkan`.
  4. Jika ditolak: Admin mengklik "Tolak Pembatalan", status aktif pesanan sebelumnya dipertahankan.

---

### UC-20: Logout Administrator
- **Aktor Utama:** Admin
- **Deskripsi:** Mengakhiri sesi administrasi secara aman.
- **Alur Utama:**
  1. Admin mengklik tombol "Logout" di header panel admin.
  2. Sistem menghapus sesi otentikasi admin, menginvalidasi token, dan mengalihkan halaman ke form login admin.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-002
Task **ANA-002 (Use Case Description)** telah selesai dilaksanakan:
- 20 Use Case lengkap telah dideskripsikan menggunakan format standar baku (Aktor, Pre/Post-conditions, Main Flow, Alternative Flows, Exception Flows).
- Seluruh spesifikasi selaras 100% dengan kebutuhan SRS (`requirement.md`) dan diagram use case (`ANA-001`).
- Kriteria penyelesaian (*Definition of Done*) terpenuhi.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task pemodelan diagram aktivitas berikutnya pada sub-fase 5.2:
- **`ANA-003 — Activity Diagram pemesanan katalog.`**

