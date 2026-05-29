<button class="btn-icon relative" onclick="toggleDropdown('notif-dd')">
    <i class="fas fa-bell text-sm"></i>

    @php
        $unreadCount = auth()->user()->unreadNotifications->count();
    @endphp

    @if ($unreadCount > 0)
        <span
            class="absolute -top-0.5 -right-0.5 min-w-[14px] h-[14px] px-[2px] bg-red text-white text-[8px] font-bold rounded-full flex items-center justify-center">
            {{ $unreadCount > 9 ? '9+' : $unreadCount }}
        </span>
    @endif
</button>

<div class="dropdown-menu" id="notif-dd" style="right:0;min-width:320px;top:42px">

    <!-- Header -->
    <div class="p-3 border-b border-border flex items-center justify-between">
        <div class="flex items-center gap-2">
            <span class="text-tp text-xs font-semibold">
                Notifications
            </span>

            @if ($unreadCount > 0)
                <span class="chip chip-red">
                    {{ $unreadCount }} new
                </span>
            @endif
        </div>

        @if ($unreadCount > 0)
            <form action="{{ route('notifications.read.all') }}" method="POST">
                @csrf
                @method('patch')

                <button type="submit"
                    class="text-[11px] text-accent hover:underline">
                    Mark all read
                </button>
            </form>
        @endif
    </div>

    <!-- Notifications -->
    <div class="max-h-[350px] overflow-y-auto p-2">

        @forelse(auth()->user()->notifications->take(8) as $notification)
            @php
                $data = $notification->data;
                $isUnread = is_null($notification->read_at);
            @endphp

            <a href="{{ route('admin.readAndRedirect',['notificationid' => $notification->id, 'route' => base64_encode($data['route'])]) }}"
                class="dropdown-item flex items-start gap-3 rounded-xl p-2 transition-all hover:bg-input
                {{ $isUnread ? 'bg-accent/5' : '' }}">

                <!-- Icon -->
                <div
                    class="w-8 h-8 rounded-full bg-input border border-border flex items-center justify-center shrink-0">
                    <i class="{{ $data['icon'] }} text-accent text-xs"></i>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">

                    <div class="flex items-start justify-between gap-2">

                        <h6
                            class="text-[12px] font-semibold text-tp leading-[1.3] line-clamp-1">
                            {{ $data['title'] }}
                        </h6>

                        @if ($isUnread)
                            <span
                                class="w-2 h-2 rounded-full bg-red mt-1 shrink-0"></span>
                        @endif
                    </div>

                    <p class="text-ts text-[11px] leading-[1.4] mt-1 line-clamp-2">
                        {{ Str::limit($data['message'], 70) }}
                    </p>

                    <span class="text-[10px] text-ts mt-1 block">
                        {{ $notification->created_at->diffForHumans() }}
                    </span>
                </div>
            </a>

        @empty
            <div class="py-8 text-center">
                <i class="fa-regular fa-bell-slash text-2xl text-ts mb-2"></i>

                <p class="text-xs text-ts">
                    No notifications found
                </p>
            </div>
        @endforelse

    </div>

    <!-- Footer -->
    <div class="p-3 border-t border-border text-center">
        <a href="{{ route('notifications.index') }}"
            class="text-accent text-xs hover:underline">
            View all notifications →
        </a>
    </div>
</div>
