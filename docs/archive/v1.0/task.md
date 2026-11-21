# MASTER PROMPT — PROJECT TASK MANAGEMENT
# BLOOMÉ — Flowers & Stories

## ROLE

Bertindaklah sebagai Senior Project Manager, Technical Project Manager, Software Architect, System Analyst, UI/UX Lead, Backend Developer, Frontend Developer, dan QA Engineer.

Tugas Anda adalah menyusun dokumen manajemen tugas proyek (Task Management Document) yang mencakup seluruh proses pengembangan website BLOOMÉ dari tahap perencanaan hingga penyelesaian dan serah terima.

Nama file:

`task.md`

Dokumen ini akan digunakan sebagai:
- Master checklist proyek.
- Panduan kerja AI coding assistant.
- Panduan kerja seluruh anggota tim.
- Alat pemantauan progres.
- Acuan pembagian tugas.
- Acuan pengujian dan penyelesaian proyek.

Jangan membuat task list yang hanya berisi aktivitas umum. Pecah setiap pekerjaan menjadi task dan subtask yang jelas, spesifik, terukur, serta memiliki hasil yang dapat diperiksa.

---

# 1. PROJECT INFORMATION

Nama produk:

**BLOOMÉ — Flowers & Stories**

Nama proyek:

Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web.

Project Sponsor:

Nabila Febriyani.

Lokasi usaha:

Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Kota Samarinda.

Teknologi:

- Laravel.
- PHP.
- HTML.
- CSS.
- JavaScript.
- MySQL.
- Laravel Blade jika digunakan.
- Vite untuk pengelolaan aset frontend jika digunakan.

Arsitektur:

Three-Layer Architecture:
1. Presentation Layer.
2. Application Layer.
3. Data Layer.

Metodologi:

Waterfall.

Periode proyek:

13 Oktober–30 November 2026.

## Project Team

| Anggota | Peran | Tanggung Jawab |
|---|---|---|
| Jayanti Firdasari | Project Manager & System Analyst | Perencanaan, analisis kebutuhan, koordinasi, dokumentasi, dan pengawasan proyek |
| Riya Monika | UI/UX Designer & Frontend Developer | Design system, wireframe, mockup, prototype, dan implementasi frontend |
| Elsa Futri | Backend Developer & Database Administrator | Arsitektur backend, database, Laravel, business logic, dan integrasi backend |

Pembagian pekerjaan dapat disesuaikan melalui kesepakatan tim, tetapi tanggung jawab utama setiap anggota harus tetap terlihat.

---

# 2. SOURCE OF TRUTH

Sebelum membuat task list, baca seluruh dokumen proyek yang tersedia:

1. `requirement.md`
2. `prd.md`
3. `architecture.md`
4. `design-system.md`
5. `user-flow.md`
6. `database-design.md`
7. Project Charter.
8. Dokumen analisis kebutuhan sistem.

Jika sebagian dokumen belum tersedia, jangan menganggapnya sudah selesai.

Gunakan aturan:

- Project Charter menentukan ruang lingkup, jadwal, anggaran, dan tujuan proyek.
- `requirement.md` menentukan kebutuhan fungsional, nonfungsional, dan business rules.
- `prd.md` menentukan kebutuhan produk, user stories, prioritas, dan acceptance criteria.
- `architecture.md` menentukan rancangan teknis sistem.
- `design-system.md` menentukan konsistensi visual.
- `user-flow.md` menentukan alur pengguna.
- `database-design.md` menentukan rancangan database.

Jangan membuat task yang bertentangan dengan dokumen sumber.

Jika ada informasi yang belum tersedia, tandai sebagai `[PERLU KONFIRMASI]`.

---

# 3. TASK MANAGEMENT RULES

Setiap task wajib memiliki:

- Task ID.
- Phase.
- Task Name.
- Description.
- Assigned To.
- Priority.
- Status.
- Dependencies.
- Deliverables.
- Acceptance Criteria.

Gunakan format ID:

- DOC-001: Documentation.
- ANA-001: Analysis.
- UX-001: UI/UX.
- ARC-001: Architecture.
- DB-001: Database.
- BE-001: Backend.
- FE-001: Frontend.
- INT-001: Integration.
- SEC-001: Security.
- QA-001: Quality Assurance.
- DEP-001: Deployment.
- FIN-001: Finalization.

## Status

Gunakan status:

- [ ] Not Started.
- [~] In Progress.
- [x] Completed.
- [!] Blocked.
- [-] Cancelled.

Jangan mengubah status menjadi Completed tanpa bukti bahwa pekerjaan benar-benar selesai.

## Priority

Gunakan:

- P0 — Critical.
- P1 — High.
- P2 — Medium.
- P3 — Low.

## Dependency

Tentukan task mana yang harus selesai sebelum task lain dimulai.

Jangan mengerjakan task yang memiliki dependency belum terpenuhi, kecuali pekerjaan tersebut memang dapat dilakukan secara paralel.

## Deliverables

Setiap task harus menghasilkan sesuatu yang dapat diperiksa, misalnya:

- File dokumentasi.
- Diagram.
- Wireframe.
- Mockup.
- Migration.
- Model.
- Controller.
- Blade view.
- CSS component.
- JavaScript module.
- Test case.
- Test report.

---

# 4. PHASE 1 — PROJECT INITIATION AND DOCUMENTATION

Tujuan: Menyiapkan seluruh dasar proyek dan dokumentasi.

Buat task untuk:

## 4.1 Project Foundation

- [x] DOC-001 — Memeriksa Project Charter.
- [x] DOC-002 — Memeriksa ruang lingkup proyek.
- [x] DOC-003 — Memeriksa pembagian tugas tim.
- [x] DOC-004 — Memastikan jadwal proyek.
- [x] DOC-005 — Menentukan struktur direktori dokumentasi.

## 4.2 Requirements Documentation

- [x] DOC-006 — Menyusun `requirement.md`.
- [x] DOC-007 — Meninjau functional requirements.
- [x] DOC-008 — Meninjau non-functional requirements.
- [x] DOC-009 — Meninjau business rules.
- [x] DOC-010 — Meninjau acceptance criteria.

## 4.3 Product Documentation

- [x] DOC-011 — Menyusun `prd.md`.
- [x] DOC-012 — Meninjau product vision.
- [x] DOC-013 — Meninjau user personas.
- [x] DOC-014 — Meninjau user stories.
- [x] DOC-015 — Meninjau product priorities.

## 4.4 Technical Documentation

- [x] DOC-016 — Menyusun `architecture.md`.
- [x] DOC-017 — Menyusun `database-design.md`.
- [x] DOC-018 — Menyusun `design-system.md`.
- [x] DOC-019 — Menyusun `user-flow.md`.
- [x] DOC-020 — Menyusun `implementation-plan.md`.
- [x] DOC-021 — Menyusun `testing-plan.md`.

Pastikan seluruh dokumen saling konsisten sebelum implementasi dimulai.

---

# 5. PHASE 2 — SYSTEM ANALYSIS AND DESIGN

Tujuan: Memastikan sistem sudah memiliki rancangan yang dapat diimplementasikan.

## 5.1 Requirement Validation

Buat task untuk:
- Memvalidasi kebutuhan pelanggan.
- Memvalidasi kebutuhan admin.
- Memvalidasi alur katalog.
- Memvalidasi alur custom.
- Memvalidasi pembayaran.
- Memvalidasi pembatalan.
- Memvalidasi status pesanan.
- Memeriksa kebutuhan yang belum diputuskan.

## 5.2 System Modeling

Buat task untuk:

- [x] ANA-001 — Use Case Diagram.
- [x] ANA-002 — Use Case Description.
- [x] ANA-003 — Activity Diagram pemesanan katalog.
- [x] ANA-004 — Activity Diagram pemesanan custom.
- [x] ANA-005 — Activity Diagram pembayaran.
- [x] ANA-006 — Activity Diagram pembatalan.
- [x] ANA-007 — Sequence Diagram pemesanan.
- [x] ANA-008 — Sequence Diagram pembayaran.
- [x] ANA-009 — Sequence Diagram pengelolaan pesanan.
- [x] ANA-010 — Validasi seluruh diagram.

Diagram tambahan dapat dibuat jika diperlukan dan disepakati.

## 5.3 System Architecture

Buat task untuk:

- [x] ARC-001 — Menentukan Three-Layer Architecture.
- [x] ARC-002 — Membuat High-Level Architecture Diagram.
- [x] ARC-003 — Membuat Component Diagram.
- [ ] ARC-004 — Menentukan Application Modules.
- [ ] ARC-005 — Menentukan Routing Architecture.
- [ ] ARC-006 — Menentukan Controller Responsibilities.
- [ ] ARC-007 — Menentukan Service Responsibilities.
- [ ] ARC-008 — Menentukan Model Relationships.
- [ ] ARC-009 — Menentukan File Storage Architecture.
- [ ] ARC-010 — Menentukan Security Architecture.

---

# 6. PHASE 3 — UI/UX DESIGN

Tujuan: Menghasilkan desain seluruh website dengan konsistensi visual.

Gunakan `design-system.md` sebagai sumber utama.

## 6.1 Design System

Buat task untuk:

- [ ] UX-001 — Menetapkan color tokens.
- [ ] UX-002 — Menetapkan typography.
- [ ] UX-003 — Menetapkan spacing system.
- [ ] UX-004 — Menetapkan border radius.
- [ ] UX-005 — Menetapkan shadow dan border.
- [ ] UX-006 — Mendesain button components.
- [ ] UX-007 — Mendesain form components.
- [ ] UX-008 — Mendesain card components.
- [ ] UX-009 — Mendesain table components.
- [ ] UX-010 — Mendesain badge dan status components.
- [ ] UX-011 — Mendesain navbar dan footer.
- [ ] UX-012 — Mendesain admin sidebar dan header.
- [ ] UX-013 — Menetapkan ilustrasi floral.

## 6.2 Customer Wireframe and Mockup

Buat task untuk seluruh halaman:

- [ ] UX-014 — Homepage.
- [ ] UX-015 — Katalog Produk.
- [ ] UX-016 — Detail Produk.
- [ ] UX-017 — Form Pemesanan Katalog.
- [ ] UX-018 — Form Custom Bouquet.
- [ ] UX-019 — Upload Gambar Referensi.
- [ ] UX-020 — Ringkasan Pesanan.
- [ ] UX-021 — Informasi Pembayaran.
- [ ] UX-022 — Konfirmasi Pesanan.
- [ ] UX-023 — Tentang Usaha.
- [ ] UX-024 — Kontak.

## 6.3 Admin Wireframe and Mockup

Buat task untuk:

- [ ] UX-025 — Login Admin.
- [ ] UX-026 — Dashboard.
- [ ] UX-027 — Manajemen Produk.
- [ ] UX-028 — Form Tambah/Edit Produk.
- [ ] UX-029 — Manajemen Kategori.
- [ ] UX-030 — Manajemen Pesanan.
- [ ] UX-031 — Detail Pesanan.
- [ ] UX-032 — Permintaan Custom.
- [ ] UX-033 — Detail Permintaan Custom.
- [ ] UX-034 — Penentuan Harga Custom.
- [ ] UX-035 — Manajemen Pembayaran.
- [ ] UX-036 — Detail Pembayaran.
- [ ] UX-037 — Pengelolaan Status Pesanan.
- [ ] UX-038 — Pengajuan Pembatalan.
- [ ] UX-039 — Pengaturan Admin.

## 6.4 Responsive Design

Buat task untuk:
- Desktop.
- Tablet.
- Mobile.

Periksa seluruh halaman pada ukuran layar yang telah ditentukan.

## 6.5 Prototype

Buat prototype untuk:
- Catalog ordering.
- Custom ordering.
- Admin product management.
- Admin order management.
- Payment verification.
- Cancellation management.

---

# 7. PHASE 4 — DATABASE DESIGN AND IMPLEMENTATION

Tujuan: Membuat struktur database yang sesuai dengan kebutuhan sistem.

## 7.1 Database Design

Buat task untuk:

- [ ] DB-001 — Identifikasi entitas.
- [ ] DB-002 — Menentukan atribut setiap entitas.
- [ ] DB-003 — Menentukan primary keys.
- [ ] DB-004 — Menentukan foreign keys.
- [ ] DB-005 — Menentukan relasi.
- [ ] DB-006 — Membuat ERD.
- [ ] DB-007 — Menentukan normalisasi yang sesuai.
- [ ] DB-008 — Menentukan indexing.
- [ ] DB-009 — Meninjau integritas data.
- [ ] DB-010 — Validasi rancangan database.

Entitas awal:

1. admins.
2. categories.
3. products.
4. customers.
5. orders.
6. order_details.
7. custom_requests.
8. custom_references.
9. payments.
10. order_status_histories.

Jangan menganggap atribut dan relasi final sebelum ERD disetujui.

## 7.2 Laravel Migrations

Buat task untuk:

- [ ] DB-011 — Membuat migration admins.
- [ ] DB-012 — Membuat migration categories.
- [ ] DB-013 — Membuat migration products.
- [ ] DB-014 — Membuat migration customers.
- [ ] DB-015 — Membuat migration orders.
- [ ] DB-016 — Membuat migration order_details.
- [ ] DB-017 — Membuat migration custom_requests.
- [ ] DB-018 — Membuat migration custom_references.
- [ ] DB-019 — Membuat migration payments.
- [ ] DB-020 — Membuat migration order_status_histories.
- [ ] DB-021 — Menjalankan seluruh migration.
- [ ] DB-022 — Memvalidasi foreign keys.

## 7.3 Models and Relationships

Buat task untuk:
- Admin model.
- Category model.
- Product model.
- Customer model.
- Order model.
- OrderDetail model.
- CustomRequest model.
- CustomReference model.
- Payment model.
- OrderStatusHistory model.

Periksa seluruh relasi Eloquent.

## 7.4 Seeders and Factories

Buat task untuk:
- Admin seeder.
- Category seeder.
- Product seeder.
- Data dummy untuk testing.
- Validasi data seed.

Jangan memasukkan data dummy ke production.

---

# 8. PHASE 5 — LARAVEL PROJECT FOUNDATION

Tujuan: Menyiapkan aplikasi Laravel.

Buat task untuk:

- [ ] BE-001 — Memeriksa versi PHP dan Laravel.
- [ ] BE-002 — Menyiapkan project Laravel.
- [ ] BE-003 — Mengonfigurasi file `.env`.
- [ ] BE-004 — Menghubungkan MySQL.
- [ ] BE-005 — Mengatur database migrations.
- [ ] BE-006 — Mengatur struktur controller.
- [ ] BE-007 — Mengatur struktur model.
- [ ] BE-008 — Mengatur service classes jika diperlukan.
- [ ] BE-009 — Mengatur Form Requests.
- [ ] BE-010 — Mengatur middleware.
- [ ] BE-011 — Mengatur route groups.
- [ ] BE-012 — Mengatur error handling.
- [ ] BE-013 — Menguji koneksi database.

Gunakan struktur Laravel standar dan hindari abstraksi berlebihan.

---

# 9. PHASE 6 — BACKEND DEVELOPMENT

Tujuan: Mengimplementasikan seluruh logika sistem.

## 9.1 Authentication

- [ ] BE-014 — Implementasi admin login.
- [ ] BE-015 — Implementasi password hashing.
- [ ] BE-016 — Implementasi admin logout.
- [ ] BE-017 — Implementasi protected routes.
- [ ] BE-018 — Menguji akses tanpa autentikasi.

Tidak perlu membuat customer login.

## 9.2 Category Management

- [ ] BE-019 — Category index.
- [ ] BE-020 — Category create.
- [ ] BE-021 — Category store.
- [ ] BE-022 — Category edit.
- [ ] BE-023 — Category update.
- [ ] BE-024 — Category delete.
- [ ] BE-025 — Category validation.

## 9.3 Product Management

- [ ] BE-026 — Product index.
- [ ] BE-027 — Product create.
- [ ] BE-028 — Product store.
- [ ] BE-029 — Product edit.
- [ ] BE-030 — Product update.
- [ ] BE-031 — Product delete.
- [ ] BE-032 — Product image upload.
- [ ] BE-033 — Product availability.
- [ ] BE-034 — Product validation.

## 9.4 Customer Management

- [ ] BE-035 — Customer data validation.
- [ ] BE-036 — Customer data creation.
- [ ] BE-037 — Customer-order relationship.
- [ ] BE-038 — Customer information retrieval.

Jangan membuat akun pelanggan.

## 9.5 Catalog Ordering

- [ ] BE-039 — Product selection.
- [ ] BE-040 — Availability validation.
- [ ] BE-041 — Customer information submission.
- [ ] BE-042 — Order creation.
- [ ] BE-043 — Order detail creation.
- [ ] BE-044 — Order total calculation.
- [ ] BE-045 — Order code generation jika disepakati.
- [ ] BE-046 — Order confirmation response.

Gunakan database transaction untuk operasi yang harus tersimpan secara konsisten.

## 9.6 Custom Bouquet

- [ ] BE-047 — Custom form validation.
- [ ] BE-048 — Custom specification storage.
- [ ] BE-049 — Reference image validation.
- [ ] BE-050 — Reference image storage.
- [ ] BE-051 — Custom request creation.
- [ ] BE-052 — Custom request-order relationship.
- [ ] BE-053 — Custom request retrieval.
- [ ] BE-054 — Custom request detail.

Ketentuan file:
- JPG/JPEG/PNG.
- Maksimal 5 MB per file.
- Jumlah maksimal file belum ditentukan.

## 9.7 Custom Price Management

- [ ] BE-055 — Admin custom request review.
- [ ] BE-056 — Custom price input.
- [ ] BE-057 — Proposed price storage.
- [ ] BE-058 — Price approval recording sesuai workflow yang disetujui.
- [ ] BE-059 — Price rejection recording sesuai workflow yang disetujui.
- [ ] BE-060 — Custom request revision handling.

Jangan membuat kalkulasi harga otomatis.

## 9.8 Order Management

- [ ] BE-061 — Order list.
- [ ] BE-062 — Order detail.
- [ ] BE-063 — Order search dan filter jika diperlukan.
- [ ] BE-064 — Order status update.
- [ ] BE-065 — Status transition validation.
- [ ] BE-066 — Order history.
- [ ] BE-067 — Order status history storage.

## 9.9 Payment Management

- [ ] BE-068 — Payment method handling.
- [ ] BE-069 — Payment information storage.
- [ ] BE-070 — Payment list.
- [ ] BE-071 — Payment detail.
- [ ] BE-072 — Manual payment verification.
- [ ] BE-073 — Payment status update.
- [ ] BE-074 — Payment-order relationship.

Metode pembayaran:
- Transfer bank.
- E-wallet.

Tidak ada payment gateway.

## 9.10 Cancellation Management

- [ ] BE-075 — Cancellation request recording.
- [ ] BE-076 — Cancellation reason storage.
- [ ] BE-077 — Admin cancellation review.
- [ ] BE-078 — Approve cancellation.
- [ ] BE-079 — Reject cancellation.
- [ ] BE-080 — Cancellation status validation.

---

# 10. PHASE 7 — FRONTEND DEVELOPMENT

Tujuan: Mengimplementasikan desain menjadi halaman website yang berfungsi.

Gunakan `design-system.md` sebagai sumber utama.

## 10.1 Frontend Foundation

- [ ] FE-001 — Menyiapkan asset management.
- [ ] FE-002 — Menyiapkan global CSS.
- [ ] FE-003 — Menyiapkan typography.
- [ ] FE-004 — Menyiapkan color tokens.
- [ ] FE-005 — Menyiapkan spacing tokens.
- [ ] FE-006 — Menyiapkan reusable components.
- [ ] FE-007 — Menyiapkan responsive utilities.

## 10.2 Shared Components

- [ ] FE-008 — Navbar.
- [ ] FE-009 — Footer.
- [ ] FE-010 — Product card.
- [ ] FE-011 — Category card.
- [ ] FE-012 — Primary and secondary buttons.
- [ ] FE-013 — Input fields.
- [ ] FE-014 — Select components.
- [ ] FE-015 — Upload component.
- [ ] FE-016 — Status badges.
- [ ] FE-017 — Modal.
- [ ] FE-018 — Alert and notification.

## 10.3 Customer Interface

- [ ] FE-019 — Homepage.
- [ ] FE-020 — Product catalog.
- [ ] FE-021 — Product detail.
- [ ] FE-022 — Catalog order form.
- [ ] FE-023 — Custom bouquet form.
- [ ] FE-024 — Reference image upload interface.
- [ ] FE-025 — Order summary.
- [ ] FE-026 — Payment information.
- [ ] FE-027 — Order confirmation.
- [ ] FE-028 — About page.
- [ ] FE-029 — Contact page.

## 10.4 Admin Interface

- [ ] FE-030 — Admin login.
- [ ] FE-031 — Admin layout.
- [ ] FE-032 — Sidebar.
- [ ] FE-033 — Header.
- [ ] FE-034 — Dashboard.
- [ ] FE-035 — Product management.
- [ ] FE-036 — Add/Edit product form.
- [ ] FE-037 — Category management.
- [ ] FE-038 — Order management.
- [ ] FE-039 — Order detail.
- [ ] FE-040 — Custom request management.
- [ ] FE-041 — Custom request detail.
- [ ] FE-042 — Custom price form.
- [ ] FE-043 — Payment management.
- [ ] FE-044 — Payment detail.
- [ ] FE-045 — Order status management.
- [ ] FE-046 — Cancellation management.
- [ ] FE-047 — Admin settings jika termasuk ruang lingkup final.

## 10.5 Responsive Interface

- [ ] FE-048 — Desktop responsiveness.
- [ ] FE-049 — Tablet responsiveness.
- [ ] FE-050 — Mobile responsiveness.
- [ ] FE-051 — Responsive tables.
- [ ] FE-052 — Mobile navigation.
- [ ] FE-053 — Responsive admin sidebar.

---

# 11. PHASE 8 — INTEGRATION

Tujuan: Menghubungkan frontend, backend, dan database.

## 11.1 Customer Integration

- [ ] INT-001 — Connect homepage to product data.
- [ ] INT-002 — Connect catalog to database.
- [ ] INT-003 — Connect product detail to database.
- [ ] INT-004 — Connect catalog order form to backend.
- [ ] INT-005 — Connect custom form to backend.
- [ ] INT-006 — Connect image upload.
- [ ] INT-007 — Connect order summary.
- [ ] INT-008 — Connect order confirmation.

## 11.2 Admin Integration

- [ ] INT-009 — Connect admin login.
- [ ] INT-010 — Connect dashboard statistics.
- [ ] INT-011 — Connect product management.
- [ ] INT-012 — Connect category management.
- [ ] INT-013 — Connect order management.
- [ ] INT-014 — Connect custom request management.
- [ ] INT-015 — Connect custom price management.
- [ ] INT-016 — Connect payment management.
- [ ] INT-017 — Connect order status management.
- [ ] INT-018 — Connect cancellation management.

## 11.3 Integration Validation

- [ ] INT-019 — Validate database persistence.
- [ ] INT-020 — Validate frontend/backend communication.
- [ ] INT-021 — Validate order relationships.
- [ ] INT-022 — Validate file storage.
- [ ] INT-023 — Validate business workflows.

---

# 12. PHASE 9 — SECURITY AND QUALITY ASSURANCE

Tujuan: Memastikan aplikasi aman dan berfungsi sesuai kebutuhan.

## 12.1 Security

- [ ] SEC-001 — Admin authentication validation.
- [ ] SEC-002 — Protected route validation.
- [ ] SEC-003 — Authorization validation.
- [ ] SEC-004 — Password hashing validation.
- [ ] SEC-005 — CSRF protection validation.
- [ ] SEC-006 — Input validation.
- [ ] SEC-007 — SQL injection prevention review.
- [ ] SEC-008 — XSS prevention review.
- [ ] SEC-009 — File upload security.
- [ ] SEC-010 — Sensitive data protection.
- [ ] SEC-011 — Environment configuration review.

## 12.2 Functional Testing

- [ ] QA-001 — Homepage testing.
- [ ] QA-002 — Product catalog testing.
- [ ] QA-003 — Product detail testing.
- [ ] QA-004 — Catalog ordering testing.
- [ ] QA-005 — Custom bouquet testing.
- [ ] QA-006 — Image upload testing.
- [ ] QA-007 — Custom price workflow testing.
- [ ] QA-008 — Payment testing.
- [ ] QA-009 — Manual payment verification testing.
- [ ] QA-010 — Order status testing.
- [ ] QA-011 — Cancellation testing.
- [ ] QA-012 — Admin authentication testing.
- [ ] QA-013 — Product management testing.
- [ ] QA-014 — Category management testing.
- [ ] QA-015 — Dashboard testing.

## 12.3 Technical Testing

- [ ] QA-016 — Unit testing.
- [ ] QA-017 — Feature testing.
- [ ] QA-018 — Integration testing.
- [ ] QA-019 — Database integrity testing.
- [ ] QA-020 — File validation testing.
- [ ] QA-021 — Error handling testing.

## 12.4 UI/UX Testing

- [ ] QA-022 — Color consistency review.
- [ ] QA-023 — Typography consistency review.
- [ ] QA-024 — Component consistency review.
- [ ] QA-025 — Responsive testing.
- [ ] QA-026 — Navigation testing.
- [ ] QA-027 — Form usability testing.
- [ ] QA-028 — Empty state testing.
- [ ] QA-029 — Loading state testing.
- [ ] QA-030 — Error state testing.
- [ ] QA-031 — Success state testing.

## 12.5 User Acceptance Testing

- [ ] QA-032 — Customer workflow validation.
- [ ] QA-033 — Admin workflow validation.
- [ ] QA-034 — Sponsor review.
- [ ] QA-035 — Bug recording.
- [ ] QA-036 — Bug fixing.
- [ ] QA-037 — Final acceptance.

---

# 13. PHASE 10 — DEPLOYMENT AND FINALIZATION

Tujuan: Menyelesaikan dan menyerahkan sistem.

## 13.1 Deployment Preparation

- [ ] DEP-001 — Menentukan hosting.
- [ ] DEP-002 — Menentukan domain.
- [ ] DEP-003 — Menyiapkan production environment.
- [ ] DEP-004 — Mengonfigurasi environment variables.
- [ ] DEP-005 — Mengonfigurasi database production.
- [ ] DEP-006 — Menyiapkan file storage.
- [ ] DEP-007 — Menyiapkan HTTPS.
- [ ] DEP-008 — Menyiapkan database backup.

Hosting dan domain tetap menunggu persetujuan jika belum ditentukan.

## 13.2 Deployment

- [ ] DEP-009 — Deploy Laravel application.
- [ ] DEP-010 — Run production migrations.
- [ ] DEP-011 — Create admin account securely.
- [ ] DEP-012 — Verify database connection.
- [ ] DEP-013 — Verify file upload.
- [ ] DEP-014 — Verify public pages.
- [ ] DEP-015 — Verify admin pages.
- [ ] DEP-016 — Verify production security settings.

## 13.3 Documentation and Handover

- [ ] FIN-001 — Finalize requirement.md.
- [ ] FIN-002 — Finalize prd.md.
- [ ] FIN-003 — Finalize architecture.md.
- [ ] FIN-004 — Finalize design-system.md.
- [ ] FIN-005 — Finalize database-design.md.
- [ ] FIN-006 — Finalize user-flow.md.
- [ ] FIN-007 — Create installation guide.
- [ ] FIN-008 — Create user guide.
- [ ] FIN-009 — Create admin guide.
- [ ] FIN-010 — Create testing report.
- [ ] FIN-011 — Create final project report.
- [ ] FIN-012 — Prepare project handover.
- [ ] FIN-013 — Final sponsor approval.

---

# 14. CROSS-PHASE QUALITY GATES

Setiap fase harus memiliki quality gate.

Jangan melanjutkan pekerjaan yang bergantung pada fase sebelumnya apabila quality gate belum terpenuhi.

## Gate 1 — Requirements Approved

Syarat:
- Requirement telah diperiksa.
- Business rules telah jelas.
- Ruang lingkup telah disepakati.
- Open questions sudah diidentifikasi.

## Gate 2 — Design Approved

Syarat:
- Architecture telah diperiksa.
- ERD telah disetujui.
- User flow telah divalidasi.
- Design system telah ditetapkan.
- Wireframe dan mockup telah diperiksa.

## Gate 3 — Development Ready

Syarat:
- Laravel siap digunakan.
- Database siap.
- Struktur aplikasi siap.
- Komponen frontend siap.
- Routing telah dirancang.

## Gate 4 — Integration Complete

Syarat:
- Frontend dan backend terhubung.
- Database menyimpan data dengan benar.
- Seluruh alur utama dapat dijalankan.
- Error handling tersedia.

## Gate 5 — Testing Approved

Syarat:
- Functional tests selesai.
- Security checks selesai.
- Responsive testing selesai.
- Critical bugs diperbaiki.
- UAT selesai.

## Gate 6 — Project Completed

Syarat:
- Deployment selesai jika termasuk deliverable proyek.
- Dokumentasi lengkap.
- Handover selesai.
- Sponsor memberikan persetujuan.

---

# 15. TEAM ASSIGNMENT

Gunakan pembagian tugas berikut sebagai tanggung jawab utama.

## Jayanti Firdasari

Project Manager & System Analyst.

Fokus pekerjaan:
- Project planning.
- Requirement validation.
- Product documentation.
- Business process analysis.
- Use case.
- Activity diagram.
- Sequence diagram.
- Project monitoring.
- Coordination.
- UAT coordination.
- Final project documentation.

## Riya Monika

UI/UX Designer & Frontend Developer.

Fokus pekerjaan:
- Design system.
- User flow visual.
- Wireframe.
- High-fidelity mockup.
- Prototype.
- Customer interface.
- Admin interface.
- Responsive design.
- Frontend integration.
- UI/UX testing.

## Elsa Futri

Backend Developer & Database Administrator.

Fokus pekerjaan:
- Architecture.
- Database design.
- ERD.
- Laravel setup.
- Migrations.
- Models.
- Controllers.
- Services.
- Authentication.
- Backend modules.
- Database integration.
- Security.
- Backend testing.

## Shared Responsibilities

Ketiga anggota bertanggung jawab bersama untuk:

- Requirement review.
- Design review.
- Integration review.
- Bug fixing.
- Functional testing.
- User acceptance testing.
- Final project review.

Satu task dapat memiliki satu penanggung jawab utama dan anggota pendukung.

---

# 16. PROJECT TIMELINE

Gunakan periode proyek:

13 Oktober–30 November 2026.

Susun timeline yang realistis berdasarkan dependensi.

Kelompokkan menjadi:

1. Project initiation and requirements.
2. System analysis and design.
3. UI/UX design.
4. Database and backend foundation.
5. Backend and frontend development.
6. Integration.
7. Testing.
8. Deployment and finalization.

Untuk setiap task, tambahkan:

- Planned Start.
- Planned End.
- Estimated Duration.
- Actual Start.
- Actual End.

Jangan mengarang tanggal aktual.

Jika jadwal rinci belum tersedia, buat usulan jadwal dan beri label `[PROPOSED SCHEDULE]`.

Identifikasi pekerjaan yang dapat dilakukan paralel.

Pastikan tidak ada task penting yang ditempatkan setelah batas akhir proyek tanpa persetujuan.

---

# 17. TASK DEPENDENCY AND CRITICAL PATH

Buat dependency map.

Contoh:

Requirements Approval
→ Architecture
→ Database Design
→ Migrations
→ Models
→ Backend Modules
→ Integration
→ Testing
→ Deployment.

Secara paralel:

Requirements Approval
→ Design System
→ Wireframe
→ Mockup
→ Frontend Development
→ Integration.

Jelaskan:
- Critical dependencies.
- Tasks that can run in parallel.
- Blocking tasks.
- Potential bottlenecks.
- Critical path.

Gunakan Mermaid flowchart untuk menggambarkan dependency utama.

---

# 18. PROGRESS TRACKING

Sediakan bagian untuk mencatat:

- Total tasks.
- Completed tasks.
- In-progress tasks.
- Not-started tasks.
- Blocked tasks.
- Cancelled tasks.
- Progress percentage.
- Phase completion.

Gunakan rumus:

Progress = (Completed Tasks / Total Active Tasks) × 100%.

Jangan menghitung Cancelled Tasks sebagai task aktif.

Jika status task belum diperbarui, tandai progres sebagai belum terverifikasi.

Sediakan tabel progress per fase dan per anggota.

---

# 19. DEFINITION OF DONE

Sebuah task hanya dapat dianggap selesai jika:

1. Deliverable telah dibuat.
2. Hasil sesuai requirement.
3. Acceptance criteria terpenuhi.
4. Tidak ada error kritis yang belum diselesaikan.
5. Sudah diperiksa oleh penanggung jawab.
6. Dokumentasi diperbarui jika diperlukan.
7. Perubahan kode telah disimpan dan diintegrasikan.
8. Task status diperbarui.

Untuk task coding:
- Kode dapat dijalankan.
- Validasi berjalan.
- Tidak melanggar business rules.
- Tidak merusak fitur lain.
- Pengujian terkait dilakukan.

Untuk task desain:
- Sesuai design system.
- Sudah diperiksa pada ukuran layar relevan.
- Komponen konsisten.
- Sudah mendapatkan review.

---

# 20. AI EXECUTION PROTOCOL

Dokumen task.md akan digunakan sebagai panduan AI coding assistant.

Karena itu, tambahkan aturan berikut:

## Before Starting a Task

AI wajib:

1. Membaca task yang akan dikerjakan.
2. Membaca requirement terkait.
3. Membaca PRD terkait.
4. Membaca architecture terkait.
5. Membaca design system jika task menyangkut UI.
6. Memeriksa dependency.
7. Memeriksa file proyek yang sudah tersedia.
8. Memahami implementasi yang sudah ada.
9. Menghindari perubahan yang tidak berkaitan.

## While Executing a Task

AI wajib:

1. Fokus pada satu task utama.
2. Tidak melewati dependency.
3. Mengikuti coding conventions.
4. Menggunakan kembali komponen yang tersedia.
5. Tidak membuat duplikasi fungsi.
6. Tidak mengubah business rules tanpa persetujuan.
7. Menjaga konsistensi UI.
8. Memeriksa dampak perubahan terhadap fitur lain.
9. Menjelaskan file yang dibuat atau diubah.

## After Completing a Task

AI wajib:

1. Memeriksa hasil implementasi.
2. Menjalankan test terkait jika tersedia.
3. Melaporkan hasil pengujian.
4. Menyebutkan file yang dibuat atau diubah.
5. Mencatat kendala.
6. Memperbarui status task hanya jika benar-benar selesai.
7. Mencatat dependency yang belum terpenuhi.
8. Menyarankan task berikutnya berdasarkan dependency.

AI tidak boleh mengklaim task selesai apabila belum diuji atau deliverable belum tersedia.

## Task Selection Rule

Jika pengguna meminta AI melanjutkan proyek:

1. Baca `task.md`.
2. Identifikasi task yang belum selesai.
3. Periksa task yang dependency-nya sudah terpenuhi.
4. Pilih task prioritas tertinggi yang siap dikerjakan.
5. Jika beberapa task dapat dikerjakan secara paralel, jelaskan pilihan yang paling tepat.
6. Jangan mengulang task yang sudah selesai tanpa alasan.
7. Jangan melewati task yang masih terblokir.

---

# 21. FINAL DOCUMENT STRUCTURE

Susun `task.md` dengan struktur:

1. Project Information.
2. Project Objectives.
3. Source of Truth.
4. Task Management Rules.
5. Project Phases.
6. Project Initiation and Documentation.
7. System Analysis and Design.
8. UI/UX Design.
9. Database Design and Implementation.
10. Laravel Project Foundation.
11. Backend Development.
12. Frontend Development.
13. Integration.
14. Security and Quality Assurance.
15. Deployment.
16. Documentation and Handover.
17. Quality Gates.
18. Team Assignment.
19. Project Timeline.
20. Task Dependencies.
21. Progress Tracking.
22. Definition of Done.
23. AI Execution Protocol.
24. Risk and Blocker Log.
25. Change Log.

Setiap task harus memiliki ID unik dan tidak boleh digunakan ulang.

---

# 22. FINAL VALIDATION

Sebelum menyelesaikan dokumen, periksa:

- Apakah semua fase proyek tercakup?
- Apakah seluruh kebutuhan di requirement.md memiliki task implementasi?
- Apakah seluruh fitur di PRD memiliki task?
- Apakah seluruh modul architecture memiliki task?
- Apakah semua halaman di design system memiliki task desain dan implementasi?
- Apakah seluruh entitas database memiliki task?
- Apakah semua alur bisnis memiliki task pengujian?
- Apakah pembagian tugas tim jelas?
- Apakah dependency sudah diidentifikasi?
- Apakah quality gates tersedia?
- Apakah acceptance criteria dapat diperiksa?
- Apakah timeline sesuai Project Charter?
- Apakah dokumentasi dan handover sudah dimasukkan?
- Apakah AI dapat menggunakan task.md untuk melanjutkan pekerjaan?

Lakukan cross-check dengan dokumen sumber.

Jangan menghilangkan fitur atau pekerjaan penting.

---

# 23. FINAL OUTPUT

Buat satu file Markdown lengkap:

`task.md`

Ketentuan:

- Format Markdown valid.
- Task memiliki ID unik.
- Task dapat dilacak.
- Task memiliki penanggung jawab.
- Task memiliki prioritas.
- Task memiliki dependency.
- Task memiliki deliverable.
- Task memiliki acceptance criteria.
- Memiliki checklist yang dapat diperbarui.
- Memiliki timeline dan progress tracking.
- Memiliki pembagian tugas tim.
- Memiliki AI execution protocol.

Dokumen harus dapat digunakan oleh Project Manager, System Analyst, UI/UX Designer, Backend Developer, Frontend Developer, dan AI coding assistant.

Jangan membuat task list yang terlalu umum.

Pecah pekerjaan hingga dapat langsung dikerjakan dan diperiksa.

**Tujuan akhir: `task.md` harus mencakup seluruh pekerjaan yang diperlukan untuk menyelesaikan BLOOMÉ dari awal hingga akhir tanpa melewatkan analisis, desain, coding, integrasi, pengujian, deployment, dan dokumentasi.**