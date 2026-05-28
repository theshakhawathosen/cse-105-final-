@extends('layouts.admin.admin-layout')
@section('title', 'Edit Notice')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Notices
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Edit Notice</h1>
                <p class="text-ts text-sm">Update notice information</p>
            </div>
        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif
            <form method="POST" action="{{ route('notices.update', $notice->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Title</label>
                        <input type="text" name="title" value="{{ old('title', $notice->title) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('title')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label class="text-ts text-xs">Category</label>

                        <select name="category"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">-- Select Category --</option>

                            @foreach (['Academic', 'Assignment', 'Lab Report', 'Exam', 'General', 'Emergency', 'Others'] as $cat)
                                <option value="{{ $cat }}"
                                    {{ old('category', $notice->category) == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach

                        </select>

                        @error('category')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label class="text-ts text-xs">Priority</label>
                        <select name="priority"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="low" {{ $notice->priority == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="normal" {{ $notice->priority == 'normal' ? 'selected' : '' }}>Normal</option>
                            <option value="high" {{ $notice->priority == 'high' ? 'selected' : '' }}>High</option>
                            <option value="urgent" {{ $notice->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>

                        </select>
                    </div>

                    <!-- Expire -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Expire At</label>
                        <input type="datetime-local" name="expire_at"
                            value="{{ $notice->expire_at ? \Carbon\Carbon::parse($notice->expire_at)->format('Y-m-d\TH:i') : '' }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">
                    </div>

                    <!-- ATTACHMENT -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Attachment</label>

                        <input type="file" name="attachment"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        <p class="text-xs text-ts mt-1">
                            PDF, DOC, DOCX, PNG, JPG allowed (Max: 5MB)
                        </p>

                        @if ($notice->attachment)
                            <div class="mt-3">
                                <a href="{{ asset('storage/' . $notice->attachment) }}" target="_blank"
                                    class="inline-flex items-center gap-2 chip chip-blue">

                                    <i class="fas fa-paperclip"></i>
                                    View Current File
                                </a>
                            </div>
                        @endif

                        @error('attachment')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Content -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Content</label>
                        <textarea name="content" rows="5" class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">{{ old('content', $notice->content) }}</textarea>

                        @error('content')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="md:col-span-2 flex flex-col gap-2 text-sm text-tp">

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_published" value="1"
                                {{ $notice->is_published ? 'checked' : '' }} class="accent-green-500">
                            Published
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_scrolling" value="1"
                                {{ $notice->is_scrolling ? 'checked' : '' }} class="accent-blue-500">
                            Scrolling
                        </label>

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">
                    <a href="{{ route('notices.index') }}" class="btn-ghost text-xs px-4 py-2">
                        Cancel
                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">
                        Update Notice
                    </button>
                </div>

            </form>

        </div>

    </main>
@endsection
