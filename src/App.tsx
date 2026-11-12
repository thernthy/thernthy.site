import React, { useState, useEffect } from "react";
import { Navbar } from "./components/Navbar";
import { Hero } from "./components/Hero";
import { ProjectCard } from "./components/ProjectCard";
import { MentionsSection } from "./components/MentionsSection";
import { SecurityJourney } from "./components/SecurityJourney";
import { Footer } from "./components/Footer";
import { PROJECTS, CORE_STACK } from "./data/portfolioData";

export default function App() {
  const [darkMode, setDarkMode] = useState(false);

  useEffect(() => {
    const saved = localStorage.getItem("theme");
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    if (saved === "dark" || (!saved && prefersDark)) {
      setDarkMode(true);
      document.documentElement.classList.add("dark");
    }
  }, []);

  const toggleDarkMode = () => {
    const next = !darkMode;
    setDarkMode(next);
    document.documentElement.classList.toggle("dark", next);
    localStorage.setItem("theme", next ? "dark" : "light");
  };

  return (
    <div className="min-h-screen bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 selection:bg-zinc-900 selection:text-white dark:selection:bg-white dark:selection:text-zinc-950">
      <Navbar darkMode={darkMode} toggleDarkMode={toggleDarkMode} />

      <main className="max-w-4xl mx-auto px-6 pt-36 pb-24 space-y-28">
        <Hero />

        {/* Selected Works */}
        <section id="work" className="space-y-8 scroll-mt-28">
          <div className="space-y-1">
            <h2 className="text-xl font-semibold tracking-tight">
              Selected Works
            </h2>
            <p className="text-sm text-zinc-500">
              Full-stack platforms and infrastructure tools built for production.
            </p>
          </div>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            {PROJECTS.map((project, idx) => (
              <ProjectCard key={idx} {...project} />
            ))}
          </div>
        </section>

        {/* About */}
        <section id="about" className="space-y-4 scroll-mt-28">
          <h2 className="text-xl font-semibold tracking-tight">About</h2>
          <p className="text-sm md:text-base text-zinc-600 dark:text-zinc-400 leading-relaxed max-w-2xl">
            Bridging enterprise security engineering with modern web
            architecture. Experienced in mobile app shielding, dynamic
            instrumentation, and building resilient full-stack systems that scale
            reliably.
          </p>
        </section>

        {/* Blog Posts & Social Mentions */}
        <MentionsSection />

        {/* Security Journey */}
        <SecurityJourney />

        {/* Core Stack */}
        <section id="stack" className="space-y-4 scroll-mt-28">
          <h2 className="text-xl font-semibold tracking-tight">Core Stack</h2>
          <div className="flex flex-wrap gap-2">
            {CORE_STACK.map((tech) => (
              <span
                key={tech}
                className="px-3 py-1.5 text-xs font-medium rounded-lg bg-zinc-100 dark:bg-zinc-900 border border-zinc-200/50 dark:border-zinc-800"
              >
                {tech}
              </span>
            ))}
          </div>
        </section>
      </main>

      <Footer />
    </div>
  );
}
