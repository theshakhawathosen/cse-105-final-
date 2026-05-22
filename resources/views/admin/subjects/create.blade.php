@extends('layouts.admin.admin-layout')
@section('title', 'Add Subject')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Subjects
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Add New Subject
                </h1>

                <p class="text-ts text-sm">
                    Create a new subject
                </p>
            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST" action="{{ route('subjects.store') }}">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="text-ts text-xs">
                            Subject Name
                        </label>

                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter subject name"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('name')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Code -->
                    <div>
                        <label class="text-ts text-xs">
                            Subject Code
                        </label>

                        <input type="text" name="code" value="{{ old('code') }}" placeholder="Enter subject code"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('code')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Teacher -->
                    <div>
                        <label class="text-ts text-xs">
                            Teacher
                        </label>

                        <select name="teacher_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Teacher
                            </option>

                            @foreach ($teachers as $teacher)
                                <option value="{{ $teacher->id }}"
                                    {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>

                                    {{ $teacher->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('teacher_id')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Credit -->
                    <div>
                        <label class="text-ts text-xs">
                            Credit
                        </label>

                        <input type="number" step="0.5" name="credit" value="{{ old('credit') }}"
                            placeholder="Enter subject credit"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('credit')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Subject Type
                        </label>

                        <select name="type"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="theory" {{ old('type') == 'theory' ? 'selected' : '' }}>
                                Theory
                            </option>

                            <option value="lab" {{ old('type') == 'lab' ? 'selected' : '' }}>
                                Lab
                            </option>

                        </select>

                        @error('type')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('subjects.index') }}" class="btn-ghost text-xs px-4 py-2">

                        Cancel
                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">

                        Save Subject
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
