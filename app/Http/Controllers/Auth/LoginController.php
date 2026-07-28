<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    // 1. Redirect user to Google's OAuth screen
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // 2. Handle the callback from Google after successful authentication
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists in the database by email
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // If the user doesn't exist, create them as a new record
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(uniqid()), // Random secure password for OAuth users
                ]);
            }

            // Log the user into the application
            Auth::login($user);

            // Check if they have finished onboarding (e.g., selected their role)
            if (empty($user->role)) {
                return redirect()->route('onboarding');
            }

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google authentication failed. Please try again.');
        }
    }
    
    // 3. Handle Email-only form submissions from the login view
    public function loginWithEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            Auth::login($user);
            
            if (empty($user->role)) {
                return redirect()->route('onboarding');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'No account found with this email address.']);
    }
}