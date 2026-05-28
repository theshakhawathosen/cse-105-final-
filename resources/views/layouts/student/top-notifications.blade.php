@php
    $notifications = auth()->user()->notifications()->latest()->take(10)->get();
    $unreadCount = auth()->user()->unreadNotifications()->count();
@endphp

<div class="relative">

    <!-- Notification Button -->
    <button id="notifBtn"
        class="relative w-[34px] h-[34px] bg-input border border-bdr rounded-full flex items-center justify-center text-sec text-sm hover:text-accent hover:border-accent transition-all cursor-pointer">

        <i class="fa-regular fa-bell"></i>

        @if ($unreadCount > 0)
            <span id="notifDot"
                class="absolute top-[5px] right-[5px] w-2 h-2 bg-red rounded-full border-[1.5px] border-nav">
            </span>
        @endif
    </button>

    <!-- Dropdown -->
    <div id="notifDropdown"
        class="hidden absolute top-[calc(100%+10px)] right-0 w-[320px] bg-card border border-bdr rounded-xl shadow-[0_12px_40px_rgba(0,0,0,.45)] z-[9999] overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-4 py-3 border-b border-bdr">

            <span class="text-[0.8rem] font-semibold text-prim">
                Notifications
            </span>

            @if ($unreadCount > 0)
                <form action="{{ route('student.notifications.markAllAsRead') }}" method="POST">
                    @csrf

                    <button type="submit" class="text-[0.7rem] text-accent font-medium hover:text-ahover transition">
                        Mark all read
                    </button>
                </form>
            @endif

        </div>

        <!-- Notifications -->
        <div class="max-h-[320px] overflow-y-auto no-scroll">

            @forelse($notifications as $notification)
                @php
                    $data = $notification->data;
                    $isUnread = is_null($notification->read_at);
                @endphp

                <a href="{{ route('student.readAndRedirect',['notificationid' => $notification['id'], 'route' => base64_encode($data['route'])]) }}" class="notif-item group flex gap-3 px-4 py-3 border-b border-bdr transition-colors
                    {{ $isUnread ? 'bg-accent/10' : 'hover:bg-white/[0.03]' }}">

                    <!-- Icon -->
                    <div
                        class="w-[36px] h-[36px] border rounded-full bg-{{ $data['color'] ?? 'blue' }}/10 flex items-center justify-center shrink-0">

                        <i
                            class="fa-solid {{ $data['icon'] ?? 'fa-bell' }} text-{{ $data['color'] ?? 'blue' }} text-xs">
                        </i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 min-w-0">

                        <p class="text-[0.78rem] leading-snug {{ $isUnread ? 'text-prim font-medium' : 'text-sec' }}">

                            {{ \Illuminate\Support\Str::limit($data['title'] ?? 'New notification', 30, '...') }}

                        </p>
                        <p class="text-[0.50rem] mt-1 leading-snug {{ $isUnread ? 'text-prim font-medium' : 'text-sec' }}">
                            {{ \Illuminate\Support\Str::limit($data['message'] ?? 'New notification', 100, '...') }}

                        </p>

                        <p class="text-[0.60rem] text-hint mt-1">
                            <i class="fa-regular fa-clock mr-1"></i>
                            {{ $notification->created_at->diffForHumans() }}
                        </p>

                        <!-- Actions -->
                        <div class="flex items-center gap-3">

                            @if ($isUnread)
                                <form action="{{ route('student.notifications.markAsRead', $notification->id) }}"
                                    method="POST">
                                    @csrf

                                    <button type="submit"
                                        class="text-[0.68rem] text-accent hover:text-ahover transition">
                                        Mark as read
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('student.notifications.delete', $notification->id) }}"
                                method="POST" onsubmit="return confirm('Delete this notification?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="text-[0.68rem] text-red-400 hover:text-red-300 transition">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                </a>

            @empty

                <div class="px-4 py-8 text-center">

                    <div
                        class="w-14 h-14 mx-auto rounded-full bg-input border border-bdr flex items-center justify-center mb-3">
                        <i class="fa-regular fa-bell-slash text-sec text-lg"></i>
                    </div>

                    <p class="text-sm text-hint">
                        No notifications found
                    </p>

                </div>
            @endforelse

        </div>

        <!-- Footer -->
        <div class="px-4 py-3 border-t border-bdr bg-white/[0.02]">

            <div class="flex items-center justify-between">

                <a href="{{ route('student.notifications') }}"
                    class="text-[0.75rem] text-accent font-medium hover:text-ahover transition">
                    View all notifications
                </a>

                @if ($notifications->count() > 0)
                    <form action="{{ route('student.notifications.deleteAll') }}" method="POST"
                        onsubmit="return confirm('Delete all notifications?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="text-[0.72rem] text-red-400 hover:text-red-300 transition">
                            Delete all
                        </button>

                    </form>
                @endif

            </div>

        </div>

    </div>
</div>
