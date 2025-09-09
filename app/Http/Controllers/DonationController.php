<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Project;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'nullable|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|string',
            'reference' => 'required|string',
            'purpose' => 'required|string',
            'notes' => 'nullable|string',
            'project_id' => 'nullable|exists:church_projects,id', // Add project_id validation
        ]);

        // Create the donation
        $donation = Donation::create($validated);

        // ✅ Fix: Update project raised amount if donation is for a specific project
        if ($validated['purpose'] === 'church_project' && $request->project_id) {
            $project = Project::find($request->project_id);
            if ($project) {
                $project->raised_amount += $validated['amount'];
                $project->save();
            }
        }
        
        return redirect()->back()->with('success', 'Donation submitted successfully!');
    }
    
    public function index()
    {
        $donations = Donation::with('member', 'project')->orderBy('created_at', 'desc')->get();
        return view('treasurer.donate', compact('donations'));
    }
}