@extends('layouts.student.student-layout')

@section('title', 'Notifications')

@section('content')

<main id="main-content" class="p-4 md:p-6">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5 mb-7">

        <div>

            <div
                class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-white/10 bg-white/[0.03] backdrop-blur-md text-xs text-slate-300">

                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>

                Notification Center

            </div>

            <h1 class="mt-3 text-3xl md:text-4xl font-bold tracking-tight text-white">
                Notifications
            </h1>

            <p class="mt-2 text-sm text-slate-400">
                Stay updated with your latest academic activities and announcements.
            </p>

        </div>


        <!-- Actions -->
        <div class="flex flex-wrap items-center gap-3">

            @if($unreadCount > 0)

                <form action="{{ route('student.notifications.markAllAsRead') }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="h-11 px-5 rounded-2xl border border-white/10 bg-white/[0.04] text-white text-sm font-medium hover:border-cyan-400/50 hover:bg-cyan-500/10 hover:text-cyan-300 transition-all duration-300">

                        <i class="fa-solid fa-check-double mr-2"></i>

                        Mark All Read

                    </button>
                </form>

            @endif


            @if($notifications->count() > 0)

                <form action="{{ route('student.notifications.deleteAll') }}"
                    method="POST"
                    onsubmit="return confirm('Delete all notifications?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="h-11 px-5 rounded-2xl border border-red-500/20 bg-red-500/10 text-red-400 text-sm font-medium hover:bg-red-500 hover:text-white transition-all duration-300">

                        <i class="fa-solid fa-trash mr-2"></i>

                        Delete All

                    </button>

                </form>

            @endif

        </div>

    </div>



    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mb-7">

        <!-- Total -->
        <div
            class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-6 shadow-xl">

            <div
                class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-3xl">
            </div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Total Notifications
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-white">
                        {{ $notifications->total() }}
                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 flex items-center justify-center text-2xl">

                    <i class="fa-regular fa-bell"></i>

                </div>

            </div>

        </div>



        <!-- Unread -->
        <div
            class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-6 shadow-xl">

            <div
                class="absolute top-0 right-0 w-32 h-32 bg-yellow-500/10 rounded-full blur-3xl">
            </div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Unread
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-white">
                        {{ $unreadCount }}
                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 flex items-center justify-center text-2xl">

                    <i class="fa-solid fa-envelope"></i>

                </div>

            </div>

        </div>



        <!-- Read -->
        <div
            class="relative overflow-hidden rounded-3xl border border-white/10 bg-gradient-to-br from-slate-900 to-slate-950 p-6 shadow-xl">

            <div
                class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-3xl">
            </div>

            <div class="relative flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-400">
                        Read
                    </p>

                    <h2 class="mt-3 text-4xl font-black text-white">
                        {{ $notifications->total() - $unreadCount }}
                    </h2>

                </div>

                <div
                    class="w-16 h-16 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-2xl">

                    <i class="fa-solid fa-check"></i>

                </div>

            </div>

        </div>

    </div>




    <!-- Notification List -->
    <div class="space-y-5">

        @forelse($notifications as $notification)

            @php
                $isRead = !is_null($notification->read_at);
                $data = $notification->data;
            @endphp

            <div
                class="relative overflow-hidden rounded-3xl border transition-all duration-300
                {{ !$isRead
                    ? 'border-cyan-500/30 bg-cyan-500/[0.03]'
                    : 'border-white/10 bg-white/[0.03]' }}">

                <!-- Glow -->
                @if(!$isRead)
                    <div
                        class="absolute top-0 left-0 w-1 h-full bg-cyan-400">
                    </div>
                @endif


                <a href="{{ route('student.readAndRedirect',['notificationid' => $notification['id'], 'route' => base64_encode($data['route'])]) }}" class="block p-5 md:p-6">

                    <div class="flex flex-col xl:flex-row xl:items-start xl:justify-between gap-6">

                        <!-- Left -->
                        <div class="flex items-start gap-4 flex-1 min-w-0">

                            <!-- Icon -->
                            <div
                                class="w-14 h-14 rounded-2xl flex-shrink-0 flex items-center justify-center text-xl border
                                {{ !$isRead
                                    ? 'bg-cyan-500/10 border-cyan-500/20 text-cyan-400'
                                    : 'bg-white/[0.03] border-white/10 text-slate-400' }}">

                                <i class="fa-regular fa-bell"></i>

                            </div>


                            <!-- Content -->
                            <div class="flex-1 min-w-0">

                                <div class="flex flex-wrap items-center gap-3 mb-3">

                                    <h2 class="text-lg md:text-xl font-bold text-white break-words">

                                        {{ $data['title'] ?? 'New Notification' }}

                                    </h2>

                                    @if(!$isRead)

                                        <span
                                            class="px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-300 text-xs font-semibold">

                                            New

                                        </span>

                                    @endif

                                </div>


                                <p class="text-sm leading-7 text-slate-400 break-words">

                                   {{ \Illuminate\Support\Str::limit($data['message'] ?? 'New notification', 150, '...') }}

                                </p>



                                @if(isset($data['link']))

                                    <a href="{{ $data['link'] }}"
                                        class="inline-flex items-center gap-2 mt-5 text-sm font-medium text-cyan-400 hover:text-cyan-300 transition-all">

                                        View Details

                                        <i class="fa-solid fa-arrow-right text-xs"></i>

                                    </a>

                                @endif



                                <!-- Time -->
                                <div class="flex flex-wrap items-center gap-5 mt-5 text-xs text-slate-500">

                                    <div class="flex items-center gap-2">

                                        <i class="fa-regular fa-clock"></i>

                                        {{ $notification->created_at->diffForHumans() }}

                                    </div>


                                    <div class="flex items-center gap-2">

                                        <i class="fa-regular fa-calendar"></i>

                                        {{ $notification->created_at->format('d M Y · h:i A') }}

                                    </div>

                                </div>

                            </div>

                        </div>




                        <!-- Right Actions -->
                        <div class="flex flex-wrap items-center gap-3">

                            @if(!$isRead)

                                <form
                                    action="{{ route('student.notifications.markAsRead', $notification->id) }}"
                                    method="POST">

                                    @csrf

                                    <button type="submit"
                                        class="h-10 px-4 rounded-xl border border-white/10 bg-white/[0.03] text-white text-sm font-medium hover:border-cyan-400/40 hover:bg-cyan-500/10 hover:text-cyan-300 transition-all duration-300">

                                        <i class="fa-solid fa-check mr-2"></i>

                                        Mark Read

                                    </button>

                                </form>

                            @endif



                            <form
                                action="{{ route('student.notifications.delete', $notification->id) }}"
                                method="POST"
                                onsubmit="return confirm('Delete this notification?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="h-10 px-4 rounded-xl border border-red-500/20 bg-red-500/10 text-red-400 text-sm font-medium hover:bg-red-500 hover:text-white transition-all duration-300">

                                    <i class="fa-solid fa-trash mr-2"></i>

                                    Delete

                                </button>

                            </form>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <!-- Empty -->
            <div
                class="rounded-3xl border border-dashed border-white/10 bg-white/[0.03] p-12 text-center">

                <div
                    class="w-28 h-28 mx-auto rounded-full bg-white/[0.03] border border-white/10 flex items-center justify-center text-5xl text-slate-500 mb-6">

                    <i class="fa-regular fa-bell-slash"></i>

                </div>

                <h2 class="text-3xl font-bold text-white mb-3">

                    No Notifications Found

                </h2>

                <p class="max-w-lg mx-auto text-slate-400 leading-7">

                    You currently have no notifications. Important updates,
                    announcements and academic activities will appear here.

                </p>

            </div>

        @endforelse

    </div>




    <!-- Pagination -->
    @if($notifications->hasPages())

        <div class="mt-8">

            {{ $notifications->links() }}

        </div>

    @endif

</main>

@endsection
