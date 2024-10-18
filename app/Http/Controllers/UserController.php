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
            if ($user->usertype == 'admin') {
                return redirect()->route('dashboard');
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

        // Ensure only admin users can access the dashboard
        if ($user->usertype != 'admin') {
            return redirect()->route('landingpage');
        }

        return view('dashboard');
    }
   
}
