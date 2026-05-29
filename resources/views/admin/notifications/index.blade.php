@extends('layouts.admin.admin-layout')

@section('title', 'Notifications')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Notifications
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    All Notifications
                </h1>

                <p class="text-ts text-sm">
                    Manage all system notifications
                </p>
            </div>


            <div class="flex flex-column gap-4">
                @if (auth()->user()->unreadNotifications->count())
                    <form action="{{ route('notifications.read.all') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <button class="btn-primary text-xs px-4 py-2">
                            <i class="fas fa-check-double mr-1"></i>
                            Mark All Read
                        </button>
                    </form>
                @endif


                @if(auth()->user()->notifications->count())
                                <form onclick="return confirm('Are you sure?')" action="{{ route('notifications.delete-all') }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="bg-red rounded-full text-xs px-4 py-2">
                        <i class="fas fa-trash mr-1"></i>
                        Delete All
                    </button>
                </form>
                @endif
            </div>


        </div>

        <!-- Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table -->
            <div class="overflow-x-auto">

                <table class="data-table w-full">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Notification</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($notifications as $notification)
                            @php
                                $data = $notification->data;
                                $isUnread = is_null($notification->read_at);
                            @endphp

                            <tr class="fade-up fade-up-d1">

                                {{-- ID --}}
                                <td>
                                    #{{ $loop->iteration }}
                                </td>

                                {{-- TITLE --}}
                                <td>

                                    <div class="flex items-start gap-3">

                                        <div
                                            class="w-9 h-9 rounded-full bg-input border border-border flex items-center justify-center shrink-0">

                                            <i class="{{ $data['icon'] ?? 'fa-regular fa-bell' }} text-accent text-sm"></i>
                                        </div>

                                        <div>

                                            <h6 class="font-semibold text-sm text-tp">
                                                {{ $data['title'] ?? 'Notification' }}
                                            </h6>

                                            @if ($isUnread)
                                                <span class="chip chip-blue mt-1">
                                                    New
                                                </span>
                                            @endif

                                        </div>

                                    </div>

                                </td>

                                {{-- MESSAGE --}}
                                <td class="text-ts text-sm max-w-[280px]">
                                    {{ Str::limit($data['message'] ?? '-', 80) }}
                                </td>

                                {{-- STATUS --}}
                                <td>

                                    @if ($isUnread)
                                        <span class="chip chip-red">
                                            Unread
                                        </span>
                                    @else
                                        <span class="chip chip-green">
                                            Read
                                        </span>
                                    @endif

                                </td>

                                {{-- TIME --}}
                                <td class="text-ts text-sm">
                                    {{ $notification->created_at->diffForHumans() }}
                                </td>

                                {{-- ACTION --}}
                                <td class="text-right">

                                    <div class="flex justify-end gap-2">

                                        {{-- VIEW --}}
                                        @if (!empty($data['route']))
                                            <a href="{{ route('admin.readAndRedirect',['notificationid' => $notification->id, 'route' => base64_encode($data['route'])]) }}" class="btn-ghost text-xs px-3 py-1">

                                                Open
                                            </a>
                                        @endif

                                        {{-- MARK AS READ --}}
                                        @if ($isUnread)
                                            <form method="POST"
                                                action="{{ route('notifications.read', $notification->id) }}">

                                                @csrf
                                                @method('PATCH')

                                                <button class="btn-primary text-xs px-3 py-1">
                                                    Read
                                                </button>
                                            </form>
                                        @endif

                                        {{-- DELETE --}}
                                        <form method="POST"
                                            action="{{ route('notifications.destroy', $notification->id) }}">

                                            @csrf
                                            @method('DELETE')

                                            <button onclick="return confirm('Delete notification?')"
                                                class="btn-danger text-xs px-3 py-1">

                                                Delete
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="py-10 text-center">

                                    <div class="flex flex-col items-center">

                                        <i class="fa-regular fa-bell-slash text-3xl text-ts mb-3"></i>

                                        <p class="text-ts text-sm">
                                            No notifications found
                                        </p>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            @if ($notifications->hasPages())
                <div class="mt-5">
                    {{ $notifications->links() }}
                </div>
            @endif

        </div>

    </main>

@endsection
