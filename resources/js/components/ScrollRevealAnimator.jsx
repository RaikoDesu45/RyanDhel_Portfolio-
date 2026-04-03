import React, { useEffect } from 'react';
import { createRoot } from 'react-dom/client';
import { animate, inView, stagger, useReducedMotion } from 'framer-motion';

const EASE_OUT_EXPO = [0.22, 1, 0.36, 1];

function revealImmediately(item) {
    item.style.opacity = '1';
    item.style.transform = 'none';
    item.style.filter = 'none';
    item.style.willChange = 'auto';
}

function ScrollRevealAnimator() {
    const reduceMotion = useReducedMotion();

    useEffect(() => {
        const groups = Array.from(document.querySelectorAll('[data-react-group]'));

        if (!groups.length) {
            return undefined;
        }

        const stopObservers = [];

        groups.forEach((group) => {
            const items = Array.from(group.querySelectorAll('[data-motion-item]'));

            if (!items.length) {
                return;
            }

            if (reduceMotion) {
                items.forEach(revealImmediately);
                return;
            }

            items.forEach((item) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.filter = 'blur(6px)';
                item.style.willChange = 'transform, opacity, filter';
            });

            const stop = inView(
                group,
                () => {
                    if (group.dataset.motionPlayed === 'true') {
                        return;
                    }

                    group.dataset.motionPlayed = 'true';

                    animate(
                        items,
                        {
                            opacity: [0, 1],
                            y: [20, 0],
                            filter: ['blur(6px)', 'blur(0px)'],
                        },
                        {
                            duration: 0.62,
                            delay: stagger(0.08),
                            ease: EASE_OUT_EXPO,
                        }
                    );

                    window.setTimeout(() => {
                        items.forEach((item) => {
                            item.style.willChange = 'auto';
                        });
                    }, 720);
                },
                {
                    amount: 0.22,
                    margin: '0px 0px -10% 0px',
                }
            );

            if (typeof stop === 'function') {
                stopObservers.push(stop);
            }
        });

        return () => {
            stopObservers.forEach((stop) => stop());
        };
    }, [reduceMotion]);

    return null;
}

export default function mountScrollRevealAnimator() {
    const mountNode = document.getElementById('scrollRevealAnimator');

    if (!mountNode) {
        return;
    }

    const root = createRoot(mountNode);
    root.render(<ScrollRevealAnimator />);
}
