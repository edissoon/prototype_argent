<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashflowExpenseEntry;

class ExpenseController extends Controller
{
    public function storeEntries(Request $request)
    {
        $entries = $request->input('entries', []);
        
        if (empty($entries)) {
            return response()->json(['success' => false, 'message' => 'No expense entries received']);
        }

        foreach ($entries as $entry) {
            CashflowExpenseEntry::create([
                'expense_name' => $entry['expense_name'] ?? 'Unknown',
                'amount'       => $entry['amount'] ?? 0,
            ]);
        }

        return response()->json(['success' => true]);
        }
}