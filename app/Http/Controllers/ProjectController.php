<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Donation;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // Show Treasurer Projects Page
    public function index()
    {
        $projects = Project::latest()->get();
        $donations = Donation::with('project')->latest()->get();

        // Not strictly necessary (model accessor exists) but this ensures the attribute is present
        foreach ($projects as $project) {
            $project->progress_percent = $project->progress_percent;
        }

        return view('treasurer.projects', compact('projects', 'donations'));
    }

    // Store new project
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'goal_amount' => 'required|numeric|min:1',
            'start_date'  => 'required|date',
            'image'       => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
        }

        Project::create([
            'name'          => $validated['name'],
            'description'   => $validated['description'] ?? '',
            'goal_amount'   => $validated['goal_amount'],
            'start_date'    => $validated['start_date'],
            'image_url'     => $path,
            'status'        => 'active',
            'raised_amount' => 0,
        ]);

        return redirect()->route('treasurer.projects')->with('success', 'Project added successfully!');
    }

    // Mark project as completed
    public function deactivate($id)
    {
        $project = Project::findOrFail($id);
        $project->status = 'completed';
        $project->save();

        return back()->with('success', 'Project marked as completed.');
    }
}