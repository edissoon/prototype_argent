<?php

namespace App\Http\Controllers;

use App\Models\Donation;
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
        ]);

        Donation::create($validated);
        
        return redirect()->back()->with('success', 'Donation submitted successfully!');

    }
    
    public function index()
    {
        $donations = Donation::with('member')->orderBy('created_at', 'desc')->get();
        return view('treasurer.donate', compact('donations'));
    }
}