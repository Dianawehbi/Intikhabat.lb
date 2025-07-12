<?php

namespace App\Http\Controllers;

use App\Http\Requests\PartyRequest;
use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all parties and return them to the view
        $parties = Party::all();
        return view('parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display form for creating a new party
        return view('parties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartyRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Create a new party record
        Party::create($data);

        // Redirect with success message
        return redirect()->route('parties.index')->with('success', 'Party created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        // Display the details of a specific party
        return view('parties.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        // Display form for editing an existing party
        return view('parties.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartyRequest $request, Party $party)
    {
        // Validate the request data
        $data = $request->validated();

        // Update the party record
        $party->update($data);

        // Redirect with success message
        return redirect()->route('parties.index')->with('success', 'Party updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        // Delete the party record
        $party->delete();

        // Redirect with success message
        return redirect()->route('parties.index')->with('success', 'Party deleted successfully.');
    }
}
