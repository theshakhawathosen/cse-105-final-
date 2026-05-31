@extends('layouts.student.student-layout')
@section('title', 'Subjects')
@section('content')

<main class="pt-5 px-4 md:px-5 pb-8 mx-5" role="main">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

        <div>
            <h1 class="text-[1.15rem] md:text-[1.35rem] font-bold text-prim">
                <i class="fa-solid fa-book-open text-accent mr-2"></i>
                Subjects List
            </h1>

            <p class="text-[0.78rem] text-sec mt-1">
                All semester subjects with teacher & credits
            </p>
        </div>

    </div>

    <!-- Desktop Table -->
    <div class="hidden md:block bg-card border border-bdr rounded-2xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-input border-b border-bdr">

                <tr>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        #
                    </th>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        Subject
                    </th>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        Code
                    </th>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        Credit
                    </th>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        Type
                    </th>

                    <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                        Teacher
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse ($subjects as $subject)

                    <tr class="border-b border-bdr hover:bg-white/[0.02] transition-all">

                        <td class="px-5 py-4 text-[0.78rem] text-sec">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-5 py-4">

                            <h3 class="text-[0.82rem] font-semibold text-prim">
                                {{ $subject->name }}
                            </h3>

                        </td>

                        <td class="px-5 py-4 text-[0.78rem] text-sec">
                            {{ $subject->code ?? 'N/A' }}
                        </td>

                        <td class="px-5 py-4">

                            <span
                                class="px-2 py-1 rounded-lg text-[10px] font-medium bg-green-500/10 text-green-500 border border-green-500/20">

                                {{ $subject->credit ?? '0.0' }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            @if ($subject->type == 'theory')

                                <span
                                    class="px-2 py-1 rounded-lg text-[10px] font-medium bg-blue-500/10 text-blue-500 border border-blue-500/20">
                                    Theory
                                </span>

                            @elseif($subject->type == 'lab')

                                <span
                                    class="px-2 py-1 rounded-lg text-[10px] font-medium bg-purple-500/10 text-purple-500 border border-purple-500/20">
                                    Lab
                                </span>

                            @endif

                        </td>

                        <td class="px-5 py-4">

                            @if ($subject->teacher)

                                <div class="flex items-center gap-3">

                                    @if ($subject->teacher->photo)

                                        <img
                                            src="{{ asset('storage/' . $subject->teacher->photo) }}"
                                            alt="{{ $subject->teacher->name }}"
                                            class="w-10 h-10 rounded-xl object-cover border border-bdr">

                                    @else

                                        <div
                                            class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center border border-bdr">

                                            <i class="fa-solid fa-user text-accent text-xs"></i>

                                        </div>

                                    @endif

                                    <div>

                                        <h4 class="text-[0.78rem] font-medium text-prim">
                                            {{ $subject->teacher->name }}
                                        </h4>

                                        @if ($subject->teacher->designation)

                                            <p class="text-[0.65rem] text-sec mt-[2px]">
                                                {{ $subject->teacher->designation }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            @else

                                <span class="text-[0.75rem] text-red-400">
                                    No Teacher
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="px-5 py-16 text-center">

                            <i class="fa-solid fa-book-open text-4xl text-hint mb-4"></i>

                            <h3 class="text-lg font-semibold text-prim mb-2">
                                No Subjects Found
                            </h3>

                            <p class="text-sec text-sm">
                                No subject available right now.
                            </p>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- Mobile Cards -->
    <div class="md:hidden space-y-4">

        @forelse ($subjects as $subject)

            <div class="bg-card border border-bdr rounded-2xl p-4">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <h3 class="text-sm font-semibold text-prim">
                           #{{ $loop->iteration }} {{ $subject->name }}
                        </h3>

                        <p class="text-xs text-sec mt-1">
                            {{ $subject->code ?? 'N/A' }}
                        </p>

                    </div>

                    <span
                        class="px-2 py-1 min-w-[70px] text-center rounded-lg text-[10px] font-medium bg-green-500/10 text-green-500 border border-green-500/20">

                        {{ $subject->credit ?? '0.0' }} Credit

                    </span>

                </div>

                <div class="mt-3">

                    @if ($subject->type == 'theory')

                        <span
                            class="px-2 py-1 rounded-lg text-[10px] font-medium bg-blue-500/10 text-blue-500 border border-blue-500/20">
                            Theory
                        </span>

                    @elseif($subject->type == 'lab')

                        <span
                            class="px-2 py-1 rounded-lg text-[10px] font-medium bg-purple-500/10 text-purple-500 border border-purple-500/20">
                            Lab
                        </span>

                    @endif

                </div>

                <div class="mt-4 pt-4 border-t border-bdr">

                    @if ($subject->teacher)

                        <div class="flex items-center gap-3">

                            @if ($subject->teacher->photo)

                                <img
                                    src="{{ asset('storage/' . $subject->teacher->photo) }}"
                                    alt="{{ $subject->teacher->name }}"
                                    class="w-11 h-11 rounded-xl object-cover border border-bdr">

                            @else

                                <div
                                    class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center border border-bdr">

                                    <i class="fa-solid fa-user text-accent text-sm"></i>

                                </div>

                            @endif

                            <div>

                                <h4 class="text-sm font-medium text-prim">
                                    {{ $subject->teacher->name }}
                                </h4>

                                @if ($subject->teacher->designation)

                                    <p class="text-xs text-sec mt-1">
                                        {{ $subject->teacher->designation }}
                                    </p>

                                @endif

                            </div>

                        </div>

                    @else

                        <span class="text-xs text-red-400">
                            No Teacher Assigned
                        </span>

                    @endif

                </div>

            </div>

        @empty

            <div class="bg-card border border-bdr rounded-2xl py-16 text-center">

                <i class="fa-solid fa-book-open text-4xl text-hint mb-4"></i>

                <h3 class="text-lg font-semibold text-prim mb-2">
                    No Subjects Found
                </h3>

                <p class="text-sec text-sm">
                    No subject available right now.
                </p>

            </div>

        @endforelse

    </div>

</main>

@endsection
