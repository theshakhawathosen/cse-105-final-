@extends('layouts.student.student-layout')

@section('title', 'Notices')

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

        <div>
            <div class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">
                <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                Student Portal
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">Notices</h1>
            <p class="text-sec text-sm mt-1">Stay updated with the latest announcements</p>
        </div>

        <!-- Right: Total + Category Filter -->
        <div class="flex flex-col sm:flex-row sm:items-center gap-3">

            <div class="inline-flex items-center gap-2 bg-card border border-bdr px-4 py-2.5 rounded-2xl text-sm text-sec shrink-0">
                <i class="fas fa-bell text-yellow-400"></i>
                <span class="text-prim font-medium">{{ $notices->total() }}</span> Total Notices
            </div>

            <form method="GET" action="{{ route('student.notice') }}">
                <select
                    name="category"
                    onchange="this.form.submit()"
                    class="bg-card border border-bdr text-sec text-sm px-4 py-2.5 rounded-2xl focus:outline-none focus:border-yellow-400/50 hover:border-yellow-400/50 transition-all duration-200 cursor-pointer">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                            {{ $category }}
                        </option>
                    @endforeach
                </select>
            </form>

        </div>

    </div>

    <!-- Notice List -->
    <div class="space-y-4">

        @forelse($notices as $notice)

            @php
                $isExpired = $notice->expire_at
                    ? \Carbon\Carbon::parse($notice->expire_at)->isPast()
                    : false;

                $priorityConfig = [
                    'urgent' => ['bg' => 'bg-red/10',          'text' => 'text-red',         'border' => 'border-red/20',          'dot' => 'bg-red',         'label' => 'Urgent'],
                    'high'   => ['bg' => 'bg-orange-500/10',   'text' => 'text-orange-400',  'border' => 'border-orange-500/20',   'dot' => 'bg-orange-400',  'label' => 'High'],
                    'normal' => ['bg' => 'bg-yellow-500/10',   'text' => 'text-yellow-400',  'border' => 'border-yellow-500/20',   'dot' => 'bg-yellow-400',  'label' => 'Normal'],
                    'low'    => ['bg' => 'bg-blue-500/10',     'text' => 'text-blue-400',    'border' => 'border-blue-500/20',     'dot' => 'bg-blue-400',    'label' => 'Low'],
                ];
                $p = $priorityConfig[$notice->priority] ?? $priorityConfig['normal'];
            @endphp

            <a href="{{ route('student.notice.show', $notice->id) }}"
               class="group bg-card border border-bdr rounded-2xl px-5 py-4 hover:border-yellow-400/40 transition-all duration-300 shadow-md shadow-black/10 animate-fadeUp flex items-center gap-5 block text-white">

                <!-- Priority Color Bar -->
                <div class="w-1 self-stretch rounded-full {{ $p['dot'] }} opacity-60 shrink-0"></div>

                <!-- Icon -->
                <div class="w-11 h-11 rounded-2xl {{ $p['bg'] }} {{ $p['text'] }} flex items-center justify-center border {{ $p['border'] }} shrink-0 group-hover:scale-105 transition-transform duration-200">
                    @if($notice->priority === 'urgent')
                        <i class="fas fa-exclamation-triangle text-white"></i>
                    @elseif($notice->priority === 'high')
                        <i class="fas fa-exclamation-circle text-white"></i>
                    @else
                        <i class="fas fa-bell text-white"></i>
                    @endif
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">

                    <div class="flex flex-wrap items-center gap-2 mb-1">

                        <!-- Priority Badge -->
                        <span class="inline-flex items-center gap-1 {{ $p['bg'] }} {{ $p['text'] }} {{ $p['border'] }} border text-[11px] px-2.5 py-0.5 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full {{ $p['dot'] }} {{ $notice->priority === 'urgent' ? 'animate-pulse' : '' }}"></span>
                            {{ $p['label'] }}
                        </span>

                        <!-- Category -->
                        @if($notice->category)
                            <span class="inline-flex items-center gap-1 bg-input border border-bdr text-sec text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-tag text-[9px]"></i>
                                {{ $notice->category }}
                            </span>
                        @endif

                        <!-- Expired -->
                        @if($isExpired)
                            <span class="inline-flex items-center gap-1 bg-red/10 text-red border border-red/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-clock text-[9px]"></i> Expired
                            </span>
                        @endif

                        <!-- Scrolling -->
                        {{-- @if($notice->is_scrolling)
                            <span class="inline-flex items-center gap-1 bg-yellow-400/10 text-yellow-400 border border-yellow-400/20 text-[11px] px-2.5 py-0.5 rounded-full">
                                <i class="fas fa-scroll text-[9px]"></i> Scrolling
                            </span>
                        @endif --}}

                    </div>

                    <h2 class="text-base font-semibold text-prim group-hover:text-yellow-400 transition-colors duration-200 truncate">
                        {{ $notice->title }}
                    </h2>

                    <p class="text-xs text-sec mt-0.5 truncate">
                        {{ Str::limit(strip_tags($notice->content), 80) }}
                    </p>

                </div>

                <!-- Date + Arrow -->
                <div class="hidden sm:flex flex-col items-end gap-2 shrink-0">
                    <span class="text-xs text-sec">
                        <i class="fas fa-calendar-alt text-[10px] mr-1 text-yellow-400/60"></i>
                        {{ $notice->created_at->format('d M Y') }}
                    </span>
                    @if($notice->expire_at && !$isExpired)
                        <span class="text-[11px] text-sec">
                            Expires {{ \Carbon\Carbon::parse($notice->expire_at)->diffForHumans() }}
                        </span>
                    @endif
                    <i class="fas fa-chevron-right text-sec text-sm group-hover:text-yellow-400 group-hover:translate-x-0.5 transition-all duration-200 mt-1"></i>
                </div>

            </a>

        @empty

            <div class="bg-card border border-bdr rounded-3xl p-10 text-center">
                <div class="w-20 h-20 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center text-sec text-3xl">
                    <i class="fas fa-bell-slash"></i>
                </div>
                <h3 class="text-xl font-semibold text-prim mt-5">No Notices Found</h3>
                <p class="text-sec text-sm mt-2">
                    {{ request('category') ? 'No notices for this category.' : 'There are no published notices at the moment.' }}
                </p>
            </div>

        @endforelse

    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $notices->appends(request()->query())->links() }}
    </div>

</main>

@endsection
