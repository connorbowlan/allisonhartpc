# Copilot Instructions for `allisonhartpc`

## Build, test, and lint commands

This repository is a small PHP website without a package manager, build pipeline, or automated test suite.

Use these commands for local validation:

```powershell
# Run the site locally (document root is current-code/)
php -S localhost:8000 -t current-code

# Lint all PHP files
Get-ChildItem current-code -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }

# Lint a single file (single-test equivalent)
php -l current-code\contact.php
```

## High-level architecture

- The deployed web root is `current-code/`; repository root is mainly a container for that site.
- The site is a flat, page-oriented PHP app with one file per route:
  - `index.php`, `profile.php`, `practice.php`, `contact.php`.
- Shared fragments are included from `current-code\static\`:
  - `meta.php` (SEO metadata, favicon tags, Font Awesome kit, viewport),
  - `analytics.php` (Google Analytics script),
  - `footer.php` (footer columns/links),
  - `styles.css` (global layout/typography/responsive behavior).
- `contact.php` contains both rendering and form handling in the same file:
  - self-posting form (`action="contact.php"`),
  - inline sanitization helper functions,
  - CAPTCHA validation via `include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php'`,
  - email dispatch via `mail(...)`.
- Static assets are served from:
  - `current-code\images\` (including `images\favicons\`),
  - `current-code\attached\` (PDFs),
  - plus crawl metadata files (`robots.txt`, `sitemap.xml`).

## Key conventions in this codebase

- Keep page URLs and internal links as explicit `.php` routes (see `sitemap.xml` and nav links).
- Preserve the shared include pattern in page `<head>` and footer:
  - `<?php include "static/analytics.php" ?>`,
  - `<?php include "static/meta.php" ?>`,
  - `<?php include "static/footer.php" ?>`.
- Header/nav markup is duplicated per page, and the active nav state is set manually with `id="active"` on the current page link.
- Layout is driven by `.columns` and `.column-1/.column-2/.column-3` from `static/styles.css`; follow these classes when adding or restructuring content blocks.
- Contact-form status messaging relies on CSS classes `p.error` and `p.success`; keep those class names if changing form behavior.
- `.htaccess` contains cPanel-managed PHP handler settings for `ea-php82`; keep that managed block intact.
