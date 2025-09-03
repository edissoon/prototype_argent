<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChurchSaving;

class ChurchSavingController extends Controller
{
    public function index()
    {
        $savings = ChurchSaving::latest()->get();

        // Get latest balance from last transaction
        $latest = ChurchSaving::latest()->first();
        $currentBalance = $latest ? $latest->balance_after : 0;

        return response()->json([
            'transactions' => $savings,
            'balance' => $currentBalance
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:add,deduct',
            'amount' => 'required|numeric|min:0.01',
            'note' => 'required|string|max:255'
        ]);

        $lastBalance = ChurchSaving::latest()->first()?->balance_after ?? 0;

        $newBalance = $request->type === 'add'
            ? $lastBalance + $request->amount
            : $lastBalance - $request->amount;

        if ($newBalance < 0) {
            return response()->json(['error' => 'Insufficient balance.'], 400);
        }

        $record = ChurchSaving::create([
            'type' => $request->type,
            'amount' => $request->amount,
            'note' => $request->note,
            'balance_after' => $newBalance
        ]);

        // Return full updated data to update UI
        return response()->json($record, 201);
    }
}