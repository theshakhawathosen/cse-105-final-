@extends('layouts.student.student-layout')

@section('title', 'Assignments')

@section('content')

    <main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

            <div>

                <div
                    class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Student Portal
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                    Assignments
                </h1>

                <p class="text-sec text-sm mt-1">
                    View and manage your pending assignments
                </p>

            </div>

            <!-- Right Side: Total + Subject Filter -->
            <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                <!-- Total Count -->
                <div
                    class="inline-flex items-center gap-2 bg-card border border-bdr px-4 py-2.5 rounded-2xl text-sm text-sec shrink-0">
                    <i class="fas fa-layer-group text-accent"></i>
                    <span class="text-prim font-medium">{{ $assignments->total() }}</span> Total Assignments
                </div>

                <!-- Subject Filter Dropdown -->
                <!-- Subject Filter -->
                <form method="GET" action="{{ route('student.assignment') }}">
                    <select name="subject_id" onchange="this.form.submit()"
                        class="bg-card border border-bdr text-sec text-sm px-4 py-2.5 rounded-2xl focus:outline-none focus:border-accent/50 hover:border-accent/50 transition-all duration-200 cursor-pointer">
                        <option value="">All Subjects</option>
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}"
                                {{ request('subject_id') == $subject->id ? 'selected' : '' }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

            </div>

        </div>

        <!-- Active Filter Label -->
        @if (request('subject_id') && $subjects->find(request('subject_id')))
            <div class="mb-5 animate-fadeUp">
                <div
                    class="inline-flex items-center gap-2 bg-accent/10 border border-accent/20 text-accent text-xs px-4 py-2 rounded-full">
                    <i class="fas fa-filter text-[10px]"></i>
                    Showing: <span class="font-semibold">{{ $subjects->find(request('subject_id'))->name }}</span>
                    <a href="{{ route('student.assignment') }}"
                        class="ml-1 hover:text-white transition-colors duration-150">
                        <i class="fas fa-times-circle"></i>
                    </a>
                </div>
            </div>
        @endif

        <!-- Assignment Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @forelse($assignments as $assignment)
                @php
                    $isExpired = $assignment->deadline ? \Carbon\Carbon::parse($assignment->deadline)->isPast() : false;

                    $isDueSoon = $assignment->deadline
                        ? \Carbon\Carbon::parse($assignment->deadline)->diffInDays(now()) <= 3 && !$isExpired
                        : false;
                @endphp

                <!-- Card -->
                <a href="{{ route('student.assignment.show', $assignment->id) }}"
                    class="group bg-card border border-bdr rounded-3xl p-5 hover:border-accent/50 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-black/10 animate-fadeUp block">

                    <!-- Top -->
                    <div class="flex items-start justify-between gap-3">

                        <div class="flex-1 min-w-0">

                            <span
                                class="inline-flex items-center gap-1 bg-input border border-bdr text-sec text-[11px] px-2.5 py-1 rounded-full">
                                Assignment #{{ $loop->iteration }}
                            </span>

                            <h2
                                class="text-lg font-semibold text-prim mt-3 group-hover:text-accent transition-colors duration-200 line-clamp-2">
                                {{ $assignment->title }}
                            </h2>

                        </div>

                        <div
                            class="w-11 h-11 rounded-2xl bg-accent/10 text-accent flex items-center justify-center border border-accent/20 shrink-0 group-hover:bg-accent/20 transition-colors duration-200">
                            <i class="fas fa-file-alt text-lg"></i>
                        </div>

                    </div>

                    <!-- Status Badges -->
                    <div class="flex flex-wrap items-center gap-2 mt-4">

                        @if ($isExpired)
                            <span
                                class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-3 py-1 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-red"></span>
                                Expired
                            </span>
                        @elseif($isDueSoon)
                            <span
                                class="inline-flex items-center gap-1 bg-yellow-500/10 text-yellow-400 border border-yellow-500/20 text-[11px] px-3 py-1 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                                Due Soon
                            </span>
                        @elseif($assignment->deadline)
                            <span
                                class="inline-flex items-center gap-1 bg-grn/10 text-grn border border-grn/20 text-[11px] px-3 py-1 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-grn"></span>
                                Active
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[11px] px-3 py-1 rounded-full">
                                <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                                No Deadline
                            </span>
                        @endif

                        @if ($assignment->file)
                            <span
                                class="inline-flex items-center gap-1 bg-accent/10 text-accent border border-accent/20 text-[11px] px-3 py-1 rounded-full">
                                <i class="fas fa-paperclip text-[10px]"></i>
                                Attachment
                            </span>
                        @endif

                    </div>

                    <!-- Subject -->
                    <div class="mt-5 bg-input border border-bdr rounded-2xl px-4 py-3 flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-xl bg-accent/10 border border-accent/20 text-accent flex items-center justify-center shrink-0">
                            <i class="fas fa-book text-xs"></i>
                        </div>
                        <div>
                            <p class="text-[11px] text-sec">Subject</p>
                            <p class="text-sm font-medium text-prim">{{ $assignment->subject->name ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <!-- Description Preview -->
                    @if ($assignment->description)
                        <div class="mt-3 bg-input border border-bdr rounded-2xl px-4 py-3">
                            <p class="text-[11px] text-sec mb-1">Description</p>
                            <p class="text-sm text-prim leading-relaxed line-clamp-2">
                                {{ $assignment->description }}
                            </p>
                        </div>
                    @endif

                    <!-- Footer -->
                    <div class="flex items-center justify-between mt-5 pt-4 border-t border-bdr">

                        <div class="text-xs text-sec space-y-1">

                            <div>
                                Posted :
                                <span class="text-prim font-medium">
                                    {{ $assignment->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <div>
                                Deadline :
                                <span
                                    class="{{ $isExpired ? 'text-red' : ($isDueSoon ? 'text-yellow-400' : 'text-prim') }} font-medium">
                                    @if ($assignment->deadline)
                                        {{ \Carbon\Carbon::parse($assignment->deadline)->format('d M Y') }}
                                    @else
                                        No Deadline
                                    @endif
                                </span>
                            </div>

                        </div>

                        <div
                            class="inline-flex items-center gap-1.5 bg-accent/10 border border-accent/20 text-accent text-xs px-4 py-2 rounded-xl group-hover:bg-accent group-hover:text-white transition-all duration-200">
                            <span>View</span>
                            <i
                                class="fas fa-arrow-right text-[10px] group-hover:translate-x-0.5 transition-transform duration-200"></i>
                        </div>

                    </div>

                </a>

            @empty

                <!-- Empty State -->
                <div class="col-span-full bg-card border border-bdr rounded-3xl p-10 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center text-sec text-3xl">
                        <i class="fas fa-file-alt"></i>
                    </div>

                    <h3 class="text-xl font-semibold text-prim mt-5">
                        No Assignments Found
                    </h3>

                    <p class="text-sec text-sm mt-2">
                        @if (request('subject_id'))
                            No assignments available for this subject.
                        @else
                            There are currently no assignments posted for you.
                        @endif
                    </p>

                    @if (request('subject_id'))
                        <a href="{{ route('student.assignment') }}"
                            class="inline-flex items-center gap-2 mt-5 bg-accent hover:bg-ahover text-white text-sm font-medium px-5 py-2.5 rounded-2xl transition shadow-lg shadow-accent/20">
                            <i class="fas fa-times"></i>
                            Clear Filter
                        </a>
                    @endif

                </div>
            @endforelse

        </div>

        <!-- Pagination (keep subject filter in paginate links) -->
        <div class="mt-8">
            {{ $assignments->appends(request()->query())->links() }}
        </div>

    </main>

    <!-- Close dropdown on outside click -->
    <script>
        document.addEventListener('click', function(e) {
            const wrapper = document.getElementById('subject-dropdown-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById('subject-dropdown').classList.add('hidden');
            }
        });
    </script>

@endsection
