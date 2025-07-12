<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdScanRequest;
use App\Models\IdScan;
use Illuminate\Http\Request;

class IdScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all ID scans and display them in a view
        $idScans = IdScan::all();
        return view('id_scans.index', compact('idScans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Display form to create a new ID scan
        return view('id_scans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdScanRequest $request)
    {
        // Validate the request using the custom request class
        $data = $request->validated();

        // Handle the file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('id_scans', 'public');
            $data['image_path'] = $imagePath;
        }

        // Create a new ID scan record
        IdScan::create($data);

        // Redirect with success message
        return redirect()->route('id_scans.index')->with('success', 'ID Scan uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(IdScan $idScan)
    {
        // Show the details of a specific ID scan
        return view('id_scans.show', compact('idScan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IdScan $idScan)
    {
        // Show form to edit an existing ID scan
        return view('id_scans.edit', compact('idScan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdScanRequest $request, IdScan $idScan)
    {
        // Validate and update the ID scan data
        $data = $request->validated();

        // Handle the file upload if a new image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('id_scans', 'public');
            $data['image_path'] = $imagePath;
        }

        // Update the ID scan record
        $idScan->update($data);

        // Redirect with success message
        return redirect()->route('id_scans.index')->with('success', 'ID Scan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IdScan $idScan)
    {
        // Delete the ID scan record
        $idScan->delete();

        // Redirect with success message
        return redirect()->route('id_scans.index')->with('success', 'ID Scan deleted successfully.');
    }
}
