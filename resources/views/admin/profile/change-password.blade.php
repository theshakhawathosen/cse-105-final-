@extends('layouts.admin.admin-layout')
@section('title', 'Change Password')

@section('content')
    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">
            <div>
                <span class="section-label">
                    <i class="fas fa-circle text-[6px] pulse-anim"></i> Security
                </span>
                <h1 class="text-xl font-bold text-tp mt-4">Change Password</h1>
                <p class="text-ts text-sm">Update your account password securely</p>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            <div class="dash-card p-5 fade-up fade-up-d2">

                <div class="section-hd mb-4">
                    <div class="section-title">
                        <i class="fas fa-lock text-accent"></i> Password Settings
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.updatePassword') }}">
                    @csrf

                    <div class="space-y-4">

                        <!-- New Password -->
                        <div>
                            <label class="text-ts text-xs">New Password</label>
                            <input type="password" name="password"
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp outline-none focus:border-accent"
                                placeholder="Enter new password">

                            @error('password')
                                <p class="text-red text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="text-ts text-xs">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp outline-none focus:border-accent"
                                placeholder="Confirm new password">

                            @error('password_confirmation')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end gap-2 mt-5">
                        <button type="reset" class="btn-ghost text-xs px-4 py-2">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary text-xs px-4 py-2">
                            Update Password
                        </button>
                    </div>
                </form>

            </div>
        </div>

    </main>
@endsection
