<?php
namespace App\Http\Controllers;

use App\Models\JobPositions;
use Illuminate\Http\Request;

class JobPositionsController extends Controller
{
    // Display a listing of the job positions
    public function index()
    {
        $jobPositions = JobPositions::all();
        return view('job_positions.index', compact('jobPositions'));
    }

    // Show the form for creating a new job position
    public function create()
    {
        return view('job_positions.create');
    }

    // Store a newly created job position in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        JobPositions::create($validatedData);

        return redirect()->route('job_positions.index')->with('success', 'Job Position created successfully.');
    }

    // Show the form for editing the specified job position
    public function edit($id)
    {
        $jobPosition = JobPositions::findOrFail($id);
        return view('job_positions.edit', compact('jobPosition'));
    }

    // Update the specified job position in storage
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'industry' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $jobPosition = JobPositions::findOrFail($id);
        $jobPosition->update($validatedData);

        return redirect()->route('job_positions.index')->with('success', 'Job Position updated successfully.');
    }

    // Remove the specified job position from storage
    public function destroy($id)
    {
        $jobPosition = JobPositions::findOrFail($id);
        $jobPosition->delete();

        return redirect()->route('job_positions.index')->with('success', 'Job Position deleted successfully.');
    }
}

