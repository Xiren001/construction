<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Log;

class BillingController extends Controller
{
    public function index()
    {
        $search = request('search');
        $sortBy = request('sort_by', 'name');
        $sortDirection = request('sort_direction', 'asc');

        $billings = Billing::where('hidden', false) // Only non-hidden records
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sortBy, $sortDirection) // Sort by the specified column and direction
            ->get()->all();

        return view('billing.index', compact('billings', 'search', 'sortBy', 'sortDirection'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Check if a record with the same name and email already exists
        $existingBilling = Billing::where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        if ($existingBilling) {
            return redirect()->back()->with('error', 'Information already exists.');
        }

        // Create a single billing record
        Billing::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'Successfully Recorded.');
    }

    public function confirmPayment($id, Request $request)
    {
        // Find the billing record
        $billing = Billing::findOrFail($id);

        // Insert the billing data into the logs table
        \DB::table('logs')->insert([
            'name' => $billing->name,
            'email' => $billing->email,
            'payment_method' => $request->paymentMethod,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Hide the billing entry instead of deleting it
        $billing->hidden = true;
        $billing->save();

        return response()->json(['success' => true]);
    }

    public function viewLogs(Request $request)
    {
        $search = $request->input('search');

        $logs = \DB::table('logs')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('payment_method', 'like', "%{$search}%");
            })
            ->get();

        return view('logs.index', compact('logs'));
    }
}
