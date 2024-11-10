<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workload;
use App\Models\Service;

class WorkloadController extends Controller
{

    public function index()
    {
        $user = auth()->user(); // Get the currently authenticated user
    
        // Retrieve workloads assigned to the logged-in employee
        $workloads = Workload::with(['employee', 'services'])
                    ->where('employee_id', $user->id)
                    ->get();
    
        return view('workload.index', compact('workloads'));
    }
    
  public function showReadOnly()
{
    $user = auth()->user(); // Get the logged-in user

    // Check if the user is of type 'user'
    if ($user->usertype === 'user') {
        // Retrieve workloads where the email matches the logged-in user's email
        $workloads = Workload::with(['employee', 'services'])
                        ->where('email', $user->email)
                        ->get();
    } else {
        // If the user is not of type 'user', show no workloads or handle accordingly
        $workloads = collect(); // Empty collection if user is not authorized
    }

    return view('workload.read-only', compact('workloads'));
}


    public function store(Request $request)
    {
        // Validate and create workload
        $workload = Workload::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee,
            'status' => $request->input('status', 'Pending'), // Add this line
        ]);

        // Attach services if they are present
        if ($request->filled('services')) {
            $workload->services()->sync($request->services);
        }

        return redirect()->route('client.index')->with('success', 'Workload created successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        $workload = Workload::findOrFail($id);
        $workload->status = $request->status;
        $workload->save();

        return redirect()->route('workload.index')->with('success', 'Status updated successfully!');
    }
}