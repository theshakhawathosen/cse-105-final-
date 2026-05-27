@extends('layouts.student.student-layout')

@section('title', 'Resources')

@section('content')

<main id="main-content" class="p-4 md:p-6">

    <!-- Header -->
    <div class="mb-6 fade-up">
            <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                Study Resources

            </div>

        <h1 class="text-2xl md:text-3xl font-bold text-white mt-2">
            Resources Collection
        </h1>

        <p class="text-gray-400 mt-2">
            Access notes, slides, books, tutorials and more.
        </p>
    </div>

    <!-- Resource Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

        @forelse ($resources as $resource)

            <div class="bg-card border border-border rounded-2xl p-5 shadow-lg hover:border-accent transition-all duration-300 fade-up">

                <!-- Top -->
                <div class="flex items-start justify-between gap-3">

                    <div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-accent/10 text-accent capitalize mb-3">
                            {{ str_replace('_', ' ', $resource->category) }}
                        </span>

                        <h2 class="text-lg font-semibold text-white leading-snug">
                            {{ $resource->title }}
                        </h2>

                        <p class="text-sm text-gray-400 mt-2">
                            {{ $resource->subject->name ?? 'N/A' }}
                        </p>
                    </div>

                    <div
                        class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center text-accent shrink-0">
                        <i class="fas fa-folder-open"></i>
                    </div>

                </div>

                <!-- Footer -->
                <div class="mt-5 flex items-center justify-between">

                    <div class="text-sm text-gray-500">
                        {{ $resource->files->count() }} Files
                    </div>

                    <a href="{{ route('student.resources.show', $resource->id) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-accent hover:bg-accentH text-white text-sm font-medium transition">

                        View
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>

                </div>

            </div>

        @empty

            <div class="col-span-full">

                <div class="bg-card border border-border rounded-2xl p-10 text-center">

                    <div
                        class="w-20 h-20 mx-auto rounded-full bg-accent/10 flex items-center justify-center text-accent text-3xl mb-4">
                        <i class="fas fa-box-open"></i>
                    </div>

                    <h2 class="text-xl font-semibold text-white">
                        No Resources Found
                    </h2>

                    <p class="text-gray-400 mt-2">
                        Resources will appear here once uploaded.
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</main>

@endsection
