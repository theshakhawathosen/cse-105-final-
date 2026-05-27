@extends('layouts.student.student-layout')

@section('title', 'Polls')

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

        <div>

            <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                Student Voting System

            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                Polls & Voting
            </h1>

            <p class="text-sec text-sm mt-1">
                Participate in polls and check live voting results
            </p>

        </div>

    </div>

    <!-- Poll Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

        @forelse($polls as $poll)

            @php

                $totalVotes = $poll->votes->count();

                $userVote = $poll->votes
                    ->where('user_id', auth()->id())
                    ->first();

                $isExpired = $poll->expire_at
                    ? \Carbon\Carbon::parse($poll->expire_at)->isPast()
                    : false;

                // vote permission
                $canVote =
                    !$userVote &&
                    $poll->status === 'active' &&
                    !$isExpired;

            @endphp

            <!-- Card -->
            <div
                class="bg-card border border-bdr rounded-3xl p-5 hover:border-accent/50 hover:-translate-y-1 transition-all duration-300 shadow-lg shadow-black/10 animate-fadeUp">

                <!-- Top -->
                <div class="flex items-start justify-between gap-3">

                    <div>

                        <span
                            class="inline-flex items-center gap-1 bg-input border border-bdr text-sec text-[11px] px-2.5 py-1 rounded-full">

                            Poll #{{ $loop->iteration }}

                        </span>

                        <h2 class="text-lg font-semibold text-prim mt-3">
                            {{ $poll->title }}
                        </h2>

                    </div>

                    <div
                        class="w-11 h-11 rounded-2xl bg-accent/10 text-accent flex items-center justify-center border border-accent/20">

                        <i class="fas fa-chart-pie text-lg"></i>

                    </div>

                </div>

                <!-- Status -->
                <div class="flex flex-wrap items-center gap-2 mt-4">

                    <!-- Active / Closed -->
                    @if($poll->status == 'active')

                        <span
                            class="inline-flex items-center gap-1 bg-grn/10 text-grn border border-grn/20 text-[11px] px-3 py-1 rounded-full">

                            <span class="w-2 h-2 rounded-full bg-grn"></span>

                            Active

                        </span>

                    @else

                        <span
                            class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-3 py-1 rounded-full">

                            <span class="w-2 h-2 rounded-full bg-red"></span>

                            Closed

                        </span>

                    @endif

                    <!-- Expire -->
                    @if($poll->expire_at)

                        @if($isExpired)

                            <span
                                class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-3 py-1 rounded-full">

                                <i class="fas fa-clock text-[10px]"></i>

                                Expired

                            </span>

                        @else

                            <span
                                class="inline-flex items-center gap-1 bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[11px] px-3 py-1 rounded-full">

                                <i class="fas fa-hourglass-half text-[10px]"></i>

                                Running

                            </span>

                        @endif

                    @endif

                </div>

                <!-- Question -->
                <div
                    class="mt-5 bg-input border border-bdr rounded-2xl px-4 py-4">

                    <p class="text-sm text-sec mb-2">
                        Question
                    </p>

                    <h3 class="text-white font-medium text-prim leading-relaxed">
                        {{ $poll->question }}
                    </h3>

                </div>



                <!-- Voting Section -->
                <div class="mt-5">

                    @if($canVote)

                        <form
                            action="{{ route('student.poll.vote', $poll->id) }}"
                            method="POST">

                            @csrf

                            <div class="space-y-3">

                                @foreach($poll->options as $option)

                                    <label
                                        class="flex items-center gap-3 bg-input border border-bdr hover:border-accent rounded-2xl px-4 py-3 cursor-pointer transition">

                                        <input
                                            type="radio"
                                            name="poll_option_id"
                                            value="{{ $option->id }}"
                                            class="w-4 h-4 text-accent bg-input border-bdr focus:ring-accent"
                                            required>

                                        <span class="text-sm text-prim font-medium">
                                            {{ $option->option_text }}
                                        </span>

                                    </label>

                                @endforeach

                            </div>

                            <button
                                type="submit"
                                class="w-full mt-5 inline-flex items-center justify-center gap-2 bg-accent hover:bg-ahover text-white text-sm font-medium px-5 py-3 rounded-2xl transition shadow-lg shadow-accent/20">

                                <i class="fas fa-check-circle"></i>

                                Submit Vote

                            </button>

                        </form>

                    @else

                        <!-- Alert -->
                        <div
                            class="bg-input border border-bdr rounded-2xl px-4 py-3 mb-5">

                            @if($userVote)

                                <p class="text-sm text-grn font-medium">

                                    <i class="fas fa-check-circle mr-1"></i>

                                    You already voted in this poll

                                </p>

                            @elseif($poll->status == 'closed')

                                <p class="text-sm text-red font-medium">

                                    <i class="fas fa-lock mr-1"></i>

                                    This poll has been closed

                                </p>

                            @elseif($isExpired)

                                <p class="text-sm text-red font-medium">

                                    <i class="fas fa-clock mr-1"></i>

                                    Poll voting time has expired

                                </p>

                            @endif

                        </div>

                        <!-- Results -->
                        <div class="space-y-4">

                            @foreach($poll->options as $option)

                                @php

                                    $optionVotes = $option->votes->count();

                                    $percentage =
                                        $totalVotes > 0
                                            ? round(($optionVotes / $totalVotes) * 100)
                                            : 0;

                                    $isSelected =
                                        $userVote &&
                                        $userVote->poll_option_id == $option->id;

                                @endphp

                                <div>

                                    <div
                                        class="flex items-center justify-between mb-2">

                                        <div class="flex items-center gap-2">

                                            <span
                                                class="text-sm font-medium text-prim">

                                                {{ $option->option_text }}

                                            </span>

                                            @if($isSelected)

                                                <span
                                                    class="text-[10px] bg-grn/10 text-grn border border-grn/20 px-2 py-1 rounded-full">

                                                    Your Vote

                                                </span>

                                            @endif

                                        </div>

                                        <span
                                            class="text-xs font-semibold text-sec">

                                            {{ $percentage }}%

                                        </span>

                                    </div>

                                    <!-- Progress -->
                                    <div
                                        class="w-full h-3 bg-input rounded-full overflow-hidden border border-bdr">

                                        <div
                                            class="{{ $isSelected ? 'bg-grn' : 'bg-accent' }} h-full transition-all duration-500"
                                            style="width: {{ $percentage }}%">

                                        </div>

                                    </div>

                                    <div class="mt-1 text-right">

                                        <span class="text-xs text-sec">
                                            {{ $optionVotes }} votes
                                        </span>

                                    </div>

                                </div>

                            @endforeach

                        </div>

                    @endif

                </div>

                <!-- Footer -->
                <div
                    class="flex items-center justify-between mt-6 pt-5 border-t border-bdr">

                    <div class="text-xs text-sec space-y-1">

                        <div>
                            Created :
                            <span class="text-prim font-medium">
                                {{ $poll->created_at->format('d M Y') }}
                            </span>
                        </div>

                        <div>
                            Expire :
                            <span class="text-prim font-medium">

                                @if($poll->expire_at)

                                    {{ \Carbon\Carbon::parse($poll->expire_at)->format('d M Y h:i A') }}

                                @else

                                    No Expiry

                                @endif

                            </span>
                        </div>

                    </div>

                    <div
                        class="inline-flex items-center gap-2 bg-input border border-bdr text-sec text-xs px-4 py-2 rounded-xl">

                        <i class="fas fa-users"></i>

                        {{ $totalVotes }} Votes

                    </div>

                </div>

            </div>

        @empty

            <!-- Empty State -->
            <div
                class="col-span-full bg-card border border-bdr rounded-3xl p-10 text-center">

                <div
                    class="w-20 h-20 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center text-sec text-3xl">

                    <i class="fas fa-chart-pie"></i>

                </div>

                <h3 class="text-xl font-semibold text-prim mt-5">
                    No Polls Available
                </h3>

                <p class="text-sec text-sm mt-2">
                    There are currently no active polls available.
                </p>

            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">

        {{ $polls->links() }}

    </div>

</main>

@endsection
