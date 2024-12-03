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
    
        // Employees should not access the dashboard
        if ($user->usertype === 'employee') {
            return redirect()->route('workload.index');
        }
    
        // Only allow admins
        if ($user->usertype === 'admin') {
            return view('dashboard');
        }
    
        // Redirect unauthorized users
        return redirect()->route('landingpage');
    }
    

    
}
