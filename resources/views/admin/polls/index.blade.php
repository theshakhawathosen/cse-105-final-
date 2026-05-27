@extends('layouts.admin.admin-layout')

@section('title', 'Polls')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-7 fade-up">

        <div>

            <span
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-card border border-border text-xs text-ts">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                Poll Management

            </span>

            <h1 class="text-2xl font-bold text-tp mt-4">
                Poll List
            </h1>

            <p class="text-ts text-sm mt-1">
                Manage all polls from one place
            </p>

        </div>

        <a href="{{ route('polls.create') }}"
            class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-accent hover:bg-accentH text-white text-sm font-medium transition-all duration-300 shadow-lg shadow-accent/20">

            <i class="fas fa-plus"></i>
            Add Poll

        </a>

    </div>

    <!-- Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        @forelse($polls as $poll)

            @php

                $isExpired = $poll->expire_at && now()->gt($poll->expire_at);

                $winner = null;

                if($isExpired) {

                    $winner = $poll->options
                        ->sortByDesc(function($option) {

                            return $option->votes->count();
                        })
                        ->first();
                }

            @endphp

            <!-- Card -->
            <div
                class="group relative overflow-hidden rounded-3xl border border-border bg-card hover:border-accent/40 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl hover:shadow-accent/5">

                <!-- Glow -->
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 bg-gradient-to-br from-accent/5 via-transparent to-purple/5">
                </div>

                <div class="relative p-5 flex flex-col h-full">

                    <!-- Top -->
                    <div class="flex items-start justify-between gap-3 mb-5">

                        <div>

                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-input border border-border text-[11px] text-ts">

                                Poll #{{ $poll->id }}

                            </span>

                        </div>

                        <!-- Status -->
                        @if($poll->status == 'active')

                            <span
                                class="px-3 py-1 rounded-full bg-green/10 text-green border border-green/20 text-[11px] capitalize">

                                Active

                            </span>

                        @elseif($poll->status == 'closed')

                            <span
                                class="px-3 py-1 rounded-full bg-red/10 text-red border border-red/20 text-[11px] capitalize">

                                Closed

                            </span>

                        @else

                            <span
                                class="px-3 py-1 rounded-full bg-amber/10 text-amber border border-amber/20 text-[11px] capitalize">

                                {{ $poll->status }}

                            </span>

                        @endif

                    </div>

                    <!-- Question -->
                    <h2 class="text-lg font-semibold text-tp leading-relaxed mb-5 line-clamp-2">

                        {{ $poll->question }}

                    </h2>

                    <!-- Tags -->
                    <div class="flex flex-wrap gap-2 mb-5">

                        @if($poll->is_published)

                            <span
                                class="px-3 py-1 rounded-full bg-teal/10 text-teal border border-teal/20 text-[11px]">

                                Published

                            </span>

                        @else

                            <span
                                class="px-3 py-1 rounded-full bg-amber/10 text-amber border border-amber/20 text-[11px]">

                                Draft

                            </span>

                        @endif

                        @if($isExpired)

                            <span
                                class="px-3 py-1 rounded-full bg-red/10 text-red border border-red/20 text-[11px]">

                                Expired

                            </span>

                        @else

                            <span
                                class="px-3 py-1 rounded-full bg-accent/10 text-accent border border-accent/20 text-[11px]">

                                Running

                            </span>

                        @endif

                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-3 mb-5">

                        <!-- Options -->
                        <div
                            class="rounded-2xl bg-input border border-border p-4">

                            <div class="flex items-center justify-between mb-2">

                                <span class="text-ts text-xs">
                                    Options
                                </span>

                                <i class="fas fa-list text-accent text-xs"></i>

                            </div>

                            <h3 class="text-xl font-bold text-tp">

                                {{ $poll->options->count() }}

                            </h3>

                        </div>

                        <!-- Votes -->
                        <div
                            class="rounded-2xl bg-input border border-border p-4">

                            <div class="flex items-center justify-between mb-2">

                                <span class="text-ts text-xs">
                                    Votes
                                </span>

                                <i class="fas fa-vote-yea text-green text-xs"></i>

                            </div>

                            <h3 class="text-xl font-bold text-tp">

                                {{ $poll->votes->count() }}

                            </h3>

                        </div>

                    </div>

                    <!-- Expire -->
                    <div
                        class="rounded-2xl bg-input border border-border p-4 mb-5">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs text-ts mb-1">
                                    Expire Date
                                </p>

                                <h4 class="text-sm font-medium text-tp">

                                    @if($poll->expire_at)

                                        {{ \Carbon\Carbon::parse($poll->expire_at)->format('d M Y') }}

                                    @else

                                        No Expire

                                    @endif

                                </h4>

                            </div>

                            @if($poll->expire_at)

                                <span class="text-xs text-ts">

                                    {{ \Carbon\Carbon::parse($poll->expire_at)->format('h:i A') }}

                                </span>
                            @endif

                        </div>

                    </div>

                    <!-- Winner -->
                    @if($isExpired && $winner)

                        <div
                            class="rounded-2xl bg-green/10 border border-green/20 p-4 mb-5">

                            <div class="flex items-center gap-2 mb-2">

                                <i class="fas fa-trophy text-green"></i>

                                <span class="text-xs uppercase tracking-wider text-green font-semibold">

                                    Winner Option

                                </span>

                            </div>

                            <h3 class="text-sm font-semibold text-tp">

                                {{ $winner->option_text }}

                            </h3>

                            <p class="text-xs text-green mt-1">

                                {{ $winner->votes->count() }} Votes

                            </p>

                        </div>

                    @endif

                    <!-- Actions -->
                    <div class="grid grid-cols-3 gap-2 mt-auto">

                        <!-- View -->
                        <a href="{{ route('polls.show', $poll->id) }}"
                            class="flex items-center justify-center gap-2 px-3 py-3 rounded-2xl bg-accent/10 text-accent border border-accent/20 hover:bg-accent hover:text-white transition-all duration-300 text-xs font-medium">

                            <i class="fas fa-eye"></i>

                            <span class="hidden sm:inline">
                                View
                            </span>

                        </a>

                        <!-- Edit -->
                        <a href="{{ route('polls.edit', $poll->id) }}"
                            class="flex items-center justify-center gap-2 px-3 py-3 rounded-2xl bg-input border border-border hover:border-purple hover:text-purple transition-all duration-300 text-xs font-medium text-ts">

                            <i class="fas fa-edit"></i>

                            <span class="hidden sm:inline">
                                Edit
                            </span>

                        </a>

                        <!-- Delete -->
                        <form action="{{ route('polls.destroy', $poll->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                onclick="return confirm('Are you sure?')"
                                class="w-full flex items-center justify-center gap-2 px-3 py-3 rounded-2xl bg-red/10 text-red border border-red/20 hover:bg-red hover:text-white transition-all duration-300 text-xs font-medium">

                                <i class="fas fa-trash"></i>

                                <span class="hidden sm:inline">
                                    Delete
                                </span>

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <!-- Empty -->
            <div class="col-span-full">

                <div
                    class="rounded-3xl border border-border bg-card p-12 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-3xl bg-input border border-border flex items-center justify-center mb-5">

                        <i class="fas fa-poll text-3xl text-accent"></i>

                    </div>

                    <h2 class="text-2xl font-bold text-tp mb-3">

                        No Poll Found

                    </h2>

                    <p class="text-ts text-sm mb-6 max-w-md mx-auto">

                        You have not created any polls yet.
                        Start by creating your first poll.

                    </p>

                    <a href="{{ route('polls.create') }}"
                        class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-accent hover:bg-accentH text-white text-sm font-medium transition-all duration-300 shadow-lg shadow-accent/20">

                        <i class="fas fa-plus"></i>
                        Create Poll

                    </a>

                </div>

            </div>

        @endforelse

    </div>

</main>

@endsection
