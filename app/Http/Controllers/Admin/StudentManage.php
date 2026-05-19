<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class StudentManage extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = User::where('role', 'student')->latest()->paginate(20);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // photo upload
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('students', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => 'student',
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
        ]);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = User::findOrFail($id);

        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|min:6',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // photo update
        if ($request->hasFile('photo')) {

            // old photo delete (optional)
            if ($student->photo && file_exists(storage_path('app/public/' . $student->photo))) {
                unlink(storage_path('app/public/' . $student->photo));
            }

            $student->photo = $request->file('photo')->store('students', 'public');
        }

        // update data
        $student->name = $request->name;
        $student->email = $request->email;
        $student->phone = $request->phone;

        // password only if filled
        if ($request->password) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = User::findOrFail($id);

        // 1. Delete image first (if exists)
        if ($student->photo && File::exists(storage_path('app/public/' . $student->photo))) {
            File::delete(storage_path('app/public/' . $student->photo));
        }

        // 2. Delete student record
        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully!');
    }
}
