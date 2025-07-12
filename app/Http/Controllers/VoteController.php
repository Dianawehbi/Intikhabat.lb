<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all votes and return them to the view
        $votes = Vote::all();
        return view('votes.index', compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display form for creating a new vote
        return view('votes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VoteRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Create a new vote record
        Vote::create($data);

        // Redirect with success message
        return redirect()->route('votes.index')->with('success', 'Vote recorded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vote $vote)
    {
        // Display the details of a specific vote
        return view('votes.show', compact('vote'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vote $vote)
    {
        // Display form for editing an existing vote
        return view('votes.edit', compact('vote'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VoteRequest $request, Vote $vote)
    {
        // Validate the request data
        $data = $request->validated();

        // Update the vote record with the new data
        $vote->update($data);

        // Redirect with success message
        return redirect()->route('votes.index')->with('success', 'Vote updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vote $vote)
    {
        // Delete the vote record from the database
        $vote->delete();

        // Redirect with success message
        return redirect()->route('votes.index')->with('success', 'Vote deleted successfully.');
    }
}
