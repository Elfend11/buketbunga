# BLOOMÉ Browser Smoke Test Report

Date: 2026-11-25
Branch: `fix/foundation-repair`

## 1. Application configuration

- Laravel reports version 13.43.0 and PHP 8.5.5.
- `APP_KEY` is present. Its value is intentionally not included in this report.
- `APP_URL` is `http://localhost:8000`.
- Database connection is configured as MySQL at `127.0.0.1:3306`, database `bloome_db`. Credentials are not included.
- TCP connection to `127.0.0.1:3306` failed; Laravel's database check was refused by the target machine.
- `public/build/manifest.json` exists and maps `resources/css/app.css` and `resources/js/app.js` to the generated CSS and JavaScript files.
- The customer layout has an `@vite` directive for both entries. The admin layout has an `@vite` directive for the CSS entry.
- `storage/framework/sessions` is absent. Requests through the web middleware failed while trying to write session files. No directory or configuration was created or changed during this test.

## 2. Laravel server

- **PASS:** `php artisan serve --host=127.0.0.1 --port=8000` started successfully.
- **PASS:** Laravel health endpoint `/up` returned HTTP 200.
- **FAIL:** The server could not render application pages reliably due to unavailable session storage and database connectivity. The server was stopped after testing.

`php artisan about` and `php artisan route:list` both completed. `php artisan about` reported the local environment, debug mode enabled, MySQL database driver, and file-based sessions.

## 3. Routes inspected

The route list contains 55 routes. Routes relevant to this smoke test:

| Page | Route | Handler / middleware |
|---|---|---|
| Home | `GET /` (`home`) | `HomeController@index`, `web` |
| Catalog | `GET /katalog` (`catalog.index`) | `CatalogController@index`, `web` |
| Product detail | `GET /katalog/{slug}` (`catalog.show`) | `CatalogController@show`, `web` |
| Admin login | `GET /admin/login` (`admin.login`) | `Admin\AdminAuthController@showLoginForm`, `web` |
| Admin dashboard | `GET /admin/dashboard` (`admin.dashboard`) | `Admin\AdminDashboardController@index`, `web`, `auth:admin` |
| Health | `GET /up` | Laravel health check |

Route registration confirms these endpoints exist, but does not confirm their application behavior.

## 4. Page test results

| Page | Result | Observation |
|---|---|---|
| Home `/` | **FAIL / blocked** | Browser returned HTTP 500. Laravel displayed a refused MySQL connection while querying available products; the request subsequently exceeded PHP's execution time. |
| Catalog `/katalog` | **FAIL / blocked** | Browser returned HTTP 500. Laravel could not write the session file because `storage/framework/sessions` is missing. Catalog data could not be verified. |
| Product detail `/katalog/{slug}` | **NOT TESTED / blocked** | No product slug or database-backed product data was available to select. No synthetic data was created. |
| Admin login `/admin/login` | **FAIL** | Browser returned HTTP 500 while Laravel attempted to write a session file to the missing session directory. |
| Admin dashboard `/admin/dashboard` | **FAIL / blocked** | Browser returned HTTP 500 on the same session-storage failure. The route also requires `auth:admin`; authenticated behavior was not tested. |
| Health `/up` | **PASS** | Returned HTTP 200. |

The static `/tentang-kami` and `/kontak` endpoints also returned HTTP 500 during probing because the web session middleware could not write session files.

## 5. CSS and JavaScript

- **PASS (HTTP asset checks):** `/build/manifest.json` returned HTTP 200, CSS returned HTTP 200 (`text/css`), and JavaScript returned HTTP 200 (`application/javascript`).
- **NOT VERIFIED in rendered pages:** Because application pages failed before rendering their normal layouts, browser loading of CSS/JavaScript through the page's `@vite` tags could not be confirmed.
- No application JavaScript runtime error was observed. The browser did report HTTP 500 errors for failed page requests.
- No asset 404 was observed in direct HTTP checks.

## 6. Errors and warnings

- MySQL on `127.0.0.1:3306` is unavailable; Laravel received a connection-refused error.
- The Laravel session directory `storage/framework/sessions` does not exist, causing HTTP 500 responses for web routes.
- The home request exceeded PHP's 30-second execution limit after its database exception.
- Debug mode is enabled in the local environment. The detailed Laravel error page was visible during testing; production debug settings were not changed.
- Laravel generated 44 untracked compiled Blade files under `storage/framework/views` and one untracked log file under `storage/logs` during the test. These runtime artifacts were left untouched; no cleanup was performed.
- No migrations, seeders, database changes, `.env` changes, source edits, or configuration edits were made.

## 7. Pages blocked by database

The home page demonstrably requires MySQL to query products and cannot be validated until MariaDB is available and the expected database state exists. Catalog and product detail data also remain unverified; the catalog request failed at session handling before its normal response could be observed. No attempt was made to start or initialize MariaDB, create records, or run migrations or seeders.

The admin dashboard's authenticated behavior remains untested. Its request currently fails on session storage, and its route requires admin authentication.

## 8. Recommended next steps

1. With approval, restore the required Laravel writable runtime directories, especially `storage/framework/sessions`, without changing existing data.
2. Start or configure local MariaDB only after separately confirming the intended local database and port. Do not initialize, migrate, or seed it without approval.
3. Once session storage and database availability are resolved, repeat browser tests for home, catalog, and a real existing product detail.
4. Test the admin login flow with approved credentials, then test the dashboard only after successful authentication.
5. Reconfirm rendered-page CSS/JavaScript loading and browser console/network results.

**Overall readiness:** Frontend build artifacts and the Laravel health endpoint are available, but BLOOMÉ's public and admin pages are **not ready for browser validation** until session storage and database connectivity are addressed.
