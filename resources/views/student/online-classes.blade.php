@extends('layouts.student.student-layout')

@section('title', 'Online Classes')

@section('content')

    <main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

            <div>

                <div
                    class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">
                    <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>
                    Live Classes
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                    Online Classes
                </h1>

                <p class="text-sec text-sm mt-1">
                    Join your scheduled live classes
                </p>

            </div>

        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            @forelse($classes as $class)
                @php
                    $classDateTime = \Carbon\Carbon::parse($class->date . ' ' . $class->time);

                    if ($classDateTime->isToday()) {
                        $status = 'today';
                    } elseif ($classDateTime->isFuture()) {
                        $status = 'scheduled';
                    } else {
                        $status = 'expired';
                    }
                @endphp

                <div
                    class="bg-card border border-bdr rounded-3xl p-5 hover:border-accent/50 hover:-translate-y-1 transition-all duration-300 shadow-lg animate-fadeUp">

                    <!-- Top -->
                    <div class="flex items-start justify-between">

                        <div>
                            <span class="text-xs px-3 py-1 rounded-full bg-input border border-bdr text-sec">
                                {{ strtoupper($class->platform) }}
                            </span>

                            <h2 class="text-lg font-semibold text-prim mt-3">
                                {{ $class->subject->name ?? 'No Subject' }}
                            </h2>
                        </div>

                        <div
                            class="w-11 h-11 rounded-2xl bg-accent/10 text-accent flex items-center justify-center border border-accent/20">
                            <i class="fas fa-video"></i>
                        </div>

                    </div>

                    <!-- Info -->
                    <div class="mt-5 space-y-2 text-sm text-sec">

                        <div>
                            📅 Date:
                            <span class="text-prim font-medium">
                                {{ \Carbon\Carbon::parse($class->date)->format('d M Y') }}
                            </span>
                        </div>

                        <div>
                            ⏰ Time:
                            <span class="text-prim font-medium">
                                {{ \Carbon\Carbon::parse($class->time)->format('h:i A') }}
                            </span>
                        </div>

                    </div>

                    <!-- Status -->
<!-- Status -->
<div class="mt-4">

    @if($status == 'today')

        <span class="inline-flex items-center gap-2 bg-grn/10 text-grn border border-grn/20 px-3 py-1 rounded-full text-xs">

            <span class="w-2 h-2 rounded-full bg-grn animate-pulse"></span>

            Today Class

        </span>

    @elseif($status == 'scheduled')

        <span class="inline-flex items-center gap-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 px-3 py-1 rounded-full text-xs">

            <i class="fas fa-calendar-alt"></i>

            Scheduled

        </span>

    @else

        <span class="inline-flex items-center gap-2 bg-red/10 text-red border border-red/20 px-3 py-1 rounded-full text-xs">

            <i class="fas fa-times-circle"></i>

            Expired

        </span>

    @endif

</div>

                    <!-- Join Button -->
<!-- Join Button -->
<div class="mt-5">

    @if($status == 'today')

        <a href="{{ route('student.online-class.join', $class->id) }}"
           target="_blank"
           class="w-full inline-flex items-center justify-center gap-2 bg-accent hover:bg-ahover text-white text-sm font-medium px-5 py-3 rounded-2xl transition">

            <i class="fas fa-video"></i>

            Join Class

        </a>

    @elseif($status == 'scheduled')

        <button disabled
                class="w-full bg-input border border-bdr text-sec text-sm px-5 py-3 rounded-2xl cursor-not-allowed">

            <i class="fas fa-clock mr-2"></i>

            Not Available Yet

        </button>

    @else

        <button disabled
                class="w-full bg-red/10 border border-red/20 text-red text-sm px-5 py-3 rounded-2xl cursor-not-allowed">

            <i class="fas fa-ban mr-2"></i>

            Class Ended

        </button>

    @endif

</div>

                </div>

            @empty

                <div class="col-span-full bg-card border border-bdr rounded-3xl p-10 text-center">
                    <i class="fas fa-video text-3xl text-sec"></i>
                    <h3 class="text-xl font-semibold text-prim mt-4">
                        No Classes Found
                    </h3>
                </div>
            @endforelse

        </div>

    </main>

@endsection
