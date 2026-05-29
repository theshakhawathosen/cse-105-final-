@extends('layouts.student.student-layout')

@section('title', 'Routines')

@section('content')

    <main id="main-content" class="p-4 md:p-6">

        <!-- Header -->
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-8 fade-up">

            <!-- Left -->
            <div>

                <div
                    class="inline-flex items-center gap-2 bg-[#161a22] border border-[#232938] px-3 py-1.5 rounded-full text-xs text-gray-300">

                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                    Academic Routine

                </div>

                <h1 class="text-3xl font-bold text-white mt-3 tracking-tight">
                    Routine Schedule
                </h1>

                <p class="text-gray-400 text-sm mt-1">
                    View class and exam schedules easily.
                </p>

            </div>

            <!-- Right Filter -->
            <form method="GET" action="{{ route('student.routine') }}">

                <div class="relative">

                    <select name="type" onchange="this.form.submit()"
                        class="appearance-none w-100 bg-[#151922] border border-[#262d3d] hover:border-[#3b82f6]/50 text-gray-300 rounded-xl px-4 py-2.5 pr-10 text-sm focus:outline-none focus:border-accent transition-all duration-300 min-w-[190px] shadow-lg shadow-black/10">

                        <option value="">
                            All Routines
                        </option>

                        <option value="class_routine"
                            {{ $type == 'class_routine' ? 'selected' : '' }}>
                            Class Routine
                        </option>

                        <option value="mid_exam_routine"
                            {{ $type == 'mid_exam_routine' ? 'selected' : '' }}>
                            Mid Exam Routine
                        </option>

                        <option value="final_exam_routine"
                            {{ $type == 'final_exam_routine' ? 'selected' : '' }}>
                            Final Exam Routine
                        </option>

                    </select>


                </div>

            </form>

        </div>

        <!-- Routine Grid -->
        @if ($routines->count() > 0)

            <div class="grid grid-cols-1 xl:grid-cols-2 gap-5">

                @foreach ($routines as $routine)

                    <div
                        class="group bg-[#11151d] border border-[#1f2633] rounded-3xl overflow-hidden hover:border-[#3b82f6]/40 transition-all duration-300 shadow-xl shadow-black/10 fade-up">

                        <!-- Image -->
                        <div class="relative overflow-hidden">

                            <a href="{{ asset('storage/' . $routine->filepath) }}"
                                target="_blank">

                                <img src="{{ asset('storage/' . $routine->filepath) }}"
                                    alt="Routine"
                                    class="w-full h-[260px] object-cover group-hover:scale-[1.02] transition-all duration-500">

                            </a>

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0b0e13] via-transparent to-transparent">
                            </div>

                            <!-- Type Badge -->
                            <div class="absolute top-4 right-4">

                                <span
                                    class="px-3 py-1 rounded-full text-[11px] font-semibold backdrop-blur-md border

                                    @if ($routine->type == 'class_routine')
                                        bg-blue-500/10 text-blue-300 border-blue-500/20
                                    @elseif($routine->type == 'mid_exam_routine')
                                        bg-amber-500/10 text-amber-300 border-amber-500/20
                                    @else
                                        bg-emerald-500/10 text-emerald-300 border-emerald-500/20
                                    @endif">

                                    {{ ucwords(str_replace('_', ' ', $routine->type)) }}

                                </span>

                            </div>

                        </div>

                        <!-- Content -->
                        <div class="p-5">

                            <div
                                class="flex items-start justify-between gap-3 mb-4">

                                <div>

                                    <h2
                                        class="text-lg font-semibold text-white leading-tight">

                                        {{ $routine->title }}

                                    </h2>

                                    <p class="text-xs text-gray-500 mt-1">

                                        Uploaded :
                                        {{ $routine->created_at->format('d M Y') }}

                                    </p>

                                </div>

                            </div>

                            <!-- Buttons -->
                            <div class="flex items-center gap-2">

                                <!-- View -->
                                <a href="{{ asset('storage/' . $routine->filepath) }}"
                                    target="_blank"
                                    class="flex-1 inline-flex items-center justify-center gap-2 px-3 py-2.5 rounded-xl bg-[#191f2b] border border-[#283142] text-gray-300 text-sm hover:bg-[#222a38] hover:text-white transition-all duration-300">

                                    <i class="fas fa-eye text-xs"></i>

                                    View

                                </a>

                                <!-- Download -->
                                <a href="{{ asset('storage/' . $routine->filepath) }}"
                                    download
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-accent hover:bg-accentH text-white text-sm transition-all duration-300 shadow-lg shadow-blue-500/20">

                                    <i class="fas fa-download text-xs"></i>

                                    Download

                                </a>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <!-- Empty -->
            <div
                class="bg-[#11151d] border border-[#1f2633] rounded-3xl p-14 text-center fade-up">

                <div
                    class="w-20 h-20 mx-auto rounded-2xl bg-[#181d27] flex items-center justify-center mb-5 border border-[#252c3a]">

                    <i class="fas fa-calendar-times text-3xl text-gray-500"></i>

                </div>

                <h2 class="text-2xl font-semibold text-white mb-2">
                    No Routine Found
                </h2>

                <p class="text-gray-400 text-sm">
                    No routines available right now.
                </p>

            </div>

        @endif

    </main>

@endsection
