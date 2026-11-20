# LAPORAN PENINJAUAN USER STORIES & SKENARIO PENERIMAAN (USER STORIES REVIEW)
## BLOOMÉ — Flowers & Stories
**Task ID:** DOC-014  
**Fase:** Phase 1 — Project Initiation and Documentation (Sub-fase 4.3 Product Documentation)  
**Penanggung Jawab:** Jayanti Firdasari (Project Manager & System Analyst)  
**Tanggal Peninjauan:** 13 November 2026 (Diperbarui: 20 November 2026 — Penyelarasan Konsep v1.1)  
**Status Task:** Completed (`[x]`)  
**Dependensi:** DOC-013 — Meninjau user personas (Selesai dan Diselaraskan)  

---

## 1. Ringkasan Eksekutif

Peninjauan Cerita Pengguna (Task DOC-014) dilakukan untuk memvalidasi kelengkapan, ketajaman nilai, serta keterujian (*testability*) dari seluruh **User Stories** yang menjadi jembatan antara kebutuhan bisnis pengguna (*Customer* dan *Admin*) dengan implementasi teknis website **BLOOMÉ — Flowers & Stories**.

Berdasarkan kesepakatan terbaru (Konsep Sistem v1.1), sistem informasi BLOOMÉ difokuskan sebagai **website katalog interaktif dan media personalisasi buket bunga, sedangkan proses pemesanan, konfirmasi harga, pembayaran, negosiasi, dan pengiriman dilanjutkan secara langsung melalui WhatsApp**.

Hasil peninjauan mengonfirmasi terdapat **26 User Stories Terstruktur (US-001 s/d US-026)** yang dikelompokkan ke dalam **8 Klaster Fungsional**. Seluruh cerita pengguna telah diaudit menggunakan kriteria kualitas internasional **INVEST** (*Independent, Negotiable, Valuable, Estimable, Small, Testable*) dan dilengkapi skenario penerimaan berformat *Given-When-Then* (Gherkin syntax).

---

## 2. Katalog Lengkap 26 User Stories Berdasarkan 8 Klaster Fungsional

### 2.1 Klaster 1: Eksplorasi Katalog & Navigasi Kategori (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-001** | *Sebagai pelanggan, saya ingin melihat halaman beranda yang memuat identitas butik dan sorotan produk, agar saya mengenal BLOOMÉ dan menemukan inspirasi kado.* | **Given** pelanggan membuka URL utama, **When** halaman selesai dimuat, **Then** tampil hero banner estetik, produk unggulan, navigasi kategori, dan alamat butik di Samarinda tanpa form login. |
| **US-002** | *Sebagai pelanggan, saya ingin menelusuri katalog buket bunga berdasarkan kategori, agar saya dapat menemukan buket yang sesuai tema acara.* | **Given** pelanggan di halaman katalog, **When** memilih filter "Buket Bunga", **Then** daftar produk hanya menampilkan buket kategori tersebut lengkap dengan harga dasar dan ketersediaan stok. |
| **US-003** | *Sebagai pelanggan, saya ingin melihat detail produk dengan galeri foto multi-sudut dan deskripsi komposisi bunga, agar saya yakin dengan kualitas buket sebelum memesan.* | **Given** pelanggan mengklik kartu produk, **When** halaman detail terbuka, **Then** tampil galeri multi-foto tajam, deskripsi bahan, harga dasar, dan tombol pemesanan. |
| **US-004** | *Sebagai pelanggan, saya ingin melihat badge ketersediaan produk (Tersedia / Habis), agar saya tidak memesan produk yang bahannya sedang kosong.* | **Given** produk berstatus habis, **When** pelanggan membuka detail, **Then** tampil badge "Stok Habis" dan tombol pemesanan WhatsApp dinonaktifkan secara visual. |

---

### 2.2 Klaster 2: Konfigurasi Personalisasi & Add-on (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-005** | *Sebagai pelanggan, saya ingin memilih variasi personalisasi buket (warna wrapping, pita), agar tampilan buket sesuai dengan selera penerima.* | **Given** detail produk dengan opsi personalisasi terbuka, **When** pelanggan memilih swatch warna wrapping/pita, **Then** opsi terpilih tercentang dan rincian variasi tercatat pada ringkasan. |
| **US-006** | *Sebagai pelanggan, saya ingin memilih item add-on (kartu ucapan khusus, cokelat, boneka), agar hadiah buket saya semakin istimewa dan berkesan.* | **Given** daftar add-on tersedia di halaman produk, **When** pelanggan mencentang satu atau lebih add-on, **Then** item add-on beserta biaya tambahannya ditambahkan ke ringkasan. |
| **US-007** | *Sebagai pelanggan, saya ingin menuliskan catatan khusus dan teks kartu ucapan, agar pesan personal saya tersampaikan kepada penerima.* | **Given** kolom catatan/ucapan tersedia, **When** pelanggan mengetik ucapan, **Then** sistem menampilkan counter karakter dan menyimpan teks secara utuh di memori antarmuka. |

---

### 2.3 Klaster 3: Ringkasan Estimasi & Pemesanan WhatsApp (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-008** | *Sebagai pelanggan, saya ingin melihat kalkulasi ringkasan pilihan dan estimasi harga secara real-time, agar saya mengetahui perkiraan total biaya sebelum memesan.* | **Given** pelanggan memilih variasi dan add-on, **When** ada pilihan yang berubah, **Then** panel ringkasan otomatis mengalkulasi total estimasi (Harga Dasar + Variasi + Add-on) secara live. |
| **US-009** | *Sebagai pelanggan, saya ingin memilih beberapa jenis buket dalam satu pesan WhatsApp `[Perlu Konfirmasi Owner]`, agar saya dapat memesan lebih dari satu buket sekaligus secara efisien.* | **Given** pelanggan ingin memesan lebih dari 1 produk, **When** menambahkan buket ke daftar sementara ringkasan pesan, **Then** sistem menyusun rincian seluruh buket ke dalam satu draf pemesanan. |
| **US-010** | *Sebagai pelanggan, saya ingin menekan tombol "Pesan via WhatsApp" untuk menghasilkan pesan terformat otomatis, agar saya tidak perlu mengetik rincian pesanan secara manual.* | **Given** konfigurasi buket telah lengkap, **When** pelanggan menekan "Pesan via WhatsApp", **Then** sistem membuka tautan `wa.me` ke nomor toko dengan teks draf rapi berisi nama produk, opsi personalisasi, add-on, ucapan, dan estimasi harga. |

---

### 2.4 Klaster 4: Konsultasi Buket Custom via WhatsApp (Customer)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-011** | *Sebagai pelanggan, saya ingin mengakses tombol konsultasi buket custom langsung ke WhatsApp, agar saya dapat memesan desain khusus di luar katalog.* | **Given** pelanggan berada di halaman kustom/kontak, **When** menekan "Konsultasi Buket Custom", **Then** sistem membuka tautan WhatsApp dengan template salam konsultasi desain kustom. |
| **US-012** | *Sebagai pelanggan, saya ingin mendiskusikan rancangan buket custom dan mengirim gambar referensi di chat WhatsApp, agar florist dapat menilai ketersediaan bahan dan memberikan penawaran harga.* | **Given** chat WhatsApp toko terbuka, **When** pelanggan mengirim foto referensi dan preferensi, **Then** pemilik toko meninjau, menegosiasikan, dan menyepakati harga langsung via WhatsApp. |

---

### 2.5 Klaster 5: Autentikasi Admin & Dashboard Overview (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-013** | *Sebagai admin, saya ingin login panel admin menggunakan email dan password terenkripsi, agar data etalase dan konfigurasi toko terlindungi dari pihak luar.* | **Given** halaman login admin dibuka, **When** memasukkan email dan password valid, **Then** sistem memberikan sesi terotentikasi; jika salah, sistem menampilkan pesan error kredensial. |
| **US-014** | *Sebagai admin, saya ingin melihat kartu ringkasan etalase digital di dashboard, agar saya dapat memantau kesehatan katalog produk secara cepat.* | **Given** admin login di dashboard, **When** halaman beranda admin terbuka, **Then** tampil kartu metrik: total produk aktif, total kategori, opsi personalisasi aktif, item add-on, dan nomor WhatsApp toko aktif. |

---

### 2.6 Klaster 6: Manajemen Master Kategori, Produk & Ketersediaan Stok (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-015** | *Sebagai admin, saya ingin menambah, mengubah, dan menghapus kategori produk, agar pengelompokan buket tetap teratur.* | **Given** menu Kategori dibuka, **When** admin menyimpan kategori baru, **Then** data tersimpan di tabel `categories` dan langsung muncul pada filter katalog publik. Kategori yang masih terikat produk aktif dicegah untuk dihapus. |
| **US-016** | *Sebagai admin, saya ingin mengelola master produk buket (nama, deskripsi, harga dasar, kategori), agar etalase produk selalu mutakhir.* | **Given** form produk dibuka, **When** admin menyimpan data buket, **Then** data tersimpan di tabel `products` dan tayang di katalog publik. |
| **US-017** | *Sebagai admin, saya ingin mengubah toggle ketersediaan stok buket (*Tersedia* / *Habis*), agar pelanggan langsung mengetahui jika bahan bunga tertentu sedang kosong di butik.* | **Given** bahan bunga habis di butik, **When** admin menonaktifkan status ketersediaan produk, **Then** sistem langsung memperbarui badge menjadi "Habis" di katalog publik. |

---

### 2.7 Klaster 7: Manajemen Galeri Multi-Foto, Variasi Personalisasi & Add-on (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-018** | *Sebagai admin, saya ingin mengunggah beberapa foto untuk satu produk buket dan memilih satu foto sampul utama (*primary*), agar tampilan buket menarik dari berbagai sudut.* | **Given** admin di form galeri foto produk, **When** mengunggah berkas gambar valid (JPG/PNG ≤ 2MB), **Then** berkas disimpan di local storage, tercatat di `product_photos`, dan foto berlabel primary tampil sebagai sampul utama. |
| **US-019** | *Sebagai admin, saya ingin mengonfigurasi tipe personalisasi (warna kertas wrapping, pita) untuk setiap produk buket, agar pelanggan dapat memilih variasi yang didukung produk tersebut.* | **Given** admin mengelola produk, **When** menautkan tipe personalisasi di `product_personalization_types`, **Then** opsi variasi tersebut muncul di konfigurator produk publik. |
| **US-020** | *Sebagai admin, saya ingin mengelola nilai opsi variasi beserta penyesuaian harganya (misal: wrapping premium +Rp15.000), agar perubahan harga tercatat otomatis.* | **Given** admin di menu nilai personalisasi, **When** menginput nilai variasi dan nominal penyesuaian harga di `personalization_values`, **Then** kalkulator publik memperhitungkan biaya tersebut saat dipilih pelanggan. |
| **US-021** | *Sebagai admin, saya ingin mengelola master item add-on (nama, harga, gambar), agar produk pendukung seperti cokelat atau boneka dapat ditawarkan kepada pelanggan.* | **Given** menu Add-on dibuka, **When** admin menyimpan data add-on di tabel `add_ons`, **Then** item add-on siap ditautkan ke produk buket. |
| **US-022** | *Sebagai admin, saya ingin menautkan item add-on ke produk buket tertentu, agar add-on yang relevan tampil pada konfigurator produk.* | **Given** admin di tab Add-on produk, **When** mencentang add-on yang diizinkan di `product_add_ons`, **Then** pilihan add-on tersebut muncul pada halaman detail produk terkait. |

---

### 2.8 Klaster 8: Pengaturan Bisnis & WhatsApp Toko (Admin)
| ID Story | Pernyataan User Story | Skenario Penerimaan (Acceptance Criteria / Gherkin) |
|---|---|---|
| **US-023** | *Sebagai admin, saya ingin memperbarui nomor WhatsApp bisnis toko, agar seluruh pesan pemesanan dan konsultasi masuk ke nomor kontak aktif.* | **Given** admin membuka menu Pengaturan Bisnis, **When** mengupdate nomor WhatsApp di tabel `business_settings`, **Then** seluruh tautan tombol WhatsApp di sisi publik otomatis mengarah ke nomor baru tersebut. |
| **US-024** | *Sebagai admin, saya ingin mengonfigurasi template pembuka pesan WhatsApp standar, agar salam pembuka yang dihasilkan konsisten dengan keramahan butik BLOOMÉ.* | **Given** form pengaturan pesan dibuka, **When** admin menyesuaikan template teks pembuka di `business_settings`, **Then** generator pesan WhatsApp menyertakan teks pembuka tersebut. |
| **US-025** | *Sebagai admin, saya ingin memperbarui alamat lokasi butik di Samarinda dan jam operasional, agar informasi kontak pada beranda dan footer selalu akurat.* | **Given** admin di menu Informasi Bisnis, **When** memperbarui alamat dan jam buka di `business_settings`, **Then** footer dan beranda website menampilkan data alamat terbaru secara instan. |
| **US-026** | *Sebagai admin, saya ingin melakukan logout secara aman dari panel admin, agar sesi administrator berakhir dan tidak dapat diakses orang lain.* | **Given** admin sedang login, **When** menekan tombol Logout, **Then** sesi login di server dihancurkan (*session invalidated*) dan halaman dialihkan ke form login. |

---

## 3. Evaluasi Kualitas User Stories (Audit Kriteria INVEST)

| Kriteria INVEST | Analisis Kepatuhan Cerita Pengguna BLOOMÉ v1.1 | Status Kepatuhan |
|---|---|:---:|
| **Independent (Mandiri)** | Setiap cerita dapat diimplementasikan dan diuji secara terisolasi tanpa menciptakan dependensi melingkar (*no circular dependency*). | **Lolos 100%** |
| **Negotiable (Dapat Dinegosiasikan)** | Rincian tata letak UI (penempatan tombol, animasi swatch) fleksibel disesuaikan selama tidak melanggar aturan bisnis WhatsApp hand-off. | **Lolos 100%** |
| **Valuable (Bernilai Nyata)** | Setiap cerita memberikan nilai konkret bagi kenyamanan pembeli kasual tanpa registrasi atau efisiensi florist dalam mengelola etalase & menerima pesanan rapi. | **Lolos 100%** |
| **Estimable (Dapat Diestimasi)** | Ruang lingkup setiap cerita jelas terdefinisi sehingga developer (Elsa Futri & Riya Monika) dapat memperkirakan jam kerja coding secara akurat. | **Lolos 100%** |
| **Small (Ukuran Tepat)** | Tidak ada cerita bertipe "Epic raksasa"; seluruh cerita dirancang dapat diselesaikan dalam rentang 1-2 hari kerja per task. | **Lolos 100%** |
| **Testable (Dapat Diuji)** | Setiap cerita memiliki skenario penerimaan eksplisit berformat *Given-When-Then* yang dapat diverifikasi secara objektif pada fase pengujian sistem. | **Lolos 100%** |

---

## 4. Kesimpulan & Rekomendasi

### 4.1 Status Task DOC-014
Task **DOC-014 (Meninjau user stories)** telah selesai dilaksanakan:
- 26 User Stories terstruktur lengkap dengan skenario penerimaan (*Acceptance Criteria*) telah diselaraskan penuh dengan 8 klaster fungsional arsitektur katalog & pemesanan WhatsApp v1.1.
- Seluruh sisa user story checkout web, approval harga di web, mutasi transfer web, dan pembatalan web telah dieliminasi dan digantikan dengan cerita konfigurator personalisasi, add-on, kalkulator estimasi live, WhatsApp hand-off, galeri multi-foto, dan pengaturan WhatsApp bisnis.
- Seluruh cerita memenuhi standar kualitas INVEST 100%.

### 4.2 Rekomendasi Langkah Berikutnya:
Melanjutkan ke task penutup sub-fase 4.3:
- **`DOC-015 — Meninjau product priorities.`**
