<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabReport;
use App\Models\Subject;
use App\Models\User;
use App\Notifications\CreateLabReportNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LabReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $labReports = LabReport::with('subject')
            ->latest()
            ->get();

        return view('admin.lab-reports.index', compact('labReports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.lab-reports.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file' => 'nullable|mimes:pdf,doc,docx,zip|max:2048',
            'status' => 'required|in:active,closed',
        ]);

        $fileName = null;

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            $uploadPath = storage_path('app/public/lab-reports');

            // Create folder if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadPath, $fileName);
        }

        $labReport = LabReport::create([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file' => $fileName,
            'status' => $request->status,
        ]);

        // Send Notification
        $students = User::where('role', 'student')->get();
        foreach ($students as $stu) {
            $stu->notify(new CreateLabReportNotification($labReport));
        }

        return redirect()
            ->route('lab-reports.index')
            ->with('success', 'Lab report created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $labReport = LabReport::findOrFail($id);

        $subjects = Subject::latest()->get();

        return view('admin.lab-reports.edit', compact('labReport', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $labReport = LabReport::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'file' => 'nullable|mimes:pdf,doc,docx,zip|max:2048',
            'status' => 'required|in:active,closed',
        ]);

        $fileName = $labReport->file;

        if ($request->hasFile('file')) {

            $uploadPath = storage_path('app/public/lab-reports');

            // Create folder if not exists
            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            // Delete old file
            if ($labReport->file && File::exists($uploadPath . '/' . $labReport->file)) {
                File::delete($uploadPath . '/' . $labReport->file);
            }

            $file = $request->file('file');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move($uploadPath, $fileName);
        }

        $labReport->update([
            'title' => $request->title,
            'subject_id' => $request->subject_id,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'file' => $fileName,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('lab-reports.index')
            ->with('success', 'Lab report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $labReport = LabReport::findOrFail($id);

        $filePath = storage_path('app/public/lab-reports/' . $labReport->file);

        // Delete file
        if ($labReport->file && File::exists($filePath)) {
            File::delete($filePath);
        }

        $labReport->delete();

        return redirect()
            ->route('lab-reports.index')
            ->with('success', 'Lab report deleted successfully.');
    }
}
