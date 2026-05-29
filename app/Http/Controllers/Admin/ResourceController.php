<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Subject;
use App\Models\User;
use App\Notifications\CreateResourceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resource::with([
            'subject',
            'files'
        ])
            ->latest()
            ->get();

        return view('admin.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjects = Subject::latest()->get();

        return view('admin.resources.create', compact('subjects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',

            'subject_id' => 'required|exists:subjects,id',

            'category' => 'required|in:notes,slides,book,lab_manual,assignment_solution,question_bank,tutorial,others',

            'files.*' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar,jpg,jpeg,png|max:10240',

            'link' => 'nullable|url',

        ]);

        // Either file or link required
        if (!$request->hasFile('files') && !$request->link) {

            return back()
                ->withErrors([
                    'files' => 'Please upload file or provide link.'
                ])
                ->withInput();
        }

        $resource = Resource::create([
            'title' => $request->title,

            'subject_id' => $request->subject_id,

            'category' => $request->category,

            'link' => $request->link,

            'is_published' => $request->has('is_published'),
        ]);

        // Multiple Upload
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                $path = $file->store('resources', 'public');

                $resource->files()->create([

                    'file' => $path,

                    'original_name' => $file->getClientOriginalName(),

                ]);
            }
        }

        // Send Notification
        $students = User::where('role', 'student')->get();
        foreach ($students as $stu) {
            $stu->notify(new CreateResourceNotification($resource));
        }

        return redirect()
            ->route('resources.index')
            ->with('success', 'Resource created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resource = Resource::with('files')
            ->findOrFail($id);

        $subjects = Subject::latest()->get();

        return view('admin.resources.edit', compact('resource', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resource = Resource::with('files')
            ->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',

            'subject_id' => 'required|exists:subjects,id',

            'category' => 'required|in:notes,slides,book,lab_manual,assignment_solution,question_bank,tutorial,others',

            'files.*' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,rar,jpg,jpeg,png|max:10240',

            'link' => 'nullable|url',

        ]);

        $resource->update([
            'title' => $request->title,

            'subject_id' => $request->subject_id,

            'category' => $request->category,

            'link' => $request->link,

            'is_published' => $request->has('is_published'),
        ]);

        // New Upload
        if ($request->hasFile('files')) {

            foreach ($request->file('files') as $file) {

                $path = $file->store('resources', 'public');

                $resource->files()->create([

                    'file' => $path,

                    'original_name' => $file->getClientOriginalName(),

                ]);
            }
        }

        return redirect()
            ->route('resources.index')
            ->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resource = Resource::with('files')
            ->findOrFail($id);

        // Delete Files
        foreach ($resource->files as $file) {

            if (Storage::disk('public')->exists($file->file)) {

                Storage::disk('public')->delete($file->file);
            }
        }

        $resource->delete();

        return redirect()
            ->route('resources.index')
            ->with('success', 'Resource deleted successfully.');
    }
}
