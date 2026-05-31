   <nav id="mobSidebar"
       class="mob-sidebar fixed top-0 left-0 w-64 h-full bg-card border-r border-bdr z-[1060] overflow-y-auto py-5">
       <!-- Sidebar header -->
       <div class="flex items-center justify-between px-4 pb-4 border-b border-bdr mb-2">
           <div class="flex items-center gap-2">
               <div class="w-7 h-7 rounded-lg bg-accent/20 border border-accent/30 flex items-center justify-center">
                   <i class="fa-solid fa-graduation-cap text-accent text-xs"></i>
               </div>
               <span class="font-bold text-prim text-sm">CSE-105</span>
           </div>
           <button onclick="closeMobMenu()" class="text-sec text-base cursor-pointer bg-transparent border-none">
               <i class="fa-solid fa-xmark"></i>
           </button>
       </div>

       <!-- Mobile nav links -->

       <a href="{{ route('student.dashboard') }}"
           class="mob-nav-link {{ Route::is('student.dashboard') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-gauge-high w-4 text-center"></i> Dashboard
       </a>

       <a href="{{ route('student.subjects') }}"
           class="mob-nav-link {{ Route::is('student.subjects') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-book-open w-4 text-center"></i> Subjects
       </a>

       <a href="{{ route('student.teachers') }}"
           class="mob-nav-link {{ Route::is('student.teachers') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-chalkboard-user w-4 text-center"></i> Teachers
       </a>

       <a href="{{ route('student.classmates') }}"
           class="mob-nav-link {{ Route::is('student.classmates') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-users w-4 text-center"></i> Classmates
       </a>

       <a href="{{ route('student.routine') }}"
           class="mob-nav-link {{ Route::is('student.routine') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-regular fa-calendar w-4 text-center"></i> Routine
       </a>

       <a href="{{ route('student.calendar') }}"
           class="mob-nav-link {{ Route::is('student.calendar') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-th w-4 text-center"></i> Study Calendar
       </a>

       <a href="{{ route('student.online-class.index') }}"
           class="mob-nav-link {{ Route::is('student.online-class.*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-globe w-4 text-center"></i>
           Online Class

           @if ($upcomingOnlineClassCount > 0)
               <span class="ml-auto bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                   {{ $upcomingOnlineClassCount }}
               </span>
           @endif
       </a>

       <a href="{{ route('student.assignment') }}"
           class="mob-nav-link {{ Route::is('student.assignment*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-file-pen w-4 text-center"></i>
           Assignment

           @if ($upcomingAssignmentCount > 0)
               <span class="ml-auto bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                   {{ $upcomingAssignmentCount }}
               </span>
           @endif
       </a>

       <a href="{{ route('student.lab-report') }}"
           class="mob-nav-link {{ Route::is('student.lab-report*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-flask w-4 text-center"></i>
           Lab Report

           @if ($activeLabReportCount > 0)
               <span class="ml-auto bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                   {{ $activeLabReportCount }}
               </span>
           @endif
       </a>

       <a href="{{ route('student.attendances') }}"
           class="mob-nav-link {{ Route::is('student.attendances*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-user-check w-4 text-center"></i> Attendance
       </a>

       <a href="{{ route('student.results') }}?student_id={{ Auth::id() }}"
           class="mob-nav-link {{ Route::is('student.results*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-graduation-cap w-4 text-center"></i> Results
       </a>

       <a href="{{ route('student.resources') }}"
           class="mob-nav-link {{ Route::is('student.resources*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-photo-film w-4 text-center"></i> Resources
       </a>

       <a href="{{ route('student.links') }}"
           class="mob-nav-link {{ Route::is('student.links') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-link w-4 text-center"></i> Links
       </a>

       <a href="{{ route('student.notice') }}"
           class="mob-nav-link {{ Route::is('student.notice*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-bell w-4 text-center"></i>
           Notice

           @if ($activeNoticeCount > 0)
               <span class="ml-auto bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                   {{ $activeNoticeCount }}
               </span>
           @endif
       </a>

       <a href="{{ route('student.polls') }}"
           class="mob-nav-link {{ Route::is('student.poll*') || Route::is('student.polls') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-square-poll-vertical w-4 text-center"></i>
           Poll

           @if ($activePollCount > 0)
               <span class="ml-auto bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
                   {{ $activePollCount }}
               </span>
           @endif
       </a>

       <a href="{{ route('student.feedback') }}"
           class="mob-nav-link {{ Route::is('student.feedback*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-comments w-4 text-center"></i> Feedback
       </a>

       <div class="h-px bg-bdr mx-4 my-2"></div>

       <a href="{{ route('student.profile') }}"
           class="mob-nav-link {{ Route::is('student.profile*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-circle-user w-4 text-center"></i> My Profile
       </a>

       <a href="{{ route('student.change.password') }}"
           class="mob-nav-link {{ Route::is('student.change.password*') ? 'active' : 'text-sec' }} flex items-center gap-3 px-5 py-3 text-sm font-medium border-l-2 border-transparent">
           <i class="fa-solid fa-key w-4 text-center"></i> Change Password
       </a>

       <a href="{{ route('student.logout') }}"
           class="mob-nav-link flex items-center gap-3 px-5 py-3 text-sm font-medium text-red border-l-2 border-transparent">
           <i class="fa-solid fa-right-from-bracket w-4 text-center"></i> Logout
       </a>
   </nav>
