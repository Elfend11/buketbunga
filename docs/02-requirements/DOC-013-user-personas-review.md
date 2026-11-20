# LAPORAN PENINJAUAN USER PERSONAS (USER PERSONAS & EMPATHY MAPPING REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-013  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.3 Product Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst) & Riya Monika (UI/UX Designer)  
**Tanggal Peninjauan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-012 — Meninjau product vision (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Peninjauan Persona Pengguna (Task DOC-013) dilakukan untuk memvalidasi representasi profil pengguna nyata yang menjadi target utama website **BLOOMÉ — Flowers & Stories**. Melalui penyusunan persona berbasis empati (*Empathy Mapping*), tim pengembang memastikan bahwa setiap keputusan tata letak UI, navigasi katalog, konfigurator personalisasi, integrasi WhatsApp hand-off, dan fungsionalitas dashboard admin secara nyata menjawab kebutuhan, motivasi, serta titik frustrasi (*pain points*) pengguna di Samarinda.

Sesuai dengan konsep sistem terbaru (v1.1), sistem informasi BLOOMÉ berfungsi sebagai **katalog interaktif dan media personalisasi buket bunga, sedangkan proses pemesanan, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**. Hasil peninjauan memetakan dua tipe persona pembeli (*Customer Personas*) dan satu persona pengelola usaha (*Administrator Persona*).

---

## 2. Profil Persona Pelanggan (Customer Personas)

### 2.1 Persona 1: Dinda Kirana — Pembeli Katalog Cepat (The Fast & Aesthetic Buyer)
- **Demografi:** 22 tahun, Mahasiswi Tingkat Akhir, Kota Samarinda.
- **Profil Perilaku:** Pengguna aktif smartphone, menyukai visual estetik di Instagram dan Pinterest, sangat sibuk mempersiapkan sidang skripsi dan menghadiri perayaan wisuda teman-temannya.
- **Skenario Penggunaan:** Ingin memesan buket bunga segar atau buket uang untuk sahabatnya yang sidang besok lusa tanpa proses yang berbelit-belit.
- **Tujuan Utama (Goals):**
  - Melihat katalog buket siap pesan beserta harganya secara transparan 24/7 tanpa perlu repot bertanya harga dasar di chat.
  - Memilih kombinasi warna wrapping dan pita yang manis secara visual melalui *color swatches*.
  - Menambahkan kartu ucapan selamat kelulusan dan melihat estimasi total harga secara instan.
  - Melakukan pemesanan langsung ke WhatsApp tanpa perlu membuat akun, tanpa password, dan tanpa mengisi formulir checkout web yang panjang.
- **Titik Frustrasi (Pain Points):**
  - Toko bunga yang tidak mencantumkan harga dan lambat membalas chat WhatsApp.
  - Situs web dengan form pendaftaran akun panjang yang mewajibkan verifikasi email/kata sandi.
  - Penulisan kartu ucapan yang salah ketik (*typo*) oleh penjual karena obrolan chat tercecer.

---

### 2.2 Persona 2: Reza Pratama — Pembeli Personalisasi Custom (The Thoughtful Custom Gift Giver)
- **Demografi:** 26 tahun, Karyawan Swasta, Samarinda Ilir.
- **Profil Perilaku:** Teliti, menghargai hubungan personal, ingin memberikan kado spesial di hari perayaan (*anniversary*) pasangannya, terbiasa mencari inspirasi foto buket kustom dari internet.
- **Skenario Penggunaan:** Ingin memesan buket dengan kombinasi warna khusus dan add-on cokelat/boneka, atau membawa ide rangkaian bunga unik di luar katalog dan ingin berdiskusi langsung dengan florist.
- **Tujuan Utama (Goals):**
  - Mengeksplorasi opsi variasi warna wrapping, jenis pita, serta add-on pendukung dengan kepastian penyesuaian harga yang transparan.
  - Menghubungi florist secara langsung melalui tombol "Konsultasi Buket Custom via WhatsApp" untuk mendiskusikan desain unik, mengirim referensi gambar di chat, dan menyepakati penawaran harga.
  - Melakukan pembayaran transfer bank atau e-wallet resmi dengan instruksi yang terpercaya dan fleksibilitas negosiasi atau DP 50%.
- **Titik Frustrasi (Pain Points):**
  - Florist yang kaku atau sistem otomatis yang tidak bisa diajak berdiskusi tentang detail custom.
  - Kenaikan harga mendadak di akhir tanpa penjelasan komponen variasi.
  - Formulir kustomisasi web yang rumit dan tidak fleksibel menampung keinginan desain non-standar.

---

## 3. Profil Persona Pengelola (Administrator Persona)

### 3.1 Nabila Febriyani — Pemilik Usaha & Florist Artisan (The Multi-Tasking Florist / Solopreneur)
- **Demografi:** 24 tahun, Pemilik Usaha & Florist BLOOMÉ, Samarinda.
- **Profil Perilaku:** Kreatif, teliti dalam merangkai bunga, mengelola bisnis secara mandiri (*solopreneur*), sering mengakses sistem melalui laptop di butik maupun smartphone saat berbelanja bunga di pasar/suplier.
- **Tujuan Utama (Goals):**
  - Mengelola etalase digital secara mandiri: menambah buket baru, mengunggah multi-foto galeri, mengubah status ketersediaan stok (*Tersedia* / *Habis*) secara cepat agar pelanggan tidak memesan bahan yang kosong.
  - Mengonfigurasi pilihan variasi personalisasi (warna wrapping, pita) dan item add-on beserta penyesuaian harganya.
  - Mengatur nomor WhatsApp resmi bisnis toko (`business_settings`) agar seluruh permintaan pemesanan masuk ke nomor yang tepat.
  - Menerima pesan masuk di WhatsApp yang sudah terstruktur rapi dari web (nama produk, variasi, add-on, catatan ucapan, estimasi harga), sehingga menghemat waktu tanya-jawab berulang dan memungkinkannya fokus merangkai bunga serta melayani pelanggan secara hangat.
- **Titik Frustrasi (Pain Points):**
  - Obrolan chat WhatsApp yang berantakan karena pelanggan tidak tahu apa yang ingin dipesan atau menanyakan warna kertas yang habis.
  - Waktu terbuang menjelaskan ulang rincian harga dasar dan biaya tambahan satu per satu.
  - Sistem rumit yang membebaninya untuk mengelola status transaksi teknis di web saat tangannya sedang sibuk merangkai bunga basah.

---

## 4. Peta Empati (Empathy Map Matrix)

### 4.1 Empathy Map: Pelanggan (Customer)
| Kuadran | Hasil Analisis Empati Pelanggan |
|---|---|
| **What they THINK & FEEL?** | *"Saya ingin memberikan kado buket terbaik tanpa buang waktu; saya butuh kepastian harga, warna yang pas, dan bisa langsung memesan ke WhatsApp toko."* |
| **What they SEE?** | Etalase buket menawan di web, palet warna pastel yang estetik, pilihan add-on cokelat/boneka, tombol pesan WhatsApp yang jelas. |
| **What they HEAR?** | Rekomendasi butik buket di Samarinda; keluhan teman yang pesanannya salah ucapan atau warna kertasnya tidak sesuai saat pesan via DM media sosial. |
| **What they SAY & DO?** | Menjelajahi katalog via HP, memilih variasi warna wrapping, menambahkan add-on, mengetik pesan kartu ucapan, meninjau estimasi harga, lalu menekan "Pesan via WhatsApp". |
| **PAINS (Titik Sakit)** | Keharusan membuat akun/login, form checkout web yang kaku, ketidakjelasan harga dasar, salah ketik kartu ucapan. |
| **GAINS (Kebutuhan Nilai)** | Eksplorasi bebas tanpa login, swatch warna visual interaktif, teks WhatsApp tersusun rapi otomatis, kemudahan berkonsultasi langsung dengan florist. |

---

### 4.2 Empathy Map: Pengelola (Admin / Nabila)
| Kuadran | Hasil Analisis Empati Pemilik Usaha |
|---|---|
| **What they THINK & FEEL?** | *"Saya ingin fokus merangkai bunga yang indah dengan tenang tanpa lelah menjawab pertanyaan dasar yang sama berulang kali di chat WhatsApp."* |
| **What they SEE?** | Stok bunga segar di butik, pesan WhatsApp pelanggan yang sudah rapi memuat detail pesanan dari website, mutasi transfer masuk di mobile banking. |
| **What they HEAR?** | Kepuasan pelanggan yang senang pesanannya sesuai warna impian, apresiasi atas respons chat yang cepat dan terarah. |
| **What they SAY & DO?** | Memperbarui katalog dan foto produk di web admin, mengatur toggle ketersediaan stok, menyapa pelanggan yang masuk dari tautan WhatsApp web, mengonfirmasi pembayaran DP/lunas, dan mengoordinasikan jadwal kurir. |
| **PAINS (Titik Sakit)** | Mengetik format pesanan manual berulang-ulang, salah paham warna buket di chat, repot mengelola sistem web yang terlalu birokratis. |
| **GAINS (Kebutuhan Nilai)** | Panel admin yang ringan dan fokus pada etalase & stok, format pesan WhatsApp yang terstruktur baku dari web, fleksibilitas penanganan transaksi di chat. |

---

## 5. Dampak Peninjauan Persona terhadap Rancangan UI/UX & Fitur Sistem

Peninjauan persona menghasilkan keputusan desain konkret yang menjamin kepuasan pengguna:

1. **Zero-Login & Peniadaan Form Checkout Web (Menjawab Kebutuhan Dinda):**
   - Pelanggan tidak dibebani form registrasi atau alur checkout multi-tahap di web. Transaksi dialihkan secara alami ke WhatsApp yang merupakan aplikasi percakapan sehari-hari.
2. **Konfigurator Visual & Pratinjau Catatan Ucapan (Menjawab Kebutuhan Dinda & Reza):**
   - Pemilihan variasi wrapping dan pita disajikan menggunakan pemilih visual (*color swatches*) yang intuitif. Kolom catatan khusus dan kartu ucapan dilengkapi counter karakter untuk mencegah salah ketik.
3. **Kalkulasi Estimasi Harga Real-Time (Menjawab Transparansi Dinda & Reza):**
   - Kartu ringkasan pesanan secara otomatis menghitung `Harga Dasar + Penyesuaian Variasi + Total Add-on` secara live di layar antarmuka pengguna sebelum dialihkan ke WhatsApp.
4. **Tombol Konsultasi Custom Khusus (Menjawab Kebutuhan Desain Unik Reza):**
   - Disediakan tombol khusus "Konsultasi Buket Custom via WhatsApp" dengan template pesan pembuka yang mengundang diskusi personal, pengiriman referensi foto di chat, dan penawaran harga fleksibel.
5. **Panel Admin Ringkas & Fokus Etalase (Menjawab Kenyamanan Kerja Nabila):**
   - Dashboard admin difokuskan sepenuhnya pada pengelolaan master etalase: produk, kategori, galeri foto, variasi personalisasi, item add-on, toggle ketersediaan stok instan, dan konfigurasi nomor WhatsApp bisnis (`business_settings`).

---

## 6. Kesimpulan & Rekomendasi

### 6.1 Status Task DOC-013
Task **DOC-013 (Meninjau user personas)** telah selesai dilaksanakan:
- 3 Persona representatif (Dinda Kirana, Reza Pratama, Nabila Febriyani) telah ditinjau mendalam lengkap dengan peta empati (*Empathy Map*) dan penyesuaian kebutuhan v1.1.
- Seluruh keputusan UI/UX dan batasan fungsional selaras dengan model pemesanan WhatsApp terintegrasi.
- Kriteria penyelesaian terpenuhi 100%.

### 6.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task peninjauan berikutnya pada sub-fase 4.3:
- **`DOC-014 — Meninjau user stories.`**
