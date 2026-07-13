# Copilot Instructions for `allisonhartpc`

## Build, test, and lint commands

Primary app validation (Astro app at repository root):

```powershell
# Install deps
npm install

# Run local dev server
npm run dev

# Build static output
npm run build

# Preview production build
npm run preview
```

Legacy reference site validation (`current-code/` only, when needed for parity checks):

```powershell
# Run legacy PHP site
php -S localhost:8000 -t current-code

# Lint all legacy PHP files
Get-ChildItem current-code -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }
```

## High-level architecture

- The active site is an Astro static app rooted at repository root.
- Main app surfaces:
  - `src/layouts/BaseLayout.astro` for shared head/metadata shell
  - `src/components/SiteHeader.astro` for nav + skyline hero
  - `src/components/SiteFooter.astro` for minimal immediate-contact footer row
  - `src/pages/index.astro`, `profile.astro`, `practice.astro`, `contact.astro`
  - `src/styles/global.css` for global styling
- `current-code/` remains as legacy PHP source-of-truth reference (not the deployed app).
- GitHub Pages deploys static `dist/` via `.github/workflows/deploy-modern-site.yml`.

## Contact form constraints and behavior

- Hosting is GitHub Pages (static), so no server-side form handling runs in production.
- Contact form intentionally uses a `mailto:` submission flow that opens the user email client with pre-filled fields.
- Legacy `securimage` CAPTCHA and PHP `mail(...)` backend behavior are not used in Astro.
- If true backend email sending is required later, move deployment to a platform with serverless/functions or add an external API endpoint.

## Key conventions in this codebase

- Keep URLs as explicit page routes (`/`, `/profile`, `/practice`, `/contact`).
- Keep base-path-safe links/assets using existing helpers/patterns (project site path: `/allisonhartpc`).
- Preserve shared layout/component pattern; avoid duplicating shell markup across pages.
- Keep nav structure stable:
  - Main links: Home, Profile, Practice, Contact
  - Utility action: Pay Online (styled as distinct aside action)
- Footer should remain minimal (immediate contact row only: Call, Email, Pay Online).
- Maintain icon consistency with currently supported Font Awesome classes already in use.
