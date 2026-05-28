<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::with('subject')
            ->latest()
            ->get();

        return view('admin.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.assignments.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'deadline' => 'nullable|date',
            'file' => 'nullable|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $uploadPath = storage_path('app/public/assignments');

            // Create folder if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadPath, $fileName);
        }

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'deadline' => $request->deadline,
            'file' => $fileName,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $assignment = Assignment::findOrFail($id);

        $subjects = Subject::latest()->get();

        return view('admin.assignments.edit', compact('assignment', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assignment = Assignment::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'deadline' => 'nullable|date',
            'file' => 'nullable|mimes:pdf,doc,docx,zip|max:2048',
        ]);

        $fileName = $assignment->file;

        if ($request->hasFile('file')) {

            $uploadPath = storage_path('app/public/assignments');

            // Create folder if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Delete old file
            if ($assignment->file && File::exists($uploadPath . '/' . $assignment->file)) {
                File::delete($uploadPath . '/' . $assignment->file);
            }

            $file = $request->file('file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadPath, $fileName);
        }

        $assignment->update([
            'title' => $request->title,
            'description' => $request->description,
            'subject_id' => $request->subject_id,
            'deadline' => $request->deadline,
            'file' => $fileName,
        ]);

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assignment = Assignment::findOrFail($id);

        $filePath = storage_path('app/public/assignments/' . $assignment->file);

        // Delete file
        if ($assignment->file && File::exists($filePath)) {
            File::delete($filePath);
        }

        $assignment->delete();

        return redirect()
            ->route('assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }
}
