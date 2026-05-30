@extends('layouts.admin.admin-layout')
@section('title', 'Add Lesson')

@section('content')

    <main id="main-content">

        <div class="dash-card p-5 max-w-4xl mx-auto">

            <form method="POST" action="{{ route('lessons.store') }}">
                @csrf

                <div class="grid md:grid-cols-2 gap-4">

                    <!-- Subject -->
                    <div>
                        <label class="text-xs text-ts">
                            Subject
                        </label>

                        <select name="subject_id"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach ($subjects as $subject)

                                <option value="{{ $subject->id }}"
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

                    <!-- Date -->
                    <div>
                        <label class="text-xs text-ts">
                            Date
                        </label>

                        <input type="date"
                            name="date"
                            value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2">

                        @error('date')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Topic -->
                    <div class="md:col-span-2">

                        <label class="text-xs text-ts">
                            Topic
                        </label>

                        <textarea
                            name="topic"
                            rows="6"
                            placeholder="Enter lesson topic"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2">{{ old('topic') }}</textarea>

                        @error('topic')
                            <p class="text-red text-xs mt-1">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <!-- Notes -->
                    <div class="md:col-span-2">

                        <label class="text-xs text-ts">
                            Notes
                        </label>

                        <textarea
                            name="notes"
                            rows="6"
                            placeholder="Write lesson notes here..."
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2">{{ old('notes') }}</textarea>

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
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2">

                            <option value="">
                                Select Platform
                            </option>

                            <option value="Online"
                                {{ old('platform') == 'Online' ? 'selected' : '' }}>
                                Online
                            </option>

                            <option value="Offline"
                                {{ old('platform') == 'Offline' ? 'selected' : '' }}>
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
                <div class="flex justify-end mt-5">

                    <button type="submit"
                        class="btn-primary px-5 py-2 text-xs">

                        Save Lesson

                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
