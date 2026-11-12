import React from "react";
import { motion } from "framer-motion";
import { ArrowUpRight } from "lucide-react";

const containerVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.12, delayChildren: 0.1 },
  },
};

const itemVariants = {
  hidden: { opacity: 0, y: 20 },
  visible: {
    opacity: 1,
    y: 0,
    transition: { type: "spring", stiffness: 280, damping: 24 },
  },
};

export function Hero() {
  return (
    <motion.section
      variants={containerVariants}
      initial="hidden"
      animate="visible"
      className="space-y-8"
    >
      <motion.div variants={itemVariants} className="flex items-center gap-4">
        <motion.img
          whileHover={{ scale: 1.05 }}
          transition={{ type: "spring", stiffness: 400, damping: 25 }}
          src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80"
          alt="Thy Thern"
          className="w-14 h-14 rounded-2xl object-cover border border-zinc-200 dark:border-zinc-800 shadow-xs"
        />
        <div className="space-y-1">
          <p className="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
            Thy Thern <span className="text-zinc-400 font-normal">(Phanet)</span>
          </p>
          <div className="inline-flex items-center gap-2 px-2.5 py-0.5 rounded-full bg-zinc-100 dark:bg-zinc-900 border border-zinc-200/80 dark:border-zinc-800 text-xs font-medium text-zinc-600 dark:text-zinc-400">
            <span className="relative flex h-2 w-2">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75" />
              <span className="relative inline-flex rounded-full h-2 w-2 bg-emerald-500" />
            </span>
            Available for projects & security engineering
          </div>
        </div>
      </motion.div>

      <motion.h1
        variants={itemVariants}
        className="text-4xl md:text-6xl font-semibold tracking-tight leading-[1.1]"
      >
        Engineering secure systems <br />
        <span className="text-zinc-400 dark:text-zinc-500">
          & minimalist web apps.
        </span>
      </motion.h1>

      <motion.p
        variants={itemVariants}
        className="text-base md:text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl leading-relaxed"
      >
        Network and Security Engineer & full-stack developer specializing in
        enterprise cloud defense, mobile application shielding, and
        high-performance web experiences.
      </motion.p>

      <motion.div variants={itemVariants} className="flex flex-wrap gap-3 pt-1">
        <a
          href="#work"
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-zinc-900 text-white dark:bg-zinc-100 dark:text-zinc-950 font-medium text-sm hover:opacity-90 transition-opacity"
        >
          Explore Work
          <ArrowUpRight className="w-4 h-4" />
        </a>
        <a
          href="#journey"
          className="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-zinc-100 dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 font-medium text-sm border border-zinc-200 dark:border-zinc-800 hover:bg-zinc-200/50 dark:hover:bg-zinc-800/80 transition-colors"
        >
          Security Journey
        </a>
      </motion.div>
    </motion.section>
  );
}
