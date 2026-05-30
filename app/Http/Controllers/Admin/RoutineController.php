<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\User;
use App\Notifications\CreateRoutineNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routines = Routine::latest()->get();

        return view('admin.routines.index', compact('routines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.routines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:class_routine,mid_exam_routine,final_exam_routine',
            'filepath' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = null;

        if ($request->hasFile('filepath')) {

            $filePath = $request->file('filepath')
                ->store('routines', 'public');
        }

        $routine = Routine::create([
            'title' => $request->title,
            'type' => $request->type,
            'filepath' => $filePath,
        ]);

        $students = User::where('role', 'student')->get();
        foreach ($students as $stu) {
            $stu->notify(new CreateRoutineNotification($routine));
        }

        return redirect()
            ->route('routines.index')
            ->with('success', 'Routine created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $routine = Routine::findOrFail($id);

        return view('admin.routines.edit', compact('routine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $routine = Routine::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:class_routine,mid_exam_routine,final_exam_routine',
            'filepath' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $filePath = $routine->filepath;

        if ($request->hasFile('filepath')) {

            // delete old file
            if ($routine->filepath && Storage::disk('public')->exists($routine->filepath)) {

                Storage::disk('public')->delete($routine->filepath);
            }

            // upload new file
            $filePath = $request->file('filepath')
                ->store('routines', 'public');
        }

        $routine->update([
            'title' => $request->title,
            'type' => $request->type,
            'filepath' => $filePath,
        ]);

        return redirect()
            ->route('routines.index')
            ->with('success', 'Routine updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $routine = Routine::findOrFail($id);

        // delete file
        if ($routine->filepath && Storage::disk('public')->exists($routine->filepath)) {

            Storage::disk('public')->delete($routine->filepath);
        }

        DB::table('notifications')
            ->where('type', CreateRoutineNotification::class)
            ->where('data->route', route('student.attendances'))
            ->delete();

        $routine->delete();

        return redirect()
            ->route('routines.index')
            ->with('success', 'Routine deleted successfully.');
    }
}
