@extends('layouts.student.student-layout')
@section('title', 'Classmates')
@section('content')


<!-- ═══════════════════════════════════════════════════
     CLASSMATES TAB CONTENT
═══════════════════════════════════════════════════ -->

<main class="pt-5 px-4 md:px-5 pb-8 max-w-auto mx-5" role="main">

    <!-- ── PAGE HEADER ── -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

        <div>
            <h1 class="text-[1.15rem] md:text-[1.35rem] font-bold text-prim">
                <i class="fa-solid fa-users text-accent mr-2"></i>
                Classmates Directory
            </h1>

            <p class="text-[0.78rem] text-sec mt-1">
                Connect with all students
            </p>
        </div>

        <!-- Search -->
        <form action="{{ route('student.classmates') }}" method="GET">
            <div class="relative">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-hint text-[0.72rem]">
                </i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search by name / email / roll / reg"
                    class="w-full sm:w-[260px] bg-input border border-bdr rounded-xl pl-9 pr-3 py-2.5 text-[0.78rem] text-prim outline-none focus:border-accent transition-all placeholder:text-hint" />
            </div>
        </form>
    </div>

    <!-- ── STATS BAR ── -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">

        <!-- Total -->
        <div class="bg-card border border-bdr rounded-2xl p-4 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-accent/15 flex items-center justify-center">
                <i class="fa-solid fa-users text-accent"></i>
            </div>

            <div>
                <h3 class="text-[1.1rem] font-bold text-prim">
                    {{ $totalStudents }}
                </h3>

                <p class="text-[0.7rem] text-sec">
                    Total Students
                </p>
            </div>
        </div>

        <!-- Admin -->
        <div class="bg-card border border-bdr rounded-2xl p-4 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-grn/15 flex items-center justify-center">
                <i class="fa-solid fa-user-shield text-grn"></i>
            </div>

            <div>
                <h3 class="text-[1.1rem] font-bold text-prim">
                    {{ $totalAdmins }}
                </h3>

                <p class="text-[0.7rem] text-sec">
                    Admins
                </p>
            </div>
        </div>

        <!-- Students -->
        <div class="bg-card border border-bdr rounded-2xl p-4 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-pur/15 flex items-center justify-center">
                <i class="fa-solid fa-user-group text-pur"></i>
            </div>

            <div>
                <h3 class="text-[1.1rem] font-bold text-prim">
                    {{ $totalOnlyStudents }}
                </h3>

                <p class="text-[0.7rem] text-sec">
                    Students
                </p>
            </div>
        </div>

        <!-- With Phone -->
        <div class="bg-card border border-bdr rounded-2xl p-4 flex items-center gap-3">
            <div class="w-11 h-11 rounded-xl bg-pnk/15 flex items-center justify-center">
                <i class="fa-solid fa-phone text-pnk"></i>
            </div>

            <div>
                <h3 class="text-[1.1rem] font-bold text-prim">
                    {{ $withPhone }}
                </h3>

                <p class="text-[0.7rem] text-sec">
                    Phone Added
                </p>
            </div>
        </div>
    </div>

    <!-- ── CLASSMATES GRID ── -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

        @forelse($classmates as $student)

            <div
                class="bg-card border border-bdr rounded-2xl overflow-hidden hover:border-accent hover:-translate-y-1 transition-all duration-300 group">

                <!-- Top -->
                <div class="relative h-24 bg-gradient-to-r from-accent/20 to-accent/5">

                    <div class="absolute -bottom-10 left-1/2 -translate-x-1/2">

                        <img
                            src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) }}"
                            alt="{{ $student->name }}"
                            class="w-20 h-20 rounded-full border-4 border-card object-cover" />
                    </div>
                </div>

                <!-- Body -->
                <div class="pt-14 px-4 pb-4 text-center">

                    <!-- Name -->
                    <h3 class="text-[0.95rem] font-semibold text-prim">
                        {{ $student->name }}
                    </h3>

                    <!-- Roll + Reg -->
                    <div class="mt-2 space-y-1">

                        @if($student->roll)
                            <p class="text-[0.7rem] text-sec">
                                Roll: {{ $student->roll }}
                            </p>
                        @endif

                        @if($student->reg)
                            <p class="text-[0.7rem] text-sec">
                                Reg: {{ $student->reg }}
                            </p>
                        @endif

                    </div>

                    <!-- Email -->
                    <a
                        href="mailto:{{ $student->email }}"
                        class="mt-4 flex items-center justify-center gap-2 bg-input border border-bdr rounded-xl px-3 py-2 text-[0.72rem] text-sec hover:border-accent hover:text-accent transition-all">

                        <i class="fa-regular fa-envelope"></i>

                        <span class="truncate">
                            {{ $student->email }}
                        </span>
                    </a>

                    <!-- Phone -->
                    @if($student->phone)
                        <a
                            href="tel:{{ $student->phone }}"
                            class="mt-2 flex items-center justify-center gap-2 bg-input border border-bdr rounded-xl px-3 py-2 text-[0.72rem] text-sec hover:border-grn hover:text-grn transition-all">

                            <i class="fa-solid fa-phone"></i>

                            {{ $student->phone }}
                        </a>
                    @endif

                </div>
            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-card border border-bdr rounded-2xl p-10 text-center">

                    <i class="fa-solid fa-users text-4xl text-hint mb-4"></i>

                    <h3 class="text-lg font-semibold text-prim mb-2">
                        No Classmates Found
                    </h3>

                    <p class="text-sec text-sm">
                        Try searching with another keyword.
                    </p>
                </div>
            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $classmates->links() }}
    </div>

</main>

@endsection
