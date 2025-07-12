<?php

namespace App\Http\Controllers;

use App\Http\Requests\ListModelRequest;
use App\Models\Election;
use App\Models\ListModel;
use Illuminate\Http\Request;

class ListModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $lists = ListModel::with(['election', 'electoral_district', 'party', 'candidates'])
            ->when($request->election, function ($query, $electionId) {
                return $query->where('election_id', $electionId);
            })
            ->when($request->region, function ($query, $region) {
                return $query->whereHas('electoral_district', function ($q) use ($region) {
                    $q->where('region', $region);
                });
            })
            ->paginate(10);

        $elections = Election::orderBy('start_date', 'desc')->get();
        // dd($elections);
        return view('lists.index', compact('lists', 'elections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display form for creating a new list model
        return view('lists.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ListModelRequest $request)
    {
        // Validate the request data
        $data = $request->validated();

        // Store the new list model in the database
        ListModel::create($data);

        // Redirect with success message
        return redirect()->route('lists.index')->with('success', 'List created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ListModel $list)
    {
        // Display the details of a specific list model
        return view('lists.show', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListModel $list)
    {
        // Display form for editing an existing list model
        return view('lists.edit', compact('list'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ListModelRequest $request, ListModel $list)
    {
        // Validate the request data
        $data = $request->validated();

        // Update the list model with the new data
        $list->update($data);

        // Redirect with success message
        return redirect()->route('lists.index')->with('success', 'List updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListModel $list)
    {
        // Delete the list model from the database
        $list->delete();

        // Redirect with success message
        return redirect()->route('lists.index')->with('success', 'List deleted successfully.');
    }
}
