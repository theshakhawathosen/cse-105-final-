@extends('layouts.admin.admin-layout')
@section('title', 'Bulk Result Create')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Results
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Bulk Result Create
                </h1>

                <p class="text-ts text-sm">
                    Add multiple student results together
                </p>

            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 fade-up fade-up-d2">


            <form action="{{ route('results.bulk.store') }}" method="POST">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Global Exam Select -->
                    <div class="mb-5 max-w-md">

                        <label class="text-ts text-xs">
                            Select Exam
                        </label>

                        <select id="globalExam" name="exam_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach ($exams as $exam)
                                <option value="{{ $exam->id }}">

                                    {{ $exam->exam_name }}

                                </option>
                            @endforeach

                        </select>

                        @error('exam_id')
                            <span class="text-red text-xs">{{ $message }}</span>
                        @enderror

                    </div>

                    <!-- Global Exam Select -->
                    <div class="mb-5 max-w-md">

                        <label class="text-ts text-xs">
                            Select Subject
                        </label>

                        <select id="globalExam" name="subject_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">

                                    {{ $subject->name }} - ({{ $subject->type }})

                                </option>
                            @endforeach

                        </select>

                        @error('subject_id')
                            <span class="text-red text-xs">{{ $message }}</span>
                        @enderror

                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead>

                            <tr class="text-ts border-b border-border">

                                <th class="py-3 text-left">
                                    Student
                                </th>

                                <th class="py-3 text-left">
                                    Marks
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($users as $key => $user)
                                <tr class="border-b border-border">

                                    <td class="py-3">
                                        <div class="flex items-center gap-3">

                                            {{-- Student Image --}}
                                            @if ($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}"
                                                    class="w-12 h-12 rounded-full object-cover border">
                                            @else
                                                <img src="{{ asset('default.png') }}" alt="{{ $user->name }}"
                                                    class="w-12 h-12 rounded-full object-cover border">
                                            @endif

                                            {{-- Student Info --}}
                                            <div>
                                                <h4 class="font-semibold text-white">
                                                    {{ $user->name }}
                                                </h4>

                                                <p class="text-sm text-gray-500">
                                                    Roll: {{ $user->roll }}
                                                </p>

                                                <p class="text-sm text-gray-500">
                                                    Reg: {{ $user->reg }}
                                                </p>
                                            </div>

                                            {{-- Hidden Input --}}
                                            <input type="hidden" name="results[{{ $key }}][user_id]"
                                                value="{{ $user->id }}">
                                        </div>
                                    </td>


                                    <!-- Marks -->
                                    <td class="py-3">

                                        <input type="number" step="0.01" required
                                            name="results[{{ $key }}][marks]" placeholder="Enter marks"
                                            class="w-full bg-input border border-border rounded-xl px-3 py-2 text-tp">

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!-- Button -->
                <div class="flex justify-end mt-5">

                    <button type="submit" class="btn-primary text-xs px-4 py-2">

                        Submit Results

                    </button>

                </div>

            </form>

        </div>

    </main>

    {{-- <script>
        const globalExam = document.getElementById('globalExam');
        const examSelects = document.querySelectorAll('.exam-select');

        globalExam.addEventListener('change', function() {

            examSelects.forEach(select => {

                select.innerHTML =
                    `<option selected>${globalExam.options[globalExam.selectedIndex].text}</option>`;

            });

        });
    </script> --}}
@endsection
