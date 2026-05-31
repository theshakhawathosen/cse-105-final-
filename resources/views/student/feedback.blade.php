{{-- resources/views/student/feedback.blade.php --}}

@extends('layouts.student.student-layout')

@section('title', 'Feedback')

@section('content')

<main id="main-content" class="px-4 sm:px-6 lg:px-8 py-6">

    <!-- Header -->
    <div
        class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-7 animate-fadeUp">

        <div>

            <div
                class="inline-flex items-center gap-2 bg-card border border-bdr px-3 py-1.5 rounded-full text-xs text-sec">

                <span class="w-2 h-2 rounded-full bg-accent animate-pulse"></span>

                Student Feedback System

            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-prim mt-4">
                Submit Feedback
            </h1>

            <p class="text-sec text-sm mt-1">
                Share your suggestions, issues or opinions with us
            </p>

        </div>

    </div>

    <!-- Success Message -->
    @if(session('success'))

        <div
            class="mb-5 bg-grn/10 border border-grn/20 text-grn px-5 py-4 rounded-2xl animate-fadeUp">

            <div class="flex items-center gap-2">

                <i class="fas fa-check-circle"></i>

                <span class="text-sm font-medium">
                    {{ session('success') }}
                </span>

            </div>

        </div>

    @endif

    <!-- Error Message -->
    @if($errors->any())

        <div
            class="mb-5 bg-red/10 border border-red/20 text-red px-5 py-4 rounded-2xl animate-fadeUp">

            <div class="flex items-start gap-3">

                <i class="fas fa-exclamation-circle mt-1"></i>

                <div>

                    <h4 class="font-semibold mb-2">
                        Validation Errors
                    </h4>

                    <ul class="space-y-1 text-sm">

                        @foreach($errors->all() as $error)

                            <li>• {{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif

    <!-- Form Card -->
    <div
        class="bg-card border border-bdr rounded-3xl p-5 sm:p-7 shadow-lg shadow-black/10 animate-fadeUp">

        <form
            action="{{ route('student.feedback.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6">

            @csrf

            <!-- Title -->
            <div>

                <label class="block text-sm font-medium text-prim mb-2">
                    Feedback Title
                </label>

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter feedback title"
                    class="w-full bg-input border border-bdr rounded-2xl px-4 py-3 text-sm text-prim placeholder:text-sec focus:outline-none focus:border-accent transition">

            </div>

            <!-- Description -->
            <div>

                <label class="block text-sm font-medium text-prim mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="8"
                    placeholder="Write your feedback here..."
                    class="w-full bg-input border border-bdr rounded-2xl px-4 py-3 text-sm text-prim placeholder:text-sec focus:outline-none focus:border-accent transition resize-none">{{ old('description') }}</textarea>

            </div>


            <!-- Submit -->
            <div class="flex justify-end">

                <button
                    type="submit"
                    class="inline-flex items-center gap-2 bg-accent hover:bg-ahover text-white text-sm font-medium px-6 py-3 rounded-2xl transition shadow-lg shadow-accent/20">

                    <i class="fas fa-paper-plane"></i>

                    Submit Feedback

                </button>

            </div>

        </form>

    </div>

</main>

@endsection
