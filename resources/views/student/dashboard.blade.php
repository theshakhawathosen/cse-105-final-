@extends('layouts.student.student-layout')
@section('title', 'Dashboard')
@section('content')
    <main class="pt-5 px-4 md:px-5 pb-8 max-w-auto mx-5" role="main">
        <!-- ── SECTION HEADING: Batch Overview ── -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-[0.78rem] font-semibold uppercase tracking-widest text-sec">
                <i class="fa-solid fa-chart-simple text-accent mr-1.5"></i>Batch
                Overview
            </h2>
            <a href="#" class="text-[0.72rem] text-accent font-medium hover:text-ahover transition-colors">See
                all</a>
        </div>

        <!-- ── STATS GRID ── -->
        <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-8 gap-3 mb-7">
            <!-- Notice -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-accent transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-accent/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-bell text-accent"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        3
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">New Notices</div>
                </div>
            </div>

            <!-- Assignment -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-amb transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-amb/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-file-pen text-amb"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        4
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Assignments</div>
                </div>
            </div>

            <!-- Lab Report -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-pur transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-pur/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-flask text-pur"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        6
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Lab Reports</div>
                </div>
            </div>

            <!-- Routine -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-grn transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-grn/15 flex items-center justify-center text-base">
                    <i class="fa-regular fa-calendar text-grn"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        1
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Routines</div>
                </div>
            </div>

            <!-- Teachers -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-tel transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-tel/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-chalkboard-user text-tel"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        8
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Teachers</div>
                </div>
            </div>

            <!-- Classmates -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-crl transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-crl/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-users text-crl"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        52
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Classmates</div>
                </div>
            </div>

            <!-- Polls -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-pnk transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-pnk/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-square-poll-vertical text-pnk"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        2
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Active Polls</div>
                </div>
            </div>

            <!-- Feedback -->
            <div
                class="stat-card animate-fadeUp bg-card border border-bdr rounded-2xl p-4 flex flex-col gap-2.5 hover:border-red transition-all hover:-translate-y-0.5 cursor-default">
                <div class="w-10 h-10 rounded-xl bg-red/15 flex items-center justify-center text-base">
                    <i class="fa-solid fa-comments text-red"></i>
                </div>
                <div>
                    <div class="stat-value text-[1.6rem] font-bold leading-none text-prim">
                        14
                    </div>
                    <div class="text-[0.72rem] text-sec mt-1">Feedbacks</div>
                </div>
            </div>
        </div>
        <!-- /stats grid -->

        <!-- ── SECTION HEADING: Latest Updates ── -->
        <div class="flex items-center justify-between mb-3 mt-1">
            <h2 class="text-[0.78rem] font-semibold uppercase tracking-widest text-sec">
                <i class="fa-solid fa-table-columns text-accent mr-1.5"></i>Latest
                Updates
            </h2>
        </div>

        <!-- ── CONTENT GRID (2 columns on md+) ── -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- ════ LEFT PANEL: Important Notices ════ -->
            <div class="bg-card border border-bdr rounded-2xl overflow-hidden animate-fadeUp">
                <!-- Panel Header -->
                <div class="flex items-center justify-between px-4 py-3.5 border-b border-bdr bg-white/[.015]">
                    <div class="flex items-center gap-2 text-[0.82rem] font-semibold text-prim">
                        <i class="fa-solid fa-bell text-accent text-[0.85rem]"></i>
                        Important Notices
                    </div>
                    <a href="#"
                        class="text-[0.72rem] text-accent font-medium hover:text-ahover transition-colors">View all
                        →</a>
                </div>

                <!-- Notice rows -->
                <div class="py-2">
                    <!-- Row 1 — Urgent -->
                    <div class="notice-row flex items-start gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors"
                        onclick="
                this.style.background = 'rgba(61,127,255,.08)';
                setTimeout(() => (this.style.background = ''), 300);
              ">
                        <div class="w-2 h-2 rounded-full bg-red mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-[0.8rem] font-medium text-prim leading-snug">
                                Complete Computer &amp; Cyber Security lab report before the
                                exam
                            </p>
                            <div class="flex items-center gap-2.5 mt-1 text-[0.68rem] text-hint">
                                <i class="fa-regular fa-clock text-[0.65rem]"></i> 2 hours ago
                                <span
                                    class="bg-red/15 text-red px-1.5 py-px rounded-full text-[0.6rem] font-semibold uppercase tracking-wide">Urgent</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2 — Exam -->
                    <div class="notice-row flex items-start gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors"
                        onclick="
                this.style.background = 'rgba(61,127,255,.08)';
                setTimeout(() => (this.style.background = ''), 300);
              ">
                        <div class="w-2 h-2 rounded-full bg-accent mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-[0.8rem] font-medium text-prim leading-snug">
                                Mid-term exam routine published — check the Routine section
                            </p>
                            <div class="flex items-center gap-2.5 mt-1 text-[0.68rem] text-hint">
                                <i class="fa-regular fa-clock text-[0.65rem]"></i> Yesterday
                                <span
                                    class="bg-amb/15 text-amb px-1.5 py-px rounded-full text-[0.6rem] font-semibold uppercase tracking-wide">Exam</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 3 — Updated -->
                    <div class="notice-row flex items-start gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors"
                        onclick="
                this.style.background = 'rgba(61,127,255,.08)';
                setTimeout(() => (this.style.background = ''), 300);
              ">
                        <div class="w-2 h-2 rounded-full bg-accent mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-[0.8rem] font-medium text-prim leading-snug">
                                Data Structures Assignment #4 deadline extended to 30 May
                            </p>
                            <div class="flex items-center gap-2.5 mt-1 text-[0.68rem] text-hint">
                                <i class="fa-regular fa-clock text-[0.65rem]"></i> 2 days ago
                                <span
                                    class="bg-accent/15 text-accent px-1.5 py-px rounded-full text-[0.6rem] font-semibold uppercase tracking-wide">Updated</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 4 — Resource -->
                    <div class="notice-row flex items-start gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors"
                        onclick="
                this.style.background = 'rgba(61,127,255,.08)';
                setTimeout(() => (this.style.background = ''), 300);
              ">
                        <div class="w-2 h-2 rounded-full bg-grn mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-[0.8rem] font-medium text-prim leading-snug">
                                New study material uploaded for Computer Networks — Chapter 5
                            </p>
                            <div class="flex items-center gap-2.5 mt-1 text-[0.68rem] text-hint">
                                <i class="fa-regular fa-clock text-[0.65rem]"></i> 3 days ago
                                <span
                                    class="bg-grn/15 text-grn px-1.5 py-px rounded-full text-[0.6rem] font-semibold uppercase tracking-wide">Resource</span>
                            </div>
                        </div>
                    </div>

                    <!-- Row 5 — Schedule -->
                    <div class="notice-row flex items-start gap-3 px-4 py-3 cursor-pointer hover:bg-hover transition-colors"
                        onclick="
                this.style.background = 'rgba(61,127,255,.08)';
                setTimeout(() => (this.style.background = ''), 300);
              ">
                        <div class="w-2 h-2 rounded-full bg-grn mt-1.5 shrink-0"></div>
                        <div>
                            <p class="text-[0.8rem] font-medium text-prim leading-snug">
                                Lab session rescheduled — Thursday group move to Friday 10am
                            </p>
                            <div class="flex items-center gap-2.5 mt-1 text-[0.68rem] text-hint">
                                <i class="fa-regular fa-clock text-[0.65rem]"></i> 4 days ago
                                <span
                                    class="bg-grn/15 text-grn px-1.5 py-px rounded-full text-[0.6rem] font-semibold uppercase tracking-wide">Schedule</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /left panel -->

            <!-- ════ RIGHT COLUMN ════ -->
            <div class="flex flex-col gap-4">
                <!-- Assignments Panel -->
                <div class="bg-card border border-bdr rounded-2xl overflow-hidden animate-fadeUp">
                    <!-- Panel Header -->
                    <div class="flex items-center justify-between px-4 py-3.5 border-b border-bdr bg-white/[.015]">
                        <div class="flex items-center gap-2 text-[0.82rem] font-semibold text-prim">
                            <i class="fa-solid fa-file-pen text-accent text-[0.85rem]"></i>
                            Upcoming Assignments
                        </div>
                        <a href="#"
                            class="text-[0.72rem] text-accent font-medium hover:text-ahover transition-colors">View all
                            →</a>
                    </div>

                    <!-- Quick actions -->
                    <div class="flex gap-2 px-4 py-2.5 border-b border-bdr overflow-x-auto no-scroll">
                        <button
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-input border border-bdr rounded-md text-[0.72rem] font-medium text-sec whitespace-nowrap hover:text-prim hover:border-accent hover:bg-accent/10 transition-all">
                            <i class="fa-solid fa-plus text-accent text-[0.75rem]"></i>
                            Submit
                        </button>
                        <button
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-input border border-bdr rounded-md text-[0.72rem] font-medium text-sec whitespace-nowrap hover:text-prim hover:border-accent hover:bg-accent/10 transition-all">
                            <i class="fa-solid fa-filter text-accent text-[0.75rem]"></i>
                            Filter
                        </button>
                        <button
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-input border border-bdr rounded-md text-[0.72rem] font-medium text-sec whitespace-nowrap hover:text-prim hover:border-accent hover:bg-accent/10 transition-all">
                            <i class="fa-solid fa-sort text-accent text-[0.75rem]"></i> Sort
                            by date
                        </button>
                    </div>

                    <!-- Assignment rows -->
                    <div class="py-2">
                        <div
                            class="flex items-center gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors">
                            <div
                                class="w-9 h-9 rounded-xl bg-amb/15 flex items-center justify-center text-[0.85rem] shrink-0">
                                <i class="fa-solid fa-database text-amb"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[0.8rem] font-medium text-prim truncate">
                                    Data Structures — Assignment #4
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>Due: 30 May · DSA
                                </p>
                            </div>
                            <span
                                class="bg-amb/15 text-amb text-[0.65rem] font-semibold px-2.5 py-1 rounded-full shrink-0">Soon</span>
                        </div>

                        <div
                            class="flex items-center gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors">
                            <div
                                class="w-9 h-9 rounded-xl bg-red/15 flex items-center justify-center text-[0.85rem] shrink-0">
                                <i class="fa-solid fa-network-wired text-red"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[0.8rem] font-medium text-prim truncate">
                                    Computer Networks — Lab Report #3
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>Due: 22 May ·
                                    Networks
                                </p>
                            </div>
                            <span
                                class="bg-red/15 text-red text-[0.65rem] font-semibold px-2.5 py-1 rounded-full shrink-0">Due
                                soon</span>
                        </div>

                        <div
                            class="flex items-center gap-3 px-4 py-3 border-b border-bdr cursor-pointer hover:bg-hover transition-colors">
                            <div
                                class="w-9 h-9 rounded-xl bg-grn/15 flex items-center justify-center text-[0.85rem] shrink-0">
                                <i class="fa-brands fa-python text-grn"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[0.8rem] font-medium text-prim truncate">
                                    OOP in Python — Project Submission
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>Due: 5 Jun · OOP
                                </p>
                            </div>
                            <span
                                class="bg-grn/15 text-grn text-[0.65rem] font-semibold px-2.5 py-1 rounded-full shrink-0">Open</span>
                        </div>

                        <div class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-hover transition-colors">
                            <div
                                class="w-9 h-9 rounded-xl bg-bdr flex items-center justify-center text-[0.85rem] shrink-0">
                                <i class="fa-solid fa-microchip text-hint"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-[0.8rem] font-medium text-prim truncate">
                                    Digital Logic Design — Quiz Prep
                                </p>
                                <p class="text-[0.68rem] text-hint mt-0.5">
                                    <i class="fa-regular fa-clock mr-1"></i>Submitted · DLD
                                </p>
                            </div>
                            <span
                                class="bg-bdr text-hint text-[0.65rem] font-semibold px-2.5 py-1 rounded-full shrink-0">Closed</span>
                        </div>
                    </div>
                </div>
                <!-- /assignments -->

                <!-- Poll Panel -->
                <div class="bg-card border border-bdr rounded-2xl overflow-hidden animate-fadeUp">
                    <div class="flex items-center justify-between px-4 py-3.5 border-b border-bdr bg-white/[.015]">
                        <div class="flex items-center gap-2 text-[0.82rem] font-semibold text-prim">
                            <i class="fa-solid fa-square-poll-vertical text-accent text-[0.85rem]"></i>
                            Active Poll
                        </div>
                        <a href="#"
                            class="text-[0.72rem] text-accent font-medium hover:text-ahover transition-colors">Vote
                            →</a>
                    </div>

                    <div class="px-4 py-4">
                        <p class="text-[0.8rem] font-medium text-prim mb-3">
                            Which lab session time works best for the group?
                        </p>

                        <!-- Option 1 -->
                        <div class="mb-3">
                            <div class="flex justify-between text-[0.72rem] text-sec mb-1">
                                <span>Thursday 10:00 AM</span>
                                <span class="text-accent font-semibold">42%</span>
                            </div>
                            <div class="h-[5px] bg-bdr rounded-full overflow-hidden">
                                <div class="poll-bar h-full bg-accent rounded-full" style="width: 42%"></div>
                            </div>
                        </div>

                        <!-- Option 2 -->
                        <div class="mb-3">
                            <div class="flex justify-between text-[0.72rem] text-sec mb-1">
                                <span>Friday 10:00 AM</span>
                                <span class="text-grn font-semibold">35%</span>
                            </div>
                            <div class="h-[5px] bg-bdr rounded-full overflow-hidden">
                                <div class="poll-bar h-full bg-grn rounded-full" style="width: 35%"></div>
                            </div>
                        </div>

                        <!-- Option 3 -->
                        <div class="mb-3">
                            <div class="flex justify-between text-[0.72rem] text-sec mb-1">
                                <span>Saturday 9:00 AM</span>
                                <span class="text-amb font-semibold">23%</span>
                            </div>
                            <div class="h-[5px] bg-bdr rounded-full overflow-hidden">
                                <div class="poll-bar h-full bg-amb rounded-full" style="width: 23%"></div>
                            </div>
                        </div>

                        <p class="text-[0.68rem] text-hint mt-2">
                            <i class="fa-solid fa-users mr-1"></i>38 votes · Closes May 20
                        </p>
                    </div>
                </div>
                <!-- /poll -->
            </div>
            <!-- /right column -->
        </div>
        <!-- /content grid -->
    </main>

@endsection
