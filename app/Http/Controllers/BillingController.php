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

        // Calculate total price for all billings (or you can adjust for specific client if needed)
        $totalPrice = $this->calculateTotalPrice();

        $billings = Billing::where('hidden', false) // Only non-hidden records
        ->when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
        })
        ->orderBy($sortBy, $sortDirection) // Sort by the specified column and direction
        ->get()->all();

        return view('billing.index', compact('billings', 'search', 'sortBy', 'sortDirection', 'totalPrice'));
    }

    private function calculateTotalPrice()
    {
        // Adjust this to calculate total for relevant services
        $billings = Billing::all();
        $total = 0;

        foreach ($billings as $billing) {
            $total += $billing->price; // Assuming `price` holds the service amount
        }

        return $total;
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'price' => 'required|array', // Ensure it's an array
            'price.*' => 'numeric', // Validate each price in the array
        ]);

        // Check if a record with the same name and email already exists
        $existingBilling = Billing::where('name', $request->name)
            ->where('email', $request->email)
            ->first();

        if ($existingBilling) {
            return redirect()->back()->with('error', 'Information already exists.');
        }

        // Sum all the prices from the request
        $totalPrice = array_sum($request->price);

        // Create a single billing record with the total price
        Billing::create([
            'name' => $request->name,
            'email' => $request->email,
            'price' => $totalPrice,
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
            'price' => $billing->price,
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
