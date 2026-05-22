@extends('layouts.admin.admin-layout')

@section('title', 'Routines')

@section('content')

    <main id="main-content">

        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

            <div>

                <span class="section-label">

                    <i class="fas fa-circle text-[6px] pulse-anim"></i>
                    Routines

                </span>

                <h1 class="text-xl font-bold text-tp mt-4">

                    Routine List

                </h1>

                <p class="text-ts text-sm">

                    Manage all routines

                </p>

            </div>

        </div>

        <!-- Card Container -->
        <div class="dash-card p-5 fade-up fade-up-d2">

            @if (session('success'))
                <div class="mb-4 bg-green-500/10 border border-green-500/20 text-green-400 px-4 py-3 rounded-xl text-sm">

                    {{ session('success') }}

                </div>
            @endif

            <!-- Top -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-5">

                <h2 class="text-tp font-semibold text-sm">

                    All Routines

                </h2>

                <a href="{{ route('routines.create') }}" class="btn-primary text-xs px-4 py-2">

                    <i class="fas fa-plus mr-1"></i>
                    Add Routine

                </a>

            </div>

            <!-- Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                @forelse($routines as $routine)
                    <div
                        class="dash-card border border-border overflow-hidden hover:border-accent/40 transition duration-300">

                        <!-- Image -->
                        <div class="relative h-48 bg-input overflow-hidden">

                            @if ($routine->filepath)
                                <img src="{{ asset('storage/' . $routine->filepath) }}" alt="{{ $routine->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            @else
                                <img src="https://placehold.co/600x400/111827/9ca3af?text=Routine" alt="Routine"
                                    class="w-full h-full object-cover">
                            @endif

                            <!-- Type Badge -->
                            <div class="absolute top-3 right-3">

                                <span
                                    class="px-2 py-1 text-[10px] rounded-lg bg-black/40 backdrop-blur border border-white/10 text-white capitalize">

                                    {{ str_replace('_', ' ', $routine->type) }}

                                </span>

                            </div>

                        </div>

                        <!-- Content -->
                        <div class="p-4 space-y-4">

                            <!-- Title -->
                            <div>

                                <h3 class="text-base font-semibold text-tp line-clamp-1">

                                    {{ $routine->title }}

                                </h3>

                                <p class="text-xs text-ts mt-1">

                                    Routine ID: #{{ $routine->id }}

                                </p>

                            </div>

                            <!-- File -->
                            <div>

                                <a href="{{ asset('storage/' . $routine->filepath) }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-accent hover:underline text-xs">

                                    <i class="fas fa-file-alt"></i>

                                    View File

                                </a>

                            </div>

                            <!-- Actions -->
                            <div class="flex items-center justify-end gap-2 pt-2">

                                <a href="{{ route('routines.edit', $routine->id) }}"
                                    class="text-xs px-3 py-2 rounded-lg bg-input border border-border hover:border-accent transition">

                                    <i class="fas fa-pen mr-1"></i>

                                    Edit

                                </a>

                                <form action="{{ route('routines.destroy', $routine->id) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                        class="text-xs px-3 py-2 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500/20 transition">

                                        <i class="fas fa-trash mr-1"></i>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-span-full">

                        <div class="dash-card p-10 text-center border border-border">

                            <div
                                class="w-16 h-16 mx-auto rounded-2xl bg-input border border-border flex items-center justify-center mb-4">

                                <i class="fas fa-folder-open text-ts text-xl"></i>

                            </div>

                            <h3 class="text-tp font-semibold mb-1">

                                No routines found

                            </h3>

                            <p class="text-ts text-sm">

                                Add your first routine to get started.

                            </p>

                        </div>

                    </div>
                @endforelse

            </div>

        </div>

    </main>

@endsection
