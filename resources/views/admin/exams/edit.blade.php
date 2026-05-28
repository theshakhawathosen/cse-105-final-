@extends('layouts.admin.admin-layout')
@section('title', 'Edit Exam')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Exams
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Exam
                </h1>

                <p class="text-ts text-sm">
                    Update exam information
                </p>

            </div>

        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST"
                action="{{ route('exams.update', $exam->id) }}">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Exam Name -->
                    <div>

                        <label class="text-ts text-xs">
                            Exam Name
                        </label>

                        <input type="text" name="exam_name" placeholder="Example: CT 1"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            value="{{ old('exam_name',$exam->exam_name) }}">

                        @error('exam_name')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>
                    <!-- Exam Type -->
                    <div>

                        <label class="text-ts text-xs">
                            Exam Type
                        </label>

                        <select name="exam_type"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="CT"
                                {{ old('exam_type', $exam->exam_type) == 'CT' ? 'selected' : '' }}>
                                CT
                            </option>

                            <option value="Mid"
                                {{ old('exam_type', $exam->exam_type) == 'Mid' ? 'selected' : '' }}>
                                Mid
                            </option>

                            <option value="Final"
                                {{ old('exam_type', $exam->exam_type) == 'Final' ? 'selected' : '' }}>
                                Final
                            </option>

                        </select>

                        @error('exam_type')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    <!-- Date -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Exam Date
                        </label>

                        <input type="date"
                            name="date"
                            value="{{ old('date', $exam->date) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('date')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('exams.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel

                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Update Exam

                    </button>

                </div>

            </form>

        </div>

    </main>
@endsection
