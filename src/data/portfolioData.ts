export const NAV_ITEMS = [
  { label: "Work", href: "#work", id: "work" },
  { label: "About", href: "#about", id: "about" },
  { label: "Mentions", href: "#posts", id: "posts" },
  { label: "Journey", href: "#journey", id: "journey" },
  { label: "Stack", href: "#stack", id: "stack" },
];

export const PROJECTS = [
  {
    title: "Grab One Platform",
    description:
      "Multi-tenant e-commerce & POS platform featuring Telegram Mini Apps, dynamic custom domains, and real-time WebSocket synchronization.",
    tags: ["Next.js", "Fastify", "TypeScript", "PostgreSQL", "Redis"],
    link: "https://github.com",
    year: "2026",
  },
  {
    title: "SecureEdge Infrastructure",
    description:
      "Enterprise container deployment pipeline with automated Traefik v3 ingress routing, Prometheus metrics, and Grafana telemetry dashboards.",
    tags: ["Docker", "Traefik", "Prometheus", "Grafana"],
    link: "https://github.com",
    year: "2026",
  },
];

export const MENTIONS = [
  {
    platform: "Facebook",
    title: "Tech Community Spotlight",
    date: "Oct 2026",
    excerpt:
      "Highlighting Thy Thern's work on mobile application shielding and enterprise DLP proof-of-concepts—bridging offensive reverse engineering insights with practical defense.",
    url: "https://facebook.com",
    domain: "facebook.com/posts/...",
    badge: "Social Feature",
  },
  {
    platform: "Blog",
    title: "Engineering & Security Blog",
    date: "Sep 2026",
    excerpt:
      "How builders are architecting multi-tenant Telegram Mini Apps and KHQR payment integrations with modern TypeScript and containerized edge infrastructure.",
    url: "https://example.com",
    domain: "techblog.example.com",
    badge: "Press / Blog",
  },
];

export const SECURITY_JOURNEY = [
  {
    vendor: "Netskope",
    role: "SASE & Endpoint DLP",
    category: "Cloud & Data Security",
    summary:
      "Architected and validated enterprise Data Loss Prevention (DLP) policies across GenAI, webmail, and cloud storage channels—benchmarking inline SSL inspection and zero-trust network performance under real traffic loads.",
  },
  {
    vendor: "Promon",
    role: "Mobile App Shielding & RASP",
    category: "Application Protection",
    summary:
      "Delivered runtime application self-protection (RASP) solutions for Android and iOS financial apps, hardening binaries against dynamic instrumentation (Frida), hooking, tampering, and reverse engineering.",
  },
  {
    vendor: "Fastly",
    role: "Edge Cloud & Next-Gen WAF",
    category: "Edge & API Defense",
    summary:
      "Configured edge caching, TLS termination, and Next-Gen WAF rules to protect high-throughput mobile and web API traffic against automated abuse, DDoS, and layer-7 exploits.",
  },
  {
    vendor: "Qualys",
    role: "Vulnerability Management & Posture",
    category: "Risk & Compliance",
    summary:
      "Executed continuous asset discovery, vulnerability scanning, and remediation workflows across hybrid network infrastructure to shrink attack surfaces and maintain compliance.",
  },
];

export const CORE_STACK = [
  "TypeScript",
  "React",
  "Next.js",
  "Fastify",
  "Drizzle ORM",
  "PostgreSQL",
  "Redis",
  "Docker",
  "Traefik",
  "Tailwind CSS",
];
