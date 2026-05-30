<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Exam;
use App\Models\Feedback;
use App\Models\LabReport;
use App\Models\Lesson;
use App\Models\Link;
use App\Models\Notice;
use App\Models\OnlineClass;
use App\Models\Poll;
use App\Models\PollVote;
use App\Models\Resource;
use App\Models\ResourceFile;
use App\Models\Result;
use App\Models\Routine;
use App\Models\Subject;
use App\Models\TakeAttendance;
use App\Models\Teacher;
use App\Models\User;
use App\Notifications\StudentCreateFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
            'file' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        $fileName = null;

        // Upload File
        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->storeAs('feedback', $fileName, 'public');
        }

        // Store Feedback
        $feedback = Feedback::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'file' => $fileName,
        ]);

        if ($feedback) {
            // Send Notification
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $stu) {
                $stu->notify(new StudentCreateFeedback($feedback, Auth::user()));
            }
        }

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
        $links = Link::orderBy('type', "asc")->get();

        return view('student.links', compact('links'));
    }
    public function results(Request $request)
    {
        $students = User::where('role', 'student')->oldest('roll')->get();
        $user = User::findOrFail($request->student_id);
        $exams = Exam::orderBy('date', 'asc')->get();
        $results = Result::all();
        $subjects = Subject::all();


        return view('student.result', compact(
            'students',
            'exams',
            'results',
            'subjects',
            'user'
        ));
    }

    public function assignments(Request $request)
    {

        $subjects = Subject::orderBy('name')->get();

        // Total count across all subjects (unfiltered)
        $totalCount = Assignment::count();

        // Build query with optional subject filter
        $assignments = Assignment::with('subject')
            ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
            ->latest()
            ->paginate(9);

        return view('student.assignments', compact('assignments', 'subjects', 'totalCount'));
    }

    public function assignmentshow(Assignment $assignment)
    {
        $assignment->load('subject');

        return view('student.assignment-show', compact('assignment'));
    }

    public function labReports(Request $request)
    {
        $subjects = Subject::orderBy('name')->get();

        $labReports = LabReport::with('subject')
            ->when($request->subject_id, fn($q) => $q->where('subject_id', $request->subject_id))
            ->latest()
            ->paginate(10);

        return view('student.lab-reports', compact('labReports', 'subjects'));
    }

    public function labreportShow(LabReport $labReport)
    {
        $labReport->load('subject');

        return view('student.lab-report-show', compact('labReport'));
    }

    public function notices(Request $request)
    {
        // Distinct categories for the filter dropdown
        $categories = Notice::where('is_published', true)
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $notices = Notice::where('is_published', true)
            ->when($request->category, fn($q) => $q->where('category', $request->category))
            ->latest()
            ->paginate(10);

        return view('student.notices', compact('notices', 'categories'));
    }

    public function noticeshow(Notice $notice)
    {
        // Only show published notices to students
        abort_if(!$notice->is_published, 404);

        return view('student.notice-show', compact('notice'));
    }

    public function profile()
    {
        $student = Auth::user();
        return view('student.profile', compact('student'));
    }

    public function updateProfile(Request $request)
    {
        $student = Auth::user();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'phone' => 'nullable|string|max:20',
            'roll'  => 'nullable|numeric',
            'reg'   => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload Photo
        if ($request->hasFile('photo')) {

            $photo = $request->file('photo')->store('students', 'public');

            $student->photo = $photo;
        }

        // Update Data
        $student->name  = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->roll  = $request->roll;
        $student->reg   = $request->reg;

        $student->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        return view('student.change-password');
    }
    public function updatePassword(Request $request)
    {
        $request->validate(['current_password' => 'required', 'password' => 'required|min:6|confirmed',], ['current_password.required' => 'Current password is required.', 'password.required' => 'New password is required.', 'password.min' => 'Password must be at least 6 characters.', 'password.confirmed' => 'Password confirmation does not match.',]);
        $student = Auth::user(); // Check current password
        if (!Hash::check($request->current_password, $student->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        } // Update password
        $student->password = Hash::make($request->password);
        $student->save();
        return back()->with('success', 'Password changed successfully.');
    }


    // Notifications
    public function notifications()
    {
        $student = Auth::user();

        $notifications = $student->notifications()
            ->latest()
            ->paginate(12);

        $unreadCount = $student->unreadNotifications->count();

        return view('student.notifications', compact(
            'notifications',
            'unreadCount'
        ));
    }

    public function readAndRedirect($notiId, $desinationRoute)
    {
        $student = Auth::user();
        $notification = $student->notifications()
            ->where('id', $notiId)
            ->firstOrFail();
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }
        return redirect()->to(base64_decode($desinationRoute));
    }


    /**
     * Mark Single Notification As Read
     */
    public function markNotificationRead($id)
    {
        $student = Auth::user();

        $notification = $student->notifications()
            ->where('id', $id)
            ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return back()->with('success', 'Notification marked as read.');
    }

    /**
     * Mark All Notifications As Read
     */
    public function markAllNotificationsRead()
    {
        $student = Auth::user();

        $student->unreadNotifications->markAsRead();

        return back()->with('success', 'All notifications marked as read.');
    }

    /**
     * Delete Single Notification
     */
    public function deleteNotification($id)
    {
        $student = Auth::user();

        $notification = $student->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $notification->delete();

        return back()->with('success', 'Notification deleted successfully.');
    }

    /**
     * Delete All Notifications
     */
    public function deleteAllNotifications()
    {
        $student = Auth::user();

        $student->notifications()->delete();

        return back()->with('success', 'All notifications deleted successfully.');
    }

    public function calendar()
    {
        $currentMonth = now();

        $lessons = Lesson::with('subject')
            ->whereMonth('date', $currentMonth->month)
            ->whereYear('date', $currentMonth->year)
            ->orderBy('date')
            ->get();

        return view('student.calendar',
            compact('currentMonth', 'lessons')
        );
    }


    public function onlineClasses()
    {
        $classes = OnlineClass::with('subject')
            ->latest()
            ->paginate(12);

        return view('student.online-classes', compact('classes'));
    }

    // JOIN CLASS
    public function joinClass($id)
    {
        $class = OnlineClass::findOrFail($id);

        $dateTime = \Carbon\Carbon::parse($class->date . ' ' . $class->time);

        if (!$dateTime->isToday()) {
            return redirect()->back()->with('error', 'Class not available yet.');
        }

        // Zoom / Google Meet redirect
        return redirect()->to($class->meeting_link);
    }
}
