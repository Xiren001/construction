<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        // Redirect based on usertype
        if ($user->usertype === 'admin') {
            return redirect()->route('dashboard');
        } elseif ($user->usertype === 'employee') {
            return redirect()->route('workload.index');
        } else {
            return redirect()->route('landingpage');
        }
    }

    // If authentication fails
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}


    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $user = Auth::user();
    
        // Restrict access to admin only
        if ($user->usertype !== 'admin') {
            return redirect()->route('landingpage');
        }
    
        return view('dashboard');
    }
    
    public function workload()
    {
        $user = Auth::user();
    
        // Restrict access to the workload page for non-employees
        if (!$user || $user->usertype !== 'employee') {
            return redirect()->route('landingpage');
        }
    
        return view('workload.index');
    }

    public function landingpage()
    {
        return view('landingpage');
    }
}
