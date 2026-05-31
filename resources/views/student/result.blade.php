@extends('layouts.student.student-layout')

@section('title', 'Results')

@section('content')

    <main id="main-content" class="p-4 md:p-6">

        <!-- Transcript Wrapper -->
        <div class="max-w-7xl mx-auto">

            <!-- Top Actions -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6 fade-up">

                <!-- Title -->
                <div>

                    <div
                        class="inline-flex items-center gap-2 bg-card border border-border px-3 py-1.5 rounded-full text-xs text-ts shadow-sm">

                        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                        Student Academic Transcript

                    </div>

                    <h1 class="text-2xl md:text-3xl font-bold text-tp mt-3 tracking-tight">
                        Results Overview
                    </h1>

                    <p class="text-sm text-ts mt-1">
                        View student marks, exam performance and total obtained marks.
                    </p>

                </div>

                <!-- Student Select -->
                <form method="GET" action="" class="w-full lg:w-auto">

                    <div
                        class="flex items-center gap-3 bg-card border border-border rounded-2xl px-4 py-3 shadow-sm">

                        <div
                            class="w-10 h-10 rounded-xl bg-input border border-border flex items-center justify-center text-ts">

                            <i class="fas fa-user-graduate"></i>

                        </div>

                        <div class="flex-1 min-w-[240px]">

                            <label class="text-xs text-ts block mb-1">
                                Select Student
                            </label>

                            <select name="student_id"
                                onchange="this.form.submit()"
                                class="w-full bg-card border-0 outline-none text-sm text-tp font-medium cursor-pointer">

                                @foreach ($students as $student)

                                    <option value="{{ $student->id }}"
                                        {{ request()->student_id == $student->id ? 'selected' : '' }}>

                                        {{ $student->name }} - ({{ $student->roll}})

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                </form>

            </div>

            <!-- Transcript Card -->
            <div
                class="dash-card border border-border/70 rounded-3xl overflow-hidden fade-up fade-up-d2 shadow-[0_0_0_1px_rgba(255,255,255,0.02)]">

                <!-- Header -->
                <div
                    class="relative overflow-hidden border-b border-border bg-gradient-to-br from-input/70 to-card px-6 md:px-8 py-7">

                    <div class="absolute top-0 right-0 w-52 h-52 bg-accent/5 rounded-full blur-3xl"></div>

                    <div
                        class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                        <!-- Student Info -->
                        <div class="flex items-start gap-5">

                            <!-- Photo -->
                            <div class="shrink-0">

                                @if ($user->photo)

                                    <img src="{{ asset('storage/' . $user->photo) }}"
                                        class="w-28 h-28 rounded-3xl object-cover border border-border shadow-lg">

                                @else

                                    <img src="{{ asset('default.png') }}"
                                        class="w-28 h-28 rounded-3xl object-cover border border-border shadow-lg">

                                @endif

                            </div>

                            <!-- Details -->
                            <div>

                                <h2 class="text-2xl md:text-3xl font-bold text-tp">
                                    {{ $user->name }}
                                </h2>

                                <p class="text-sm text-ts mt-1">
                                    Student Academic Information
                                </p>

                                <h4 class="">Roll: {{ $user->roll }}</h4>
                                <h4>Registration: {{ $user->reg }}</h4>

                            </div>

                        </div>



                    </div>

                </div>

                <!-- Table -->
                <div class="p-4 md:p-6">

                    <div
                        class="overflow-x-auto rounded-2xl border border-border bg-card/30 backdrop-blur-sm">

                        <table class="w-full min-w-[850px]">

                            <!-- Table Head -->
                            <thead>

                                <tr class="bg-input/70 border-b border-border text-tp">

                                    <!-- Subject -->
                                    <th
                                        class="py-4 px-5 text-left font-semibold whitespace-nowrap">

                                        Subject

                                    </th>

                                    <!-- Dynamic Exams -->
                                    @foreach ($exams as $exam)

                                        <th
                                            class="py-4 px-5 text-center font-semibold whitespace-nowrap border-l border-border">

                                            {{ $exam->exam_name }}

                                        </th>

                                    @endforeach

                                    <!-- Total -->
                                    <th
                                        class="py-4 px-5 text-center font-semibold whitespace-nowrap border-l border-border bg-accent/5">

                                        Total

                                    </th>

                                </tr>

                            </thead>

                            <!-- Body -->
                            <tbody class="text-sm text-tp">

                                @forelse($subjects as $subject)

                                    <tr
                                        class="border-b border-border hover:bg-input/40 transition-all duration-200">

                                        <!-- Subject -->
                                        <td class="py-4 px-5 font-semibold whitespace-nowrap">

                                            <div class="flex items-center gap-3">

                                                <div
                                                    class="w-9 h-9 rounded-xl bg-input border border-border flex items-center justify-center text-ts">

                                                    <i class="fas fa-book-open text-xs"></i>

                                                </div>

                                                <span>
                                                    {{ $subject->name }}
                                                </span>

                                            </div>

                                        </td>

                                        @php
                                            $marks = 0;
                                        @endphp

                                        <!-- Marks -->
                                        @foreach ($exams as $exam)

                                            @php

                                                $result = $results
                                                    ->where('subject_id', $subject->id)
                                                    ->where('exam_id', $exam->id)
                                                    ->where('user_id', request()->student_id)
                                                    ->first();

                                            @endphp

                                            <td
                                                class="py-4 px-5 text-center border-l border-border">

                                                @if ($result)

                                                    <span
                                                        class="inline-flex items-center justify-center min-w-[48px] h-9 px-3 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 font-semibold">

                                                        {{ $mark = $result->marks }}

                                                        @php
                                                            $marks = $mark + $marks;
                                                        @endphp

                                                    </span>

                                                @else

                                                    <span class="text-ts">
                                                        —
                                                    </span>

                                                @endif

                                            </td>

                                        @endforeach

                                        <!-- Total -->
                                        <td
                                            class="py-4 px-5 text-center border-l border-border">

                                            <div
                                                class="inline-flex items-center justify-center min-w-[60px] h-10 px-4 rounded-xl bg-accent/10 border border-accent/20 text-accent font-bold">

                                                {{ $marks }}

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="{{ $exams->count() + 2 }}"
                                            class="py-16 text-center">

                                            <div
                                                class="flex flex-col items-center justify-center">

                                                <div
                                                    class="w-16 h-16 rounded-2xl bg-input border border-border flex items-center justify-center text-ts mb-4">

                                                    <i class="fas fa-file-alt text-xl"></i>

                                                </div>

                                                <h3 class="text-lg font-semibold text-tp">
                                                    No Results Found
                                                </h3>

                                                <p class="text-sm text-ts mt-1">
                                                    No transcript data available for this student.
                                                </p>

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </main>

@endsection
