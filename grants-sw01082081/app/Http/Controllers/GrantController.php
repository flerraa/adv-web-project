<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use App\Models\Academician;
use Illuminate\Http\Request;

class GrantController extends Controller
{
    // Display all grants
    public function index()
    {
        $grants = Grant::with('projectLeader')->get();
        return view('grants.index', compact('grants'));
    }

    // Show form to create a new grant
    public function create()
    {
        $academicians = Academician::all();
        return view('grants.create', compact('academicians'));
    }

    // Store a newly created grant
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'provider' => 'required',
            'start_date' => 'required|date',
            'duration_months' => 'required|integer|min:1',
            'project_leader_id' => 'required|exists:academicians,id',
        ]);

        Grant::create($request->all());
        return redirect()->route('grants.index')->with('success', 'Grant created successfully!');
    }

    // Show a single grant's details
    public function show(Grant $grant)
    {
        $milestones = $grant->milestones;
        return view('grants.show', compact('grant', 'milestones'));
    }

    // Show form to edit a grant
    public function edit(Grant $grant)
{
    $academicians = Academician::all(); // Fetch all academicians for selection
    $members = $grant->academicians; // Existing members
    return view('grants.edit', compact('grant', 'academicians', 'members'));
}

public function update(Request $request, Grant $grant)
{
    $request->validate([
        'title' => 'required',
        'amount' => 'required|numeric|min:0',
        'provider' => 'required',
        'start_date' => 'required|date',
        'duration_months' => 'required|integer|min:1',
        'project_leader_id' => 'required|exists:academicians,id',
        'project_members' => 'nullable|array',
        'project_members.*' => 'exists:academicians,id',
    ]);

    $grant->update($request->only(['title', 'amount', 'provider', 'start_date', 'duration_months', 'project_leader_id']));

    // Sync project members
    $grant->academicians()->sync($request->input('project_members', []));

    return redirect()->route('grants.index')->with('success', 'Grant updated successfully!');
}

    // Delete a grant
    public function destroy(Grant $grant)
    {
        $grant->delete();
        return redirect()->route('grants.index')->with('success', 'Grant deleted successfully!');
    }
}
