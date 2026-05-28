@extends('layouts.admin.admin-layout')
@section('title', 'Exams')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Exams
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Exam List
                </h1>

                <p class="text-ts text-sm">
                    Manage all exams
                </p>
            </div>
        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Exams
                </h2>
                <div>
                    <a href="{{ route('exams.create') }}" class="btn-primary text-xs px-4 py-2">

                        <i class="fas fa-plus mr-1"></i>
                        Add Exam

                    </a>
                </div>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Exam Type</th>
                            <th class="py-3 text-left">Exam Name</th>
                            <th class="py-3 text-left">Date</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($exams as $exam)
                            <!-- DESKTOP -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $loop->iteration }}
                                </td>

                                <td class="py-3">

                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">

                                        {{ $exam->exam_type }}

                                    </span>

                                </td>
                                <td class="py-3">

                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">

                                        {{ $exam->exam_name }}

                                    </span>

                                </td>


                                <td class="py-3 text-ts">
                                    {{ \Carbon\Carbon::parse($exam->date)->format('d M, Y') }}
                                </td>

                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('exams.edit', $exam->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit

                                    </a>

                                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST" class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            <!-- MOBILE CARD -->
                            <tr class="md:hidden">

                                <td colspan="5" class="py-3">

                                    <div class="dash-card p-4 space-y-3">

                                        <div class="flex items-center justify-between">

                                            <div>

                                                <div class="font-semibold text-tp">
                                                    {{ $exam->subject->name ?? '-' }}
                                                </div>

                                                <div class="text-xs text-ts">
                                                    {{ \Carbon\Carbon::parse($exam->date)->format('d M, Y') }}
                                                </div>

                                            </div>

                                            <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">

                                                {{ $exam->exam_type }}

                                            </span>

                                        </div>

                                        <div class="flex justify-end gap-2 pt-2">

                                            <a href="{{ route('exams.edit', $exam->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                Edit

                                            </a>

                                            <form action="{{ route('exams.destroy', $exam->id) }}" method="POST"
                                                class="inline">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" onclick="return confirm('Are you sure?')"
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

                                <td colspan="5" class="py-6 text-center text-ts">

                                    No exams found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>
@endsection
