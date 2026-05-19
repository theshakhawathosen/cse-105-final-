@extends('layouts.admin.admin-layout')
@section('title', 'Teachers')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Teachers
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Teacher List</h1>
                <p class="text-ts text-sm">Manage all registered teachers</p>
            </div>
        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <h2 class="text-tp font-semibold text-sm">All Teachers</h2>

                <a href="{{ route('teachers.create') }}" class="btn-primary text-xs px-4 py-2">
                    <i class="fas fa-plus mr-1"></i> Add Teacher
                </a>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-ts border-b border-border">
                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Photo</th>
                            <th class="py-3 text-left">Name</th>
                            <th class="py-3 text-left">Email</th>
                            <th class="py-3 text-left">Phone</th>
                            <th class="py-3 text-left">Gender</th>
                            <th class="py-3 text-left">Room</th>
                            <th class="py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-tp">

                        @forelse($teachers as $teacher)
                            <!-- DESKTOP TABLE -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">#{{ $teacher->id }}</td>

                                <!-- Photo -->
                                <td class="py-3">
                                    @if ($teacher->photo)
                                        <img src="{{ asset('storage/' . $teacher->photo) }}"
                                            class="w-10 h-10 rounded-lg object-cover border border-border">
                                    @else
                                        <img src="{{ asset('storage/man.png') }}"
                                            class="w-10 h-10 rounded-lg object-cover border border-border">
                                    @endif
                                </td>

                                <td class="py-3 font-medium">{{ $teacher->name }}</td>
                                <td class="py-3 text-ts">{{ $teacher->email ?? '-' }}</td>
                                <td class="py-3 text-ts">{{ $teacher->phone ?? '-' }}</td>

                                <td class="py-3">
                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">
                                        {{ ucfirst($teacher->gender) }}
                                    </span>
                                </td>

                                <td class="py-3 text-ts">{{ $teacher->roomNumber ?? '-' }}</td>

                                <td class="py-3 text-right space-x-2">
                                    <a href="{{ route('teachers.edit', $teacher->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">
                                        Edit
                                    </a>

                                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- MOBILE CARD -->
                            <tr class="md:hidden">
                                <td colspan="8" class="py-3">

                                    <div class="dash-card p-4 space-y-3">

                                        <div class="flex items-center gap-3">
                                            @if ($teacher->photo)
                                                <img src="{{ asset('storage/' . $teacher->photo) }}"
                                                    class="w-12 h-12 rounded-lg border border-border object-cover">
                                            @else
                                                <img src="{{ asset('storage/man.png') }}"
                                                    class="w-12 h-12 rounded-lg border border-border">
                                            @endif

                                            <div>
                                                <div class="font-semibold text-tp">{{ $teacher->name }}</div>
                                                <div class="text-xs text-ts">{{ $teacher->email ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <div class="text-xs text-ts">
                                            Phone: {{ $teacher->phone ?? '-' }}
                                        </div>

                                        <div class="text-xs text-ts">
                                            Gender: {{ ucfirst($teacher->gender) }}
                                        </div>

                                        <div class="text-xs text-ts">
                                            Room: {{ $teacher->roomNumber ?? '-' }}
                                        </div>

                                        <div class="flex justify-end gap-2 pt-2">
                                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                class="text-xs px-3 py-1 rounded-lg bg-input border border-border">
                                                Edit
                                            </a>

                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" onclick="return confirm('Are you sure?')"
                                                    class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="8" class="py-6 text-center text-ts">
                                    No teachers found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>

    </main>
@endsection
