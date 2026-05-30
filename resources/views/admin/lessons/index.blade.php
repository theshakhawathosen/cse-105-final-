@extends('layouts.admin.admin-layout')
@section('title', 'Lessons')

@section('content')

    <main id="main-content">

        <div class="flex justify-between items-center mb-6">

            <div>
                <span class="section-label">
                    Lessons
                </span>

                <h1 class="text-xl font-bold text-tp mt-3">
                    Lesson List
                </h1>
            </div>

            <a href="{{ route('lessons.create') }}" class="btn-primary px-4 py-2 text-xs">

                Add Lesson

            </a>

        </div>

        <div class="dash-card p-5">

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b border-border text-ts">
                            <th class="py-3 text-left">Subject</th>
                            <th class="py-3 text-left">Topic</th>
                            <th class="py-3 text-left">Date</th>
                            <th class="py-3 text-left">Platform</th>
                            <th class="py-3 text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($lessons as $lesson)

                            <tr class="border-b border-border">

                                <td class="py-3">
                                    {{ $lesson->subject->name }}
                                </td>

                                <td class="py-3">
                                    <ol style="list-style: disc">
                                        @foreach (explode("\n", $lesson->topic) as $topic)
                                            <li>{{ $topic }}</li>
                                        @endforeach
                                    </ol>
                                </td>

                                <td class="py-3">
                                    {{ $lesson->date }}
                                </td>
                                <td class="py-3">
                                    {{ $lesson->platform }}
                                </td>

                                <td class="py-3 text-right">

                                    <a href="{{ route('lessons.edit', $lesson) }}"
                                        class="text-xs px-3 py-1 rounded-lg bg-input border border-border">

                                        Edit

                                    </a>

                                    <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" onclick="return confirm('Delete?')"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-500/10 text-red-400">

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="py-5 text-center text-ts">

                                    No lessons found

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </main>

@endsection
