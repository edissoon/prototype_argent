<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pledge;
use App\Models\Donation;

class PledgeController extends Controller
{
    public function showPledgeLogs(Request $request)
    {
        $query = Pledge::query();

        // Filtering
        if ($request->filled('member')) {
            $query->where('member_name', 'LIKE', '%' . $request->member . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('frequency')) {
            $query->where('frequency', $request->frequency);
        }

        $pledges = $query->latest()->paginate(10);

        // Summary Calculations
        $totalPledged = $query->sum('amount');
        $totalCollected = $query->where('status', 'completed')->sum('amount');
        $missedPledges = $query->where('status', 'missed')->count();

        // ✅ ADD THIS: Get pledge donations from the donations table
        $pledgeDonations = Donation::where('purpose', 'pledge')
            ->with('member') // Load member relationship
            ->latest()
            ->get();

        return view('treasurer.pledges', compact(
            'pledges',
            'totalPledged',
            'totalCollected',
            'missedPledges',
            'pledgeDonations' // ✅ Pass this to the view
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_name' => 'required|string',
            'amount' => 'required|numeric',
            'pledge_date' => 'required|date',
            'frequency' => 'required|string',
            'send_reminder' => 'required|string',
        ]);

        Pledge::create([
            'member_name' => $request->member_name,
            'amount' => $request->amount,
            'pledge_date' => $request->pledge_date,
            'frequency' => $request->frequency,
            'send_reminder' => $request->send_reminder === 'yes',
        ]);

        return redirect()->back()->with('success', 'Pledge added successfully!');
    }
}