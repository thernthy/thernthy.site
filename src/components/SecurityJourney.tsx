import React from "react";
import { motion } from "framer-motion";
import { ShieldCheck } from "lucide-react";
import { SECURITY_JOURNEY } from "../data/portfolioData";

export function SecurityJourney() {
  return (
    <section id="journey" className="space-y-8 scroll-mt-28">
      <div className="space-y-2">
        <div className="inline-flex items-center gap-2 text-xs font-mono text-zinc-500 uppercase tracking-wider">
          <ShieldCheck className="w-4 h-4 text-zinc-400" />
          Career Evolution
        </div>
        <h2 className="text-xl font-semibold tracking-tight">
          Network & Security Engineering Journey
        </h2>
        <p className="text-sm md:text-base text-zinc-600 dark:text-zinc-400 leading-relaxed max-w-2xl">
          My transition into Network and Security Engineering grew out of
          hands-on work securing enterprise perimeters, mobile runtimes, and
          cloud-edge traffic—turning deep protocol and reverse-engineering
          knowledge into real-world defense architectures.
        </p>
      </div>

      <div className="relative border-l border-zinc-200 dark:border-zinc-800 ml-3 pl-6 space-y-6">
        {SECURITY_JOURNEY.map((step, index) => (
          <motion.div
            key={step.vendor}
            initial={{ opacity: 0, x: -16 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true, margin: "-80px" }}
            transition={{ delay: index * 0.08 }}
            className="relative group"
          >
            <span className="absolute -left-[31px] top-1.5 h-3 w-3 rounded-full border-2 border-white dark:border-zinc-950 bg-zinc-400 group-hover:bg-zinc-900 dark:group-hover:bg-white transition-colors" />
            <div className="p-5 rounded-2xl bg-zinc-50/70 dark:bg-zinc-900/40 border border-zinc-200/80 dark:border-zinc-800/80 hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors space-y-2">
              <div className="flex flex-wrap items-center justify-between gap-2">
                <h3 className="text-base font-semibold text-zinc-900 dark:text-zinc-100">
                  {step.vendor} — {step.role}
                </h3>
                <span className="px-2.5 py-0.5 text-xs font-mono rounded-full bg-zinc-200/70 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                  {step.category}
                </span>
              </div>
              <p className="text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed">
                {step.summary}
              </p>
            </div>
          </motion.div>
        ))}
      </div>
    </section>
  );
}
