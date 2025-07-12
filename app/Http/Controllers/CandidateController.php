<?php

namespace App\Http\Controllers;

use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use App\Models\Election;
use App\Models\ElectoralDistrict;
use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $filters = $request->only(['region', 'year', 'election_type', 'party_id']);

        // Get dropdown values
        $regions = ElectoralDistrict::select('region')->distinct()->orderBy('region')->pluck('region');
        $years = Election::selectRaw('YEAR(start_date) as year')->distinct()->pluck('year');
        $electionTypes = Election::select('election_type')->distinct()->pluck('election_type');
        $parties = Party::orderBy('name')->get(); // Adjust if you want to limit by year/type

        // Build district list with filtered candidates
        $districts = ElectoralDistrict::with([
            'candidates' => function ($query) use ($filters) {
                $query->with('election', 'party')
                    ->when(
                        $filters['year'] ?? null,
                        fn($q) =>
                        $q->whereHas('election', fn($q2) =>
                            $q2->whereYear('start_date', $filters['year']))
                    )
                    ->when(
                        $filters['election_type'] ?? null,
                        fn($q) =>
                        $q->whereHas('election', fn($q2) =>
                            $q2->where('election_type', $filters['election_type']))
                    )
                    ->when(
                        $filters['party_id'] ?? null,
                        fn($q) =>
                        $q->where('party_id', $filters['party_id'])
                    )
                    ->orderBy('full_name');
            }
        ])
            ->when($filters['region'] ?? null, fn($q) => $q->where('region', $filters['region']))
            ->orderBy('name')
            ->get();
        return view('candidates.index', compact('districts', 'filters', 'regions', 'years', 'electionTypes', 'parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form for creating a new candidate
        return view('candidates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CandidateRequest $request)
    {
        // Validate and create candidate
        $data = $request->validated();

        // Handle image upload if it exists
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('candidates', 'public');
        }

        // Store the candidate
        Candidate::create($data);

        // Redirect with success message
        return redirect()->route('candidates.index')->with('success', 'Candidate created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidate $candidate)
    {
        // Show details for a specific candidate
        return view('candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidate $candidate)
    {
        // Show form to edit the candidate
        return view('candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CandidateRequest $request, Candidate $candidate)
    {
        // Validate and update candidate
        $data = $request->validated();

        // Handle image upload if it exists
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($candidate->image) {
                Storage::disk('public')->delete($candidate->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('candidates', 'public');
        }

        // Update the candidate data
        $candidate->update($data);

        // Redirect with success message
        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidate $candidate)
    {
        // Delete candidate and associated image
        if ($candidate->image) {
            Storage::disk('public')->delete($candidate->image);
        }

        $candidate->delete();

        // Redirect with success message
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}
