@extends('layouts.admin.admin-layout')
@section('title', 'Feedback Details')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">

                <i class="fas fa-circle text-[6px] pulse-anim"></i>

                Feedback Details

            </span>

            <h1 class="text-xl font-bold text-tp mt-4">

                {{ $feedback->title }}

            </h1>

            <p class="text-ts text-sm">

                Submitted by
                {{ $feedback->user->name ?? 'Unknown User' }}

            </p>

        </div>

        <!-- Back -->
        <a href="{{ route('feedbacks.index') }}"
            class="btn-ghost text-xs px-4 py-2">

            Back

        </a>

    </div>

    <!-- Main Wrapper -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Left -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Feedback Details -->
            <div
                class="dash-card p-6 fade-up fade-up-d2">

                <!-- Description -->
                <div>

                    <h2
                        class="text-sm font-semibold text-tp mb-4">

                        Feedback Description

                    </h2>

                    <div
                        class="text-sm text-ts leading-relaxed whitespace-pre-line">

                        {{ $feedback->description }}

                    </div>

                </div>

            </div>

            <!-- Attachment -->
            @if($feedback->file)

                <div
                    class="dash-card p-6 fade-up fade-up-d3">

                    <div
                        class="flex items-center justify-between mb-5">

                        <h2
                            class="text-sm font-semibold text-tp">

                            Attachment Preview

                        </h2>

                        <a href="{{ asset($feedback->file) }}"
                            target="_blank"
                            class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent text-tp">

                            Open Image

                        </a>

                    </div>

                    <!-- Image -->
                    <div>

                        <img src="{{ asset($feedback->file) }}"
                            alt="Attachment"
                            onclick="openImageModal('{{ asset($feedback->file) }}')"
                            class="w-full max-h-[500px] object-cover rounded-2xl border border-border cursor-pointer hover:scale-[1.01] transition">

                    </div>

                    <p class="text-xs text-ts mt-3">

                        Click image to preview larger view

                    </p>

                </div>

            @endif

        </div>

        <!-- Right -->
        <div class="space-y-6">

            <!-- User Info -->
            <div
                class="dash-card p-5 fade-up fade-up-d2">

                <div
                    class="flex items-center gap-4 mb-5">

                    <!-- Photo -->
                    <div>

                        @if($feedback->user?->photo)

                            <img src="{{ asset($feedback->user->photo) }}"
                                alt="User Photo"
                                class="w-16 h-16 rounded-2xl object-cover border border-border">

                        @else

                            <div
                                class="w-16 h-16 rounded-2xl bg-input border border-border flex items-center justify-center text-ts">

                                <i class="fas fa-user"></i>

                            </div>

                        @endif

                    </div>

                    <!-- Name -->
                    <div>

                        <h2
                            class="text-lg font-semibold text-tp">

                            {{ $feedback->user->name ?? 'Unknown User' }}

                        </h2>

                        <p class="text-xs text-ts mt-1">

                            Feedback Sender

                        </p>

                    </div>

                </div>

                <!-- Details -->
                <div class="space-y-4">

                    <!-- Email -->
                    <div
                        class="bg-input border border-border rounded-2xl p-4">

                        <p class="text-xs text-ts">

                            Email Address

                        </p>

                        <h3
                            class="text-sm font-medium text-tp mt-2 break-all">

                            {{ $feedback->user->email ?? 'N/A' }}

                        </h3>

                    </div>

                    <!-- Phone -->
                    <div
                        class="bg-input border border-border rounded-2xl p-4">

                        <p class="text-xs text-ts">

                            Phone Number

                        </p>

                        <h3
                            class="text-sm font-medium text-tp mt-2">

                            {{ $feedback->user->phone ?? 'N/A' }}

                        </h3>

                    </div>

                    <!-- Submitted At -->
                    <div
                        class="bg-input border border-border rounded-2xl p-4">

                        <p class="text-xs text-ts">

                            Submitted At

                        </p>

                        <h3
                            class="text-sm font-medium text-tp mt-2">

                            {{ $feedback->created_at->format('d M Y h:i A') }}

                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

<!-- Image Modal -->
<div id="imageModal"
    class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center p-5">

    <!-- Close -->
    <button
        onclick="closeImageModal()"
        class="absolute top-5 right-5 text-white text-2xl hover:text-red-400">

        <i class="fas fa-times"></i>

    </button>

    <!-- Image -->
    <img id="modalImage"
        src=""
        class="max-w-full max-h-[90vh] rounded-2xl border border-white/10 shadow-2xl">

</div>

<!-- Script -->
<script>

    function openImageModal(image)
    {
        document
            .getElementById('imageModal')
            .classList
            .remove('hidden');

        document
            .getElementById('imageModal')
            .classList
            .add('flex');

        document
            .getElementById('modalImage')
            .src = image;
    }

    function closeImageModal()
    {
        document
            .getElementById('imageModal')
            .classList
            .add('hidden');

        document
            .getElementById('imageModal')
            .classList
            .remove('flex');
    }

</script>

@endsection
