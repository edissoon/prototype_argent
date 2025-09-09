<?php

namespace App\Http\Controllers;

use App\Helpers\FinanceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Donation;
use App\Models\Project;

class MemberController extends Controller
{
    public function memberDashboard()
    {
        $overview = FinanceHelper::getFinancialOverview();

        // Get active projects with model accessor progress_percent
            $projects = Project::where('status', 'active')->latest()->get();

            foreach ($projects as $project) {
                $goal = $project->goal_amount;
                $raised = $project->raised_amount;
                $project->progress_percent = $goal > 0 ? min(($raised / $goal) * 100, 100) : 0;
            }

            // Get user's donation history
            $userDonations = Donation::where('member_id', Auth::id())
                ->with('project')
                ->orderBy('created_at', 'desc')
                ->get();

            // If $overview is an array of data, merge it; otherwise pass individually
            if (is_array($overview)) {
                $data = array_merge($overview, [
                    'projects' => $projects,
                    'userDonations' => $userDonations,
                ]);
                return view('member.home', $data);
            }

            return view('member.home', array_merge($overview, ['projects' => $projects]));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'ministry' => 'nullable|string|max:100',
        ]);

    }

    public function memberIndex()
    {
        // Fetch all active projects
        $projects = Project::where('status', 'active')->latest()->get();

        // Fetch donations for the currently logged-in member (if available)
        $user = Auth::user();
        $donations = collect(); // Default to an empty collection
        if ($user) {
            $donations = Donation::where('email', $user->email)->with('project')->latest()->get();
        }

        // Pass the projects and donations data to the view
        return view('member.home', compact('projects', 'donations'));
    }

}