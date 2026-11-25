# BLOOMÉ Frontend Integration Audit & Repair

**Checked:** 2026-11-25  
**Branch:** `fix/foundation-repair`  
**Project:** `C:\Users\jayan\Documents\buketbunga\buketbunga`

## Initial findings

- `package.json` already declares Vite `^5.0.0` and `laravel-vite-plugin` `^1.0.0`; its scripts provide `npm run dev` and `npm run build`.
- No frontend lockfile or `node_modules` directory exists. A build cannot be verified reproducibly, so no package installation or lockfile generation was attempted.
- `vite.config.js` already declares `resources/css/app.css` and `resources/js/app.js` as its Vite inputs.
- Before this repair, those resource files were only wrappers that imported `/css/app.css` and `/js/app.js` from `public/`. The public files held the actual BLOOMÉ styling and estimator behavior. This split meant Blade served the public copies directly while the Vite entries pointed back to root-relative public URLs.
- The customer layout loaded CSS and JavaScript with `asset()`. The admin layout loaded CSS with `asset()`. No Blade `@vite` directives were present.
- Google Fonts is the only external frontend resource found. The code uses plain CSS and browser JavaScript; there is no CSS framework or preprocessor dependency. `axios` is declared but not imported or used by the current frontend.
- The product detail estimator markup targets the `catalog.estimate` route, and the JavaScript sends its selected personalization/add-on IDs to that endpoint. The Blade route expression was missing a closing parenthesis.

## Selected architecture

Use **Vite as the sole application asset-loading pipeline**:

1. Keep `resources/css/app.css` and `resources/js/app.js` as the authoritative source and Vite inputs.
2. Load them using Laravel's `@vite` directive in the Blade layouts.
3. Keep the JavaScript only in the customer layout, where the estimator feature is used; the admin layout requests only the shared CSS.
4. Remove the old `public/css/app.css` and `public/js/app.js` copies. They were duplicate application assets, no longer referenced after switching the layouts, and are not Vite source entries.

No package manifest or lockfile was changed. Vite and its Laravel plugin are declared, but dependency availability and lockfile reproducibility remain a blocker for building the assets.

## Files changed

| File | Change |
|---|---|
| `resources/css/app.css` | Replaced the root-relative import stub with the existing BLOOMÉ stylesheet so Vite owns the actual CSS source. Existing styles and design tokens were preserved. |
| `resources/js/app.js` | Replaced the root-relative import stub with the existing customer price-estimator JavaScript. Existing behavior was preserved. |
| `resources/views/layouts/app.blade.php` | Replaced direct CSS/JS URLs with one `@vite` call for the CSS and JavaScript entries. |
| `resources/views/layouts/admin.blade.php` | Replaced the direct CSS URL with `@vite` for the shared CSS entry; admin pages do not load the customer estimator JavaScript. |
| `resources/views/customer/catalog/show.blade.php` | Closed the estimator route expression so Blade can compile the form action. No business logic changed. |
| `config/view.php` | Added the missing Laravel view configuration, including a stable compiled-view path. Without it, Blade compilation failed because `view.compiled` was unset. |
| `public/css/app.css` | Removed the duplicate stylesheet after moving its contents to the Vite CSS source. |
| `public/js/app.js` | Removed the duplicate script after moving its contents to the Vite JavaScript source. |
| `docs/07-deployment-and-guides/FRONTEND-INTEGRATION-REPORT.md` | Added this audit and repair report. |

`package.json`, all lockfile paths, database configuration, migrations, seeders, models, and business logic were left unchanged.

## Integration results

- **Blade layouts:** Customer pages use Vite for CSS and estimator JavaScript. Admin pages use Vite for CSS only.
- **Vite entries:** Blade references match the existing `vite.config.js` input paths.
- **Duplicate loading:** No remaining direct references to the removed public app CSS/JS assets were found. No view both loads the same entry through `@vite` and `asset()`.
- **CSS:** The existing public stylesheet was moved into the Vite CSS source; the visual rules and design tokens were retained.
- **JavaScript:** The existing estimator script was moved into the Vite JavaScript source. Its form selector and payload correspond to the product detail form and named estimate route.
- **Route/controller/service:** `catalog.estimate` remains registered to `CatalogController::estimate`, which validates the submitted IDs and delegates calculation to `PriceEstimatorService`. No feature beyond this existing estimator was assumed to be implemented.
- **Other feature scope:** Some existing admin pages are explicitly marked legacy or outside the active feature scope; their presence is not treated as proof of complete order, payment, custom-request, or cancellation workflows.
- **External resource:** Google Fonts continues to load from Google-hosted URLs in the customer layout.

## Validation

| Check | Result |
|---|---|
| `node --check resources/js/app.js` | **PASS** |
| `php -l config/view.php` | **PASS** |
| `php artisan route:list --except-vendor` | **PASS** — 52 routes; estimator route is present |
| `php artisan view:cache` | **PASS** — all Blade views compiled |
| `php artisan view:clear` | **PASS** — generated compiled views cleared afterward |
| `git diff --check` | **PASS** |
| Asset-reference scan | **PASS** — layouts use `@vite`; no direct app CSS/JS `asset()` references or root-relative source imports remain |
| `npm run build` | **BLOCKED** — Vite is not installed (`vite` command unavailable); `node_modules` and all supported frontend lockfiles are absent |

The manifest and layout wiring are statically consistent, but a successful Vite build and browser-level asset delivery are **not verified**. No `public/build/manifest.json` or Vite development-server marker exists yet.

## Remaining blockers and recommendations

1. Obtain or approve a frontend lockfile before installing packages, then install from that lockfile and run `npm run build`. This audit did not create one or choose package versions.
2. Once built, verify the generated Vite manifest and test both customer and admin layouts in a browser.
3. MariaDB was inactive in the preceding environment check. Database-backed page behavior remains unverified; inspect and approve the local database before any migration or seeder work.
4. `axios` is currently unused, and Tailwind is mentioned in planning text but is not present in the package manifest or current stylesheet implementation. Neither dependency scope nor business features were changed in this repair.

**Readiness:** The Blade/Vite source integration is repaired and Blade templates compile, but the project is **not yet ready for full frontend execution/testing** until frontend dependencies are available and a Vite build is verified. Database-dependent end-to-end testing also remains blocked.
