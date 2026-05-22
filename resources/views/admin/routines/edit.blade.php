@extends('layouts.admin.admin-layout')
@section('title', 'Edit Routine')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Routines
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Routine
                </h1>

                <p class="text-ts text-sm">
                    Update routine information
                </p>

            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST" action="{{ route('routines.update', $routine->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Routine Title
                        </label>

                        <input type="text" name="title" value="{{ old('title', $routine->title) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('title')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Type -->
                    <div>

                        <label class="text-ts text-xs">
                            Routine Type
                        </label>

                        <select name="type"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="class_routine"
                                {{ old('type', $routine->type) == 'class_routine' ? 'selected' : '' }}>

                                Class Routine
                            </option>

                            <option value="mid_exam_routine"
                                {{ old('type', $routine->type) == 'mid_exam_routine' ? 'selected' : '' }}>

                                Mid Exam Routine
                            </option>

                            <option value="final_exam_routine"
                                {{ old('type', $routine->type) == 'final_exam_routine' ? 'selected' : '' }}>

                                Final Exam Routine
                            </option>

                        </select>

                        @error('type')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- File -->
                    <div>

                        <label class="text-ts text-xs">
                            Upload New File
                        </label>

                        <input type="file" name="filepath"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @if ($routine->filepath)
                            <a href="{{ asset('storage/' . $routine->filepath) }}" target="_blank"
                                class="text-xs text-accent mt-2 inline-block hover:underline">

                                View Current File
                            </a>
                        @endif

                        @error('filepath')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('routines.index') }}" class="btn-ghost text-xs px-4 py-2">

                        Cancel
                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">

                        Update Routine
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
