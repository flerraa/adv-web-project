<?php

namespace App\Http\Controllers;

use App\Models\Academician;
use Illuminate\Http\Request;

class AcademicianController extends Controller
{
    // Display all academicians
    public function index()
    {
        $academicians = Academician::all();
        return view('academicians.index', compact('academicians'));
    }

    // Show form to create a new academician
    public function create()
    {
        return view('academicians.create');
    }

    // Store a newly created academician
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'staff_number' => 'required|string|unique:academicians', 
            'email' => 'required|email|unique:academicians',
            'college' => 'required',
            'department' => 'required',
            'position' => 'required',
        ]);

        Academician::create($request->all());
        return redirect()->route('academicians.index')->with('success', 'Academician created successfully!');
    }

    // Show a single academician's details
    public function show(Academician $academician)
    {
        $grants = $academician->grants;
        return view('academicians.show', compact('academician', 'grants'));

    }

    // Show form to edit an academician
    public function edit(Academician $academician)
    {
        return view('academicians.edit', compact('academician'));
    }

    // Update an existing academician
    public function update(Request $request, Academician $academician)
    {
        $request->validate([
            'name' => 'required',
            'staff_number' => 'required|string|unique:academicians,staff_number,' . $academician->id . ',id',
            'email' => 'required|email|unique:academicians,email,' . $academician->id . ',id',
             'college' => 'required',
            'college' => 'required',
            'department' => 'required',
            'position' => 'required',
        ]);

        $academician->update($request->all());
        return redirect()->route('academicians.index')->with('success', 'Academician updated successfully!');
    }

    // Delete an academician
    public function destroy(Academician $academician)
    {
        $academician->delete();
        return redirect()->route('academicians.index')->with('success', 'Academician deleted successfully!');
    }
}
