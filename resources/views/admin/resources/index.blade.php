@extends('layouts.admin.admin-layout')
@section('title', 'Resources')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Resources
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Resource List
                </h1>

                <p class="text-ts text-sm">
                    Manage all academic resources
                </p>

            </div>

        </div>

        <!-- Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl text-sm">

                    {{ session('success') }}

                </div>
            @endif

            <!-- Top -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Resources
                </h2>

                <a href="{{ route('resources.create') }}" class="btn-primary text-xs px-4 py-2">

                    <i class="fas fa-plus mr-1"></i>
                    Add Resource

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
                            <th class="py-3 text-left">Category</th>
                            <th class="py-3 text-left">Files</th>
                            <th class="py-3 text-left">Status</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($resources as $resource)

                            <!-- Desktop -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $resource->id }}
                                </td>

                                <td class="py-3 font-medium">
                                    {{ $resource->title }}
                                </td>

                                <td class="py-3 text-ts">
                                    {{ $resource->subject->name ?? '-' }}
                                </td>

                                <td class="py-3">

                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border capitalize">

                                        {{ str_replace('_', ' ', $resource->category) }}

                                    </span>

                                </td>

                                <!-- Files -->
                                <td class="py-3">

                                    @if ($resource->files->count())
                                        <div class="flex flex-col gap-1">

                                            @foreach ($resource->files as $file)
                                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                                    class="text-xs text-accent hover:underline">

                                                    {{ $file->original_name }}

                                                </a>
                                            @endforeach

                                        </div>
                                    @else
                                        <span class="text-ts text-xs">
                                            No File
                                        </span>
                                    @endif

                                </td>

                                <!-- Status -->
                                <td class="py-3">

                                    @if ($resource->is_published)
                                        <span class="text-green-400 text-xs">
                                            Published
                                        </span>
                                    @else
                                        <span class="text-red-400 text-xs">
                                            Draft
                                        </span>
                                    @endif

                                </td>

                                <!-- Action -->
                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('resources.edit', $resource->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit

                                    </a>

                                    <form action="{{ route('resources.destroy', $resource->id) }}" method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure?')"
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
                                                {{ $resource->title }}
                                            </h3>

                                            <p class="text-xs text-ts">
                                                {{ $resource->subject->name ?? '-' }}
                                            </p>

                                        </div>

                                        <div>

                                            <span
                                                class="text-[10px] px-2 py-1 bg-input border border-border rounded-lg capitalize">

                                                {{ str_replace('_', ' ', $resource->category) }}

                                            </span>

                                        </div>

                                        <!-- Files -->
                                        <div class="flex flex-col gap-1">

                                            @foreach ($resource->files as $file)
                                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                                    class="text-xs text-accent hover:underline">

                                                    {{ $file->original_name }}

                                                </a>
                                            @endforeach

                                        </div>

                                        <div class="flex justify-between items-center">

                                            @if ($resource->is_published)
                                                <span class="text-green-400 text-xs">
                                                    Published
                                                </span>
                                            @else
                                                <span class="text-red-400 text-xs">
                                                    Draft
                                                </span>
                                            @endif

                                            <div class="space-x-2">

                                                <a href="{{ route('resources.edit', $resource->id) }}"
                                                    class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                    Edit

                                                </a>

                                                <form action="{{ route('resources.destroy', $resource->id) }}"
                                                    method="POST" class="inline">

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

                                <td colspan="7" class="py-6 text-center text-ts">

                                    No resources found

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
