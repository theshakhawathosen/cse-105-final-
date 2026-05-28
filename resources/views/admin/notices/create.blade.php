@extends('layouts.admin.admin-layout')
@section('title', 'Add Notice')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Notices
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Create Notice</h1>
                <p class="text-ts text-sm">Add a new notice for students & teachers</p>
            </div>
        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('notices.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- TITLE -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Title</label>

                        <input type="text" name="title" value="{{ old('title') }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            placeholder="Enter notice title">

                        @error('title')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CATEGORY -->
                    <div>
                        <label class="text-ts text-xs">Category</label>

                        <select name="category"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">-- Select Category --</option>

                            @foreach (['Academic', 'Assignment', 'Lab Report', 'Exam', 'General', 'Emergency', 'Others'] as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach

                        </select>

                        @error('category')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- PRIORITY -->
                    <div>
                        <label class="text-ts text-xs">Priority</label>

                        <select name="priority"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="normal" {{ old('priority', 'normal') == 'normal' ? 'selected' : '' }}>Normal
                            </option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>

                        </select>

                        @error('priority')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- EXPIRE -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Expire At (optional)</label>

                        <input type="datetime-local" name="expire_at" value="{{ old('expire_at') }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('expire_at')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- ATTACHMENT -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Attachment (optional)</label>

                        <input type="file" name="attachment"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        <p class="text-xs text-ts mt-1">
                            PDF, DOC, DOCX, PNG, JPG allowed (Max: 5MB)
                        </p>

                        @error('attachment')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CONTENT -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Content</label>

                        <textarea name="content" rows="5" class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            placeholder="Write notice details...">{{ old('content') }}</textarea>

                        @error('content')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- CHECKBOXES -->
                    <div class="md:col-span-2 flex flex-col gap-2 text-sm text-tp">

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" value="1"
                                {{ old('is_published') ? 'checked' : '' }} class="accent-green-500">
                            Publish Now
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_scrolling" value="1"
                                {{ old('is_scrolling') ? 'checked' : '' }} class="accent-blue-500">
                            Enable Scrolling
                        </label>

                    </div>

                </div>

                <!-- BUTTONS -->
                <div class="flex justify-end gap-2 mt-5">
                    <a href="{{ route('notices.index') }}" class="btn-ghost text-xs px-4 py-2">
                        Cancel
                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">
                        Save Notice
                    </button>
                </div>

            </form>

        </div>

    </main>
@endsection
