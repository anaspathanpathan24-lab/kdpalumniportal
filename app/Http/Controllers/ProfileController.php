<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // 1. Update basic user info (Name, Email)
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        // 2. Handle Profile Photo Upload
        $photoPath = $request->user()->profile->photo_path ?? null;

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            ]);
            
            // Delete old photo from storage if a new one is uploaded
            if ($photoPath && Storage::disk('public')->exists($photoPath)) {
                Storage::disk('public')->delete($photoPath);
            }

            $photoPath = $request->file('photo')->store('profile-photos', 'public');
        }

        // 3. Update or Create the custom Profile data
        $request->user()->profile()->updateOrCreate(
            ['user_id' => $request->user()->id],
            [
                'degree' => $request->degree,
                'department' => $request->department,
                'graduation_year' => $request->graduation_year,
                'current_company' => $request->current_company,
                'job_title' => $request->job_title,
                'location' => $request->location,
                'photo_path' => $photoPath,
            ]
        );

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Delete profile photo from storage before deleting user
        if (isset($user->profile->photo_path) && Storage::disk('public')->exists($user->profile->photo_path)) {
            Storage::disk('public')->delete($user->profile->photo_path);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}