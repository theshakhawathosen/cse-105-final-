@extends('layouts.student.student-layout')
@section('title', 'Show Attendance')
@section('content')
    <main id="main-content">

        <!-- Attendance Info Header -->
        <div class="bg-card border border-bdr rounded-3xl p-5 sm:p-6 mb-6">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <!-- Left -->
                <div>

                    <div
                        class="inline-flex items-center gap-2 bg-input border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>

                        Attendance Record

                    </div>

                    <h2 class="text-2xl font-bold text-prim mt-4">
                        {{ $attendance->subject->name ?? 'Subject Attendance' }}
                    </h2>

                    <p class="text-sec text-sm mt-1">
                        Attendance details for selected class
                    </p>

                </div>

                <!-- Right -->
                <a href="{{ route('student.attendances') }}"
                    class="inline-flex items-center justify-center gap-2 bg-input border border-bdr hover:border-accent px-5 py-3 rounded-2xl text-sm text-prim transition">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">

                <!-- Subject -->
                <div class="bg-input border border-bdr rounded-2xl p-4">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-2xl bg-blue-500/10 text-blue-400 flex items-center justify-center">

                            <i class="fas fa-book text-lg"></i>

                        </div>

                        <div>

                            <p class="text-xs text-sec">
                                Subject
                            </p>

                            <h3 class="text-sm font-semibold text-prim mt-1">
                                {{ $attendance->subject->name ?? 'N/A' }}
                            </h3>

                        </div>

                    </div>

                </div>

                <!-- Date -->
                <div class="bg-input border border-bdr rounded-2xl p-4">

                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-2xl bg-green-500/10 text-green-400 flex items-center justify-center">

                            <i class="fas fa-calendar-day text-lg"></i>

                        </div>

                        <div>

                            <p class="text-xs text-sec">
                                Attendance Date
                            </p>

                            <h3 class="text-sm font-semibold text-prim mt-1">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}
                            </h3>

                        </div>

                    </div>

                </div>

                <!-- Day -->
                <div class="bg-input border border-bdr rounded-2xl p-4">

                    <div class="flex items-center gap-3">

                        <div
                            class="w-12 h-12 rounded-2xl bg-orange-500/10 text-orange-400 flex items-center justify-center">

                            <i class="fas fa-clock text-lg"></i>

                        </div>

                        <div>

                            <p class="text-xs text-sec">
                                Day
                            </p>

                            <h3 class="text-sm font-semibold text-prim mt-1">
                                {{ \Carbon\Carbon::parse($attendance->date)->format('l') }}
                            </h3>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- Main Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top -->

            <!-- All Students -->
            <div>

                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-tp">
                        All Students
                    </h2>

                    <a href="{{ route('student.attendances') }}"
                        class="px-3 py-1.5 text-xs font-medium text-white bg-black rounded-md hover:bg-gray-800 transition duration-200">
                        Back
                    </a>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">

                    @foreach ($students as $student)
                        <label class="student-card cursor-pointer">

                            <input type="checkbox" class="hidden attendance-checkbox" disabled
                                {{ in_array($student->id, $presentStudents) ? 'checked' : '' }}>

                            <div
                                class="attendance-ui rounded-2xl p-4 text-center transition-all duration-300

                            {{ in_array($student->id, $presentStudents)
                                ? 'bg-green-800/10 border border-green-500/20'
                                : 'bg-red/10 border border-red/20' }}">

                                <!-- Checkbox -->
                                <div
                                    class="checkbox-ui w-8 h-8 rounded-xl border-2 mx-auto flex items-center justify-center transition-all duration-300

                                {{ in_array($student->id, $presentStudents) ? 'bg-green-500 border-green-800' : 'border-red-300/30' }}">

                                    <i
                                        class="fas fa-check text-white text-sm check-icon

                                    {{ in_array($student->id, $presentStudents) ? '' : 'hidden' }}"></i>

                                </div>

                                <!-- Photo -->
                                <div class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mt-4 border border-border">
                                    @if ($student->photo)
                                        <img src="{{ asset('storage/' . $student->photo ?? 'default.png') }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('default.png') }}" class="w-full h-full object-cover">
                                    @endif


                                </div>

                                <!-- Roll -->
                                <h2 class="text-lg font-bold text-tp mt-3">
                                    {{ $student->roll }}
                                </h2>

                                <!-- Name -->
                                <p class="text-xs text-ts mt-1 line-clamp-1">
                                    {{ $student->name }}
                                </p>

                                <!-- Status -->
                                <div class="mt-3">

                                    <span
                                        class="status-badge text-[10px] px-3 py-1 rounded-full border

                                    {{ in_array($student->id, $presentStudents)
                                        ? 'bg-green-500/20 text-green-500 border-green-400/20'
                                        : 'bg-red-500/20 text-red-500 border-red-500/20' }}">

                                        {{ in_array($student->id, $presentStudents) ? 'Present' : 'Absent' }}

                                    </span>

                                </div>

                            </div>

                        </label>
                    @endforeach

                </div>

            </div>

            <!-- Present & Absent Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-10">

                <!-- Present Students -->
                <div class="dash-card p-5 border border-green-800/20">

                    <div class="flex items-center justify-between mb-5">

                        <h2 class="text-lg font-bold text-green-500">
                            Present Students
                        </h2>

                        <span
                            class="px-3 py-1 rounded-full text-xs bg-green-500/20 text-green-500 border border-green-800/20">

                            {{ $presentStudentList->count() }} Present

                        </span>

                    </div>

                    <div class="space-y-3">

                        @forelse ($presentStudentList as $student)
                            <div class="flex items-center gap-3 bg-green-500/10 border border-green-800/20 rounded-2xl p-3">

                                <!-- Photo -->
                                <div class="w-12 h-12 rounded-xl overflow-hidden">

                                    <img src="{{ asset($student->photo ? 'storage/' . $student->photo : 'default.png') }}"
                                        class="w-full h-full object-cover">

                                </div>

                                <!-- Info -->
                                <div class="flex-1">

                                    <h3 class="text-sm font-semibold text-tp">
                                        {{ $student->name }}
                                    </h3>

                                    <p class="text-xs text-ts">
                                        Roll : {{ $student->roll }}
                                    </p>

                                </div>

                                <!-- Badge -->
                                <span
                                    class="text-[10px] px-3 py-1 rounded-full bg-green-500/20 text-green-400 border border-green-500/20">

                                    Present

                                </span>

                            </div>

                        @empty

                            <p class="text-ts text-sm">
                                No Present Students
                            </p>
                        @endforelse

                    </div>

                </div>

                <!-- Absent Students -->
                <div class="dash-card p-5 border border-red/20">

                    <div class="flex items-center justify-between mb-5">

                        <h2 class="text-lg font-bold text-red">
                            Absent Students
                        </h2>

                        <span class="px-3 py-1 rounded-full text-xs bg-red/20 text-red border border-red/20">

                            {{ $absentStudentList->count() }} Absent

                        </span>

                    </div>

                    <div class="space-y-3">

                        @forelse ($absentStudentList as $student)
                            <div class="flex items-center gap-3 bg-red/10 border border-red/20 rounded-2xl p-3">

                                <!-- Photo -->
                                <div class="w-12 h-12 rounded-xl overflow-hidden">

                                    <img src="{{ asset($student->photo ?? 'default.png') }}"
                                        class="w-full h-full object-cover">

                                </div>

                                <!-- Info -->
                                <div class="flex-1">

                                    <h3 class="text-sm font-semibold text-tp">
                                        {{ $student->name }}
                                    </h3>

                                    <p class="text-xs text-ts">
                                        Roll : {{ $student->roll }}
                                    </p>

                                </div>

                                <!-- Badge -->
                                <span class="text-[10px] px-3 py-1 rounded-full bg-red/20 text-red border border-red/20">

                                    Absent

                                </span>

                            </div>

                        @empty

                            <p class="text-ts text-sm">
                                No Absent Students
                            </p>
                        @endforelse

                    </div>

                </div>

            </div>



        </div>

    </main>
@endsection
