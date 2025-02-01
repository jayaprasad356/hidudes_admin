<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');  // Show the login form
    }

    public function login(Request $request)
    {
        // Validate the input (email and password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt login using the 'admins' guard (since you're authenticating against the admin table)
        if (Auth::guard('web')->attempt($credentials)) {
            // If login is successful, redirect to the dashboard or intended page
            return redirect()->intended('/dashboard');
        }

        // If authentication fails, return back with an error message
        return back()->withErrors(['email' => 'Invalid credentials'])
                     ->withInput();  // Add withInput() to retain the input on failure
    }

    public function logout(Request $request)
    {
        // Log the user out
        Auth::logout();
        
        // Redirect to the login page after logout
        return redirect('/login');
    }
}
