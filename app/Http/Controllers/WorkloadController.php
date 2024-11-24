<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Workload;
use App\Models\CompletedWork;

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
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'employee' => 'nullable|exists:users,id',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
        ]);

        // Check if the client is already assigned to any employee
        $duplicate = Workload::where('email', $request->email)->exists();

        if ($duplicate) {
            return redirect()->back()->withErrors(['error' => 'This client is already assigned to an employee.']);
        }

        // Create a workload
        $workload = Workload::create([
            'name' => $request->name,
            'email' => $request->email,
            'employee_id' => $request->employee,
            'status' => $request->input('status', 'Pending'), // Default to "Pending"
        ]);

        // Attach services if provided
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


    public function submitChecklist(Request $request)
    {
        $validated = $request->validate([
            'workload_id' => 'required|exists:workloads,id',
            'checklist' => 'required|array',
            'photo' => 'required|image|max:2048', // Validate photo upload
        ]);

        // Retrieve the workload
        $workload = Workload::findOrFail($validated['workload_id']);

        // Store the uploaded photo
        $photoPath = $request->file('photo')->store('completed_work_photos', 'public');

        // Save to the 'completed_works' table
        CompletedWork::create([
            'workload_id' => $workload->id,
            'checklist' => json_encode($validated['checklist']),
            'photo' => $photoPath,
        ]);

        // Update the workload status to 'Completed'
        $workload->status = 'Completed';
        $workload->save();

        return redirect()->back()->with('success', 'Checklist submitted and workload marked as Completed!');
    }

    public function indexCompletedWorks()
    {
        $completedWorks = CompletedWork::with('workload')->get(); // Assuming you have a relationship
        return view('completed_works.index', compact('completedWorks'));
    }

    public function showCompletedWork($id)
    {
        $completedWork = CompletedWork::findOrFail($id);
        return view('completed_works.show', compact('completedWork'));
    }
}
