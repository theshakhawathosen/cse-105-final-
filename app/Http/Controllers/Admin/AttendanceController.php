<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Subject;
use App\Models\TakeAttendance;
use App\Models\TakeAttendence;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * History page
     */
    public function index(Request $request)
    {
        $attendances = Attendance::with('subject')
            ->latest('date')
            ->paginate(10);

        // return $attendances;

        return view('admin.attendances.index', compact('attendances'));
    }

    // /**
    //  * Create page
    //  */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get();

        $students = User::where('role', 'student')
            ->orderBy('roll', 'asc')
            ->get();

        return view(
            'admin.attendances.create',
            compact('subjects', 'students')
        );
    }

    // /**
    //  * Store attendance
    //  */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
        ]);

        $students = User::where('role', 'student')->get();

        // Create Attendence Row
        $attendance = Attendance::updateOrCreate(
            [
                'subject_id' => $request->subject_id,
                'date' => $request->date,
            ],
            [
                'subject_id' => $request->subject_id,
                'date' => $request->date,
            ]
        );

        foreach ($students as $student) {
            TakeAttendance::updateOrCreate(

                [
                    'subject_id' => $request->subject_id,
                    'user_id' => $student->id,
                    'attendance_id' => $attendance->id,
                    'date' => $request->date,
                ],

                [
                    'status' => in_array(
                        $student->id,
                        $request->students ?? []
                    )
                        ? 'present'
                        : 'absent',
                ]
            );
        }

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Attendance submitted successfully.'
            );
    }

    // /**
    //  * Show page
    //  */
public function show(string $id)
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
        'admin.attendances.show',
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


    // /**
    //  * Edit page
    //  */
    public function edit(string $id)
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

        return view('admin.attendances.edit', compact('attendance', 'subjects', 'students', 'presentStudents'));
    }

    // /**
    //  * Update attendance
    //  */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'date' => 'required|date',
        ]);

        $students = User::where('role', 'student')->get();

        // TakeAttendance::where('subject_id', $request->subject_id)
        //     ->where('date', $request->date)
        //     ->delete();
        // Create Attendence Row
        $attendance = Attendance::updateOrCreate(
            [
                'subject_id' => $request->subject_id,
                'date' => $request->date,
            ],
            [
                'subject_id' => $request->subject_id,
                'date' => $request->date,
            ]
        );

        foreach ($students as $student) {
            TakeAttendance::updateOrCreate(

                [
                    'subject_id' => $request->subject_id,
                    'user_id' => $student->id,
                    'attendance_id' => $attendance->id,
                    'date' => $request->date,
                ],

                [
                    'status' => in_array(
                        $student->id,
                        $request->students ?? []
                    )
                        ? 'present'
                        : 'absent',
                ]
            );
        }

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Attendance submitted successfully.'
            );
    }

    // /**
    //  * Delete one attendance row
    //  */
    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->delete();

        return redirect()
            ->route('attendances.index')
            ->with(
                'success',
                'Attendance deleted successfully.'
            );
    }
}
