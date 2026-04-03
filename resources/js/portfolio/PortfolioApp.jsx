import React, { useEffect, useMemo, useState } from 'react';
import { AnimatePresence, motion, useReducedMotion } from 'framer-motion';

const NAV_ITEMS = [
    { id: 'overview', label: 'Home' },
    { id: 'about', label: 'About' },
    { id: 'projects', label: 'Experience' },
    { id: 'skills', label: 'Skills' },
    { id: 'contact', label: 'Contact' },
];

const HERO_ROLES = [
    'Web Developer',
    'IT Support Specialist',
    'Network Technician',
    'CCTV and Security Installer',
];

const HERO_TICKER_ITEMS = [
    'Networking',
    'CCTV Setup',
    'Frontend UI',
    'PHP and Laravel',
    'MySQL',
    'Customer Support',
    'Troubleshooting',
    'System Maintenance',
];

const KPI_ITEMS = [
    { value: '2019-2025', label: 'BS Information Systems' },
    { value: '24/7', label: 'Surveillance Setup' },
    { value: '2024', label: 'IT Internship' },
];

const FOCUS_ITEMS = [
    'Network Cabling (Cat5e/Cat6)',
    'CCTV + DVR Configuration',
    'HTML5, CSS3, JavaScript, PHP',
    'MySQL + System Maintenance',
];

const PROJECTS = [
    {
        tag: 'Work Experience',
        title: 'Customer Service Representative (Target Account)',
        description:
            'Store Service Representative at ResultsCX supporting Target retail customers with order inquiries, returns, payments, and account concerns while maintaining a positive service experience.',
        tech: ['ResultsCX', 'Customer Support', 'Issue Resolution'],
    },
    {
        tag: 'Internship',
        title: 'IT Intern | ACC College, Taytay',
        description:
            'Assisted with computer laboratory and library operations, supported technical maintenance, and performed troubleshooting for campus computing facilities (Feb 2024 - May 2024).',
        tech: ['IT Support', 'Hardware', 'Maintenance'],
    },
    {
        tag: 'Academic Project',
        title: 'Network Setup and Security System Installation',
        description:
            'Designed and implemented a full surveillance setup for ACC College of Taytay, including CCTV installation, Cat5e/Cat6 cabling, and DVR configuration for reliable 24/7 monitoring and recording.',
        tech: ['CCTV', 'Cat5e/Cat6', 'DVR'],
    },
];

const SKILL_GROUPS = [
    {
        title: 'Networking and Security',
        items: ['Network Cabling', 'Cat5e/Cat6', 'CCTV Installation', 'DVR Setup', '24/7 Surveillance'],
    },
    {
        title: 'Web Development',
        items: ['HTML5', 'CSS3', 'JavaScript', 'PHP', 'Responsive UI'],
    },
    {
        title: 'IT Support and Database',
        items: ['MySQL', 'Troubleshooting', 'System Configuration', 'Technical Maintenance', 'User Support'],
    },
];

const EDUCATION_ITEMS = [
    {
        school: 'AMA Computer Learning Center, Taytay',
        detail: 'Bachelor of Science in Information Systems (2019 - 2025)',
    },
    {
        school: 'AMA Computer Learning Center Senior High School, Taytay',
        detail: 'Information and Communications Technology (2017 - 2019)',
    },
    {
        school: 'Dr. Vivencio B. Villamayor Integrated School, Angono',
        detail: 'Junior High School (2013 - 2017)',
    },
    {
        school: 'Joaquin Guido Elementary School, Angono',
        detail: 'Elementary (2007 - 2013)',
    },
];

const DEFAULT_OLD_INPUT = {
    name: '',
    email: '',
    subject: '',
    message: '',
};

const easeOutExpo = [0.22, 1, 0.36, 1];

function useRevealAnimation(reduceMotion) {
    return (delay = 0) => {
        if (reduceMotion) {
            return {
                initial: false,
            };
        }

        return {
            initial: { opacity: 0, y: 20, filter: 'blur(6px)' },
            whileInView: { opacity: 1, y: 0, filter: 'blur(0px)' },
            viewport: { once: true, amount: 0.2 },
            transition: {
                duration: 0.58,
                delay,
                ease: easeOutExpo,
            },
        };
    };
}

export default function PortfolioApp({
    cvUrl,
    contactAction,
    csrfToken,
    mailSuccess,
    mailError,
    validationError,
    oldInput,
}) {
    const reduceMotion = useReducedMotion();
    const reveal = useRevealAnimation(reduceMotion);

    const [menuOpen, setMenuOpen] = useState(false);
    const [activeSection, setActiveSection] = useState('overview');
    const [scrollProgress, setScrollProgress] = useState(0);
    const [scrolled, setScrolled] = useState(false);
    const [roleIndex, setRoleIndex] = useState(0);

    const hasCv = Boolean(cvUrl);
    const cvHref = hasCv ? cvUrl : '#contact';
    const formDefaults = useMemo(() => ({ ...DEFAULT_OLD_INPUT, ...(oldInput || {}) }), [oldInput]);

    const formAlert = useMemo(() => {
        if (mailSuccess) {
            return { type: 'success', text: mailSuccess };
        }

        if (mailError) {
            return { type: 'error', text: mailError };
        }

        if (validationError) {
            return { type: 'error', text: validationError };
        }

        return null;
    }, [mailSuccess, mailError, validationError]);

    useEffect(() => {
        if (reduceMotion) {
            return undefined;
        }

        const timer = window.setInterval(() => {
            setRoleIndex((prevRoleIndex) => (prevRoleIndex + 1) % HERO_ROLES.length);
        }, 2600);

        return () => {
            window.clearInterval(timer);
        };
    }, [reduceMotion]);

    useEffect(() => {
        const updateScrollState = () => {
            const scrollY = window.scrollY || 0;
            const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
            const progress = maxScroll > 0 ? Math.min(scrollY / maxScroll, 1) : 0;

            const marker = scrollY + window.innerHeight * 0.35;
            let currentSection = NAV_ITEMS[0].id;

            NAV_ITEMS.forEach((item) => {
                const section = document.getElementById(item.id);
                if (section && marker >= section.offsetTop) {
                    currentSection = item.id;
                }
            });

            setScrollProgress(progress);
            setScrolled(scrollY > 24);
            setActiveSection(currentSection);
        };

        updateScrollState();

        let tickScheduled = false;
        const onScroll = () => {
            if (tickScheduled) {
                return;
            }

            tickScheduled = true;
            window.requestAnimationFrame(() => {
                updateScrollState();
                tickScheduled = false;
            });
        };

        window.addEventListener('scroll', onScroll, { passive: true });
        window.addEventListener('resize', updateScrollState);

        return () => {
            window.removeEventListener('scroll', onScroll);
            window.removeEventListener('resize', updateScrollState);
        };
    }, []);

    useEffect(() => {
        const closeMenuOnDesktop = () => {
            if (window.innerWidth > 860) {
                setMenuOpen(false);
            }
        };

        window.addEventListener('resize', closeMenuOnDesktop);

        return () => {
            window.removeEventListener('resize', closeMenuOnDesktop);
        };
    }, []);

    const activeRole = HERO_ROLES[roleIndex];
    const tickerItems = [...HERO_TICKER_ITEMS, ...HERO_TICKER_ITEMS];

    return (
        <div className="portfolio-page">
            <div className="ambient-grid" aria-hidden="true" />
            <div className="scroll-progress" aria-hidden="true" style={{ transform: `scaleX(${scrollProgress})` }} />

            <header className={`site-header ${scrolled ? 'scrolled' : ''}`}>
                <div className="shell header-inner">
                    <a className="brand" href="#overview" onClick={() => setMenuOpen(false)}>
                        <span className="brand-mark">RC</span>
                        <span className="brand-text">
                            Ryan Dhel S. Canja
                            <span className="brand-sub">Bachelor of Science in Information Systems</span>
                        </span>
                    </a>

                    <button
                        type="button"
                        className="menu-toggle"
                        aria-expanded={menuOpen}
                        aria-controls="site-menu"
                        onClick={() => setMenuOpen((prevValue) => !prevValue)}
                    >
                        Menu
                    </button>

                    <nav id="site-menu" className={`menu ${menuOpen ? 'open' : ''}`} aria-label="Primary">
                        {NAV_ITEMS.map((item) => (
                            <a
                                key={item.id}
                                href={`#${item.id}`}
                                className={activeSection === item.id ? 'active' : ''}
                                onClick={() => setMenuOpen(false)}
                            >
                                {item.label}
                            </a>
                        ))}
                    </nav>

                    <a className="btn btn-primary header-cta" href="#contact" onClick={() => setMenuOpen(false)}>
                        Hire Me
                    </a>
                </div>
            </header>

            <aside className="social-rail" aria-label="Social links">
                <a href="mailto:ryandhelcanja13@gmail.com" title="Email">
                    EM
                </a>
                <a href="tel:+639810249744" title="Phone">
                    PH
                </a>
                <a href={cvHref} download={hasCv} title={hasCv ? 'Download CV' : 'Upload a PDF to public folder'}>
                    CV
                </a>
            </aside>

            <main className="shell">
                <section id="overview" className="hero">
                    <motion.article className="hero-copy" {...reveal(0.05)}>
                        <span className="eyebrow">Open for immediate opportunities</span>

                        <h1 className="hero-title texture-text">Aspiring Web Developer</h1>

                        <div className="role-wrapper" aria-live="polite">
                            <span className="role-label">Building for</span>
                            <span className="role-track">
                                <AnimatePresence mode="wait">
                                    <motion.span
                                        key={activeRole}
                                        className="role-value"
                                        initial={reduceMotion ? false : { opacity: 0, y: 12, filter: 'blur(4px)' }}
                                        animate={reduceMotion ? undefined : { opacity: 1, y: 0, filter: 'blur(0px)' }}
                                        exit={reduceMotion ? undefined : { opacity: 0, y: -12, filter: 'blur(4px)' }}
                                        transition={{ duration: 0.4, ease: 'easeOut' }}
                                    >
                                        {activeRole}
                                    </motion.span>
                                </AnimatePresence>
                            </span>
                        </div>

                        <div className="skill-tape" aria-label="Core strengths">
                            <div className="skill-tape-mask">
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
                                    {tickerItems.map((item, index) => (
                                        <span className="skill-pill" key={`${item}-${index}`}>
                                            {item}
                                        </span>
                                    ))}
                                </motion.div>
                            </div>
                        </div>

                        <p className="hero-summary">
                            Dedicated Bachelor of Science in Information Systems graduate with a strong foundation in network
                            infrastructure, surveillance systems, web development, and technical support. Experienced in customer
                            service, troubleshooting, and improving operations through technology.
                        </p>

                        <div className="cta-row">
                            <a className="btn btn-primary" href="#projects">
                                View Experience
                            </a>
                            <a className="btn btn-outline" href="#contact">
                                Contact Me
                            </a>
                            <a className="btn btn-outline" href={cvHref} download={hasCv}>
                                Download CV (PDF)
                            </a>
                        </div>

                        <div className="kpi-grid">
                            {KPI_ITEMS.map((kpi, index) => (
                                <motion.div className="kpi" key={kpi.label} {...reveal(0.15 + index * 0.08)}>
                                    <strong>{kpi.value}</strong>
                                    <span>{kpi.label}</span>
                                </motion.div>
                            ))}
                        </div>
                    </motion.article>

                    <motion.article className="hero-art" {...reveal(0.15)}>
                        <div className="profile-card">
                            <div className="profile-top">
                                <img
                                    className="avatar"
                                    src="/ryandhel.png"
                                    alt="Portrait of Ryan Dhel S. Canja"
                                    onError={(event) => {
                                        const image = event.currentTarget;
                                        if (image.dataset.fallbackLoaded === 'true') {
                                            return;
                                        }

                                        image.dataset.fallbackLoaded = 'true';
                                        image.src = '/ryandhel.jpg';
                                    }}
                                />
                                <div>
                                    <p className="profile-name">Ryan Dhel S. Canja</p>
                                    <p className="profile-role">Entry-Level IT and Web Developer</p>
                                    <p className="live-dot">Open for immediate opportunities</p>
                                </div>
                            </div>

                            <div className="mini-grid">
                                <div className="mini">
                                    <strong>Location</strong>
                                    Sitio Minahang Bato, Brgy. San Isidro, Angono, Rizal, 1930
                                </div>
                                <div className="mini">
                                    <strong>Phone</strong>
                                    +63 9810 249744
                                </div>
                                <div className="mini">
                                    <strong>Email</strong>
                                    ryandhelcanja13@gmail.com
                                </div>
                                <div className="mini">
                                    <strong>Core Strength</strong>
                                    Technical support, networking, customer service
                                </div>
                            </div>
                        </div>
                    </motion.article>
                </section>

                <motion.section id="about" className="section" {...reveal(0.05)}>
                    <h2 className="section-title texture-text">Professional Summary</h2>
                    <p className="section-subtitle">
                        Hands-on learner with practical exposure to customer-facing support, hardware troubleshooting, and real-world
                        network and security implementation.
                    </p>

                    <div className="about-grid">
                        <motion.article className="about-panel" {...reveal(0.1)}>
                            I graduated with a <strong>Bachelor of Science in Information Systems</strong> and built my skills in
                            networking, surveillance setup, web development, and IT support. During my internship and academic
                            projects, I worked on lab operations, system maintenance, and campus security solutions.
                            <br />
                            <br />I also gained strong communication and problem-resolution skills through customer service work,
                            assisting users with inquiries, payments, returns, and account concerns while delivering clear policy
                            guidance.
                        </motion.article>

                        <ul className="focus-list">
                            {FOCUS_ITEMS.map((item, index) => (
                                <motion.li key={item} {...reveal(0.14 + index * 0.07)}>
                                    {item}
                                </motion.li>
                            ))}
                        </ul>
                    </div>
                </motion.section>

                <motion.section id="projects" className="section" {...reveal(0.05)}>
                    <h2 className="section-title texture-text">Experience and Projects</h2>
                    <p className="section-subtitle">
                        Practical experience from customer service, internship responsibilities, and technical academic projects.
                    </p>

                    <div className="project-grid">
                        {PROJECTS.map((project, index) => (
                            <motion.article className="project-card" key={project.title} {...reveal(0.1 + index * 0.09)}>
                                <span className="chip">{project.tag}</span>
                                <h3>{project.title}</h3>
                                <p>{project.description}</p>
                                <div className="tech-list">
                                    {project.tech.map((techItem) => (
                                        <span key={`${project.title}-${techItem}`}>{techItem}</span>
                                    ))}
                                </div>
                            </motion.article>
                        ))}
                    </div>
                </motion.section>

                <motion.section id="skills" className="section" {...reveal(0.05)}>
                    <h2 className="section-title texture-text">Technical Skills</h2>
                    <p className="section-subtitle">
                        Core technical competencies aligned with entry-level IT support, networking, and web development roles.
                    </p>

                    <div className="skills-grid">
                        {SKILL_GROUPS.map((group, groupIndex) => (
                            <motion.article className="skill-panel" key={group.title} {...reveal(0.1 + groupIndex * 0.09)}>
                                <h3>{group.title}</h3>
                                <div className="stack">
                                    {group.items.map((item) => (
                                        <span key={`${group.title}-${item}`}>{item}</span>
                                    ))}
                                </div>
                            </motion.article>
                        ))}
                    </div>
                </motion.section>

                <motion.section id="contact" className="section" {...reveal(0.05)}>
                    <h2 className="section-title texture-text">Education and Contact</h2>
                    <p className="section-subtitle">
                        If you are hiring for IT support, networking, or junior web development roles, I would be glad to connect.
                    </p>

                    <div className="contact-grid">
                        <motion.article className="contact-card" {...reveal(0.1)}>
                            <p>
                                Character reference is available upon request. I am open to interviews and technical assessments for
                                entry-level roles.
                            </p>

                            <ul className="contact-list">
                                <li>
                                    <strong>Email</strong>
                                    <a href="mailto:ryandhelcanja13@gmail.com">ryandhelcanja13@gmail.com</a>
                                </li>
                                <li>
                                    <strong>Phone</strong>
                                    <a href="tel:+639810249744">+63 981 024 9744</a>
                                </li>
                                <li>
                                    <strong>Location</strong>
                                    Sitio Minahang Bato, Brgy. San Isidro, Angono, Rizal, 1930
                                </li>
                                <li>
                                    <strong>Availability</strong>
                                    Open to full-time or internship opportunities
                                </li>
                            </ul>

                            <div className="contact-actions">
                                <a className="btn btn-primary" href={cvHref} download={hasCv}>
                                    Download CV (PDF)
                                </a>
                            </div>
                        </motion.article>

                        <motion.article className="contact-form education-panel" {...reveal(0.16)}>
                            <h3>Education</h3>
                            <ul className="contact-list">
                                {EDUCATION_ITEMS.map((item) => (
                                    <li key={item.school}>
                                        <strong>{item.school}</strong>
                                        {item.detail}
                                    </li>
                                ))}
                            </ul>

                            <div className="cert-box">
                                <strong>Certification and Training</strong>
                                Navigating Pathways in the IT-BPM Industry - Metro Rizal IT-BPM Summit (November 26, 2024)
                            </div>
                        </motion.article>
                    </div>

                    <motion.form
                        className="contact-form contact-mail-form"
                        action={contactAction || '#contact'}
                        method="post"
                        {...reveal(0.12)}
                    >
                        <input type="hidden" name="_token" value={csrfToken || ''} />
                        <h3>Send Message Via Email</h3>

                        {formAlert ? <p className={`form-alert ${formAlert.type}`}>{formAlert.text}</p> : null}

                        <label className="field-label" htmlFor="contact_name">
                            Name
                        </label>
                        <input
                            className="input"
                            id="contact_name"
                            name="name"
                            type="text"
                            defaultValue={formDefaults.name}
                            placeholder="Your full name"
                            required
                        />

                        <label className="field-label" htmlFor="contact_email">
                            Email
                        </label>
                        <input
                            className="input"
                            id="contact_email"
                            name="email"
                            type="email"
                            defaultValue={formDefaults.email}
                            placeholder="your@email.com"
                            required
                        />

                        <label className="field-label" htmlFor="contact_subject">
                            Subject
                        </label>
                        <input
                            className="input"
                            id="contact_subject"
                            name="subject"
                            type="text"
                            defaultValue={formDefaults.subject}
                            placeholder="Job opportunity / Project inquiry"
                            required
                        />

                        <label className="field-label" htmlFor="contact_message">
                            Message
                        </label>
                        <textarea
                            className="input textarea"
                            id="contact_message"
                            name="message"
                            defaultValue={formDefaults.message}
                            placeholder="Write your message here"
                            required
                        />

                        <button className="btn btn-primary" type="submit">
                            Send Email
                        </button>
                    </motion.form>
                </motion.section>
            </main>

            <footer className="site-footer">Copyright {new Date().getFullYear()} Ryan Canja. Built with Laravel and React.</footer>
        </div>
    );
}
