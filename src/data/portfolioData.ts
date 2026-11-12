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

const FB_ID = "61550073096893";

const fbEmbed = (storyFbid: string) =>
  "https://www.facebook.com/plugins/post.php?href=" +
  encodeURIComponent(
    `https://www.facebook.com/permalink.php?story_fbid=${storyFbid}&id=${FB_ID}`
  ) +
  "&show_text=true&width=500";

export const ARTICLES = [
  {
    source: "Kiripost",
    title: "Young People's Digital Talents Promoted at International Youth Day Celebration",
    url: "https://kiripost.com/stories/young-peoples-digital-talents-promoted-at-international-youth-day-celebration",
    domain: "kiripost.com",
    badge: "Press / Blog",
  },
];

export const FACEBOOK_POSTS = [
  {
    title: "Facebook Post 1",
    src: fbEmbed("pfbid02s84PDUNc2hWNsXZN452bd9f8vr3gdncfac255bMhHgAmHh3HRRZVnE4AUvg7UXN3l"),
    height: 773,
  },
  {
    title: "Facebook Post 2",
    src: fbEmbed("pfbid0ewguGc1Nvk5RJPPrLzipYngnWP2RChDE7JBjSXKMWU2Jh11FBYNpTMAqzWeFJuPFl"),
    height: 575,
  },
  {
    title: "Facebook Post 3",
    src: fbEmbed("pfbid0i4kyxdMiAXKizuHFY5kS7Lkk4K8VgPmjkckUww351CdXZgBRYb1oq5JsHx9u944cl"),
    height: 250,
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
