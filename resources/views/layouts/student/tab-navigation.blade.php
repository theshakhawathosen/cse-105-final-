    <nav class=" h-11 bg-nav border-b border-bdr z-[980] overflow-x-auto no-scroll" role="navigation"
        aria-label="Page sections">
        <div class="flex items-stretch h-full px-2 whitespace-nowrap">

            <!-- Dashboard -->
            <a href="{{ route('student.dashboard') }}"
                class="{{ Route::is('student.dashboard') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-gauge-high text-[0.8rem]"></i> Dashboard
            </a>

            <!-- Academic -->
            <a href="{{ route('student.subjects') }}"
                class="{{ Route::is('student.subjects') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-book-open text-[0.8rem]"></i> Subjects
            </a>

            <a href="{{ route('student.teachers') }}"
                class="{{ Route::is('student.teachers') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-chalkboard-user text-[0.8rem]"></i> Teachers
            </a>

            <a href="{{ route('student.classmates') }}"
                class="{{ Route::is('student.classmates') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-users text-[0.8rem]"></i> Classmates
            </a>

            <!-- Class Activities -->
            <a href="{{ route('student.routine') }}"
                class="{{ Route::is('student.routine') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-regular fa-calendar text-[0.8rem]"></i> Routine
            </a>

            <a href="{{ route('student.calendar') }}"
                class="{{ Route::is('student.calendar') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-th text-[0.8rem]"></i> Study Calendar
            </a>


            <a href="{{ route('student.online-class.index') }}"
                class="{{ Route::is('student.online-class.index') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">

                <i class="fa-solid fa-globe text-[0.8rem]"></i> Online Class

                @if ($upcomingOnlineClassCount > 0)
                    <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                        {{ $upcomingOnlineClassCount }}
                    </span>
                @endif

            </a>

            <!-- Assignments & Reports -->


            <a href="{{ route('student.assignment') }}"
                class="{{ Route::is('student.assignment') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">

                <i class="fa-solid fa-file-pen text-[0.8rem]"></i> Assignment

                @if ($upcomingAssignmentCount > 0)
                    <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                        {{ $upcomingAssignmentCount }}
                    </span>
                @endif

            </a>


            <a href="{{ route('student.lab-report') }}"
                class="{{ Route::is('student.lab-report') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">

                <i class="fa-solid fa-flask text-[0.8rem]"></i> Lab Report

                @if ($activeLabReportCount > 0)
                    <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                        {{ $activeLabReportCount }}
                    </span>
                @endif

            </a>

            <!-- Progress -->
            <a href="{{ route('student.attendances') }}"
                class="{{ Route::is('student.attendances') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-user-check text-[0.8rem]"></i> Attendance
            </a>

            <a href="{{ route('student.results') }}?student_id={{ Auth::id() }}"
                class="{{ Route::is('student.results*') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-graduation-cap text-[0.8rem]"></i> Results
            </a>

            <!-- Resources -->
            <a href="{{ route('student.resources') }}"
                class="{{ Route::is('student.resources*') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-photo-film text-[0.8rem]"></i> Resources
            </a>

            <a href="{{ route('student.links') }}"
                class="{{ Route::is('student.links') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-link text-[0.8rem]"></i> Links
            </a>

            <!-- Communication -->

            <a href="{{ route('student.notice') }}"
                class="{{ Route::is('student.notice') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">

                <i class="fa-solid fa-bell text-[0.8rem]"></i> Notice

                @if ($activeNoticeCount > 0)
                    <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                        {{ $activeNoticeCount }}
                    </span>
                @endif

            </a>



            <a href="{{ route('student.polls') }}"
                class="{{ Route::is('student.polls') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">

                <i class="fa-solid fa-square-poll-vertical text-[0.8rem]"></i> Poll

                @if ($activePollCount > 0)
                    <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                        {{ $activePollCount }}
                    </span>
                @endif

            </a>

            <a href="{{ route('student.feedback') }}"
                class="{{ Route::is('student.feedback') ? 'active text-accent' : 'text-sec' }} tab-link inline-flex items-center gap-1.5 px-3.5 text-[0.78rem] font-medium shrink-0">
                <i class="fa-solid fa-comments text-[0.8rem]"></i> Feedback
            </a>

        </div>
    </nav>
