# BLOOMÉ — Flowers & Stories

BLOOMÉ is a Laravel web application for browsing bouquet products and configuring
personalization options. The intended customer journey shows an estimated price
and hands the order details off to the shop through WhatsApp. The website scope
does not include customer accounts, web checkout, a payment gateway, or storing
customer orders.

## Technology

- The lockfile pins Laravel Framework 13.43.0; `composer.json` declares PHP
  `^8.3` (the project baseline uses PHP 8.5.5).
- MySQL is the configured relational database.
- Blade, JavaScript, and Vite are used for the web interface and assets.

## Project documentation

| Document | Purpose |
|---|---|
| [requirement.md](requirement.md) | Software requirements and scope |
| [prd.md](prd.md) | Product requirements |
| [architecture.md](architecture.md) | Three-layer architecture |
| [database-design.md](database-design.md) | Current catalog database design |
| [implementation-plan.md](implementation-plan.md) | Implementation roadmap |
| [task.md](task.md) | Project task tracking |
| [design-system.md](design-system.md) | UI design system |
| [user-flow.md](user-flow.md) | Customer and admin journeys |
| [testing-plan.md](testing-plan.md) | QA strategy |
| [docs/](docs/) | Supporting analysis, design, QA, and operational guides |
| [docs/archive/](docs/archive/README.md) | Historical documentation, not the active specification |

## Scope note

The documented scope and implementation are not yet aligned: `routes/web.php`
still exposes order, payment, cancellation, and tracking flows, backed by
controllers and models from the earlier design. Those files were retained
during this cleanup; removing or reactivating them requires a separate
implementation decision.
