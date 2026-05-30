@extends('layouts.admin.admin-layout')
@section('title', 'Add Online Class')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Online Classes
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Add Online Class
                </h1>

                <p class="text-ts text-sm">
                    Schedule a new online class
                </p>
            </div>

        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-4xl mx-auto fade-up fade-up-d2">

            @if(session('success'))
                <div
                    class="mb-4 bg-green-500/10 text-green-400 border border-green-500/20 px-4 py-3 rounded-xl text-sm">

                    {{ session('success') }}

                </div>
            @endif

            <form method="POST" action="{{ route('online-classes.store') }}">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Subject -->
                    <div>
                        <label class="text-xs text-ts">
                            Subject
                        </label>

                        <select
                            name="subject_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option
                                    value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

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

                    <!-- Platform -->
                    <div>

                        <label class="text-xs text-ts">
                            Platform
                        </label>

                        <select
                            name="platform"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="">
                                Select Platform
                            </option>

                            <option
                                value="Zoom"
                                {{ old('platform') == 'Zoom' ? 'selected' : '' }}>

                                Zoom

                            </option>

                            <option
                                value="Google Meet"
                                {{ old('platform') == 'Google Meet' ? 'selected' : '' }}>

                                Google Meet

                            </option>

                        </select>

                        @error('platform')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Date -->
                    <div>

                        <label class="text-xs text-ts">
                            Date
                        </label>

                        <input
                            type="date"
                            name="date"
                            value="{{ old('date', date('Y-m-d')) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('date')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Time -->
                    <div>

                        <label class="text-xs text-ts">
                            Time
                        </label>

                        <input
                            type="time"
                            name="time"
                            value="{{ old('time') }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('time')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Meeting Link -->
                    <div class="md:col-span-2">

                        <label class="text-xs text-ts">
                            Meeting Link
                        </label>

                        <input
                            type="url"
                            name="meeting_link"
                            value="{{ old('meeting_link') }}"
                            placeholder="https://meet.google.com/..."
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('meeting_link')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('online-classes.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel

                    </a>

                    <button
                        type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Save Class

                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
