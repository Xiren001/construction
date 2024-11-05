<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class LogController extends Controller
{
    public function generateReport(Request $request)
    {
        // Get the selected month and year, or default to the current month and year
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // Get logs for the selected month and year
        $logs = Log::whereMonth('created_at', $month)
                    ->whereYear('created_at', $year)
                    ->get();

        // Calculate totals
        $totalCash = $logs->where('payment_method', 'cash')->sum('price');
        $totalGcash = $logs->where('payment_method', 'gcash')->sum('price');
        $totalOverall = $logs->sum('price');

        // Pass the data and selected month/year to the view
        return view('logs.report', compact('logs', 'totalCash', 'totalGcash', 'totalOverall', 'month', 'year'));
    }
}
