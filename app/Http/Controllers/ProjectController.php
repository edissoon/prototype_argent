<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Treasurer view
    public function index()
    {
        $projects = Project::latest()->get();
        return view('treasurer.project', compact('projects'));
    }

    // Public projects for landing page
    public function publicProjects()
    {
        $projects = Project::where('status', 'active')->latest()->get();
        return view('landing', compact('projects'));
    }

    // Member projects view
    public function memberProjects()
    {
        $projects = Project::where('status', 'active')->latest()->get();
        return view('member.home', compact('projects'));
    }

    // Store new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'image' => 'nullable|image|max:10240', // 10MB max
            'status' => 'required|in:active,completed,archived',
        ]);

        // Set current_amount to 0 for new projects
        $validated['current_amount'] = 0;

        if ($request->hasFile('image')) {
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($validated);

        return redirect()->route('treasurer.projects')->with('success', 'Project added successfully!');
    }

    // Show edit form
    public function edit(Project $project)
    {
        $projects = Project::latest()->get();
        return view('treasurer.project', compact('projects', 'project'));
    }

    // Update existing project
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'target_amount' => 'required|numeric|min:1', 
            'image' => 'nullable|image|max:10240',
            'status' => 'required|in:active,completed,archived',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($project->image_path) {
                Storage::disk('public')->delete($project->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('treasurer.projects')->with('success', 'Project updated successfully!');
    }

    // Toggle project status
    public function toggle(Project $project)
    {
        $newStatus = $project->status === 'archived' ? 'active' : 'archived';
        $project->update(['status' => $newStatus]);

        $message = $newStatus === 'active' ? 'Project restored successfully!' : 'Project archived successfully!';
        return redirect()->route('treasurer.projects')->with('success', $message);
    }

    // Delete project
    public function destroy(Project $project)
    {
        // Delete associated image if exists
        if ($project->image_path) {
            Storage::disk('public')->delete($project->image_path);
        }
        
        $project->delete();

        return redirect()->route('treasurer.projects')->with('success', 'Project deleted successfully!');
    }

    // Add method to update current amount (for donations)
    public function updateCurrentAmount(Project $project, $amount)
    {
        $project->increment('current_amount', $amount);
        return $project;
    }
}