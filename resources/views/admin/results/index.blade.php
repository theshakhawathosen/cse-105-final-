@extends('layouts.admin.admin-layout')
@section('title', 'Results')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Results
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Result List
                </h1>

                <p class="text-ts text-sm">
                    Manage all student results
                </p>
            </div>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Results
                </h2>

                <div class="flex items-center gap-2">

                    <a href="{{ route('results.bulk.create') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        <i class="fas fa-layer-group mr-1"></i>
                        Bulk Create

                    </a>

                    <a href="{{ route('results.create') }}"
                        class="btn-primary text-xs px-4 py-2">

                        <i class="fas fa-plus mr-1"></i>
                        Add Result

                    </a>

                </div>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Student</th>
                            <th class="py-3 text-left">Exam Name</th>
                            <th class="py-3 text-left">Exam</th>
                            <th class="py-3 text-left">Subject</th>
                            <th class="py-3 text-left">Marks</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($results as $result)

                            <!-- Desktop -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $result->id }}
                                </td>

                                <td class="py-3 font-medium">
                                    {{ $result->user->name ?? '-' }}
                                </td>
                                <td class="py-3">
                                    {{ $result->exam->exam_name ?? '-' }}
                                </td>

                                <td class="py-3">
                                    {{ $result->exam->exam_type ?? '-' }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ $result->exam->subject->name ?? '-' }}
                                </td>

                                <td class="py-3">

                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">
                                        {{ $result->marks }}
                                    </span>

                                </td>

                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('results.edit', $result->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit

                                    </a>

                                    <form action="{{ route('results.destroy', $result->id) }}"
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

                        @empty

                            <tr>

                                <td colspan="6"
                                    class="py-6 text-center text-ts">

                                    No results found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>
@endsection
