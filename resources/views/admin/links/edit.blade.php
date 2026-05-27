@extends('layouts.admin.admin-layout')
@section('title', 'Edit Link')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Links
                </span>

                <h1 class="text-xl font-bold text-tp mt-4">
                    Edit Link
                </h1>

                <p class="text-ts text-sm">
                    Update link information
                </p>

            </div>

        </div>

        <!-- Form -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            <form method="POST"
                action="{{ route('links.update', $link->id) }}">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-4">

                    <!-- Title -->
                    <div>

                        <label class="text-ts text-xs">
                            Title
                        </label>

                        <input type="text"
                            name="title"
                            value="{{ old('title', $link->title) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- URL -->
                    <div>

                        <label class="text-ts text-xs">
                            URL
                        </label>

                        <input type="url"
                            name="url"
                            value="{{ old('url', $link->url) }}"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                    </div>

                    <!-- Type -->
                    <div>

                        <label class="text-ts text-xs">
                            Type
                        </label>

                        <select name="type"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                            <option value="google classroom"
                                {{ old('type', $link->type) == 'google classroom' ? 'selected' : '' }}>

                                Google Classroom
                            </option>

                            <option value="group"
                                {{ old('type', $link->type) == 'group' ? 'selected' : '' }}>

                                Group
                            </option>

                        </select>

                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">

                    <a href="{{ route('links.index') }}"
                        class="btn-ghost text-xs px-4 py-2">

                        Cancel
                    </a>

                    <button type="submit"
                        class="btn-primary text-xs px-4 py-2">

                        Update Link
                    </button>

                </div>

            </form>

        </div>

    </main>

@endsection
