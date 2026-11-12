import React from "react";
import { motion } from "framer-motion";
import { ArrowUpRight, Newspaper } from "lucide-react";
import { MENTIONS } from "../data/portfolioData";

export function MentionsSection() {
  return (
    <section id="posts" className="space-y-6 scroll-mt-28">
      <div className="space-y-1">
        <h2 className="text-xl font-semibold tracking-tight">
          Featured Mentions & Posts
        </h2>
        <p className="text-sm text-zinc-500">
          Social highlights, community features, and external articles about my work.
        </p>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        {MENTIONS.map((item, idx) => (
          <motion.article
            key={idx}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, margin: "-80px" }}
            transition={{ delay: idx * 0.1 }}
            className="flex flex-col justify-between p-5 rounded-2xl bg-zinc-50/70 dark:bg-zinc-900/50 border border-zinc-200/80 dark:border-zinc-800/80 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all"
          >
            <div className="space-y-4">
              <div className="flex items-center justify-between">
                <div className="flex items-center gap-2.5">
                  <div
                    className={`w-8 h-8 rounded-full flex items-center justify-center ${
                      item.platform === "Facebook"
                        ? "bg-blue-600/10 text-blue-600 dark:text-blue-400"
                        : "bg-emerald-500/10 text-emerald-600 dark:text-emerald-400"
                    }`}
                  >
                    {item.platform === "Facebook" ? (
                      <svg className="w-4 h-4 fill-current" viewBox="0 0 24 24">
                        <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z" />
                      </svg>
                    ) : (
                      <Newspaper className="w-4 h-4" />
                    )}
                  </div>
                  <div>
                    <p className="text-xs font-semibold text-zinc-900 dark:text-zinc-100">
                      {item.title}
                    </p>
                    <p className="text-[11px] text-zinc-500">
                      {item.platform} · {item.date}
                    </p>
                  </div>
                </div>

                <a
                  href={item.url}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="text-xs font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-zinc-100 inline-flex items-center gap-1"
                >
                  View
                  <ArrowUpRight className="w-3.5 h-3.5" />
                </a>
              </div>

              <p className="text-sm text-zinc-600 dark:text-zinc-300 leading-relaxed">
                "{item.excerpt}"
              </p>
            </div>

            <div className="mt-4 pt-3 border-t border-zinc-200/60 dark:border-zinc-800/60 flex items-center justify-between text-xs text-zinc-500">
              <span>{item.domain}</span>
              <span
                className={`px-2 py-0.5 rounded font-medium ${
                  item.platform === "Facebook"
                    ? "bg-blue-500/10 text-blue-600 dark:text-blue-400"
                    : "bg-emerald-500/10 text-emerald-600 dark:text-emerald-400"
                }`}
              >
                {item.badge}
              </span>
            </div>
          </motion.article>
        ))}
      </div>
    </section>
  );
}
