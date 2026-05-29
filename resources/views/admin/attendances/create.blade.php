@extends('layouts.admin.admin-layout')
@section('title', 'Take Attendance')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">
                <i class="fas fa-circle text-[6px] pulse-anim"></i>
                Attendance
            </span>

            <h1 class="text-xl font-bold text-tp mt-4">
                Take Attendance
            </h1>

            <p class="text-ts text-sm">
                Manage student attendance
            </p>

        </div>

    </div>

    <!-- Form -->
    <div class="dash-card p-5 fade-up fade-up-d2">

        <form method="POST"
            action="{{ route('attendances.store') }}">

            @csrf

            <!-- Top -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                <!-- Subject -->
                <div>

                    <label class="text-ts text-xs">
                        Select Subject
                    </label>

                    <select name="subject_id" required
                        class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        <option value="">
                            Select Subject
                        </option>

                        @foreach($subjects as $subject)

                            <option value="{{ $subject->id }}">
                                {{ $subject->name }}
                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Date -->
                <div>

                    <label class="text-ts text-xs">
                        Attendance Date
                    </label>

                    <input type="date" required
                        name="date"
                        value="{{ now()->format('Y-m-d') }}"
                        class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                </div>

            </div>

            <!-- Students -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">

                @foreach($students as $student)

                    <label class="student-card cursor-pointer">

                        <input type="checkbox"
                            name="students[]"
                            value="{{ $student->id }}"
                            class="hidden attendance-checkbox">

                        <div class="attendance-ui bg-red/10 border border-red/20 rounded-2xl p-4 text-center transition-all duration-300">

                            <!-- Checkbox -->
                            <div class="checkbox-ui w-8 h-8 rounded-xl border-2 border-red/30 mx-auto flex items-center justify-center transition-all duration-300">

                                <i class="fas fa-check text-white text-sm hidden check-icon"></i>

                            </div>

                            <!-- Photo -->
                            <div class="w-16 h-16 rounded-2xl overflow-hidden mx-auto mt-4 border border-border">

                                @if ($student->photo)
                                <img src="{{ asset('storage/'.$student->photo ?? 'default.png') }}"
                                    class="w-full h-full object-cover">
                                    @else

                                <img src="{{ asset('default.png') }}"
                                    class="w-full h-full object-cover">
                                @endif

                            </div>

                            <!-- Roll -->
                            <h2 class="text-lg font-bold text-tp mt-3">
                                {{ $student->roll }}
                            </h2>

                            <!-- Name -->
                            <p class="text-xs text-ts mt-1 line-clamp-1">
                                {{ $student->name }}
                            </p>

                            <!-- Status -->
                            <div class="mt-3">

                                <span class="status-badge text-[10px] px-3 py-1 rounded-full bg-red/20 text-red border border-red/20">

                                    Absent

                                </span>

                            </div>

                        </div>

                    </label>

                @endforeach

            </div>

            <!-- Submit -->
            <div class="flex justify-end mt-6">

                <button type="submit"
                    class="btn-primary text-xs px-5 py-2">

                    Submit Attendance

                </button>

            </div>

        </form>

    </div>

</main>

<script>

const checkboxes =
    document.querySelectorAll('.attendance-checkbox');

checkboxes.forEach((checkbox) =>
{
    checkbox.addEventListener('change', function()
    {
        const card =
            this.closest('.student-card');

        const ui =
            card.querySelector('.attendance-ui');

        const badge =
            card.querySelector('.status-badge');

        const checkboxUI =
            card.querySelector('.checkbox-ui');

        const checkIcon =
            card.querySelector('.check-icon');

        if(this.checked)
        {
            ui.classList.remove(
                'bg-red/10',
                'border-red/20'
            );

            ui.classList.add(
                'bg-green/10',
                'border-green/20'
            );

            checkboxUI.classList.remove(
                'border-red/30'
            );

            checkboxUI.classList.add(
                'bg-green',
                'border-green'
            );

            checkIcon.classList.remove('hidden');

            badge.innerText = 'Present';

            badge.classList.remove(
                'bg-red/20',
                'text-red',
                'border-red/20'
            );

            badge.classList.add(
                'bg-green/20',
                'text-green',
                'border-green/20'
            );
        }
        else
        {
            ui.classList.remove(
                'bg-green/10',
                'border-green/20'
            );

            ui.classList.add(
                'bg-red/10',
                'border-red/20'
            );

            checkboxUI.classList.remove(
                'bg-green',
                'border-green'
            );

            checkboxUI.classList.add(
                'border-red/30'
            );

            checkIcon.classList.add('hidden');

            badge.innerText = 'Absent';

            badge.classList.remove(
                'bg-green/20',
                'text-green',
                'border-green/20'
            );

            badge.classList.add(
                'bg-red/20',
                'text-red',
                'border-red/20'
            );
        }
    });
});

</script>

@endsection
