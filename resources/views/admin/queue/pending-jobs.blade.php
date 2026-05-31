@extends('layouts.admin.admin-layout')

@section('title', 'Pending Queue Jobs')

@section('content')

<main id="main-content">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 mb-6 fade-up">

        <div>
            <span class="section-label">
                <i class="fas fa-clock"></i>
                Queue Monitor
            </span>
            <h1 class="section-title">Pending Jobs</h1>
            <p class="section-subtitle">
                Jobs waiting to be processed by queue workers.
            </p>
        </div>

        <div class="badge badge-warning mt-1">
            <i class="fas fa-spinner"></i>
            {{ $jobs->total() }} Pending Jobs
        </div>

    </div>

    {{-- Table Card --}}
    <div class="card overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full">

                <thead>
                    <tr class="border-b border-bdr">
                        <th class="text-left p-4 whitespace-nowrap w-20">#</th>
                        <th class="text-left p-4">Queue</th>
                        <th class="text-left p-4 whitespace-nowrap">Attempts</th>
                        <th class="text-left p-4 whitespace-nowrap">Reserved</th>
                        <th class="text-left p-4 whitespace-nowrap">Created</th>
                        <th class="text-center p-4 w-24">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($jobs as $job)

                        <tr class="border-b border-bdr hover:bg-card-hover transition-colors">

                            <td class="p-4 font-mono text-sm text-muted">
                                #{{ $job->id }}
                            </td>

                            <td class="p-4">
                                <span class="badge badge-primary">
                                    {{ $job->queue }}
                                </span>
                            </td>

                            <td class="p-4 text-muted text-sm">
                                {{ $job->attempts }}
                            </td>

                            <td class="p-4 text-muted text-sm whitespace-nowrap">
                                {{ $job->reserved_at
                                    ? \Carbon\Carbon::createFromTimestamp($job->reserved_at)->diffForHumans()
                                    : 'Waiting'
                                }}
                            </td>

                            <td class="p-4 text-muted text-sm whitespace-nowrap">
                                {{ \Carbon\Carbon::createFromTimestamp($job->available_at)->diffForHumans() }}
                            </td>

                            <td class="p-4">
                                <div class="flex justify-center items-center gap-2">

                                    <button
                                        onclick="showPayload(`{{ base64_encode($job->payload) }}`)"
                                        class="btn-secondary btn-sm"
                                        title="View Payload">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <form action="{{ route('admin.delete.job',$job->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure?')"
                                            type="submit"
                                            class="btn-danger btn-sm"
                                            title="Delete Job">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center py-16">
                                <i class="fas fa-check-circle text-green-500 text-4xl mb-3 block"></i>
                                <h3 class="font-semibold text-lg mb-1">No Pending Jobs</h3>
                                <p class="text-muted">Queue is currently empty.</p>
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        <div class="p-4 border-t border-bdr flex items-center justify-between">
            <span class="text-muted text-sm">
                Showing {{ $jobs->firstItem() }}–{{ $jobs->lastItem() }} of {{ $jobs->total() }} jobs
            </span>
            {{ $jobs->links() }}
        </div>

    </div>

</main>

{{-- Payload Modal --}}
<div id="payloadModal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4"
     onclick="closePayload()">

    <div class="bg-card rounded-xl p-6 max-w-3xl w-full"
         onclick="event.stopPropagation()">

        <div class="flex items-center justify-between mb-4">
            <h3 class="font-semibold text-lg">Job Payload</h3>
            <button
                onclick="closePayload()"
                class="btn-secondary btn-sm"
                title="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <pre id="payloadContent"
             class="bg-muted p-4 rounded-lg overflow-auto max-h-96 text-sm font-mono leading-relaxed"></pre>

    </div>

</div>

<script>
    function showPayload(b64) {
        try {
            const raw = atob(b64);
            const parsed = JSON.parse(raw);
            document.getElementById('payloadContent').textContent =
                JSON.stringify(parsed, null, 2);
        } catch {
            document.getElementById('payloadContent').textContent = atob(b64);
        }

        document.getElementById('payloadModal')
            .classList.replace('hidden', 'flex');
    }

    function closePayload() {
        document.getElementById('payloadModal')
            .classList.replace('flex', 'hidden');
    }

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closePayload();
    });
</script>

@endsection
