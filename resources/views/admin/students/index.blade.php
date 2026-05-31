@extends('layouts.admin.admin-layout')
@section('title', 'Students')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Students
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Student List</h1>
                <p class="text-ts text-sm">Manage all registered students</p>
            </div>
        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <!-- Top Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <h2 class="text-tp font-semibold text-sm">All Students</h2>

                <a href="{{ route('students.create') }}" class="btn-primary text-xs px-4 py-2">
                    <i class="fas fa-plus mr-1"></i> Add Student
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
                            <th class="py-3 text-left">Roll</th>
                            <th class="py-3 text-left">Email</th>
                            <th class="py-3 text-left">Phone</th>
                            <th class="py-3 text-left">Role</th>
                            <th class="py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-tp">

                        @forelse($students as $student)
                            <!-- DESKTOP TABLE ROW -->
                            <tr class="border-b border-border hover:bg-input/40 transition hidden md:table-row">

                                <td class="py-3">#{{ $student->id }}</td>

                                <!-- Photo -->
                                <td class="py-3">
                                    @if ($student->photo)
                                        <img src="{{ asset('storage/' . $student->photo) }}"
                                            class="w-10 h-10 rounded-lg object-cover border border-border">
                                    @else
                                        <img src="{{ asset('default.png') }}"
                                            class="w-10 h-10 rounded-lg object-cover border border-border">
                                    @endif
                                </td>

                                <td class="py-3 font-medium">{{ $student->name }} <div><small>{{ $student->reg }}</small></div></td>
                                <td class="py-3 font-medium">{{ $student->roll }}</td>

                                <td class="py-3 text-ts">{{ $student->email }}</td>

                                <td class="py-3 text-ts">{{ $student->phone ?? '-' }}</td>

                                <td class="py-3">
                                    <span class="px-2 py-1 text-[10px] rounded-lg bg-input border border-border">
                                        {{ $student->role }}
                                    </span>
                                </td>

                                <td class="py-3 text-right space-x-2">
                                    <a href="{{ route('students.edit', $student->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">
                                        Edit
                                    </a>

                                    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
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
                                <td colspan="7" class="py-3">

                                    <div class="dash-card p-4 space-y-2">

                                        <div class="flex items-center gap-3">

                                            @if ($student->photo)
                                                <img src="{{ asset('storage/' . $student->photo) }}"
                                                    class="w-12 h-12 rounded-lg border border-border">
                                            @else
                                                <img src="{{ asset('/default.png') }}"
                                                    class="w-12 h-12 rounded-lg border border-border">
                                            @endif

                                            <div>
                                                <div class="font-semibold text-tp">{{ $student->name }}</div>
                                                <div class="text-xs text-ts">{{ $student->email }}</div>
                                            </div>
                                        </div>

                                        <div class="text-xs text-ts">
                                            Phone: {{ $student->phone ?? '-' }}
                                        </div>

                                        <div class="flex justify-between items-center">
                                            <span class="text-[10px] px-2 py-1 bg-input border border-border rounded-lg">
                                                {{ $student->role }}
                                            </span>

                                            <div class="space-x-2">
                                                <a href="{{ route('students.edit', $student->id) }}"
                                                    class="text-xs px-3 py-1 rounded-lg bg-input border border-border">
                                                    Edit
                                                </a>

                                                <form action="{{ route('students.destroy', $student->id) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                    </div>

                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7" class="py-6 text-center text-ts">
                                    No students found
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
            <div class="p-3 mt-4">
                {{ $students->links() }}
            </div>

        </div>

    </main>
@endsection
