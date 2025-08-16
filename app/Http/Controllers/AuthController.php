<?php

namespace App\Http\Controllers;

// 1. IMPORT THESE CLASSES
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
    // --- Your existing login methods ---
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    // 2. ADD THE TWO NEW METHODS BELOW

    /**
     * Display the signup form view.
     */
    public function showSignupForm(): View
    {
        return view('signup');
    }

    /**
     * Handle the signup form submission.
     */
    public function handleSignup(Request $request)
{
    // Validate all the form fields
    $validated = $request->validate([
        'fullname' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username',
        'dob'      => 'required|date_format:d-m-Y', // ✅ This is the correct line
        'gender'   => 'required|string',
        'contact'  => 'required|string|max:20',
        'address'  => 'required|string',
        'password' => 'required|string|min:8',
    ]);

    // Create the user in the database
    $user = User::create([
        'fullname' => $validated['fullname'],
        'username' => $validated['username'],
        'dob'      => $validated['dob'],
        'gender'   => $validated['gender'],
        'contact'  => $validated['contact'],
        'address'  => $validated['address'],
        'password' => Hash::make($validated['password']), // Hash the password
    ]);

    // Redirect to the login page with a success message
    return redirect()->route('login.form')
        ->with('success', 'Account created successfully! Please log in.');
}

    // --- Your existing logout method ---
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}