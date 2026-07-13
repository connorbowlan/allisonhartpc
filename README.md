# Allison Hart website (Astro)

Modern static rebuild of the legacy PHP site from `current-code`, preserving the same style and core content while using reusable components and Astro pages.

## Local development

Run from the repository root:

```sh
npm install
npm run dev
```

Dev server URL: `http://localhost:3000`

## Build and preview

```sh
npm run build
npm run preview
```

## Structure

- `src/layouts/BaseLayout.astro`: shared page shell and SEO/head metadata
- `src/components/SiteHeader.astro`: shared top nav + skyline hero
- `src/components/SiteFooter.astro`: minimal immediate-contact row (Call, Email, Pay Online)
- `src/pages/*.astro`: route pages (`/`, `/profile`, `/practice`, `/contact`)
- `src/styles/global.css`: migrated styling from legacy site
- `public/images` / `public/attached`: migrated static assets and documents
- `current-code/`: legacy PHP source retained for reference and content parity checks

## Deployment

GitHub Pages deployment is configured in repository root:

- `.github/workflows/deploy-modern-site.yml`

The workflow builds from the repository root and deploys `dist/`.

## Contact form behavior

- The Contact page form keeps the legacy field set (`firstName`, `lastName`, `email`, `phone`, `referral`, `county`, `message`).
- Because this site is hosted on GitHub Pages (static hosting), form submission currently uses a `mailto:` flow (opens the user’s email app with pre-filled content).
- CAPTCHA/`securimage` and server-side email sending from the legacy PHP site are intentionally not used in the Astro version.

## Current UX decisions

- Primary nav includes `Home`, `Profile`, `Practice`, `Contact`.
- `Pay Online` is present in nav as a distinct utility action.
- Footer is intentionally minimal and only contains an immediate contact row.
