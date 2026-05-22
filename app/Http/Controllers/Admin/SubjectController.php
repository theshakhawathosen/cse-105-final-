<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('teacher')
            ->latest()
            ->get();

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::orderBy('name')->get();

        return view('admin.subjects.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'teacher_id' => 'nullable|exists:teachers,id',
            'credit' => 'nullable|numeric|min:0',
            'type' => 'required|in:theory,lab',
        ]);

        Subject::create([
            'name' => $request->name,
            'code' => $request->code,
            'teacher_id' => $request->teacher_id,
            'credit' => $request->credit,
            'type' => $request->type,
        ]);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subject = Subject::findOrFail($id);

        $teachers = Teacher::latest()->get();

        return view('admin.subjects.edit', compact('subject', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject = Subject::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:100',
            'teacher_id' => 'nullable|exists:teachers,id',
            'credit' => 'nullable|numeric|min:0',
            'type' => 'required|in:theory,lab',
        ]);

        $subject->update([
            'name' => $request->name,
            'code' => $request->code,
            'teacher_id' => $request->teacher_id,
            'credit' => $request->credit,
            'type' => $request->type,
        ]);

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()
            ->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }
}
