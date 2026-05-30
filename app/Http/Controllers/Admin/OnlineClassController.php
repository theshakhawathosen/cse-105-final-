<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnlineClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class OnlineClassController extends Controller
{
    public function index()
    {
        $classes = OnlineClass::with('subject')
            ->latest()
            ->get();

        return view('admin.online-classes.index',
            compact('classes')
        );
    }

    public function create()
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.online-classes.create',
            compact('subjects')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject_id'   => 'required|exists:subjects,id',
            'platform'     => 'required|in:Zoom,Google Meet',
            'meeting_link' => 'nullable|url',
            'date'         => 'required|date',
            'time'         => 'required',
        ]);

        OnlineClass::create($validated);

        return redirect()
            ->route('online-classes.index')
            ->with('success', 'Online class added successfully.');
    }

    public function edit(OnlineClass $onlineClass)
    {
        $subjects = Subject::orderBy('name')->get();

        return view('admin.online-classes.edit',
            compact(
                'onlineClass',
                'subjects'
            )
        );
    }

    public function update(
        Request $request,
        OnlineClass $onlineClass
    ) {

        $validated = $request->validate([
            'subject_id'   => 'required|exists:subjects,id',
            'platform'     => 'required|in:Zoom,Google Meet',
            'meeting_link' => 'nullable|url',
            'date'         => 'required|date',
            'time'         => 'required',
        ]);

        $onlineClass->update($validated);

        return redirect()
            ->route('online-classes.index')
            ->with('success', 'Online class updated successfully.');
    }

    public function destroy(
        OnlineClass $onlineClass
    ) {

        $onlineClass->delete();

        return redirect()
            ->route('online-classes.index')
            ->with('success', 'Online class deleted successfully.');
    }
}
