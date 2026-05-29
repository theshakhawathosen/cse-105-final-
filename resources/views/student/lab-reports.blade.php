@extends('layouts.student.student-layout')

@section('title', 'Lab Reports')

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

        <div>
            <div class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">
                <span class="w-2 h-2 rounded-full bg-purple-400 animate-pulse"></span>
                Student Portal
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                Lab Reports
            </h1>
            <p class="text-sec text-sm mt-1">
                View your lab report tasks and submissions
            </p>
        </div>

        <!-- Right: Total + Subject Filter -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">

            <div class="inline-flex items-center gap-2 bg-card border border-bdr px-4 py-2.5 rounded-2xl text-sm text-sec shrink-0">
                <i class="fas fa-flask text-purple-400"></i>
                <span class="text-prim font-medium">{{ $labReports->total() }}</span> Total Reports
            </div>

            <form method="GET" action="{{ route('student.lab-report') }}">
                <select
                    name="subject_id"
                    onchange="this.form.submit()"
                    class="bg-card border border-bdr text-sec text-sm px-4 py-2.5 rounded-2xl focus:outline-none focus:border-purple-400/50 hover:border-purple-400/50 transition-all duration-200 cursor-pointer">
                    <option value="">All Subjects</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                            {{ $subject->name }}
                        </option>
                    @endforeach
                </select>
            </form>

        </div>

    </div>

    <!-- Lab Report List -->
    <div class="space-y-4">

        @forelse($labReports as $report)

            @php
                $isExpired = $report->deadline
                    ? \Carbon\Carbon::parse($report->deadline)->isPast()
                    : false;

                $isDueSoon = $report->deadline
                    ? \Carbon\Carbon::parse($report->deadline)->diffInDays(now()) <= 3 && !$isExpired
                    : false;
            @endphp

            <!-- Row Card -->
            <a href="{{ route('student.lab-report.show', $report->id) }}"
               class="group bg-card border border-bdr rounded-2xl px-5 py-4 hover:border-purple-400/50 hover:bg-card/80 transition-all duration-300 shadow-md shadow-black/10 animate-fadeUp flex items-center gap-5">

                <!-- Index + Icon -->
                <div class="w-12 h-12 rounded-2xl bg-purple-400/10 border border-purple-400/20 text-purple-400 flex items-center justify-center shrink-0 group-hover:bg-purple-400/20 transition-colors duration-200">
                    <i class="fas fa-flask text-lg"></i>
                </div>

                <!-- Main Info -->
                <div class="flex-1 min-w-0">

                    <div class="flex flex-wrap items-center gap-2 mb-1">

                        <span class="text-[11px] bg-input border border-bdr text-sec px-2.5 py-0.5 rounded-full">
                            Report #{{ $loop->iteration }}
                        </span>

                        <!-- Status -->
                        @if($report->status === 'active')
                            <span class="inline-flex items-center gap-1 bg-grn/10 text-grn border border-grn/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-grn"></span> Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-red"></span> Inactive
                            </span>
                        @endif

                        <!-- Deadline badge -->
                        @if($isExpired)
                            <span class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-clock text-[9px]"></i> Expired
                            </span>
                        @elseif($isDueSoon)
                            <span class="inline-flex items-center gap-1 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-exclamation-circle text-[9px]"></i> Due Soon
                            </span>
                        @endif

                        @if($report->file)
                            <span class="inline-flex items-center gap-1 bg-purple-400/10 text-purple-400 border border-purple-400/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-paperclip text-[9px]"></i> File
                            </span>
                        @endif

                    </div>

                    <h2 class="text-white font-semibold text-prim group-hover:text-purple-400 transition-colors duration-200 truncate">
                        {{ $report->title }}
                    </h2>

                    @if($report->description)
                        <p class="text-xs text-sec mt-0.5 truncate">{{ $report->description }}</p>
                    @endif

                </div>

                <!-- Subject + Deadline -->
                <div class="hidden sm:flex flex-col items-end gap-1.5 shrink-0 text-right">

                    <div class="inline-flex items-center gap-1.5 bg-input border border-bdr text-sec text-xs px-3 py-1.5 rounded-xl">
                        <i class="fas fa-book text-[10px] text-purple-400"></i>
                        {{ $report->subject->name ?? 'N/A' }}
                    </div>

                    <span class="text-xs {{ $isExpired ? 'text-red' : ($isDueSoon ? 'text-yellow-400' : 'text-sec') }}">
                        <i class="fas fa-calendar-alt text-[10px] mr-1"></i>
                        @if($report->deadline)
                            {{ \Carbon\Carbon::parse($report->deadline)->format('d M Y') }}
                        @else
                            No Deadline
                        @endif
                    </span>

                </div>

                <!-- Arrow -->
                <div class="text-sec group-hover:text-purple-400 transition-colors duration-200 shrink-0">
                    <i class="fas fa-chevron-right text-sm group-hover:translate-x-0.5 transition-transform duration-200"></i>
                </div>

            </a>

        @empty

            <div class="bg-card border border-bdr rounded-3xl p-10 text-center">

                <div class="w-20 h-20 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center text-sec text-3xl">
                    <i class="fas fa-flask"></i>
                </div>

                <h3 class="text-xl font-semibold text-prim mt-5">No Lab Reports Found</h3>

                <p class="text-sec text-sm mt-2">
                    @if(request('subject_id'))
                        No lab reports available for this subject.
                    @else
                        There are currently no lab reports posted for you.
                    @endif
                </p>

            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $labReports->appends(request()->query())->links() }}
    </div>

</main>

@endsection
