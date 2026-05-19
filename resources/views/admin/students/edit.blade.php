@extends('layouts.admin.admin-layout')
@section('title', 'Edit Student')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Students
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Edit Student</h1>
                <p class="text-ts text-sm">Update student information</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="text-ts text-xs">Name</label>
                        <input type="text" name="name" value="{{ old('name', $student->name) }}"
                            placeholder="Enter full name"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('name')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-ts text-xs">Email</label>
                        <input type="email" name="email" value="{{ old('email', $student->email) }}"
                            placeholder="Enter email address"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('email')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="text-ts text-xs">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                            placeholder="Enter phone number"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('phone')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="text-ts text-xs">Role</label>
                        <input type="text" value="{{ $student->role }}" readonly
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp opacity-70">
                    </div>

                    <!-- Password (optional update) -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Password (leave blank if not changing)</label>
                        <input type="password" name="password" placeholder="Enter new password (optional)"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('password')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Photo -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Photo</label>

                        <input type="file" name="photo"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @if ($student->photo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $student->photo) }}"
                                    class="w-14 h-14 rounded-lg border border-border">
                            </div>
                        @endif

                        @error('photo')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Buttons -->
                <div class="flex justify-end gap-2 mt-5">
                    <a href="{{ route('students.index') }}" class="btn-ghost text-xs px-4 py-2">
                        Cancel
                    </a>

                    <button type="submit" class="btn-primary text-xs px-4 py-2">
                        Update Student
                    </button>
                </div>

            </form>

        </div>

    </main>
@endsection
