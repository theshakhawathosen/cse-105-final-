@extends('layouts.student.student-layout')

@section('title', 'Profile')

@section('content')

    <main id="main-content" class="p-4 md:p-6">

        <!-- Header -->
        <div class="mb-6 fade-up">

                          <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                Student Profile
            </div>

            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mt-2">

                <div>
                    <h1 class="text-2xl font-bold text-prim">
                        Edit Profile
                    </h1>

                    <p class="text-sm text-sec mt-1">
                        Update all your account information from here.
                    </p>
                </div>

            </div>

        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div
                class="mb-5 rounded-2xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-400 fade-up">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Card -->
        <div class="dash-card overflow-hidden fade-up fade-up-d1">

            <!-- Top Banner -->
            <div class="h-32 bg-gradient-to-r from-accent/30 via-accent/10 to-transparent relative">

                <div class="absolute left-6 -bottom-14 flex items-end gap-5">

                    <!-- Photo -->
                    <div class="relative">

                        <img id="profilePreview"
                            src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=0D8ABC&color=fff' }}"
                            alt="Profile" class="w-28 h-28 rounded-3xl object-cover border-4 border-bg shadow-2xl">

                        <div
                            class="absolute -bottom-1 -right-1 w-9 h-9 rounded-2xl bg-accent text-white flex items-center justify-center shadow-lg">

                            <i class="fa-solid fa-camera text-sm"></i>

                        </div>

                    </div>

                    <!-- Info -->
                    <div class="pb-3">

                        <h2 class="text-2xl font-bold text-prim">
                            {{ $student->name }}
                        </h2>

                        <p class="text-sec text-sm mt-1">
                            {{ $student->email }}
                        </p>

                    </div>

                </div>

            </div>

            <!-- Form Area -->
            <div class="pt-20 p-5 md:p-7">

                <form action="{{ route('student.profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Name -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Full Name
                            </label>

                            <input type="text" name="name" value="{{ old('name', $student->name) }}"
                                class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                                placeholder="Enter full name">

                        </div>

                        <!-- Email -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Email Address
                            </label>

                            <input type="email" name="email" value="{{ old('email', $student->email) }}"
                                class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                                placeholder="Enter email address">

                        </div>

                        <!-- Phone -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Phone Number
                            </label>

                            <input type="text" name="phone" value="{{ old('phone', $student->phone) }}"
                                class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                                placeholder="01XXXXXXXXX">

                        </div>

                        <!-- Roll -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Roll Number
                            </label>

                            <input type="number" readonly name="roll" value="{{ old('roll', $student->roll) }}"
                                class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                                placeholder="Enter roll number">

                        </div>

                        <!-- Registration -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Registration Number
                            </label>

                            <input type="text" readonly name="reg" value="{{ old('reg', $student->reg) }}"
                                class="w-full h-12 rounded-2xl border border-bdr bg-card px-4 text-sm text-prim outline-none focus:border-accent transition-all"
                                placeholder="Enter registration number">

                        </div>

                        <!-- Photo -->
                        <div>

                            <label class="block text-sm font-medium text-sec mb-2">
                                Profile Photo
                            </label>

                            <input type="file" id="photoInput" name="photo"
                                class="w-full rounded-2xl border border-bdr bg-card px-4 py-[0.72rem] text-sm text-sec">

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-3 mt-8">

                        <button type="reset"
                            class="h-12 px-5 rounded-2xl border border-bdr text-sec hover:bg-card transition-all">

                            Reset

                        </button>

                        <button type="submit"
                            class="h-12 px-6 rounded-2xl bg-accent text-white font-semibold hover:opacity-90 transition-all shadow-lg shadow-accent/20">

                            Save Changes

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>
<script>

    const photoInput = document.getElementById('photoInput');
    const profilePreview = document.getElementById('profilePreview');

    photoInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (file) {

            profilePreview.src = URL.createObjectURL(file);

        }

    });

</script>
@endsection
