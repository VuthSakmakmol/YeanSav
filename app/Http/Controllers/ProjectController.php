<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Show all projects (for users and admins)
    public function index()
    {
        $projects = Project::all();
        // Corrected view path to match your folder structure
        return view('pages.projects.index', compact('projects'));
    }

    // Show a specific project along with its details (for users and admins)
    public function show($id)
{
    $project = Project::with('detail.images')->findOrFail($id);
    return view('pages.projects.show', compact('project'));
}

    // Show form to create a new project (for admins only)
    public function create()
    {
        // Corrected view path to match your folder structure
        return view('pages.projects.create');
    }

    // Store a new project in the database (for admins only)
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Store in 'projects' directory within the 'public' disk
            $imagePath = $request->file('image')->store('projects', 'public');
            // Save only the file name, removing the 'projects/' prefix
            $validatedData['image'] = basename($imagePath);
        }

        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    // Show form to edit an existing project (for admins only)
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        // Corrected view path to match your folder structure
        return view('pages.projects.edit', compact('project'));
    }

    // Update an existing project in the database (for admins only)
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Store in 'projects' directory within the 'public' disk
            $imagePath = $request->file('image')->store('projects', 'public');
            // Save only the file name, removing the 'projects/' prefix
            $validatedData['image'] = basename($imagePath);
        }

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    // Delete a project from the database (for admins only)
    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
