# USE CASE DESCRIPTIONS & DETAILED SCENARIO SPECIFICATIONS
## BLOOMÉ — Flowers & Stories
**Task ID:** ANA-002  
**Fase:** Phase 2 — System Analysis and Design (Sub-fase 5.2 System Modeling)  
**Penanggung Jawab:** Jayanti Firdasari (Lead System Analyst & Project Manager)  
**Tanggal Penyusunan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ANA-001 — Use Case Diagram (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Penyusunan Deskripsi Use Case (Task ANA-002) merupakan spesifikasi tekstual formal yang mendokumentasikan setiap use case dari diagram `ANA-001`. Dokumen ini merinci alur interaksi standar (*Main Flow / Happy Path*), alur percabangan (*Alternative Flows*), penanganan galat (*Exception Flows*), prakondisi, pascakondisi, serta aturan bisnis yang berlaku.

Berdasarkan kesepakatan arsitektur terbaru (Konsep Sistem v1.1), sistem informasi **BLOOMÉ — Flowers & Stories** difokuskan sebagai **katalog interaktif dan media konfigurasi personalisasi buket bunga, sedangkan proses pemesanan resmi, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**. 

Dengan penegasan batas sistem (*system boundary*) ini, website tidak menyediakan registrasi pelanggan, tidak melakukan checkout web, tidak menyimpan transaksi resmi di basis data web, dan tidak mengelola status pesanan. Seluruh interaksi lanjutan pasca penekanan tombol WhatsApp diselesaikan secara manusiawi di saluran percakapan WhatsApp toko oleh pemilik usaha (Nabila Febriyani).

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
- **Alur Pengecualian (*Exception Flows*):** Penanganan kesalahan input atau kondisi data kosong.

---

## 3. Spesifikasi Use Case Domain Pelanggan (Customer Domain)

### UC-01: Melihat Beranda & Profil Butik Samarinda
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan mengakses halaman utama website untuk melihat identitas merek BLOOMÉ, hero banner, koleksi buket unggulan, navigasi kategori, dan alamat butik di Samarinda tanpa form login.
- **Prakondisi:** Pelanggan memiliki koneksi internet dan peramban web aktif.
- **Pascakondisi:** Halaman beranda ter-render sempurna dengan nuansa estetika floral (*Playfair Display & Blush Pink*).
- **Alur Utama:**
  1. Pelanggan membuka URL utama website (`/`).
  2. Sistem mengambil data kategori aktif dari tabel `categories` dan produk unggulan dari tabel `products`.
  3. Sistem mengambil informasi kontak butik Samarinda dari tabel `business_settings`.
  4. Sistem menampilkan hero banner, cerita butik (*Flowers & Stories*), kartu buket unggulan, banner ajakan konsultasi custom, dan footer.
- **Alur Pengecualian:**
  - *E1 (Koneksi Database Terputus):* Sistem menampilkan halaman error 500 yang ramah pengguna.

---

### UC-02: Menjelajahi Katalog & Filter Kategori
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan melihat etalase buket siap pesan dan menyaringnya berdasarkan kelompok kategori tertentu.
- **Prakondisi:** Pelanggan mengakses menu "Katalog" (`/katalog`).
- **Pascakondisi:** Daftar produk ditampilkan dalam bentuk kartu grid sesuai filter kategori terpilih.
- **Alur Utama:**
  1. Pelanggan membuka menu "Katalog".
  2. Sistem menampilkan seluruh produk buket aktif beserta thumbnail foto utama, nama, harga dasar, dan status ketersediaan.
  3. Pelanggan mengklik tombol filter kategori (misal: *Buket Bunga*, *Buket Uang*, *Buket Snack*).
  4. Sistem menyaring dan menyajikan produk yang sesuai dengan kategori terpilih tanpa memuat ulang seluruh halaman (*client-side filter* atau query teroptimasi).
- **Alur Alternatif:**
  - *A1 (Kategori Kosong):* Jika tidak ada produk pada kategori terpilih, sistem menyajikan *empty state* ramah dengan ilustrasi vas bunga dan tombol "Lihat Semua Buket".

---

### UC-03: Melihat Detail Buket & Galeri Multi-Foto
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan membuka halaman rincian produk untuk meninjau foto multi-sudut, deskripsi komposisi bunga, harga dasar, dan status ketersediaan stok.
- **Prakondisi:** Pelanggan memilih kartu produk buket di katalog atau beranda.
- **Pascakondisi:** Halaman detail produk terbuka lengkap.
- **Alur Utama:**
  1. Pelanggan mengklik salah satu kartu buket.
  2. Sistem mencari produk berdasarkan kolom `slug` di tabel `products`.
  3. Sistem melakukan *eager loading* foto galeri terkait dari tabel `product_images`, opsi personalisasi dari `personalization_options`, dan item add-on yang diizinkan dari `add_ons`.
  4. Sistem menampilkan slider galeri foto tajam, nama buket, harga dasar, deskripsi bahan, status ketersediaan (*Tersedia* / *Habis*), dan panel konfigurator personalisasi.
- **Alur Alternatif:**
  - *A1 (Stok Habis):* Jika `is_available == 0`, sistem menyajikan badge "Stok Habis" dan menonaktifkan tombol pemesanan WhatsApp secara visual dengan pesan informatif.

---

### UC-04: Mengonfigurasi Personalisasi Buket (Wrapping & Pita)
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan memilih variasi warna kertas pembungkus (*wrapping paper*), pita satin, atau opsi variasi lainnya secara interaktif.
- **Prakondisi:** Halaman detail produk buket terbuka dan produk berstatus tersedia (`is_available == 1`).
- **Pascakondisi:** Opsi variasi terpilih tercatat pada memori antarmuka dan memperbarui ringkasan.
- **Alur Utama:**
  1. Pelanggan melihat opsi personalisasi yang tersedia untuk buket tersebut.
  2. Pelanggan mengklik salah satu pemilih visual warna (*color swatches*) atau tombol radio variasi (misal: *Wrapping Spunbond Blush Pink*, *Pita Satin Burgundy*).
  3. Sistem menandai swatch warna yang aktif dan memperbarui pilihan variasi pada panel ringkasan pesanan.
  4. Jika variasi memiliki penyesuaian harga (`additional_price > 0`), sistem langsung memperbarui kalkulasi estimasi total harga.

---

### UC-05: Memilih Item Add-on & Mengisi Catatan Ucapan
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menambahkan item pelengkap (kartu ucapan khusus, boneka wisuda mini, cokelat Ferrero, lampu LED string) dan menuliskan pesan ucapan kartu.
- **Prakondisi:** Pelanggan berada pada panel konfigurasi di halaman detail produk.
- **Pascakondisi:** Item add-on terpilih dan teks ucapan kartu tersimpan pada memori antarmuka.
- **Alur Utama:**
  1. Pelanggan melihat daftar add-on yang tersedia beserta thumbnail foto dan harga satuan.
  2. Pelanggan mencentang satu atau beberapa kotak centang add-on (misal: *Kartu Ucapan Premium*, *Boneka Wisuda Mini*).
  3. Sistem menambahkan item add-on dan nominal biayanya ke panel ringkasan pesanan.
  4. Pelanggan mengetikkan pesan personal ucapan pada kolom teks yang disediakan (*greeting card message*).
  5. Sistem menampilkan indikator jumlah karakter teks secara real-time.

---

### UC-06: Melihat Ringkasan Pilihan & Kalkulasi Estimasi Harga Live
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan melihat rangkuman seluruh pilihan buket, variasi yang dipilih, daftar add-on, dan kalkulasi estimasi total biaya secara langsung.
- **Prakondisi:** Pelanggan telah memilih produk dan mengonfigurasi personalisasi atau add-on.
- **Pascakondisi:** Kartu ringkasan menyajikan subtotal transparan sebelum beralih ke WhatsApp.
- **Alur Utama:**
  1. Sistem secara otomatis mendeteksi setiap perubahan pilihan (produk, variasi personalisasi, penambahan/pengurangan add-on).
  2. Sistem menghitung subtotal: `Harga Dasar Produk + Total Penyesuaian Variasi + Total Biaya Add-on`.
  3. Sistem merender kartu ringkasan interaktif yang menampilkan: nama buket, variasi terpilih, rincian add-on, teks ucapan, dan nominal estimasi harga total (IDR).
- **Alur Alternatif:**
  - *A1 (Pemesanan Multi-Item):* Jika fitur draf pemesanan beberapa buket diaktifkan `[Perlu Konfirmasi Owner]`, pelanggan dapat menambahkan buket terkonfigurasi ke daftar sementara draf sebelum mengarahkan ke WhatsApp.

---

### UC-07: Mengarahkan Pemesanan ke WhatsApp (Generator Pesan)
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menekan tombol "Pesan via WhatsApp" untuk menghasilkan pesan terformat rapi dan membuka aplikasi/tab WhatsApp resmi toko tanpa penyimpanan transaksi di basis data web.
- **Prakondisi:** Konfigurasi buket telah dipilih dan tombol "Pesan via WhatsApp" aktif.
- **Pascakondisi:** Aplikasi atau peramban membuka URL `wa.me` dengan draf pesan pesanan lengkap; tidak ada record pesanan yang tersimpan di basis data web.
- **Alur Utama:**
  1. Pelanggan mengklik tombol "Pesan via WhatsApp".
  2. Sistem menyusun teks draf pemesanan terstruktur rapi:
     - Salam pembuka resmi BLOOMÉ
     - Nama Produk Buket
     - Rincian Variasi Personalisasi (Wrapping, Pita)
     - Rincian Add-on Tambahan
     - Pesan Kartu Ucapan / Catatan Khusus
     - Estimasi Total Harga (IDR)
     - Catatan bahwa harga final, ongkir Samarinda, dan pembayaran akan dikonfirmasi pemilik toko.
  3. Sistem mengambil nomor WhatsApp aktif dari tabel `business_settings`.
  4. Sistem melakukan *URL encode* terhadap teks pesan dan menyusun tautan lengkap: `https://wa.me/{nomor_toko}?text={encoded_message}`.
  5. Sistem membuka tautan tersebut pada tab baru atau mengalihkan ke aplikasi WhatsApp di ponsel pelanggan.
  6. Pelanggan secara mandiri menekan tombol "Kirim" (*Send*) pada aplikasi WhatsApp mereka.
- **Catatan Batas Sistem:**
  - Website tidak menerima atau menyimpan pesanan hanya karena WhatsApp berhasil dibuka.
  - Seluruh konfirmasi ketersediaan bahan, kesepakatan harga final, pembayaran transfer/e-wallet, DP 50%, dan pengiriman Samarinda dilanjutkan di WhatsApp.

---

### UC-08: Mengakses Konsultasi Buket Custom via WhatsApp
- **Aktor Utama:** Customer (Guest)
- **Deskripsi:** Pelanggan menghubungi pemilik usaha melalui WhatsApp untuk mendiskusikan permintaan rancangan buket di luar katalog.
- **Prakondisi:** Pelanggan berada pada beranda, katalog, atau bagian panduan buket custom.
- **Pascakondisi:** Aplikasi WhatsApp terbuka dengan draf pesan pembuka konsultasi desain custom.
- **Alur Utama:**
  1. Pelanggan membaca panduan konsultasi buket custom pada website.
  2. Pelanggan mengklik tombol "Konsultasi Buket Custom via WhatsApp".
  3. Sistem mengambil nomor WhatsApp toko dari `business_settings` dan menyusun draf salam konsultasi custom.
  4. Sistem membuka URL protokol `wa.me`.
  5. Pelanggan mengirim pesan di WhatsApp, mengirim foto referensi buket dari ponsel mereka, dan berdiskusi langsung mengenai bahan, warna, dan harga bersama pemilik usaha (Nabila Febriyani).

---

## 4. Spesifikasi Use Case Domain Administrator (Admin Domain)

### UC-09: Login Administrator (Single Admin Account)
- **Aktor Utama:** Admin (Nabila Febriyani)
- **Deskripsi:** Otentikasi satu pintu yang aman untuk mengakses dashboard administrasi.
- **Prakondisi:** Admin membuka halaman login `/admin/login`.
- **Pascakondisi:** Sesi login administrator terotentikasi dan dialihkan ke dashboard admin.
- **Alur Utama:**
  1. Admin membuka halaman login admin.
  2. Admin memasukkan alamat email terdaftar dan kata sandi.
  3. Sistem memvalidasi token CSRF dan mencocokkan hash password Bcrypt pada tabel `admins` (hanya ada 1 akun admin aktif milik pemilik usaha).
  4. Sistem meregenerasi ID sesi (`Session::regenerate()`) dan mengarahkan admin ke `/admin/dashboard`.
- **Alur Pengecualian:**
  - *E1 (Kredensial Salah):* Sistem menolak akses dan menampilkan pesan error: *"Email atau kata sandi tidak cocok"*.
  - *E2 (Rate Limiting):* Jika terjadi percobaan login berulang yang gagal (> 5 kali), sistem mengunci sementara form login selama 60 detik.

---

### UC-10: Melihat Dashboard & Ringkasan Etalase Digital
- **Aktor Utama:** Admin
- **Deskripsi:** Memantau metrik ringkasan kesehatan etalase produk dan konfigurasi toko.
- **Prakondisi:** Admin telah login (`auth:admin`).
- **Pascakondisi:** Dashboard menampilkan kartu statistik etalase digital secara tepat.
- **Alur Utama:**
  1. Admin membuka halaman dashboard.
  2. Sistem menghitung: total produk aktif (`products`), total kategori (`categories`), total opsi personalisasi (`personalization_options`), total add-on aktif (`add_ons`), dan nomor WhatsApp toko aktif (`business_settings`).
  3. Sistem menyajikan kartu metrik ringkasan dan tautan cepat ke modul manajemen katalog.

---

### UC-11: Mengelola Kategori Produk (CRUD & Proteksi Relasi)
- **Aktor Utama:** Admin
- **Deskripsi:** Menambah, melihat, mengedit, dan menghapus kategori buket dengan proteksi referensial.
- **Prakondisi:** Admin berada pada menu Kategori (`/admin/categories`).
- **Pascakondisi:** Data kategori diperbarui pada tabel `categories`.
- **Alur Utama (Tambah/Edit):**
  1. Admin mengklik "Tambah Kategori" atau memilih kategori untuk diedit.
  2. Admin memasukkan nama kategori dan deskripsi singkat.
  3. Sistem memvalidasi nama unik, membuat slug URL secara otomatis, dan menyimpan data ke tabel `categories`.
- **Alur Alternatif (Hapus Kategori):**
  1. Admin mengklik tombol hapus pada suatu kategori.
  2. Sistem memeriksa apakah kategori masih memiliki produk aktif di tabel `products`.
  3. Jika masih memiliki produk, sistem menolak penghapusan dan menampilkan alert: *"Kategori tidak dapat dihapus karena masih memuat produk buket aktif"*. Jika kosong, kategori dihapus dari database.

---

### UC-12: Mengelola Master Produk Buket (CRUD & Toggle Stok)
- **Aktor Utama:** Admin
- **Deskripsi:** Menambah, mengedit informasi produk buket, mengatur harga dasar, dan mengubah status ketersediaan secara cepat.
- **Prakondisi:** Admin berada pada menu Produk (`/admin/products`).
- **Pascakondisi:** Data produk buket tersimpan di tabel `products`.
- **Alur Utama (Tambah/Edit Produk):**
  1. Admin membuka form Tambah/Edit Produk.
  2. Admin memilih kategori, memasukkan nama buket, harga dasar (IDR) `[Perlu Konfirmasi Owner]`, deskripsi rangkaian bunga, dan mengunggah foto utama.
  3. Sistem memvalidasi data form request, menyimpan foto ke storage lokal, dan menyimpan record produk.
- **Alur Alternatif (Toggle Ketersediaan Stok):**
  1. Admin mengklik sakelar (*toggle switch*) ketersediaan pada baris produk di tabel.
  2. Sistem secara instan memperbarui nilai `is_available` (1 = Tersedia, 0 = Habis) tanpa perlu membuka form edit lengkap.
  3. Perubahan status langsung tercermin di etalase katalog publik.

---

### UC-13: Mengelola Galeri Multi-Foto Produk
- **Aktor Utama:** Admin
- **Deskripsi:** Mengunggah beberapa foto detail buket sekaligus, menentukan urutan foto, menetapkan foto sampul utama (*primary*), dan menghapus foto lama.
- **Prakondisi:** Admin berada pada tab Galeri Foto di halaman detail produk admin.
- **Pascakondisi:** Berkas foto tersimpan di penyimpanan lokal dan tercatat pada tabel `product_images`.
- **Alur Utama:**
  1. Admin memilih satu atau beberapa berkas foto dari perangkat (JPG/PNG ≤ 2MB per berkas).
  2. Sistem memvalidasi tipe MIME dan ukuran berkas.
  3. Sistem menyimpan foto dengan nama hash acak (UUID) di folder `storage/app/public/products/`.
  4. Sistem menyimpan record path ke tabel `product_images` dengan relasi `product_id`.
  5. Admin dapat menandai salah satu foto sebagai foto sampul utama (`is_primary = 1`).
  6. Foto-foto tersebut langsung tayang pada slider galeri halaman detail produk publik.
- **Alur Alternatif (Hapus Foto):**
  1. Admin mengklik ikon hapus pada salah satu foto galeri.
  2. Sistem menghapus record dari tabel `product_images` dan menghapus berkas fisik dari storage lokal.

---

### UC-14: Mengelola Opsi Personalisasi & Nilai Variasi
- **Aktor Utama:** Admin
- **Deskripsi:** Mengonfigurasi opsi variasi (wrapping paper, pita satin) dan nilai opsinya beserta kode warna HEX dan biaya tambahan.
- **Prakondisi:** Admin berada pada menu Personalisasi (`/admin/personalizations`).
- **Pascakondisi:** Opsi personalisasi tersimpan pada tabel `personalization_options`, `personalization_values`, dan ditautkan ke produk pada `product_personalization_options`.
- **Alur Utama:**
  1. Admin membuat tipe opsi personalisasi baru (misal: *Warna Kertas Wrapping*, tipe: `color_swatch`).
  2. Admin menambahkan nilai variasi pada opsi tersebut (misal: *Blush Pink*, hex: `#E99AAF`, biaya tambahan: Rp0).
  3. Admin menambahkan variasi premium jika berlaku (misal: *Korean Floral Cellophane*, biaya tambahan: +Rp15.000 `[Perlu Konfirmasi Owner]`).
  4. Admin menautkan opsi personalisasi tersebut ke produk buket yang bersangkutan melalui tabel pivot `product_personalization_options`.
  5. Opsi swatch warna tersebut langsung tampil interaktif pada konfigurator buket publik.

---

### UC-15: Mengelola Master Item Add-on & Relasi Produk
- **Aktor Utama:** Admin
- **Deskripsi:** Menambah master data item add-on (kartu ucapan khusus, cokelat, boneka, lampu LED) dan menautkannya ke produk buket.
- **Prakondisi:** Admin berada pada menu Add-on (`/admin/addons`).
- **Pascakondisi:** Data add-on tersimpan pada tabel `add_ons` dan relasi produk pada `product_add_ons`.
- **Alur Utama:**
  1. Admin membuka menu Add-on dan mengklik "Tambah Add-on".
  2. Admin memasukkan nama item, harga satuan (IDR) `[Perlu Konfirmasi Owner]`, deskripsi singkat, mengunggah thumbnail foto, dan status ketersediaan.
  3. Sistem menyimpan data ke tabel `add_ons`.
  4. Pada manajemen produk buket, admin mencentang add-on mana saja yang diizinkan untuk dipilih bersama produk tersebut.
  5. Pilihan add-on tersebut langsung muncul sebagai pilihan tambahan di halaman detail produk publik.

---

### UC-16: Mengelola Pengaturan Bisnis & WhatsApp Toko
- **Aktor Utama:** Admin
- **Deskripsi:** Memperbarui nomor WhatsApp resmi toko dan teks draf pesan pada tabel `business_settings`.
- **Prakondisi:** Admin berada pada menu Pengaturan Bisnis (`/admin/settings`).
- **Pascakondisi:** Data pengaturan toko diperbarui pada tabel `business_settings`.
- **Alur Utama:**
  1. Admin membuka menu Pengaturan Bisnis.
  2. Admin memperbarui nomor kontak WhatsApp bisnis resmi BLOOMÉ `[Perlu Konfirmasi Owner]`.
  3. Admin memperbarui template salam pembuka pesan WhatsApp dan informasi alamat butik di Samarinda (`Jl. Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Samarinda`).
  4. Sistem memvalidasi format nomor internasional (format diawali `62`) dan menyimpan nilai konfigurasi ke tabel `business_settings`.
  5. Seluruh generator tautan WhatsApp publik otomatis menggunakan nomor kontak dan konfigurasi terbaru tersebut.

---

### UC-17: Logout Administrator
- **Aktor Utama:** Admin
- **Deskripsi:** Mengakhiri sesi login administrator secara aman.
- **Prakondisi:** Admin sedang berada dalam sesi terotentikasi.
- **Pascakondisi:** Sesi dihapus dan browser dialihkan ke halaman login admin.
- **Alur Utama:**
  1. Admin mengklik tombol "Logout" pada header panel admin.
  2. Sistem memproses request logout, menghancurkan data sesi di server (`Auth::logout()`, `Session::invalidate()`, `Session::regenerateToken()`).
  3. Sistem mengarahkan admin kembali ke halaman login (`/admin/login`) dengan pesan sukses logout.

---

## 5. Kesimpulan & Rekomendasi

### 5.1 Status Task ANA-002
Task **ANA-002 (Use Case Descriptions)** telah selesai dilaksanakan:
- 17 Use Case lengkap telah dideskripsikan secara komprehensif menggunakan format standar baku (Aktor, Pre/Post-conditions, Main Flow, Alternative Flows, Exception Flows).
- Seluruh spesifikasi selaras 100% dengan kebutuhan SRS (`requirement.md` v1.1), PRD (`prd.md` v1.1), skema database (`database-design.md` v1.1), dan diagram use case (`ANA-001`).
- Seluruh Use Case usang checkout web, verifikasi mutasi transfer web, dan approval status pesanan web telah dihilangkan sepenuhnya.
- Kriteria penyelesaian (*Definition of Done*) terpenuhi 100%.

### 5.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke pemodelan diagram aktivitas alur katalog dan pemesanan WhatsApp:
- **`ANA-003 — Activity Diagram katalog, personalisasi, dan pemesanan WhatsApp.`**
