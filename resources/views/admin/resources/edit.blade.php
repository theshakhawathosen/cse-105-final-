@extends('layouts.admin.admin-layout')
@section('title', 'Edit Resource')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Resources
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Resource
                </h1>

                <p class="text-ts text-sm">
                    Update resource information
                </p>

            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl text-sm">

                    {{ session('success') }}

                </div>
            @endif

            <form method="POST" action="{{ route('resources.update', $resource->id) }}" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Resource Title
                        </label>

                        <input type="text" name="title" value="{{ old('title', $resource->title) }}"
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

                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $resource->subject_id) == $subject->id ? 'selected' : '' }}>

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

                            <option value="notes" {{ old('category', $resource->category) == 'notes' ? 'selected' : '' }}>
                                Notes</option>

                            <option value="slides" {{ old('category', $resource->category) == 'slides' ? 'selected' : '' }}>
                                Slides</option>

                            <option value="book" {{ old('category', $resource->category) == 'book' ? 'selected' : '' }}>
                                Book</option>

                            <option value="lab_manual"
                                {{ old('category', $resource->category) == 'lab_manual' ? 'selected' : '' }}>Lab Manual
                            </option>

                            <option value="assignment_solution"
                                {{ old('category', $resource->category) == 'assignment_solution' ? 'selected' : '' }}>
                                Assignment Solution</option>

                            <option value="question_bank"
                                {{ old('category', $resource->category) == 'question_bank' ? 'selected' : '' }}>Question
                                Bank</option>

                            <option value="tutorial"
                                {{ old('category', $resource->category) == 'tutorial' ? 'selected' : '' }}>Tutorial
                            </option>

                            <option value="others"
                                {{ old('category', $resource->category) == 'others' ? 'selected' : '' }}>Others</option>

                        </select>

                    </div>

                    <!-- Upload New Files -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Upload New Files
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

                    <!-- Existing Files -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs mb-2 block">
                            Existing Files
                        </label>

                        @if ($resource->files->count())

                            <div class="space-y-2">

                                @foreach ($resource->files as $file)
                                    <div
                                        class="flex items-center justify-between bg-input border border-border rounded-lg px-3 py-2">

                                        <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                            class="text-xs text-accent hover:underline">

                                            {{ $file->original_name }}

                                        </a>

                                        <!-- Delete Single File -->
                                        <a href="{{ route('resource-files.destroy', $file->id) }}"
                                            onclick="return confirm('Remove this file?')"
                                            class="text-red-400 text-xs hover:underline">

                                            Remove
                                        </a>


                                    </div>
                                @endforeach

                            </div>
                        @else
                            <p class="text-xs text-ts mt-2">
                                No files uploaded
                            </p>

                        @endif

                    </div>
                    <!-- Link -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            External Link
                        </label>

                        <input type="url" name="link" value="{{ old('link', $resource->link) }}"
                            placeholder="https://example.com"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- Published -->
                    <div class="md:col-span-2">

                        <label class="flex items-center gap-2 text-sm text-ts">

                            <input type="checkbox" name="is_published"
                                {{ old('is_published', $resource->is_published) ? 'checked' : '' }}>

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

                        Update Resource

                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
