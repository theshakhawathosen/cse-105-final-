@extends('layouts.admin.admin-layout')
@section('title', 'Edit Result')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Results
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Result
                </h1>

                <p class="text-ts text-sm">
                    Update student result
                </p>

            </div>

        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST"
                action="{{ route('results.update', $result->id) }}">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Student -->
                    <div>

                        <label class="text-ts text-xs">
                            Student
                        </label>

                        <select name="user_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            @foreach($users as $user)

                                <option value="{{ $user->id }}"
                                    {{ old('user_id', $result->user_id) == $user->id ? 'selected' : '' }}>

                                    {{ $user->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('user_id')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Exam -->
                    <div>

                        <label class="text-ts text-xs">
                            Exam
                        </label>

                        <select name="exam_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}"
                                    {{ old('exam_id', $result->exam_id) == $exam->id ? 'selected' : '' }}>

                                    {{ $exam->exam_type }}
                                    -
                                    {{ $exam->subject->name ?? '-' }}

                                </option>

                            @endforeach

                        </select>

                        @error('exam_id')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Marks -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Marks
                        </label>

                        <input type="number"
                            step="0.01"
                            name="marks"
                            value="{{ old('marks', $result->marks) }}"
                            placeholder="Enter marks"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('marks')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('results.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel

                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Update Result

                    </button>

                </div>

            </form>

        </div>

    </main>
@endsection
