import React from 'react';
import { createRoot } from 'react-dom/client';
import { motion, useReducedMotion } from 'framer-motion';

const FALLBACK_ITEMS = [
    'Networking',
    'CCTV Setup',
    'Frontend UI',
    'Laravel + PHP',
    'MySQL',
    'Technical Support',
    'Troubleshooting',
    'Customer Service',
];

function parseItems(rawItems) {
    if (!rawItems) {
        return FALLBACK_ITEMS;
    }

    try {
        const parsed = JSON.parse(rawItems);
        if (Array.isArray(parsed) && parsed.length > 0) {
            const cleaned = parsed.filter((item) => typeof item === 'string' && item.trim().length > 0);
            if (cleaned.length > 0) {
                return cleaned;
            }
        }
    } catch {
        return FALLBACK_ITEMS;
    }

    return FALLBACK_ITEMS;
}

function SkillTapeAnimator({ items }) {
    const reduceMotion = useReducedMotion();
    const repeatedItems = [...items, ...items];

    return (
        <div className="skill-tape-mask" aria-label="Core strengths ticker">
            <motion.div
                className="skill-tape-row"
                animate={reduceMotion ? undefined : { x: ['0%', '-50%'] }}
                transition={
                    reduceMotion
                        ? undefined
                        : {
                              duration: 18,
                              ease: 'linear',
                              repeat: Number.POSITIVE_INFINITY,
                          }
                }
            >
                {repeatedItems.map((item, index) => (
                    <span className="skill-pill" key={`${item}-${index}`}>
                        {item}
                    </span>
                ))}
            </motion.div>
        </div>
    );
}

export default function mountSkillTapeAnimator() {
    const mountNode = document.getElementById('heroSkillTapeAnimator');

    if (!mountNode) {
        return;
    }

    const items = parseItems(mountNode.getAttribute('data-items'));
    const root = createRoot(mountNode);

    root.render(
        <React.StrictMode>
            <SkillTapeAnimator items={items} />
        </React.StrictMode>
    );
}
