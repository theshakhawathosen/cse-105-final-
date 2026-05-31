<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InviteMail;
use App\Mail\ResetStudentPasswodMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class MailController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.mail-settings', compact('students'));
    }

    public function inviteAll()
    {
        $students = User::where('role', 'student')->get();
        foreach ($students as $student) {
            $password = Str::password(10, true, true, false);
            $student->update([
                'password' => Hash::make($password)
            ]);
            Mail::to($student->email)->queue(new InviteMail($student->name, $student->email, $password));
        }

        return redirect()->route('admin.queue.pending')->with('success', 'Mail send to all students!');
    }


    public function deleteJob($id)
    {
        DB::table('jobs')->where('id', $id)->delete();
        return back()->with('success', 'Job Deleted Successfully!');
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'student_id' => 'required'
        ]);

        $password = Str::password(10, true, true, false);
        $student = User::findOrFail($request->student_id);
        Mail::to($student->email)->queue(new ResetStudentPasswodMail($student->name, $student->email, $password));
        return back()->with('success', 'Mail send to student!');
    }
}
