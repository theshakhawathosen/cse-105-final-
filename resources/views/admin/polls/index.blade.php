@extends('layouts.admin.admin-layout')
@section('title', 'Polls')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">
                <i class="fas fa-circle text-[6px] pulse-anim"></i>
                Polls
            </span>

            <h1 class="text-xl font-bold text-tp mt-4">
                Poll List
            </h1>

            <p class="text-ts text-sm">
                Manage all polls
            </p>

        </div>

    </div>

    <!-- Table Card -->
    <div class="dash-card p-5 fade-up fade-up-d2">

        <!-- Top -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

            <h2 class="text-tp font-semibold text-sm">
                All Polls
            </h2>

            <a href="{{ route('polls.create') }}"
                class="btn-primary text-xs px-4 py-2">

                <i class="fas fa-plus mr-1"></i>
                Add Poll
            </a>

        </div>

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

               <thead class="hidden md:table-header-group">

                    <tr class="text-ts border-b border-border">

                        <th class="py-3 text-left">ID</th>
                        <th class="py-3 text-left">Question</th>
                        <th class="py-3 text-left">Result / Options</th>
                        <th class="py-3 text-left">Votes</th>
                        <th class="py-3 text-left">Status</th>
                        <th class="py-3 text-left">Published</th>
                        <th class="py-3 text-left">Expire</th>
                        <th class="py-3 text-right">Action</th>

                    </tr>

                </thead>

                <tbody class="text-tp">

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

                        <!-- Desktop -->
                        <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                            <td class="py-3">
                                #{{ $poll->id }}
                            </td>

                            <td class="py-3 font-medium">
                                {{ $poll->question }}
                            </td>

                            <!-- Result / Options -->
                            <td class="py-3 text-ts">

                                @if($isExpired && $winner)

                                    <div class="flex flex-col gap-1">

                                        <span class="text-xs  font-medium text-green">
                                            {{ $winner->option_text }}
                                        </span>

                                    </div>

                                @else

                                    {{ $poll->options->count() }} Options

                                @endif

                            </td>

                            <!-- Votes -->
                            <td class="py-3 text-ts">

                                {{ $poll->votes->count() }} Votes

                            </td>

                            <!-- Status -->
                            <td class="py-3">

                                <span
                                    class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border capitalize">

                                    {{ $poll->status }}
                                </span>

                            </td>

                            <!-- Publish -->
                            <td class="py-3">

                                @if($poll->is_published)

                                    <span
                                        class="text-[10px] px-2 py-1 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">

                                        Published
                                    </span>

                                @else

                                    <span
                                        class="text-[10px] px-2 py-1 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">

                                        Draft
                                    </span>

                                @endif

                            </td>

                            <!-- Expire -->
                            <td class="py-3 text-ts">

                                @if($poll->expire_at)

                                    {{ \Carbon\Carbon::parse($poll->expire_at)->format('d M Y h:i A') }}

                                @else

                                    No Expire

                                @endif

                            </td>

                            <!-- Action -->
                            <td class="py-3 text-right space-x-2">

                                <!-- View -->
                                <a href="{{ route('polls.show', $poll->id) }}"
                                    class="text-xs px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 hover:bg-blue-500/20">

                                    View
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('polls.edit', $poll->id) }}"
                                    class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                    Edit
                                </a>

                                <!-- Delete -->
                                <form action="{{ route('polls.destroy', $poll->id) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20">

                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        <!-- Mobile -->
                        <tr class="md:hidden">

                            <td colspan="8" class="py-3">

                                <div class="dash-card p-4 space-y-3">

                                    <!-- Question -->
                                    <div>

                                        <h3 class="font-semibold text-tp">
                                            {{ $poll->question }}
                                        </h3>

                                        @if($isExpired && $winner)

                                            <div class="mt-2 space-y-1">


                                                <p class="text-xs  font-medium text-green">
                                                    {{ $winner->option_text }}

                                                </p>

                                            </div>

                                        @else

                                            <p class="text-xs text-ts mt-1">

                                                {{ $poll->options->count() }} Options
                                                •
                                                {{ $poll->votes->count() }} Votes

                                            </p>

                                        @endif

                                    </div>

                                    <!-- Status -->
                                    <div class="flex flex-wrap gap-2">

                                        <span
                                            class="text-[10px] px-2 py-1 bg-input border border-border rounded-lg capitalize">

                                            {{ $poll->status }}
                                        </span>

                                        @if($poll->is_published)

                                            <span
                                                class="text-[10px] px-2 py-1 rounded-lg bg-green-500/10 text-green-400 border border-green-500/20">

                                                Published
                                            </span>

                                        @else

                                            <span
                                                class="text-[10px] px-2 py-1 rounded-lg bg-yellow-500/10 text-yellow-400 border border-yellow-500/20">

                                                Draft
                                            </span>

                                        @endif

                                    </div>

                                    <!-- Expire -->
                                    <div class="text-xs text-ts">

                                        Expire:
                                        {{ $poll->expire_at ? \Carbon\Carbon::parse($poll->expire_at)->format('d M Y h:i A') : 'No Expire' }}

                                    </div>

                                    <!-- Actions -->
                                    <div class="flex justify-between items-center">

                                        <div class="space-x-2">

                                            <!-- View -->
                                            <a href="{{ route('polls.show', $poll->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20">

                                                View
                                            </a>

                                            <!-- Edit -->
                                            <a href="{{ route('polls.edit', $poll->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                Edit
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('polls.destroy', $poll->id) }}"
                                                method="POST"
                                                class="inline">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">

                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="py-6 text-center text-ts">

                                No polls found
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</main>

@endsection
