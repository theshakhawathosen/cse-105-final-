@extends('layouts.student.student-layout')

@section('title', 'Class Learning Tracker')

@section('content')
    @php

        $daysInMonth = $currentMonth->daysInMonth;

        $firstDay = $currentMonth->copy()->startOfMonth()->dayOfWeek;

        $offset = ($firstDay + 1) % 7;

        $lessonMap = [];

        foreach ($lessons as $lesson) {
            $day = \Carbon\Carbon::parse($lesson->date)->day;

            $lessonMap[$day][] = [
                'date' => \Carbon\Carbon::parse($lesson->date)->format('d M Y'),
                'subject' => $lesson->subject->name,
                'topic' => $lesson->topic,
                'notes' => $lesson->notes,
                'platform' => $lesson->platform,
            ];
        }

    @endphp
    <main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

        <!-- Header -->
        <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10 mb-6">

            <div class="flex items-center gap-4">

                <div
                    class="w-14 h-14 rounded-2xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center">

                    <i class="fas fa-book-open text-2xl"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-bold text-prim">
                        Class Learning Tracker
                    </h1>

                    <p class="text-sm text-sec mt-1">
                        Click any date to view lesson details.
                    </p>

                </div>

            </div>

        </div>

        <!-- Calendar -->
        <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

            <!-- Month Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6">

                <div>

                    <h2 class="text-xl font-bold text-prim">
                        {{ $currentMonth->format('F Y') }}
                    </h2>

                    <p class="text-xs text-sec mt-1">
                        Learning History Calendar
                    </p>

                </div>

                <div
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-grn/10 border border-grn/20 text-grn text-xs">

                    <span class="w-2 h-2 rounded-full bg-grn animate-pulse"></span>

                    Today: {{ now()->format('d M Y') }}

                </div>

            </div>

            <!-- Days Header -->
            <div class="grid grid-cols-7 gap-3 mb-3">

                @foreach (['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'] as $day)
                    <div class="bg-input border border-bdr rounded-xl py-3 text-center">

                        <span class="text-xs font-semibold uppercase text-sec">

                            {{ $day }}

                        </span>

                    </div>
                @endforeach

            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-3">

                {{-- Empty Cells --}}
                @for ($i = 0; $i < $offset; $i++)
                    <div></div>
                @endfor

                {{-- Dates --}}
                @for ($date = 1; $date <= $daysInMonth; $date++)
                    @php

                        $dayLessons = $lessonMap[$date] ?? [];

                        $hasLesson = count($dayLessons) > 0;

                        $isToday =
                            $date == now()->day &&
                            $currentMonth->month == now()->month &&
                            $currentMonth->year == now()->year;

                    @endphp

                    <button @if ($hasLesson) onclick='openLessonModal(@json($dayLessons))' @endif
                        class="
                        group
                        min-h-[95px]
                        rounded-2xl
                        p-3
                        transition-all
                        duration-300
                        hover:-translate-y-1

                        {{ $isToday
                            ? 'bg-grn border border-grn text-white shadow-lg shadow-grn/20'
                            : 'bg-input border ' .
                                ($hasLesson ? 'border-accent/30 hover:border-accent hover:shadow-lg hover:shadow-accent/10' : 'border-bdr') }}
                    ">

                        <div class="flex flex-col h-full">

                            <div class="text-left">

                                <span class="text-lg font-bold {{ $isToday ? 'text-white' : 'text-prim' }}">

                                    {{ str_pad($date, 2, '0', STR_PAD_LEFT) }}

                                </span>

                            </div>

                            <div class="mt-auto">

                                @if ($isToday)
                                    <span class="inline-flex px-2 py-1 rounded-full bg-white/20 text-[10px] text-white">

                                        TODAY

                                    </span>
                                @elseif($hasLesson)
                                    <div class="flex flex-col gap-1">

                                        @foreach (collect($dayLessons)->take(3) as $index => $lesson)
                                            @php

                                                $colors = [
                                                    'bg-accent/10 text-accent',
                                                    'bg-grn/10 text-grn',
                                                    'bg-amb/10 text-amb',
                                                    'bg-pur/10 text-pur',
                                                    'bg-tel/10 text-tel',
                                                    'bg-pnk/10 text-pnk',
                                                ];

                                            @endphp

                                            <span
                                                class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-[9px] w-fit {{ $colors[$index % count($colors)] }}">

                                                ●

                                                {{ \Illuminate\Support\Str::limit($lesson['subject'], 10) }}

                                            </span>
                                        @endforeach

                                        @if (count($dayLessons) > 3)
                                            <span class="text-[9px] text-sec">
                                                +{{ count($dayLessons) - 3 }} more
                                            </span>
                                        @endif

                                    </div>
                                @else
                                    <span class="text-[10px] text-sec">

                                        No Class

                                    </span>
                                @endif

                            </div>

                        </div>

                    </button>
                @endfor

            </div>

        </div>

    </main>

    <!-- Modal -->
    <div id="lessonModal"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-[999] flex items-center justify-center p-4">

        <div class="bg-card border border-bdr rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-bdr">

                <div>

                    <h3 id="modalDate" class="text-xl font-bold text-prim">
                        30 May 2026
                    </h3>

                    <p class="text-xs text-sec mt-1">
                        Lesson Details
                    </p>

                </div>

                <button onclick="closeLessonModal()"
                    class="w-10 h-10 rounded-xl bg-input border border-bdr text-sec hover:text-red transition">

                    <i class="fas fa-times"></i>

                </button>

            </div>

            <!-- Body -->
            <div id="lessonContainer" class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
            </div>

        </div>

    </div>

    <script>
        const modal = document.getElementById('lessonModal');

        const modalDate = document.getElementById('modalDate');

        const lessonContainer =
            document.getElementById('lessonContainer');

        function openLessonModal(lessons) {
            if (!lessons.length) return;

            modalDate.textContent = lessons[0].date;

            let html = '';

            lessons.forEach((lesson, index) => {
                html += `

                    <div class="bg-gradient-to-br from-input to-hover border border-bdr rounded-2xl p-5 shadow-lg shadow-black/10">

                        <!-- Subject -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent/10 text-accent text-xs font-medium">

                                <i class="fas fa-book"></i>

                                Subject

                            </span>

                            <p class="font-bold text-prim text-lg mt-2">
                                ${lesson.subject}
                            </p>

                        </div>

                        <!-- Topic -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-grn/10 text-grn text-xs font-medium">

                                <i class="fas fa-list-check"></i>

                                Topics Covered

                            </span>

                            <ul class="mt-3 space-y-2">

                                ${
                                    lesson.topic
                                        .split('\n')
                                        .filter(item => item.trim() !== '')
                                        .map(item => `
                                                <li class="flex items-center gap-2 text-sm text-prim">

                                                    <span class="w-2 h-2 rounded-full bg-grn"></span>

                                                    ${item}

                                                </li>
                                            `)
                                        .join('')
                                }

                            </ul>

                        </div>

                        <!-- Platform -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-pur/10 text-pur text-xs font-medium">

                                <i class="fas fa-laptop"></i>

                                Platform

                            </span>

                            <p class="text-sm text-prim mt-2">
                                ${lesson.platform}
                            </p>

                        </div>

                        <!-- Notes -->
                        <div>

                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amb/10 text-amb text-xs font-medium">

                                <i class="fas fa-note-sticky"></i>

                                Notes

                            </span>

                            <div class="mt-3 p-3 rounded-xl bg-base/40 border border-bdr">

                                <p class="text-xs ">
                                    ${lesson.notes ?? 'No notes available'}
                                </p>

                            </div>

                        </div>

                    </div>

                    `;
            });

            lessonContainer.innerHTML = html;

            modal.classList.remove('hidden');

            document.body.classList.add('overflow-hidden');
        }

        function closeLessonModal() {
            modal.classList.add('hidden');

            document.body.classList.remove('overflow-hidden');
        }

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLessonModal();
            }
        });
    </script>

@endsection
