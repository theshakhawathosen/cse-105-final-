<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashbaord');
    }

    public function profile()
    {
        $admin = Auth::user();
        return view('admin.profile.profile', compact('admin'));
    }

    public function storeProfile(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Current admin
        $admin = Auth::user();

        // Update fields
        $admin->name  = $validated['name'];
        $admin->email = $validated['email'];
        $admin->phone = $validated['phone'] ?? null;

        // Photo handling
        if ($request->hasFile('photo')) {

            // ✅ OLD IMAGE DELETE (safe check)
            if ($admin->photo && Storage::disk('public')->exists($admin->photo)) {
                Storage::disk('public')->delete($admin->photo);
            }

            // Upload new image
            $path = $request->file('photo')->store('admin/profile', 'public');

            $admin->photo = $path;
        }

        // Save
        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    public function updatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ], [
            'password.required' => 'Password field is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        // Get logged in admin
        $admin = Auth::user();

        // Update password
        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', 'Password updated successfully!');
    }
}
