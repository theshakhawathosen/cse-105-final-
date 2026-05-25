@extends('layouts.admin.admin-layout')
@section('title', 'Attendance History')

@section('content')

    <main id="main-content">

        <!-- Attendance Report Modal -->
        @if (session('attendance_text'))
            <div id="attendanceModal" class="fixed inset-0 z-50 bg-black/70 flex items-center justify-center p-4">

                <div class="dash-card p-5 w-full max-w-2xl relative">

                    <button onclick="closeAttendanceModal()" class="absolute top-3 right-3 text-ts hover:text-red-400">

                        <i class="fas fa-times"></i>

                    </button>

                    <h2 class="text-lg font-bold text-tp mb-4">
                        Attendance Report
                    </h2>

                    <textarea rows="15" readonly class="w-full bg-input border border-border rounded-2xl px-4 py-4 text-sm text-tp">{{ session('attendance_text') }}</textarea>

                    <div class="flex justify-end mt-4">

                        <button onclick="copyAttendanceModal()" class="btn-primary text-xs px-4 py-2">

                            Copy Report

                        </button>

                    </div>

                </div>

            </div>
        @endif

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Attendance
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Attendance History
                </h1>

                <p class="text-ts text-sm">
                    Manage attendance records
                </p>

            </div>

            <a href="{{ route('attendances.create') }}" class="btn-primary text-xs px-4 py-2">

                <i class="fas fa-plus mr-1"></i>
                Take Attendance

            </a>

        </div>

        <!-- Table Card -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>

                        <tr class="text-ts border-b border-border">

                            <th class="py-3 text-left">ID</th>
                            <th class="py-3 text-left">Subject</th>
                            <th class="py-3 text-left">Date</th>
                            <th class="py-3 text-left">Day</th>
                            <th class="py-3 text-left">Present</th>
                            <th class="py-3 text-left">Absent</th>
                            <th class="py-3 text-center">Present %</th>
                            <th class="py-3 text-right">Action</th>

                        </tr>

                    </thead>

                    <tbody class="text-tp">

                        @forelse($attendances as $attendance)
                            <tr class="border-b border-border hover:bg-input/40 transition">

                                <td class="py-3">
                                    #{{ $loop->iteration }}
                                </td>


                                <td class="py-3 text-ts">
                                    {{ $attendance->subject->name }}
                                </td>
                                <td class="py-3 text-ts">
                                    {{ $attendance->date }}
                                </td>
                                <td class="py-3 text-ts">
                                    {{ \Carbon\Carbon::parse($attendance->date)->format('l') }}
                                </td>

                                <td class="py-3 text-green">
                                    {{ $total_present = $attendance->take_attendence->where('status', 'present')->count() }}
                                </td>
                                <td class="py-3 text-red">
                                    {{ $total_absent = $attendance->take_attendence->where('status', 'absent')->count() }}
                                </td>
                                @php
                                    $total_students = $attendance->take_attendence->count();
                                    $presentPercentage =
                                        $total_students > 0 ? round(($total_present / $total_students) * 100) : 0;

                                    $absentPercentage = 100 - $presentPercentage;
                                @endphp

                                <td class="py-3 min-w-[100px]">

                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden flex">

                                        <!-- Present -->
                                        <div class="bg-green text-black text-[7px] flex items-center justify-center transition-all duration-300"
                                            style="width: {{ $presentPercentage }}%">

                                            {{ $presentPercentage }}%

                                        </div>

                                        <!-- Absent -->
                                        <div class="bg-red text-black text-[7px] flex items-center justify-center transition-all duration-300"
                                            style="width: {{ $absentPercentage }}%">

                                            {{ $absentPercentage }}%

                                        </div>

                                    </div>

                                </td>


                                <td class="py-3 text-right space-x-2">

                                    <a href="{{ route('attendances.show', $attendance->id) }}"
                                        class="text-accent text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        View

                                    </a>

                                    <a href="{{ route('attendances.edit', $attendance->id) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent">

                                        Edit

                                    </a>

                                    <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                                        class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Delete attendance?')"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="py-6 text-center text-ts">

                                    No attendance found

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Pagination -->
            <div class="mt-5">

                {{ $attendances->links() }}

            </div>

        </div>

    </main>



@endsection
