<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Staff;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index(Request $request)
    {
        // Handle search input
        $search = $request->input('search');

        // Sorting by name or email, default is by name
        $sortBy = $request->input('sort_by', 'name');
        $sortDirection = $request->input('sort_direction', 'asc');

        // Query doctors and staff
        $doctors = Doctor::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orderBy($sortBy, $sortDirection)->get();

        $staff = Staff::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->orderBy($sortBy, $sortDirection)->get();

        return view('personnel.index', compact('doctors', 'staff', 'search', 'sortBy', 'sortDirection'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors|unique:staff',
            'position' => 'required|string',
        ]);

        if ($request->position === 'doctor') {
            Doctor::create($validated);
        } else {
            Staff::create($validated);
        }

        return redirect()->route('personnel.index')->with('success', 'added successfully');
    }

    public function destroy($id, $type)
    {
        if ($type === 'doctor') {
            Doctor::destroy($id);
        } else {
            Staff::destroy($id);
        }

        return redirect()->route('personnel.index')->with('success', 'deleted successfully');
    }


    public function update(Request $request, $id)
    {
        $personnel = Doctor::find($id) ?? Staff::find($id); // Find either doctor or staff by ID
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $personnel->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'updated successfully.');
    }
}
