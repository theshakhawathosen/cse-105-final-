@extends('layouts.admin.admin-layout')
@section('title', 'Links')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Links
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Link List
                </h1>

                <p class="text-ts text-sm">
                    Manage all important links
                </p>

            </div>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <h2 class="text-tp font-semibold text-sm">
                    All Links
                </h2>

                <a href="{{ route('links.create') }}"
                    class="btn-primary text-xs px-4 py-2">

                    <i class="fas fa-plus mr-1"></i>
                    Add Link
                </a>

            </div>

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Title</th>
                            <th class="py-3 text-left">Type</th>
                            <th class="py-3 text-left">URL</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($links as $link)

                            <!-- Desktop -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">
                                    #{{ $link->id }}
                                </td>

                                <td class="py-3 font-medium">
                                    {{ $link->title }}
                                </td>

                                <td class="py-3">
                                    <span
                                        class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border capitalize">

                                        {{ $link->type }}
                                    </span>
                                </td>

                                <td class="py-3">

                                    <a href="{{ $link->url }}"
                                        target="_blank"
                                        class="text-accent text-xs break-all">

                                        Open Link
                                    </a>

                                </td>

                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('links.edit', $link->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit
                                    </a>

                                    <form action="{{ route('links.destroy', $link->id) }}"
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

                                <td colspan="5" class="py-3">

                                    <div class="dash-card p-4 space-y-3">

                                        <div>

                                            <h3 class="font-semibold text-tp">
                                                {{ $link->title }}
                                            </h3>

                                            <p class="text-xs text-ts capitalize">
                                                {{ $link->type }}
                                            </p>

                                        </div>

                                        <div>

                                            <a href="{{ $link->url }}"
                                                target="_blank"
                                                class="text-xs text-accent break-all">

                                                Open Link
                                            </a>

                                        </div>

                                        <div class="flex justify-end gap-2">

                                            <a href="{{ route('links.edit', $link->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                                Edit
                                            </a>

                                            <form action="{{ route('links.destroy', $link->id) }}"
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

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="py-6 text-center text-ts">

                                    No links found
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
