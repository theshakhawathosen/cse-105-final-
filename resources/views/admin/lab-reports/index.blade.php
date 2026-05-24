@extends('layouts.admin.admin-layout')
@section('title', 'Lab Reports')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Lab Reports
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Lab Report List
                </h1>

                <p class="text-ts text-sm">
                    Manage all lab reports
                </p>

            </div>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Lab Reports
                </h2>

                <a href="{{ route('lab-reports.create') }}"
                    class="btn-primary text-xs px-4 py-2">

                    <i class="fas fa-plus mr-1"></i>
                    Add Lab Report
                </a>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Title</th>
                            <th class="py-3 text-left">Subject</th>
                            <th class="py-3 text-left">Deadline</th>
                            <th class="py-3 text-left">Status</th>
                            <th class="py-3 text-left">File</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($labReports as $labReport)

                            <!-- Desktop -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $labReport->id }}
                                </td>

                                <td class="py-3 font-medium">
                                    {{ $labReport->title }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ $labReport->subject->name ?? '-' }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ \Carbon\Carbon::parse($labReport->deadline)->format('d M Y h:i A') }}
                                </td>

                                <td class="py-3">

                                    <span
                                        class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border capitalize">

                                        {{ $labReport->status }}
                                    </span>

                                </td>

                                <td class="py-3">

                                    @if($labReport->file)

                                        <a href="{{ asset('uploads/lab-reports/' . $labReport->file) }}"
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

                                    <a href="{{ route('lab-reports.edit', $labReport->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit
                                    </a>

                                    <form action="{{ route('lab-reports.destroy', $labReport->id) }}"
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

                                <td colspan="7" class="py-3">

                                    <div class="dash-card p-4 space-y-3">

                                        <div>

                                            <h3 class="font-semibold text-tp">
                                                {{ $labReport->title }}
                                            </h3>

                                            <p class="text-xs text-ts">
                                                {{ $labReport->subject->name ?? '-' }}
                                            </p>

                                        </div>

                                        <div class="text-xs text-ts">

                                            Deadline:
                                            {{ \Carbon\Carbon::parse($labReport->deadline)->format('d M Y h:i A') }}

                                        </div>

                                        <div>

                                            <span
                                                class="text-[10px] px-2 py-1 bg-input border border-border rounded-lg capitalize">

                                                {{ $labReport->status }}
                                            </span>

                                        </div>

                                        <div class="flex justify-between items-center">

                                            @if($labReport->file)

                                                <a href="{{ asset('uploads/lab-reports/' . $labReport->file) }}"
                                                    target="_blank"
                                                    class="text-xs text-accent">

                                                    View File
                                                </a>

                                            @else

                                                <span class="text-xs text-ts">
                                                    No File
                                                </span>

                                            @endif

                                            <div class="space-x-2">

                                                <a href="{{ route('lab-reports.edit', $labReport->id) }}"
                                                    class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                    Edit
                                                </a>

                                                <form action="{{ route('lab-reports.destroy', $labReport->id) }}"
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

                                <td colspan="7"
                                    class="py-6 text-center text-ts">

                                    No lab reports found
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
