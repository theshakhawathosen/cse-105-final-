<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Subject;
use App\Models\User;
use App\Notifications\CreateResultNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::with(['user', 'exam'])
            ->latest()
            ->paginate(20);

        return view('admin.results.index', compact('results'));
    }

    /**
     * Show the form for creating the resource.
     */
    public function create()
    {
        $users = User::latest()->get();
        $exams = Exam::latest()->get();
        $subjects = Subject::latest("name")->get();

        return view('admin.results.create', compact('users', 'exams', 'subjects'));
    }

    /**
     * Store the resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',

            'subject_id' => 'required|exists:subjects,id',

            'exam_id' => [
                'required',
                'exists:exams,id',

                Rule::unique('results')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user_id);
                }),
            ],

            'marks' => 'required|numeric|min:0|max:100',

        ], [

            'exam_id.unique' => 'This student result already exists for this exam.',

        ]);

        $result = Result::create([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'subject_id' => $request->subject_id,
            'marks' => $request->marks,
        ]);

        // Send Notification Only To This Student
        $student = User::find($request->user_id);
        if ($student) {
            $student->notify(new CreateResultNotification($result));
        }

        return redirect()
            ->route('results.index')
            ->with('success', 'Result created successfully');
    }
    /**
     * Bulk Create Page
     */
    public function bulkCreate()
    {
        $users = User::latest()->get();

        $exams = Exam::latest('exam_name')->get();
        $subjects = Subject::oldest('name')->get();

        return view('admin.results.bulk-create', compact('users', 'exams', 'subjects'));
    }

    /**
     * Bulk Store
     */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'exam_id' => 'required|exists:exams,id',
            'subject_id' => 'required|exists:subjects,id',
            'results' => 'required|array',
        ]);


        foreach ($request->results as $result) {

            if ($result['marks'] !== null && $result['marks'] !== '') {

                Result::updateOrCreate(

                    [
                        'user_id' => $result['user_id'],
                        'exam_id' => $request->exam_id,
                        'subject_id' => $request->subject_id,
                    ],

                    [
                        'marks' => $result['marks'],
                    ]

                );
            }
        }

        return redirect()
            ->route('results.index')
            ->with('success', 'Bulk results saved successfully');
    }

    /**
     * Edit Page
     */
    public function edit(Result $result)
    {
        $users = User::latest()->get();

        $exams = Exam::with('subject')
            ->latest()
            ->get();

        return view('admin.results.edit', compact('result', 'users', 'exams'));
    }

    /**
     * Update Resource
     */
    public function update(Request $request, Result $result)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',

            'exam_id' => [

                'required',
                'exists:exams,id',

                Rule::unique('results')
                    ->where(function ($query) use ($request) {

                        return $query->where('user_id', $request->user_id);
                    })
                    ->ignore($result->id),

            ],

            'marks' => 'required|numeric|min:0|max:100',

        ], [

            'exam_id.unique' => 'This student result already exists for this exam.',

        ]);

        $result->update([
            'user_id' => $request->user_id,
            'exam_id' => $request->exam_id,
            'marks' => $request->marks,
        ]);

        return redirect()
            ->route('results.index')
            ->with('success', 'Result updated successfully');
    }

    /**
     * Delete Resource
     */
    public function destroy(Result $result)
    {

        DB::table('notifications')
            ->where('type', CreateResultNotification::class)
            ->where('data->route', route('student.results'))
            ->delete();
        $result->delete();

        return redirect()
            ->route('results.index')
            ->with('success', 'Result deleted successfully');
    }
}
