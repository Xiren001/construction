<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class EmployeeController extends Controller
{
    public function index()
{
    $employees = User::where('usertype', 'employee')->get();
    return view('employees.index', compact('employees'));
}

public function showDashboard()
{
    $employeeCount = User::where('usertype', 'employee')->count();
    return view('dashboard', compact('employeeCount'));
}

    
}




