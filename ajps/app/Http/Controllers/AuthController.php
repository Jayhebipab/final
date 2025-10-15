<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Hanapin ang user sa database
        $user = User::where('email', $request->email)->first();

if ($user && $user->password === $request->password) {
    session([
        'user_id' => $user->id,
        'user_name' => $user->name,
        'user_email' => $user->email,
        'user_role' => $user->role ?? 'user',
    ]);

    return redirect('/dashboard');
}

        // Kung invalid
        return back()->with('error', 'Invalid email or password.');
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login')->with('error', 'You have been logged out.');
    }
}
