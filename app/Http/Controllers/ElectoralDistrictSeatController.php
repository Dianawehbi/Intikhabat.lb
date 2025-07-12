<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElectoralDistrictSeatRequest;
use App\Models\ElectoralDistrictSeat;
use Illuminate\Http\Request;

class ElectoralDistrictSeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all electoral district seats
        $electoralDistrictSeats = ElectoralDistrictSeat::all();
        return view('electoral_district_seats.index', compact('electoralDistrictSeats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form for creating a new electoral district seat
        // return view('electoral_district_seats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElectoralDistrictSeatRequest $request)
    {
        // Validate and store the electoral district seat
        $data = $request->validated();

        // Create the new electoral district seat
        ElectoralDistrictSeat::create($data);

        // Redirect with success message
        // return redirect()->route('electoral_district_seats.index')->with('success', 'Electoral district seat created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectoralDistrictSeat $electoralDistrictSeat)
    {
        // Display the details of a specific electoral district seat
        // return view('electoral_district_seats.show', compact('electoralDistrictSeat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectoralDistrictSeat $electoralDistrictSeat)
    {
        // Show form to edit the electoral district seat
        // return view('electoral_district_seats.edit', compact('electoralDistrictSeat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ElectoralDistrictSeatRequest $request, ElectoralDistrictSeat $electoralDistrictSeat)
    {
        // Validate and update the electoral district seat data
        $data = $request->validated();

        // Update the electoral district seat
        $electoralDistrictSeat->update($data);

        // Redirect with success message
        // return redirect()->route('electoral_district_seats.index')->with('success', 'Electoral district seat updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectoralDistrictSeat $electoralDistrictSeat)
    {
        // Delete the electoral district seat
        $electoralDistrictSeat->delete();

        // Redirect with success message
        // return redirect()->route('electoral_district_seats.index')->with('success', 'Electoral district seat deleted successfully.');
    }
}
