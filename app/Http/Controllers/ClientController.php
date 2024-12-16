<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        $employees = User::where('usertype', 'employee')->get(); // Fetch employees from User model
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');
        $sortDirection = $request->input('sort_direction', 'asc');

        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        })->orderBy($sortBy, $sortDirection)->get()->all();
        return view('client.index', compact('clients', 'services', 'employees', 'search', 'sortBy', 'sortDirection'));
    }

    public function showDashboard()
    {
        $clientCount = Client::count(); // Count all clients
        return view('dashboard', compact('clientCount'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:clients,email',
        'phone' => 'required|numeric',
        'address_home' => 'required|string',
        'deadline' => 'nullable|date',
        'feedback' => 'nullable|string',
        'contract_file' => 'nullable|file|mimes:pdf,docx|max:2048',
        'employee_id' => 'nullable|exists:users,id',
        'services' => 'nullable|array',
        'services.*' => 'exists:services,id',
    ]);

    // Handle file upload
    if ($request->hasFile('contract_file')) {
        $validated['contract_file'] = $request->file('contract_file')->store('contracts');
    }

    $client = Client::create($validated);
    if (!empty($request->services)) {
        $client->services()->attach($request->services);
    }

    return redirect()->back()->with('success', 'Client added successfully.');
}

public function update(Request $request, $id)
{
    $client = Client::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:clients,email,' . $id,
        'phone' => 'required|numeric',
        'address_home' => 'required|string',
        'deadline' => 'nullable|date',
        'feedback' => 'nullable|string',
        'contract_file' => 'nullable|file|mimes:pdf,docx|max:2048',
        'employee_id' => 'nullable|exists:users,id',
    ]);

    if ($request->hasFile('contract_file')) {
        // Delete old file if exists
        if ($client->contract_file) {
            Storage::delete($client->contract_file);
        }
        $validated['contract_file'] = $request->file('contract_file')->store('contracts');
    }

    $client->update($validated);

    if ($request->has('services')) {
        $client->services()->sync($request->services);
    } else {
        $client->services()->detach();
    }

    return redirect()->route('client.index')->with('success', 'Client updated successfully.');
}



    public function show($id)
    {
        $client = Client::with(['services', 'categorys'])->findOrFail($id);
        return view('client.show', compact('client'));
    }


    public function create()
    {
        // Fetch IDs of employees who are already assigned to a client
        $assignedEmployeeIds = Client::whereNotNull('employee_id')->pluck('employee_id')->toArray();

        // Get only unassigned employees by excluding assignedEmployeeIds
        $employees = User::where('usertype', 'employee')
            ->whereNotIn('id', $assignedEmployeeIds)
            ->get();

        $services = Service::all(); // Fetch all services as usual
        return view('client.create', compact('employees', 'services'));
    }


    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->back()->with('success', 'deleted successfully.');
    }
}
