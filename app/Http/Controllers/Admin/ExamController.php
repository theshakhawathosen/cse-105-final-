<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::with('subject')
            ->latest()
            ->get();

        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::all();

        return view('admin.exams.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'exam_type' => 'required',

            'exam_name' => 'required',

            'subject_id' => 'required|exists:subjects,id',

            'date' => 'required|date',

        ]);

        Exam::create([

            'exam_type' => $request->exam_type,

            'exam_name' => $request->exam_name,

            'subject_id' => $request->subject_id,

            'date' => $request->date,

        ]);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $subjects = Subject::all();

        return view('admin.exams.edit', compact('exam', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Exam $exam)
    {
        $request->validate([

            'exam_type' => 'required',

            'exam_name' => 'required',

            'subject_id' => 'required|exists:subjects,id',

            'date' => 'required|date',

        ]);

        $exam->update([

            'exam_type' => $request->exam_type,

            'exam_name' => $request->exam_name,

            'subject_id' => $request->subject_id,

            'date' => $request->date,

        ]);

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with('success', 'Exam deleted successfully');
    }

    public function generateAll()
    {
        // সব exam delete
        Exam::truncate();

        // সব subject আনো
        $subjects = Subject::all();

        // exam types
        $examTypes = ['CT', 'Mid', 'Final'];

        foreach ($subjects as $subject) {

        $i = 1;
            foreach ($examTypes as $type) {

                Exam::create([
                    'subject_id' => $subject->id,
                    'exam_type'  => $type,
                    'exam_name'  => $type."-".$i,
                    'date'       => Carbon::now()->today()->format('y-m-d'),
                ]);
                $i++;
            }
        }

        return back()->with('success', 'All exams generated successfully.');
    }
}
