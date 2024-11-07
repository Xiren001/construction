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

            // Allow only admins and employees to access the dashboard
            if ($user->usertype == 'admin' || $user->usertype == 'employee') {
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

        // Ensure only admin and employee users can access the dashboard
        if (!in_array($user->usertype, ['admin', 'employee'])) {
            return redirect()->route('landingpage');
        }

        return view('dashboard');
    }
}
