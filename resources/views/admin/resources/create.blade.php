@extends('layouts.admin.admin-layout')
@section('title', 'Add Resource')

@section('content')

    <main id="main-content">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Resources
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Add New Resource
                </h1>

                <p class="text-ts text-sm">
                    Upload academic resources
                </p>

            </div>

        </div>

        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Resource Title
                        </label>

                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('title')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- Subject -->
                    <div>

                        <label class="text-ts text-xs">
                            Subject
                        </label>

                        <select name="subject_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">

                                    {{ $subject->name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    <!-- Category -->
                    <div>

                        <label class="text-ts text-xs">
                            Category
                        </label>

                        <select name="category"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="notes">Notes</option>
                            <option value="slides">Slides</option>
                            <option value="book">Book</option>
                            <option value="lab_manual">Lab Manual</option>
                            <option value="assignment_solution">Assignment Solution</option>
                            <option value="question_bank">Question Bank</option>
                            <option value="tutorial">Tutorial</option>
                            <option value="others">Others</option>

                        </select>

                    </div>

                    <!-- Multiple Files -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Upload Files
                        </label>

                        <input type="file" name="files[]" multiple
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('files')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror

                        @error('files.*')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- Link -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            External Link
                        </label>

                        <input type="url" name="link" value="{{ old('link') }}" placeholder="https://example.com"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- Published -->
                    <div class="md:col-span-2">

                        <label class="flex items-center gap-2 text-sm text-ts">

                            <input type="checkbox" name="is_published" checked>

                            Published

                        </label>

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('resources.index') }}" class="btn-ghost text-xs px-4 py-2">

                        Cancel

                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">

                        Save Resource

                    </button>

                </div>

            </form>

        </div>

    </main>
@endsection
