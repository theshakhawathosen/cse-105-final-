<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSE-105 Admin — Batch Solution Hub</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tiro+Bangla:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        bg: '#0d0f14',
                        navbar: '#111318',
                        card: '#13161e',
                        input: '#1a1e28',
                        hover: '#1e2232',
                        border: '#1f2333',
                        accent: '#3d7fff',
                        accentH: '#5a94ff',
                        tp: '#e8eaf0',
                        ts: '#7c8090',
                        muted: '#454860',
                        green: '#29d68e',
                        amber: '#f5a623',
                        red: '#ff4d6a',
                        purple: '#a78bfa',
                        teal: '#22d3ee',
                        pink: '#f472b6',
                        coral: '#fb923c'
                    },
                    fontFamily: {
                        poppins: ["Poppins","Tiro Bangla","sans-serif"]
                    }
                }
            }
        }
    </script>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0
        }

        html {
            scroll-behavior: smooth
        }

        body {
            font-family: 'Poppins', "Tiro Bangla",sans-serif;
            background: #0d0f14;
            color: #e8eaf0;
            overflow-x: hidden
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px
        }

        ::-webkit-scrollbar-track {
            background: #0d0f14
        }

        ::-webkit-scrollbar-thumb {
            background: #1f2333;
            border-radius: 4px
        }

        /* ── Variables ── */
        :root {
            --bg: #0d0f14;
            --nb: #111318;
            --card: #13161e;
            --inp: #1a1e28;
            --hov: #1e2232;
            --bdr: #1f2333;
            --acc: #3d7fff;
            --acch: #5a94ff;
            --tp: #e8eaf0;
            --ts: #7c8090;
            --mu: #454860;
            --green: #29d68e;
            --amber: #f5a623;
            --red: #ff4d6a;
            --purple: #a78bfa;
            --teal: #22d3ee;
            --pink: #f472b6;
            --coral: #fb923c;
            --sidebar-w: 240px;
            --sidebar-collapsed: 64px;
            --topbar-h: 60px;
        }

        /* ── Layout ── */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-w);
            background: var(--nb);
            border-right: 1px solid var(--bdr);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: width .3s cubic-bezier(.4, 0, .2, 1);
            overflow: hidden;
        }

        #sidebar.collapsed {
            width: var(--sidebar-collapsed)
        }

        #sidebar.collapsed .nav-label,
        #sidebar.collapsed .sidebar-section-label,
        #sidebar.collapsed .brand-text,
        #sidebar.collapsed .sidebar-footer-text {
            opacity: 0;
            pointer-events: none;
            width: 0;
            overflow: hidden
        }

        #sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 0 0 0 0
        }

        #sidebar.collapsed .nav-item .nav-icon {
            margin: 0
        }

        #sidebar.collapsed .badge-pill {
            display: none
        }

        #topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: rgba(17, 19, 24, .95);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--bdr);
            z-index: 100;
            transition: left .3s cubic-bezier(.4, 0, .2, 1);
            display: flex;
            align-items: center;
            padding: 0 20px;
            gap: 12px;
        }

        #topbar.collapsed {
            left: var(--sidebar-collapsed)
        }

        #main-content {
            margin-left: var(--sidebar-w);
            margin-top: var(--topbar-h);
            padding: 24px;
            min-height: calc(100vh - var(--topbar-h));
            transition: margin-left .3s cubic-bezier(.4, 0, .2, 1);
        }

        #main-content.collapsed {
            margin-left: var(--sidebar-collapsed)
        }

        /* ── Sidebar nav ── */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 14px;
            border-radius: 10px;
            cursor: pointer;
            color: var(--ts);
            font-size: .82rem;
            font-weight: 500;
            transition: all .18s ease;
            white-space: nowrap;
            margin: 1px 8px;
            position: relative;
        }

        .nav-item:hover {
            background: var(--hov);
            color: var(--tp)
        }

        .nav-item.active {
            background: rgba(61, 127, 255, .15);
            color: var(--acc)
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 60%;
            background: var(--acc);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            font-size: .9rem;
            width: 18px;
            text-align: center;
            flex-shrink: 0;
            transition: margin .3s
        }

        .sidebar-section-label {
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--mu);
            padding: 10px 22px 4px;
            transition: opacity .2s, width .3s;
        }

        .badge-pill {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font-size: .58rem;
            font-weight: 700;
            padding: 2px 6px;
            border-radius: 99px;
        }

        /* ── Cards ── */
        .dash-card {
            background: var(--card);
            border: 1px solid var(--bdr);
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .35);
            transition: border-color .25s, box-shadow .25s, transform .25s;
        }

        .dash-card:hover {
            border-color: rgba(61, 127, 255, .28);
            box-shadow: 0 0 28px rgba(61, 127, 255, .12), 0 8px 28px rgba(0, 0, 0, .45);
            transform: translateY(-2px);
        }

        .stat-card {
            position: relative;
            overflow: hidden;
            padding: 18px 20px;
        }

        .stat-card::after {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            opacity: .06;
        }

        /* ── Inputs ── */
        .inp-field {
            background: var(--inp);
            border: 1px solid var(--bdr);
            color: var(--tp);
            border-radius: 10px;
            padding: 9px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: .82rem;
            outline: none;
            width: 100%;
            transition: border-color .2s, box-shadow .2s;
        }

        .inp-field:focus {
            border-color: var(--acc);
            box-shadow: 0 0 0 3px rgba(61, 127, 255, .12)
        }

        .inp-field::placeholder {
            color: var(--mu)
        }

        select.inp-field option {
            background: var(--inp)
        }

        /* ── Buttons ── */
        .btn-primary {
            background: var(--acc);
            color: #fff;
            border: none;
            border-radius: 9px;
            padding: 8px 18px;
            font-family: 'Poppins', sans-serif;
            font-size: .8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 16px rgba(61, 127, 255, .28);
        }

        .btn-primary:hover {
            background: var(--acch);
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(61, 127, 255, .42)
        }

        .btn-ghost {
            background: transparent;
            color: var(--tp);
            border: 1px solid var(--bdr);
            border-radius: 9px;
            padding: 8px 16px;
            font-family: 'Poppins', sans-serif;
            font-size: .8rem;
            font-weight: 500;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-ghost:hover {
            border-color: var(--acc);
            background: rgba(61, 127, 255, .08)
        }

        .btn-danger {
            background: rgba(255, 77, 106, .15);
            color: var(--red);
            border: 1px solid rgba(255, 77, 106, .25);
            border-radius: 9px;
            padding: 6px 14px;
            font-family: 'Poppins', sans-serif;
            font-size: .75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
        }

        .btn-danger:hover {
            background: rgba(255, 77, 106, .25)
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: .8rem;
            transition: all .15s;
            background: var(--inp);
            color: var(--ts);
        }

        .btn-icon:hover {
            background: var(--hov);
            color: var(--tp)
        }

        .btn-icon.edit:hover {
            color: var(--acc);
            background: rgba(61, 127, 255, .12)
        }

        .btn-icon.del:hover {
            color: var(--red);
            background: rgba(255, 77, 106, .12)
        }

        .btn-icon.view:hover {
            color: var(--green);
            background: rgba(41, 214, 142, .12)
        }

        .btn-icon.pub:hover {
            color: var(--amber);
            background: rgba(245, 166, 35, .12)
        }

        /* ── Chips / badges ── */
        .chip {
            font-size: .6rem;
            font-weight: 700;
            letter-spacing: .05em;
            padding: 3px 9px;
            border-radius: 20px;
            text-transform: uppercase
        }

        .chip-blue {
            background: rgba(61, 127, 255, .15);
            color: var(--acc)
        }

        .chip-green {
            background: rgba(41, 214, 142, .15);
            color: var(--green)
        }

        .chip-amber {
            background: rgba(245, 166, 35, .15);
            color: var(--amber)
        }

        .chip-red {
            background: rgba(255, 77, 106, .15);
            color: var(--red)
        }

        .chip-purple {
            background: rgba(167, 139, 250, .15);
            color: var(--purple)
        }

        .chip-teal {
            background: rgba(34, 211, 238, .15);
            color: var(--teal)
        }

        .chip-muted {
            background: rgba(69, 72, 96, .25);
            color: var(--mu)
        }

        /* ── Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse
        }

        .data-table thead th {
            background: var(--inp);
            color: var(--ts);
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .07em;
            text-transform: uppercase;
            padding: 10px 14px;
            border-bottom: 1px solid var(--bdr);
            text-align: left;
        }

        .data-table thead th:first-child {
            border-radius: 10px 0 0 0
        }

        .data-table thead th:last-child {
            border-radius: 0 10px 0 0
        }

        .data-table tbody tr {
            border-bottom: 1px solid rgba(31, 35, 51, .6);
            transition: background .15s
        }

        .data-table tbody tr:hover {
            background: rgba(30, 34, 50, .5)
        }

        .data-table tbody td {
            padding: 11px 14px;
            font-size: .78rem;
            color: var(--tp)
        }

        .data-table tbody tr:last-child {
            border-bottom: none
        }

        /* ── Progress ── */
        .progress {
            background: var(--bdr);
            border-radius: 99px;
            overflow: hidden
        }

        .progress-fill {
            height: 100%;
            border-radius: 99px;
            transition: width 1.2s ease
        }

        /* ── Modal ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .7);
            backdrop-filter: blur(6px);
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all
        }

        .modal-box {
            background: var(--card);
            border: 1px solid var(--bdr);
            border-radius: 18px;
            box-shadow: 0 24px 80px rgba(0, 0, 0, .6);
            width: 100%;
            max-width: 520px;
            transform: translateY(20px) scale(.97);
            transition: transform .25s;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1)
        }

        /* ── Mobile sidebar overlay ── */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, .6);
            z-index: 150;
        }

        #sidebar-overlay.show {
            display: block
        }

        /* ── Animations ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(.85)
            }

            to {
                opacity: 1;
                transform: scale(1)
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1
            }

            50% {
                opacity: .5
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-10px)
            }

            to {
                opacity: 1;
                transform: translateX(0)
            }
        }

        .fade-up {
            animation: fadeUp .5s ease forwards;
            opacity: 0
        }

        .fade-up-d1 {
            animation-delay: .05s
        }

        .fade-up-d2 {
            animation-delay: .1s
        }

        .fade-up-d3 {
            animation-delay: .15s
        }

        .fade-up-d4 {
            animation-delay: .2s
        }

        .fade-up-d5 {
            animation-delay: .25s
        }

        .fade-up-d6 {
            animation-delay: .3s
        }

        .fade-up-d7 {
            animation-delay: .35s
        }

        .fade-up-d8 {
            animation-delay: .4s
        }

        .pulse-anim {
            animation: pulse 2.5s ease-in-out infinite
        }

        .slide-in {
            animation: slideIn .4s ease forwards;
            opacity: 0
        }

        /* ── Section heading ── */
        .section-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px
        }

        .section-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--tp);
            display: flex;
            align-items: center;
            gap: 8px
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(61, 127, 255, .1);
            border: 1px solid rgba(61, 127, 255, .2);
            color: var(--acc);
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 99px;
        }

        /* ── Chart bars ── */
        .chart-bar {
            background: rgba(61, 127, 255, .15);
            border-radius: 4px 4px 0 0;
            transition: all .3s ease;
            cursor: pointer;
            position: relative;
        }

        .chart-bar:hover {
            background: rgba(61, 127, 255, .35)
        }

        .chart-bar-inner {
            background: linear-gradient(180deg, var(--acc), rgba(61, 127, 255, .4));
            border-radius: 4px 4px 0 0;
            width: 100%;
            transition: height 1.2s cubic-bezier(.34, 1.56, .64, 1);
        }

        /* ── Donut ── */
        .donut-ring {
            transform: rotate(-90deg);
            transform-origin: 50% 50%
        }

        /* ── Activity timeline ── */
        .timeline-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: .75rem;
        }

        .timeline-line {
            width: 1px;
            background: var(--bdr);
            flex-grow: 1;
            margin: 2px auto
        }

        /* ── Dropdown ── */
        .dropdown-menu {
            position: absolute;
            background: var(--card);
            border: 1px solid var(--bdr);
            border-radius: 12px;
            box-shadow: 0 16px 48px rgba(0, 0, 0, .5);
            min-width: 180px;
            z-index: 300;
            opacity: 0;
            pointer-events: none;
            transform: translateY(8px);
            transition: opacity .2s, transform .2s;
        }

        .dropdown-menu.open {
            opacity: 1;
            pointer-events: all;
            transform: translateY(0)
        }

        .dropdown-item {
            padding: 8px 14px;
            font-size: .8rem;
            color: var(--ts);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 8px;
            margin: 3px 4px;
            transition: all .15s;
        }

        .dropdown-item:hover {
            background: var(--hov);
            color: var(--tp)
        }

        /* ── Search bar ── */
        .search-bar {
            background: var(--inp);
            border: 1px solid var(--bdr);
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 0 14px;
            flex: 1;
            max-width: 320px;
            height: 36px;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-bar:focus-within {
            border-color: var(--acc);
            box-shadow: 0 0 0 3px rgba(61, 127, 255, .1)
        }

        .search-bar input {
            background: none;
            border: none;
            outline: none;
            color: var(--tp);
            font-family: 'Poppins', sans-serif;
            font-size: .8rem;
            flex: 1
        }

        .search-bar input::placeholder {
            color: var(--mu)
        }

        /* ── Quick action cards ── */
        .qa-card {
            background: var(--inp);
            border: 1px solid var(--bdr);
            border-radius: 12px;
            padding: 12px 14px;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .qa-card:hover {
            border-color: rgba(61, 127, 255, .4);
            background: var(--hov);
            transform: translateY(-2px)
        }

        /* ── Feedback card ── */
        .fb-card {
            background: var(--inp);
            border: 1px solid var(--bdr);
            border-radius: 12px;
            padding: 14px;
            transition: border-color .2s;
        }

        .fb-card:hover {
            border-color: rgba(61, 127, 255, .3)
        }

        /* ── Grid ── */
        @media(max-width:1024px) {
            #sidebar {
                transform: translateX(-100%);
                width: var(--sidebar-w) !important
            }

            #sidebar.mobile-open {
                transform: translateX(0)
            }

            #topbar,
            #main-content {
                left: 0 !important;
                margin-left: 0 !important
            }

            #topbar {
                left: 0
            }

            #main-content {
                margin-left: 0 !important;
                padding: 16px
            }
        }

        @media(max-width:640px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr) !important
            }

            .qa-grid {
                grid-template-columns: repeat(2, 1fr) !important
            }
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <!-- ═══════════════ SIDEBAR ═══════════════ -->
    <div id="sidebar-overlay" onclick="closeMobileSidebar()"></div>
    @include('layouts.admin.sidebar')

    <!-- ═══════════════ TOPBAR ═══════════════ -->
    <header id="topbar">
        <!-- Hamburger -->
        <button class="btn-icon flex-shrink-0" id="sidebar-toggle" onclick="toggleSidebar()">
            <i class="fas fa-bars text-sm"></i>
        </button>

        <!-- Search -->
        <div class="search-bar">
            <i class="fas fa-search text-muted text-xs"></i>
            <input type="text" placeholder="Search students, notices, assignments...">
            <span class="text-muted text-[10px] font-medium border border-border rounded px-1.5 py-0.5">⌘K</span>
        </div>

        <div class="flex items-center gap-2 ml-auto">
            <!-- Notif -->
            <div class="relative">
                @include('layouts.admin.notification')
            </div>

            <!-- Admin profile -->
            <div class="relative">
                <button
                    class="flex items-center gap-2 bg-input border border-border rounded-xl px-3 py-1.5 cursor-pointer hover:border-accent transition-colors"
                    onclick="toggleDropdown('profile-dd')">
                    @if (Auth::user()->photo)
                        <div
                            class="w-6 h-6 rounded-lg bg-accent flex items-center justify-center text-white text-[10px] font-bold">
                            <img src="{{ asset('storage/man.png') }}" alt="logo">
                        </div>
                    @else
                        <div
                            class="w-6 h-6 rounded-lg bg-accent flex items-center justify-center text-white text-[10px] font-bold">
                            A</div>
                    @endif

                    <span class="text-tp text-xs font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-ts text-[10px]"></i>
                </button>
                <div class="dropdown-menu" id="profile-dd" style="right:0;top:42px">
                    <div class="p-3 border-b border-border">
                        <div class="text-tp text-xs font-semibold">Admin</div>
                        <div class="text-ts text-[10px]">{{ auth::user()->email ?? 'N/A' }}</div>
                    </div>
                    <div class="p-2">
                        <a href="{{ route('admin.profile') }}" class="dropdown-item"><i
                                class="fas fa-user text-xs"></i>My Profile</a>
                        <div class="dropdown-item"><i class="fas fa-cog text-xs"></i>Settings</div>
                        <a href="{{ route('admin.change-password') }}" class="dropdown-item"><i
                                class="fas fa-key text-xs"></i>Password</a>
                        <a href="{{ route('admin.logout') }}" class="dropdown-item" style="color:var(--red)"><i
                                class="fas fa-sign-out-alt text-xs"></i>Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
