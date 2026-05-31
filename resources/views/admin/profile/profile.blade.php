@extends('layouts.admin.admin-layout')
@section('title', 'Admin Profile')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Profile
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">My Profile</h1>
                <p class="text-ts text-sm">Manage your account information</p>
            </div>
        </div>

        <!-- Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <!-- LEFT CARD -->
            <div class="dash-card p-5 text-center fade-up fade-up-d2">

                <div class="flex justify-center mb-4">
                    @if ($admin->photo)
                    <img src="{{ asset('storage/' . $admin->photo) }}"
                        class="w-28 h-28 rounded-2xl object-cover border border-border">
                        @else
                    <img src="{{ asset('default.png') }}"
                        class="w-28 h-28 rounded-2xl object-cover border border-border">
                    @endif
                </div>

                <h2 class="text-lg font-bold text-tp">{{ $admin->name }}</h2>
                <p class="text-ts text-sm">{{ $admin->role }}</p>

                <div class="mt-5 space-y-3 text-left">

                    <div class="bg-input border border-border rounded-xl p-3">
                        <div class="text-ts text-[10px]">ID</div>
                        <div class="text-tp font-semibold text-sm">#{{ $admin->id }}</div>
                    </div>

                    <div class="bg-input border border-border rounded-xl p-3">
                        <div class="text-ts text-[10px]">Role</div>
                        <div class="text-tp font-semibold text-sm">{{ $admin->role }}</div>
                    </div>

                </div>
            </div>

            <!-- RIGHT CARD -->
            <div class="lg:col-span-2 dash-card p-5 fade-up fade-up-d3">

                <div class="section-hd mb-4">
                    <div class="section-title">
                        <i class="fas fa-user text-accent"></i> Profile Information
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.storeProfile') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Name -->
                        <div>
                            <label class="text-ts text-xs">Name</label>
                            <input type="text" name="name" value="{{ old('name', $admin->name) }}"
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp outline-none focus:border-accent">

                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="text-ts text-xs">Email</label>
                            <input type="email" name="email" value="{{ old('email', $admin->email) }}"
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp outline-none focus:border-accent">

                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="text-ts text-xs">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}"
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp outline-none focus:border-accent">

                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Role (readonly) -->
                        <div>
                            <label class="text-ts text-xs">Role</label>
                            <input type="text" value="{{ $admin->role }}" readonly
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp opacity-70">
                        </div>

                    </div>

                    <!-- Photo Upload -->
                    <div class="mt-4">
                        <label class="text-ts text-xs">Profile Photo</label>
                        <input type="file" name="photo"
                            class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2 mt-5">
                        <button type="button" class="btn-ghost text-xs px-4 py-2">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary text-xs px-4 py-2">
                            Save Changes
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </main>
@endsection
