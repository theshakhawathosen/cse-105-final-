<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('admin.notices.index', compact('notices'));
    }

    // toggle publish
    public function togglePublish(Notice $notice)
    {
        $notice->is_published = !$notice->is_published;
        $notice->save();

        return back()->with('success', 'Publish status updated!');
    }

    // toggle scrolling
    public function toggleScrolling(Notice $notice)
    {
        $notice->is_scrolling = !$notice->is_scrolling;
        $notice->save();

        return back()->with('success', 'Scrolling status updated!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.notices.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'nullable|string|max:255',
            'priority'    => 'required|in:low,normal,high,urgent',
            'expire_at'   => 'nullable|date',
        ]);

        Notice::create([
            'title'         => $validated['title'],
            'content'       => $validated['content'],
            'category'      => $validated['category'] ?? null,
            'priority'      => $validated['priority'],
            'expire_at'     => $validated['expire_at'] ?? null,

            // checkbox handling
            'is_published'  => $request->has('is_published'),
            'is_scrolling'  => $request->has('is_scrolling'),
        ]);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice created successfully!');
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
        $notice = Notice::findOrFail($id);
        return view('admin.notices.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'category'    => 'nullable|string|max:255',
            'priority'    => 'required|in:low,normal,high,urgent',
            'expire_at'   => 'nullable|date',
        ]);

        $notice->update([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'category'     => $validated['category'] ?? null,
            'priority'     => $validated['priority'],
            'expire_at'    => $validated['expire_at'] ?? null,

            'is_published' => $request->has('is_published'),
            'is_scrolling' => $request->has('is_scrolling'),
        ]);

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice updated successfully!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);

        $notice->delete();

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice deleted successfully!');
    }
}
