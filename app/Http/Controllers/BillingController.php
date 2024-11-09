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

}
