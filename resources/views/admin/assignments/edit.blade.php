@extends('layouts.admin.admin-layout')
@section('title', 'Edit Assignment')

@section('content')

    <main id="main-content">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Assignments
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Assignment
                </h1>

                <p class="text-ts text-sm">
                    Update assignment information
                </p>
            </div>

        </div>

        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST"
                action="{{ route('assignments.update', $assignment->id) }}"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Assignment Title
                        </label>

                        <input type="text" name="title"
                            value="{{ old('title', $assignment->title) }}"
                            class="w-full mt-1 bg-input border @error('title') border-red-500 @else border-border @enderror rounded-xl px-3 py-2 text-tp">

                        @error('title')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Subject -->
                    <div>

                        <label class="text-ts text-xs">
                            Subject
                        </label>

                        <select name="subject_id"
                            class="w-full mt-1 bg-input border @error('subject_id') border-red-500 @else border-border @enderror rounded-xl px-3 py-2 text-tp">

                            @foreach ($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $assignment->subject_id) == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('subject_id')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Deadline -->
                    <div>

                        <label class="text-ts text-xs">
                            Deadline
                        </label>

                        <input type="date" name="deadline"
                            value="{{ old('deadline', $assignment->deadline) }}"
                            class="w-full mt-1 bg-input border @error('deadline') border-red-500 @else border-border @enderror rounded-xl px-3 py-2 text-tp">

                        @error('deadline')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- File -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Assignment File
                        </label>

                        <input type="file" name="file"
                            class="w-full mt-1 bg-input border @error('file') border-red-500 @else border-border @enderror rounded-xl px-3 py-2 text-tp">

                        @error('file')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                        @if($assignment->file)

                            <a href="{{ asset('uploads/assignments/' . $assignment->file) }}"
                                target="_blank"
                                class="text-xs text-accent mt-2 inline-block">

                                View Current File
                            </a>

                        @endif

                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Description
                        </label>

                        <textarea name="description" rows="5"
                            class="w-full mt-1 bg-input border @error('description') border-red-500 @else border-border @enderror rounded-xl px-3 py-2 text-tp">{{ old('description', $assignment->description) }}</textarea>

                        @error('description')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('assignments.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel
                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Update Assignment
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
