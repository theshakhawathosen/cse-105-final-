@extends('layouts.student.student-layout')
@section('title', 'Subjects')
@section('content')

<!-- ═══════════════════════════════════════════════
     SUBJECTS TABLE VIEW
═══════════════════════════════════════════════ -->

<main class="pt-5 px-4 md:px-5 pb-8 mx-5" role="main">

    <!-- ── PAGE HEADER ── -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">

        <div>
            <h1 class="text-[1.15rem] md:text-[1.35rem] font-bold text-prim">
                <i class="fa-solid fa-book-open text-accent mr-2"></i>
                Subjects List
            </h1>

            <p class="text-[0.78rem] text-sec mt-1">
                All semester subjects with teacher & credits
            </p>
        </div>



    </div>

    <!-- ── TABLE ── -->
    <div class="bg-card border border-bdr rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px]">

                <!-- Head -->
                <thead class="bg-input border-b border-bdr">

                    <tr>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            #
                        </th>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            Subject
                        </th>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            Code
                        </th>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            Credit
                        </th>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            Type
                        </th>

                        <th class="text-left px-5 py-4 text-[0.72rem] font-semibold text-sec uppercase">
                            Teacher
                        </th>

                    </tr>

                </thead>

                <!-- Body -->
                <tbody>

                    @forelse ($subjects as $subject)

                        <tr class="border-b border-bdr hover:bg-white/[0.02] transition-all">

                            <!-- SL -->
                            <td class="px-5 py-4 text-[0.78rem] text-sec">
                                {{ $loop->iteration }}
                            </td>

                            <!-- Subject -->
                            <td class="px-5 py-4">

                                <div>

                                    <h3 class="text-[0.82rem] font-semibold text-prim">
                                        {{ $subject->name }}
                                    </h3>

                                </div>

                            </td>

                            <!-- Code -->
                            <td class="px-5 py-4 text-[0.78rem] text-sec">
                                {{ $subject->code ?? 'N/A' }}
                            </td>


                            <!-- Credit -->
                            <td class="px-5 py-4">

                                <span
                                    class="px-2 py-1 rounded-lg text-[10px] font-medium bg-green-500/10 text-green-500 border border-green-500/20">

                                    {{ $subject->credit ?? '0.0' }}

                                </span>

                            </td>

                            <!-- Type -->
                            <td class="px-5 py-4">

                                @if ($subject->type == 'theory')

                                    <span
                                        class="px-2 py-1 rounded-lg text-[10px] font-medium bg-blue-500/10 text-blue-500 border border-blue-500/20">

                                        Theory

                                    </span>

                                @elseif($subject->type == 'lab')

                                    <span
                                        class="px-2 py-1 rounded-lg text-[10px] font-medium bg-purple-500/10 text-purple-500 border border-purple-500/20">

                                        Lab

                                    </span>

                                @endif

                            </td>


                            <!-- Teacher -->
                            <td class="px-5 py-4">

                                @if ($subject->teacher)

                                    <div class="flex items-center gap-3">

                                        <!-- Photo -->
                                        @if ($subject->teacher->photo)

                                            <img
                                                src="{{ asset('storage/' . $subject->teacher->photo) }}"
                                                alt="{{ $subject->teacher->name }}"
                                                class="w-10 h-10 rounded-xl object-cover border border-bdr">

                                        @else

                                            <div
                                                class="w-10 h-10 rounded-xl bg-accent/10 flex items-center justify-center border border-bdr">

                                                <i class="fa-solid fa-user text-accent text-xs"></i>

                                            </div>

                                        @endif

                                        <!-- Info -->
                                        <div>

                                            <h4 class="text-[0.78rem] font-medium text-prim">
                                                {{ $subject->teacher->name }}
                                            </h4>

                                            @if ($subject->teacher->designation)
                                                <p class="text-[0.65rem] text-sec mt-[2px]">
                                                    {{ $subject->teacher->designation }}
                                                </p>
                                            @endif

                                        </div>

                                    </div>

                                @else

                                    <span class="text-[0.75rem] text-red-400">
                                        No Teacher
                                    </span>

                                @endif

                            </td>


                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-5 py-16 text-center">

                                <i class="fa-solid fa-book-open text-4xl text-hint mb-4"></i>

                                <h3 class="text-lg font-semibold text-prim mb-2">
                                    No Subjects Found
                                </h3>

                                <p class="text-sec text-sm">
                                    No subject available right now.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


</main>

@endsection
