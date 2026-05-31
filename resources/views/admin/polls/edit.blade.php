@extends('layouts.admin.admin-layout')
@section('title', 'Edit Poll')

@section('content')

<main id="main-content">

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 fade-up">

        <div>

            <span class="section-label">
                <i class="fas fa-circle text-[6px] pulse-anim"></i>
                Polls
            </span>

            <h1 class="text-xl font-bold text-tp mt-4">
                Edit Poll
            </h1>

            <p class="text-ts text-sm">
                Update poll information
            </p>

        </div>

    </div>

    <!-- Form -->
    <div class="dash-card p-5 max-w-3xl mx-auto fade-up fade-up-d2">

        <form method="POST"
            action="{{ route('polls.update', $poll->id) }}">

            @csrf
            @method('PUT')

            <div class="space-y-4">

                <!-- Question -->
                <div>

                    <label class="text-ts text-xs">
                        Poll Question
                    </label>

                    <input type="text"
                        name="question"
                        value="{{ old('question', $poll->question) }}"
                        class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                </div>

                <!-- Expire -->
                <div>

                    <label class="text-ts text-xs">
                        Expire At
                    </label>

                    <input type="datetime-local"
                        name="expire_at"
                        value="{{ old('expire_at', $poll->expire_at ? \Carbon\Carbon::parse($poll->expire_at)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                </div>

                <!-- Status -->
                <div>

                    <label class="text-ts text-xs">
                        Status
                    </label>

                    <select name="status"
                        class="w-full mt-1 bg-input border border-border rounded-xl px-3 py-2 text-tp">

                        <option value="active"
                            {{ old('status', $poll->status) == 'active' ? 'selected' : '' }}>

                            Active
                        </option>

                        <option value="closed"
                            {{ old('status', $poll->status) == 'closed' ? 'selected' : '' }}>

                            Closed
                        </option>

                    </select>

                </div>

                <!-- Publish -->
                <div class="flex items-center gap-2">

                    <input type="checkbox"
                        name="is_published"
                        value="1" id="is_published"
                        {{ old('is_published', $poll->is_published) ? 'checked' : '' }}>

                    <label for="is_published" class="text-ts text-sm">
                        Publish Poll
                    </label>

                </div>

                <!-- Options -->
                <div>

                    <div class="flex items-center justify-between mb-2">

                        <label class="text-ts text-xs">
                            Poll Options
                        </label>

                        <button type="button"
                            onclick="addOption()"
                            class="text-xs px-3 py-1 rounded-lg bg-input border border-border hover:border-accent text-tp">

                            + Add Option
                        </button>

                    </div>

                    <div id="options-wrapper" class="space-y-2">

                        @foreach($poll->options as $option)

                            <div class="flex gap-2 option-item">

                                <input type="text"
                                    name="options[]"
                                    value="{{ $option->option_text }}"
                                    class="w-full bg-input border border-border rounded-xl px-3 py-2 text-tp">

                                <button type="button"
                                    onclick="removeOption(this)"
                                    class="px-3 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

            <!-- Buttons -->
            <div class="flex justify-end gap-2 mt-5">

                <a href="{{ route('polls.index') }}"
                    class="btn-ghost text-xs px-4 py-2">

                    Cancel
                </a>

                <button type="submit"
                    class="btn-primary text-xs px-4 py-2">

                    Update Poll
                </button>

            </div>

        </form>

    </div>

</main>

<script>

    function addOption() {

        let wrapper = document.getElementById('options-wrapper');

        let html = `
            <div class="flex gap-2 option-item">

                <input type="text"
                    name="options[]"
                    placeholder="Enter option"
                    class="w-full bg-input border border-border rounded-xl px-3 py-2 text-tp">

                <button type="button"
                    onclick="removeOption(this)"
                    class="px-3 rounded-xl bg-red-500/10 text-red-400 border border-red-500/20">

                    <i class="fas fa-trash"></i>

                </button>

            </div>
        `;

        wrapper.insertAdjacentHTML('beforeend', html);
    }

    function removeOption(button) {

        let items = document.querySelectorAll('.option-item');

        if(items.length <= 2) {

            alert('Minimum 2 options required');

            return;
        }

        button.parentElement.remove();
    }

</script>

@endsection
