<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile');

        // General search keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('department', 'like', "%{$search}%")
                        ->orWhere('current_company', 'like', "%{$search}%")
                        ->orWhere('job_title', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('graduation_year', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by Graduation Year
        if ($request->filled('graduation_year')) {
            $query->whereHas('profile', function($pq) use ($request) {
                $pq->where('graduation_year', $request->graduation_year);
            });
        }

        // Filter by Location
        if ($request->filled('location')) {
            $query->whereHas('profile', function($pq) use ($request) {
                $pq->where('location', 'like', "%{$request->location}%");
            });
        }

        $alumni = $query->paginate(10);

        return view('alumni.index', compact('alumni'));
    }
}