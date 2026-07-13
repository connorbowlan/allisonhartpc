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
- `src/components/SiteHeader.astro` / `SiteFooter.astro`: shared chrome
- `src/pages/*.astro`: route pages (`/`, `/profile`, `/practice`, `/contact`)
- `src/styles/global.css`: migrated styling from legacy site
- `public/images` / `public/attached`: migrated static assets and documents

## Deployment

GitHub Pages deployment is configured in repository root:

- `.github/workflows/deploy-modern-site.yml`

The workflow builds from the repository root and deploys `dist/`.
