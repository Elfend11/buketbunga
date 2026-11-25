# BLOOMÉ NPM Security Advisory Review

**Reviewed:** 2026-11-25  
**Project:** `C:\Users\jayan\Documents\buketbunga\buketbunga`  
**Branch:** `fix/foundation-repair`

This review covers the current `package.json`, `package-lock.json`, and the frontend dependency audit. `npm audit --json` was run against the existing lockfile and exited with code 1 because it found vulnerabilities. No install, audit fix, manifest/lockfile edit, source edit, commit, or push was performed.

## Summary

npm reports **2 vulnerable package entries**, not just 2 individual advisories:

- `esbuild` is a **transitive development dependency** of Vite.
- `vite` is a **direct development dependency**. npm aggregates eight Vite advisories under this one package entry; one is rated high.

The locked versions are Vite **5.4.21**, esbuild **0.21.5**, and `laravel-vite-plugin` **1.3.0**. The project is on Windows. The findings affect development tooling and mostly require the dev server to be running; they do not mean the built production assets alone are vulnerable. Several advisories have additional attack preconditions, noted below.

## Advisory inventory

| Package / current version | Advisory and severity | Affected versions → first fixed | Impact and project relevance |
|---|---|---|---|
| `esbuild` **0.21.5** (transitive via Vite) | [GHSA-67mh-4wv8-2f99](https://github.com/advisories/GHSA-67mh-4wv8-2f99); no CVE; **Moderate** | `<= 0.24.2` → `0.25.0` | Its development server's permissive CORS can let a website send requests and read responses, potentially exposing source. The advisory applies to use of esbuild's serve feature; npm reports it through Vite's dependency tree. |
| `vite` **5.4.21** (direct) | [GHSA-4w7w-66w2-5vf9](https://github.com/advisories/GHSA-4w7w-66w2-5vf9), CVE-2026-39365; **Moderate** | `<= 6.4.1` → `6.4.2` | Path traversal can expose predictable `.map` files when a dev server is network-exposed and a sensitive source map is reachable. |
| `vite` **5.4.21** (direct) | [GHSA-v6wh-96g9-6wx3](https://github.com/advisories/GHSA-v6wh-96g9-6wx3), CVE-2026-53632; **Moderate** | `<= 6.4.2` → `6.4.3` | On Windows, opening a crafted UNC path can trigger NTLM authentication to an attacker-controlled host. Requires the affected editor middleware/server path and an active dev server. Windows makes this platform-specific issue relevant to this laptop. |
| `vite` **5.4.21** (direct) | [GHSA-fx2h-pf6j-xcff](https://github.com/advisories/GHSA-fx2h-pf6j-xcff), CVE-2026-53571; **Moderate** | `<= 6.4.2` → `6.4.3` | On Windows, alternate NTFS/8.3 paths can bypass `server.fs.deny` and expose files. Requires a network-exposed dev server and the specified file/path conditions. |
| `vite` **5.4.21** (direct) | [GHSA-698v-4r3x-3vcv](https://github.com/advisories/GHSA-698v-4r3x-3vcv), CVE-2026-112943; **Moderate** | `<= 6.4.3` → `6.4.4` | `launch-editor` argument escaping on Windows can allow command execution with attacker-controlled filenames/environment or NTFS alternate data stream conditions. |
| `vite` **5.4.21** (direct) | [GHSA-r825-w8mm-5pxw](https://github.com/advisories/GHSA-r825-w8mm-5pxw), CVE-2026-112944; **Moderate** | `<= 6.4.3` → `6.4.4` | Editor CLI flag interpretation can cause command execution or unintended file operations in specific editor, filesystem, or WSL conditions. |
| `vite` **5.4.21** (direct) | [GHSA-587h-7wmj-h5pm](https://github.com/advisories/GHSA-587h-7wmj-h5pm), CVE-2026-112942; **High** | `<= 6.4.3` → `6.4.4` | On Windows, a crafted path can bypass an existence check and, combined with argument handling, reach OS command execution. Requires the dev-server editor path and attacker-controlled request/path conditions. This is the high-severity issue driving npm's Vite rating. |
| `vite` **5.4.21** (direct) | [GHSA-9jrq-w75r-8gcw](https://github.com/advisories/GHSA-9jrq-w75r-8gcw), CVE-2026-112945; **Low** | `<= 6.4.3` → `6.4.4` | Cross-origin script execution in a narrower custom/middleware-mode setup that passes an unchanged request URL to `transformIndexHtml`. The current app uses the Laravel Vite plugin, not this custom middleware setup. |
| `vite` **5.4.21** (direct) | [GHSA-rq7h-c2jc-7f22](https://github.com/advisories/GHSA-rq7h-c2jc-7f22), CVE-2026-112946; **Moderate** | `<= 6.4.3` → `6.4.4` | Under specific non-Windows, network-exposed configurations, project paths can cause files outside `server.fs.allow` to be served. This OS-specific condition does not match the current Windows laptop. |

The full npm audit includes all eight Vite advisories even though the summary groups them under one vulnerable `vite` package entry. Individual advisory severity can differ from the aggregated package severity.

## Dependency tree and patched versions

- `vite@5.4.21` is a direct entry in `devDependencies`.
- `esbuild@0.21.5` is transitive: `vite@5.4.21` declares `esbuild ^0.21.3`.
- The esbuild advisory's first patched version is **0.25.0**. Vite **6.4.6** declares `esbuild ^0.25.0`.
- npm registry metadata lists **5.4.21** as the latest Vite 5 release. The audit advisories include affected Vite ranges through `6.4.3`; there is **no patched Vite 5 release** for the complete reported set.
- The first common fixed Vite version across the Vite advisories is **6.4.4**. The latest Vite 6 patch release confirmed in the registry is **6.4.6**.
- The existing locked `laravel-vite-plugin@1.3.0` peer range is `vite ^5.0.0 || ^6.0.0`. It supports Vite 6.4.6 without a plugin upgrade. Node 24.16.0 satisfies the Vite 6 and plugin engine ranges.

## Remediation comparison

### Minimal practical fix: move to Vite 6.4.6

Change the Vite manifest range from `^5.0.0` to `^6.4.6` in a separately approved repair, regenerate the lockfile, and verify that esbuild resolves to a patched `0.25.x` version. Keep `laravel-vite-plugin@1.3.0` and the existing Vite/Blade architecture. This crosses one Vite major boundary, but avoids the reported Vite ranges and fixes esbuild through Vite's dependency range. Test the production build and dev-server integration after the change.

An esbuild-only override would not fix the high-severity Vite advisories. Conversely, upgrading to Vite 6 naturally selects the patched esbuild range.

### Upgrade to Vite 8

Vite 8.3.8 is npm's suggested `fixAvailable` target for the current manifest because the declared Vite `^5.0.0` range cannot accept a fix. It is not the only patched path: Vite 6.4.6 is also beyond the affected ranges. The current Laravel Vite plugin 1.3.0 does **not** accept Vite 8; registry metadata shows Laravel Vite plugin 3.2.1 as a compatible candidate with peer range `^8.0.0`. This requires major upgrades to both Vite and the plugin and therefore carries more compatibility and regression risk. It is not needed to resolve these advisories while the Vite 6 path remains available.

Neither option changes the frontend architecture: both retain Laravel Blade, Vite, the same CSS/JavaScript inputs, and the same `@vite` directives.

## Recommendation and proposed repair commands

**Recommended:** upgrade Vite to **6.4.6**, retain Laravel Vite plugin **1.3.0**, then regenerate and review the lockfile. Do **not** upgrade to Vite 8 solely because npm's automatic fix suggestion selected it. The exact manifest and lockfile edits require approval; none were made in this review.

After approval, update only the Vite range to `^6.4.6`, then run:

```powershell
npm install --package-lock-only --ignore-scripts
npm ls --package-lock-only --depth=0
npm audit --json
```

Review the changed manifest and lockfile, confirm Vite is 6.4.6 or later within major 6, esbuild is 0.25.x or later within the selected compatible range, plugin peer compatibility is valid, and the reported advisories are cleared. Then, only after approval to install and build:

```powershell
npm ci
npm run build
```

Finally verify `public/build/manifest.json` and smoke-test customer/admin Blade layouts. Do not run automatic `npm audit fix` or `npm audit fix --force`.

## Current status

**No dependency changes were made.** `package.json` and `package-lock.json` remain as approved. No dependencies were installed and no build was run. The security findings remain open pending approval of the Vite 6 remediation.
