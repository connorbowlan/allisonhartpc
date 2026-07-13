// @ts-check
import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

// https://astro.build/config
export default defineConfig({
  site: 'https://connorbowlan.github.io',
  base: '/allisonhartpc',
  server: {
    port: 3000,
  },
  integrations: [sitemap()],
});
