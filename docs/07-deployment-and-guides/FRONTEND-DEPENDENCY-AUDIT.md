# BLOOMÉ Frontend Dependency Resolution Audit

**Checked:** 2026-11-25  
**Project:** `C:\Users\jayan\Documents\buketbunga\buketbunga`  
**Branch:** `fix/foundation-repair`

This audit initially reviewed the manifest and registry metadata without installing packages. Following approval, an initial lockfile was generated using `npm install --package-lock-only --ignore-scripts`. No package installation into `node_modules`, manifest change, or source-code change was performed.

## 1. Manifest audit

`package.json` declares:

| Name | Manifest range | Section | Role |
|---|---|---|---|
| `vite` | `^5.0.0` | `devDependencies` | Development server and production asset bundler |
| `laravel-vite-plugin` | `^1.0.0` | `devDependencies` | Laravel integration and Blade/Vite manifest support |
| `axios` | `^1.6.4` | `devDependencies` | HTTP client; not imported by the current application JavaScript |

Scripts are `dev: vite` and `build: vite build`. The project currently uses plain CSS and browser `fetch`; no CSS framework, CSS preprocessor, or additional frontend runtime dependency is used. No additional direct package is required by the current Vite inputs.

The existing JavaScript does not use Axios. Its declaration is part of the current manifest and was not removed or otherwise changed during this audit.

## 2. Version and Node.js compatibility

The installed runtime is **Node.js 24.16.0** with **npm 11.13.0**.

Registry metadata was checked without installing packages:

| Package/version examined | Declared Node engine | Compatibility result |
|---|---|---|
| Vite 5.4.21 | `^18.0.0 || >=20.0.0` | Node 24.16.0 satisfies the declared engine |
| Laravel Vite plugin 1.3.0 | `^18.0.0 || ^20.0.0 || >=22.0.0` | Node 24.16.0 satisfies the declared engine |

Laravel Vite plugin 1.3.0 declares peer support for Vite `^5.0.0 || ^6.0.0`; therefore it is compatible with the project's Vite `^5.0.0` range. The ranges in the manifest exclude Vite 6 and Laravel Vite plugin 2, avoiding those major-version upgrades.

The versions above are the highest compatible Vite 5 and plugin 1.x versions observed in registry metadata during this audit. They were initially unpinned; the generated lockfile now records the exact resolutions listed below. Registry metadata and compatibility declarations do not replace an actual install and build test.

## 3. Direct and transitive dependencies

Direct declarations are listed above. The package metadata also shows these dependency edges:

- `laravel-vite-plugin` depends on `picocolors` and `vite-plugin-full-reload`, and has Vite as a peer dependency.
- Vite depends on `rollup`, `esbuild`, and `postcss`.
- Axios 1.21.1 depends on `form-data`, `https-proxy-agent`, `proxy-from-env`, and `follow-redirects`.

npm resolves and installs the transitive dependency tree from package metadata. Exact transitive versions are not declared in `package.json`; they are captured by a lockfile once one is generated. The currently unused Axios declaration still causes Axios and its dependency tree to be installed by a normal npm install.

## 4. Existing installation documentation

The existing [FIN-007 installation guide](./FIN-007-installation-guide.md) documents the generic sequence:

```text
npm install
npm run build
```

It does not pin package versions, explain the missing lockfile, or provide a reproducible installation procedure. No prior frontend lockfile or recorded dependency resolution was found.

## 5. Initial lockfile resolution

The approved command completed successfully:

```powershell
npm install --package-lock-only --ignore-scripts
```

The generated [package-lock.json](../../package-lock.json) uses lockfile version 3 and contains 89 package entries, including the root entry. Its root `devDependencies` exactly match `package.json`; all 88 dependency entries have resolved metadata.

| Direct package | Resolved version | Node engine / peer result |
|---|---:|---|
| `axios` | `1.21.1` | Resolved within `^1.6.4` |
| `laravel-vite-plugin` | `1.3.0` | Node 24 engine permits `>=22`; Vite peer range `^5 || ^6` accepts Vite 5.4.21 |
| `vite` | `5.4.21` | Node engine `^18 || >=20` accepts Node 24.16.0 |

`npm ls --package-lock-only --depth=0` completed successfully without invalid peers or unresolved direct dependencies. npm’s full tree also shows optional peer packages (such as Sass, Less, and `@types/node`) as unmet; they are optional and are not needed by the current plain CSS inputs.

Transitive packages are resolved and recorded in the lockfile. The generated Axios 1.21.1 metadata includes `follow-redirects`, `form-data`, `https-proxy-agent`, and `proxy-from-env`. Laravel Vite plugin includes `picocolors` and `vite-plugin-full-reload`. Vite includes `esbuild`, `postcss`, and `rollup`.

The npm audit found **2 vulnerabilities** in the resolved tree:

| Severity | Package | Finding |
|---|---|---|
| Moderate | `esbuild` (transitive through Vite) | Development server can allow a website to send requests and read responses |
| High | `vite` (direct) | Audit reports Vite advisories affecting versions through `6.4.3`, including a Windows `launch-editor` command execution issue |

The audit output says a fix is available by moving to Vite `8.3.8`, which is outside the manifest’s `^5.0.0` range and is a major-version change. The locked Laravel Vite plugin 1.3.0 peer range only supports Vite 5 and 6, so a Vite 8 upgrade also requires reviewing/upgrading the plugin compatibility. No automatic audit fix was run and no dependency range was changed. Review and approve a compatible toolchain upgrade separately before addressing these findings. npm reported no deprecation notices for the three resolved direct package versions.

## 6. Installation safety and reproducibility

Before this lockfile was generated, `npm install` could technically resolve the manifest without one, and the declared direct packages had compatible Node engine ranges for Node 24.16.0. Such a resolution selects versions satisfying the semver ranges and ordinarily creates a new `package-lock.json`; the result may vary over time, including transitive packages. The generated lockfile now records and stabilizes this initial selection.

**Recommendation:** the initial lockfile has now been generated and reviewed at the package-tree level. Retain the lockfile with the project and use `npm ci` for subsequent clean installs. The reported Vite/esbuild vulnerabilities remain a separate unresolved risk; do not silently override the approved manifest or jump major versions.

## 7. Recommended versions and commands

No manifest edits are recommended for this setup. Retain the declared ranges:

- Vite `^5.0.0` — lockfile resolves `5.4.21`; audit reports a high-severity finding.
- Laravel Vite plugin `^1.0.0` — lockfile resolves `1.3.0`, peer-compatible with Vite 5.
- Axios `^1.6.4` — lockfile resolves `1.21.1`; currently unused, retained as approved.

After approval to install dependencies and build, run from the project root:

```powershell
npm ci
npm run build
```

Then verify that `public/build/manifest.json` was generated and smoke-test both customer and admin layouts so Laravel's `@vite` directives resolve the expected CSS and JavaScript. If the resolution or build has problems, stop and review them rather than changing package ranges automatically.

## 8. Risks and status

- **Vite security findings:** npm reports one high-severity direct Vite finding and one moderate transitive esbuild finding. The suggested Vite fix is outside the current major-version range.
- **Unverified build:** No dependency install or Vite build was run. Compatibility was checked from engine/peer metadata and the lockfile tree.
- **Unused package:** Axios is installed as a direct dev dependency despite not being used in current frontend source.
- **No unsupported dependency additions:** The current CSS and JavaScript do not require Tailwind, Axios usage, or a CSS preprocessor for the configured Vite inputs.

**Lockfile status: GENERATED AND REVIEWED.** The next step, `npm ci` followed by `npm run build`, is waiting for separate approval. Package audit findings should also be reviewed before using the Vite development server.
