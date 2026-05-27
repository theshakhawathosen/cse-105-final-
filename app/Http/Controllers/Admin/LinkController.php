<?php

namespace App\Http\Controllers\Admin;

use App\Models\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        Link::create([
            'title' => $request->title,
            'url'   => $request->url,
            'type'  => $request->type,
        ]);

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
        $link->delete();

        return redirect()
            ->route('links.index')
            ->with('success', 'Link deleted successfully.');
    }
}
