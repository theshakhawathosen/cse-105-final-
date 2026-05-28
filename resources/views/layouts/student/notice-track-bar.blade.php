@php
    $notices = \App\Models\Notice::latest()->where('is_scrolling',true)->where('is_published',true)->take(10)->get();
@endphp

<div class="bg-accent right-0 h-9 bg-hover border-b border-accent/20 flex items-center z-[990] overflow-hidden"
    role="marquee" aria-label="Batch notices">

    <!-- Label -->
    <div class="flex items-center gap-1.5 px-3 border-r border-accent/25 h-full shrink-0 bg-accent/10">
        <i class="fa-solid fa-bullhorn text-accent text-[0.7rem]"></i>

        <span class="text-[0.7rem] font-bold text-accent uppercase tracking-widest">
            Notice
        </span>

        <span class="bg-red text-white text-[0.58rem] font-bold rounded-full px-1.5 py-px">
            {{ $notices->count() }}
        </span>
    </div>

    <!-- Ticker -->
    <div class="flex-1 overflow-hidden h-full flex items-center">

        <div class="ticker-track" id="noticeTrack">

            @forelse ($notices as $notice)

                <a href="{{ route('student.notice.show', $notice->id) }}"
                    class="inline-flex items-center gap-2 text-[0.78rem] text-prim cursor-pointer hover:text-ahover shrink-0">

                    <i
                        class="fa-solid {{ $notice->type == 'important' ? 'fa-circle-exclamation text-red' : 'fa-circle-info text-accent' }} text-[0.72rem]">
                    </i>

                    {{ $notice->title }}
                </a>

                @if (!$loop->last)
                    <span class="text-hint mx-4">•</span>
                @endif

            @empty

                <span class="text-[0.78rem] text-hint px-4">
                    No notices available right now.
                </span>

            @endforelse

        </div>

    </div>
</div>
