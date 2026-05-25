@extends('layouts.admin.admin-layout')
@section('title', 'Feedbacks')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">

                <i class="fas fa-circle text-[6px] pulse-anim"></i>

                Feedbacks

            </span>

            <h1 class="text-xl font-bold text-tp mt-4">

                Feedback List

            </h1>

            <p class="text-ts text-sm">

                Manage all feedback submissions

            </p>

        </div>

    </div>

    <!-- Table Card -->
    <div class="dash-card p-5 fade-up fade-up-d2">

        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>

                    <tr class="text-ts border-b border-border">

                        <th class="py-3 text-left">
                            ID
                        </th>

                        <th class="py-3 text-left">
                            Title
                        </th>

                        <th class="py-3 text-left">
                            User
                        </th>

                        <th class="py-3 text-left">
                            File
                        </th>

                        <th class="py-3 text-left">
                            Date
                        </th>

                        <th class="py-3 text-right">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="text-tp">

                    @forelse($feedbacks as $feedback)

                        <!-- Desktop -->
                        <tr
                            class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                            <!-- ID -->
                            <td class="py-3">

                                #{{ $feedback->id }}

                            </td>

                            <!-- Title -->
                            <td class="py-3 font-medium">

                                {{ $feedback->title }}

                            </td>

                            <!-- User -->
                            <td class="py-3 text-ts">

                                {{ $feedback->user->name ?? 'Unknown' }}

                            </td>

                            <!-- File -->
                            <td class="py-3 text-ts">

                                @if($feedback->file)

                                    <span
                                        class="text-green-400">

                                        Attached

                                    </span>

                                @else

                                    No File

                                @endif

                            </td>

                            <!-- Date -->
                            <td class="py-3 text-ts">

                                {{ $feedback->created_at->format('d M Y') }}

                            </td>

                            <!-- Action -->
                            <td
                                class="py-3 text-right space-x-2">

                                <!-- View -->
                                <a href="{{ route('feedbacks.show', $feedback->id) }}"
                                    class="text-xs px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 hover:bg-blue-500/20">

                                    View

                                </a>

                                <!-- Delete -->
                                <form
                                    action="{{ route('feedbacks.destroy', $feedback->id) }}"
                                    method="POST"
                                    class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure?')"
                                        class="text-xs px-3 py-1 rounded-lg bg-red/80 text-white border border-red/20 hover:bg-red/50">

                                        Delete

                                    </button>

                                </form>

                            </td>

                        </tr>

                        <!-- Mobile -->
                        <tr class="md:hidden">

                            <td colspan="6"
                                class="py-3">

                                <div
                                    class="dash-card p-4 space-y-3">

                                    <!-- Top -->
                                    <div>

                                        <h3
                                            class="font-semibold text-tp">

                                            {{ $feedback->title }}

                                        </h3>

                                        <p
                                            class="text-xs text-ts mt-1">

                                            By:
                                            {{ $feedback->user->name ?? 'Unknown' }}

                                        </p>

                                        <p
                                            class="text-xs text-ts mt-1">

                                            {{ $feedback->created_at->format('d M Y') }}

                                        </p>

                                    </div>

                                    <!-- File -->
                                    <div>

                                        @if($feedback->file)

                                            <span
                                                class="text-xs text-green-400">

                                                File Attached

                                            </span>

                                        @else

                                            <span
                                                class="text-xs text-ts">

                                                No File

                                            </span>

                                        @endif

                                    </div>

                                    <!-- Actions -->
                                    <div
                                        class="flex justify-between items-center">

                                        <div
                                            class="space-x-2">

                                            <!-- View -->
                                            <a href="{{ route('feedbacks.show', $feedback->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20">

                                                View

                                            </a>

                                            <!-- Delete -->
                                            <form
                                                action="{{ route('feedbacks.destroy', $feedback->id) }}"
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

                            <td colspan="6"
                                class="py-6 text-center text-ts">

                                No feedback found

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <!-- Pagination -->
        <div class="mt-5">

            {{ $feedbacks->links() }}

        </div>

    </div>

</main>

@endsection
