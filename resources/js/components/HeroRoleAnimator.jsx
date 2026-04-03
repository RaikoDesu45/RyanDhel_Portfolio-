import React, { useEffect, useState } from 'react';
import { createRoot } from 'react-dom/client';
import { AnimatePresence, motion } from 'framer-motion';

const FALLBACK_ROLES = [
    'Web Developer',
    'IT Support Specialist',
    'Network Technician',
    'Customer Service Problem-Solver',
];

const ROTATION_DELAY = 2600;

function parseRoles(rawRoles) {
    if (!rawRoles) {
        return FALLBACK_ROLES;
    }

    try {
        const parsed = JSON.parse(rawRoles);
        if (Array.isArray(parsed) && parsed.length > 0) {
            return parsed.filter((role) => typeof role === 'string' && role.trim().length > 0);
        }
    } catch {
        return FALLBACK_ROLES;
    }

    return FALLBACK_ROLES;
}

function HeroRoleAnimator({ roles }) {
    const [index, setIndex] = useState(0);
    const activeRole = roles[index % roles.length];

    useEffect(() => {
        const timer = window.setInterval(() => {
            setIndex((prevIndex) => (prevIndex + 1) % roles.length);
        }, ROTATION_DELAY);

        return () => window.clearInterval(timer);
    }, [roles.length]);

    return (
        <div className="hero-role-shell" aria-live="polite">
            <span className="hero-role-label">Building for</span>
            <span className="hero-role-track">
                <AnimatePresence mode="wait">
                    <motion.span
                        key={activeRole}
                        className="hero-role-value"
                        initial={{ opacity: 0, y: 14, filter: 'blur(6px)' }}
                        animate={{ opacity: 1, y: 0, filter: 'blur(0px)' }}
                        exit={{ opacity: 0, y: -14, filter: 'blur(6px)' }}
                        transition={{ duration: 0.45, ease: 'easeOut' }}
                    >
                        {activeRole}
                    </motion.span>
                </AnimatePresence>
            </span>
        </div>
    );
}

export default function mountHeroRoleAnimator() {
    const mountNode = document.getElementById('heroRoleAnimator');

    if (!mountNode) {
        return;
    }

    const roles = parseRoles(mountNode.getAttribute('data-roles'));
    const root = createRoot(mountNode);

    root.render(
        <React.StrictMode>
            <HeroRoleAnimator roles={roles} />
        </React.StrictMode>
    );
}
