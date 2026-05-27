@extends('layouts.student.student-layout')
@section('title', 'Teachers')
@section('content')


    <main class="pt-5 px-4 md:px-5 pb-8 max-w-auto mx-5" role="main">

        <!-- ── PAGE HEADER ── -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

            <div>
                <h1 class="text-[1.15rem] md:text-[1.35rem] font-bold text-prim">
                    <i class="fa-solid fa-user text-accent mr-2"></i>
                    Teachers Directory
                </h1>

                <p class="text-[0.78rem] text-sec mt-1">
                    Connect with all teachers
                </p>
            </div>

            <!-- Search -->
            <form action="{{ route('student.teachers') }}" method="GET">
                <div class="relative">
                    <i
                        class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-hint text-[0.72rem]">
                    </i>

                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by name / email / roll / reg"
                        class="w-full sm:w-[260px] bg-input border border-bdr rounded-xl pl-9 pr-3 py-2.5 text-[0.78rem] text-prim outline-none focus:border-accent transition-all placeholder:text-hint" />
                </div>
            </form>
        </div>


        <!-- ── CLASSMATES GRID ── -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">

            @forelse($teachers as $teacher)

                <div
                    class="bg-card border border-bdr rounded-2xl overflow-hidden hover:border-accent hover:-translate-y-1 transition-all duration-300 group">

                    <!-- Top -->
                    <div class="relative h-24 bg-gradient-to-r from-accent/20 to-accent/5">

                        <div class="absolute -bottom-10 left-1/2 -translate-x-1/2">

                            <img src="{{ $teacher->photo ? asset('storage/' . $teacher->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) }}"
                                alt="{{ $teacher->name }}"
                                class="w-20 h-20 rounded-full border-4 border-card object-cover" />
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="pt-14 px-4 pb-4 text-center">

                        <!-- Name -->
                        <h3 class="text-[0.95rem] font-semibold text-prim">
                            {{ $teacher->name }}
                        </h3>

                        <!-- Roll + Reg -->
                        <div class="mt-2 space-y-1">

                            @if ($teacher->gender)
                                <p class="text-xs capitalize">

                                <div class="flex items-center justify-center gap-2 mt-2">

                                    {{-- Gender --}}
                                    @if ($teacher->gender == 'female')
                                        <span
                                            class="px-2 py-[3px] rounded-full text-[9px] font-medium bg-red-500/10 text-red-500 border border-red-500/20 leading-none">
                                            {{ ucfirst($teacher->gender) }}
                                        </span>
                                    @elseif($teacher->gender == 'male')
                                        <span
                                            class="px-2 py-[3px] rounded-full text-[9px] font-medium bg-green-500/10 text-green-500 border border-green-500/20 leading-none">
                                            {{ ucfirst($teacher->gender) }}
                                        </span>
                                    @endif

                                    {{-- Room Number --}}
                                    @if ($teacher->roomNumber)
                                        <span
                                            class="px-2 py-[3px] rounded-full text-[9px] font-medium bg-blue-500/10 text-blue-500 border border-blue-500/20 leading-none">
                                            Room {{ $teacher->roomNumber }}
                                        </span>
                                    @endif

                                </div>

                                </p>
                            @endif

                        </div>

                        <!-- Email -->
                        <a href="mailto:{{ $teacher->email }}"
                            class="mt-4 flex items-center justify-center gap-2 bg-input border border-bdr rounded-xl px-3 py-2 text-[0.72rem] text-sec hover:border-accent hover:text-accent transition-all">

                            <i class="fa-regular fa-envelope"></i>

                            <span class="truncate">
                                {{ $teacher->email }}
                            </span>
                        </a>

                        <!-- Phone -->
                        @if ($teacher->phone)
                            <a href="tel:{{ $teacher->phone }}"
                                class="mt-2 flex items-center justify-center gap-2 bg-input border border-bdr rounded-xl px-3 py-2 text-[0.72rem] text-sec hover:border-grn hover:text-grn transition-all">

                                <i class="fa-solid fa-phone"></i>

                                {{ $teacher->phone }}
                            </a>
                        @endif

                    </div>
                </div>

            @empty

                <div class="col-span-full">

                    <div class="bg-card border border-bdr rounded-2xl p-10 text-center">

                        <i class="fa-solid fa-users text-4xl text-hint mb-4"></i>

                        <h3 class="text-lg font-semibold text-prim mb-2">
                            No Teacher Found
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
            {{ $teachers->links() }}
        </div>

    </main>

@endsection
