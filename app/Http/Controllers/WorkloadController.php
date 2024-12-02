<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CompletedWork;
use App\Models\Service;

use App\Models\User; // Import the User model
use App\Models\Client; // Ensure you have this model if you're using it
use App\Models\Workload; // Import the Workload model

class WorkloadController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Retrieve workloads assigned to the logged-in employee
        $workloads = Workload::with(['employee', 'services'])
            ->where('employee_id', $user->id)
            ->where('hidden', false) // Exclude hidden workloads
            ->get();

        $services = Service::all();

        return view('workload.index', compact('workloads', 'services'));
    }


    public function showReadOnly()
    {
        $user = auth()->user(); // Get the logged-in user

        if ($user->usertype === 'user') {
            // Retrieve workloads where the email matches the logged-in user's email
            $workloads = Workload::with(['employee', 'services'])
                ->where('email', $user->email)
                ->get();
            $services = Service::all();
        } else {
            // If the user is not of type 'user', show no workloads or handle accordingly
            $workloads = collect(); // Empty collection if user is not authorized
        }

        return view('workload.read-only', compact('workloads', 'services'));
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
        if ($request->has('services')) {
            $workload->services()->sync($request->services);
        }

        return redirect()->route('client.index')->with('success', 'Workload created successfully!');
    }



    public function updateStatus(Request $request, $id)
    {
        // Find the workload by ID
        $workload = \App\Models\Workload::find($id);

        // Check if workload exists
        if (!$workload) {
            return redirect()->route('workload.index')->with('error', 'Workload not found.');
        }

        // Check if the status is "Canceled"
        if ($request->status === 'Canceled') {
            // Check if services are associated with the workload
            $services = $workload->services ? $workload->services->pluck('id')->toArray() : [];

            // Move the workload to the `canceled_workloads` table
            \App\Models\CanceledWorkload::create([
                'name' => $workload->name,
                'email' => $workload->email,
                'employee_id' => $workload->employee_id,
                'services' => $services, // Save service IDs
            ]);

            // Delete the workload from the `workloads` table
            $workload->delete();
        } else {
            // Update the status if not canceled
            $workload->status = $request->status;
            $workload->save();
        }

        // Redirect to the workload index with a success message
        return redirect()->route('workload.index')->with('success', 'Status updated successfully!');
    }



    public function submitChecklist(Request $request)
    {
        $validated = $request->validate([
            'workload_id' => 'required|exists:workloads,id',
            'checklist' => 'required|array',
            'photo' => 'required|image|max:10240', // Validate photo upload
        ]);

        // Retrieve the workload
        $workload = Workload::findOrFail($validated['workload_id']);

        // Store the uploaded photo
        $photoPath = $request->file('photo')->store('completed_work_photos', 'public');

        // Save to the 'completed_works' table
        CompletedWork::create([
            'workload_id' => $workload->id,
            'workload_name' => $workload->name,
            'employee_name' => $workload->employee->name ?? 'No Employee',
            'checklist' => json_encode($validated['checklist']),
            'photo' => $photoPath,
        ]);

        // Update the workload status to 'Completed' and set it as hidden
        $workload->update([
            'status' => 'Completed',
            'hidden' => true,
        ]);

        return redirect()->back()->with('success', 'Checklist submitted and workload marked as Completed!');
    }

    public function showDashboard()
    {
        $employeeCount = User::count(); // Assuming employees are stored in the `users` table
        $clientCount = Client::count(); // Replace `Client` with your actual model name for clients
        $completedCount = Workload::where('status', 'Completed')->count();
        $canceledCount = Workload::where('status', 'Canceled')->count();
    
        return view('dashboard', compact('employeeCount', 'clientCount', 'completedCount', 'canceledCount'));
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
