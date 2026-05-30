
    <!-- ═══ FOOTER ═══ -->
    <footer class="text-center px-4 py-5 text-[0.7rem] text-hint border-t border-bdr mt-8">
        &copy; 2025 CSE-105 Batch Solution Hub — Built with ❤️ by CSE-105 Students
    </footer>

    <!-- ═══════════════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════════════ -->
    <script>
        /* ── PROFILE DROPDOWN ─────────────────────────── */
        const profileTrigger = document.getElementById("profileTrigger");
        const profileDropdown = document.getElementById("profileDropdown");
        const chevronIcon = document.getElementById("chevronIcon");

        function toggleDropdown() {
            const isOpen = profileDropdown.classList.toggle("open");
            profileTrigger.setAttribute("aria-expanded", isOpen);
            // Rotate chevron when open
            chevronIcon.style.transform = isOpen ?
                "rotate(180deg)" :
                "rotate(0deg)";
            // Close notif if open
            notifDropdown.style.display = "none";
        }

        document.addEventListener("click", function(e) {
            if (
                !profileTrigger.contains(e.target) &&
                !profileDropdown.contains(e.target)
            ) {
                profileDropdown.classList.remove("open");
                profileTrigger.setAttribute("aria-expanded", "false");
                chevronIcon.style.transform = "rotate(0deg)";
            }
        });

        profileTrigger.addEventListener("keydown", function(e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                toggleDropdown();
            }
        });

        /* ── NOTIFICATION DROPDOWN ────────────────────── */
        const notifBtn = document.getElementById("notifBtn");
        const notifDropdown = document.getElementById("notifDropdown");
        const notifDot = document.getElementById("notifDot");
        const markAllRead = document.getElementById("markAllRead");

        // Toggle on bell click
        notifBtn.addEventListener("click", function(e) {
            e.stopPropagation();
            const isOpen = notifDropdown.style.display === "block";
            notifDropdown.style.display = isOpen ? "none" : "block";
            // Close profile dropdown if open
            profileDropdown.classList.remove("open");
            chevronIcon.style.transform = "rotate(0deg)";
        });

        // Close on outside click
        document.addEventListener("click", function(e) {
            if (!notifBtn.contains(e.target) && !notifDropdown.contains(e.target)) {
                notifDropdown.style.display = "none";
            }
        });



        // Single item click → mark as read
        document.querySelectorAll(".notif-item").forEach(function(item) {
            item.addEventListener("click", function() {
                this.classList.remove("unread");
                this.style.background = "transparent";
                if (!document.querySelector(".notif-item.unread")) {
                    notifDot.style.display = "none";
                }
            });
        });

        /* ── TAB NAVIGATION ───────────────────────────── */
        function setTab(el, event) {
            event.preventDefault();
            document
                .querySelectorAll(".tab-link")
                .forEach((t) => t.classList.remove("active"));
            el.classList.add("active");
        }

        /* ── MOBILE SIDEBAR ───────────────────────────── */
        const mobOverlay = document.getElementById("mobOverlay");
        const mobSidebar = document.getElementById("mobSidebar");

        function openMobMenu() {
            mobOverlay.style.display = "block";
            requestAnimationFrame(() => {
                mobOverlay.classList.add("open");
                mobSidebar.classList.add("open");
            });
            document.body.style.overflow = "hidden";
        }

        function closeMobMenu() {
            mobOverlay.classList.remove("open");
            mobSidebar.classList.remove("open");
            document.body.style.overflow = "";
            setTimeout(() => {
                mobOverlay.style.display = "none";
            }, 280);
        }

        /* ── NOTICE TICKER — seamless loop ───────────── */
        // (function () {
        //   const track = document.getElementById("noticeTrack");
        //   const clone = track.cloneNode(true);
        //   clone.setAttribute("aria-hidden", "true");
        //   track.parentElement.appendChild(clone);
        // })();

        /* ── STAT COUNTER ANIMATION ───────────────────── */
        function animateCounter(el, target, duration) {
            let start = 0;
            const step = target / (duration / 16);
            const timer = setInterval(() => {
                start += step;
                if (start >= target) {
                    el.textContent = target;
                    clearInterval(timer);
                } else {
                    el.textContent = Math.floor(start);
                }
            }, 16);
        }

        window.addEventListener("load", function() {
            document.querySelectorAll(".stat-value").forEach(function(el) {
                const target = parseInt(el.textContent, 10);
                if (!isNaN(target)) {
                    el.textContent = "0";
                    animateCounter(el, target, 900);
                }
            });
        });
    </script>

{{-- <script>
document.addEventListener('DOMContentLoaded', () => {

    console.log(window.Echo);

    window.Echo.channel('test-channel')
        .listen('TestMessage', (e) => {

            console.log('Received:', e);

            alert(e.message);

        });

});
</script> --}}


{{-- Presence Channel er Jonno --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    if (window.Echo) {

        window.Echo.join('online-students')

            .here((users) => {
                console.log('Online Users:', users);
            })

            .joining((user) => {
                console.log(user.name + ' joined');
            })

            .leaving((user) => {
                console.log(user.name + ' left');
            });

    }

});
</script>

</body>

</html>
