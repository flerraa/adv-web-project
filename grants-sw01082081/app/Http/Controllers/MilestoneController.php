<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Grant;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        $milestones = Milestone::with(['grant'])->get();
        return view('milestones.index', compact('milestones'));
    }

    public function create()
    {
        $grants = Grant::all();
        return view('milestones.create', compact('grants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'target_date' => 'required|date',
            'deliverable' => 'required',
            'grant_id' => 'required|exists:grants,id'
        ]);

        Milestone::create($request->all());
        return redirect()->route('milestones.index')->with('success', 'Milestone created successfully!');
    }

    public function edit(Milestone $milestone)
    {
        return view('milestones.edit', compact('milestone'));
    }

    public function update(Request $request, Milestone $milestone)
    {
        $request->validate([
            'name' => 'required',
            'target_date' => 'required|date',
            'deliverable' => 'required',
            'status' => 'required|in:Pending,In Progress,Completed'
        ]);

        $milestone->update($request->all());
        return redirect()->route('milestones.index')->with('success', 'Milestone updated successfully!');
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return redirect()->route('milestones.index')->with('success', 'Milestone deleted successfully!');
    }

    public function updateStatus(Request $request, Milestone $milestone)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed'
        ]);

        $milestone->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status updated successfully!');
    }
}