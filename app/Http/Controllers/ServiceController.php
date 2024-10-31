<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        // Handle search input
        $search = $request->input('search');

        $services = Service::all();
        
        return view('service.index', compact('services', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'service_name' => 'required|string',
            'price_min' => 'required|numeric',
        ]);

        Service::create($validated);
        return redirect()->back()->with('success', 'added successfully.');
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'service_name' => 'required|string',
            'price_min' => 'required|numeric',
        ]);
    
        $service->update($validated);
    
        return redirect()->back()->with('success', 'updated successfully.');
    }
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->back()->with('success', 'deleted successfully.');
    }
}
