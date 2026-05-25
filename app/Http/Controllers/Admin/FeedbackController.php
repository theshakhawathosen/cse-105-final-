<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Display feedback list
     */
    public function index()
    {
        $feedbacks = Feedback::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.feedbacks.index',
            compact('feedbacks')
        );
    }

    /**
     * Show single feedback
     */
    public function show(string $id)
    {
        $feedback = Feedback::with('user')
            ->findOrFail($id);

        return view('admin.feedbacks.show',
            compact('feedback')
        );
    }

    /**
     * Delete feedback
     */
    public function destroy(string $id)
    {
        $feedback = Feedback::findOrFail($id);

        $feedback->delete();

        return redirect()
            ->route('feedbacks.index')
            ->with(
                'success',
                'Feedback deleted successfully.'
            );
    }
}
