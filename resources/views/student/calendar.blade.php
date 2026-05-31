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

    <main id="main-content" class="px-2 sm:px-4 md:px-6 lg:px-8 py-4 sm:py-6">

        <!-- Header -->
        <div class="bg-card border border-bdr rounded-2xl sm:rounded-3xl p-4 sm:p-6 shadow-lg shadow-black/10 mb-4 sm:mb-6">

            <div class="flex items-center gap-3 sm:gap-4">

                <div
                    class="w-11 h-11 sm:w-14 sm:h-14 rounded-xl sm:rounded-2xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center shrink-0">

                    <i class="fas fa-book-open text-lg sm:text-2xl"></i>

                </div>

                <div class="min-w-0">

                    <h1 class="text-lg sm:text-2xl font-bold text-prim break-words">
                        Class Learning Tracker
                    </h1>

                    <p class="text-xs sm:text-sm text-sec mt-1 break-words">
                        Click any date to view lesson details.
                    </p>

                </div>

            </div>

        </div>

        <!-- Calendar -->
        <div class="bg-card border border-bdr rounded-2xl sm:rounded-3xl p-2 sm:p-6 shadow-lg shadow-black/10">

            <!-- Month Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4 sm:mb-6">

                <div>

                    <h2 class="text-lg sm:text-xl font-bold text-prim">
                        {{ $currentMonth->format('F Y') }}
                    </h2>

                    <p class="text-[11px] sm:text-xs text-sec mt-1">
                        Learning History Calendar
                    </p>

                </div>

                <div
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-grn/10 border border-grn/20 text-grn text-[10px] sm:text-xs w-fit">

                    <span class="w-2 h-2 rounded-full bg-grn animate-pulse"></span>

                    Today: {{ now()->format('d M Y') }}

                </div>

            </div>

            <!-- Days Header -->
            <div class="grid grid-cols-7 gap-1 sm:gap-3 mb-2 sm:mb-3">

                @foreach (['Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri'] as $day)
                    <div class="bg-input border border-bdr rounded-lg sm:rounded-xl py-2 sm:py-3 text-center">

                        <span class="text-[9px] sm:text-xs font-semibold uppercase text-sec">

                            {{ $day }}

                        </span>

                    </div>
                @endforeach

            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 gap-1 sm:gap-3">

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

                    <button
                        @if ($hasLesson) onclick='openLessonModal(@json($dayLessons))' @endif
                        class="
                        group
                        min-h-[70px]
                        sm:min-h-[95px]
                        rounded-xl
                        sm:rounded-2xl
                        p-1.5
                        sm:p-3
                        transition-all
                        duration-300
                        hover:-translate-y-1
                        overflow-hidden

                        {{ $isToday
                            ? 'bg-grn border border-grn text-white shadow-lg shadow-grn/20'
                            : 'bg-input border ' .
                                ($hasLesson ? 'border-accent/30 hover:border-accent hover:shadow-lg hover:shadow-accent/10' : 'border-bdr') }}
                    ">

                        <div class="flex flex-col h-full min-w-0">

                            <div class="text-left">

                                <span
                                    class="text-[11px] sm:text-lg font-bold {{ $isToday ? 'text-white' : 'text-prim' }}">

                                    {{ str_pad($date, 2, '0', STR_PAD_LEFT) }}

                                </span>

                            </div>

                            <div class="mt-auto overflow-hidden">

                                @if ($isToday)
                                    <span
                                        class="inline-flex px-1 py-0.5 sm:px-2 sm:py-1 rounded-full bg-white/20 text-[8px] sm:text-[10px] text-white">

                                        TODAY

                                    </span>
                                                                    @elseif($hasLesson)

                                    <div class="flex flex-col gap-1 overflow-hidden">

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
                                                class="inline-flex items-center gap-1 px-1 py-0.5 sm:px-2 sm:py-1 rounded-full text-[7px] sm:text-[9px] max-w-full overflow-hidden whitespace-nowrap {{ $colors[$index % count($colors)] }}">

                                                ●

                                                <span class="truncate">
                                                    {{ \Illuminate\Support\Str::limit($lesson['subject'], 6) }}
                                                </span>

                                            </span>

                                        @endforeach

                                        @if (count($dayLessons) > 3)
                                            <span class="text-[7px] sm:text-[9px] text-sec truncate">
                                                +{{ count($dayLessons) - 3 }} more
                                            </span>
                                        @endif

                                    </div>

                                @else

                                    <span class="text-[7px] sm:text-[10px] text-sec">

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
        class="fixed inset-0 bg-black/70 backdrop-blur-sm hidden z-[999] flex items-center justify-center p-2 sm:p-4">

        <div
            class="bg-card border border-bdr rounded-2xl sm:rounded-3xl w-full max-w-2xl overflow-hidden shadow-2xl mx-1 sm:mx-0">

            <!-- Header -->
            <div class="flex items-center justify-between p-3 sm:p-6 border-b border-bdr">

                <div class="min-w-0">

                    <h3 id="modalDate" class="text-base sm:text-xl font-bold text-prim break-words">
                        30 May 2026
                    </h3>

                    <p class="text-[10px] sm:text-xs text-sec mt-1">
                        Lesson Details
                    </p>

                </div>

                <button
                    onclick="closeLessonModal()"
                    class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-input border border-bdr text-sec hover:text-red transition shrink-0">

                    <i class="fas fa-times"></i>

                </button>

            </div>

            <!-- Body -->
            <div
                id="lessonContainer"
                class="p-3 sm:p-6 space-y-3 sm:space-y-4 max-h-[75vh] overflow-y-auto">
            </div>

        </div>

    </div>

    <script>
        const modal = document.getElementById('lessonModal');

        const modalDate = document.getElementById('modalDate');

        const lessonContainer = document.getElementById('lessonContainer');

        function openLessonModal(lessons) {

            if (!lessons.length) return;

            modalDate.textContent = lessons[0].date;

            let html = '';

            lessons.forEach((lesson, index) => {

                html += `

                    <div class="bg-gradient-to-br from-input to-hover border border-bdr rounded-2xl p-3 sm:p-5 shadow-lg shadow-black/10">

                        <!-- Subject -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-accent/10 text-accent text-[10px] sm:text-xs font-medium">

                                <i class="fas fa-book"></i>

                                Subject

                            </span>

                            <p class="font-bold text-prim text-sm sm:text-lg mt-2 break-words whitespace-pre-wrap">${lesson.subject}</p>

                        </div>

                        <!-- Topic -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-grn/10 text-grn text-[10px] sm:text-xs font-medium">

                                <i class="fas fa-list-check"></i>

                                Topics Covered

                            </span>

                            <ul class="mt-3 space-y-2">${lesson.topic
                                        .split('\n')
                                        .filter(item => item.trim() !== '')
                                        .map(item => `
                                                <li class="flex items-start gap-2 text-xs sm:text-sm text-prim break-words">
                                                    <span class="w-2 h-2 rounded-full bg-grn mt-1 shrink-0"></span>
                                                    <span class="break-words whitespace-pre-wrap">${item}</span>
                                                </li>
                                            `)
                                        .join('')
                                }
                            </ul>

                        </div>

                        <!-- Platform -->
                        <div class="mb-4">

                            <span class="inline-flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-pur/10 text-pur text-[10px] sm:text-xs font-medium">

                                <i class="fas fa-laptop"></i>

                                Platform

                            </span>

                            <p class="text-xs sm:text-sm text-prim mt-2 break-words whitespace-pre-wrap">${lesson.platform ?? 'N/A'}</p>

                        </div>

                        <!-- Notes -->
                        <div>

                            <span class="inline-flex items-center gap-2 px-2 sm:px-3 py-1 rounded-full bg-amb/10 text-amb text-[10px] sm:text-xs font-medium">

                                <i class="fas fa-note-sticky"></i>

                                Notes

                            </span>

                            <div class="mt-3 p-3 rounded-xl bg-base/40 border border-bdr overflow-hidden">

                                <p class="text-xs text-prim break-words whitespace-pre-wrap">${lesson.notes ?? 'No notes available'}</p>

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

        document.addEventListener('keydown', function(e) {

            if (e.key === 'Escape') {
                closeLessonModal();
            }

        });
    </script>

@endsection
