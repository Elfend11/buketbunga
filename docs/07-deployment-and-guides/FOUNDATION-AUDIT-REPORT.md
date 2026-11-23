# BLOOMÉ Foundation Audit Report

Audit date: 2026-11-23
Repository: `C:\Projects\buketbunga`
Scope: static and safe read-only inspection; no application source, route, migration, database, dependency, or configuration changes were made.

## 1. Executive Summary

The current repository is an incomplete Laravel foundation, not a customer-ready application. Laravel 13.43.0 and Composer are correctly installed or reported, routes are registered, and the repository contains substantial model, service, migration, and legacy workflow code. However, the application has no Blade views or frontend source assets under `resources/`, and the product implementation is inconsistent with the product database schema.

The most severe risks are:

- Most routes point to Blade views that do not exist, so customer and admin pages cannot render.
- Product CRUD uses `price` and `image_path`, while migrations and models use `base_price` and `main_image`; product create/update/catalog/order operations are therefore inconsistent or likely to fail.
- The default admin seeder contains a predictable fallback password and could create a publicly guessable administrative credential if environment variables are absent.
- The implemented route surface contains persistent order, payment, cancellation, tracking, and custom-request workflows that are outside the agreed WhatsApp-based foundation scope.

### Priority totals

| Priority | Count |
|---|---:|
| CRITICAL | 3 |
| HIGH | 4 |
| MEDIUM | 3 |
| LOW | 1 |
| **Total** | **11** |

## 2. Project Environment and Technology Stack

| Item | Evidence |
|---|---|
| Laravel | `php artisan --version`: Laravel Framework 13.43.0 |
| PHP requirement | `composer.json`: `^8.3` |
| Framework | Laravel 13.17 constraint in `composer.json` |
| Database | MySQL in project configuration intent and `.env.example` |
| Frontend | Blade, Vite, HTML/CSS/JavaScript declared in the audit scope |
| Composer | `composer validate --no-check-publish`: valid |
| Routes | `php artisan route:list`: 47 routes, all discovered successfully |
| Migration status | Could not connect to MySQL at 127.0.0.1:3306 |
| Automated tests | No test methods; the test runner reported `0` tests |

The actual PHP runtime was not separately established through a dedicated `php --version` command. Runtime database and test behavior could not be verified because MySQL was unavailable.

## 3. Project Structure Audit

The repository follows the Laravel directory convention:

- `app/Http/Controllers` contains public and admin controllers.
- `app/Http/Requests` contains Form Request validation classes.
- `app/Models` contains Eloquent models.
- `app/Services` contains domain and infrastructure-style services.
- `database/migrations` contains current and legacy migrations.
- `routes/web.php` contains the complete web route map.

There is no `resources/views` content and no `resources/css` or `resources/js` content. `public/` contains framework entry files and favicons but no compiled application assets. The framework and route registrations do exist, but the presentation layer is absent.

## 4. Three-Layer Architecture Audit

The implementation contains a controller/request/model/service organization that is broadly consistent with a three-layer direction, but controllers still directly perform database queries and orchestration. Services such as `WhatsAppLinkGeneratorService`, `FileUploadSanitizerService`, `OrderCodeGeneratorService`, and `OrderStatusStateMachineService` demonstrate separation of selected responsibilities.

Architecture assessment:

- Presentation: Blade view structure is absent.
- Application: controllers and Form Requests provide application coordination and validation.
- Domain/data: Eloquent models and services exist, but direct Eloquent database work remains extensive in controllers.

Overall, this is a Laravel MVC/application-service arrangement rather than a complete, consistently implemented three-layer architecture.

## 5. Database and Migration Audit

### 5.1 Current v1.1 tables

The current migration set defines:

| Table | Key evidence |
|---|---|
| `admins` | [admins migration](../../database/migrations/2026_11_13_000001_create_admins_table.php) |
| `categories` | [categories migration](../../database/migrations/2026_11_13_000002_create_categories_table.php) |
| `products` | [products migration](../../database/migrations/2026_11_13_000003_create_products_table.php) |
| `product_images` | [product images migration](../../database/migrations/2026_11_20_000004_create_product_images_table.php) |
| `personalization_options` | [personalization options migration](../../database/migrations/2026_11_20_000005_create_personalization_options_table.php) |
| `personalization_values` | [personalization values migration](../../database/migrations/2026_11_20_000006_create_personalization_values_table.php) |
| `product_personalization_options` | [personalization pivot migration](../../database/migrations/2026_11_20_000007_create_product_personalization_options_table.php) |
| `add_ons` | [add-ons migration](../../database/migrations/2026_11_20_000008_create_add_ons_table.php) |
| `product_add_ons` | [add-ons pivot migration](../../database/migrations/2026_11_20_000009_create_product_add_ons_table.php) |
| `business_settings` | [business settings migration](../../database/migrations/2026_11_20_000010_create_business_settings_table.php) |

The schema includes appropriate primary keys, unique constraints, foreign keys, cascade/restrict behavior, timestamps, and indexes for these core entities.

### 5.2 Legacy v1.0 tables

Legacy migrations remain under `database/migrations/legacy_v1.0/` and define `customers`, `orders`, `order_details`, `custom_requests`, `custom_references`, `payments`, and `order_status_histories`.

These tables are not merely inert documentation:

- Public and admin order/payment/cancellation/tracking controllers reference them.
- Admin dashboard metrics query `orders` and `payments`.
- Public routes create and expose customer order records.
- Models exist for every legacy entity and relationship.

The tables conflict with the agreed scope, which excludes persistent orders, checkout, payment processing, cancellation workflows, customer accounts, and order tracking.

No migration or table was deleted or modified.

## 6. Model and Relationship Audit

Core models and relationships are generally consistent with the migrations:

- `Category::products()` matches `categories.id` to `products.category_id`.
- `Product::images()` matches `product_images.product_id`.
- Both personalization and add-on pivots use correct foreign keys.
- `PersonalizationOption::values()` matches `option_id`.
- `CustomRequest::references()` matches `custom_request_id`.
- Legacy order relationships are implemented in `Order`, `Customer`, `OrderDetail`, `Payment`, and `OrderStatusHistory`.

Mass assignment protection is present in all inspected models through `fillable` arrays. Password casting and hidden fields are defined on `Admin`.

The primary model/controller mismatch is that [Product.php](../../app/Models/Product.php) defines `base_price` and `main_image`, while [AdminProductController.php](../../app/Http/Controllers/Admin/AdminProductController.php) and catalog/order controllers use `price` and `image_path`.

## 7. Authentication and Security Audit

Admin authentication is implemented through a dedicated `admin` guard backed by the `Admin` Eloquent model. [auth.php](../../config/auth.php) defines both the `web` and `admin` guards with the admin provider. Login validation, session regeneration, logout invalidation, token regeneration, and login throttling are present.

Protected admin routes use `auth:admin`. CSRF middleware is provided by Laravel route behavior.

Positive controls:

- `remember` is cast through request boolean handling.
- Passwords use Laravel's hashed cast and `Hash::make`.
- Password changes verify the current password.
- Product and payment uploads use request validation and a UUID-based upload service.
- Login and store routes have throttling.

The principal security concern is the predictable fallback administrative credential in [AdminSeeder.php](../../database/seeders/AdminSeeder.php). It uses `BloomeSamarinda2026!` and `admin@bloome.com` when environment variables are absent.

File upload protection is partially inconsistent: Form Requests allow JPEG/JPG/PNG/WEBP up to 3 MB, while [FileUploadSanitizerService.php](../../app/Services/FileUploadSanitizerService.php) additionally checks MIME and 5 MB limits. The extension is taken from the original filename but replaced by a UUID; a separately verified MIME check and server-side storage remain important.

## 8. Admin Dashboard and CRUD Audit

| Feature | Status | Evidence |
|---|---|---|
| Admin authentication | Implemented and verified through code inspection | [AdminAuthController.php](../../app/Http/Controllers/Admin/AdminAuthController.php), [AdminLoginRequest.php](../../app/Http/Requests/AdminLoginRequest.php), [auth.php](../../config/auth.php) |
| Dashboard | Partially implemented | [AdminDashboardController.php](../../app/Http/Controllers/Admin/AdminDashboardController.php); queries legacy order/payment models and references missing Blade views |
| Category CRUD | Partially implemented | [AdminCategoryController.php](../../app/Http/Controllers/Admin/AdminCategoryController.php); validation and relationship safeguards exist, but view is absent |
| Product CRUD | Partially implemented | [AdminProductController.php](../../app/Http/Controllers/Admin/AdminProductController.php); schema mismatch and missing views prevent verification |
| Product image upload | Present but not sufficiently verified | UUID storage service exists, but product controller uses `image_path` rather than schema field `main_image` |
| Stock/availability | Partially implemented | `toggleStatus` exists in [AdminProductController.php](../../app/Http/Controllers/Admin/AdminProductController.php), but implementation cannot be verified end-to-end |
| Personalization options | Partially implemented | Migrations/models exist; no admin controllers or routes manage options or values |
| Add-ons | Partially implemented | Migrations/models exist; no admin controllers or routes manage add-ons or product assignments |
| Business contact settings | Not implemented | Only admin profile update exists in [AdminSettingController.php](../../app/Http/Controllers/Admin/AdminSettingController.php); settings table/model/seeder are not used by that controller |

## 9. Routing and Business Scope Audit

### Public routes

- `/` — homepage
- `/katalog` and `/katalog/{slug}` — catalog/detail
- `/tentang-kami` — about
- `/kontak` — contact

### Authentication routes

- `/admin/login`
- `/admin/logout`

### Admin routes

Admin routes cover dashboard, product, category, orders, custom requests, payments, cancellations, and settings.

### Out-of-scope/legacy routes

The following route families implement persistent transaction workflows outside the agreed scope:

- `/pesan/{slug}`, `/pesanan/{order_code}`, `/pesanan/{order_code}/batal`
- `/custom-bouquet`
- `/pembayaran/{order_code}`
- `/lacak-pesanan`
- `/admin/pesanan`
- `/admin/custom-requests`
- `/admin/pembayaran`
- `/admin/pembatalan`

The WhatsApp link service exists, but several routes implement direct database checkout, payment proof submission, cancellation, and status tracking instead.

## 10. Frontend and UI Structure Audit

No Blade layouts or Blade views exist in the repository's active `resources/views` directory. No CSS or JavaScript application files exist under `resources/css` or `resources/js`, and `vite.config.js` points to two absent input files:

- `resources/css/app.css`
- `resources/js/app.js`

The documented BLOOMÉ identity values (Playfair Display, Poppins, primary pink, soft pink, blush background, warm white, and burgundy) are not present in an implemented frontend source. Public assets contain no application build output. This means the design cannot currently be visually validated or customer-facing.

## 11. Validation and Testing Results

| Check | Result |
|---|---|
| `php artisan --version` | Laravel Framework 13.43.0 |
| `composer validate --no-check-publish` | Passed |
| `php artisan route:list` | Passed; 47 routes discovered |
| `php artisan migrate:status` | Failed because MySQL at `127.0.0.1:3306` refused the connection |
| `php artisan test` | Passed runner startup; no tests were found |

Static code inspection is the basis of this report. No runtime pages, database records, migrations, uploads, authentication attempts, or customer journeys were executed successfully.

## 12. Findings and Risk Classification

### C-01 - Customer and admin presentation layer is absent

- **Priority:** CRITICAL
- **Description:** The active `resources/` directory contains no Blade views, CSS, or JavaScript source files. Every page route references missing `view(...)` names.
- **Evidence:** [routes/web.php](../../routes/web.php), [vite.config.js](../../vite.config.js); directories `resources/views`, `resources/css`, and `resources/js` contain no application files.
- **Impact:** Customer browsing, catalog detail, personalization, WhatsApp flow, authentication, and admin pages cannot render.
- **Recommended action:** Restore or implement the presentation layer before attempting customer-facing development.

### C-02 - Product column names are inconsistent across migrations, models, requests, and controllers

- **Priority:** CRITICAL
- **Description:** The migration and model use `base_price` and `main_image`, while catalog, order, and admin product code use `price` and `image_path`.
- **Evidence:** [2026_11_13_000003_create_products_table.php](../../database/migrations/2026_11_13_000003_create_products_table.php), [Product.php](../../app/Models/Product.php), [AdminProductController.php](../../app/Http/Controllers/Admin/AdminProductController.php:61), [CatalogController.php](../../app/Http/Controllers/CatalogController.php:31), [OrderController.php](../../app/Http/Controllers/OrderController.php:78).
- **Impact:** Product create/update and price sorting are likely to fail or write nonexistent fields; order totals and catalog prices are not reliably represented.
- **Recommended action:** Align the canonical product schema and every consumer on one pair of field names. Remove `order_details_count` dependency or add the actual relationship count name consistently.

### C-03 - Predictable default administrator credential

- **Priority:** CRITICAL
- **Description:** [AdminSeeder.php](../../database/seeders/AdminSeeder.php) defines fallback default email and password values from environment variables or predictable literals.
- **Evidence:** The previous seeder used predictable fallback values for `ADMIN_DEFAULT_PASSWORD` and `ADMIN_DEFAULT_EMAIL` rather than requiring explicit environment configuration. Exact removed values are intentionally omitted.
- **Impact:** If seeders are used without environment overrides, an attacker may know the administrator credentials.
- **Recommended action:** Require explicit secret configuration and fail seeding rather than using a known fallback password.

### H-01 - Implemented routes materially exceed the agreed WhatsApp scope

- **Priority:** HIGH
- **Description:** Public checkout, custom ticket, payment proof, cancellation, tracking, and admin payment/order workflows are active.
- **Evidence:** [web.php](../../routes/web.php), [OrderController.php](../../app/Http/Controllers/OrderController.php), [PaymentController.php](../../app/Http/Controllers/PaymentController.php), [TrackingController.php](../../app/Http/Controllers/TrackingController.php).
- **Impact:** The foundation contains more persistent customer and transaction behavior than the approved scope and creates privacy, security, and maintenance surface.
- **Recommended action:** Treat these routes as legacy; remove or disable from the foundation plan only after a separate scope decision. Do not delete code or migrations during implementation.

### H-02 - Personalization and add-on management is incomplete

- **Priority:** HIGH
- **Description:** Database, models, and pivots exist, but no admin controllers/routes/views manage personalization options, values, add-ons, or product assignments. Public catalog/detail code does not calculate a selected estimated price.
- **Evidence:** [PersonalizationOption.php](../../app/Models/PersonalizationOption.php), [PersonalizationValue.php](../../app/Models/PersonalizationValue.php), [AddOn.php](../../app/Models/AddOn.php), [routes/web.php](../../routes/web.php), [CatalogController.php](../../app/Http/Controllers/CatalogController.php).
- **Impact:** Core customer personalization and estimated pricing features are not implementable through the current application surfaces.
- **Recommended action:** Implement the missing management, public loading, selection, and server-side price calculation surfaces.

### H-03 - Business contact settings are not wired to the settings UI or WhatsApp service

- **Priority:** HIGH
- **Description:** `business_settings` and `BusinessSettingSeeder` exist, while admin settings only updates the admin name/password. WhatsApp phone selection reads configuration/environment instead of the setting model.
- **Evidence:** [AdminSettingController.php](../../app/Http/Controllers/Admin/AdminSettingController.php), [BusinessSetting.php](../../app/Models/BusinessSetting.php), [WhatsAppLinkGeneratorService.php](../../app/Services/WhatsAppLinkGeneratorService.php:14).
- **Impact:** Business contact data can become inconsistent between the database, environment, UI, and generated WhatsApp links.
- **Recommended action:** Define one setting source of truth and expose approved keys through the admin settings workflow.

### H-04 - Automated verification is effectively absent

- **Priority:** HIGH
- **Description:** The test suite has only a base `TestCase`; `php artisan test` found zero tests.
- **Evidence:** [TestCase.php](../../tests/TestCase.php).
- **Impact:** Authentication, CRUD, relationships, routes, uploads, price calculations, and missing views are not protected against regressions.
- **Recommended action:** Add focused feature tests after the schema and view gaps are corrected.

### M-01 - Three-layer separation is not complete

- **Priority:** MEDIUM
- **Description:** Services exist, but controllers directly perform queries, transactions, state transitions, and file work.
- **Evidence:** [CatalogController.php](../../app/Http/Controllers/CatalogController.php), [OrderController.php](../../app/Http/Controllers/OrderController.php), [CustomBouquetController.php](../../app/Http/Controllers/CustomBouquetController.php).
- **Impact:** Architecture is harder to maintain and test consistently.
- **Recommended action:** Introduce application/domain services or repositories only where the current scope requires business rules to remain reusable.

### M-02 - Product seed data is not included in the primary seeder

- **Priority:** MEDIUM
- **Description:** `ProductSeeder.php` exists, but `DatabaseSeeder.php` does not call it.
- **Evidence:** [ProductSeeder.php](../../database/seeders/ProductSeeder.php), [DatabaseSeeder.php](../../database/seeders/DatabaseSeeder.php).
- **Impact:** A normal database seeding flow does not populate catalog products.
- **Recommended action:** Add product seeding only after category seeding and field-name alignment are verified.

### M-03 - Database migration status and runtime behavior could not be verified

- **Priority:** MEDIUM
- **Description:** MySQL refused connections during `php artisan migrate:status`.
- **Evidence:** `SQLSTATE[HY000] [2002]` using connection `mysql`, host `127.0.0.1`, port `3306`, database `bloome_db`.
- **Impact:** Migration application state and runtime routes/views remain unverified.
- **Recommended action:** Start or provide the approved MySQL environment and rerun read-only migration status and tests.

### L-01 - BLOOMÉ design identity is not implemented in frontend source

- **Priority:** LOW
- **Description:** No CSS or Blade source was found for the defined BLOUMÉ palette or typography.
- **Evidence:** `resources/` contains no application frontend files; `vite.config.js` references absent inputs.
- **Impact:** Visual identity, responsiveness, and reusable UI components cannot be audited or delivered.
- **Recommended action:** Implement the design system after restoring the Blade and asset foundation.

## 13. Overall Foundation Readiness Assessment

**Overall condition:** Not ready for further customer-facing development.

The Laravel framework shell, route registration, models, migrations, and several services are present, but the implementation is not internally consistent enough to support safe feature development:

- Missing presentation files are a blocking CRITICAL issue.
- Product field mismatch is a blocking CRITICAL issue.
- Default credential handling is a blocking security issue.
- Scope boundaries are violated by active legacy transaction routes.
- Personalization, add-ons, settings, and tests are incomplete.

## 14. Recommended Implementation Roadmap

1. Correct and verify the product schema and field names across migration/model/controller/request/seeder code.
2. Remove or replace the predictable admin default credential and verify authentication credentials through environment-based setup.
3. Restore the Blade layout, page views, CSS, JavaScript, and Vite inputs.
4. Define and enforce the final scope boundary for legacy order/payment/cancellation/tracking routes.
5. Implement personalization and add-on admin management and public estimated-price calculation.
6. Wire business contact settings to one database-backed source and the WhatsApp link service.
7. Add focused authentication, catalog, product CRUD, personalization, settings, upload, and route tests.
8. Start MySQL in the development environment and run migration status plus safe tests.
