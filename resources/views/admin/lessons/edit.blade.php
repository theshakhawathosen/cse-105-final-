@extends('layouts.admin.admin-layout')
@section('title', 'Edit Lesson')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Lessons
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Lesson
                </h1>

                <p class="text-ts text-sm">
                    Update lesson information
                </p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-4xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div
                    class="mb-4 bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('lessons.update', $lesson->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

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

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id', $lesson->subject_id) == $subject->id ? 'selected' : '' }}>

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

                    <!-- Date -->
                    <div>
                        <label class="text-ts text-xs">
                            Date
                        </label>

                        <input type="date" name="date"
                            value="{{ old('date', \Carbon\Carbon::parse($lesson->date)->format('Y-m-d')) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('date')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Topic -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Topic
                        </label>

                        <textarea name="topic" rows="6" placeholder="One topic per line..."
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">{{ old('topic', $lesson->topic) }}</textarea>

                        @error('topic')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Notes
                        </label>

                        <textarea name="notes" rows="8" placeholder="Write lesson notes here..."
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">{{ old('notes', $lesson->notes) }}</textarea>

                        @error('notes')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Platform -->
                    <div>
                        <label class="text-xs text-ts">
                            Platform
                        </label>

                        <select name="platform"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Platform
                            </option>

                            <option value="Online"
                                {{ old('platform', $lesson->platform) == 'Online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="Offline"
                                {{ old('platform', $lesson->platform) == 'Offline' ? 'selected' : '' }}>
                                Offline
                            </option>

                        </select>

                        @error('platform')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('lessons.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel

                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Update Lesson

                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
