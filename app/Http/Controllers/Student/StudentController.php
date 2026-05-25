<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

 public function classmate(Request $request)
    {
        $search = $request->search;

        $classmates = User::query()

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('roll', 'like', "%{$search}%")
                    ->orWhere('reg', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(12);

        $totalStudents = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $totalOnlyStudents = User::where('role', 'student')->count();

        $withPhone = User::whereNotNull('phone')->count();

        return view('student.classmate', compact(
            'classmates',
            'totalStudents',
            'totalAdmins',
            'totalOnlyStudents',
            'withPhone'
        ));
    }
}
