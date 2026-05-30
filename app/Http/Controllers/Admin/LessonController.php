<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Subject;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('subject')
            ->latest('date')->latest('id')
            ->get();

        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.lessons.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'topic'      => 'required|string|max:255',
            'notes'      => 'nullable|string',
            'date'       => 'required|date',
            'platform'       => 'required|string',
        ]);

        Lesson::create($validated);

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson added successfully.');
    }

    public function edit(Lesson $lesson)
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.lessons.edit',
            compact('lesson', 'subjects')
        );
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validated = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'topic'      => 'required|string|max:255',
            'notes'      => 'nullable|string',
            'date'       => 'required|date',
            'platform'       => 'required|string',
        ]);

        $lesson->update($validated);

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson updated successfully.');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return redirect()
            ->route('lessons.index')
            ->with('success', 'Lesson deleted successfully.');
    }
}
