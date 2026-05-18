<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSE-105 Batch Solution Hub</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        accentHover: '#5a94ff',
        textPrimary: '#e8eaf0',
        textSecondary: '#7c8090',
        muted: '#454860',
        green: '#29d68e',
        amber: '#f5a623',
        red: '#ff4d6a',
        purple: '#a78bfa',
        teal: '#22d3ee',
        pink: '#f472b6',
        coral: '#fb923c',
      },
      fontFamily: { poppins: ['Poppins', 'sans-serif'] },
      borderRadius: { xl: '12px', '2xl': '16px', '3xl': '24px' },
      boxShadow: {
        card: '0 4px 24px rgba(0,0,0,0.4)',
        glow: '0 0 30px rgba(61,127,255,0.18)',
        glowHover: '0 0 40px rgba(61,127,255,0.35)',
        btn: '0 4px 20px rgba(61,127,255,0.3)',
      }
    }
  }
}
</script>
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body {
    font-family: 'Poppins', sans-serif;
    background: #0d0f14;
    color: #e8eaf0;
    overflow-x: hidden;
  }

  /* ── Scrollbar ── */
  ::-webkit-scrollbar { width: 6px; }
  ::-webkit-scrollbar-track { background: #0d0f14; }
  ::-webkit-scrollbar-thumb { background: #1f2333; border-radius: 4px; }

  /* ── Navbar ── */
  .navbar {
    background: rgba(17,19,24,0.92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid #1f2333;
    position: fixed; top: 0; width: 100%; z-index: 1000;
  }
  .nav-link {
    color: #7c8090; font-size: 0.875rem; font-weight: 500;
    transition: color .2s ease; cursor: pointer;
    text-decoration: none;
  }
  .nav-link:hover { color: #e8eaf0; }
  .btn-primary {
    background: #3d7fff; color: #fff;
    font-weight: 600; font-size: 0.8rem; letter-spacing: 0.02em;
    border-radius: 10px; padding: 7px 18px;
    border: none; cursor: pointer;
    transition: background .2s, box-shadow .2s, transform .15s;
    box-shadow: 0 4px 18px rgba(61,127,255,0.25);
  }
  .btn-primary:hover {
    background: #5a94ff;
    box-shadow: 0 6px 28px rgba(61,127,255,0.45);
    transform: translateY(-1px);
  }
  .btn-ghost {
    background: transparent; color: #e8eaf0;
    font-weight: 500; font-size: 0.8rem; letter-spacing: 0.02em;
    border-radius: 10px; padding: 7px 18px;
    border: 1px solid #1f2333; cursor: pointer;
    transition: border-color .2s, background .2s, transform .15s;
  }
  .btn-ghost:hover { border-color: #3d7fff; background: rgba(61,127,255,0.08); transform: translateY(-1px); }

  /* ── Grid Pattern ── */
  .grid-bg {
    background-image:
      linear-gradient(rgba(61,127,255,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(61,127,255,0.03) 1px, transparent 1px);
    background-size: 44px 44px;
  }

  /* ── Hero Glow ── */
  .hero-glow {
    position: absolute; border-radius: 50%; filter: blur(90px); pointer-events: none;
  }
  .glow-blue { background: rgba(61,127,255,0.13); width: 700px; height: 600px; top: -120px; left: -100px; }
  .glow-purple { background: rgba(167,139,250,0.07); width: 500px; height: 400px; top: 80px; right: -80px; }
  .glow-center { background: rgba(61,127,255,0.06); width: 900px; height: 400px; top: 30%; left: 50%; transform: translateX(-50%); }

  /* ── Card ── */
  .dash-card {
    background: #13161e;
    border: 1px solid #1f2333;
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.4);
    transition: border-color .25s, box-shadow .25s, transform .25s;
  }
  .dash-card:hover {
    border-color: rgba(61,127,255,0.35);
    box-shadow: 0 0 32px rgba(61,127,255,0.15), 0 8px 32px rgba(0,0,0,0.5);
    transform: translateY(-4px);
  }
  .feature-card { position: relative; overflow: hidden; }
  .feature-card::before {
    content: '';
    position: absolute; inset: 0; border-radius: 16px;
    background: linear-gradient(135deg, rgba(61,127,255,0.07), transparent);
    opacity: 0; transition: opacity .3s;
  }
  .feature-card:hover::before { opacity: 1; }

  /* ── Stats badge ── */
  .stat-badge {
    background: #1a1e28;
    border: 1px solid #1f2333;
    border-radius: 12px;
    padding: 10px 14px;
    display: flex; align-items: center; gap: 10px;
  }

  /* ── Tag/Chip ── */
  .chip {
    font-size: 0.65rem; font-weight: 600; letter-spacing: 0.06em;
    padding: 3px 9px; border-radius: 20px; text-transform: uppercase;
  }
  .chip-blue { background: rgba(61,127,255,0.15); color: #3d7fff; }
  .chip-green { background: rgba(41,214,142,0.15); color: #29d68e; }
  .chip-amber { background: rgba(245,166,35,0.15); color: #f5a623; }
  .chip-red { background: rgba(255,77,106,0.15); color: #ff4d6a; }
  .chip-purple { background: rgba(167,139,250,0.15); color: #a78bfa; }
  .chip-teal { background: rgba(34,211,238,0.15); color: #22d3ee; }

  /* ── Progress bar ── */
  .progress { background: #1f2333; border-radius: 99px; overflow: hidden; }
  .progress-fill { height: 100%; border-radius: 99px; transition: width 1.2s ease; }

  /* ── Mock Dashboard ── */
  .mock-screen {
    background: #0d0f14;
    border: 1px solid #1f2333;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 30px 80px rgba(0,0,0,0.7), 0 0 60px rgba(61,127,255,0.1);
  }
  .mock-sidebar {
    background: #111318;
    border-right: 1px solid #1f2333;
  }
  .mock-topbar {
    background: #111318;
    border-bottom: 1px solid #1f2333;
    padding: 10px 16px;
    display: flex; align-items: center; justify-content: space-between;
  }
  .sidebar-item {
    display: flex; align-items: center; gap: 8px;
    padding: 7px 12px; border-radius: 10px;
    font-size: 0.68rem; font-weight: 500; color: #7c8090;
    cursor: pointer; transition: all .2s; margin-bottom: 2px;
  }
  .sidebar-item.active { background: rgba(61,127,255,0.15); color: #3d7fff; }
  .sidebar-item:hover:not(.active) { background: #1e2232; color: #e8eaf0; }

  /* ── Floating animation ── */
  @keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-14px) rotate(0.5deg); }
  }
  .float-anim { animation: float 5s ease-in-out infinite; }

  /* ── Pulse dot ── */
  @keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.85); }
  }
  .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }

  /* ── Fade Up ── */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .fade-up { opacity: 0; transform: translateY(30px); }
  .fade-up.visible { animation: fadeUp 0.6s ease forwards; }

  /* ── Accordion ── */
  .faq-item { border-radius: 14px; overflow: hidden; }
  .faq-body { max-height: 0; overflow: hidden; transition: max-height .4s ease, padding .3s ease; }
  .faq-body.open { max-height: 300px; }
  .faq-btn { width: 100%; text-align: left; background: none; border: none; cursor: pointer; }
  .faq-icon { transition: transform .3s ease; }
  .faq-icon.rotated { transform: rotate(180deg); }

  /* ── Mobile Menu ── */
  .mobile-menu {
    background: rgba(17,19,24,0.98);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid #1f2333;
    max-height: 0; overflow: hidden;
    transition: max-height .35s ease;
  }
  .mobile-menu.open { max-height: 400px; }

  /* ── Testimonial ── */
  .avatar-ring {
    background: linear-gradient(135deg, #3d7fff, #a78bfa);
    padding: 2px; border-radius: 50%; display: inline-block;
  }
  .avatar-inner {
    background: #13161e; border-radius: 50%;
    width: 44px; height: 44px;
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; font-size: 0.9rem;
  }

  /* ── Divider glow ── */
  .divider-glow {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(61,127,255,0.3), transparent);
  }

  /* ── Section label ── */
  .section-label {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(61,127,255,0.1); border: 1px solid rgba(61,127,255,0.2);
    color: #3d7fff; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.1em;
    text-transform: uppercase; padding: 5px 14px; border-radius: 99px;
  }

  /* ── Notification dot ── */
  .notif-dot {
    width: 7px; height: 7px; border-radius: 50%; background: #ff4d6a;
    position: absolute; top: -1px; right: -1px;
  }

  /* star rating */
  .stars { color: #f5a623; font-size: 0.75rem; }

  /* CTA big */
  .btn-hero {
    font-size: 0.9rem; font-weight: 600; padding: 12px 28px;
    border-radius: 12px; cursor: pointer;
    transition: all .2s ease;
  }
  .btn-hero-primary {
    background: #3d7fff; color: #fff;
    box-shadow: 0 6px 30px rgba(61,127,255,0.4);
  }
  .btn-hero-primary:hover {
    background: #5a94ff; transform: translateY(-2px);
    box-shadow: 0 10px 40px rgba(61,127,255,0.55);
  }
  .btn-hero-outline {
    background: transparent; color: #e8eaf0;
    border: 1px solid #1f2333;
  }
  .btn-hero-outline:hover {
    border-color: #3d7fff; background: rgba(61,127,255,0.08);
    transform: translateY(-2px);
  }

  /* Wave separator */
  .section-sep { height: 1px; background: #1f2333; }

  /* Glow icon box */
  .icon-box {
    width: 46px; height: 46px; border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem; flex-shrink: 0;
  }

  /* poll bar */
  @keyframes barGrow { from { width: 0; } }

  /* smooth scroll offset */
  section[id] { scroll-margin-top: 72px; }

  @media (max-width: 768px) {
    .hero-glow { display: none; }
  }
</style>
</head>
<body>

<!-- ═══════════════ NAVBAR ═══════════════ -->
<nav class="navbar">
  <div class="max-w-7xl mx-auto px-5 py-3 flex items-center justify-between">
    <!-- Logo -->
    <a href="#" class="flex items-center gap-2.5 no-underline">
      <div class="w-8 h-8 rounded-xl bg-accent flex items-center justify-center text-white text-sm font-bold" style="box-shadow:0 4px 16px rgba(61,127,255,0.4);">
        <i class="fas fa-graduation-cap text-xs"></i>
      </div>
      <div class="leading-tight">
        <div class="text-textPrimary font-bold text-sm tracking-wide">CSE-105</div>
        <div class="text-textSecondary text-[10px] font-medium -mt-0.5">Batch Solution Hub</div>
      </div>
    </a>

    <!-- Desktop Nav -->
    <div class="hidden md:flex items-center gap-6">
      <a href="#home" class="nav-link">Home</a>
      <a href="#features" class="nav-link">Features</a>
      <a href="#preview" class="nav-link">Dashboard</a>
      <a href="#about" class="nav-link">About</a>
      <a href="#contact" class="nav-link">Contact</a>
    </div>

    <!-- Desktop CTA -->
    <div class="hidden md:flex items-center gap-2.5">
      <a href="{{ route('login') }}" class="btn-ghost">Login</a>
      <a href="{{ route('login') }}" class="btn-primary">Get Started <i class="fas fa-arrow-right ml-1 text-xs"></i></a>
    </div>

    <!-- Mobile Hamburger -->
    <button class="md:hidden text-textSecondary hover:text-textPrimary transition-colors" onclick="toggleMobile()">
      <i class="fas fa-bars text-lg" id="hamburger-icon"></i>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div class="mobile-menu md:hidden" id="mobile-menu">
    <div class="px-5 py-4 flex flex-col gap-3">
      <a href="#home" class="nav-link text-sm py-2 border-b border-border" onclick="toggleMobile()">Home</a>
      <a href="#features" class="nav-link text-sm py-2 border-b border-border" onclick="toggleMobile()">Features</a>
      <a href="#preview" class="nav-link text-sm py-2 border-b border-border" onclick="toggleMobile()">Dashboard</a>
      <a href="#about" class="nav-link text-sm py-2 border-b border-border" onclick="toggleMobile()">About</a>
      <a href="#contact" class="nav-link text-sm py-2" onclick="toggleMobile()">Contact</a>
      <div class="flex gap-2 pt-2">
        <button class="btn-ghost flex-1">Login</button>
        <button class="btn-primary flex-1">Get Started</button>
      </div>
    </div>
  </div>
</nav>

<!-- ═══════════════ HERO ═══════════════ -->
<section id="home" class="relative min-h-screen flex items-center pt-20 grid-bg overflow-hidden">
  <div class="hero-glow glow-blue"></div>
  <div class="hero-glow glow-purple"></div>
  <div class="hero-glow glow-center"></div>

  <div class="max-w-7xl mx-auto px-5 py-16 w-full">
    <div class="flex flex-col lg:flex-row items-center gap-14 lg:gap-10">

      <!-- Left Text -->
      <div class="flex-1 text-center lg:text-left fade-up" style="animation-delay:0s;">
        <div class="section-label mb-5 inline-flex">
          <span class="pulse-dot w-1.5 h-1.5 rounded-full bg-accent inline-block"></span>
          CSE-105 · BATCH 2024
        </div>

        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight mb-5">
          Your Complete<br>
          <span style="background:linear-gradient(90deg,#3d7fff,#a78bfa,#22d3ee);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
            Batch Solution
          </span><br>
          Platform
        </h1>

        <p class="text-textSecondary text-base md:text-lg leading-relaxed max-w-xl mx-auto lg:mx-0 mb-8">
          Access notices, assignments, lab reports, routines, resources and everything your batch needs — all organized in one beautiful place.
        </p>

        <!-- Stats row -->
        <div class="flex flex-wrap gap-4 justify-center lg:justify-start mb-8">
          <div class="stat-badge"><i class="fas fa-users text-accent text-xs"></i><span class="text-textPrimary text-xs font-semibold">150+ Students</span></div>
          <div class="stat-badge"><i class="fas fa-book-open text-green text-xs"></i><span class="text-textPrimary text-xs font-semibold">8 Courses</span></div>
          <div class="stat-badge"><i class="fas fa-star text-amber text-xs"></i><span class="text-textPrimary text-xs font-semibold">4.9 Rated</span></div>
        </div>

        <div class="flex flex-wrap gap-3 justify-center lg:justify-start">
          <button class="btn-hero btn-hero-primary">
            <i class="fas fa-th-large mr-2 text-sm"></i>Explore Dashboard
          </button>
          <button class="btn-hero btn-hero-outline">
            <i class="fas fa-user-plus mr-2 text-sm"></i>Join Batch
          </button>
        </div>
      </div>

      <!-- Right Mock Preview -->
      <div class="flex-1 w-full max-w-lg lg:max-w-none float-anim">
        <div class="mock-screen" style="max-height:440px;overflow:hidden;">
          <!-- Top bar -->
          <div class="mock-topbar">
            <div class="flex items-center gap-2">
              <div class="w-3 h-3 rounded-full bg-red opacity-70"></div>
              <div class="w-3 h-3 rounded-full bg-amber opacity-70"></div>
              <div class="w-3 h-3 rounded-full bg-green opacity-70"></div>
            </div>
            <div class="flex items-center gap-2 bg-input rounded-lg px-3 py-1.5">
              <i class="fas fa-lock text-muted text-[10px]"></i>
              <span class="text-muted text-[10px] font-medium">cse105hub.app/dashboard</span>
            </div>
            <div class="flex items-center gap-2">
              <div class="relative">
                <div class="w-7 h-7 rounded-lg bg-input flex items-center justify-center text-textSecondary text-xs">
                  <i class="fas fa-bell"></i>
                </div>
                <div class="notif-dot"></div>
              </div>
              <div class="w-7 h-7 rounded-lg bg-accent flex items-center justify-center text-white text-[10px] font-bold">R</div>
            </div>
          </div>

          <!-- Dashboard body -->
          <div class="flex" style="height:390px;">
            <!-- Sidebar -->
            <div class="mock-sidebar w-36 p-3 flex-shrink-0 hidden sm:block">
              <div class="text-muted text-[9px] font-semibold uppercase tracking-wider mb-2 px-2">Menu</div>
              <div class="sidebar-item active"><i class="fas fa-th-large text-[10px]"></i><span>Dashboard</span></div>
              <div class="sidebar-item"><i class="fas fa-bullhorn text-[10px]"></i><span>Notices</span></div>
              <div class="sidebar-item"><i class="fas fa-tasks text-[10px]"></i><span>Assignments</span></div>
              <div class="sidebar-item"><i class="fas fa-flask text-[10px]"></i><span>Lab Reports</span></div>
              <div class="sidebar-item"><i class="fas fa-calendar text-[10px]"></i><span>Routine</span></div>
              <div class="sidebar-item"><i class="fas fa-poll text-[10px]"></i><span>Polls</span></div>
              <div class="sidebar-item"><i class="fas fa-book text-[10px]"></i><span>Resources</span></div>
              <div class="sidebar-item"><i class="fas fa-chalkboard-teacher text-[10px]"></i><span>Teachers</span></div>
              <div class="mt-3 pt-3 border-t border-border">
                <div class="text-muted text-[9px] font-semibold uppercase tracking-wider mb-2 px-2">Account</div>
                <div class="sidebar-item"><i class="fas fa-user text-[10px]"></i><span>Profile</span></div>
                <div class="sidebar-item"><i class="fas fa-cog text-[10px]"></i><span>Settings</span></div>
              </div>
            </div>

            <!-- Main content -->
            <div class="flex-1 p-3 overflow-hidden bg-bg" style="font-size:0.65rem;">
              <!-- Greeting -->
              <div class="flex items-center justify-between mb-3">
                <div>
                  <div class="text-textPrimary font-semibold text-xs">Good morning, Rahim 👋</div>
                  <div class="text-textSecondary" style="font-size:0.6rem;">CSE-105 · Roll: 2024331008</div>
                </div>
                <div class="chip chip-green">Active</div>
              </div>

              <!-- Stats row -->
              <div class="grid grid-cols-4 gap-1.5 mb-3">
                <div class="bg-card border border-border rounded-xl p-2 text-center">
                  <div class="text-accent font-bold text-sm">12</div>
                  <div class="text-muted" style="font-size:0.58rem;">Notices</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-2 text-center">
                  <div class="text-amber font-bold text-sm">5</div>
                  <div class="text-muted" style="font-size:0.58rem;">Pending</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-2 text-center">
                  <div class="text-green font-bold text-sm">8</div>
                  <div class="text-muted" style="font-size:0.58rem;">Submitted</div>
                </div>
                <div class="bg-card border border-border rounded-xl p-2 text-center">
                  <div class="text-purple font-bold text-sm">3</div>
                  <div class="text-muted" style="font-size:0.58rem;">Lab Due</div>
                </div>
              </div>

              <!-- Two column content -->
              <div class="grid grid-cols-2 gap-2">
                <!-- Notices -->
                <div class="bg-card border border-border rounded-xl p-2.5">
                  <div class="flex items-center justify-between mb-2">
                    <span class="text-textPrimary font-semibold" style="font-size:0.65rem;"><i class="fas fa-bullhorn text-accent mr-1"></i>Latest Notices</span>
                    <span class="text-accent" style="font-size:0.58rem;">View all</span>
                  </div>
                  <div class="space-y-1.5">
                    <div class="bg-input rounded-lg p-1.5">
                      <div class="text-textPrimary" style="font-size:0.6rem;font-weight:500;">Midterm Schedule Released</div>
                      <div class="text-muted" style="font-size:0.55rem;">2 hours ago · Academic</div>
                    </div>
                    <div class="bg-input rounded-lg p-1.5">
                      <div class="text-textPrimary" style="font-size:0.6rem;font-weight:500;">Lab Makeup Class — Fri</div>
                      <div class="text-muted" style="font-size:0.55rem;">Yesterday · Lab</div>
                    </div>
                    <div class="bg-input rounded-lg p-1.5">
                      <div class="text-textPrimary" style="font-size:0.6rem;font-weight:500;">Assignment 3 Deadline Ext.</div>
                      <div class="text-muted" style="font-size:0.55rem;">2 days ago · Assignment</div>
                    </div>
                  </div>
                </div>

                <!-- Assignments + Poll -->
                <div class="space-y-2">
                  <!-- Assignment -->
                  <div class="bg-card border border-border rounded-xl p-2.5">
                    <div class="text-textPrimary font-semibold mb-1.5" style="font-size:0.65rem;"><i class="fas fa-tasks text-amber mr-1"></i>Upcoming</div>
                    <div class="space-y-1">
                      <div class="flex items-center justify-between">
                        <span class="text-textSecondary" style="font-size:0.6rem;">DS Assignment #3</span>
                        <span class="chip chip-red" style="font-size:0.5rem;padding:2px 6px;">2d left</span>
                      </div>
                      <div class="progress h-1"><div class="progress-fill bg-accent" style="width:65%;"></div></div>
                      <div class="flex items-center justify-between">
                        <span class="text-textSecondary" style="font-size:0.6rem;">OOP Lab Report</span>
                        <span class="chip chip-amber" style="font-size:0.5rem;padding:2px 6px;">5d left</span>
                      </div>
                      <div class="progress h-1"><div class="progress-fill bg-purple" style="width:30%;"></div></div>
                    </div>
                  </div>
                  <!-- Poll -->
                  <div class="bg-card border border-border rounded-xl p-2.5">
                    <div class="text-textPrimary font-semibold mb-1.5" style="font-size:0.65rem;"><i class="fas fa-poll text-teal mr-1"></i>Quick Poll</div>
                    <div class="text-textSecondary mb-1.5" style="font-size:0.6rem;">Best study time?</div>
                    <div class="space-y-1">
                      <div>
                        <div class="flex justify-between mb-0.5" style="font-size:0.55rem;">
                          <span class="text-textSecondary">Morning</span><span class="text-accent">58%</span>
                        </div>
                        <div class="progress h-1.5"><div class="progress-fill bg-accent" style="width:58%;"></div></div>
                      </div>
                      <div>
                        <div class="flex justify-between mb-0.5" style="font-size:0.55rem;">
                          <span class="text-textSecondary">Night</span><span class="text-purple">42%</span>
                        </div>
                        <div class="progress h-1.5"><div class="progress-fill bg-purple" style="width:42%;"></div></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Floating badges -->
        <div class="flex justify-between px-2 -mt-5 relative z-10 pointer-events-none">
          <div class="bg-card border border-green border-opacity-40 rounded-xl px-3 py-1.5 flex items-center gap-2 shadow-card" style="margin-top:-5px;">
            <i class="fas fa-check-circle text-green text-xs"></i>
            <span class="text-green text-xs font-semibold">Lab Submitted</span>
          </div>
          <div class="bg-card border border-accent border-opacity-40 rounded-xl px-3 py-1.5 flex items-center gap-2 shadow-card">
            <i class="fas fa-bell text-accent text-xs"></i>
            <span class="text-accent text-xs font-semibold">3 New Notices</span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- scroll indicator -->
  <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-muted animate-bounce">
    <span class="text-[10px] font-medium tracking-wider uppercase">Scroll</span>
    <i class="fas fa-chevron-down text-xs"></i>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ FEATURES ═══════════════ -->
<section id="features" class="py-20 max-w-7xl mx-auto px-5">
  <div class="text-center mb-12 fade-up">
    <div class="section-label mb-4 inline-flex"><i class="fas fa-bolt mr-1"></i>Platform Features</div>
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Everything You Need, <span style="color:#3d7fff;">In One Place</span></h2>
    <p class="text-textSecondary max-w-2xl mx-auto">A complete academic toolkit built specifically for CSE-105 students — organized, beautiful, and always up-to-date.</p>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
    <!-- Feature cards -->
    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.05s">
      <div class="icon-box bg-blue-500 bg-opacity-10 text-accent mb-4"><i class="fas fa-bullhorn"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Notice System</div>
      <div class="text-textSecondary text-sm leading-relaxed">Get real-time academic notices, circulars, and urgent announcements from teachers.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.1s">
      <div class="icon-box bg-amber-500 bg-opacity-10 text-amber mb-4"><i class="fas fa-tasks"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Assignment Tracking</div>
      <div class="text-textSecondary text-sm leading-relaxed">Track deadlines, submission status, and course-wise assignments in a clean dashboard.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.15s">
      <div class="icon-box bg-purple-500 bg-opacity-10 text-purple mb-4"><i class="fas fa-flask"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Lab Reports</div>
      <div class="text-textSecondary text-sm leading-relaxed">Download, submit and manage all your lab reports with version history and teacher feedback.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.2s">
      <div class="icon-box bg-green-500 bg-opacity-10 text-green mb-4"><i class="fas fa-calendar-alt"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Exam Routine</div>
      <div class="text-textSecondary text-sm leading-relaxed">View your class routine, exam schedule and never miss an important session again.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.25s">
      <div class="icon-box bg-teal-500 bg-opacity-10 text-teal mb-4"><i class="fas fa-poll"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Poll System</div>
      <div class="text-textSecondary text-sm leading-relaxed">Participate in batch polls, vote on decisions, and see community opinions in real time.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.3s">
      <div class="icon-box bg-pink-500 bg-opacity-10 text-pink mb-4"><i class="fas fa-book-open"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Study Resources</div>
      <div class="text-textSecondary text-sm leading-relaxed">Access notes, slides, books, and curated study materials organized by course and topic.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.35s">
      <div class="icon-box bg-coral-500 bg-opacity-10 text-coral mb-4" style="color:#fb923c;"><i class="fas fa-chalkboard-teacher"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Teacher Directory</div>
      <div class="text-textSecondary text-sm leading-relaxed">Find contact info, office hours, and course details for all your course teachers instantly.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>

    <div class="dash-card feature-card p-5 fade-up" style="animation-delay:0.4s">
      <div class="icon-box" style="background:rgba(34,211,238,0.1);color:#22d3ee;border-radius:12px;width:46px;height:46px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;margin-bottom:1rem;"><i class="fas fa-users"></i></div>
      <div class="font-semibold text-textPrimary mb-2">Classmate Network</div>
      <div class="text-textSecondary text-sm leading-relaxed">Connect with your batch, find study partners, and collaborate on group projects seamlessly.</div>
      <div class="mt-3 flex items-center gap-1 text-accent text-xs font-medium">Learn more <i class="fas fa-arrow-right ml-1 text-[10px]"></i></div>
    </div>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ DASHBOARD PREVIEW ═══════════════ -->
<section id="preview" class="py-20 relative overflow-hidden">
  <div class="hero-glow glow-center" style="opacity:0.6;"></div>
  <div class="max-w-7xl mx-auto px-5">
    <div class="text-center mb-12 fade-up">
      <div class="section-label mb-4 inline-flex"><i class="fas fa-desktop mr-1"></i>Live Preview</div>
      <h2 class="text-3xl md:text-4xl font-bold mb-4">A Dashboard Built for <span style="color:#3d7fff;">Students</span></h2>
      <p class="text-textSecondary max-w-xl mx-auto">Clean, fast, and always relevant — see exactly how your academic life looks inside the hub.</p>
    </div>

    <!-- Big mock dashboard -->
    <div class="dash-card p-0 overflow-hidden fade-up" style="border-radius:20px;max-width:860px;margin:0 auto;">
      <!-- Topbar -->
      <div class="mock-topbar">
        <div class="flex items-center gap-2">
          <div class="w-2.5 h-2.5 rounded-full bg-red opacity-70"></div>
          <div class="w-2.5 h-2.5 rounded-full bg-amber opacity-70"></div>
          <div class="w-2.5 h-2.5 rounded-full bg-green opacity-70"></div>
          <span class="text-textSecondary text-xs ml-2 font-medium">CSE-105 Hub — Dashboard</span>
        </div>
        <div class="flex items-center gap-2">
          <div class="bg-input rounded-lg px-3 py-1.5 flex items-center gap-2">
            <i class="fas fa-search text-muted text-[10px]"></i>
            <span class="text-muted text-[10px]">Search anything...</span>
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="flex">
        <!-- Sidebar (hidden on mobile) -->
        <div class="mock-sidebar w-40 p-3 flex-shrink-0 hidden md:block" style="min-height:460px;">
          <div class="flex items-center gap-1.5 mb-4 px-1">
            <div class="w-6 h-6 rounded-lg bg-accent flex items-center justify-center text-white text-[9px] font-bold"><i class="fas fa-graduation-cap"></i></div>
            <span class="text-textPrimary text-xs font-bold">CSE-105</span>
          </div>
          <div class="text-muted text-[9px] font-semibold uppercase tracking-wider mb-1.5 px-2">Navigation</div>
          <div class="sidebar-item active"><i class="fas fa-th-large text-[10px]"></i><span>Dashboard</span></div>
          <div class="sidebar-item"><i class="fas fa-bullhorn text-[10px]"></i><span>Notices</span><span class="ml-auto bg-red text-white text-[8px] font-bold rounded-full w-4 h-4 flex items-center justify-center">3</span></div>
          <div class="sidebar-item"><i class="fas fa-tasks text-[10px]"></i><span>Assignments</span></div>
          <div class="sidebar-item"><i class="fas fa-flask text-[10px]"></i><span>Lab Reports</span></div>
          <div class="sidebar-item"><i class="fas fa-calendar text-[10px]"></i><span>Routine</span></div>
          <div class="sidebar-item"><i class="fas fa-poll text-[10px]"></i><span>Polls</span></div>
          <div class="sidebar-item"><i class="fas fa-book text-[10px]"></i><span>Resources</span></div>
          <div class="sidebar-item"><i class="fas fa-users text-[10px]"></i><span>Classmates</span></div>
          <div class="mt-3 pt-3 border-t border-border">
            <div class="sidebar-item"><i class="fas fa-cog text-[10px]"></i><span>Settings</span></div>
            <div class="sidebar-item"><i class="fas fa-sign-out-alt text-[10px]"></i><span>Logout</span></div>
          </div>
        </div>

        <!-- Main -->
        <div class="flex-1 p-4 bg-bg">
          <!-- Greeting -->
          <div class="flex items-center justify-between mb-4">
            <div>
              <div class="text-textPrimary font-semibold text-sm">Dashboard Overview</div>
              <div class="text-textSecondary text-xs">Sunday, 17 May 2026 · Semester 2</div>
            </div>
            <div class="flex items-center gap-2">
              <div class="chip chip-green text-[10px]">● Live</div>
              <div class="stat-badge text-xs"><i class="fas fa-sync-alt text-accent text-[10px]"></i><span class="text-textSecondary text-[10px]">Updated</span></div>
            </div>
          </div>

          <!-- Stats cards -->
          <div class="grid grid-cols-4 gap-2 mb-4">
            <div class="bg-card border border-border rounded-xl p-3">
              <div class="flex items-center gap-1.5 mb-1.5">
                <i class="fas fa-bullhorn text-accent text-[10px]"></i>
                <span class="text-textSecondary text-[10px]">Notices</span>
              </div>
              <div class="text-textPrimary font-bold text-lg">24</div>
              <div class="text-green text-[9px] font-medium">↑ 3 new today</div>
            </div>
            <div class="bg-card border border-border rounded-xl p-3">
              <div class="flex items-center gap-1.5 mb-1.5">
                <i class="fas fa-tasks text-amber text-[10px]"></i>
                <span class="text-textSecondary text-[10px]">Assignments</span>
              </div>
              <div class="text-textPrimary font-bold text-lg">7</div>
              <div class="text-amber text-[9px] font-medium">5 pending</div>
            </div>
            <div class="bg-card border border-border rounded-xl p-3">
              <div class="flex items-center gap-1.5 mb-1.5">
                <i class="fas fa-flask text-purple text-[10px]"></i>
                <span class="text-textSecondary text-[10px]">Lab Reports</span>
              </div>
              <div class="text-textPrimary font-bold text-lg">3</div>
              <div class="text-red text-[9px] font-medium">2 overdue</div>
            </div>
            <div class="bg-card border border-border rounded-xl p-3">
              <div class="flex items-center gap-1.5 mb-1.5">
                <i class="fas fa-users text-teal text-[10px]"></i>
                <span class="text-textSecondary text-[10px]">Classmates</span>
              </div>
              <div class="text-textPrimary font-bold text-lg">152</div>
              <div class="text-teal text-[9px] font-medium">48 online</div>
            </div>
          </div>

          <!-- Two-column content -->
          <div class="grid grid-cols-2 gap-3">
            <!-- Notices -->
            <div class="bg-card border border-border rounded-xl p-3">
              <div class="flex items-center justify-between mb-2.5">
                <span class="text-textPrimary font-semibold text-xs"><i class="fas fa-bullhorn text-accent mr-1.5"></i>Recent Notices</span>
                <span class="text-accent text-[10px] cursor-pointer">View all →</span>
              </div>
              <div class="space-y-2">
                <div class="bg-input rounded-xl p-2.5 flex items-start gap-2">
                  <div class="w-6 h-6 rounded-lg bg-blue-500 bg-opacity-20 flex items-center justify-center text-accent text-[9px] flex-shrink-0 mt-0.5"><i class="fas fa-info"></i></div>
                  <div>
                    <div class="text-textPrimary text-[11px] font-medium leading-tight">Midterm Exam Timetable Published</div>
                    <div class="text-muted text-[9px] mt-0.5">Dr. Ahmed · 2h ago</div>
                  </div>
                  <span class="chip chip-blue ml-auto flex-shrink-0" style="font-size:0.5rem;">New</span>
                </div>
                <div class="bg-input rounded-xl p-2.5 flex items-start gap-2">
                  <div class="w-6 h-6 rounded-lg bg-green-500 bg-opacity-20 flex items-center justify-center text-green text-[9px] flex-shrink-0 mt-0.5"><i class="fas fa-flask"></i></div>
                  <div>
                    <div class="text-textPrimary text-[11px] font-medium leading-tight">Lab Makeup Class — Friday 2PM</div>
                    <div class="text-muted text-[9px] mt-0.5">Lab Dept · Yesterday</div>
                  </div>
                </div>
                <div class="bg-input rounded-xl p-2.5 flex items-start gap-2">
                  <div class="w-6 h-6 rounded-lg bg-amber-500 bg-opacity-20 flex items-center justify-center text-amber text-[9px] flex-shrink-0 mt-0.5"><i class="fas fa-clock"></i></div>
                  <div>
                    <div class="text-textPrimary text-[11px] font-medium leading-tight">Assignment 3 Deadline Extended</div>
                    <div class="text-muted text-[9px] mt-0.5">CR · 2 days ago</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right col -->
            <div class="space-y-3">
              <!-- Assignments -->
              <div class="bg-card border border-border rounded-xl p-3">
                <div class="flex items-center justify-between mb-2.5">
                  <span class="text-textPrimary font-semibold text-xs"><i class="fas fa-tasks text-amber mr-1.5"></i>Assignments</span>
                  <span class="chip chip-amber" style="font-size:0.5rem;">5 pending</span>
                </div>
                <div class="space-y-2">
                  <div>
                    <div class="flex items-center justify-between mb-1">
                      <span class="text-textSecondary text-[10px]">Data Structures #3</span>
                      <span class="chip chip-red" style="font-size:0.48rem;padding:2px 5px;">Due Fri</span>
                    </div>
                    <div class="progress h-1.5"><div class="progress-fill bg-accent" style="width:70%;"></div></div>
                  </div>
                  <div>
                    <div class="flex items-center justify-between mb-1">
                      <span class="text-textSecondary text-[10px]">OOP Lab Report</span>
                      <span class="chip chip-amber" style="font-size:0.48rem;padding:2px 5px;">Due Mon</span>
                    </div>
                    <div class="progress h-1.5"><div class="progress-fill bg-purple" style="width:25%;"></div></div>
                  </div>
                  <div>
                    <div class="flex items-center justify-between mb-1">
                      <span class="text-textSecondary text-[10px]">Discrete Math HW</span>
                      <span class="chip chip-green" style="font-size:0.48rem;padding:2px 5px;">Submitted</span>
                    </div>
                    <div class="progress h-1.5"><div class="progress-fill bg-green" style="width:100%;"></div></div>
                  </div>
                </div>
              </div>

              <!-- Poll widget -->
              <div class="bg-card border border-border rounded-xl p-3">
                <div class="text-textPrimary font-semibold text-xs mb-2"><i class="fas fa-poll text-teal mr-1.5"></i>Active Poll</div>
                <div class="text-textSecondary text-[10px] mb-2 leading-snug">When should we schedule the group study session?</div>
                <div class="space-y-1.5">
                  <div>
                    <div class="flex justify-between mb-0.5">
                      <span class="text-textSecondary text-[9px]">Thursday Evening</span>
                      <span class="text-accent text-[9px] font-semibold">62%</span>
                    </div>
                    <div class="progress h-2"><div class="progress-fill bg-accent" style="width:62%;"></div></div>
                  </div>
                  <div>
                    <div class="flex justify-between mb-0.5">
                      <span class="text-textSecondary text-[9px]">Friday Morning</span>
                      <span class="text-purple text-[9px] font-semibold">38%</span>
                    </div>
                    <div class="progress h-2"><div class="progress-fill bg-purple" style="width:38%;"></div></div>
                  </div>
                </div>
                <div class="text-muted text-[9px] mt-1.5">87 votes · Ends in 12h</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ WHY CHOOSE US ═══════════════ -->
<section id="about" class="py-20 max-w-7xl mx-auto px-5">
  <div class="text-center mb-12 fade-up">
    <div class="section-label mb-4 inline-flex"><i class="fas fa-star mr-1"></i>Why Choose Us</div>
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Built for Student <span style="color:#3d7fff;">Excellence</span></h2>
    <p class="text-textSecondary max-w-xl mx-auto">We designed every feature with real student pain points in mind — less chaos, more focus.</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <div class="dash-card p-7 text-center fade-up" style="animation-delay:0.05s">
      <div class="w-14 h-14 rounded-2xl bg-accent bg-opacity-15 flex items-center justify-center text-accent text-2xl mx-auto mb-5">
        <i class="fas fa-layer-group"></i>
      </div>
      <h3 class="font-bold text-textPrimary text-lg mb-3">Organized Academic Life</h3>
      <p class="text-textSecondary text-sm leading-relaxed">No more scattered WhatsApp groups or missed deadlines. Everything is structured, tagged, and searchable in one beautiful dashboard.</p>
      <div class="mt-5 flex flex-wrap gap-2 justify-center">
        <span class="chip chip-blue">Deadlines</span>
        <span class="chip chip-green">Submissions</span>
        <span class="chip chip-purple">Reports</span>
      </div>
    </div>

    <div class="dash-card p-7 text-center fade-up" style="animation-delay:0.15s;border-color:rgba(61,127,255,0.3);box-shadow:0 0 40px rgba(61,127,255,0.12);">
      <div class="w-14 h-14 rounded-2xl bg-accent bg-opacity-20 flex items-center justify-center text-accent text-2xl mx-auto mb-5" style="box-shadow:0 0 20px rgba(61,127,255,0.3);">
        <i class="fas fa-database"></i>
      </div>
      <h3 class="font-bold text-textPrimary text-lg mb-3">Centralized Resources</h3>
      <p class="text-textSecondary text-sm leading-relaxed">All study materials, past exams, notes, and books — organized by course, semester, and teacher — available anytime, anywhere.</p>
      <div class="mt-5 flex flex-wrap gap-2 justify-center">
        <span class="chip chip-amber">Notes</span>
        <span class="chip chip-teal">Books</span>
        <span class="chip chip-red">Past Papers</span>
      </div>
    </div>

    <div class="dash-card p-7 text-center fade-up" style="animation-delay:0.25s">
      <div class="w-14 h-14 rounded-2xl bg-accent bg-opacity-15 flex items-center justify-center text-accent text-2xl mx-auto mb-5">
        <i class="fas fa-handshake"></i>
      </div>
      <h3 class="font-bold text-textPrimary text-lg mb-3">Better Batch Collaboration</h3>
      <p class="text-textSecondary text-sm leading-relaxed">Connect with classmates, vote on batch decisions through polls, and build a stronger academic community together.</p>
      <div class="mt-5 flex flex-wrap gap-2 justify-center">
        <span class="chip chip-purple">Polls</span>
        <span class="chip chip-green">Network</span>
        <span class="chip chip-blue">Groups</span>
      </div>
    </div>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ TESTIMONIALS ═══════════════ -->
<section class="py-20 max-w-7xl mx-auto px-5">
  <div class="text-center mb-12 fade-up">
    <div class="section-label mb-4 inline-flex"><i class="fas fa-comment-dots mr-1"></i>Student Reviews</div>
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Loved by <span style="color:#3d7fff;">Batchmates</span></h2>
    <p class="text-textSecondary">Real words from real CSE-105 students who use the hub every day.</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
    <!-- T1 -->
    <div class="dash-card p-6 fade-up" style="animation-delay:0.05s">
      <div class="stars mb-3">★★★★★</div>
      <p class="text-textSecondary text-sm leading-relaxed mb-5">"This platform completely changed how I manage my studies. I used to miss assignments all the time — now I never miss a single deadline. The notice system alone is worth it!"</p>
      <div class="flex items-center gap-3">
        <div class="avatar-ring">
          <div class="avatar-inner text-accent">RA</div>
        </div>
        <div>
          <div class="text-textPrimary font-semibold text-sm">Rahim Ahmed</div>
          <div class="text-textSecondary text-xs">Roll: 2024331008 · CR</div>
        </div>
      </div>
    </div>

    <!-- T2 -->
    <div class="dash-card p-6 fade-up" style="animation-delay:0.15s;border-color:rgba(61,127,255,0.25);">
      <div class="stars mb-3">★★★★★</div>
      <p class="text-textSecondary text-sm leading-relaxed mb-5">"The lab report section saved me so much stress. I can see exactly what's due, when, and who submitted. The design is also stunning — feels like a proper professional tool."</p>
      <div class="flex items-center gap-3">
        <div class="avatar-ring" style="background:linear-gradient(135deg,#29d68e,#22d3ee);">
          <div class="avatar-inner text-green">NK</div>
        </div>
        <div>
          <div class="text-textPrimary font-semibold text-sm">Nadia Khan</div>
          <div class="text-textSecondary text-xs">Roll: 2024331021 · Lab Rep</div>
        </div>
      </div>
    </div>

    <!-- T3 -->
    <div class="dash-card p-6 fade-up" style="animation-delay:0.25s">
      <div class="stars mb-3">★★★★★</div>
      <p class="text-textSecondary text-sm leading-relaxed mb-5">"Finally, a platform that actually understands student needs. The poll system is genius — we used it to decide our study schedule and everyone loved it. 100% recommend!"</p>
      <div class="flex items-center gap-3">
        <div class="avatar-ring" style="background:linear-gradient(135deg,#f472b6,#a78bfa);">
          <div class="avatar-inner text-pink" style="color:#f472b6;">SH</div>
        </div>
        <div>
          <div class="text-textPrimary font-semibold text-sm">Sabbir Hossain</div>
          <div class="text-textSecondary text-xs">Roll: 2024331045 · Student</div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ FAQ ═══════════════ -->
<section id="contact" class="py-20 max-w-3xl mx-auto px-5">
  <div class="text-center mb-12 fade-up">
    <div class="section-label mb-4 inline-flex"><i class="fas fa-question-circle mr-1"></i>FAQ</div>
    <h2 class="text-3xl md:text-4xl font-bold mb-4">Common <span style="color:#3d7fff;">Questions</span></h2>
    <p class="text-textSecondary">Everything you need to know about the CSE-105 Batch Solution Hub.</p>
  </div>

  <div class="space-y-3 fade-up">
    <!-- FAQ 1 -->
    <div class="faq-item dash-card" id="faq1">
      <button class="faq-btn p-5 flex items-center justify-between gap-4" onclick="toggleFaq('faq1')">
        <span class="text-textPrimary font-semibold text-sm text-left">How do I join the platform?</span>
        <i class="fas fa-chevron-down text-textSecondary text-xs flex-shrink-0 faq-icon" id="faq1-icon"></i>
      </button>
      <div class="faq-body" id="faq1-body">
        <div class="px-5 pb-5 text-textSecondary text-sm leading-relaxed">
          Simply click "Get Started" and register with your CSE-105 batch roll number. Once verified by the batch CR, you'll get full access to all features. Registration takes less than 2 minutes!
        </div>
      </div>
    </div>

    <!-- FAQ 2 -->
    <div class="faq-item dash-card" id="faq2">
      <button class="faq-btn p-5 flex items-center justify-between gap-4" onclick="toggleFaq('faq2')">
        <span class="text-textPrimary font-semibold text-sm text-left">Is the platform completely free to use?</span>
        <i class="fas fa-chevron-down text-textSecondary text-xs flex-shrink-0 faq-icon" id="faq2-icon"></i>
      </button>
      <div class="faq-body" id="faq2-body">
        <div class="px-5 pb-5 text-textSecondary text-sm leading-relaxed">
          Yes! The CSE-105 Batch Solution Hub is 100% free for all CSE-105 batch students. There are no premium tiers, no hidden fees — everything is available to every student equally.
        </div>
      </div>
    </div>

    <!-- FAQ 3 -->
    <div class="faq-item dash-card" id="faq3">
      <button class="faq-btn p-5 flex items-center justify-between gap-4" onclick="toggleFaq('faq3')">
        <span class="text-textPrimary font-semibold text-sm text-left">Can teachers upload resources and notices?</span>
        <i class="fas fa-chevron-down text-textSecondary text-xs flex-shrink-0 faq-icon" id="faq3-icon"></i>
      </button>
      <div class="faq-body" id="faq3-body">
        <div class="px-5 pb-5 text-textSecondary text-sm leading-relaxed">
          Yes! Teachers can be given special access to upload study materials, post notices, and create assignments. Contact the CR to set up a teacher account with the appropriate permissions.
        </div>
      </div>
    </div>

    <!-- FAQ 4 -->
    <div class="faq-item dash-card" id="faq4">
      <button class="faq-btn p-5 flex items-center justify-between gap-4" onclick="toggleFaq('faq4')">
        <span class="text-textPrimary font-semibold text-sm text-left">How do I submit assignments through the hub?</span>
        <i class="fas fa-chevron-down text-textSecondary text-xs flex-shrink-0 faq-icon" id="faq4-icon"></i>
      </button>
      <div class="faq-body" id="faq4-body">
        <div class="px-5 pb-5 text-textSecondary text-sm leading-relaxed">
          Go to the Assignments section, find your assignment, click "Submit", and upload your file (PDF, DOCX, ZIP supported). You'll receive a confirmation and can track your submission status in real time.
        </div>
      </div>
    </div>
  </div>
</section>

<div class="divider-glow"></div>

<!-- ═══════════════ CTA ═══════════════ -->
<section class="py-20 relative overflow-hidden">
  <div class="hero-glow" style="background:rgba(61,127,255,0.12);width:800px;height:500px;top:50%;left:50%;transform:translate(-50%,-50%);filter:blur(100px);"></div>
  <div class="max-w-3xl mx-auto px-5 text-center relative z-10 fade-up">
    <div class="dash-card p-12 md:p-16" style="border-color:rgba(61,127,255,0.2);">
      <div class="w-16 h-16 rounded-2xl bg-accent bg-opacity-20 flex items-center justify-center text-accent text-3xl mx-auto mb-6" style="box-shadow:0 0 30px rgba(61,127,255,0.3);">
        <i class="fas fa-rocket"></i>
      </div>
      <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to simplify your<br><span style="color:#3d7fff;">academic life?</span></h2>
      <p class="text-textSecondary mb-8 text-base leading-relaxed max-w-lg mx-auto">Join 150+ CSE-105 students who are already managing their academic lives smarter. It takes 2 minutes to get started.</p>
      <div class="flex flex-wrap gap-3 justify-center">
        <button class="btn-hero btn-hero-primary"><i class="fas fa-sign-in-alt mr-2"></i>Login Now</button>
        <button class="btn-hero btn-hero-outline"><i class="fas fa-user-plus mr-2"></i>Get Started</button>
      </div>
      <div class="mt-6 flex flex-wrap gap-5 justify-center text-textSecondary text-xs">
        <span><i class="fas fa-check text-green mr-1.5"></i>Free forever</span>
        <span><i class="fas fa-check text-green mr-1.5"></i>No credit card</span>
        <span><i class="fas fa-check text-green mr-1.5"></i>Instant access</span>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════ FOOTER ═══════════════ -->
<footer style="background:#111318;border-top:1px solid #1f2333;">
  <div class="max-w-7xl mx-auto px-5 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
      <!-- Brand -->
      <div class="md:col-span-2">
        <div class="flex items-center gap-2.5 mb-4">
          <div class="w-9 h-9 rounded-xl bg-accent flex items-center justify-center text-white" style="box-shadow:0 4px 16px rgba(61,127,255,0.4);">
            <i class="fas fa-graduation-cap text-sm"></i>
          </div>
          <div>
            <div class="text-textPrimary font-bold">CSE-105</div>
            <div class="text-textSecondary text-xs">Batch Solution Hub</div>
          </div>
        </div>
        <p class="text-textSecondary text-sm leading-relaxed max-w-xs mb-5">
          The all-in-one academic platform designed to help CSE-105 students stay organized, connected, and ahead of their coursework.
        </p>
        <!-- Social links -->
        <div class="flex items-center gap-2">
          <a href="#" class="w-8 h-8 rounded-lg bg-input border border-border flex items-center justify-center text-textSecondary hover:text-accent hover:border-accent transition-all text-xs">
            <i class="fab fa-github"></i>
          </a>
          <a href="#" class="w-8 h-8 rounded-lg bg-input border border-border flex items-center justify-center text-textSecondary hover:text-accent hover:border-accent transition-all text-xs">
            <i class="fab fa-facebook"></i>
          </a>
          <a href="#" class="w-8 h-8 rounded-lg bg-input border border-border flex items-center justify-center text-textSecondary hover:text-accent hover:border-accent transition-all text-xs">
            <i class="fab fa-discord"></i>
          </a>
          <a href="#" class="w-8 h-8 rounded-lg bg-input border border-border flex items-center justify-center text-textSecondary hover:text-accent hover:border-accent transition-all text-xs">
            <i class="fab fa-telegram"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div>
        <div class="text-textPrimary font-semibold text-sm mb-4">Quick Links</div>
        <div class="space-y-2.5">
          <a href="#home" class="block text-textSecondary text-sm hover:text-accent transition-colors">Home</a>
          <a href="#features" class="block text-textSecondary text-sm hover:text-accent transition-colors">Features</a>
          <a href="#preview" class="block text-textSecondary text-sm hover:text-accent transition-colors">Dashboard Preview</a>
          <a href="#about" class="block text-textSecondary text-sm hover:text-accent transition-colors">About</a>
          <a href="#contact" class="block text-textSecondary text-sm hover:text-accent transition-colors">FAQ</a>
        </div>
      </div>

      <!-- Platform -->
      <div>
        <div class="text-textPrimary font-semibold text-sm mb-4">Platform</div>
        <div class="space-y-2.5">
          <a href="#" class="block text-textSecondary text-sm hover:text-accent transition-colors">Notices</a>
          <a href="#" class="block text-textSecondary text-sm hover:text-accent transition-colors">Assignments</a>
          <a href="#" class="block text-textSecondary text-sm hover:text-accent transition-colors">Lab Reports</a>
          <a href="#" class="block text-textSecondary text-sm hover:text-accent transition-colors">Routine</a>
          <a href="#" class="block text-textSecondary text-sm hover:text-accent transition-colors">Resources</a>
        </div>
      </div>
    </div>

    <div class="divider-glow mb-6"></div>

    <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-textSecondary text-xs">
      <span>© 2026 CSE-105 Batch Solution Hub. All rights reserved.</span>
      <div class="flex items-center gap-4">
        <a href="#" class="hover:text-accent transition-colors">Privacy Policy</a>
        <a href="#" class="hover:text-accent transition-colors">Terms of Use</a>
        <span class="flex items-center gap-1.5"><span class="pulse-dot w-1.5 h-1.5 rounded-full bg-green inline-block"></span>All systems operational</span>
      </div>
    </div>
  </div>
</footer>

<!-- ═══════════════ JS ═══════════════ -->
<script>
  // Mobile menu toggle
  function toggleMobile() {
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('hamburger-icon');
    menu.classList.toggle('open');
    icon.className = menu.classList.contains('open')
      ? 'fas fa-times text-lg'
      : 'fas fa-bars text-lg';
  }

  // FAQ accordion
  function toggleFaq(id) {
    const body = document.getElementById(id + '-body');
    const icon = document.getElementById(id + '-icon');
    const card = document.getElementById(id);
    const isOpen = body.classList.contains('open');

    // Close all
    document.querySelectorAll('.faq-body').forEach(b => b.classList.remove('open'));
    document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotated'));
    document.querySelectorAll('.faq-item').forEach(c => {
      c.style.borderColor = '';
      c.style.boxShadow = '';
    });

    if (!isOpen) {
      body.classList.add('open');
      icon.classList.add('rotated');
      card.style.borderColor = 'rgba(61,127,255,0.4)';
      card.style.boxShadow = '0 0 24px rgba(61,127,255,0.12)';
    }
  }

  // Intersection Observer for fade-up
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        const delay = parseFloat(entry.target.style.animationDelay || '0') * 1000;
        setTimeout(() => {
          entry.target.classList.add('visible');
        }, delay);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });

  document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));

  // Active nav link highlight on scroll
  const sections = document.querySelectorAll('section[id]');
  const navLinks = document.querySelectorAll('.nav-link');
  window.addEventListener('scroll', () => {
    const scrollY = window.scrollY + 100;
    sections.forEach(sec => {
      const top = sec.offsetTop;
      const height = sec.offsetHeight;
      if (scrollY >= top && scrollY < top + height) {
        navLinks.forEach(link => {
          link.style.color = '';
          if (link.getAttribute('href') === '#' + sec.id) {
            link.style.color = '#3d7fff';
          }
        });
      }
    });
  });

  // Close mobile menu on resize
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
      document.getElementById('mobile-menu').classList.remove('open');
      document.getElementById('hamburger-icon').className = 'fas fa-bars text-lg';
    }
  });

  // Animate progress bars when visible
  const progressObs = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const fills = entry.target.querySelectorAll('.progress-fill');
        fills.forEach(fill => {
          const w = fill.style.width;
          fill.style.width = '0';
          setTimeout(() => { fill.style.width = w; }, 200);
        });
        progressObs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });

  document.querySelectorAll('.dash-card').forEach(el => progressObs.observe(el));
</script>
</body>
</html>