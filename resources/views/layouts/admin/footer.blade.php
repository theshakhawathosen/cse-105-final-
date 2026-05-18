<!-- ══════════════ JS ══════════════ -->
<script>
    // ── Sidebar toggle ──
    let sidebarCollapsed = false;
    let mobileSidebarOpen = false;

    function toggleSidebar() {
        const isMobile = window.innerWidth < 1024;
        if (isMobile) {
            mobileSidebarOpen = !mobileSidebarOpen;
            document.getElementById('sidebar').classList.toggle('mobile-open', mobileSidebarOpen);
            document.getElementById('sidebar-overlay').classList.toggle('show', mobileSidebarOpen);
        } else {
            sidebarCollapsed = !sidebarCollapsed;
            document.getElementById('sidebar').classList.toggle('collapsed', sidebarCollapsed);
            document.getElementById('topbar').classList.toggle('collapsed', sidebarCollapsed);
            document.getElementById('main-content').classList.toggle('collapsed', sidebarCollapsed);
        }
    }

    function closeMobileSidebar() {
        mobileSidebarOpen = false;
        document.getElementById('sidebar').classList.remove('mobile-open');
        document.getElementById('sidebar-overlay').classList.remove('show');
    }

    // ── Tab switching ──
    function switchTab(tabId, el) {
        document.querySelectorAll('[id^="tab-"]').forEach(t => t.classList.add('hidden'));
        document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
        const tab = document.getElementById('tab-' + tabId);
        if (tab) {
            tab.classList.remove('hidden');
            tab.querySelectorAll('[class*="fade-up"]').forEach((e, i) => {
                e.style.animationDelay = i * 0.04 + 's';
                e.style.animation = 'none';
                void e.offsetWidth;
                e.style.animation = '';
            });
        }
        el.classList.add('active');
        closeMobileSidebar();
    }

    // ── Dropdown toggle ──
    function toggleDropdown(id) {
        const dd = document.getElementById(id);
        const isOpen = dd.classList.contains('open');
        document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('open'));
        if (!isOpen) dd.classList.add('open');
    }
    document.addEventListener('click', e => {
        if (!e.target.closest('[onclick*="toggleDropdown"]') && !e.target.closest('.dropdown-menu')) {
            document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('open'));
        }
    });

    // ── Modal ──
    function openModal(id) {
        document.getElementById(id).classList.add('open');
    }

    function closeModal(id) {
        document.getElementById(id).classList.remove('open');
    }

    function handleOverlayClick(e, id) {
        if (e.target === document.getElementById(id)) closeModal(id);
    }
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') document.querySelectorAll('.modal-overlay.open').forEach(m => m.classList
            .remove('open'));
    });

    // ── Poll option add ──
    let optCount = 2;

    function addPollOption() {
        optCount++;
        const d = document.createElement('div');
        d.className = 'flex gap-2';
        d.innerHTML =
            `<input class="inp-field" placeholder="Option ${optCount}"><button class="btn-icon del" onclick="this.parentElement.remove()"><i class="fas fa-times text-xs"></i></button>`;
        document.getElementById('poll-options').appendChild(d);
    }

    // ── Animated counters ──
    function animateCounters() {
        document.querySelectorAll('.counter').forEach(el => {
            const target = parseInt(el.dataset.target);
            let start = 0;
            const step = target / 40;
            const timer = setInterval(() => {
                start = Math.min(start + step, target);
                el.textContent = Math.floor(start);
                if (start >= target) clearInterval(timer);
            }, 30);
        });
    }

    // ── Bar chart ──
    function renderBars() {
        const data = [45, 72, 58, 88, 64, 33, 51];
        const colors = ['#3d7fff', '#a78bfa', '#3d7fff', '#29d68e', '#3d7fff', '#f5a623', '#3d7fff'];
        const max = Math.max(...data);
        const container = document.getElementById('bar-chart');
        if (!container) return;
        container.innerHTML = '';
        data.forEach((v, i) => {
            const pct = (v / max * 100);
            const bar = document.createElement('div');
            bar.className = 'flex-1 flex flex-col justify-end';
            bar.innerHTML = `
      <div class="text-tp text-[9px] text-center mb-0.5 font-semibold">${v}</div>
      <div class="chart-bar w-full" style="min-height:4px">
        <div class="chart-bar-inner" style="height:0;background:linear-gradient(180deg,${colors[i]},${colors[i]}55);border-radius:4px 4px 0 0"></div>
      </div>`;
            container.appendChild(bar);
            setTimeout(() => {
                bar.querySelector('.chart-bar-inner').style.height = pct + '%';
            }, 300 + i * 80);
        });
    }

    // ── Init ──
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(animateCounters, 300);
        setTimeout(renderBars, 200);
    });

    // Re-render charts on tab switch to dashboard
    const origSwitch = switchTab;
    window.switchTab = function(tabId, el) {
        origSwitch(tabId, el);
        if (tabId === 'dashboard') setTimeout(renderBars, 200);
    };

    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            document.getElementById('sidebar').classList.remove('mobile-open');
            document.getElementById('sidebar-overlay').classList.remove('show');
            mobileSidebarOpen = false;
        }
    });
</script>
</body>

</html>
