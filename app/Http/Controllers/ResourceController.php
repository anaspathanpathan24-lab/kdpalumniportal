<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::with('user.profile')->latest();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $resources = $query->paginate(10);

        return view('resources.index', compact('resources'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:mooc,exam_paper,study_notes,other'],
            'description' => ['nullable', 'string'],
            'url' => ['nullable', 'url', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf,doc,docx,zip,ppt,pptx', 'max:10240'], // Max 10MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resource_vault', 'public');
        }

        $request->user()->resources()->create([
            'title' => $request->title,
            'category' => $request->category,
            'description' => $request->description,
            'url' => $request->url,
            'file_path' => $filePath,
        ]);

        return redirect()->route('resources.index')->with('status', 'Resource shared successfully!');
    }
}