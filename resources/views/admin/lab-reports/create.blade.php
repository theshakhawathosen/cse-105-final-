@extends('layouts.admin.admin-layout')
@section('title', 'Add Lab Report')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Lab Reports
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Add New Lab Report
                </h1>

                <p class="text-ts text-sm">
                    Create a new lab report
                </p>

            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST"
                action="{{ route('lab-reports.store') }}"
                enctype="multipart/form-data">

                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Title -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Report Title
                        </label>

                        <input type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Enter report title"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

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
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

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

                    </div>

                    <!-- Deadline -->
                    <div>

                        <label class="text-ts text-xs">
                            Deadline
                        </label>

                        <input type="datetime-local"
                            name="deadline"
                            value="{{ old('deadline') }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- Status -->
                    <div>

                        <label class="text-ts text-xs">
                            Status
                        </label>

                        <select name="status"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="active">
                                Active
                            </option>

                            <option value="closed">
                                Closed
                            </option>

                        </select>

                    </div>

                    <!-- File -->
                    <div>

                        <label class="text-ts text-xs">
                            File
                        </label>

                        <input type="file"
                            name="file"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">

                        <label class="text-ts text-xs">
                            Description
                        </label>

                        <textarea name="description"
                            rows="5"
                            placeholder="Enter report description"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">{{ old('description') }}</textarea>

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('lab-reports.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel
                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Save Lab Report
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
