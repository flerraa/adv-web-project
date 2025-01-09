<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Grant;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    // Display all milestones
    public function index()
    {
        $milestones = Milestone::with('grant')->get();
        return view('milestones.index', compact('milestones'));
    }

    // Show form to create a new milestone
    public function create()
    {
        $grants = Grant::all();
        return view('milestones.create', compact('grants'));
    }

    // Store a newly created milestone
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'target_date' => 'required|date',
            'deliverable' => 'required',
            'status' => 'required|in:Pending,In Progress,Completed',
            'grant_id' => 'required|exists:grants,id',
        ]);

        Milestone::create($request->all());
        return redirect()->route('milestones.index')->with('success', 'Milestone created successfully!');
    }

    // Show a single milestone's details
    public function show(Milestone $milestone)
    {
        return view('milestones.show', compact('milestone'));
    }

    // Show form to edit a milestone
    public function edit(Milestone $milestone)
    {
        $grants = Grant::all();
        return view('milestones.edit', compact('milestone', 'grants'));
    }

    // Update an existing milestone
    public function update(Request $request, Milestone $milestone)
    {
        $request->validate([
            'name' => 'required',
            'target_date' => 'required|date',
            'deliverable' => 'required',
            'status' => 'required|in:Pending,In Progress,Completed',
            'grant_id' => 'required|exists:grants,id',
        ]);

        $milestone->update($request->all());
        return redirect()->route('milestones.index')->with('success', 'Milestone updated successfully!');
    }

    // Delete a milestone
    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->route('milestones.index')->with('success', 'Milestone deleted successfully!');
    }
}
