@extends('layouts.student.student-layout')
@section('title', 'Classmates')
@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Attendance Report Modal -->
    @if (session('attendance_text'))
        <div id="attendanceModal"
            class="fixed inset-0 z-50 bg-black/70 flex items-center justify-center p-4">

            <div
                class="bg-card border border-bdr rounded-3xl p-5 w-full max-w-2xl relative shadow-2xl">

                <button onclick="closeAttendanceModal()"
                    class="absolute top-3 right-3 text-sec hover:text-red transition">

                    <i class="fas fa-times"></i>

                </button>

                <h2 class="text-xl font-semibold text-prim mb-4">
                    Attendance Report
                </h2>

                <textarea rows="15" readonly
                    class="w-full bg-input border border-bdr rounded-2xl px-4 py-4 text-sm text-prim focus:outline-none">{{ session('attendance_text') }}</textarea>

                <div class="flex justify-end mt-4">

                    <button onclick="copyAttendanceModal()"
                        class="bg-accent hover:bg-ahover text-white text-xs px-5 py-2.5 rounded-xl transition">

                        <i class="fas fa-copy mr-1"></i>
                        Copy Report

                    </button>

                </div>

            </div>

        </div>
    @endif

    <!-- Header -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

        <div>

            <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-grn animate-pulse"></span>

                Attendance Management

            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                Attendance History
            </h1>

            <p class="text-sec text-sm mt-1">
                Manage attendance reports, present percentage and records
            </p>

        </div>

    </div>

    <!-- Attendance Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

        @forelse($attendances as $attendance)

            @php
                $total_present = $attendance->take_attendence
                    ->where('status', 'present')
                    ->count();

                $total_absent = $attendance->take_attendence
                    ->where('status', 'absent')
                    ->count();

                $total_students = $attendance->take_attendence->count();

                $presentPercentage =
                    $total_students > 0
                        ? round(($total_present / $total_students) * 100)
                        : 0;

                $absentPercentage = 100 - $presentPercentage;
            @endphp

            <!-- Card -->
            <div
                class="bg-card border border-bdr rounded-3xl p-5 hover:border-accent/50 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-black/10 animate-fadeUp">

                <!-- Top -->
                <div class="flex items-start justify-between gap-3">

                    <div>

                        <span
                            class="inline-flex items-center gap-1 bg-input border border-bdr text-sec text-[11px] px-2.5 py-1 rounded-full">

                            #{{ $loop->iteration }}

                        </span>

                        <h2 class="text-lg font-semibold text-prim mt-3">
                            {{ $attendance->subject->name }}
                        </h2>

                    </div>

                    <div
                        class="w-11 h-11 rounded-2xl bg-accent/10 text-accent flex items-center justify-center border border-accent/20">

                        <i class="fas fa-calendar-check text-lg"></i>

                    </div>

                </div>

                <!-- Info -->
                <div class="mt-5 space-y-3">

                    <div
                        class="flex items-center justify-between bg-input border border-bdr rounded-2xl px-4 py-3">

                        <span class="text-sec text-sm">
                            Date
                        </span>

                        <span class="text-prim text-sm font-medium">
                            {{ $attendance->date }}
                        </span>

                    </div>

                    <div
                        class="flex items-center justify-between bg-input border border-bdr rounded-2xl px-4 py-3">

                        <span class="text-sec text-sm">
                            Day
                        </span>

                        <span class="text-prim text-sm font-medium">
                            {{ \Carbon\Carbon::parse($attendance->date)->format('l') }}
                        </span>

                    </div>

                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 gap-3 mt-5">

                    <div
                        class="bg-grn/10 border border-grn/20 rounded-2xl p-4 text-center">

                        <p class="text-xs text-sec mb-1">
                            Present
                        </p>

                        <h3 class="text-2xl font-bold text-grn">
                            {{ $total_present }}
                        </h3>

                    </div>

                    <div
                        class="bg-red/10 border border-red/20 rounded-2xl p-4 text-center">

                        <p class="text-xs text-sec mb-1">
                            Absent
                        </p>

                        <h3 class="text-2xl font-bold text-red">
                            {{ $total_absent }}
                        </h3>

                    </div>

                </div>

                <!-- Progress -->
                <div class="mt-5">

                    <div class="flex items-center justify-between mb-2">

                        <span class="text-sm text-sec">
                            Attendance Rate
                        </span>

                        <span class="text-sm font-semibold text-prim">
                            {{ $presentPercentage }}%
                        </span>

                    </div>

                    <div
                        class="w-full h-3 bg-input rounded-full overflow-hidden border border-bdr flex">

                        <div class="bg-grn transition-all duration-500"
                            style="width: {{ $presentPercentage }}%"></div>

                        <div class="bg-red transition-all duration-500"
                            style="width: {{ $absentPercentage }}%"></div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="flex items-center justify-between mt-6 pt-5 border-t border-bdr">

                    <div class="text-xs text-sec">

                        Total Students :
                        <span class="text-prim font-medium">
                            {{ $total_students }}
                        </span>

                    </div>

                    <a href="{{ route('student.attendance.show', $attendance->id) }}"
                        class="inline-flex items-center gap-2 bg-input hover:bg-hover border border-bdr hover:border-accent text-accent text-xs font-medium px-4 py-2 rounded-xl transition">

                        <i class="fas fa-eye"></i>

                        View

                    </a>

                </div>

            </div>

        @empty

            <!-- Empty State -->
            <div
                class="col-span-full bg-card border border-bdr rounded-3xl p-10 text-center">

                <div
                    class="w-20 h-20 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center text-sec text-3xl">

                    <i class="fas fa-calendar-times"></i>

                </div>

                <h3 class="text-xl font-semibold text-prim mt-5">
                    No Attendance Found
                </h3>

                <p class="text-sec text-sm mt-2">
                    No attendance records are available right now.
                </p>

            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">

        {{ $attendances->links() }}

    </div>

</main>

@endsection
