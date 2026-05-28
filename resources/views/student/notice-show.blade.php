@extends('layouts.student.student-layout')

@section('title', $notice->title)

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Back -->
    <div class="mb-6 animate-fadeUp">
        <a href="{{ route('student.notice') }}"
           class="inline-flex items-center gap-2 text-sec hover:text-prim text-sm transition-colors duration-200">
            <i class="fas fa-arrow-left text-xs"></i>
            Back to Notices
        </a>
    </div>

    @php
        $isExpired = $notice->expire_at
            ? \Carbon\Carbon::parse($notice->expire_at)->isPast()
            : false;

        $priorityConfig = [
            'urgent' => ['bg' => 'bg-red/10',          'text' => 'text-red',         'border' => 'border-red/20',          'dot' => 'bg-red',         'label' => 'Urgent',  'icon' => 'fa-exclamation-triangle'],
            'high'   => ['bg' => 'bg-orange-500/10',   'text' => 'text-orange-400',  'border' => 'border-orange-500/20',   'dot' => 'bg-orange-400',  'label' => 'High',    'icon' => 'fa-exclamation-circle'],
            'normal' => ['bg' => 'bg-yellow-500/10',   'text' => 'text-yellow-400',  'border' => 'border-yellow-500/20',   'dot' => 'bg-yellow-400',  'label' => 'Normal',  'icon' => 'fa-bell'],
            'low'    => ['bg' => 'bg-blue-500/10',     'text' => 'text-blue-400',    'border' => 'border-blue-500/20',     'dot' => 'bg-blue-400',    'label' => 'Low',     'icon' => 'fa-bell'],
        ];
        $p = $priorityConfig[$notice->priority] ?? $priorityConfig['normal'];
    @endphp

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Main -->
        <div class="xl:col-span-2 space-y-5 animate-fadeUp">

            <!-- Title Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10 relative overflow-hidden">

                <!-- Top color accent bar -->
                <div class="absolute top-0 left-0 right-0 h-1 {{ $p['dot'] }} opacity-50 rounded-t-3xl"></div>

                <div class="flex items-start justify-between gap-4 mt-1">

                    <div class="flex-1">
                        <div class="inline-flex items-center gap-2 bg-yellow-400/10 border border-yellow-400/20 px-3 py-1.5 rounded-full text-xs text-yellow-400">
                            <i class="fas fa-bell text-[10px]"></i>
                            Notice Board
                        </div>
                        <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4 leading-snug">
                            {{ $notice->title }}
                        </h1>
                    </div>

                    <div class="w-14 h-14 rounded-2xl {{ $p['bg'] }} {{ $p['text'] }} flex items-center justify-center border {{ $p['border'] }} shrink-0">
                        <i class="fas {{ $p['icon'] }} text-2xl"></i>
                    </div>

                </div>

                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mt-5">

                    <span class="inline-flex items-center gap-1.5 {{ $p['bg'] }} {{ $p['text'] }} {{ $p['border'] }} border text-xs px-3 py-1.5 rounded-full">
                        <span class="w-2 h-2 rounded-full {{ $p['dot'] }} {{ $notice->priority === 'urgent' ? 'animate-pulse' : '' }}"></span>
                        {{ $p['label'] }} Priority
                    </span>

                    @if($notice->category)
                        <span class="inline-flex items-center gap-1.5 bg-input border border-bdr text-sec text-xs px-3 py-1.5 rounded-full">
                            <i class="fas fa-tag text-[10px]"></i>
                            {{ $notice->category }}
                        </span>
                    @endif

                    @if($notice->is_scrolling)
                        <span class="inline-flex items-center gap-1.5 bg-yellow-400/10 text-yellow-400 border border-yellow-400/20 text-xs px-3 py-1.5 rounded-full">
                            <i class="fas fa-scroll text-[10px]"></i> Scrolling Ticker
                        </span>
                    @endif

                    @if($isExpired)
                        <span class="inline-flex items-center gap-1.5 bg-red/10 text-red border border-red/20 text-xs px-3 py-1.5 rounded-full">
                            <i class="fas fa-clock text-[10px]"></i> Expired
                        </span>
                    @endif

                </div>

            </div>

            <!-- Content Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 rounded-xl bg-yellow-400/10 border border-yellow-400/20 text-yellow-400 flex items-center justify-center">
                        <i class="fas fa-file-alt text-sm"></i>
                    </div>
                    <h2 class="text-base font-semibold text-white">Notice Content</h2>
                </div>

                <div class="bg-input border border-bdr rounded-2xl px-5 py-5">
                    <div class="text-sm text-prim leading-relaxed prose prose-invert max-w-none">
                        {!! nl2br(e($notice->content)) !!}
                    </div>
                </div>

            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-5 animate-fadeUp">

            <!-- Info Card -->
            <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                <div class="flex items-center gap-3 mb-5">
                    <div class="w-9 h-9 rounded-xl bg-yellow-400/10 border border-yellow-400/20 text-yellow-400 flex items-center justify-center">
                        <i class="fas fa-info-circle text-sm"></i>
                    </div>
                    <h2 class="text-base font-semibold text-prim">Notice Info</h2>
                </div>

                <div class="space-y-3">

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1"><i class="fas fa-flag mr-1"></i> Priority</p>
                        <p class="text-sm font-semibold {{ $p['text'] }}">{{ $p['label'] }}</p>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1"><i class="fas fa-tag mr-1"></i> Category</p>
                        <p class="text-sm font-semibold text-prim">{{ $notice->category ?? 'General' }}</p>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1"><i class="fas fa-calendar-plus mr-1"></i> Published On</p>
                        <p class="text-sm font-semibold text-prim">{{ $notice->created_at->format('d M Y') }}</p>
                        <p class="text-xs text-sec mt-0.5">{{ $notice->created_at->format('h:i A') }}</p>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1"><i class="fas fa-calendar-times mr-1"></i> Expires</p>
                        @if($notice->expire_at)
                            <p class="text-sm font-semibold {{ $isExpired ? 'text-red' : 'text-prim' }}">
                                {{ \Carbon\Carbon::parse($notice->expire_at)->format('d M Y') }}
                            </p>
                            <p class="text-xs text-sec mt-0.5">
                                {{ $isExpired ? 'Expired ' : '' }}{{ \Carbon\Carbon::parse($notice->expire_at)->diffForHumans() }}
                            </p>
                        @else
                            <p class="text-sm font-semibold text-prim">No Expiry</p>
                        @endif
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-3">
                        <p class="text-[11px] text-sec mb-1"><i class="fas fa-scroll mr-1"></i> Scrolling Ticker</p>
                        @if($notice->is_scrolling)
                            <p class="text-sm font-semibold text-yellow-400"><i class="fas fa-check-circle mr-1"></i> Enabled</p>
                        @else
                            <p class="text-sm font-semibold text-sec"><i class="fas fa-times-circle mr-1"></i> Disabled</p>
                        @endif
                    </div>

                </div>

            </div>

            <!-- Expiry Countdown -->
            @if($notice->expire_at && !$isExpired)
                <div class="bg-card border border-bdr rounded-3xl p-6 shadow-lg shadow-black/10">

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-9 h-9 rounded-xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 flex items-center justify-center">
                            <i class="fas fa-hourglass-half text-sm"></i>
                        </div>
                        <h2 class="text-base font-semibold text-prim">Expires In</h2>
                    </div>

                    <div class="bg-input border border-bdr rounded-2xl px-4 py-4 text-center">
                        <p class="text-2xl font-bold text-yellow-400" id="countdown-display">--</p>
                        <p class="text-xs text-sec mt-1">Until expiry</p>
                    </div>

                </div>

                <script>
                    (function () {
                        const expiry = new Date("{{ \Carbon\Carbon::parse($notice->expire_at)->toIso8601String() }}");
                        const el = document.getElementById('countdown-display');
                        function update() {
                            const diff = expiry - new Date();
                            if (diff <= 0) { el.textContent = 'Expired'; return; }
                            const d = Math.floor(diff / 86400000);
                            const h = Math.floor((diff % 86400000) / 3600000);
                            const m = Math.floor((diff % 3600000) / 60000);
                            el.textContent = d > 0 ? d + 'd ' + h + 'h ' + m + 'm' : h > 0 ? h + 'h ' + m + 'm' : m + 'm';
                        }
                        update();
                        setInterval(update, 60000);
                    })();
                </script>
            @endif

            <!-- Back -->
            <a href="{{ route('student.notice') }}"
               class="w-full inline-flex items-center justify-center gap-2 bg-input hover:bg-card border border-bdr text-sec hover:text-prim text-sm font-medium px-5 py-3 rounded-2xl transition-all duration-200">
                <i class="fas fa-arrow-left text-xs"></i>
                Back to Notices
            </a>

        </div>

    </div>

</main>

@endsection
