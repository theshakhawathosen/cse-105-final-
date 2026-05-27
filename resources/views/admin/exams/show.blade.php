@extends('layouts.admin.admin-layout')

@section('title', 'Exam Details')

@section('content')

<main id="main-content" class="p-4 md:p-6">

    <div class="bg-card border border-bdr rounded-2xl p-6 max-w-2xl">

        <h1 class="text-2xl font-bold mb-6">
            Exam Details
        </h1>

        <div class="space-y-4">

            <div>
                <span class="font-semibold">Exam Type:</span>
                {{ $exam->exam_type }}
            </div>

            <div>
                <span class="font-semibold">Subject:</span>
                {{ $exam->subject->name }}
            </div>

            <div>
                <span class="font-semibold">Date:</span>
                {{ $exam->date }}
            </div>

        </div>

    </div>

</main>

@endsection
