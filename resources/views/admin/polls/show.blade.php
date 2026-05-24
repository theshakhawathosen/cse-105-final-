@extends('layouts.admin.admin-layout')
@section('title', 'Poll Details')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">
                <i class="fas fa-circle text-[6px] pulse-anim"></i>
                Poll Details
            </span>

            <h1 class="text-xl font-bold text-tp mt-4">

                {{ $poll->question }}

            </h1>

            <p class="text-ts text-sm">

                Poll analytics and voting result

            </p>

        </div>

        <a href="{{ route('polls.index') }}"
            class="btn-ghost text-xs px-4 py-2">

            Back
        </a>

    </div>

    <!-- Poll Info -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        <!-- Total Votes -->
        <div class="dash-card p-4">

            <p class="text-ts text-xs">
                Total Votes
            </p>

            <h2 class="text-2xl font-bold text-tp mt-2">

                {{ $totalVotes }}

            </h2>

        </div>

        <!-- Options -->
        <div class="dash-card p-4">

            <p class="text-ts text-xs">
                Total Options
            </p>

            <h2 class="text-2xl font-bold text-tp mt-2">

                {{ $poll->options->count() }}

            </h2>

        </div>

        <!-- Status -->
        <div class="dash-card p-4">

            <p class="text-ts text-xs">
                Poll Status
            </p>

            <h2 class="text-lg font-semibold text-tp mt-2 capitalize">

                {{ $poll->status }}

            </h2>

        </div>

        <!-- Winner -->
        <div class="dash-card p-4">

            <p class="text-ts text-xs">
                Winning Option
            </p>

            <h2 class="text-lg font-semibold text-green-400 mt-2">

                {{ $winner?->option_text ?? 'No Winner' }}

            </h2>

        </div>

    </div>

    <!-- Poll Result -->
    <div class="dash-card p-5 mb-6 fade-up">

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-tp font-semibold">
                Poll Results
            </h2>

            @php

                $isClosed =
                    $poll->status == 'closed' ||
                    ($poll->expire_at && now()->gt($poll->expire_at));

            @endphp

            @if($isClosed)

                <span
                    class="text-[10px] px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">

                    Poll Closed
                </span>

            @else

                <span
                    class="text-[10px] px-3 py-1 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">

                    Poll Active
                </span>

            @endif

        </div>

        <div class="space-y-5">

            @foreach($poll->options as $option)

                @php

                    $voteCount = $option->votes->count();

                    $percentage =
                        $totalVotes > 0
                            ? round(($voteCount / $totalVotes) * 100)
                            : 0;

                @endphp

                <div>

                    <!-- Top -->
                    <div class="flex justify-between items-center mb-2">

                        <div class="flex items-center gap-2">

                            <h3 class="text-sm font-medium text-tp">

                                {{ $option->option_text }}

                            </h3>

                            @if($winner && $winner->id == $option->id)

                                <span
                                    class="text-[10px] px-2 py-1 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">

                                    Winner
                                </span>

                            @endif

                        </div>

                        <span class="text-xs text-ts">

                            {{ $voteCount }} Votes
                            ({{ $percentage }}%)

                        </span>

                    </div>

                    <!-- Progress -->
                    <div
                        class="w-full h-3 rounded-full bg-input border border-border overflow-hidden">

                        <div
                            class="h-full bg-accent rounded-full transition-all duration-500"
                            style="width: {{ $percentage }}%">

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    <!-- Vote Details -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Voted Students -->
        <div class="dash-card p-5">

            <div class="flex items-center justify-between mb-4">

                <h2 class="text-tp font-semibold">
                    Students Who Voted
                </h2>

                <span
                    class="text-xs px-2 py-1 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">

                    {{ $totalVotes }} Students

                </span>

            </div>

            <div class="space-y-3 max-h-[400px] overflow-y-auto">

                @forelse($poll->votes as $vote)

                    <div
                        class="flex items-center justify-between p-3 rounded-xl border border-border bg-input/30">

                        <div>

                            <h3 class="text-sm font-medium text-tp">

                                {{ $vote->student->name ?? 'Unknown Student' }}

                            </h3>

                            <p class="text-xs text-ts mt-1">

                                Voted:
                                {{ $vote->option->option_text ?? '-' }}

                            </p>

                        </div>

                        <span class="text-[10px] text-ts">

                            {{ $vote->created_at->diffForHumans() }}

                        </span>

                    </div>

                @empty

                    <p class="text-ts text-sm">

                        No votes yet

                    </p>

                @endforelse

            </div>

        </div>

        <!-- Not Voted -->
        <div class="dash-card p-5">

            <div class="flex items-center justify-between mb-4">

                <h2 class="text-tp font-semibold">
                    Students Not Voted
                </h2>

            </div>

            @php

                $votedStudentIds = $poll->votes
                    ->pluck('user_id');

                $notVotedStudents = \App\Models\User::whereNotIn(
                    'id',
                    $votedStudentIds
                )->get();

            @endphp

            <div class="space-y-3 max-h-[400px] overflow-y-auto">

                @forelse($notVotedStudents as $student)

                    <div
                        class="flex items-center justify-between p-3 rounded-xl border border-border bg-input/30">

                        <div>

                            <h3 class="text-sm font-medium text-tp">

                                {{ $student->name }}

                            </h3>

                            <p class="text-xs text-ts mt-1">

                                Did not participate

                            </p>

                        </div>

                        <span
                            class="text-[10px] px-2 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">

                            Not Voted
                        </span>

                    </div>

                @empty

                    <p class="text-ts text-sm">

                        Everyone voted

                    </p>

                @endforelse

            </div>

        </div>

    </div>

</main>

@endsection
