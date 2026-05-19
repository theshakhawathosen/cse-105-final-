@extends('layouts.admin.admin-layout')
@section('title', 'Notices')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Notices
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Notice Board</h1>
                <p class="text-ts text-sm">Manage all system notices</p>
            </div>

            <a href="{{ route('notices.create') }}" class="btn-primary text-xs px-4 py-2">
                <i class="fas fa-plus mr-1"></i> Add Notice
            </a>
        </div>

        <!-- Table -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-3 bg-green-100 text-green-700 px-4 py-2 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="data-table w-full">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Priority</th>
                            <th>Expires In</th> {{-- NEW --}}
                            <th>Publish</th>
                            <th>Scrolling</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($notices as $notice)
                            @php
                                $categoryColors = [
                                    'Academic' => 'chip chip-blue',
                                    'Assignment' => 'chip chip-purple',
                                    'Lab Report' => 'chip chip-teal',
                                    'Exam' => 'chip chip-red',
                                    'General' => 'chip chip-muted',
                                    'Emergency' => 'chip chip-amber',
                                    'Others' => 'chip chip-muted',
                                ];

                                $priorityColors = [
                                    'High' => 'chip chip-red',
                                    'Medium' => 'chip chip-amber',
                                    'Low' => 'chip chip-green',
                                ];

                                // -------------------------------
                                // EXPIRY LOGIC
                                // -------------------------------
                                $expiryText = 'No expiry';

                                if ($notice->expire_at) {
                                    $now = \Carbon\Carbon::now();
                                    $expireDate = \Carbon\Carbon::parse($notice->expire_at);

                                    $diffDays = (int) $now->diffInDays($expireDate, false);

                                    if ($diffDays < 0) {
                                        $expiryText = 'Expired';
                                    } elseif ($diffDays == 0) {
                                        $expiryText = 'Expires today';
                                    } else {
                                        $expiryText = $diffDays . ' days left';
                                    }
                                }

                                $expiryClass = match (true) {
                                    $expiryText === 'Expired' => 'chip chip-red',
                                    $expiryText === 'Expires today' => 'chip chip-amber',
                                    $expiryText === 'No expiry' => 'chip chip-muted',
                                    default => 'chip chip-green',
                                };
                            @endphp

                            <tr class="fade-up fade-up-d1">

                                <td>#{{ $notice->id }}</td>

                                <td class="font-medium text-tp">
                                    {{ $notice->title }}
                                </td>

                                {{-- CATEGORY --}}
                                <td>
                                    <span class="{{ $categoryColors[$notice->category] ?? 'chip chip-muted' }}">
                                        {{ $notice->category ?? '-' }}
                                    </span>
                                </td>

                                {{-- PRIORITY --}}
                                <td>
                                    <span class="{{ $priorityColors[$notice->priority] ?? 'chip chip-muted' }}">
                                        {{ $notice->priority }}
                                    </span>
                                </td>

                                {{-- EXPIRY STATUS --}}
                                <td>
                                    <span class="{{ $expiryClass }}">
                                        {{ $expiryText }}
                                    </span>
                                </td>

                                {{-- PUBLISH --}}
                                <td>
                                    <form method="POST" action="{{ route('notices.togglePublish', $notice->id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="chip {{ $notice->is_published ? 'chip-green' : 'chip-red' }}">
                                            {{ $notice->is_published ? 'Published' : 'Draft' }}
                                        </button>
                                    </form>
                                </td>

                                {{-- SCROLLING --}}
                                <td>
                                    <form method="POST" action="{{ route('notices.toggleScrolling', $notice->id) }}">
                                        @csrf
                                        @method('PATCH')

                                        <button type="submit"
                                            class="chip {{ $notice->is_scrolling ? 'chip-blue' : 'chip-muted' }}">
                                            {{ $notice->is_scrolling ? 'ON' : 'OFF' }}
                                        </button>
                                    </form>
                                </td>

                                {{-- ACTION --}}
                                <td class="text-right space-x-2">

                                    <a href="{{ route('notices.edit', $notice->id) }}" class="btn-ghost text-xs px-3 py-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('notices.destroy', $notice->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button onclick="return confirm('Delete this notice?')"
                                            class="btn-danger text-xs px-3 py-1">
                                            Delete
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="py-6 text-center text-ts">
                                    No notices found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>

        </div>

    </main>
@endsection
