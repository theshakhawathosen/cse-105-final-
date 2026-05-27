@extends('layouts.student.student-layout')

@section('title', 'Links')

@section('content')

<main id="main-content" class="p-4 md:p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 fade-up">

        <div>

              <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                Important Links

            </div>

            <h1 class="text-2xl font-bold text-tp mt-3">
                Useful Links
            </h1>

            <p class="text-ts text-sm mt-1">
                Access all important classroom and group links
            </p>

        </div>

    </div>

    <!-- Links Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 fade-up fade-up-d2">

        @forelse($links as $link)

            <div
                class="dash-card p-5 rounded-2xl border border-border hover:border-accent/40 transition duration-300">

                <!-- Top -->
                <div class="flex items-start justify-between gap-3">

                    <div>

                        <h2 class="text-white font-semibold text-tp">
                            {{ $link->title }}
                        </h2>

                        <p
                            class="text-xs text-ts mt-1 capitalize">

                            {{ $link->type }}
                        </p>

                    </div>

                    <!-- Icon -->
                    <div
                        class="w-11 h-11 rounded-xl bg-accent/10 flex items-center justify-center text-accent">

                        @if($link->type == 'google classroom')

                            <i class="fab fa-google text-sm"></i>

                        @else

                            <i class="fas fa-users text-sm"></i>

                        @endif

                    </div>

                </div>

                <!-- Divider -->
                <div class="border-t border-border my-4"></div>

                <!-- Button -->
                <a href="{{ $link->url }}"
                    target="_blank"
                    class="bg-green-500 text-white rounded-full w-full text-center text-xs py-2.5 flex items-center justify-center gap-2">

                    <i class="fas fa-arrow-up-right-from-square"></i>

                    Open Link
                </a>

            </div>

        @empty

            <div class="col-span-full">

                <div class="dash-card p-10 text-center">

                    <div
                        class="w-16 h-16 mx-auto rounded-2xl bg-input border border-border flex items-center justify-center text-ts">

                        <i class="fas fa-link text-2xl"></i>

                    </div>

                    <h2 class="text-lg font-semibold text-tp mt-4">
                        No Links Found
                    </h2>

                    <p class="text-ts text-sm mt-1">
                        Important links will appear here
                    </p>

                </div>

            </div>

        @endforelse

    </div>

</main>

@endsection
