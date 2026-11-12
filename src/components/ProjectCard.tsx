import React from "react";
import { motion } from "framer-motion";
import { ArrowUpRight } from "lucide-react";

interface ProjectCardProps {
  title: string;
  description: string;
  tags: string[];
  link: string;
  year: string;
}

export function ProjectCard({
  title,
  description,
  tags,
  link,
  year,
}: ProjectCardProps) {
  return (
    <motion.a
      href={link}
      target="_blank"
      rel="noopener noreferrer"
      initial={{ opacity: 0, y: 24 }}
      whileInView={{ opacity: 1, y: 0 }}
      viewport={{ once: true, margin: "-80px" }}
      whileHover="hover"
      className="group relative block p-6 rounded-2xl bg-white dark:bg-zinc-900/50 border border-zinc-200 dark:border-zinc-800/80 hover:border-zinc-300 dark:hover:border-zinc-700 overflow-hidden transition-colors duration-300"
    >
      <motion.div
        variants={{ initial: { opacity: 0 }, hover: { opacity: 1 } }}
        transition={{ duration: 0.3 }}
        className="absolute inset-x-0 top-0 h-[2px] bg-gradient-to-r from-transparent via-zinc-400 dark:via-zinc-300 to-transparent"
      />

      <div className="flex flex-col justify-between h-full space-y-6">
        <div className="flex items-center justify-between text-xs text-zinc-500 font-mono">
          <span>{year}</span>
          <div className="w-8 h-8 rounded-full bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-zinc-700 dark:text-zinc-300 transition-colors group-hover:bg-zinc-900 group-hover:text-white dark:group-hover:bg-white dark:group-hover:text-zinc-950">
            <motion.div
              variants={{ initial: { x: 0, y: 0 }, hover: { x: 2, y: -2 } }}
              transition={{ type: "spring", stiffness: 400, damping: 25 }}
            >
              <ArrowUpRight className="w-4 h-4" />
            </motion.div>
          </div>
        </div>

        <div className="space-y-2">
          <h3 className="text-lg font-medium tracking-tight group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            {title}
          </h3>
          <p className="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2 leading-relaxed">
            {description}
          </p>
        </div>

        <div className="flex flex-wrap gap-2 pt-2">
          {tags.map((tag) => (
            <span
              key={tag}
              className="px-2.5 py-1 text-xs font-medium rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400"
            >
              {tag}
            </span>
          ))}
        </div>
      </div>
    </motion.a>
  );
}
