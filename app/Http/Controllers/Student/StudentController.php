<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use App\Models\TakeAttendance;
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

                $query->where('name', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(40);

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

    public function attendances()
    {

        $attendances = Attendance::with('subject')
            ->latest('date')
            ->paginate(10);

        // return $attendances;

        return view('student.attendances', compact('attendances'));
    }

    public function showattendance($id)
    {
        $mainattendance = Attendance::findOrFail($id);

        $subjects = Subject::orderBy('name')->get();

        $students = User::where('role', 'student')
            ->orderBy('roll', 'asc')
            ->get();

        $attendance = Attendance::where('subject_id', $mainattendance->subject_id)
            ->whereDate('date', $mainattendance->date)
            ->first();

        $presentStudents = [];

        if ($attendance) {

            $presentStudents = TakeAttendance::where('attendance_id', $attendance->id)
                ->where('status', 'present')
                ->pluck('user_id')
                ->toArray();
        }

        // Present Student List
        $presentStudentList = User::where('role', 'student')
            ->whereIn('id', $presentStudents)
            ->orderBy('roll', 'asc')
            ->get();

        // Absent Student List
        $absentStudentList = User::where('role', 'student')
            ->whereNotIn('id', $presentStudents)
            ->orderBy('roll', 'asc')
            ->get();

        return view(
            'student.show-attendance',
            compact(
                'attendance',
                'subjects',
                'students',
                'presentStudents',
                'presentStudentList',
                'absentStudentList'
            )
        );
    }
}
