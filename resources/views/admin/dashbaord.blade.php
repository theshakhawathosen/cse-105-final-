@extends('layouts.admin.admin-layout')
@section('title', 'Dashboard')
@section('content')
    <main id="main-content">

        <!-- ── DASHBOARD TAB ── -->
        <div id="tab-dashboard">

            <!-- Welcome header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="section-label"><i class="fas fa-circle text-[6px] pulse-anim"></i>Live
                            Dashboard</span>
                    </div>
                    <h1 class="text-xl font-bold text-tp">Welcome back, Admin 👋</h1>
                    <p class="text-ts text-sm mt-0.5">Manage all batch activities efficiently from one dashboard.</p>
                </div>
                <div class="flex items-center gap-2.5">
                    <div class="bg-card border border-border rounded-xl px-4 py-2 text-center">
                        <div class="text-ts text-[10px]">Last sync</div>
                        <div class="text-tp text-xs font-semibold">Just now</div>
                    </div>
                    <button class="btn-primary text-sm" onclick="openModal('notice-modal')">
                        <i class="fas fa-plus mr-1.5 text-xs"></i>New Notice
                    </button>
                </div>
            </div>

            <!-- Stats grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6 stats-grid">
                <!-- S1 -->
                <div class="dash-card stat-card fade-up fade-up-d1" style="--accent-color:var(--accent)">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-accent text-sm"
                            style="background:rgba(61,127,255,.12)"><i class="fas fa-user-graduate"></i></div>
                        <span class="chip chip-green">↑ 4.2%</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="152">0</div>
                    <div class="text-ts text-xs mt-0.5">Total Students</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill bg-accent" style="width:76%"></div>
                    </div>
                </div>
                <!-- S2 -->
                <div class="dash-card stat-card fade-up fade-up-d2">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-amber text-sm"
                            style="background:rgba(245,166,35,.12)"><i class="fas fa-chalkboard-teacher"></i></div>
                        <span class="chip chip-amber">↑ 1</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="12">0</div>
                    <div class="text-ts text-xs mt-0.5">Total Teachers</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:60%;background:var(--amber)"></div>
                    </div>
                </div>
                <!-- S3 -->
                <div class="dash-card stat-card fade-up fade-up-d3">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-red text-sm"
                            style="background:rgba(255,77,106,.12)"><i class="fas fa-bullhorn"></i></div>
                        <span class="chip chip-red">● Urgent</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="24">0</div>
                    <div class="text-ts text-xs mt-0.5">Active Notices</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:82%;background:var(--red)"></div>
                    </div>
                </div>
                <!-- S4 -->
                <div class="dash-card stat-card fade-up fade-up-d4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-purple text-sm"
                            style="background:rgba(167,139,250,.12)"><i class="fas fa-tasks"></i></div>
                        <span class="chip chip-purple">7 Active</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="31">0</div>
                    <div class="text-ts text-xs mt-0.5">Assignments</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:55%;background:var(--purple)"></div>
                    </div>
                </div>
                <!-- S5 -->
                <div class="dash-card stat-card fade-up fade-up-d5">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-coral text-sm"
                            style="background:rgba(251,146,60,.12)"><i class="fas fa-hourglass-half"></i></div>
                        <span class="chip chip-amber">↓ 12%</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="47">0</div>
                    <div class="text-ts text-xs mt-0.5">Pending Submissions</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:40%;background:var(--coral)"></div>
                    </div>
                </div>
                <!-- S6 -->
                <div class="dash-card stat-card fade-up fade-up-d6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-teal text-sm"
                            style="background:rgba(34,211,238,.12)"><i class="fas fa-flask"></i></div>
                        <span class="chip chip-teal">↑ 8</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="89">0</div>
                    <div class="text-ts text-xs mt-0.5">Lab Reports</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:68%;background:var(--teal)"></div>
                    </div>
                </div>
                <!-- S7 -->
                <div class="dash-card stat-card fade-up fade-up-d7">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-green text-sm"
                            style="background:rgba(41,214,142,.12)"><i class="fas fa-poll"></i></div>
                        <span class="chip chip-green">3 Active</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="18">0</div>
                    <div class="text-ts text-xs mt-0.5">Total Polls</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:72%;background:var(--green)"></div>
                    </div>
                </div>
                <!-- S8 -->
                <div class="dash-card stat-card fade-up fade-up-d8">
                    <div class="flex items-start justify-between mb-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center text-pink text-sm"
                            style="background:rgba(244,114,182,.12)"><i class="fas fa-comments"></i></div>
                        <span class="chip chip-purple">7 New</span>
                    </div>
                    <div class="text-2xl font-bold text-tp counter" data-target="34">0</div>
                    <div class="text-ts text-xs mt-0.5">Feedback</div>
                    <div class="mt-3 progress h-1">
                        <div class="progress-fill" style="width:45%;background:var(--pink)"></div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="dash-card p-4 mb-5 fade-up fade-up-d2">
                <div class="section-hd mb-3">
                    <div class="section-title"><i class="fas fa-bolt text-accent"></i>Quick Actions</div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-2 qa-grid">
                    <div class="qa-card" onclick="openModal('notice-modal')">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-accent text-sm"
                            style="background:rgba(61,127,255,.12)"><i class="fas fa-bullhorn"></i></div>
                        <span class="text-tp text-xs font-semibold">Add Notice</span>
                    </div>
                    <div class="qa-card" onclick="openModal('assignment-modal')">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-amber text-sm"
                            style="background:rgba(245,166,35,.12)"><i class="fas fa-tasks"></i></div>
                        <span class="text-tp text-xs font-semibold">Assignment</span>
                    </div>
                    <div class="qa-card" onclick="openModal('resource-modal')">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-purple text-sm"
                            style="background:rgba(167,139,250,.12)"><i class="fas fa-flask"></i></div>
                        <span class="text-tp text-xs font-semibold">Lab Report</span>
                    </div>
                    <div class="qa-card">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-green text-sm"
                            style="background:rgba(41,214,142,.12)"><i class="fas fa-calendar-plus"></i></div>
                        <span class="text-tp text-xs font-semibold">Add Routine</span>
                    </div>
                    <div class="qa-card" onclick="openModal('poll-modal')">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-teal text-sm"
                            style="background:rgba(34,211,238,.12)"><i class="fas fa-poll"></i></div>
                        <span class="text-tp text-xs font-semibold">Create Poll</span>
                    </div>
                    <div class="qa-card" onclick="openModal('resource-modal')">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-coral text-sm"
                            style="background:rgba(251,146,60,.12)"><i class="fas fa-cloud-upload-alt"></i></div>
                        <span class="text-tp text-xs font-semibold">Resource</span>
                    </div>
                </div>
            </div>

            <!-- Middle Row: Notices + Activity -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

                <!-- Recent Notices -->
                <div class="dash-card p-4 lg:col-span-2 fade-up fade-up-d2">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-bullhorn text-accent text-sm"></i>Recent Notices
                        </div>
                        <div class="flex gap-2">
                            <button class="btn-ghost text-xs py-1 px-3" onclick="openModal('notice-modal')"><i
                                    class="fas fa-plus mr-1 text-[10px]"></i>Add</button>
                            <button class="btn-ghost text-xs py-1 px-3">View All</button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="text-tp text-xs font-medium">Midterm Exam Timetable</div>
                                        <div class="text-ts text-[10px]">Dr. Ahmed · Academic</div>
                                    </td>
                                    <td><span class="chip chip-blue">Academic</span></td>
                                    <td class="text-ts text-xs">May 17, 2026</td>
                                    <td><span class="chip chip-green">Published</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-tp text-xs font-medium">Lab Makeup Class — Friday</div>
                                        <div class="text-ts text-[10px]">Lab Dept · Lab</div>
                                    </td>
                                    <td><span class="chip chip-purple">Lab</span></td>
                                    <td class="text-ts text-xs">May 16, 2026</td>
                                    <td><span class="chip chip-red">Urgent</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-tp text-xs font-medium">Assignment 3 Deadline Extended</div>
                                        <div class="text-ts text-[10px]">CR · Assignment</div>
                                    </td>
                                    <td><span class="chip chip-amber">Assignment</span></td>
                                    <td class="text-ts text-xs">May 15, 2026</td>
                                    <td><span class="chip chip-muted">Draft</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon pub"><i
                                                    class="fas fa-upload"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="text-tp text-xs font-medium">Semester Result Published</div>
                                        <div class="text-ts text-[10px]">Controller · Result</div>
                                    </td>
                                    <td><span class="chip chip-green">Result</span></td>
                                    <td class="text-ts text-xs">May 14, 2026</td>
                                    <td><span class="chip chip-green">Published</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Activity Feed -->
                <div class="dash-card p-4 fade-up fade-up-d3">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-stream text-green text-sm"></i>Activity Feed</div>
                        <span class="chip chip-green text-[9px]">Live</span>
                    </div>
                    <div class="space-y-3 mt-2">
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="timeline-dot" style="background:rgba(61,127,255,.15);color:var(--acc)"><i
                                        class="fas fa-user-plus text-[10px]"></i></div>
                                <div class="timeline-line h-8 w-px bg-border mt-1"></div>
                            </div>
                            <div class="pb-3">
                                <div class="text-tp text-xs font-medium">New student registered</div>
                                <div class="text-ts text-[10px]">Karim Hasan — Roll 2024331153</div>
                                <div class="text-muted text-[9px] mt-0.5">2 min ago</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="timeline-dot" style="background:rgba(245,166,35,.15);color:var(--amber)">
                                    <i class="fas fa-tasks text-[10px]"></i>
                                </div>
                                <div class="timeline-line h-8 w-px bg-border mt-1"></div>
                            </div>
                            <div class="pb-3">
                                <div class="text-tp text-xs font-medium">Assignment uploaded</div>
                                <div class="text-ts text-[10px]">Data Structures #3 — DS Dept</div>
                                <div class="text-muted text-[9px] mt-0.5">35 min ago</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="timeline-dot" style="background:rgba(255,77,106,.15);color:var(--red)"><i
                                        class="fas fa-bullhorn text-[10px]"></i></div>
                                <div class="timeline-line h-8 w-px bg-border mt-1"></div>
                            </div>
                            <div class="pb-3">
                                <div class="text-tp text-xs font-medium">Notice published</div>
                                <div class="text-ts text-[10px]">Midterm Exam Timetable live</div>
                                <div class="text-muted text-[9px] mt-0.5">2 hours ago</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="timeline-dot" style="background:rgba(34,211,238,.15);color:var(--teal)"><i
                                        class="fas fa-poll text-[10px]"></i></div>
                                <div class="timeline-line h-8 w-px bg-border mt-1"></div>
                            </div>
                            <div class="pb-3">
                                <div class="text-tp text-xs font-medium">Poll created</div>
                                <div class="text-ts text-[10px]">Study time preference — 87 votes</div>
                                <div class="text-muted text-[9px] mt-0.5">4 hours ago</div>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="timeline-dot" style="background:rgba(41,214,142,.15);color:var(--green)">
                                    <i class="fas fa-cloud-upload-alt text-[10px]"></i>
                                </div>
                            </div>
                            <div>
                                <div class="text-tp text-xs font-medium">Resource uploaded</div>
                                <div class="text-ts text-[10px]">OOP Notes — Chapter 5</div>
                                <div class="text-muted text-[9px] mt-0.5">Yesterday</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Assignments + Students Row -->
            <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 mb-5">

                <!-- Assignments -->
                <div class="dash-card p-4 lg:col-span-2 fade-up fade-up-d3">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-tasks text-amber text-sm"></i>Assignments</div>
                        <button class="btn-ghost text-xs py-1 px-3" onclick="openModal('assignment-modal')"><i
                                class="fas fa-plus mr-1 text-[10px]"></i>New</button>
                    </div>
                    <div class="space-y-2.5 mt-1">
                        <div class="bg-input border border-border rounded-xl p-3">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div>
                                    <div class="text-tp text-xs font-semibold">Data Structures #3</div>
                                    <div class="text-ts text-[10px]">CSE-201 · Dr. Khan</div>
                                </div>
                                <span class="chip chip-red flex-shrink-0">Due Fri</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-ts mb-1.5">
                                <span><i class="fas fa-users mr-1"></i>89/152 submitted</span>
                                <span>59%</span>
                            </div>
                            <div class="progress h-1.5">
                                <div class="progress-fill bg-accent" style="width:59%"></div>
                            </div>
                        </div>
                        <div class="bg-input border border-border rounded-xl p-3">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div>
                                    <div class="text-tp text-xs font-semibold">OOP Lab Report</div>
                                    <div class="text-ts text-[10px]">CSE-203 · Dr. Rahim</div>
                                </div>
                                <span class="chip chip-amber flex-shrink-0">Due Mon</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-ts mb-1.5">
                                <span><i class="fas fa-users mr-1"></i>34/152 submitted</span>
                                <span>22%</span>
                            </div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:22%;background:var(--amber)"></div>
                            </div>
                        </div>
                        <div class="bg-input border border-border rounded-xl p-3">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <div>
                                    <div class="text-tp text-xs font-semibold">Discrete Math HW</div>
                                    <div class="text-ts text-[10px]">CSE-111 · Dr. Islam</div>
                                </div>
                                <span class="chip chip-green flex-shrink-0">Closed</span>
                            </div>
                            <div class="flex items-center justify-between text-[10px] text-ts mb-1.5">
                                <span><i class="fas fa-users mr-1"></i>148/152 submitted</span>
                                <span>97%</span>
                            </div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:97%;background:var(--green)"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Table -->
                <div class="dash-card p-4 lg:col-span-3 fade-up fade-up-d4">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-user-graduate text-accent text-sm"></i>Students
                        </div>
                        <div class="flex gap-2">
                            <div class="search-bar" style="max-width:160px;height:30px">
                                <i class="fas fa-search text-muted text-[10px]"></i>
                                <input type="text" placeholder="Search..." style="font-size:.72rem">
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>ID</th>
                                    <th>Semester</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div
                                                class="w-7 h-7 rounded-lg bg-accent flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                                                R</div>
                                            <div>
                                                <div class="text-tp text-xs font-medium">Rahim Ahmed</div>
                                                <div class="text-ts text-[9px]">rahim@cse105.edu</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-ts text-xs">2024331008</td>
                                    <td><span class="chip chip-blue">Sem 2</span></td>
                                    <td><span class="chip chip-green">Active</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0"
                                                style="background:var(--purple)">N</div>
                                            <div>
                                                <div class="text-tp text-xs font-medium">Nadia Khan</div>
                                                <div class="text-ts text-[9px]">nadia@cse105.edu</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-ts text-xs">2024331021</td>
                                    <td><span class="chip chip-blue">Sem 2</span></td>
                                    <td><span class="chip chip-green">Active</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0"
                                                style="background:var(--teal)">S</div>
                                            <div>
                                                <div class="text-tp text-xs font-medium">Sabbir Hossain</div>
                                                <div class="text-ts text-[9px]">sabbir@cse105.edu</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-ts text-xs">2024331045</td>
                                    <td><span class="chip chip-blue">Sem 2</span></td>
                                    <td><span class="chip chip-amber">Irregular</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="flex items-center gap-2">
                                            <div class="w-7 h-7 rounded-lg flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0"
                                                style="background:var(--coral)">F</div>
                                            <div>
                                                <div class="text-tp text-xs font-medium">Fatima Begum</div>
                                                <div class="text-ts text-[9px]">fatima@cse105.edu</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-ts text-xs">2024331067</td>
                                    <td><span class="chip chip-blue">Sem 2</span></td>
                                    <td><span class="chip chip-green">Active</span></td>
                                    <td>
                                        <div class="flex gap-1"><button class="btn-icon view"><i
                                                    class="fas fa-eye"></i></button><button class="btn-icon edit"><i
                                                    class="fas fa-pen"></i></button><button class="btn-icon del"><i
                                                    class="fas fa-trash"></i></button></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-border">
                        <span class="text-ts text-[10px]">Showing 4 of 152 students</span>
                        <button class="btn-ghost text-xs py-1 px-3">View All <i
                                class="fas fa-arrow-right ml-1 text-[10px]"></i></button>
                    </div>
                </div>
            </div>

            <!-- Analytics + Poll + Feedback Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 mb-5">

                <!-- Analytics chart -->
                <div class="dash-card p-4 fade-up fade-up-d3">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-chart-bar text-purple text-sm"></i>Submissions
                        </div>
                        <span class="text-ts text-[10px]">This week</span>
                    </div>
                    <div class="flex items-end gap-1.5 h-32 mt-4" id="bar-chart">
                        <!-- bars rendered by JS -->
                    </div>
                    <div class="flex justify-between mt-2">
                        <span class="text-ts text-[9px]">Mon</span>
                        <span class="text-ts text-[9px]">Tue</span>
                        <span class="text-ts text-[9px]">Wed</span>
                        <span class="text-ts text-[9px]">Thu</span>
                        <span class="text-ts text-[9px]">Fri</span>
                        <span class="text-ts text-[9px]">Sat</span>
                        <span class="text-ts text-[9px]">Sun</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 mt-4">
                        <div class="bg-input rounded-xl p-2.5">
                            <div class="text-tp text-sm font-bold">89</div>
                            <div class="text-ts text-[10px]">Submissions</div>
                        </div>
                        <div class="bg-input rounded-xl p-2.5">
                            <div class="text-green text-sm font-bold">↑ 24%</div>
                            <div class="text-ts text-[10px]">vs last week</div>
                        </div>
                    </div>
                </div>

                <!-- Poll widget -->
                <div class="dash-card p-4 fade-up fade-up-d4">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-poll text-teal text-sm"></i>Active Polls</div>
                        <button class="btn-ghost text-xs py-1 px-3" onclick="openModal('poll-modal')"><i
                                class="fas fa-plus mr-1 text-[10px]"></i>New</button>
                    </div>
                    <div class="space-y-3 mt-2">
                        <div class="bg-input border border-border rounded-xl p-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="text-tp text-xs font-semibold">Best study time?</div>
                                <span class="chip chip-green">Active</span>
                            </div>
                            <div class="text-ts text-[10px] mb-2">87 votes · Ends May 19</div>
                            <div class="space-y-1.5">
                                <div>
                                    <div class="flex justify-between mb-1 text-[10px]"><span
                                            class="text-ts">Morning</span><span
                                            class="text-accent font-semibold">58%</span></div>
                                    <div class="progress h-1.5">
                                        <div class="progress-fill bg-accent" style="width:58%"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1 text-[10px]"><span
                                            class="text-ts">Night</span><span class="text-purple font-semibold">42%</span>
                                    </div>
                                    <div class="progress h-1.5">
                                        <div class="progress-fill" style="width:42%;background:var(--purple)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-input border border-border rounded-xl p-3">
                            <div class="flex items-center justify-between mb-1.5">
                                <div class="text-tp text-xs font-semibold">Group study day?</div>
                                <span class="chip chip-amber">Closing</span>
                            </div>
                            <div class="text-ts text-[10px] mb-2">62 votes · Ends today</div>
                            <div class="space-y-1.5">
                                <div>
                                    <div class="flex justify-between mb-1 text-[10px]"><span
                                            class="text-ts">Thursday</span><span
                                            class="text-teal font-semibold">62%</span></div>
                                    <div class="progress h-1.5">
                                        <div class="progress-fill" style="width:62%;background:var(--teal)"></div>
                                    </div>
                                </div>
                                <div>
                                    <div class="flex justify-between mb-1 text-[10px]"><span
                                            class="text-ts">Friday</span><span class="text-amber font-semibold">38%</span>
                                    </div>
                                    <div class="progress h-1.5">
                                        <div class="progress-fill" style="width:38%;background:var(--amber)"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Feedback inbox -->
                <div class="dash-card p-4 fade-up fade-up-d5">
                    <div class="section-hd">
                        <div class="section-title"><i class="fas fa-inbox text-pink text-sm"></i>Feedback Inbox</div>
                        <span class="chip chip-purple">7 New</span>
                    </div>
                    <div class="space-y-2.5 mt-2">
                        <div class="fb-card">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-lg bg-red bg-opacity-15 flex items-center justify-center text-red text-[9px] font-bold flex-shrink-0">
                                        R</div>
                                    <div class="text-tp text-xs font-semibold">Rahim Ahmed</div>
                                </div>
                                <span class="chip chip-red flex-shrink-0" style="font-size:.5rem">Urgent</span>
                            </div>
                            <p class="text-ts text-[10px] leading-relaxed line-clamp-2">The assignment submission link
                                is not working for the last 2 hours. Please fix it ASAP.</p>
                            <div class="text-muted text-[9px] mt-1">2 hours ago</div>
                        </div>
                        <div class="fb-card">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center text-white text-[9px] font-bold flex-shrink-0"
                                        style="background:var(--purple)">N</div>
                                    <div class="text-tp text-xs font-semibold">Nadia Khan</div>
                                </div>
                                <span class="chip chip-amber flex-shrink-0" style="font-size:.5rem">Medium</span>
                            </div>
                            <p class="text-ts text-[10px] leading-relaxed line-clamp-2">Could you add a dark mode
                                toggle for the mobile view? The current UI is a bit bright at night.</p>
                            <div class="text-muted text-[9px] mt-1">Yesterday</div>
                        </div>
                        <div class="fb-card">
                            <div class="flex items-start justify-between gap-2 mb-1">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-lg flex items-center justify-center text-white text-[9px] font-bold flex-shrink-0"
                                        style="background:var(--teal)">S</div>
                                    <div class="text-tp text-xs font-semibold">Sabbir Hossain</div>
                                </div>
                                <span class="chip chip-green flex-shrink-0" style="font-size:.5rem">Suggestion</span>
                            </div>
                            <p class="text-ts text-[10px] leading-relaxed line-clamp-2">Great platform! Can we have
                                email notifications for new notices?</p>
                            <div class="text-muted text-[9px] mt-1">2 days ago</div>
                        </div>
                    </div>
                    <button class="btn-ghost text-xs w-full mt-3 py-2">View All Feedback</button>
                </div>
            </div>

            <!-- Donut + Resource stats row -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-5">
                <div class="dash-card p-4 fade-up fade-up-d3 col-span-1 md:col-span-2">
                    <div class="section-hd mb-3">
                        <div class="section-title"><i class="fas fa-chart-pie text-accent text-sm"></i>Engagement
                            Overview</div>
                        <span class="text-ts text-[10px]">May 2026</span>
                    </div>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <svg viewBox="0 0 120 120" class="w-28 h-28 flex-shrink-0">
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#1f2333"
                                stroke-width="12" />
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#3d7fff"
                                stroke-width="12" stroke-dasharray="115 174" stroke-linecap="round"
                                class="donut-ring" />
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#a78bfa"
                                stroke-width="12" stroke-dasharray="52 237" stroke-dashoffset="-115"
                                stroke-linecap="round" class="donut-ring" />
                            <circle cx="60" cy="60" r="46" fill="none" stroke="#29d68e"
                                stroke-width="12" stroke-dasharray="35 254" stroke-dashoffset="-167"
                                stroke-linecap="round" class="donut-ring" />
                            <text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Poppins"
                                font-size="13" font-weight="700" fill="#e8eaf0">87%</text>
                            <text x="50%" y="63%" dominant-baseline="middle" text-anchor="middle" font-family="Poppins"
                                font-size="5.5" fill="#7c8090">Overall</text>
                        </svg>
                        <div class="space-y-2.5 flex-1">
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-accent flex-shrink-0"></div><span
                                        class="text-ts text-xs">Notice Views</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="progress h-1.5 flex-1" style="width:80px">
                                        <div class="progress-fill bg-accent" style="width:74%"></div>
                                    </div><span class="text-tp text-xs font-semibold">74%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:var(--purple)">
                                    </div><span class="text-ts text-xs">Assignment Sub.</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="progress h-1.5 flex-1" style="width:80px">
                                        <div class="progress-fill" style="width:59%;background:var(--purple)"></div>
                                    </div><span class="text-tp text-xs font-semibold">59%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:var(--green)">
                                    </div><span class="text-ts text-xs">Resource
                                        DLs</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="progress h-1.5 flex-1" style="width:80px">
                                        <div class="progress-fill" style="width:81%;background:var(--green)"></div>
                                    </div><span class="text-tp text-xs font-semibold">81%</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background:var(--amber)">
                                    </div><span class="text-ts text-xs">Poll
                                        Votes</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="progress h-1.5 flex-1" style="width:80px">
                                        <div class="progress-fill" style="width:57%;background:var(--amber)"></div>
                                    </div><span class="text-tp text-xs font-semibold">57%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mini stats -->
                <div class="dash-card p-4 fade-up fade-up-d4">
                    <div class="section-title mb-4"><i class="fas fa-download text-teal text-sm"></i>Resource
                        Downloads</div>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-[10px] mb-1"><span class="text-ts">OOP Notes
                                    Ch5</span><span class="text-tp font-semibold">234</span></div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:85%;background:var(--teal)"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] mb-1"><span class="text-ts">DS Past
                                    Papers</span><span class="text-tp font-semibold">198</span></div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:72%;background:var(--teal)"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] mb-1"><span class="text-ts">Math
                                    Formula</span><span class="text-tp font-semibold">167</span></div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:61%;background:var(--teal)"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] mb-1"><span class="text-ts">Lab
                                    Manual</span><span class="text-tp font-semibold">143</span></div>
                            <div class="progress h-1.5">
                                <div class="progress-fill" style="width:52%;background:var(--teal)"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dash-card p-4 fade-up fade-up-d5">
                    <div class="section-title mb-4"><i class="fas fa-users text-green text-sm"></i>Student Status
                    </div>
                    <div class="space-y-2.5">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green pulse-anim"></div><span
                                    class="text-ts text-xs">Online Now</span>
                            </div>
                            <span class="text-tp text-sm font-bold">48</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-accent"></div><span class="text-ts text-xs">Active
                                    Today</span>
                            </div>
                            <span class="text-tp text-sm font-bold">127</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-amber"></div><span
                                    class="text-ts text-xs">Irregular</span>
                            </div>
                            <span class="text-tp text-sm font-bold">14</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-red"></div><span
                                    class="text-ts text-xs">Inactive</span>
                            </div>
                            <span class="text-tp text-sm font-bold">11</span>
                        </div>
                        <div class="mt-4 pt-3 border-t border-border">
                            <div class="text-ts text-[10px] mb-1.5">Batch activity rate</div>
                            <div class="progress h-2">
                                <div class="progress-fill bg-green" style="width:84%"></div>
                            </div>
                            <div class="text-green text-xs font-semibold mt-1">84% Active</div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /tab-dashboard -->

        <!-- Placeholder tabs (hidden) -->
        <div id="tab-students" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-user-graduate text-5xl text-accent mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Students Management</div>
                <div class="text-ts text-sm">Full student management panel — view, edit, add, remove students.</div>
            </div>
        </div>
        <div id="tab-teachers" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-chalkboard-teacher text-5xl text-amber mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Teachers Directory</div>
                <div class="text-ts text-sm">Manage teacher profiles, courses, and contact info.</div>
            </div>
        </div>
        <div id="tab-notices" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-bullhorn text-5xl text-red mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Notice Management</div>
                <div class="text-ts text-sm">Create, publish, draft and manage all batch notices.</div>
            </div>
        </div>
        <div id="tab-assignments" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-tasks text-5xl text-purple mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Assignment Tracker</div>
                <div class="text-ts text-sm">Upload assignments, track submissions and deadlines.</div>
            </div>
        </div>
        <div id="tab-lab" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-flask text-5xl text-teal mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Lab Reports</div>
                <div class="text-ts text-sm">Manage lab report submissions and feedback.</div>
            </div>
        </div>
        <div id="tab-routines" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-calendar-alt text-5xl text-green mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Class Routines</div>
                <div class="text-ts text-sm">Manage weekly class schedule and exam timetables.</div>
            </div>
        </div>
        <div id="tab-polls" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-poll text-5xl text-teal mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Poll Management</div>
                <div class="text-ts text-sm">Create polls, track votes and manage active surveys.</div>
            </div>
        </div>
        <div id="tab-subjects" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-book text-5xl text-accent mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Subjects</div>
                <div class="text-ts text-sm">Manage all course subjects, codes and assigned teachers.</div>
            </div>
        </div>
        <div id="tab-resources" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-cloud-upload-alt text-5xl text-coral mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Resources</div>
                <div class="text-ts text-sm">Upload and categorize study materials, notes and books.</div>
            </div>
        </div>
        <div id="tab-feedback" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-comments text-5xl text-pink mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Feedback Inbox</div>
                <div class="text-ts text-sm">Read, respond and manage student feedback messages.</div>
            </div>
        </div>
        <div id="tab-analytics" class="">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-chart-bar text-5xl text-purple mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Analytics</div>
                <div class="text-ts text-sm">Deep analytics on engagement, submissions, and batch health.</div>
            </div>
        </div>
        <div id="tab-settings" class="hidden">
            <div class="dash-card p-8 text-center fade-up"><i
                    class="fas fa-cog text-5xl text-ts mb-4 block opacity-60"></i>
                <div class="text-tp font-bold text-lg mb-2">Settings</div>
                <div class="text-ts text-sm">Configure platform settings, permissions and integrations.</div>
            </div>
        </div>

    </main>
@endsection
