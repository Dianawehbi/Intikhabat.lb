<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElectionRequest;
use App\Models\Election;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all elections and return them to a view
        $elections = Election::all();
        return view('elections.index', compact('elections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form for creating a new election
        return view('elections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElectionRequest $request)
    {
        // Validate and store election data
        $data = $request->validated();

        // Store the election in the database
        Election::create($data);

        // Redirect with success message
        return redirect()->route('elections.index')->with('success', 'Election created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Election $election)
    {
        // Display the details of a specific election
        return view('elections.show', compact('election'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Election $election)
    {
        // Show the form to edit the election
        return view('elections.edit', compact('election'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ElectionRequest $request, Election $election)
    {
        // Validate and update election data
        $data = $request->validated();

        // Update the election in the database
        $election->update($data);

        // Redirect with success message
        return redirect()->route('elections.index')->with('success', 'Election updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Election $election)
    {
        // Delete the election from the database
        $election->delete();

        // Redirect with success message
        return redirect()->route('elections.index')->with('success', 'Election deleted successfully.');
    }
}
