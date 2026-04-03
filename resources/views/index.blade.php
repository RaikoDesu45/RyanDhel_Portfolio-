<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Portfolio') }} | Ryan Dhel S. Canja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&family=Bebas+Neue&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #090b1d;
            --bg-elevated: rgba(14, 18, 44, 0.82);
            --line: rgba(157, 171, 255, 0.2);
            --accent: #46f5d5;
            --accent-alt: #ffd56b;
            --ink: #edf0ff;
            --muted: #a5aed5;
            --danger: #ff4d89;
            --panel: #13183b;
            --font-heading: 'Bebas Neue', sans-serif;
            --font-body: 'Manrope', sans-serif;
            --scroll-progress: 0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            min-height: 100vh;
            background:
                radial-gradient(circle at 15% 10%, rgba(255, 118, 193, 0.22), transparent 36%),
                radial-gradient(circle at 80% 12%, rgba(70, 245, 213, 0.22), transparent 34%),
                radial-gradient(circle at 55% 65%, rgba(126, 82, 255, 0.2), transparent 41%),
                var(--bg);
            color: var(--ink);
            font-family: var(--font-body);
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 42px 42px;
            mask-image: radial-gradient(circle at center, black 58%, transparent 100%);
            z-index: 0;
        }

        .scroll-progress {
            position: fixed;
            inset: 0 auto auto 0;
            width: 100%;
            height: 3px;
            transform: scaleX(var(--scroll-progress));
            transform-origin: left center;
            background: linear-gradient(90deg, var(--accent), var(--accent-alt), #2e8bff);
            box-shadow: 0 0 14px rgba(70, 245, 213, 0.5);
            z-index: 50;
            pointer-events: none;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .shell {
            position: relative;
            z-index: 1;
            width: min(1200px, calc(100% - 2rem));
            margin: 0 auto;
        }

        .site-header {
            position: sticky;
            top: 0;
            z-index: 30;
            margin-top: 1rem;
        }

        .site-header .shell {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            border: 1px solid var(--line);
            border-radius: 999px;
            padding: 0.65rem 1rem;
            backdrop-filter: blur(14px);
            background: rgba(8, 10, 24, 0.72);
            transition: background 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }

        .site-header.scrolled .shell {
            background: rgba(5, 8, 22, 0.92);
            border-color: rgba(70, 245, 213, 0.36);
            box-shadow: 0 10px 26px rgba(4, 8, 25, 0.48);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 800;
            letter-spacing: 0.04em;
        }

        .brand-mark {
            width: 2.1rem;
            aspect-ratio: 1;
            border-radius: 0.55rem;
            display: grid;
            place-items: center;
            font-family: var(--font-heading);
            font-size: 1.45rem;
            background: linear-gradient(135deg, var(--accent), #2f8dff);
            color: #050b18;
            box-shadow: 0 0 25px rgba(70, 245, 213, 0.45);
        }

        .brand-text {
            line-height: 1;
        }

        .brand-text span {
            display: block;
            font-size: 0.7rem;
            letter-spacing: 0.22em;
            color: var(--muted);
            font-weight: 600;
        }

        .menu-toggle {
            display: none;
            background: transparent;
            border: 1px solid var(--line);
            color: var(--ink);
            border-radius: 999px;
            padding: 0.4rem 0.9rem;
            font-weight: 700;
            cursor: pointer;
        }

        .menu {
            display: inline-flex;
            align-items: center;
            gap: 1.2rem;
            font-size: 0.88rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 700;
        }

        .menu a {
            color: var(--muted);
            transition: color 0.2s ease;
        }

        .menu a.active {
            color: var(--accent-alt);
        }

        .menu a:hover {
            color: var(--accent);
        }

        .btn {
            border: 1px solid transparent;
            border-radius: 999px;
            padding: 0.78rem 1.1rem;
            font-size: 0.83rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 800;
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(130deg, var(--accent), #2e8bff);
            color: #071327;
            box-shadow: 0 14px 30px rgba(36, 145, 255, 0.32);
        }

        .btn-outline {
            border-color: var(--line);
            color: var(--ink);
            background: rgba(255, 255, 255, 0.02);
        }

        .btn-outline:hover {
            border-color: var(--accent-alt);
            box-shadow: 0 10px 18px rgba(255, 213, 107, 0.18);
        }

        .hero {
            margin-top: 2.5rem;
            display: grid;
            grid-template-columns: 1.06fr 0.94fr;
            gap: 1.4rem;
            align-items: stretch;
        }

        .hero-copy,
        .hero-art {
            border: 1px solid var(--line);
            border-radius: 1.6rem;
            overflow: hidden;
            background: linear-gradient(160deg, rgba(18, 24, 56, 0.9), rgba(10, 14, 32, 0.9));
            position: relative;
        }

        .hero-copy {
            padding: clamp(1.3rem, 3vw, 2.2rem);
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 500px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            width: fit-content;
            border: 1px solid rgba(255, 255, 255, 0.22);
            border-radius: 999px;
            padding: 0.35rem 0.8rem;
            font-size: 0.72rem;
            letter-spacing: 0.14em;
            color: #cffbff;
            text-transform: uppercase;
            background: rgba(0, 0, 0, 0.23);
        }

        h1 {
            font-family: var(--font-heading);
            font-size: clamp(2.8rem, 7vw, 5.5rem);
            margin-top: 1rem;
            line-height: 0.9;
            letter-spacing: 0.03em;
            text-wrap: balance;
            text-shadow: 0 10px 34px rgba(4, 10, 27, 0.75);
        }

        .hero-copy p {
            margin-top: 1rem;
            color: var(--muted);
            max-width: 62ch;
            font-size: 1rem;
            line-height: 1.7;
        }

        .cta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.65rem;
            margin-top: 1.5rem;
        }

        .kpi-grid {
            margin-top: 1.65rem;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.7rem;
        }

        .kpi {
            border: 1px solid var(--line);
            background: rgba(6, 10, 24, 0.5);
            border-radius: 0.9rem;
            padding: 0.85rem;
        }

        .kpi strong {
            font-size: 1.4rem;
            display: block;
            color: var(--accent-alt);
        }

        .kpi span {
            color: var(--muted);
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .hero-art {
            min-height: 500px;
            padding: 1.2rem;
            isolation: isolate;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            background:
                linear-gradient(120deg, rgba(14, 20, 51, 0.95), rgba(14, 19, 35, 0.7)),
                url('https://images.unsplash.com/photo-1518770660439-4636190af475?auto=format&fit=crop&w=1400&q=80') center/cover;
        }

        .hero-art::before,
        .hero-art::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            filter: blur(1px);
        }

        .hero-art::before {
            width: 290px;
            height: 290px;
            background: radial-gradient(circle, rgba(255, 87, 167, 0.75), transparent 72%);
            top: -68px;
            right: -36px;
            animation: drift 8s ease-in-out infinite;
        }

        .hero-art::after {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(70, 245, 213, 0.75), transparent 72%);
            left: -35px;
            bottom: -78px;
            animation: drift 7.2s ease-in-out infinite reverse;
        }

        .profile-card {
            width: min(430px, 100%);
            position: relative;
            z-index: 2;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(5, 8, 20, 0.72);
            border-radius: 1.2rem;
            backdrop-filter: blur(8px);
            padding: 1rem;
            transform: translateY(var(--profile-shift, 0px));
            transition: transform 0.12s linear;
            will-change: transform;
        }

        .profile-top {
            display: flex;
            gap: 0.9rem;
            align-items: center;
        }

        .avatar {
            width: clamp(110px, 14vw, 150px);
            height: clamp(110px, 14vw, 150px);
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.25);
            object-fit: cover;
            object-position: center;
            background: transparent;
            padding: 0;
            flex-shrink: 0;
        }

        .profile-name {
            font-size: 1.2rem;
            font-weight: 800;
        }

        .profile-role {
            color: var(--muted);
            font-size: 0.9rem;
            margin-top: 0.15rem;
        }

        .live-dot {
            margin-top: 0.45rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            color: #d5ffed;
            font-size: 0.76rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .live-dot::before {
            content: "";
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: #42f3a7;
            box-shadow: 0 0 0 7px rgba(66, 243, 167, 0.18);
            animation: pulse 1.8s ease-out infinite;
        }

        .mini-grid {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.6rem;
        }

        .mini {
            border-radius: 0.7rem;
            border: 1px solid rgba(255, 255, 255, 0.16);
            padding: 0.62rem;
            background: rgba(255, 255, 255, 0.03);
            font-size: 0.8rem;
            color: var(--muted);
        }

        .mini strong {
            display: block;
            color: var(--ink);
            margin-bottom: 0.3rem;
            font-size: 0.92rem;
        }

        .social-rail {
            position: fixed;
            right: 0.8rem;
            top: 45%;
            transform: translateY(-50%);
            z-index: 25;
            display: grid;
            gap: 0.45rem;
        }

        .social-rail a {
            width: 2.35rem;
            aspect-ratio: 1;
            border-radius: 50%;
            display: grid;
            place-items: center;
            border: 1px solid var(--line);
            background: rgba(8, 12, 30, 0.82);
            font-size: 0.75rem;
            font-weight: 800;
            color: var(--ink);
            transition: transform 0.2s ease, border-color 0.2s ease;
        }

        .social-rail a:hover {
            transform: translateX(-3px) scale(1.05);
            border-color: var(--accent);
        }

        .section {
            margin-top: 1.35rem;
            border: 1px solid var(--line);
            border-radius: 1.6rem;
            background: linear-gradient(150deg, rgba(15, 20, 49, 0.9), rgba(9, 12, 30, 0.82));
            padding: clamp(1.1rem, 3vw, 2rem);
        }

        .section-title {
            font-family: var(--font-heading);
            font-size: clamp(2rem, 5vw, 3.2rem);
            letter-spacing: 0.03em;
            line-height: 0.9;
        }

        .section-subtitle {
            color: var(--muted);
            margin-top: 0.5rem;
            max-width: 62ch;
            line-height: 1.7;
        }

        .about-grid {
            margin-top: 1.1rem;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 0.8rem;
        }

        .about-panel {
            border: 1px solid var(--line);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(8, 12, 30, 0.45);
            color: var(--muted);
            line-height: 1.75;
        }

        .about-panel strong {
            color: var(--ink);
        }

        .focus-list {
            list-style: none;
            display: grid;
            gap: 0.55rem;
        }

        .focus-list li {
            border: 1px solid var(--line);
            border-radius: 0.8rem;
            padding: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.07em;
            background: rgba(255, 255, 255, 0.02);
            color: #dce2ff;
        }

        .project-grid {
            margin-top: 1.2rem;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.85rem;
        }

        .project-card {
            border: 1px solid var(--line);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(8, 12, 30, 0.46);
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            min-height: 280px;
        }

        .chip {
            display: inline-flex;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 999px;
            font-size: 0.7rem;
            padding: 0.22rem 0.52rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #cffbff;
            background: rgba(255, 255, 255, 0.03);
            width: fit-content;
        }

        .project-card h3 {
            font-size: 1.1rem;
        }

        .project-card p {
            color: var(--muted);
            line-height: 1.6;
            font-size: 0.93rem;
        }

        .tech-list {
            margin-top: auto;
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .tech-list span {
            border: 1px solid var(--line);
            border-radius: 0.45rem;
            padding: 0.2rem 0.45rem;
            font-size: 0.72rem;
            color: #d2d9ff;
            background: rgba(255, 255, 255, 0.03);
        }

        .skills-grid {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.8rem;
        }

        .skill-panel {
            border: 1px solid var(--line);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(6, 9, 26, 0.5);
        }

        .skill-panel h3 {
            color: var(--accent-alt);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-size: 0.86rem;
            margin-bottom: 0.5rem;
        }

        .stack {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .stack span {
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 999px;
            padding: 0.3rem 0.7rem;
            font-size: 0.78rem;
            color: var(--ink);
            background: rgba(255, 255, 255, 0.04);
        }

        .contact-grid {
            margin-top: 1rem;
            display: grid;
            grid-template-columns: 1fr 0.95fr;
            gap: 0.8rem;
        }

        .contact-card,
        .contact-form {
            border: 1px solid var(--line);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(7, 11, 28, 0.56);
        }

        .contact-list {
            margin-top: 0.8rem;
            list-style: none;
            display: grid;
            gap: 0.5rem;
        }

        .contact-list li {
            border: 1px solid var(--line);
            border-radius: 0.7rem;
            padding: 0.62rem;
            color: var(--muted);
            background: rgba(255, 255, 255, 0.03);
        }

        .contact-list strong {
            color: var(--ink);
            display: block;
            font-size: 0.83rem;
            margin-bottom: 0.2rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .contact-actions {
            margin-top: 0.8rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.6rem;
        }

        .contact-mail-form {
            margin-top: 0.8rem;
            border: 1px solid var(--line);
            border-radius: 1rem;
            padding: 1rem;
            background: rgba(7, 11, 28, 0.56);
        }

        .contact-form {
            display: grid;
            gap: 0.6rem;
        }

        .contact-form h3 {
            color: var(--accent-alt);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            font-size: 0.84rem;
        }

        .form-alert {
            border-radius: 0.7rem;
            padding: 0.68rem 0.75rem;
            border: 1px solid var(--line);
            font-size: 0.88rem;
            line-height: 1.55;
        }

        .form-alert.success {
            border-color: rgba(66, 243, 167, 0.42);
            background: rgba(66, 243, 167, 0.1);
            color: #d6ffeb;
        }

        .form-alert.error {
            border-color: rgba(255, 77, 137, 0.5);
            background: rgba(255, 77, 137, 0.1);
            color: #ffd9e8;
        }

        .cert-box {
            border: 1px solid var(--line);
            border-radius: 0.75rem;
            padding: 0.75rem;
            background: rgba(255, 255, 255, 0.03);
            color: var(--muted);
            line-height: 1.6;
        }

        .cert-box strong {
            display: block;
            color: var(--ink);
            font-size: 0.82rem;
            margin-bottom: 0.25rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .contact-form label {
            color: var(--muted);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid var(--line);
            border-radius: 0.65rem;
            padding: 0.68rem;
            color: var(--ink);
            font: inherit;
        }

        .contact-form textarea {
            resize: vertical;
            min-height: 110px;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(70, 245, 213, 0.14);
        }

        .contact-mail-form .btn {
            width: fit-content;
            margin-top: 0.2rem;
        }

        footer {
            color: var(--muted);
            text-align: center;
            padding: 1.6rem 0 2.8rem;
            font-size: 0.85rem;
        }

        .reveal {
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(66, 243, 167, 0.32);
            }

            100% {
                box-shadow: 0 0 0 12px rgba(66, 243, 167, 0);
            }
        }

        @keyframes drift {
            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-10px, 12px);
            }
        }

        @media (max-width: 1080px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .hero-copy,
            .hero-art {
                min-height: auto;
            }

            .about-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }

            .project-grid,
            .skills-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .social-rail {
                display: none;
            }
        }

        @media (max-width: 760px) {
            .site-header {
                margin-top: 0.7rem;
            }

            .site-header .shell {
                border-radius: 1rem;
                padding: 0.65rem;
                align-items: flex-start;
                flex-wrap: wrap;
            }

            .menu-toggle {
                display: inline-flex;
            }

            .menu {
                width: 100%;
                flex-direction: column;
                align-items: flex-start;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
                gap: 0.7rem;
                padding-left: 0.1rem;
            }

            .menu.open {
                max-height: 15rem;
                margin-top: 0.5rem;
            }

            .header-cta {
                margin-left: auto;
            }

            h1 {
                font-size: clamp(2.35rem, 11vw, 3.45rem);
            }

            .kpi-grid {
                grid-template-columns: 1fr;
            }

            .project-grid,
            .skills-grid {
                grid-template-columns: 1fr;
            }

            .profile-top {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    @php
        $cvFiles = glob(public_path('*.pdf')) ?: [];
        sort($cvFiles, SORT_NATURAL | SORT_FLAG_CASE);
        $cvPdf = !empty($cvFiles) ? basename($cvFiles[0]) : null;
    @endphp

    <div class="scroll-progress" aria-hidden="true"></div>

    <header class="site-header">
        <div class="shell">
            <a class="brand" href="#overview">
                <span class="brand-mark">RC</span>
                <span class="brand-text">
                    Ryan Dhel S. Canja
                    <span>Bachelor of Science in Information Systems </span>
                </span>
            </a>

            <button id="menuToggle" class="menu-toggle" type="button" aria-label="Toggle navigation">Menu</button>

            <nav id="menu" class="menu" aria-label="Primary">
                <a href="#overview">Home</a>
                <a href="#about">About</a>
                <a href="#projects">Experience</a>
                <a href="#skills">Skills</a>
                <a href="#contact">Contact</a>
            </nav>

            <a class="btn btn-primary header-cta" href="#contact">Hire Me</a>
        </div>
    </header>

    <aside class="social-rail" aria-label="Social links">
        <a href="mailto:ryandhelcanja13@gmail.com" title="Email">EM</a>
        <a href="tel:+639810249744" title="Phone">PH</a>
        <a href="{{ $cvPdf ? asset($cvPdf) : '#contact' }}" @if($cvPdf) download @endif title="{{ $cvPdf ? 'Download CV' : 'Upload a PDF to public/' }}">CV</a>
    </aside>

    <main class="shell">
        <section class="hero" id="overview">
            <article class="hero-copy reveal">
                
                <h1>Aspiring Web Developer</h1>
                <p>
                    Dedicated as Bachelor of Science in Information Systems graduate with a strong foundation in network infrastructure,
                    surveillance systems, web development, and technical support. Experienced in customer service,
                    troubleshooting, and improving operations through technology.
                </p>

                <div class="cta-row">
                    <a class="btn btn-primary" href="#projects">View Experience</a>
                    <a class="btn btn-outline" href="#contact">Contact Me</a>
                    <a class="btn btn-outline" href="{{ $cvPdf ? asset($cvPdf) : '#contact' }}" @if($cvPdf) download @endif>Download CV (PDF)</a>
                </div>

                <div class="kpi-grid">
                    <div class="kpi">
                        <strong>2019-2025</strong>
                        <span>BS Information Systems</span>
                    </div>
                    <div class="kpi">
                        <strong>24/7</strong>
                        <span>Surveillance Setup</span>
                    </div>
                    <div class="kpi">
                        <strong>2024</strong>
                        <span>IT Internship</span>
                    </div>
                </div>
            </article>

            <article class="hero-art reveal">
                <div class="profile-card">
                    <div class="profile-top">
                        <img class="avatar" src="{{ asset('ryandhel.png') }}" onerror="this.onerror=null;this.src='{{ asset('ryandhel.jpg') }}';"
                            alt="Portrait of Ryan Dhel S. Canja">
                        <div>
                            <p class="profile-name">Ryan Dhel S. Canja</p>
                            <p class="profile-role">Entry-Level IT & Web Developer</p>
                            <p class="live-dot">Open for immediate opportunities</p>
                        </div>
                    </div>

                    <div class="mini-grid">
                        <div class="mini">
                            <strong>Location</strong>
                            Sitio Minahang Bato, Brgy. San Isidro, Angono, Rizal, 1930
                        </div>
                        <div class="mini">
                            <strong>Phone</strong>
                            +63 9810 249744
                        </div>
                        <div class="mini">
                            <strong>Email</strong>
                            ryandhelcanja13@gmail.com
                        </div>
                        <div class="mini">
                            <strong>Core Strength</strong>
                            Technical support, networking, customer service
                        </div>
                    </div>
                </div>
            </article>
        </section>

        <section class="section reveal" id="about">
            <h2 class="section-title">Professional Summary</h2>
            <p class="section-subtitle">
                Hands-on learner with practical exposure to customer-facing support, hardware troubleshooting,
                and real-world network and security implementation.
            </p>
            <div class="about-grid">
                <article class="about-panel">
                    I graduated with a <strong>Bachelor of Science in Information Systems</strong> and built my skills in networking,
                    surveillance setup, web development, and IT support. During my internship and academic projects, I worked on
                    lab operations, system maintenance, and campus security solutions.
                    <br><br>
                    I also gained strong communication and problem-resolution skills through customer service work, assisting users
                    with inquiries, payments, returns, and account concerns while delivering clear policy guidance.
                </article>
                <ul class="focus-list">
                    <li>Network Cabling (Cat5e/Cat6)</li>
                    <li>CCTV + DVR Configuration</li>
                    <li>HTML5, CSS3, JavaScript, PHP</li>
                    <li>MySQL + System Maintenance</li>
                </ul>
            </div>
        </section>

        <section class="section reveal" id="projects">
            <h2 class="section-title">Experience & Projects</h2>
            <p class="section-subtitle">
                Practical experience from customer service, internship responsibilities, and technical academic projects.
            </p>
            <div class="project-grid">
                <article class="project-card">
                    <span class="chip">Work Experience</span>
                    <h3>Customer Service Representative (Target Account)</h3>
                    <p>
                        Store Service Representative at ResultsCX supporting Target retail customers with order inquiries,
                        returns, payments, and account concerns while maintaining a positive service experience.
                    </p>
                    <div class="tech-list">
                        <span>ResultsCX</span>
                        <span>Customer Support</span>
                        <span>Issue Resolution</span>
                    </div>
                </article>

                <article class="project-card">
                    <span class="chip">Internship</span>
                    <h3>IT Intern | ACC College, Taytay</h3>
                    <p>
                        Assisted with computer laboratory and library operations, supported technical maintenance,
                        and performed troubleshooting for campus computing facilities (Feb 2024 - May 2024).
                    </p>
                    <div class="tech-list">
                        <span>IT Support</span>
                        <span>Hardware</span>
                        <span>Maintenance</span>
                    </div>
                </article>

                <article class="project-card">
                    <span class="chip">Academic Project</span>
                    <h3>Network Setup & Security System Installation</h3>
                    <p>
                        Designed and implemented a full surveillance setup for ACC College of Taytay, including CCTV installation,
                        Cat5e/Cat6 cabling, and DVR configuration for reliable 24/7 monitoring and recording.
                    </p>
                    <div class="tech-list">
                        <span>CCTV</span>
                        <span>Cat5e/Cat6</span>
                        <span>DVR</span>
                    </div>
                </article>
            </div>
        </section>

        <section class="section reveal" id="skills">
            <h2 class="section-title">Technical Skills</h2>
            <p class="section-subtitle">
                Core technical competencies aligned with entry-level IT support, networking, and web development roles.
            </p>
            <div class="skills-grid">
                <article class="skill-panel">
                    <h3>Networking & Security</h3>
                    <div class="stack">
                        <span>Network Cabling</span>
                        <span>Cat5e/Cat6</span>
                        <span>CCTV Installation</span>
                        <span>DVR Setup</span>
                        <span>24/7 Surveillance</span>
                    </div>
                </article>
                <article class="skill-panel">
                    <h3>Web Development</h3>
                    <div class="stack">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>JavaScript</span>
                        <span>PHP</span>
                        <span>Responsive UI</span>
                    </div>
                </article>
                <article class="skill-panel">
                    <h3>IT Support & Database</h3>
                    <div class="stack">
                        <span>MySQL</span>
                        <span>Troubleshooting</span>
                        <span>System Configuration</span>
                        <span>Technical Maintenance</span>
                        <span>User Support</span>
                    </div>
                </article>
            </div>
        </section>

        <section class="section reveal" id="contact">
            <h2 class="section-title">Education & Contact</h2>
            <p class="section-subtitle">
                If you are hiring for IT support, networking, or junior web development roles, I would be glad to connect.
            </p>
            <div class="contact-grid">
                <article class="contact-card">
                    <p>
                        Character reference is available upon request. I am open to interviews and technical assessments
                        for entry-level roles.
                    </p>
                    <ul class="contact-list">
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

                    <div class="contact-actions">
                        <a class="btn btn-primary" href="{{ $cvPdf ? asset($cvPdf) : '#contact' }}" @if($cvPdf) download @endif>Download CV (PDF)</a>
                    </div>
                </article>

                <article class="contact-form">
                    <h3>Education</h3>
                    <ul class="contact-list">
                        <li>
                            <strong>AMA Computer Learning Center, Taytay</strong>
                            Bachelor of Science in Information Systems (2019 - 2025)
                        </li>
                        <li>
                            <strong>AMA Computer Learning Center Senior High School, Taytay</strong>
                            Information and Communications Technology (2017 - 2019)
                        </li>
                        <li>
                            <strong>Dr. Vivencio B. Villamayor Integrated School, Angono</strong>
                            Junior High School (2013 - 2017)
                        </li>
                        <li>
                            <strong>Joaquin Guido Elementary School, Angono</strong>
                            Elementary (2007 - 2013)
                        </li>
                    </ul>

                    <div class="cert-box">
                        <strong>Certification & Training</strong>
                        Navigating Pathways in the IT-BPM Industry - Metro Rizal IT-BPM Summit (November 26, 2024)
                    </div>
                </article>
            </div>

            <form class="contact-form contact-mail-form" action="{{ route('contact.store') }}" method="post">
                @csrf
                <h3>Send Message Via Email</h3>

                @if(session('mail_success'))
                    <p class="form-alert success">{{ session('mail_success') }}</p>
                @endif

                @if(session('mail_error'))
                    <p class="form-alert error">{{ session('mail_error') }}</p>
                @endif

                @if($errors->any())
                    <p class="form-alert error">{{ $errors->first() }}</p>
                @endif

                <label for="contact_name">Name</label>
                <input id="contact_name" name="name" type="text" value="{{ old('name') }}" placeholder="Your full name" required>

                <label for="contact_email">Email</label>
                <input id="contact_email" name="email" type="email" value="{{ old('email') }}" placeholder="your@email.com" required>

                <label for="contact_subject">Subject</label>
                <input id="contact_subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="Job opportunity / Project inquiry" required>

                <label for="contact_message">Message</label>
                <textarea id="contact_message" name="message" placeholder="Write your message here" required>{{ old('message') }}</textarea>

                <button class="btn btn-primary" type="submit">Send Email</button>
            </form>
        </section>
    </main>

    <footer>
        Copyright {{ date('Y') }} Ryan Canja. Built with Laravel.
    </footer>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const menu = document.getElementById('menu');
        const header = document.querySelector('.site-header');
        const profileCard = document.querySelector('.profile-card');
        const menuLinks = Array.from(document.querySelectorAll('.menu a[href^="#"]'));
        const sections = Array.from(document.querySelectorAll('main section[id]'));

        menuToggle.addEventListener('click', () => {
            menu.classList.toggle('open');
        });

        document.querySelectorAll('.menu a').forEach((link) => {
            link.addEventListener('click', () => {
                menu.classList.remove('open');
            });
        });

        const revealItems = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.2
        });

        revealItems.forEach((item) => observer.observe(item));

        const setActiveSection = () => {
            if (!sections.length || !menuLinks.length) {
                return;
            }

            const marker = window.scrollY + 140;
            let currentId = sections[0].id;

            sections.forEach((section) => {
                if (marker >= section.offsetTop) {
                    currentId = section.id;
                }
            });

            menuLinks.forEach((link) => {
                const target = link.getAttribute('href')?.replace('#', '');
                link.classList.toggle('active', target === currentId);
            });
        };

        const runScrollEffects = () => {
            const scrollY = window.scrollY || window.pageYOffset;
            const maxScroll = document.documentElement.scrollHeight - window.innerHeight;
            const progress = maxScroll > 0 ? Math.min(scrollY / maxScroll, 1) : 0;

            document.documentElement.style.setProperty('--scroll-progress', progress.toFixed(4));

            if (header) {
                header.classList.toggle('scrolled', scrollY > 24);
            }

            if (profileCard) {
                const parallaxShift = Math.min(18, scrollY * 0.05);
                profileCard.style.setProperty('--profile-shift', `${parallaxShift.toFixed(2)}px`);
            }

            setActiveSection();
        };

        let isTicking = false;

        const onScroll = () => {
            if (isTicking) {
                return;
            }

            isTicking = true;
            window.requestAnimationFrame(() => {
                runScrollEffects();
                isTicking = false;
            });
        };

        window.addEventListener('scroll', onScroll, {
            passive: true
        });

        window.addEventListener('resize', runScrollEffects);
        runScrollEffects();
    </script>
</body>

</html>
