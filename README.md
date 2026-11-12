# Thy Thern — Portfolio (v2026)

Minimalist dark portfolio for a Network & Security Engineer and full-stack builder.
Built with React, TypeScript, Vite, Tailwind CSS v4, Framer Motion and Lucide icons.

## Screenshots

### Hero
![Hero](docs/screenshots/hero.png)

### Selected Works & About
![Selected Works and About](docs/screenshots/works-about.png)

### Featured Mentions & Career Journey
![Featured Mentions and Journey](docs/screenshots/mentions-journey.png)

### Journey Timeline
![Journey Timeline](docs/screenshots/journey-timeline.png)

## Development

```bash
npm install
npm run dev      # local dev server
npm run build    # production build -> dist/
```

## Deploy

Build the site, then serve `dist/` with the included `docker-compose.yml`
(nginx behind Traefik, domain `thernthy.site`):

```bash
npm run build
docker compose up -d
```
