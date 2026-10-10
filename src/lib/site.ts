const DEFAULT_SITE_URL = 'https://allisonhartpc.com';

export function resolveSiteUrl(site: URL | undefined): URL {
  return site ?? new URL(DEFAULT_SITE_URL);
}

