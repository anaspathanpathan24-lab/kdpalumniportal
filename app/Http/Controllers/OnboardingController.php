<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnboardingController extends Controller
{
    // Show the onboarding form
    public function show()
    {
        // If they already have a role, skip this page
        if (Auth::user()->role) {
            return redirect()->route('dashboard');
        }

        return view('auth.onboarding');
    }

    // Save the data
    public function store(Request $request)
    {
        $user = Auth::user();

        // Basic validation
        $request->validate([
            'role' => 'required|in:alumni,student,faculty',
            'phone' => 'required|string',
        ]);

        // Save data to the User model
        $user->role = $request->role;
        $user->phone = $request->country_code . ' ' . $request->phone;

        // If they picked Alumni, save the extra data
        if ($request->role === 'alumni') {
            $user->degree = $request->degree;
            $user->department = $request->department;
            $user->year_joining = $request->year_joining;
            $user->graduation_year = $request->graduation_year;
            $user->entry_no = $request->entry_no;
        }

        $user->save();

        // Redirect to their newly unlocked dashboard!
        return redirect()->route('dashboard')->with('success', 'Welcome to the network!');
    }
}