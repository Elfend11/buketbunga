# BLOOMÉ Runtime Prerequisites Report

Date: 2026-11-25
Branch: `fix/foundation-repair`

## 1. Initial condition

- The project was on `fix/foundation-repair`; pre-existing worktree changes were present and preserved.
- PHP 8.5.5, Composer 2.9.7, `vendor`, and `node_modules` were available. `composer check-platform-reqs` passed.
- `.env` had an APP_KEY and configured `APP_URL=http://localhost:8000`, MySQL at `127.0.0.1:3306`, database `bloome_db`, file sessions, and no explicitly set DB charset/collation. No secret values are included here.
- Effective Laravel MySQL charset/collation were `utf8mb4` / `utf8mb4_unicode_ci`.
- MariaDB 10.4.32 was reachable on port 3306, but `bloome_db` did not exist.
- The session directory existed from the earlier runtime check; standard Laravel runtime directories for private/public storage, cache data, and testing were missing.
- All 11 project migrations were reviewed before use. They create project tables; the final migration conditionally renames two product columns. No migration drops or truncates data in its `up()` method.

## 2. Problems found and repairs

- **Missing runtime directories — FIXED:** Created `storage/app/private`, `storage/app/public`, `storage/framework/cache/data`, and `storage/framework/testing`. Existing session, view, log, and `bootstrap/cache` directories were retained.
- **Write access — PASS:** PHP successfully wrote to all eight relevant storage/cache directories. Temporary permission-check files were removed after their checks; no ACL or Windows permissions were changed.
- **Missing database — FIXED:** Read-only inspection confirmed `bloome_db` was absent. Created only that database using the effective application configuration: `utf8mb4` / `utf8mb4_unicode_ci`.
- **Missing schema — FIXED:** The new database had no migration table or application tables. Ran `php artisan migrate`; all 11 reviewed migrations completed in batch 1. No seeder was run.
- **Laravel `db:show` incompatibility — UNRESOLVED:** The command fails on MariaDB 10.4.32 while querying `performance_schema.session_status`, which is not present in this server's `performance_schema`. Laravel database queries themselves succeed, and MariaDB exposes the similarly named table in `information_schema`. No server schema or framework code was modified to work around this.

## 3. Verification after repairs

| Check | Status | Result |
|---|---|---|
| `php artisan about` | **PASS** | Laravel 13.43.0 / PHP 8.5.5, local environment, MySQL and file sessions reported. |
| `php artisan route:list` | **PASS** | 55 routes listed. |
| `php artisan migrate:status` | **PASS** | All 11 migrations reported `Ran`. |
| `php artisan db:show` | **FAIL** | MariaDB compatibility failure querying `performance_schema.session_status`; details above. |
| Laravel DB query | **PASS** | Laravel returned `DATABASE() = bloome_db` and MariaDB version `10.4.32-MariaDB`. |
| Read-only table inspection | **PASS** | `bloome_db` contains `admins`, `categories`, `products`, `product_images`, `personalization_options`, `personalization_values`, `product_personalization_options`, `add_ons`, `product_add_ons`, `business_settings`, and `migrations`. |
| Database charset/collation | **PASS** | `utf8mb4` / `utf8mb4_unicode_ci`. |
| `php artisan view:cache` | **PASS** | Blade templates cached successfully. |
| Composer platform requirements | **PASS** | Required PHP/platform checks pass. |
| Frontend dependency check | **PASS** | Axios 1.21.1, Laravel Vite Plugin 1.3.0, Vite 6.4.6. |
| `git diff --check` | **PASS** | No whitespace errors. |

## 4. HTTP smoke test

Laravel was started at `http://127.0.0.1:8000` after session storage and database connectivity were verified, then stopped after testing.

| Request | Status | Result |
|---|---|---|
| `/up` | **PASS** | HTTP 200. |
| `/` | **PASS** | HTTP 200; empty category/product states rendered. |
| `/katalog` | **PASS** | HTTP 200; empty catalog state rendered. |
| `/admin/login` | **PASS** | HTTP 200; login form rendered. |
| CSS asset | **PASS** | HTTP 200, `text/css`. |
| JavaScript asset | **PASS** | HTTP 200, `application/javascript`. |

Browser smoke tests for home, catalog, and admin login each returned HTTP 200, loaded the compiled CSS/JS, and reported no JavaScript console or page errors. No product detail test was possible because no products exist. After the first admin account was created, the credential-backed local HTTP login flow reached the dashboard route, but the dashboard returned HTTP 500 because the `orders` table is absent. No product data was created.

## 5. Remaining blockers and recommendations

- `php artisan db:show` remains incompatible with this MariaDB version's `performance_schema` layout. Use the successful Laravel `SELECT DATABASE()` check, `migrate:status`, and read-only table inspection as evidence of connectivity; investigate framework/driver compatibility separately before changing server or framework configuration.
- The database schema is initialized but currently has no catalog categories/products. Add approved catalog data through the project’s authorized workflow; no catalog data was seeded.
- Resolve the missing orders/payment schema through the project’s migration design before relying on the authenticated admin dashboard.
- Re-test a product detail after approved catalog data is available.

## 6. Changes and safeguards

- Created four missing Laravel runtime directories and the `bloome_db` database.
- Ran the 11 reviewed migrations during database initialization; no seeder was run at that stage.
- `php artisan view:cache` generated runtime Blade cache.
- A prior PHP session write-check file remains at `storage/framework/sessions/runtime-prerequisite-write-check.txt`; no storage contents were deleted.
- `storage/` remains untracked in Git and includes existing/generated Laravel runtime files. No such files were removed.
- During runtime initialization, no `.env`, source code, dependency, existing database, or pre-existing worktree change was modified. The later admin-account setup added only the two admin credential keys to ignored `.env`; no other `.env` values were changed.
- The single `AdminSeeder` was run later to create the requested initial admin. No other seeder was run. No commit or push was performed.

## 7. First administrator account and login readiness

- Reviewed `AdminSeeder`: it requires `ADMIN_DEFAULT_EMAIL` and `ADMIN_DEFAULT_PASSWORD`, hashes the password with Laravel `Hash::make()`, and uses `updateOrCreate()` scoped to that configured email.
- `.env` is ignored by Git and was not tracked. Only `ADMIN_DEFAULT_EMAIL` and `ADMIN_DEFAULT_PASSWORD` were added/updated. A strong random password was generated locally and stored in `.env`; its value is intentionally not present in this report or command output. The requested weak sample value `123` was not used.
- Ran only `php artisan db:seed --class=AdminSeeder --no-interaction`; no other seeder or migration was run during account creation.
- **PASS:** The `admins` table contains exactly one account: `admin@bloome.local`, named `BLOOMÉ Administrator`.
- **PASS:** Laravel `Hash::check()` verified the stored password, and `Auth::guard('admin')->validate()` accepted the configured credentials. Password and hash were not displayed.
- **PASS:** The login form loaded at `/admin/login` with HTTP 200. A local HTTP login flow accepted the credentials and redirected to `/admin/dashboard`, confirming authentication.
- **FAIL:** The dashboard returned HTTP 500 because the application queries `orders`, but no `orders` table exists in `bloome_db` and no migration for that table is present in the current project migration set. No schema or source-code fix was attempted.
- Browser automation displayed the login form, but the password was not sent through browser tooling to avoid exposing the secret. The credential-backed local HTTP session test was performed instead.
- To retrieve the password privately, open the ignored local `.env` file in an editor and read `ADMIN_DEFAULT_PASSWORD`; do not copy it into chat, Git, or shared logs.

### Remaining login/dashboard work

The admin account and credential validation are ready, but the authenticated dashboard is not usable until the missing orders/payment schema design and migrations are resolved. No additional admin account was created and no other account was modified.
