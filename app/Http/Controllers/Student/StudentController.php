<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Feedback;
use App\Models\Link;
use App\Models\Poll;
use App\Models\PollVote;
use App\Models\Resource;
use App\Models\ResourceFile;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\TakeAttendance;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function teachers(Request $request)
    {
        $search = $request->search;

        $teachers = Teacher::query()

            ->when($search, function ($query) use ($search) {

                $query->where('name', 'like', "%{$search}%");
            })

            ->latest()
            ->paginate(10);
        return view('student.teachers', compact('teachers'));
    }

    public function subjects()
    {
        $subjects = Subject::with('teacher')
            ->latest()
            ->get();

        return view('student.subjects', compact('subjects'));
    }

    public function polls()
    {
        $polls = Poll::with(['options.votes', 'votes'])
            ->where('is_published', true) // only published polls
            ->latest()
            ->paginate(9);

        return view('student.polls', compact('polls'));
    }

    public function vote(Request $request, Poll $poll)
    {
        $request->validate([
            'poll_option_id' => 'required|exists:poll_options,id',
        ]);

        // Already voted check
        $alreadyVoted = PollVote::where('poll_id', $poll->id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($alreadyVoted) {

            return back()->with(
                'error',
                'You already voted in this poll.'
            );
        }

        // Save vote
        PollVote::create([
            'poll_id' => $poll->id,
            'poll_option_id' => $request->poll_option_id,
            'user_id' => Auth::user()->id,
        ]);

        return back()->with(
            'success',
            'Vote submitted successfully.'
        );
    }

    public function feedback()
    {
        return view('student.feedback');
    }

    public function feedbackStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120',
        ]);

        $fileName = null;

        // Upload File
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('feedback', $fileName, 'public');
        }

        // Store Feedback
        Feedback::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'file' => $fileName,
        ]);

        return back()->with(
            'success',
            'Feedback submitted successfully.'
        );
    }

    public function routine(Request $request)
    {
        $type = $request->type;

        $routines = Routine::when($type, function ($query) use ($type) {
            $query->where('type', $type);
        })
            ->latest()
            ->get();

        return view('student.routine', compact('routines', 'type'));
    }

    public function resources()
    {
        $resources = Resource::with('subject')
            ->where('is_published', true)
            ->latest()
            ->get();

        return view('student.resources.index', compact('resources'));
    }

    // Single Resource View
    public function resourceShow(Resource $resource)
    {
        $resource->load('subject', 'files');

        return view('student.resources.show', compact('resource'));
    }

    // Download File
    public function downloadResource(ResourceFile $file)
    {
        $path = public_path('storage/' . $file->file);

        return response()->download($path, $file->original_name);
    }

    public function links()
    {
        $links = Link::orderBy('type',"asc")->get();

        return view('student.links', compact('links'));
    }
}
