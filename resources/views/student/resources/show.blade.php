@extends('layouts.student.student-layout')

@section('title', 'Resource Details')

@section('content')

    <main id="main-content" class="p-4 md:p-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6 fade-up">

            <div>

                <div
                    class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                    Resource Details

                </div>

                <h1 class="text-2xl md:text-3xl font-bold text-white mt-2">
                    {{ $resource->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-3 mt-4">

                    <!-- Subject -->
                    <div
                        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-input border border-border text-sm text-gray-300">

                        <i class="fa-solid fa-book text-accent text-xs"></i>

                        <span class="text-gray-400">Subject:</span>

                        <span class="text-white font-medium">
                            {{ $resource->subject->name ?? 'N/A' }}
                        </span>

                    </div>

                    <!-- Category -->
                    <div
                        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-accent/10 border border-accent/20 text-sm text-accent capitalize">

                        <i class="fa-solid fa-layer-group text-xs"></i>

                        {{ str_replace('_', ' ', $resource->category) }}

                    </div>

                    <!-- Total Files -->
                    <div
                        class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-input border border-border text-sm text-gray-300">

                        <i class="fa-solid fa-file text-accent text-xs"></i>

                        <span class="text-gray-400">Files:</span>

                        <span class="text-white font-medium">
                            {{ $resource->files->count() }}
                        </span>

                    </div>

                </div>

            </div>

            <a href="{{ route('student.resources') }}"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-input hover:bg-hover border border-border text-white text-sm transition">

                <i class="fas fa-arrow-left"></i>
                Back
            </a>

        </div>

        <!-- Files -->
        <div class="bg-card border border-border rounded-2xl overflow-hidden fade-up">

            <div class="p-5 border-b border-border">

                <h2 class="text-lg font-semibold text-white">
                    Resource Files
                </h2>

            </div>

            <div class="divide-y divide-border">

                @forelse ($resource->files as $file)
                    <div
                        class="p-5 flex flex-col md:flex-row md:items-center md:justify-between gap-4 hover:bg-hover transition">

                        <div class="flex items-center gap-4">

                            <div
                                class="w-12 h-12 rounded-xl bg-accent/10 text-accent flex items-center justify-center text-lg">
                                <i class="fas fa-file-alt"></i>
                            </div>

                            <div>

                                <h3 class="text-white font-medium break-all">
                                    {{ $file->original_name }}
                                </h3>

                                <p class="text-sm text-gray-500 mt-1">
                                    Uploaded {{ $file->created_at->diffForHumans() }}
                                </p>

                            </div>

                        </div>

                        <a href="{{ route('student.resources.download', $file->id) }}"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl bg-accent hover:bg-accentH text-white text-sm font-medium transition">

                            <i class="fas fa-download"></i>
                            Download
                        </a>

                    </div>

                @empty

                    <div class="p-10 text-center">

                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-accent/10 flex items-center justify-center text-accent text-3xl mb-4">
                            <i class="fas fa-folder-open"></i>
                        </div>

                        <h2 class="text-xl font-semibold text-white">
                            No Files Available
                        </h2>

                        <p class="text-gray-400 mt-2">
                            Files have not been uploaded yet.
                        </p>

                    </div>
                @endforelse

            </div>

        </div>

    </main>

@endsection
