@extends('layouts.admin.admin-layout')

@section('title', 'Mail Settings')

@section('content')

    <main id="main-content">
        <div class="card p-5 mb-4 bg-card rounded-lg flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-start gap-4">

                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user-plus text-primary text-xl"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">
                        Invite All Students
                    </h3>

                    <p class="text-muted mt-1">
                        Send invitation emails to all students who have not yet activated their accounts.
                    </p>
                </div>

            </div>

            <a href="{{ route('admin.invite-all') }}" class="btn-primary open-modal whitespace-nowrap">
                Invite All
            </a>

        </div>

        <div class="card p-5 mb-4 bg-card rounded-lg flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-start gap-4">

                <div class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-user-plus text-primary text-xl"></i>
                </div>

                <div>
                    <h3 class="text-lg font-semibold">
                        Reset Password of a student
                    </h3>

                    <p class="text-muted mt-1">
                        Select a particular student and reset the passwords
                    </p>
                </div>

            </div>

            <form action="{{ route('admin.reset.student-password') }}" method="POST" class="flex justify-between item-center gap-4">
                @csrf
                @method('POST')
               <div>
                 <select name="student_id" class="text-white p-2 rounded-lg bg-card border border-accent" >
                    <option value="">Select Student</option>
                    @foreach ($students as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}-{{ $student->roll }}-{{ $student->email }}</option>
                    @endforeach
                </select>
                @error('student_id')
                    <small class="text-red text-xs">{{ $message }}</small>
                @enderror
               </div>
                <button onclick="return confirm('Are you sure?')" type="submit" class="btn-primary bg-red open-modal whitespace-nowrap">
                    Reset
                </button>
            </form>

        </div>
    </main>







@endsection

