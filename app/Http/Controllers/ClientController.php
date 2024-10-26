<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::all();
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'name');
        $sortDirection = $request->input('sort_direction', 'asc');
    
        $clients = Client::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
        })->orderBy($sortBy, $sortDirection)->get()->all();
        return view('client.index', compact('clients', 'services', 'search', 'sortBy', 'sortDirection'));
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:clients,email',
            'phone' => 'required|numeric',
            
            'address_home' => 'required|string', // New validation

            'services' => 'nullable|array', // Validate that services are an array
            'services.*' => 'exists:services,id' // Validate each service exists in the services table
        ]);

        // Create the client
        $client = Client::create($validated);

        // Attach the selected services to the client
        if (!empty($request->services)) {
            $client->services()->attach($request->services);
        }

        return redirect()->back()->with('success', 'Client added successfully.');
    }


    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        // Update the client's details
        $client->update($request->only('name', 'email', 'phone', 'address_home'));

        // Sync services
        if ($request->has('services')) {
            $client->services()->sync($request->services);
        } else {
            // If no services are selected, detach all
            $client->services()->detach();
        }

        return redirect()->route('client.index')->with('success', 'Client updated successfully');
    }



    public function show($id)
    {
        $client = Client::with(['services', 'categorys'])->findOrFail($id);
        return view('client.show', compact('client'));
    }

    public function create()
    {
        $services = Service::all(); // Fetch all services
        return view('client.create', compact('services'));
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->back()->with('success', 'deleted successfully.');
    }
}
