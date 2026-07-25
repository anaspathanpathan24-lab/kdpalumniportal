<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\JobPosting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Gather high-level stats for the dashboard
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_jobs' => JobPosting::count(),
        ];

        // Fetch all users with their profiles for the management table
        $users = User::with('profile')->latest()->paginate(10);

        return view('admin.dashboard', compact('stats', 'users'));
    }

    public function destroyUser(User $user)
    {
        // Prevent admins from accidentally deleting other admins (or themselves)
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete an administrator account.');
        }

        $user->delete();

        return back()->with('status', 'User account successfully removed.');
    }
}