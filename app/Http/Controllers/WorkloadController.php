<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workload;
use App\Models\Service;

class WorkloadController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'employee' => 'required|exists:users,id',
            'services' => 'required|json', // Check that services is a valid JSON string
        ]);

        // Decode the services array from JSON
        $services = json_decode($validated['services'], true);

        // Store workload in the database, including client_id
        Workload::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'employee_id' => $validated['employee'],
            'services' => json_encode($services), // Encode services as JSON for storage
        ]);

        return redirect()->back()->with('success', 'Workload created successfully');
    }
}
