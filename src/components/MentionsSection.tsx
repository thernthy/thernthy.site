import React from "react";
import { motion } from "framer-motion";
import { ArrowUpRight, Newspaper } from "lucide-react";
import { ARTICLES, FACEBOOK_POSTS } from "../data/portfolioData";

export function MentionsSection() {
  return (
    <section id="posts" className="space-y-6 scroll-mt-28">
      <div className="space-y-1">
        <h2 className="text-xl font-semibold tracking-tight">Blog Posts</h2>
        <p className="text-sm text-zinc-500">
          Articles and social posts featuring my work and community activity.
        </p>
      </div>

      {/* External articles */}
      <div className="grid grid-cols-1 gap-4">
        {ARTICLES.map((item, idx) => (
          <motion.a
            key={item.url}
            href={item.url}
            target="_blank"
            rel="noopener noreferrer"
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, margin: "-80px" }}
            transition={{ delay: idx * 0.1 }}
            className="group flex items-center justify-between gap-4 p-5 rounded-2xl bg-zinc-50/70 dark:bg-zinc-900/50 border border-zinc-200/80 dark:border-zinc-800/80 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all"
          >
            <div className="flex items-center gap-3 min-w-0">
              <div className="w-8 h-8 shrink-0 rounded-full flex items-center justify-center bg-emerald-500/10 text-emerald-600 dark:text-emerald-400">
                <Newspaper className="w-4 h-4" />
              </div>
              <div className="min-w-0">
                <p className="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                  {item.title}
                </p>
                <p className="text-[11px] text-zinc-500">
                  {item.source} · {item.domain}
                </p>
              </div>
            </div>
            <span className="shrink-0 text-xs font-medium text-zinc-500 group-hover:text-zinc-900 dark:group-hover:text-zinc-100 inline-flex items-center gap-1">
              Read Article
              <ArrowUpRight className="w-3.5 h-3.5" />
            </span>
          </motion.a>
        ))}
      </div>

      {/* Embedded Facebook posts */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 items-start">
        {FACEBOOK_POSTS.map((post, idx) => (
          <motion.div
            key={post.src}
            initial={{ opacity: 0, y: 20 }}
            whileInView={{ opacity: 1, y: 0 }}
            viewport={{ once: true, margin: "-80px" }}
            transition={{ delay: idx * 0.1 }}
            className="rounded-2xl overflow-hidden bg-white border border-zinc-200/80 dark:border-zinc-800/80"
          >
            <iframe
              src={post.src}
              title={post.title}
              width="100%"
              height={post.height}
              style={{ border: "none", overflow: "hidden", maxWidth: 500 }}
              scrolling="no"
              frameBorder={0}
              loading="lazy"
              allowFullScreen
              allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
            />
          </motion.div>
        ))}
      </div>
    </section>
  );
}
