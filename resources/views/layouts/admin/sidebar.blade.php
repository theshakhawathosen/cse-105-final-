    <aside id="sidebar">
        <!-- Brand -->
        <div class="flex items-center gap-2.5 px-4 py-4 border-b border-border flex-shrink-0"
            style="height:var(--topbar-h)">
            <div class="w-8 h-8 rounded-xl bg-accent flex items-center justify-center text-white text-xs font-bold flex-shrink-0"
                style="box-shadow:0 4px 16px rgba(61,127,255,.4)">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="brand-text leading-tight transition-all duration-300 overflow-hidden">
                <div class="text-tp font-bold text-sm tracking-wide whitespace-nowrap">CSE-105</div>
                <div class="text-ts text-[10px] font-medium -mt-0.5 whitespace-nowrap">Admin Panel</div>
            </div>
        </div>

        <!-- Nav -->
        <div class="flex-1 overflow-y-auto py-3" style="scrollbar-width:none">
            <div class="sidebar-section-label">Main</div>
            <div class="nav-item active" onclick="switchTab('dashboard',this)">
                <i class="nav-icon fas fa-th-large"></i>
                <span class="nav-label">Dashboard</span>
            </div>
            <div class="nav-item" onclick="switchTab('students',this)">
                <i class="nav-icon fas fa-user-graduate"></i>
                <span class="nav-label">Students</span>
                <span class="badge-pill">152</span>
            </div>
            <div class="nav-item" onclick="switchTab('teachers',this)">
                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                <span class="nav-label">Teachers</span>
            </div>

            <div class="sidebar-section-label">Content</div>
            <div class="nav-item" onclick="switchTab('notices',this)">
                <i class="nav-icon fas fa-bullhorn"></i>
                <span class="nav-label">Notices</span>
                <span class="badge-pill">3</span>
            </div>
            <div class="nav-item" onclick="switchTab('assignments',this)">
                <i class="nav-icon fas fa-tasks"></i>
                <span class="nav-label">Assignments</span>
            </div>
            <div class="nav-item" onclick="switchTab('lab',this)">
                <i class="nav-icon fas fa-flask"></i>
                <span class="nav-label">Lab Reports</span>
            </div>
            <div class="nav-item" onclick="switchTab('routines',this)">
                <i class="nav-icon fas fa-calendar-alt"></i>
                <span class="nav-label">Routines</span>
            </div>
            <div class="nav-item" onclick="switchTab('polls',this)">
                <i class="nav-icon fas fa-poll"></i>
                <span class="nav-label">Polls</span>
            </div>
            <div class="nav-item" onclick="switchTab('subjects',this)">
                <i class="nav-icon fas fa-book"></i>
                <span class="nav-label">Subjects</span>
            </div>
            <div class="nav-item" onclick="switchTab('resources',this)">
                <i class="nav-icon fas fa-cloud-upload-alt"></i>
                <span class="nav-label">Resources</span>
            </div>

            <div class="sidebar-section-label">Reports</div>
            <div class="nav-item" onclick="switchTab('feedback',this)">
                <i class="nav-icon fas fa-comments"></i>
                <span class="nav-label">Feedback</span>
                <span class="badge-pill" style="background:var(--purple)">7</span>
            </div>
            <div class="nav-item" onclick="switchTab('analytics',this)">
                <i class="nav-icon fas fa-chart-bar"></i>
                <span class="nav-label">Analytics</span>
            </div>

            <div class="sidebar-section-label">System</div>
            <div class="nav-item" onclick="switchTab('settings',this)">
                <i class="nav-icon fas fa-cog"></i>
                <span class="nav-label">Settings</span>
            </div>
            <div class="nav-item" style="color:var(--red)" onclick="alert('Logged out!')">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <span class="nav-label">Logout</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-4 py-3 border-t border-border flex items-center gap-2.5 sidebar-footer-text flex-shrink-0">
            <div
                class="w-7 h-7 rounded-lg bg-accent flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                A</div>
            <div class="overflow-hidden">
                <div class="text-tp text-xs font-semibold whitespace-nowrap">Super Admin</div>
                <div class="text-ts text-[10px] whitespace-nowrap">admin@cse105.edu</div>
            </div>
        </div>
    </aside>
