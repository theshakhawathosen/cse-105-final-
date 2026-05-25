<!doctype html>
<html lang="en">

<head>
    <!-- ═══ SEO META ═══ -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="CSE-105 Batch Solution Hub — Student Dashboard for notices, assignments, lab reports, routines and more." />
    <meta name="robots" content="noindex, nofollow" />
    <title>@yield('title','CSE-105 Batch Solution Hub')</title>

    <!-- ═══ FONTS & ICONS ═══ -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- ═══ TAILWIND CDN ═══ -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        /* ── Tailwind custom config ── */
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ["Poppins", "sans-serif"]
                    },
                    colors: {
                        base: "#0d0f14",
                        nav: "#111318",
                        card: "#13161e",
                        input: "#1a1e28",
                        hover: "#1e2232",
                        bdr: "#1f2333",
                        accent: "#3d7fff",
                        ahover: "#5a94ff",
                        prim: "#e8eaf0",
                        sec: "#7c8090",
                        hint: "#454860",
                        grn: "#29d68e",
                        amb: "#f5a623",
                        red: "#ff4d6a",
                        pur: "#a78bfa",
                        tel: "#22d3ee",
                        pnk: "#f472b6",
                        crl: "#fb923c",
                    },
                    keyframes: {
                        fadeUp: {
                            from: {
                                opacity: 0,
                                transform: "translateY(14px)"
                            },
                            to: {
                                opacity: 1,
                                transform: "translateY(0)"
                            },
                        },
                        tickerScroll: {
                            "0%": {
                                transform: "translateX(100vw)"
                            },
                            "100%": {
                                transform: "translateX(-100%)"
                            },
                        },
                    },
                    animation: {
                        fadeUp: "fadeUp 0.4s ease both",
                        ticker: "tickerScroll 28s linear infinite",
                    },
                },
            },
        };
    </script>

    <!-- ═══ CUSTOM CSS (only what Tailwind can't do inline) ═══ -->
    <style>
        /* Base font */
        * {
            font-family: "Poppins", sans-serif;
            box-sizing: border-box;
        }

        /* Logo gradient text */
        .logo-text {
            background: linear-gradient(135deg, #e8eaf0 40%, #3d7fff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Ticker animation */
        .ticker-track {
            animation: tickerScroll 32s linear infinite;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .ticker-track:hover {
            animation-play-state: paused;
        }

        @keyframes tickerScroll {
            0% {
                transform: translateX(100vw);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Stat cards stagger */
        .stat-card:nth-child(1) {
            animation-delay: 0.05s;
        }

        .stat-card:nth-child(2) {
            animation-delay: 0.1s;
        }

        .stat-card:nth-child(3) {
            animation-delay: 0.15s;
        }

        .stat-card:nth-child(4) {
            animation-delay: 0.2s;
        }

        .stat-card:nth-child(5) {
            animation-delay: 0.25s;
        }

        .stat-card:nth-child(6) {
            animation-delay: 0.3s;
        }

        .stat-card:nth-child(7) {
            animation-delay: 0.35s;
        }

        .stat-card:nth-child(8) {
            animation-delay: 0.4s;
        }

        /* Thin top accent on topnav */
        .topnav-accent::before {
            content: "";
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: #1f2333;
        }

        /* Profile dropdown open animation */
        .profile-dropdown {
            opacity: 0;
            transform: translateY(-8px);
            pointer-events: none;
            transition:
                opacity 0.22s ease,
                transform 0.22s ease;
        }

        .profile-dropdown.open {
            opacity: 1;
            transform: translateY(0);
            pointer-events: all;
        }

        /* Active tab underline */
        .tab-link {
            border-bottom: 2px solid transparent;
            transition:
                color 0.22s,
                border-color 0.22s;
        }

        .tab-link.active {
            color: #3d7fff !important;
            border-bottom-color: #3d7fff;
        }

        .tab-link:hover {
            color: #e8eaf0 !important;
        }

        /* Mobile sidebar transition */
        .mob-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .mob-sidebar.open {
            transform: translateX(0);
        }

        .mob-overlay {
            opacity: 0;
            transition: opacity 0.22s ease;
        }

        .mob-overlay.open {
            opacity: 1;
        }

        /* Scrollbars hidden */
        .no-scroll::-webkit-scrollbar {
            display: none;
        }

        .no-scroll {
            scrollbar-width: none;
        }

        /* Card top glow on hover */
        .stat-card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }

        /* Notice row click flash */
        .notice-row:active {
            background: rgba(61, 127, 255, 0.1) !important;
        }

        /* Poll bar animation */
        .poll-bar {
            transition: width 0.8s ease;
        }

        /* Notif item hover */
        .notif-item:hover {
            background: rgba(30, 34, 50, 0.9) !important;
        }

        /* Mob nav link active */
        .mob-nav-link.active {
            color: #3d7fff;
            border-left-color: #3d7fff;
            background: rgba(61, 127, 255, 0.1);
        }

        .mob-nav-link:hover {
            color: #e8eaf0;
            background: rgba(30, 34, 50, 0.9);
        }

        /* fadeUp animation */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeUp {
            animation: fadeUp 0.4s ease both;
        }
    </style>
</head>

<body class="bg-base text-prim min-h-screen overflow-x-hidden">
    <!-- ═══════════════════════════════════════════════════
     MOBILE OVERLAY
═══════════════════════════════════════════════════ -->
    <div id="mobOverlay" class="mob-overlay fixed inset-0 bg-black/55 z-[1050] hidden" onclick="closeMobMenu()"></div>

    <!-- ═══════════════════════════════════════════════════
     MOBILE SIDEBAR DRAWER
═══════════════════════════════════════════════════ -->
        @include('layouts.student.mobile-sidebar')
    <!-- ═══════════════════════════════════════════════════
     TOP NAVIGATION BAR  (fixed, h-14 = 56px)
═══════════════════════════════════════════════════ -->
        @include('layouts.student.top-navbar')

    <!-- ═══════════════════════════════════════════════════
     NOTICE TICKER BAR  (fixed, top-14 = 56px, h-9 = 36px)
═══════════════════════════════════════════════════ -->
        @include('layouts.student.notice-track-bar')

    <!-- ═══════════════════════════════════════════════════
     TAB NAVIGATION  (fixed, top-23 = 56+36=92px, h-11 = 44px)
═══════════════════════════════════════════════════ -->
        @include('layouts.student.tab-navigation')

    <!-- ═══════════════════════════════════════════════════
     MAIN PAGE BODY
     top offset = 56 (topnav) + 36 (notice) + 44 (tabnav) = 136px
═══════════════════════════════════════════════════ -->
