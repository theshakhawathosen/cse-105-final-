<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\User;
use App\Notifications\CreateLinkNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = Link::latest()->get();

        return view('admin.links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.links.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
            'type'  => 'required|in:google classroom,group',
        ]);

        $link = Link::create([
            'title' => $request->title,
            'url'   => $request->url,
            'type'  => $request->type,
        ]);

        // Send Notification
        $students = User::where('role', 'student')->get();

        foreach ($students as $stu) {
            $stu->notify(new CreateLinkNotification($link));
        }

        return redirect()
            ->route('links.index')
            ->with('success', 'Link added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        return view('admin.links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Link $link)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'required|url',
            'type'  => 'required|in:google classroom,group',
        ]);

        $link->update([
            'title' => $request->title,
            'url'   => $request->url,
            'type'  => $request->type,
        ]);

        return redirect()
            ->route('links.index')
            ->with('success', 'Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Link $link)
    {
        DB::table('notifications')
            ->where('type', CreateLinkNotification::class)
            ->where('data->route', route('student.links', $link->id))
            ->delete();

        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('success', 'Link deleted successfully.');
    }
}
