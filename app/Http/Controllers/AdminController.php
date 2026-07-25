<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\JobPosting;
use App\Models\Notice;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'total_posts' => Post::count(),
            'total_jobs' => JobPosting::count(),
        ];

        $users = User::with('profile')->latest()->paginate(10);
        $notices = Notice::latest()->get();

        return view('admin.dashboard', compact('stats', 'users', 'notices'));
    }

    public function destroyUser(User $user)
    {
        if ($user->isAdmin()) {
            return back()->with('error', 'Cannot delete an administrator account.');
        }
        $user->delete();
        return back()->with('status', 'User account successfully removed.');
    }

    public function storeNotice(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Notice::create([
            'title' => $request->title,
            'body' => $request->body,
            'is_active' => true,
        ]);

        return back()->with('status', 'Notice published successfully.');
    }

    public function destroyNotice(Notice $notice)
    {
        $notice->delete();
        return back()->with('status', 'Notice removed successfully.');
    }
}