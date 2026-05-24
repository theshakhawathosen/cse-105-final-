<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Http\Request;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polls = Poll::with('options', 'votes')
            ->latest()
            ->get();

        return view('admin.polls.index', compact('polls'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.polls.create');
    }

    /**
 * Show poll details and results
 */
public function show(string $id)
{
    $poll = Poll::with([
        'options.votes.student',
        'votes.student',
    ])->findOrFail($id);

    $totalVotes = $poll->votes->count();

    // Winner Option
    $winner = $poll->options
        ->sortByDesc(function ($option) {

            return $option->votes->count();
        })
        ->first();

    return view('admin.polls.show', compact(
        'poll',
        'totalVotes',
        'winner'
    ));
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'expire_at' => 'nullable|date',
            'status' => 'required|in:active,closed',
            'is_published' => 'nullable',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll = Poll::create([
            'question' => $request->question,
            'expire_at' => $request->expire_at,
            'status' => $request->status,
            'is_published' => $request->is_published ? true : false,
        ]);

        foreach ($request->options as $option) {

            PollOption::create([
                'poll_id' => $poll->id,
                'option_text' => $option,
            ]);
        }

        return redirect()
            ->route('polls.index')
            ->with('success', 'Poll created successfully.');
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $poll = Poll::with('options')->findOrFail($id);

        return view('admin.polls.edit', compact('poll'));
    }

    /**
     * Update poll
     */
    public function update(Request $request, string $id)
    {
        $poll = Poll::findOrFail($id);

        $request->validate([
            'question' => 'required|string|max:255',
            'expire_at' => 'nullable|date',
            'status' => 'required|in:active,closed',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
        ]);

        $poll->update([
            'question' => $request->question,
            'expire_at' => $request->expire_at,
            'status' => $request->status,
            'is_published' => $request->is_published ? true : false,
        ]);

        $poll->options()->delete();

        foreach ($request->options as $option) {

            PollOption::create([
                'poll_id' => $poll->id,
                'option_text' => $option,
            ]);
        }

        return redirect()
            ->route('polls.index')
            ->with('success', 'Poll updated successfully.');
    }

    /**
     * Delete poll
     */
    public function destroy(string $id)
    {
        $poll = Poll::findOrFail($id);

        $poll->delete();

        return redirect()
            ->route('polls.index')
            ->with('success', 'Poll deleted successfully.');
    }

    /**
     * Vote system
     */
    public function vote(Request $request, Poll $poll)
    {
        $request->validate([
            'poll_option_id' => 'required|exists:poll_options,id',
        ]);

        if ($poll->status == 'closed') {

            return back()->with('error', 'Poll closed.');
        }

        if ($poll->expire_at && now()->gt($poll->expire_at)) {

            return back()->with('error', 'Poll expired.');
        }

        $alreadyVoted = PollVote::where('poll_id', $poll->id)
            ->where('student_id', auth()->id())
            ->exists();

        if ($alreadyVoted) {

            return back()->with('error', 'You already voted.');
        }

        PollVote::create([
            'poll_id' => $poll->id,
            'poll_option_id' => $request->poll_option_id,
            'student_id' => auth()->id(),
        ]);

        return back()->with('success', 'Your vote has been submitted.');
    }
}
