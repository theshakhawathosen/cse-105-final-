@extends('layouts.student.student-layout')
@section('title','Show Attendance')
@section('content')
<main id="main-content">

    <!-- Header -->
    <div class="mt-2 px-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-2 fade-up">

        <h2 class="text-2xl text-green-500 text-bold mb-0">Student Attendence</h2>

    </div>

    <!-- Main Card -->
    <div class="dash-card p-5 fade-up fade-up-d2">

        <!-- Top -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6 p-3">

            <!-- Subject -->
            <div>

                <label class="text-ts text-xs">
                    Select Subject
                </label>

                <select disabled
                    class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    @foreach ($subjects as $subject)

                        <option value="{{ $subject->id }}"
                            {{ $attendance->subject_id == $subject->id ? 'selected' : '' }}>

                            {{ $subject->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- Date -->
            <div>

                <label class="text-ts text-xs">
                    Attendance Date
                </label>

                <input type="date"
                    readonly
                    value="{{ $attendance->date }}"
                    class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

            </div>


            <!-- Day -->
            <div>

                <label class="text-ts text-xs">
                     Day
                </label>

                <input type="input"
                    readonly
                    value="{{ \Carbon\Carbon::parse($attendance->date)->format('l') }}"
                    class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

            </div>

        </div>

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

                        <input type="checkbox"
                            class="hidden attendance-checkbox"
                            disabled
                            {{ in_array($student->id, $presentStudents) ? 'checked' : '' }}>

                        <div
                            class="attendance-ui rounded-2xl p-4 text-center transition-all duration-300

                            {{ in_array($student->id, $presentStudents)
                                ? 'bg-green-800/10 border border-green-500/20'
                                : 'bg-red/10 border border-red/20' }}">

                            <!-- Checkbox -->
                            <div
                                class="checkbox-ui w-8 h-8 rounded-xl border-2 mx-auto flex items-center justify-center transition-all duration-300

                                {{ in_array($student->id, $presentStudents)
                                    ? 'bg-green-500 border-green-800'
                                    : 'border-red-300/30' }}">

                                <i
                                    class="fas fa-check text-white text-sm check-icon

                                    {{ in_array($student->id, $presentStudents)
                                        ? ''
                                        : 'hidden' }}"></i>

                            </div>

                            <!-- Photo -->
                            <div
                                class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mt-4 border border-border">
                                @if($student->photo)
                                <img src="{{ asset('storage/'.$student->photo ?? 'default.png') }}"
                                    class="w-full h-full object-cover">
                                    @else
                                <img src="{{ asset( 'default.png') }}"
                                    class="w-full h-full object-cover">
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

                                    {{ in_array($student->id, $presentStudents)
                                        ? 'Present'
                                        : 'Absent' }}

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

                        <div
                            class="flex items-center gap-3 bg-green-500/10 border border-green-800/20 rounded-2xl p-3">

                            <!-- Photo -->
                            <div class="w-12 h-12 rounded-xl overflow-hidden">

                                <img src="{{ asset(($student->photo) ? 'storage/'.$student->photo : 'default.png') }}"
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

                    <span
                        class="px-3 py-1 rounded-full text-xs bg-red/20 text-red border border-red/20">

                        {{ $absentStudentList->count() }} Absent

                    </span>

                </div>

                <div class="space-y-3">

                    @forelse ($absentStudentList as $student)

                        <div
                            class="flex items-center gap-3 bg-red/10 border border-red/20 rounded-2xl p-3">

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
                            <span
                                class="text-[10px] px-3 py-1 rounded-full bg-red/20 text-red border border-red/20">

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
