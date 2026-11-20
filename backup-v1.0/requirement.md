# REQUIREMENT.md
# BLOOMÉ — Flowers & Stories
## Software Requirements Specification (SRS)

**Nama Proyek:** Perancangan Sistem Informasi Pemesanan dan Personalisasi Buket Bunga Berbasis Web  
**Nama Sistem:** BLOOMÉ — Flowers & Stories  
**Jenis Sistem:** Web-Based Bouquet Ordering and Customization Information System  
**Project Sponsor:** Nabila Febriyani  
**Lokasi Usaha:** Jalan Cipto Mangunkusumo, Simpang Tiga, Loa Janan Ilir, Kota Samarinda  
**Metodologi Pengembangan:** Waterfall  
**Backend Framework:** Laravel  
**Backend Language:** PHP  
**Frontend:** HTML, CSS, JavaScript  
**Database:** MySQL  
**Dokumen:** Software Requirements Specification  
**Status:** Development Requirement Baseline  
**Versi:** 1.0

---

# 1. PROJECT OVERVIEW

## 1.1 Project Description

BLOOMÉ — Flowers & Stories merupakan sistem informasi pemesanan dan personalisasi buket bunga berbasis web yang dirancang untuk membantu proses operasional usaha buket bunga.

Sistem ini dikembangkan untuk mengatasi permasalahan pemesanan yang sebelumnya dilakukan secara manual melalui WhatsApp, termasuk pengelolaan katalog produk, pencatatan pesanan, permintaan buket custom, penentuan harga, pembayaran, dan pengelolaan status pesanan.

Website menyediakan dua jenis layanan utama:

1. **Catalog Ordering:** Pelanggan dapat melihat katalog dan melakukan pemesanan produk buket yang tersedia.
2. **Custom Bouquet Ordering:** Pelanggan dapat mengajukan pembuatan buket berdasarkan spesifikasi, pilihan bahan, warna, desain, dan gambar referensi.

Admin memiliki akses khusus untuk mengelola seluruh aktivitas operasional melalui dashboard admin.

Sistem dikembangkan menggunakan Laravel dan MySQL dengan pendekatan Three-Layer Architecture.

## 1.2 Project Objectives

Tujuan pengembangan sistem:

1. Menyediakan katalog produk berbasis web.
2. Mempermudah pelanggan melakukan pemesanan produk.
3. Menyediakan layanan pengajuan buket custom.
4. Mempermudah admin meninjau permintaan custom dan menentukan harga.
5. Mengintegrasikan pencatatan pesanan.
6. Mengelola informasi pembayaran secara terstruktur.
7. Mempermudah pengelolaan status pesanan.
8. Mengurangi ketergantungan terhadap pencatatan manual melalui WhatsApp.
9. Menyediakan antarmuka yang mudah digunakan dan responsif.
10. Membantu pemilik usaha mengelola informasi produk dan transaksi secara lebih terorganisasi.

## 1.3 Project Scope

### In Scope

Fitur yang termasuk dalam pengembangan:

- Public homepage.
- Product catalog.
- Product detail.
- Product category management.
- Catalog ordering.
- Custom bouquet request.
- Customer information form.
- Reference image upload.
- Custom price determination by admin.
- Customer price approval process.
- Order management.
- Payment information management.
- Manual payment confirmation.
- Order status management.
- Cancellation request management.
- Admin authentication.
- Admin dashboard.

### Out of Scope

Fitur yang tidak termasuk dalam ruang lingkup pengembangan awal:

- Customer registration.
- Customer login.
- Customer account dashboard.
- Customer self-service order tracking.
- Automated payment gateway integration.
- Automated WhatsApp notifications.
- Automated price calculation for custom bouquets.
- Advanced courier management.
- Automated delivery tracking.
- Multi-admin role management.
- Inventory management beyond the agreed product availability information.
- Automated financial accounting system.

Fitur tambahan di luar daftar tersebut tidak boleh dikembangkan tanpa persetujuan pemilik proyek.

---

# 2. SYSTEM USERS AND ACTORS

Sistem memiliki dua aktor utama.

## 2.1 Customer

Pelanggan merupakan pengguna publik yang mengakses website tanpa perlu membuat akun.

Customer permissions:

- Access homepage.
- Browse product catalog.
- Browse product categories.
- View product details.
- Submit catalog orders.
- Submit custom bouquet requests.
- Fill in personal information.
- Upload reference images.
- View order summary.
- Receive custom price information through the admin communication process.
- Approve or reject custom pricing.
- Make payments.
- Submit payment information.
- Request order cancellation through the admin.
- Request changes to custom specifications through the admin.

Customer restrictions:

- Cannot access admin dashboard.
- Cannot access product management.
- Cannot manage categories.
- Cannot directly modify admin-managed order status.
- Cannot directly modify submitted custom specifications.
- Cannot access other customers' private order information.
- Does not have a customer account or login session.

## 2.2 Admin

Admin merupakan pemilik usaha yang mengelola website melalui satu akun admin.

Admin permissions:

- Login to admin dashboard.
- View dashboard statistics.
- Manage product categories.
- Manage products.
- View customer orders.
- View order details.
- Review custom bouquet requests.
- View uploaded reference images.
- Determine custom prices.
- Manage payment information.
- Verify payments manually.
- Update order statuses.
- Review cancellation requests.
- Approve or reject cancellation requests.
- View customer information related to orders.
- View order history.

Admin restrictions:

- Only one admin account is used in the initial system.
- Admin-only pages must be protected by authentication.
- Public users must not access administrative functions.

---

# 3. FUNCTIONAL REQUIREMENTS

All functional requirements must be implemented according to the following specifications.

## 3.1 Public Website

### FR-001 — Homepage

The system must provide a public homepage containing:

- Brand identity BLOOMÉ.
- Main navigation.
- Hero section.
- Business introduction.
- Featured products.
- Product categories.
- Service highlights.
- Custom bouquet promotion.
- Contact information.
- Footer.

### FR-002 — Product Catalog

The system must display products in a catalog.

Each product card should display:

- Product image.
- Product name.
- Product price.
- Product category.
- Availability information.
- Product detail action.

The catalog must support category-based browsing.

### FR-003 — Product Detail

The system must provide a detail page for each product.

Product information includes:

- Product name.
- Product images.
- Product description.
- Product price.
- Category.
- Availability.
- Order button.

### FR-004 — Product Category Display

The system must display available product categories.

Initial category examples:

- Buket Bunga.
- Buket Uang.
- Buket Snack.
- Buket Boneka.

Categories must be manageable by admin.

### FR-005 — Customer Order Form

The system must provide an order form for catalog products.

The form must collect the customer information and order details required to process an order.

Initial information requirements:

- Customer name.
- WhatsApp number.
- Selected product.
- Quantity.
- Additional notes when necessary.

The customer must not be required to register or log in.

### FR-006 — Customer Information

The system must collect customer identity and contact information when an order is submitted.

Customer information must be associated with the relevant order.

### FR-007 — Custom Bouquet Page

The system must provide a dedicated page for custom bouquet requests.

The page must explain the customization service and provide a form for customers to describe their desired bouquet.

### FR-008 — Custom Bouquet Specifications

The custom form must support the following information:

- Material preference.
- Color preference.
- Design preference.
- Additional specifications.
- Additional notes.
- Reference image upload.

The form must allow customers to describe their requirements clearly.

### FR-009 — Reference Image Upload

The system must support customer reference image uploads.

Allowed file formats:

- JPG.
- JPEG.
- PNG.

Maximum file size:

- 5 MB per file.

The system must validate file type and file size before accepting an upload.

The maximum number of uploaded images per order has not yet been determined and must remain configurable or subject to confirmation.

### FR-010 — Custom Request Submission

The system must save submitted custom requests and make them available in the admin dashboard.

Each custom request must be associated with customer information and its order record.

### FR-011 — Order Summary

The system must provide an order summary before or after order submission, depending on the implemented ordering flow.

The summary should contain:

- Customer information.
- Order type.
- Product or custom specifications.
- Quantity when applicable.
- Additional notes.
- Price information when available.

The system must not display an invented custom price before admin determination.

### FR-012 — Custom Price Approval

The admin determines custom bouquet prices based on customer specifications.

The price must be communicated to the customer.

The customer must have the ability to:

- Approve the proposed price.
- Reject the proposed price.

If the customer rejects the price, the request may be revised through admin communication or cancelled.

The system must record the customer's decision when supported by the implemented communication workflow.

### FR-013 — Payment Information

The system must support the following payment methods:

1. Bank transfer.
2. E-wallet.

Payment instructions must be provided based on the method and payment conditions determined by the admin.

### FR-014 — Payment Submission

The system must support the recording of payment information associated with an order.

The precise payment proof submission workflow must be confirmed with the project sponsor before implementation.

If payment proof upload is implemented, it must have appropriate file validation and secure storage.

### FR-015 — Manual Payment Verification

The admin must be able to review payment information and manually confirm whether payment has been received.

No automatic payment gateway verification is required.

### FR-016 — Order Cancellation Request

The system must support cancellation requests.

Customers may request cancellation before the order is processed.

The cancellation request must be reviewed by admin.

The admin must be able to:

- Approve cancellation.
- Reject cancellation.

If approved, the order status must become Dibatalkan.

If rejected, the previous valid order status must remain unchanged.

### FR-017 — Custom Change Request

Customers cannot directly edit an already submitted custom request.

Changes must be communicated through the admin.

The admin reviews the requested changes and manages the revised specifications.

### FR-018 — Order Confirmation

The system must provide confirmation after a valid order submission.

The confirmation page should display:

- Confirmation message.
- Order reference or order code, if generated.
- Basic order information.
- Information that the order will be reviewed by admin.
- Contact information.

### FR-019 — Contact Information

The public website must provide business contact information.

The exact phone number, social media links, and business contact details must be supplied by the project sponsor.

---

# 4. ADMIN FUNCTIONAL REQUIREMENTS

## 4.1 Admin Authentication

### FR-020 — Admin Login

The system must provide an admin login page.

Login requirements:

- Username or email.
- Password.
- Login button.
- Validation for invalid credentials.

Admin authentication must use Laravel's supported authentication and security mechanisms.

### FR-021 — Admin Logout

The system must provide a logout function.

The admin session must be terminated securely after logout.

## 4.2 Admin Dashboard

### FR-022 — Dashboard Overview

The dashboard must display an overview of business activities.

Dashboard information may include:

- Total orders.
- Total sales based on recorded transactions.
- Active products.
- Total customers recorded in the system.
- Order statistics.
- Recent orders.
- Best-selling products.
- Pending custom requests.
- Payments awaiting confirmation.

Statistics must be calculated from actual stored database records.

Do not hardcode demonstration statistics in the production system.

If there is no data, display a proper empty state.

## 4.3 Product Management

### FR-023 — Product List

Admin can view all registered products.

The product list must provide:

- Product image.
- Product name.
- Category.
- Price.
- Availability.
- Actions.

### FR-024 — Add Product

Admin can create a new product.

Product information may include:

- Product name.
- Category.
- Description.
- Price.
- Product image.
- Availability.

### FR-025 — Edit Product

Admin can modify existing product information.

### FR-026 — Delete Product

Admin can delete a product after confirmation.

The system should protect historical order records from accidental loss when a product is deleted.

### FR-027 — Product Availability

Admin can manage product availability information.

Availability must be reflected in the public catalog.

## 4.4 Category Management

### FR-028 — Category List

Admin can view all categories.

### FR-029 — Add Category

Admin can add new categories.

### FR-030 — Edit Category

Admin can update category information.

### FR-031 — Delete Category

Admin can delete categories subject to product relationship validation.

## 4.5 Order Management

### FR-032 — Order List

Admin can view all submitted orders.

The order list should display:

- Order code.
- Customer name.
- Order type.
- Order date.
- Total price when available.
- Order status.
- Action to view details.

### FR-033 — Order Detail

Admin can view detailed order information.

Order details should include:

- Customer information.
- Order items.
- Quantity.
- Product information.
- Custom specifications when applicable.
- Price information.
- Payment information.
- Order status.

### FR-034 — Order Status Management

Admin can update order statuses according to the defined workflow.

### FR-035 — Order History

Admin can view historical orders and their recorded status information.

## 4.6 Custom Request Management

### FR-036 — Custom Request List

Admin can view all custom bouquet requests.

### FR-037 — Custom Request Detail

Admin can view:

- Customer information.
- Material preference.
- Color preference.
- Design preference.
- Additional notes.
- Uploaded reference images.

### FR-038 — Custom Price Determination

Admin can enter a proposed price for a custom request.

The system must associate the proposed price with the relevant order or custom request.

### FR-039 — Custom Request Revision

Admin can manage customer requests for changes to submitted custom specifications.

### FR-040 — Custom Request Decision

Admin can manage the custom order process based on the customer's approval or rejection of the proposed price.

## 4.7 Payment Management

### FR-041 — Payment List

Admin can view payment records associated with orders.

### FR-042 — Payment Detail

Admin can inspect payment information.

### FR-043 — Manual Payment Confirmation

Admin can confirm payment after manual verification.

### FR-044 — Payment Status

The system must record the payment verification status.

## 4.8 Cancellation Management

### FR-045 — Cancellation Request List

Admin can view submitted cancellation requests.

### FR-046 — Cancellation Review

Admin can inspect the relevant order and cancellation reason.

### FR-047 — Cancellation Decision

Admin can approve or reject cancellation requests.

The system must update the order status according to the decision.

---

# 5. ORDER STATUS REQUIREMENTS

The system must use the following eight order statuses.

| Code | Status | Description |
|---|---|---|
| ST-01 | Menunggu Peninjauan Admin | A new order has been received and awaits admin review. |
| ST-02 | Menunggu Persetujuan Harga | A custom price has been proposed and awaits customer approval. |
| ST-03 | Menunggu Pembayaran | The order has been approved and awaits payment. |
| ST-04 | Menunggu Konfirmasi Pembayaran | Payment information has been submitted and awaits admin verification. |
| ST-05 | Pembayaran Dikonfirmasi | Admin has verified the payment. |
| ST-06 | Sedang Dibuat | The bouquet is being prepared. |
| ST-07 | Selesai | The order has been completed. |
| ST-08 | Dibatalkan | The order has been cancelled following an approved cancellation request or applicable cancellation decision. |

## 5.1 Status Workflow

### Catalog Order

Menunggu Peninjauan Admin  
→ Menunggu Pembayaran  
→ Menunggu Konfirmasi Pembayaran  
→ Pembayaran Dikonfirmasi  
→ Sedang Dibuat  
→ Selesai.

### Custom Order

Menunggu Peninjauan Admin  
→ Menunggu Persetujuan Harga  
→ Menunggu Pembayaran  
→ Menunggu Konfirmasi Pembayaran  
→ Pembayaran Dikonfirmasi  
→ Sedang Dibuat  
→ Selesai.

If the proposed custom price is rejected, the request must be handled through admin communication for revision or cancellation.

### Cancellation

A customer submits a cancellation request.

Admin reviews the request.

- If approved: status becomes Dibatalkan.
- If rejected: previous valid status remains.

Status transitions must be validated by the application layer.

The system must not allow arbitrary status changes that violate business rules.

---

# 6. BUSINESS RULES

The following business rules are mandatory.

| Code | Business Rule |
|---|---|
| BR-001 | Customers are not required to register or log in. |
| BR-002 | Only one admin account is used in the initial system. |
| BR-003 | Every order must be associated with customer identity and contact information. |
| BR-004 | Products are organized into admin-managed categories. |
| BR-005 | Catalog prices are managed by admin. |
| BR-006 | Custom prices are determined manually by admin. |
| BR-007 | Custom orders require customer approval of the proposed price before proceeding to payment. |
| BR-008 | Rejected custom prices may be revised through admin communication or cancelled. |
| BR-009 | Customers must contact admin to request custom specification changes. |
| BR-010 | Supported payment methods are bank transfer and e-wallet. |
| BR-011 | Payment confirmation is performed manually by admin. |
| BR-012 | Payment conditions may vary according to order type and are determined by admin. |
| BR-013 | Customers may request cancellation before an order is processed. |
| BR-014 | Cancellation requires admin approval. |
| BR-015 | Order statuses are updated by admin according to the order process. |
| BR-016 | Order progress information is communicated by admin. |
| BR-017 | Reference images must use JPG, JPEG, or PNG format. |
| BR-018 | Each uploaded reference image must not exceed 5 MB. |
| BR-019 | Customers cannot directly access administrative functions. |
| BR-020 | Historical order information must remain protected when product records are changed or removed. |

---

# 7. NON-FUNCTIONAL REQUIREMENTS

## 7.1 Usability

- The interface must be easy to understand.
- Navigation must be consistent.
- Forms must provide clear labels.
- Error messages must be understandable.
- Important actions must be clearly identifiable.

## 7.2 Responsiveness

The website must support:

- Desktop.
- Tablet.
- Mobile.

The layout must adapt to different screen sizes.

## 7.3 Performance

- Pages should load efficiently.
- Database queries should be optimized.
- Images should be appropriately optimized.
- Large images should not unnecessarily slow down the website.

Specific response-time targets must be established during testing if required.

## 7.4 Security

- Admin pages must require authentication.
- Passwords must be securely hashed.
- Inputs must be validated.
- Unauthorized access must be prevented.
- File uploads must be validated.
- Database operations must use secure Laravel mechanisms.
- CSRF protection must be enabled for applicable forms.
- Sensitive configuration must not be exposed in public files.

## 7.5 Authorization

Only authenticated admin users may access admin management functions.

Public customers must only access permitted public features.

## 7.6 Data Integrity

- Orders must be associated with valid customer records.
- Order details must reference valid products where applicable.
- Payments must be associated with valid orders.
- Custom requests must be associated with relevant orders.
- Status changes must preserve valid workflow rules.

## 7.7 Reliability

The system must save valid submitted data and handle application errors appropriately.

## 7.8 Maintainability

The application must use an organized Laravel project structure.

Code should be modular, readable, and maintainable.

## 7.9 Backup

The database must have a backup procedure to reduce the risk of data loss.

The backup schedule must be agreed upon before production operation.

## 7.10 Compatibility

The website should work on modern browsers, including Google Chrome, Microsoft Edge, and Mozilla Firefox.

## 7.11 File Security

Uploaded images must:

- Use permitted file formats.
- Respect the 5 MB file size limit.
- Be validated on the server.
- Be stored securely.
- Not be executed as server-side code.

---

# 8. USER INTERFACE REQUIREMENTS

## 8.1 Brand Identity

The website uses the brand:

**BLOOMÉ — Flowers & Stories**

Visual identity:

Elegant Floral Boutique.

Design characteristics:

- Elegant.
- Modern.
- Minimalist.
- Soft feminine.
- Premium.
- Floral aesthetic.
- Clean and spacious.

The uploaded admin dashboard reference image is the primary visual reference.

## 8.2 Locked Color Palette

The following palette must be used consistently across all pages.

| Token | Hex | Usage |
|---|---|---|
| Primary Pink | #E99AAF | Primary buttons and active elements |
| Primary Hover | #D98296 | Button hover |
| Soft Pink | #F6DDE3 | Secondary backgrounds |
| Blush Background | #FFF5F6 | Page backgrounds |
| Warm White | #FFFCFB | Cards and surfaces |
| Burgundy | #642D36 | Headings and important text |
| Primary Text | #493335 | Main body text |
| Secondary Text | #898080 | Supporting text |
| Muted Text | #B09A9C | Muted information |
| Sage Green | #A8B5A0 | Supporting floral accents |
| Border | #F0E1E4 | Card and input borders |
| Success | #6EAD70 | Success states |
| Warning | #E8B85B | Warning states |
| Danger | #D96B75 | Error and danger states |
| Information | #9B83B9 | Informational states |

Do not introduce a different dominant color on individual pages.

## 8.3 Typography

Use:

- Playfair Display for selected headings and brand presentation.
- Poppins for body text and interface elements.

Maintain consistent typography hierarchy.

## 8.4 Border Radius

Use these fixed values:

| Component | Radius |
|---|---|
| Large Card | 18 px |
| Medium Card | 16 px |
| Small Card | 12 px |
| Input Field | 10 px |
| Button | 12 px |
| Badge | Full rounded |
| Modal | 18 px |
| Sidebar Active Menu | 12 px |
| Product Image | 14 px |

## 8.5 Shadow and Border

- Use soft shadows.
- Avoid heavy black shadows.
- Use thin blush borders.
- Maintain consistent card padding.
- Maintain consistent spacing.

## 8.6 Floral Illustration Style

Use one consistent floral illustration style:

- Soft watercolor flowers.
- Pink floral elements.
- Sage green leaves.
- Delicate botanical line art.
- Pastel shading.

Illustrations must remain decorative and must not obstruct important content.

## 8.7 Shared Components

Create reusable UI components for:

- Navbar.
- Footer.
- Admin sidebar.
- Admin header.
- Buttons.
- Inputs.
- Select fields.
- Textareas.
- Upload components.
- Cards.
- Product cards.
- Category cards.
- Tables.
- Status badges.
- Modals.
- Alerts.
- Pagination.
- Breadcrumbs.

Do not create visually different versions of the same component without a functional reason.

---

# 9. PAGE REQUIREMENTS

## 9.1 Customer Pages

### PAGE-C01 — Homepage

Must contain:

- Brand logo.
- Navigation.
- Hero section.
- Featured products.
- Product categories.
- Custom bouquet promotion.
- Business introduction.
- Service highlights.
- Contact section.
- Footer.

### PAGE-C02 — Product Catalog

Must contain:

- Page title.
- Category navigation.
- Product cards.
- Product image.
- Product name.
- Price.
- Availability.
- Detail action.

### PAGE-C03 — Product Detail

Must contain:

- Product gallery.
- Product name.
- Product price.
- Description.
- Category.
- Availability.
- Order action.

### PAGE-C04 — Catalog Order Form

Must contain:

- Customer name.
- WhatsApp number.
- Selected product.
- Quantity.
- Additional notes.
- Submit action.

### PAGE-C05 — Custom Bouquet

Must contain:

- Custom service description.
- Material preference.
- Color preference.
- Design preference.
- Additional specifications.
- Reference image upload.
- Customer identity.
- Submit action.

### PAGE-C06 — Order Summary

Must contain:

- Customer information.
- Order type.
- Product or custom specifications.
- Quantity when applicable.
- Price when available.
- Order notes.

### PAGE-C07 — Payment Information

Must contain:

- Payment method.
- Bank transfer information when applicable.
- E-wallet information when applicable.
- Payment instructions.
- Amount due when determined.

### PAGE-C08 — Order Confirmation

Must contain:

- Submission confirmation.
- Order code if generated.
- Order information.
- Admin review information.
- Contact information.

### PAGE-C09 — About

Must contain available business profile and service information.

### PAGE-C10 — Contact

Must contain verified business contact information.

Do not invent phone numbers, social media URLs, or business details.

## 9.2 Admin Pages

All admin pages must share the same sidebar, header, color palette, typography, component design, and spacing rules.

### PAGE-A01 — Admin Login

Must contain:

- Brand logo.
- Username or email input.
- Password input.
- Login button.
- Validation feedback.

### PAGE-A02 — Dashboard

Must contain:

- Sidebar.
- Header.
- Admin profile.
- Notification area if implemented.
- Total orders.
- Total sales based on recorded data.
- Active products.
- Recorded customers.
- Order statistics.
- Recent orders.
- Best-selling products.
- Pending custom requests.
- Payments awaiting confirmation.

### PAGE-A03 — Order Management

Must contain:

- Order table.
- Order code.
- Customer.
- Order type.
- Date.
- Price when available.
- Status.
- Detail action.
- Search and filters where relevant.

### PAGE-A04 — Order Detail

Must contain:

- Customer information.
- Order items.
- Custom specifications if applicable.
- Price.
- Payment details.
- Status.
- Cancellation information if applicable.

### PAGE-A05 — Product Management

Must contain:

- Product list.
- Product image.
- Name.
- Category.
- Price.
- Availability.
- Add action.
- Edit action.
- Delete action.

### PAGE-A06 — Add/Edit Product

Must contain:

- Product name.
- Category.
- Price.
- Description.
- Image upload.
- Availability.
- Save action.

### PAGE-A07 — Category Management

Must contain:

- Category list.
- Category name.
- Add action.
- Edit action.
- Delete action.

### PAGE-A08 — Custom Requests

Must contain:

- Request list.
- Customer.
- Custom specifications.
- Reference images.
- Review action.

### PAGE-A09 — Custom Request Detail

Must contain:

- Customer information.
- Material.
- Color.
- Design.
- Reference images.
- Additional notes.
- Price input.
- Price communication action.

### PAGE-A10 — Payment Management

Must contain:

- Payment list.
- Order code.
- Customer.
- Method.
- Amount.
- Payment information.
- Verification status.
- Manual confirmation action.

### PAGE-A11 — Payment Detail

Must contain:

- Related order.
- Payment method.
- Amount.
- Submitted payment information.
- Proof of payment if available.
- Verification action.

### PAGE-A12 — Order Status Management

Must contain:

- Current order status.
- Available valid next statuses.
- Update action.
- Status history.

### PAGE-A13 — Cancellation Management

Must contain:

- Cancellation request list.
- Order details.
- Cancellation reason.
- Approve action.
- Reject action.

### PAGE-A14 — Admin Settings

Must contain only settings that are within the approved project scope.

---

# 10. INITIAL DATABASE REQUIREMENTS

The following entities are an initial database proposal.

The final schema must be validated through ERD before implementation.

## 10.1 admins

Purpose: Store administrator authentication information.

Initial attributes:

- id.
- name.
- email or username.
- password.
- timestamps.

## 10.2 categories

Purpose: Store product categories.

Initial attributes:

- id.
- name.
- description.
- timestamps.

## 10.3 products

Purpose: Store bouquet product information.

Initial attributes:

- id.
- category_id.
- name.
- description.
- price.
- image.
- availability.
- timestamps.

## 10.4 customers

Purpose: Store customer information.

Initial attributes:

- id.
- name.
- whatsapp_number.
- timestamps.

## 10.5 orders

Purpose: Store main order information.

Initial attributes:

- id.
- order_code.
- customer_id.
- order_type.
- order_date.
- total_price.
- order_status.
- notes.
- timestamps.

## 10.6 order_details

Purpose: Store product details associated with an order.

Initial attributes:

- id.
- order_id.
- product_id.
- quantity.
- unit_price.
- subtotal.
- timestamps.

## 10.7 custom_requests

Purpose: Store custom bouquet specifications.

Initial attributes:

- id.
- order_id.
- material_preference.
- color_preference.
- design_preference.
- additional_specifications.
- proposed_price.
- customer_decision.
- timestamps.

## 10.8 custom_references

Purpose: Store uploaded reference image metadata.

Initial attributes:

- id.
- custom_request_id.
- file_path.
- original_filename.
- file_type.
- file_size.
- timestamps.

## 10.9 payments

Purpose: Store payment information.

Initial attributes:

- id.
- order_id.
- payment_method.
- amount.
- payment_information.
- payment_proof_path if implemented.
- verification_status.
- verified_at.
- timestamps.

## 10.10 order_status_histories

Purpose: Record order status changes.

Initial attributes:

- id.
- order_id.
- previous_status.
- new_status.
- changed_by.
- notes.
- created_at.

Database rules:

1. Use primary keys.
2. Define foreign key relationships.
3. Use appropriate data types.
4. Preserve order history.
5. Avoid duplicate records.
6. Use transactions for critical operations.
7. Protect historical data.
8. Use Laravel migrations.
9. Validate database relationships before implementation.

The proposed attributes are not final. Additional fields may be required after the ERD and business rules are reviewed.

---

# 11. SYSTEM ARCHITECTURE

Use Three-Layer Architecture.

## 11.1 Presentation Layer

Responsible for:

- Public website.
- Customer forms.
- Product catalog.
- Admin dashboard.
- User interface.
- Responsive components.

## 11.2 Application Layer

Responsible for:

- Authentication.
- Authorization.
- Product management.
- Category management.
- Order processing.
- Custom request processing.
- Custom price determination.
- Payment management.
- Order status management.
- Cancellation processing.
- Validation and business rules.

## 11.3 Data Layer

Responsible for:

- MySQL database.
- Data persistence.
- Database relationships.
- Query operations.
- Data integrity.
- Backup.

The Laravel application must implement these responsibilities in an organized and maintainable way.

---

# 12. VALIDATION REQUIREMENTS

All forms must have appropriate validation.

## 12.1 Customer Information

- Customer name is required.
- WhatsApp number is required.
- Contact information must follow an appropriate format.
- Required fields must not be empty.

## 12.2 Product Form

- Product name is required.
- Category must exist.
- Price must be valid and non-negative.
- Image format must be validated.
- Availability must use an approved value.

## 12.3 Custom Form

- Required specifications must be validated.
- Image formats must be JPG, JPEG, or PNG.
- Each image must not exceed 5 MB.
- Invalid files must be rejected.
- Additional notes must be safely processed.

## 12.4 Payment

- Payment method must be valid.
- Amount must be valid.
- Payment information must be associated with the correct order.
- Admin confirmation must be recorded.

## 12.5 Admin Login

- Credentials must be validated.
- Invalid login attempts must not expose sensitive information.
- Protected routes must require authentication.

---

# 13. ERROR, EMPTY, LOADING, AND SUCCESS STATES

Every important page and interaction must provide appropriate feedback.

## 13.1 Loading State

Examples:

- Loading product list.
- Loading dashboard statistics.
- Submitting order.
- Saving product.
- Uploading image.

## 13.2 Empty State

Examples:

- No products available.
- No orders found.
- No custom requests.
- No payment records.
- No categories available.

Empty states must provide clear explanations and relevant actions for admin where applicable.

## 13.3 Error State

Examples:

- Invalid form data.
- Invalid login credentials.
- Upload format not supported.
- File exceeds size limit.
- Database operation failure.
- Unauthorized access.

## 13.4 Success State

Examples:

- Order submitted.
- Product saved.
- Category updated.
- Payment confirmed.
- Order status updated.
- Cancellation approved.

---

# 14. SECURITY REQUIREMENTS

Security must be implemented using Laravel's established security features.

Requirements:

1. Password hashing.
2. Admin authentication.
3. Protected admin routes.
4. Server-side validation.
5. CSRF protection.
6. Secure file upload handling.
7. Safe database queries.
8. Authorization checks.
9. Session management.
10. Secure configuration management.
11. Error handling without exposing sensitive information.
12. Regular database backups.

Do not store plain-text passwords.

Do not trust client-side validation alone.

Do not expose private uploaded files or administrative data publicly.

---

# 15. ACCEPTANCE CRITERIA

The system is considered functionally acceptable when the following criteria are satisfied.

## Customer Acceptance

- Customers can access the homepage without login.
- Customers can browse product categories.
- Customers can view product details.
- Customers can submit catalog orders.
- Customers can submit custom requests.
- Customers can upload permitted reference images.
- Customers can provide their contact information.
- Customers can receive order confirmation.
- Customers can receive payment information through the agreed process.

## Admin Acceptance

- Admin can log in securely.
- Admin can access the dashboard.
- Admin can manage categories.
- Admin can manage products.
- Admin can view orders.
- Admin can inspect custom requests.
- Admin can determine custom prices.
- Admin can manage payment records.
- Admin can confirm payments manually.
- Admin can update valid order statuses.
- Admin can review cancellation requests.

## Design Acceptance

- All pages use the same color palette.
- All pages use the same typography system.
- All pages use consistent card and button shapes.
- Admin sidebar and header remain consistent.
- Floral illustrations use one consistent style.
- All pages are responsive.
- Forms and tables remain readable.
- The interface follows the approved BLOOMÉ reference design.

## Technical Acceptance

- Laravel application runs correctly.
- MySQL database is connected.
- Migrations execute successfully.
- Database relationships work correctly.
- Authentication works correctly.
- Form validation works correctly.
- File upload validation works correctly.
- Business rules are enforced.
- Critical operations preserve data integrity.

---

# 16. DEVELOPMENT CONSTRAINTS

1. The initial system must use Laravel, PHP, JavaScript, CSS, and MySQL.
2. The system must follow Three-Layer Architecture.
3. Development follows the Waterfall methodology.
4. Customer login is not included.
5. Only one admin account is included in the initial scope.
6. Payment gateway integration is excluded.
7. WhatsApp automation is excluded.
8. Custom pricing is determined by admin.
9. Payment confirmation is manual.
10. Customer self-service order tracking is excluded.
11. Advanced courier management is excluded.
12. Additional features require approval before implementation.

---

# 17. INFORMATION REQUIRING CONFIRMATION

The following information has not been finalized and must not be invented.

| No. | Item | Status |
|---|---|---|
| 1 | Maximum number of reference images per custom order | Pending confirmation |
| 2 | Whether payment proof upload is mandatory | Pending confirmation |
| 3 | Exact customer information fields | Pending confirmation |
| 4 | Whether one order can contain multiple different products | Pending confirmation |
| 5 | Exact payment conditions for catalog and custom orders | Determined by admin; operational details pending |
| 6 | Bank account details | Pending from business owner |
| 7 | E-wallet account details | Pending from business owner |
| 8 | Exact contact information | Pending from business owner |
| 9 | Delivery and pickup policy | Pending confirmation |
| 10 | Hosting and domain | Pending confirmation |
| 11 | Backup schedule | Pending confirmation |
| 12 | Post-launch support duration and SLA | Follow Project Charter; detailed terms to be confirmed |

Do not silently convert these pending items into approved features or business policies.

---

# 18. DEVELOPMENT PRIORITIES

Use the following implementation order.

## Phase 1 — Foundation

- Laravel project setup.
- Environment configuration.
- MySQL connection.
- Database migrations.
- Base application architecture.
- Authentication setup.

## Phase 2 — Design System and Layout

- Global color tokens.
- Typography.
- Shared components.
- Public layout.
- Admin layout.
- Responsive structure.

## Phase 3 — Admin Master Data

- Category management.
- Product management.
- Product image handling.

## Phase 4 — Customer Website

- Homepage.
- Catalog.
- Product details.
- Catalog ordering.
- Custom bouquet form.
- Reference image upload.
- Order confirmation.

## Phase 5 — Order Processing

- Order management.
- Custom request management.
- Custom price determination.
- Customer decision recording.
- Payment management.
- Manual payment verification.
- Order status management.
- Cancellation management.

## Phase 6 — Testing

- Functional testing.
- Validation testing.
- Authorization testing.
- File upload testing.
- Responsive testing.
- Business workflow testing.
- User Acceptance Testing.

## Phase 7 — Finalization

- Bug fixing.
- Security review.
- Database backup preparation.
- Deployment.
- Documentation.
- User handover.

---

# 19. FINAL DEVELOPMENT INSTRUCTIONS

This document is the primary requirements reference for the BLOOMÉ project.

All design, coding, database, and implementation decisions must follow this document.

Before implementing any feature:

1. Check the related functional requirement.
2. Check the relevant business rules.
3. Check the required user permissions.
4. Check the data requirements.
5. Check the design system.
6. Check the acceptance criteria.

Do not:

- Invent unapproved features.
- Change approved business rules.
- Add customer login.
- Add payment gateway integration.
- Add automated WhatsApp notifications.
- Change the locked color palette.
- Change the approved typography.
- Create inconsistent UI components.
- Use hardcoded production statistics.
- Expose sensitive information.
- Implement features that conflict with the project scope.

If a requirement is ambiguous, identify it and request clarification instead of making an unsupported assumption.

**The final goal is to build a complete, consistent, secure, responsive, and maintainable BLOOMÉ website that follows the approved Project Charter, updated system requirements, and visual design reference.**