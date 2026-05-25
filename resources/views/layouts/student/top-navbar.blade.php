    <header
        class="topnav-accent fixed top-0 left-0 right-0 h-14 bg-nav border-b border-bdr flex items-center px-4 gap-4 z-[1000]">
        <!-- Hamburger — mobile only -->
        <button id="mobMenuBtn" onclick="openMobMenu()"
            class="md:hidden w-[34px] h-[34px] bg-input border border-bdr rounded-md flex items-center justify-center text-sec text-sm cursor-pointer shrink-0">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Left: Logo -->
        <div class="flex items-center gap-2 shrink-0 min-w-[140px]">
            <div
                class="w-8 h-8 bg-accent/20 border border-accent/30 rounded-lg flex items-center justify-center shrink-0">
                <i class="fa-solid fa-graduation-cap text-accent text-sm"></i>
            </div>
            <span class="logo-text font-bold text-base tracking-tight hidden sm:block">CSE-105</span>
        </div>

        <!-- Center: Title -->
        <div class="flex-1 text-center text-sm font-semibold text-sec tracking-wide truncate hidden md:block">
            CSE-105 Batch Solution Hub
        </div>

        <!-- Right: Notification + Profile -->
        <div class="flex items-center gap-3 shrink-0 min-w-[150px] justify-end">
            <!-- ── Notification Bell ── -->
            <div class="relative">
                <button id="notifBtn"
                    class="relative w-[34px] h-[34px] bg-input border border-bdr rounded-full flex items-center justify-center text-sec text-sm hover:text-accent hover:border-accent transition-all cursor-pointer">
                    <i class="fa-regular fa-bell"></i>
                    <!-- Red dot badge -->
                    <span id="notifDot"
                        class="absolute top-[5px] right-[5px] w-2 h-2 bg-red rounded-full border-[1.5px] border-nav"></span>
                </button>

                <!-- Notification Dropdown -->
                <div id="notifDropdown"
                    class="hidden absolute top-[calc(100%+10px)] right-0 w-[300px] bg-card border border-bdr rounded-xl shadow-[0_12px_40px_rgba(0,0,0,.45)] z-[9999] overflow-hidden">
                    <!-- Header -->
                    <div class="flex items-center justify-between px-4 py-3 border-b border-bdr">
                        <span class="text-[0.8rem] font-semibold text-prim">Notifications</span>
                        <span id="markAllRead"
                            class="text-[0.7rem] text-accent font-medium cursor-pointer hover:text-ahover">
                            Mark all read
                        </span>
                    </div>

                    <!-- Items list -->
                    <div class="max-h-[280px] overflow-y-auto no-scroll">
                        <!-- Item 1 — Urgent -->
                        <div
                            class="notif-item unread flex gap-2.5 px-4 py-3 border-b border-bdr cursor-pointer bg-accent/10 transition-colors">
                            <div
                                class="w-[34px] h-[34px] rounded-full bg-red/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-red text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[0.78rem] font-medium text-prim leading-snug">
                                    Lab report submission deadline tomorrow!
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>2 hours ago
                                </p>
                            </div>
                        </div>

                        <!-- Item 2 — Notice -->
                        <div
                            class="notif-item unread flex gap-2.5 px-4 py-3 border-b border-bdr cursor-pointer bg-accent/10 transition-colors">
                            <div
                                class="w-[34px] h-[34px] rounded-full bg-accent/15 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bell text-accent text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[0.78rem] font-medium text-prim leading-snug">
                                    New notice posted by admin
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>Yesterday
                                </p>
                            </div>
                        </div>

                        <!-- Item 3 — Poll -->
                        <div
                            class="notif-item unread flex gap-2.5 px-4 py-3 border-b border-bdr cursor-pointer bg-accent/10 transition-colors">
                            <div
                                class="w-[34px] h-[34px] rounded-full bg-pur/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-square-poll-vertical text-pur text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[0.78rem] font-medium text-prim leading-snug">
                                    New poll is live — cast your vote now
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>2 days ago
                                </p>
                            </div>
                        </div>

                        <!-- Item 4 — Read -->
                        <div
                            class="notif-item flex gap-2.5 px-4 py-3 border-b border-bdr cursor-pointer transition-colors">
                            <div
                                class="w-[34px] h-[34px] rounded-full bg-grn/10 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-file-pen text-grn text-xs"></i>
                            </div>
                            <div>
                                <p class="text-[0.78rem] font-medium text-sec leading-snug">
                                    Assignment #4 deadline extended
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>3 days ago
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-4 py-2.5 text-center border-t border-bdr">
                        <a href="#" class="text-[0.75rem] text-accent font-medium hover:text-ahover">View all
                            notifications</a>
                    </div>
                </div>
            </div>
            <!-- /Notification -->

            <!-- ── Profile Trigger ── -->
            <div id="profileTrigger" onclick="toggleDropdown()" role="button" tabindex="0" aria-haspopup="true"
                aria-expanded="false"
                class="flex items-center gap-2 bg-input border border-bdr rounded-full pl-1 pr-3 py-1 cursor-pointer hover:border-accent transition-all">
                <div
                    class="w-7 h-7 rounded-full bg-accent/15 border-[1.5px] border-accent flex items-center justify-center text-[0.7rem] font-semibold text-accent">

                    {{ collect(explode(' ', auth()->user()->name))->map(fn($word) => strtoupper(substr($word, 0, 1)))->take(2)->implode('') ?? 'N/A' }}

                </div>
                <span
                    class="text-[0.78rem] font-medium text-prim max-w-[90px] truncate hidden sm:block">{{ auth()->user()->name ?? 'N/A' }}</span>
                <i id="chevronIcon"
                    class="fa-solid fa-chevron-down text-[0.6rem] text-hint transition-transform duration-200"></i>
            </div>
        </div>

        <!-- Profile Dropdown (absolutely positioned in header) -->
        <div id="profileDropdown" role="menu"
            class="profile-dropdown absolute top-[54px] right-4 bg-card border border-bdr rounded-xl min-w-[185px] py-1.5 shadow-[0_12px_40px_rgba(0,0,0,.45)] z-[999]">
            <div class="px-4 pt-2.5 pb-2 border-b border-bdr mb-1">
                <p class="text-[0.82rem] font-semibold text-prim">{{ auth()->user()->name ?? 'N/A' }}</p>
                <p class="text-[0.72rem] text-sec mt-px">{{ auth()->user()->email ?? 'N/A' }}</p>
            </div>
            <a href="#" role="menuitem"
                class="flex items-center gap-2.5 px-4 py-2 text-[0.8rem] text-sec hover:bg-hover hover:text-prim transition-colors">
                <i class="fa-regular fa-circle-user w-3.5 text-center"></i> Profile
            </a>
            <a href="#" role="menuitem"
                class="flex items-center gap-2.5 px-4 py-2 text-[0.8rem] text-sec hover:bg-hover hover:text-prim transition-colors">
                <i class="fa-solid fa-key w-3.5 text-center"></i> Change Password
            </a>
            <a href="#" role="menuitem"
                class="flex items-center gap-2.5 px-4 py-2 text-[0.8rem] text-sec hover:bg-hover hover:text-prim transition-colors">
                <i class="fa-regular fa-bell w-3.5 text-center"></i> Notifications
            </a>
            <a href="#" role="menuitem"
                class="flex items-center gap-2.5 px-4 py-2 text-[0.8rem] text-sec hover:bg-hover hover:text-prim transition-colors">
                <i class="fa-solid fa-gear w-3.5 text-center"></i> Settings
            </a>
            <div class="h-px bg-bdr mx-0 my-1"></div>
            <a href="cse105-login.html" role="menuitem"
                class="flex items-center gap-2.5 px-4 py-2 text-[0.8rem] text-red hover:bg-red/10 transition-colors">
                <i class="fa-solid fa-right-from-bracket w-3.5 text-center"></i>
                Logout
            </a>
        </div>
    </header>
