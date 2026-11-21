# USE CASE DESCRIPTIONS & DETAILED SCENARIO SPECIFICATIONS
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-002  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Revisi Final: 20 November 2026)  
**Status Task:** Completed Final (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram (Selesai Final)  

---

## 1. Ringkasan Eksekutif

Dokumen Deskripsi Use Case (Task ANA-002) merupakan spesifikasi tekstual formal yang mendokumentasikan setiap skenario interaksi sistem dari Use Case Diagram `ANA-001`. Dokumen ini mendefinisikan alur interaksi standar (*Main Flow*), alur percabangan (*Alternative Flows*), penanganan kondisi khusus (*Exception Flows*), prakondisi, pascakondisi, serta aturan bisnis yang berlaku.

Sesuai arah arsitektur terkini, seluruh use case yang melibatkan checkout berbasis web, penyimpanan transaksi di database, manajemen pembayaran online, dan siklus status pesanan telah dieliminasi dan digantikan dengan alur **katalog interaktif, konfigurasi personalisasi buket, estimasi biaya, dan pengalihan pemesanan ke WhatsApp (*WhatsApp Hand-off*)**.

---

## 2. Format Standar Deskripsi Use Case

Setiap use case didokumentasikan dengan struktur baku:
- **ID & Nama Use Case:** Kode pengenal unik (`UC-XX`) dan nama tindakan fungsional.
- **Aktor:** Aktor primer yang memicu use case.
- **Deskripsi:** Ringkasan tujuan bisnis yang dicapai.
- **Prakondisi (*Preconditions*):** Kondisi sistem atau data yang harus terpenuhi sebelum alur dimulai.
- **Pascakondisi (*Postconditions*):** Hasil akhir sistem setelah alur selesai dieksekusi.
- **Alur Utama (*Main Flow*):** Urutan interaksi ideal dan sukses (*happy path*).
- **Alur Alternatif (*Alternative Flows*):** Cabang alur valid lainnya.
- **Alur Pengecualian (*Exception Flows*):** Penanganan kesalahan input atau kondisi gangguan teknis.

---

## 3. Spesifikasi Use Case Domain Pelanggan (Customer Domain)

### UC-01: Melihat Beranda & Profil Butik Samarinda
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengakses beranda website untuk meninjau profil butik BLOOMÉ Samarinda, koleksi buket unggulan, banner promosi kustomisasi, lokasi butik, dan kebijakan layanan delivery.
- **Prakondisi:** Pelanggan mengakses URL beranda website (`/`).
- **Pascakondisi:** Halaman beranda ter-render lengkap dengan navigasi floral elegan.
- **Alur Utama:**
  1. Pelanggan membuka website BLOOMÉ.
  2. Sistem memuat informasi identitas butik, jam buka, dan produk buket pilihan dari basis data.
  3. Sistem menyajikan hero section, galeri buket favorit, banner ajakan konsultasi custom, alamat butik Samarinda, dan tombol pintasan WhatsApp.
- **Alur Pengecualian:**
  - *E1 (Basis Data Gangguan):* Sistem merender tampilan kesalahan 500 yang ramah visual.

---

### UC-02: Menjelajahi Katalog & Filter Kategori
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menelusuri etalase produk buket aktif dan menyaring daftar berdasarkan kategori bunga segar, bunga artificial, buket uang, atau buket snack.
- **Prakondisi:** Pelanggan berada di halaman beranda atau mengklik menu "Katalog".
- **Pascakondisi:** Daftar kartu produk ditampilkan sesuai kategori yang dipilih.
- **Alur Utama:**
  1. Pelanggan membuka halaman Katalog (`/katalog`).
  2. Sistem menampilkan seluruh produk buket aktif dalam tata letak grid responsif.
  3. Pelanggan memilih tab filter kategori tertentu (misal: *Bunga Segar*).
  4. Sistem menyaring dan menyajikan produk yang sesuai secara instan.
- **Alur Alternatif:**
  - *A1 (Kategori Belum Memiliki Produk):* Sistem menampilkan ilustrasi vas bunga (*empty state*) bertuliskan: *"Koleksi buket untuk kategori ini segera hadir"*.

---

### UC-03: Melihat Detail Produk Buket
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan membuka halaman detail untuk melihat galeri foto buket, deskripsi komposisi bunga, harga dasar, dan status ketersediaan stok.
- **Prakondisi:** Pelanggan mengklik salah satu kartu buket di katalog.
- **Pascakondisi:** Halaman rincian produk terbuka lengkap.
- **Alur Utama:**
  1. Pelanggan memilih kartu produk buket.
  2. Sistem mencari data produk berdasarkan `slug` di basis data.
  3. Sistem menyajikan galeri foto, nama buket, harga dasar (IDR), deskripsi komposisi bunga, status ketersediaan (*Tersedia*), dan tombol aksi "Personalisasi & Pesan".
- **Alur Alternatif:**
  - *A1 (Stok Produk Habis):* Jika produk berstatus `is_available == 0`, tombol dinonaktifkan dengan label *"Stok Habis"* dan sistem menawarkan tombol *"Konsultasikan Alternatif via WhatsApp"*.

---

### UC-04: Mengonfigurasi Personalisasi & Add-on
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menyesuaikan buket pilihannya dengan menentukan warna kertas pembungkus (*wrapping*), warna pita satin, memilih produk pelengkap (*add-on*), serta mengetikkan isi ucapan kartu.
- **Prakondisi:** Pelanggan berada di halaman personalisasi buket yang berstatus tersedia.
- **Pascakondisi:** Konfigurasi personalisasi dan add-on tercatat pada antarmuka peramban.
- **Alur Utama:**
  1. Pelanggan memilih skema warna kertas pembungkus (*wrapping*) dan warna pita dari daftar opsi.
  2. Pelanggan memilih satu atau lebih item add-on (misal: *Boneka Wisuda mini*, *Cokelat Ferrero*, *Lampu LED fairy lights*, *Kartu ucapan custom*).
  3. Pelanggan mengetikkan teks ucapan khusus pada kotak input kartu ucapan.
  4. Pelanggan menentukan tanggal kebutuhan pengiriman dan mengisi alamat tujuan delivery di Samarinda.
  5. Sistem secara dinamis menghitung subtotal add-on dan menampilkan kalkulasi live.
- **Alur Pengecualian:**
  - *E1 (Karakter Pesan Terlalu Panjang):* Sistem membatasi teks kartu ucapan maksimal 250 karakter dengan indikator penghitung karakter.

---

### UC-05: Melihat Ringkasan & Estimasi Harga
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan memeriksa rangkuman menyeluruh dari buket yang telah dikonfigurasi sebelum melanjutkan pemesanan ke WhatsApp.
- **Prakondisi:** Pelanggan telah mengonfigurasi personalisasi buket pada UC-04.
- **Pascakondisi:** Komponen ringkasan pesanan menampilkan rincian item, estimasi total biaya, dan catatan pengiriman.
- **Alur Utama:**
  1. Sistem menampilkan panel ringkasan pesanan:
     - Nama varian buket utama dan harga dasar.
     - Rincian opsi personalisasi (warna wrapping, warna pita).
     - Rincian item add-on terpilih beserta harga satuannya.
     - Teks pesan kartu ucapan.
     - Tanggal rencana pengiriman dan alamat delivery Samarinda.
     - Estimasi Total Biaya (Harga Buket + Total Add-on).
  2. Sistem menampilkan catatan penting: *"Ongkos kirim kurir delivery dan kepastian ketersediaan bunga segar akan dikonfirmasi langsung oleh florist di WhatsApp"*.
  3. Tombol "Pesan via WhatsApp" menjadi aktif.

---

### UC-06: Mengalihkan Pemesanan ke WhatsApp
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengklik tombol pemesanan; sistem menyusun pesan teks terstruktur dan membuka aplikasi WhatsApp pelanggan menuju nomor florist resmi BLOOMÉ.
- **Prakondisi:** Pelanggan berada di panel ringkasan pesanan dan mengklik tombol "Pesan via WhatsApp".
- **Pascakondisi:** Peramban membuka tautan `https://wa.me/` dengan parameter pesan terenkoding (*URL encoded string*).
- **Alur Utama:**
  1. Pelanggan mengklik tombol "Pesan via WhatsApp".
  2. Sistem mengekstrak seluruh data konfigurasi pesanan dari formulir antarmuka.
  3. Sistem mengompilasi teks format pesan WhatsApp yang rapi, contohnya:
     ```text
     Halo BLOOMÉ, saya ingin memesan buket berikut:
     - Produk: Rose Elegance Bouquet (Rp250.000)
     - Wrapping: Soft Pink / Pita: Cream
     - Add-on: Boneka Wisuda Mini (+Rp35.000), Lampu LED (+Rp15.000)
     - Isi Kartu: "Happy Graduation, Sarah!"
     - Tanggal Pengiriman: 25 November 2026
     - Alamat Delivery: Jl. Juanda No. 12, Samarinda
     - Estimasi Total: Rp300.000
     Mohon konfirmasi ketersediaan dan ongkos kirimnya. Terima kasih!
     ```
  4. Sistem menghasilkan URL resmi: `https://wa.me/{nomor_wa_bloome}?text={encoded_message}`.
  5. Peramban secara otomatis mengalihkan atau membuka aplikasi WhatsApp di perangkat pelanggan.
  6. Alur di website selesai; kelanjutan transaksi (pembayaran m-banking, kesepakatan ongkir kurir, pengerjaan buket) berlangsung di WhatsApp.

---

### UC-07: Memulai Konsultasi Custom via WhatsApp
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan yang menginginkan buket yang sepenuhnya unik menghubungi florist melalui WhatsApp untuk mengirimkan foto referensi dan mendiskusikan anggaran.
- **Prakondisi:** Pelanggan membuka halaman "Custom Bouquet" atau mengklik tombol konsultasi.
- **Pascakondisi:** Aplikasi WhatsApp terbuka dengan pesan pembuka khusus konsultasi buket custom.
- **Alur Utama:**
  1. Pelanggan membuka menu "Custom Bouquet".
  2. Sistem menyajikan inspirasi, panduan konsultasi bahan bunga, dan tombol utama "Konsultasi Custom via WhatsApp".
  3. Pelanggan mengklik tombol tersebut.
  4. Sistem membuka WhatsApp resmi florist dengan pesan pembuka: *"Halo BLOOMÉ, saya ingin berkonsultasi mengenai pesanan buket custom khusus (menyesuaikan budget dan foto referensi)."*
  5. Pelanggan mengirimkan foto referensi dan berdiskusi langsung dengan florist di WhatsApp.

---

## 4. Spesifikasi Use Case Domain Administrator (Admin Domain)

### UC-08: Login Administrator
- **Aktor Utama:** Admin (Nabila Febriyani)
- **Deskripsi:** Otentikasi gerbang masuk satu pintu bagi pemilik usaha untuk mengakses dashboard manajemen website.
- **Prakondisi:** Admin membuka halaman `/admin/login`.
- **Pascakondisi:** Sesi otentikasi admin aktif (`auth:admin`) dan dialihkan ke dashboard utama.
- **Alur Utama:**
  1. Admin membuka halaman login admin.
  2. Admin memasukkan alamat email terdaftar dan kata sandi.
  3. Sistem memeriksa token CSRF dan memverifikasi kata sandi dengan hash Bcrypt pada tabel `admins`.
  4. Sistem memperbarui sesi dan mengarahkan admin ke halaman `/admin/dashboard`.
- **Alur Pengecualian:**
  - *E1 (Kredensial Tidak Cocok):* Sistem menampilkan pesan galat: *"Email atau kata sandi tidak sesuai"*.

---

### UC-09: Melihat Dashboard & Ringkasan Katalog
- **Aktor Utama:** Admin
- **Deskripsi:** Menampilkan ringkasan metrik konten website dan status etalase produk.
- **Prakondisi:** Admin telah berhasil masuk ke sistem.
- **Pascakondisi:** Halaman dashboard menyajikan kartu informasi katalog.
- **Alur Utama:**
  1. Admin mengakses menu Dashboard.
  2. Sistem mengambil data agregat dari basis data: total kategori aktif, total produk katalog, jumlah produk berstatus stok habis, dan total opsi add-on.
  3. Sistem menyajikan kartu-kartu statistik ringkasan dan tautan cepat ke manajemen produk.

---

### UC-10: Mengelola Kategori Produk (CRUD)
- **Aktor Utama:** Admin
- **Deskripsi:** Mengelola master kategori produk buket (menambah, melihat, menyunting, dan menghapus kategori).
- **Alur Utama (Tambah Kategori):**
  1. Admin membuka menu Kategori dan memilih tombol "Tambah Kategori".
  2. Admin mengisi nama kategori (misal: *Buket Uang*) dan deskripsi.
  3. Sistem memvalidasi nama unik, membuat slug otomatis, dan menyimpan data ke tabel `categories`.
- **Alur Alternatif (Hapus Kategori):**
  1. Admin memilih aksi hapus pada kategori tertentu.
  2. Sistem memeriksa relasi di tabel `products`. Jika masih memuat produk, sistem menolak penghapusan dengan alert: *"Kategori tidak dapat dihapus karena masih memuat produk aktif"*. Jika kosong, kategori dihapus.

---

### UC-11: Mengelola Produk Buket & Foto (CRUD)
- **Aktor Utama:** Admin
- **Deskripsi:** Mengelola data buket katalog, harga dasar, deskripsi bunga, unggah foto produk resmi, dan status ketersediaan stok.
- **Alur Utama (Tambah Produk):**
  1. Admin membuka menu Produk dan mengklik "Tambah Produk".
  2. Admin memilih kategori, mengisi nama buket, harga dasar (IDR), deskripsi komposisi bunga, status ketersediaan (*In Stock*), dan mengunggah foto buket resmi.
  3. Sistem memvalidasi berkas gambar (JPG/PNG ≤ 5MB), menyimpan berkas ke `storage/app/public/products/`, dan menyimpan data record ke tabel `products`.
- **Alur Alternatif (Ubah Status Ketersediaan Stok):**
  1. Admin mengklik toggle ketersediaan produk dari *Tersedia* menjadi *Stok Habis*.
  2. Sistem memperbarui kolom `is_available = 0` pada basis data.

---

### UC-12: Mengelola Opsi Personalisasi & Add-on (CRUD)
- **Aktor Utama:** Admin
- **Deskripsi:** Mengelola daftar opsi kustomisasi (warna kertas, warna pita) dan item add-on berbayar (kartu ucapan, boneka, cokelat, lampu) yang tampil di formulir personalisasi pelanggan.
- **Alur Utama:**
  1. Admin membuka menu "Personalisasi & Add-on".
  2. Admin memilih tombol "Tambah Item Add-on".
  3. Admin mengisi nama item (misal: *Boneka Wisuda Mini Teddy*), tarif harga tambahan (misal: *Rp35.000*), dan menentukan ketersediaan item.
  4. Sistem menyimpan data ke basis data; item baru langsung tersedia di kalkulator ringkasan pelanggan.

---

### UC-13: Mengelola Informasi Bisnis & Kontak WhatsApp
- **Aktor Utama:** Admin
- **Deskripsi:** Memperbarui data kontak WhatsApp resmi butik, alamat butik Samarinda, jam operasional, dan teks pembuka template pesan.
- **Alur Utama:**
  1. Admin membuka menu "Pengaturan Profil Usaha".
  2. Admin menyunting nomor WhatsApp resmi tujuan hand-off (misal: `6281234567890`) atau alamat butik.
  3. Admin mengklik "Simpan Pengaturan".
  4. Sistem memvalidasi nomor telepon dan menyimpan konfigurasi ke basis data. Seluruh tautan WhatsApp di halaman publik otomatis terarah ke nomor baru.

---

### UC-14: Logout Administrator
- **Aktor Utama:** Admin
- **Deskripsi:** Mengakhiri sesi kerja administrasi secara aman.
- **Alur Utama:**
  1. Admin mengklik tombol "Keluar / Logout".
  2. Sistem menghapus sesi `auth:admin`, menginvalidasi token sesi, dan mengalihkan ke halaman login admin.

---

## 5. Kesimpulan
Task **ANA-002 (Use Case Descriptions)** telah selesai disesuaikan penuh. Seluruh 14 Use Case didefinisikan secara runut, jelas, dan mematuhi batasan alur baru (Katalog $\rightarrow$ Personalisasi $\rightarrow$ WhatsApp Hand-off).
