@extends('layouts.admin.admin-layout')
@section('title', 'Assignments')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Assignments
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Assignment List
                </h1>

                <p class="text-ts text-sm">
                    Manage all assignments
                </p>

            </div>

        </div>

        <!-- Table -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Assignments
                </h2>

                <a href="{{ route('assignments.create') }}"
                    class="btn-primary text-xs px-4 py-2">

                    <i class="fas fa-plus mr-1"></i>
                    Add Assignment
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Title</th>
                            <th class="py-3 text-left">Subject</th>
                            <th class="py-3 text-left">Deadline</th>
                            <th class="py-3 text-left">File</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($assignments as $assignment)

                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $assignment->id }}
                                </td>

                                <td class="py-3 font-medium">
                                    {{ $assignment->title }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ $assignment->subject->name ?? '-' }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ $assignment->deadline ?? '-' }}
                                </td>

                                <td class="py-3">

                                    @if($assignment->file)

                                        <a href="{{ asset('uploads/assignments/' . $assignment->file) }}"
                                            target="_blank"
                                            class="text-accent text-xs">

                                            View File
                                        </a>

                                    @else

                                        <span class="text-ts text-xs">
                                            No File
                                        </span>

                                    @endif

                                </td>

                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('assignments.edit', $assignment->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit
                                    </a>

                                    <form action="{{ route('assignments.destroy', $assignment->id) }}"
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

                                    No assignments found
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
