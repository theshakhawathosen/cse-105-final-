@extends('layouts.student.student-layout') @section('title', 'Change Password') @section('content') <main id="main-content" class="p-4 md:p-6">
    <!-- Header -->
    <div class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

        <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

        Security Settings

    </div>
    <h1 class="text-2xl font-bold text-prim mt-2"> Change Password </h1>
    <p class="text-sm text-sec mt-1"> Update your account password securely. </p>
    </div> 
    <!-- Card -->
    <div class="max-w-2xl">
        <div class="dash-card p-5 md:p-7 fade-up fade-up-d1">
            <form action="{{ route('student.change.password.update') }}" method="POST"> @csrf @method('PUT') <div
                    class="space-y-5"> <!-- Current Password -->
                    <div> <label class="block text-sm font-medium text-sec mb-2"> Current Password </label> <input
                            type="password" name="current_password"
                            class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                            placeholder="Enter current password"> @error('current_password')
                            <p class="text-red text-xs mt-2"> {{ $message }} </p>
                        @enderror
                    </div> <!-- New Password -->
                    <div> <label class="block text-sm font-medium text-sec mb-2"> New Password </label> <input
                            type="password" name="password"
                            class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                            placeholder="Enter new password"> @error('password')
                            <p class="text-red text-xs mt-2"> {{ $message }} </p>
                        @enderror
                    </div> <!-- Confirm Password -->
                    <div> <label class="block text-sm font-medium text-sec mb-2"> Confirm Password </label> <input
                            type="password" name="password_confirmation"
                            class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                            placeholder="Confirm new password"> </div>
                </div> <!-- Buttons -->
                <div class="flex items-center justify-end gap-3 mt-8"> <button type="reset"
                        class="h-12 px-5 rounded-2xl border border-bdr text-sec hover:bg-card transition-all"> Reset
                    </button> <button type="submit"
                        class="h-12 px-6 rounded-2xl bg-accent text-white font-semibold hover:opacity-90 transition-all shadow-lg shadow-accent/20">
                        Update Password </button> </div>
            </form>
        </div>
    </div>
</main> @endsection
