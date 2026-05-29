<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use App\Models\User;
use App\Notifications\NoticeCreatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

            // FILE VALIDATION
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
        ]);

        $attachmentPath = null;

        // FILE UPLOAD
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')
                ->store('notices', 'public');
        }

        $notice =  Notice::create([
            'title'         => $validated['title'],
            'content'       => $validated['content'],
            'category'      => $validated['category'] ?? null,
            'priority'      => $validated['priority'],
            'expire_at'     => $validated['expire_at'] ?? null,
            'attachment'    => $attachmentPath,

            // checkbox handling
            'is_published'  => $request->has('is_published'),
            'is_scrolling'  => $request->has('is_scrolling'),
        ]);

        if ($notice->is_published) {
            // Send Notification
            $notiStu = User::where('role', 'student')->get();
            foreach ($notiStu as $stu) {
                $stu->notify(new NoticeCreatedNotification($notice));
            }
        }

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

            // FILE VALIDATION
            'attachment'  => 'nullable|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:5120',
        ]);

        $attachmentPath = $notice->attachment;

        // NEW FILE UPLOAD
        if ($request->hasFile('attachment')) {

            // DELETE OLD FILE
            if ($notice->attachment && Storage::disk('public')->exists($notice->attachment)) {
                Storage::disk('public')->delete($notice->attachment);
            }

            $attachmentPath = $request->file('attachment')
                ->store('notices', 'public');
        }

        if (!$notice->is_published) {
            // Send Notification
            $notiStu = User::where('role', 'student')->get();
            foreach ($notiStu as $stu) {
                $stu->notify(new NoticeCreatedNotification($notice));
            }
        }
        $notice->update([
            'title'        => $validated['title'],
            'content'      => $validated['content'],
            'category'     => $validated['category'] ?? null,
            'priority'     => $validated['priority'],
            'expire_at'    => $validated['expire_at'] ?? null,
            'attachment'   => $attachmentPath,

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

        // DELETE FILE
        if ($notice->attachment && Storage::disk('public')->exists($notice->attachment)) {
            Storage::disk('public')->delete($notice->attachment);
        }

        $notice->delete();

        return redirect()
            ->route('notices.index')
            ->with('success', 'Notice deleted successfully!');
    }
}
