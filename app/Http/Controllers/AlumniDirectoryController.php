<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile; // Make sure this model is imported
use Illuminate\Http\Request;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile');

        // 1. Keyword Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('department', 'like', "%{$search}%")
                         ->orWhere('company', 'like', "%{$search}%")
                         ->orWhere('designation', 'like', "%{$search}%");
                  });
            });
        }

        // 2. Apply Sidebar Filters
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        
        $profileFilters = [
            'year_joining', 'graduation_year', 'degree', 
            'department', 'company', 'designation', 'work_industry'
        ];

        foreach ($profileFilters as $filter) {
            if ($request->filled($filter)) {
                $query->whereHas('profile', function($pq) use ($request, $filter) {
                    $pq->where($filter, $request->$filter);
                });
            }
        }

        if ($request->filled('skills')) {
            $query->whereHas('profile', function($pq) use ($request) {
                $pq->where('skills', 'like', "%{$request->skills}%");
            });
        }

        $alumni = $query->paginate(12);

        // 3. Fetch unique data for sidebar dropdowns (ignoring nulls)
        $roles = User::select('role')->distinct()->pluck('role');
        
        // Fetching unique values from the Profile table
        $joinYears = Profile::select('year_joining')->distinct()->whereNotNull('year_joining')->orderBy('year_joining', 'desc')->pluck('year_joining');
        $gradYears = Profile::select('graduation_year')->distinct()->whereNotNull('graduation_year')->orderBy('graduation_year', 'desc')->pluck('graduation_year');
        $degrees = Profile::select('degree')->distinct()->whereNotNull('degree')->pluck('degree');
        $departments = Profile::select('department')->distinct()->whereNotNull('department')->pluck('department');
        $companies = Profile::select('company')->distinct()->whereNotNull('company')->pluck('company');
        $designations = Profile::select('designation')->distinct()->whereNotNull('designation')->pluck('designation');
        $industries = Profile::select('work_industry')->distinct()->whereNotNull('work_industry')->pluck('work_industry');

        return view('alumni.index', compact(
            'alumni', 'roles', 'joinYears', 'gradYears', 'degrees', 
            'departments', 'companies', 'designations', 'industries'
        ));
    }
}