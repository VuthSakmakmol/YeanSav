<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectDetailController extends Controller
{
    // Create project detail
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId); // Ensure the project exists
        return view('pages.projectsdetails.create', compact('project')); // Return the view for creating project details
    }

    // Show project detail
    public function show($projectId)
    {
        // Find the project or throw a 404
        $project = Project::findOrFail($projectId);

        // Load the related detail or return null if not found
        $projectDetail = $project->detail;

        // Pass both the project and its detail to the view
        return view('pages.projectsdetails.show', compact('project', 'projectDetail'));
    }


    // Store new project details
    public function store(Request $request, $projectId)
    {
        $validatedData = $request->validate([
            'client' => 'required|string',
            'size' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'architect' => 'nullable|string',
            'link' => 'nullable|url',
            'instructor_image' => 'nullable|image|max:2048', // Validation for the image file
        ]);

        // Store the uploaded image if it exists
        if ($request->hasFile('instructor_image')) {
            $path = $request->file('instructor_image')->store('project-details', 'public');
            $validatedData['instructor_image'] = $path; // Store the path in the database
        }

        $validatedData['project_id'] = $projectId;

        ProjectDetail::create($validatedData);

        return redirect()->route('projectsdetails.show', $projectId)
            ->with('success', 'Project details created successfully.');
    }

    // Edit project detail
    public function edit($projectId, $projectDetailId)
    {
        $project = Project::findOrFail($projectId);
        $projectDetail = ProjectDetail::findOrFail($projectDetailId);

        return view('pages.projectsdetails.edit', compact('project', 'projectDetail'));
    }

    public function update(Request $request, $projectId, $detailId)
    {
        $projectDetail = ProjectDetail::findOrFail($detailId);
    
        // Update basic details
        $projectDetail->update($request->only('client', 'size', 'price', 'location', 'architect', 'link'));
    
        // Handle instructor image (if provided)
        if ($request->hasFile('instructor_image')) {
            $imagePath = $request->file('instructor_image')->store('project-details', 'public');
            $projectDetail->update(['instructor_image' => $imagePath]);
        }
    
        // Handle multiple images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project-details', 'public');
                Image::create([
                    'project_detail_id' => $projectDetail->id,
                    'image_path' => $path,
                ]);
            }
        }
        
        return redirect()->route('projectsdetails.show', [$projectId, $detailId])->with('success', 'Project details updated successfully.');
    }
    



    // Delete project detail
    public function destroy($projectId, $projectDetailId)
    {
        $projectDetail = ProjectDetail::findOrFail($projectDetailId);

        // Delete the image from storage if it exists
        if ($projectDetail->instructor_image && Storage::disk('public')->exists($projectDetail->instructor_image)) {
            Storage::disk('public')->delete($projectDetail->instructor_image);
        }

        $projectDetail->delete();

        return redirect()->route('projects.index', $projectId)->with('success', 'Project detail deleted successfully.');
    }
}
