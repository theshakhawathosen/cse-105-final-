@extends('layouts.admin.admin-layout')
@section('title', 'Online Classes')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Online Classes
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Online Class List
                </h1>

                <p class="text-ts text-sm">
                    Manage all online classes
                </p>
            </div>

            <a href="{{ route('online-classes.create') }}"
                class="btn-primary text-xs px-4 py-2">

                <i class="fas fa-plus mr-1"></i>
                Add Class

            </a>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="border-b border-border text-ts">

                            <th class="py-3 text-left">
                                Subject
                            </th>

                            <th class="py-3 text-left">
                                Platform
                            </th>

                            <th class="py-3 text-left">
                                Date
                            </th>

                            <th class="py-3 text-left">
                                Time
                            </th>

                            <th class="py-3 text-left">
                                Meeting
                            </th>

                            <th class="py-3 text-right">
                                Action
                            </th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($classes as $class)

                            <!-- Desktop -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    {{ $class->subject->name }}
                                </td>

                                <td class="py-3">

                                    <span
                                        class="px-2 py-1 rounded-lg bg-input border border-border text-xs">

                                        {{ $class->platform }}

                                    </span>

                                </td>

                                <td class="py-3">

                                    {{ \Carbon\Carbon::parse($class->date)->format('d M Y') }}

                                </td>

                                <td class="py-3">

                                    {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}

                                </td>

                                <td class="py-3">

                                    @if ($class->meeting_link)

                                        <a href="{{ $class->meeting_link }}"
                                            target="_blank"
                                            class="text-accent hover:underline">

                                            Join

                                        </a>

                                    @else

                                        -

                                    @endif

                                </td>

                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('online-classes.edit', $class->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                        Edit

                                    </a>

                                    <form method="POST"
                                        action="{{ route('online-classes.destroy', $class->id) }}"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Delete this class?')"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            <!-- Mobile Card -->
                            <tr class="md:hidden">

                                <td colspan="6" class="py-3">

                                    <div class="dash-card p-4">

                                        <div class="flex items-center justify-between">

                                            <h3 class="font-semibold text-tp">

                                                {{ $class->subject->name }}

                                            </h3>

                                            <span
                                                class="px-2 py-1 rounded-lg bg-input border border-border text-[10px]">

                                                {{ $class->platform }}

                                            </span>

                                        </div>

                                        <div class="mt-3 text-xs text-ts space-y-2">

                                            <div>
                                                Date :
                                                {{ \Carbon\Carbon::parse($class->date)->format('d M Y') }}
                                            </div>

                                            <div>
                                                Time :
                                                {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
                                            </div>

                                            @if ($class->meeting_link)

                                                <div>

                                                    Link :

                                                    <a href="{{ $class->meeting_link }}"
                                                        target="_blank"
                                                        class="text-accent">

                                                        Join Meeting

                                                    </a>

                                                </div>

                                            @endif

                                        </div>

                                        <div class="flex justify-end gap-2 mt-4">

                                            <a href="{{ route('online-classes.edit', $class->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                Edit

                                            </a>

                                            <form method="POST"
                                                action="{{ route('online-classes.destroy', $class->id) }}">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    onclick="return confirm('Delete this class?')"
                                                    class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">

                                                    Delete

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="py-6 text-center text-ts">

                                    No online classes found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
