export function createBasePath(baseUrl: string) {
  const normalizedBase = baseUrl.replace(/\/?$/, '/');
  return (path: string) => `${normalizedBase}${path.replace(/^\/+/, '')}`;
}
