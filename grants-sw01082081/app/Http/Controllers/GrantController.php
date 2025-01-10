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
        $grants = Grant::with('projectLeader')->get(); // Eager load project leader relationship
        return view('grants.index', compact('grants'));
    }

    // Show the form for creating a new grant
    public function create()
    {
        $academicians = Academician::all(); // Fetch all academicians for dropdown
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

    // Show the details of a specific grant
    public function show(Grant $grant)
    {
        $grant->load('projectLeader', 'members', 'milestones');
        $availableMembers = Academician::whereNotIn('id', $grant->members->pluck('id'))
                                  ->where('id', '!=', $grant->project_leader_id)
                                  ->get();
    return view('grants.show', compact('grant', 'availableMembers'));
    }

    // Show the form for editing a grant
    public function edit(Grant $grant)
    {
        $academicians = Academician::all(); // Fetch all academicians for dropdown
        return view('grants.edit', compact('grant', 'academicians'));
    }

    // Update an existing grant
    public function update(Request $request, Grant $grant)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|numeric|min:0',
            'provider' => 'required',
            'start_date' => 'required|date',
            'duration_months' => 'required|integer|min:1',
            'project_leader_id' => 'required|exists:academicians,id',
        ]);

        $grant->update($request->all());
        return redirect()->route('grants.index')->with('success', 'Grant updated successfully!');
    }

    // Delete an existing grant
    public function destroy(Grant $grant)
    {
        $grant->delete();
        return redirect()->route('grants.index')->with('success', 'Grant deleted successfully!');
    }


    public function addMember(Request $request, Grant $grant)
{
    $request->validate([
        'member_id' => 'required|exists:academicians,id'
    ]);

    if (!$grant->members->contains($request->member_id)) {
        $grant->members()->attach($request->member_id);
    }

    return redirect()->back()->with('success', 'Member added successfully!');
}

public function removeMember(Request $request, Grant $grant)
{
    $grant->members()->detach($request->member_id);
    return redirect()->back()->with('success', 'Member removed successfully!');
}

}

