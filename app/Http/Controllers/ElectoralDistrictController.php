<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElectoralDistrictRequest;
use App\Models\ElectoralDistrict;
use App\Models\ElectoralDistrictSeat;
use Illuminate\Http\Request;

class ElectoralDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all electoral districts and return them to a view
        $electoralDistricts = ElectoralDistrict::all();
        $seats = ElectoralDistrictSeat::all();
        return view('electoral_districts.index', compact('electoralDistricts','seats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form for creating a new electoral district
        return view('electoral_districts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElectoralDistrictRequest $request)
    {
        // Validate and store the electoral district data
        $data = $request->validated();

        // Create the new electoral district
        ElectoralDistrict::create($data);

        // Redirect with a success message
        return redirect()->route('electoral_districts.index')->with('success', 'Electoral district created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ElectoralDistrict $electoralDistrict)
    {
        // Show details of a specific electoral district
        return view('electoral_districts.show', compact('electoralDistrict'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ElectoralDistrict $electoralDistrict)
    {
        // Show the form to edit the electoral district
        return view('electoral_districts.edit', compact('electoralDistrict'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ElectoralDistrictRequest $request, ElectoralDistrict $electoralDistrict)
    {
        // Validate and update electoral district data
        $data = $request->validated();

        // Update the electoral district
        $electoralDistrict->update($data);

        // Redirect with success message
        return redirect()->route('electoral_districts.index')->with('success', 'Electoral district updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ElectoralDistrict $electoralDistrict)
    {
        // Delete the electoral district from the database
        $electoralDistrict->delete();

        // Redirect with success message
        return redirect()->route('electoral_districts.index')->with('success', 'Electoral district deleted successfully.');
    }
}
