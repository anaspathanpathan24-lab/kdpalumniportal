<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AlumniDirectoryController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('profile');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('profile', function($pq) use ($search) {
                      $pq->where('department', 'like', "%{$search}%")
                        ->orWhere('current_company', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('graduation_year', 'like', "%{$search}%");
                  });
            });
        }

        $alumni = $query->paginate(10);

        return view('alumni.index', compact('alumni'));
    }
}