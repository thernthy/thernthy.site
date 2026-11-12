import React, { useState, useEffect } from "react";
import { motion, useScroll, useTransform } from "framer-motion";
import { Moon, Sun } from "lucide-react";
import { NAV_ITEMS } from "../data/portfolioData";

interface NavbarProps {
  darkMode: boolean;
  toggleDarkMode: () => void;
}

export function Navbar({ darkMode, toggleDarkMode }: NavbarProps) {
  const [activeTab, setActiveTab] = useState("work");
  const { scrollY } = useScroll();

  const height = useTransform(scrollY, [0, 100], ["80px", "62px"]);
  const borderOpacity = useTransform(scrollY, [0, 100], [0, 1]);

  useEffect(() => {
    const sections = NAV_ITEMS.map((item) => document.getElementById(item.id));
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            setActiveTab(entry.target.id);
          }
        });
      },
      { rootMargin: "-35% 0px -55% 0px" }
    );

    sections.forEach((sec) => sec && observer.observe(sec));
    return () => observer.disconnect();
  }, []);

  return (
    <motion.header
      style={{ height }}
      className="fixed top-0 inset-x-0 z-50 flex items-center backdrop-blur-md bg-white/75 dark:bg-zinc-950/75"
    >
      <motion.div
        style={{ opacity: borderOpacity }}
        className="absolute bottom-0 inset-x-0 h-[1px] bg-zinc-200 dark:bg-zinc-800"
      />

      <nav className="relative z-10 max-w-4xl w-full mx-auto px-6 flex items-center justify-between">
        <a
          href="#"
          className="font-semibold tracking-tight text-zinc-900 dark:text-zinc-100"
        >
          Thy Thern.
        </a>

        <div className="hidden md:flex items-center gap-1 p-1 rounded-full bg-zinc-100/80 dark:bg-zinc-900/80 border border-zinc-200/50 dark:border-zinc-800/50">
          {NAV_ITEMS.map((item) => {
            const isActive = activeTab === item.id;
            return (
              <a
                key={item.id}
                href={item.href}
                onClick={() => setActiveTab(item.id)}
                className={`relative px-3.5 py-1.5 text-sm font-medium rounded-full transition-colors ${
                  isActive
                    ? "text-zinc-900 dark:text-zinc-100"
                    : "text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200"
                }`}
              >
                {isActive && (
                  <motion.span
                    layoutId="active-nav-pill"
                    transition={{ type: "spring", stiffness: 380, damping: 30 }}
                    className="absolute inset-0 rounded-full bg-white dark:bg-zinc-800 shadow-xs"
                  />
                )}
                <span className="relative z-10">{item.label}</span>
              </a>
            );
          })}
        </div>

        <div className="flex items-center gap-2.5">
          <button
            onClick={toggleDarkMode}
            aria-label="Toggle theme"
            className="p-2 rounded-full bg-zinc-100 dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-zinc-100 transition-colors cursor-pointer"
          >
            {darkMode ? <Sun className="w-4 h-4" /> : <Moon className="w-4 h-4" />}
          </button>
          <a
            href="#contact"
            className="px-4 py-1.5 text-sm font-medium rounded-full bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 hover:opacity-90 transition-opacity"
          >
            Contact
          </a>
        </div>
      </nav>
    </motion.header>
  );
}
