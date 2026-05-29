@extends('layouts.student.student-layout')

@section('title', $assignment->title)

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Breadcrumb / Back -->
    <div class="mb-6 animate-fadeUp">
        <a href="{{ route('student.assignment') }}"
           class="inline-flex items-center gap-2 text-sec hover:text-prim text-sm transition-colors duration-200">
            <i class="fas fa-arrow-left text-xs"></i>
            Back to Assignments
        </a>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="xl:col-span-2 space-y-5 animate-fadeUp">

            <!-- Title Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                <!-- Top Row -->
                <div class="flex items-start justify-between gap-4">

                    <div class="flex-1">

                        <div class="inline-flex items-center gap-2 bg-input border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">
                            <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                            Assignment Details
                        </div>

                        <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4 leading-snug">
                            {{ $assignment->title }}
                        </h1>

                    </div>

                    <div class="w-14 h-14 rounded-2xl bg-accent/10 text-accent flex items-center justify-center border border-accent/20 shrink-0">
                        <i class="fas fa-file-alt text-2xl"></i>
                    </div>

                </div>

                <!-- Status Badges -->
                @php
                    $isExpired = $assignment->deadline
                        ? \Carbon\Carbon::parse($assignment->deadline)->isPast()
                        : false;

                    $isDueSoon = $assignment->deadline
                        ? \Carbon\Carbon::parse($assignment->deadline)->diffInDays(now()) <= 3 && !$isExpired
                        : false;
                @endphp

                <div class="flex flex-wrap items-center gap-2 mt-5">

                    @if($isExpired)
                        <span class="inline-flex items-center gap-1.5 bg-red/10 text-red border border-red/20 text-xs px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-red"></span>
                            Expired
                        </span>
                    @elseif($isDueSoon)
                        <span class="inline-flex items-center gap-1.5 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-xs px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                            Due Soon
                        </span>
                    @elseif($assignment->deadline)
                        <span class="inline-flex items-center gap-1.5 bg-grn/10 text-grn border border-grn/20 text-xs px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-grn"></span>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-xs px-3 py-1.5 rounded-full">
                            <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                            No Deadline
                        </span>
                    @endif

                    @if($assignment->file)
                        <span class="inline-flex items-center gap-1.5 bg-accent/10 text-accent border border-accent/20 text-xs px-3 py-1.5 rounded-full">
                            <i class="fas fa-paperclip text-[10px]"></i>
                            Has Attachment
                        </span>
                    @endif

                </div>

            </div>

            <!-- Description Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center">
                        <i class="fas fa-align-left text-sm"></i>
                    </div>
                    <h2 class="text-white font-semibold text-prim">Description</h2>
                </div>

                <div class="bg-input border border-bdr rounded-2xl px-5 py-4">
                    @if($assignment->description)
                        <p class="text-sm text-prim leading-relaxed whitespace-pre-line">
                            {{ $assignment->description }}
                        </p>
                    @else
                        <p class="text-sm text-sec italic">
                            No description provided for this assignment.
                        </p>
                    @endif
                </div>

            </div>

            <!-- Attachment Card -->
            @if($assignment->file)
                <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center">
                            <i class="fas fa-paperclip text-sm"></i>
                        </div>
                        <h2 class="text-white font-semibold text-prim">Attachment</h2>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-5 py-4 flex items-center justify-between gap-4">

                        <div class="flex items-center gap-3 min-w-0">

                            <div class="w-10 h-10 rounded-xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center shrink-0">
                                <i class="fas fa-file text-sm"></i>
                            </div>

                            <div class="min-w-0">
                                <p class="text-sm font-medium text-prim truncate">
                                    {{ basename($assignment->file) }}
                                </p>
                                <p class="text-xs text-sec mt-0.5">Assignment File</p>
                            </div>

                        </div>

                        <a href="{{ asset('storage/assignments/' . $assignment->file) }}"
                           target="_blank"
                           download
                           class="inline-flex items-center gap-2 bg-accent hover:bg-ahover text-white text-xs font-medium px-4 py-2.5 rounded-xl transition shrink-0 shadow-lg shadow-accent/20">
                            <i class="fas fa-download text-[11px]"></i>
                            Download
                        </a>

                    </div>

                </div>
            @endif

        </div>

        <!-- Sidebar -->
        <div class="space-y-5 animate-fadeUp">

            <!-- Info Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    <h2 class="text-white font-semibold text-prim">Assignment Info</h2>
                </div>

                <div class="space-y-4">

                    <!-- Subject -->
                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1">
                            <i class="fas fa-book mr-1"></i> Subject
                        </p>
                        <p class="text-sm font-semibold text-prim">
                            {{ $assignment->subject->name ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Posted Date -->
                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1">
                            <i class="fas fa-calendar-plus mr-1"></i> Posted On
                        </p>
                        <p class="text-sm font-semibold text-prim">
                            {{ $assignment->created_at->format('d M Y') }}
                        </p>
                        <p class="text-xs text-sec mt-0.5">
                            {{ $assignment->created_at->format('h:i A') }}
                        </p>
                    </div>

                    <!-- Deadline -->
                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1">
                            <i class="fas fa-calendar-times mr-1"></i> Deadline
                        </p>
                        @if($assignment->deadline)
                            <p class="text-sm font-semibold {{ $isExpired ? 'text-red' : ($isDueSoon ? 'text-yellow-400' : 'text-prim') }}">
                                {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}
                            </p>
                            <p class="text-xs text-sec mt-0.5">
                                @if($isExpired)
                                    Expired {{ \Carbon\Carbon::parse($assignment->deadline)->diffForHumans() }}
                                @else
                                    Due {{ \Carbon\Carbon::parse($assignment->deadline)->diffForHumans() }}
                                @endif
                            </p>
                        @else
                            <p class="text-sm font-semibold text-prim">No Deadline</p>
                        @endif
                    </div>

                    <!-- Attachment status -->
                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1">
                            <i class="fas fa-paperclip mr-1"></i> Attachment
                        </p>
                        @if($assignment->file)
                            <p class="text-sm font-semibold text-grn">
                                <i class="fas fa-check-circle mr-1"></i> File Available
                            </p>
                        @else
                            <p class="text-sm font-semibold text-sec">
                                <i class="fas fa-times-circle mr-1"></i> No File
                            </p>
                        @endif
                    </div>

                </div>

            </div>

            <!-- Deadline Countdown -->
            @if($assignment->deadline && !$isExpired)
                <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 flex items-center justify-center">
                            <i class="fas fa-hourglass-half text-sm"></i>
                        </div>
                        <h2 class="text-white font-semibold text-prim">Time Remaining</h2>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-4 text-center">
                        <p class="text-2xl font-bold {{ $isDueSoon ? 'text-yellow-400' : 'text-accent' }}" id="countdown-display">
                            --
                        </p>
                        <p class="text-xs text-sec mt-1">Until deadline</p>
                    </div>

                </div>

                <script>
                    (function() {
                        const deadline = new Date("{{ \Carbon\Carbon::parse($assignment->deadline)->toIso8601String() }}");
                        const el = document.getElementById('countdown-display');

                        function update() {
                            const now = new Date();
                            const diff = deadline - now;
                            if (diff <= 0) {
                                el.textContent = 'Expired';
                                el.classList.add('text-red');
                                return;
                            }
                            const d = Math.floor(diff / 86400000);
                            const h = Math.floor((diff % 86400000) / 3600000);
                            const m = Math.floor((diff % 3600000) / 60000);

                            if (d > 0) el.textContent = d + 'd ' + h + 'h ' + m + 'm';
                            else if (h > 0) el.textContent = h + 'h ' + m + 'm';
                            else el.textContent = m + 'm';
                        }

                        update();
                        setInterval(update, 60000);
                    })();
                </script>
            @endif

            <!-- Back Button -->
            <a href="{{ route('student.assignment') }}"
               class="w-full inline-flex items-center justify-center gap-2 bg-input hover:bg-card border border-bdr text-sec hover:text-prim text-sm font-medium px-5 py-3 rounded-2xl transition-all duration-200">
                <i class="fas fa-arrow-left text-xs"></i>
                Back to All Assignments
            </a>

        </div>

    </div>

</main>

@endsection
