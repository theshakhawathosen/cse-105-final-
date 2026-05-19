@extends('layouts.admin.admin-layout')
@section('title', 'Add Student')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Students
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Add New Student</h1>
                <p class="text-ts text-sm">Create a new student account</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('students.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Name -->
                    <div>
                        <label class="text-ts text-xs">Name</label>
                        <input type="text" name="name" placeholder="Enter full name"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            value="{{ old('name') }}">

                        @error('name')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-ts text-xs">Email</label>
                        <input type="email" name="email" placeholder="Enter email address"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            value="{{ old('email') }}">

                        @error('email')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="text-ts text-xs">Phone</label>
                        <input type="text" name="phone" placeholder="Enter phone number"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp"
                            value="{{ old('phone') }}">

                        @error('phone')
                            <p class="text-red text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="text-ts text-xs">Role</label>
                        <input type="text" name="role" value="student" readonly
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp opacity-70">
                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">
                        <label class="text-ts text-xs">Password</label>
                        <input type="password" name="password" placeholder="Create a password"
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
                        Save Student
                    </button>
                </div>

            </form>

        </div>

    </main>
@endsection
