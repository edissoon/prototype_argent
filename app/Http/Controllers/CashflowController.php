<?php

namespace App\Http\Controllers;

use App\Models\Cashflow;
use App\Models\CashflowExpenseEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CashflowController extends Controller
{
    // show the Blade view
    public function index()
    {
        return view('treasurer.cshflw'); // path: resources/views/treasurer/cashflow.blade.php
    }

    // load existing records for a date (AJAX)
    public function loadByDate(Request $request)
    {
        $request->validate([
            'date' => 'required|date'
        ]);

        $cashflow = Cashflow::whereDate('record_date', $request->date)->with('expenseEntries')->first();

        if (!$cashflow) {
            return response()->json(['found' => false]);
        }

        return response()->json([
            'found' => true,
            'cashflow' => $cashflow,
            'expenses' => $cashflow->expenseEntries()->orderBy('id')-> get(),
        ]);
    }

    // save all (summary & expense entries)
    public function store(Request $request)
    {
        $rules = [
            'record_date' => 'required|date',
            'total_income' => 'required|numeric',
            'total_tithes' => 'required|numeric',
            'total_offering' => 'required|numeric',
            'total_others' => 'required|numeric',
            'total_expenses' => 'required|numeric',
            'net_balance' => 'required|numeric',
            'income_records' => 'required|array',
            'expense_entries' => 'required|array',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success'=>false, 'errors'=>$validator->errors()], 422);
        }

        // prevent duplicate record for same date (option: update instead of create)
        DB::beginTransaction();
        try {
            // if exists, delete old (or you can update instead)
            $existing = Cashflow::whereDate('record_date', $request->record_date)->first();
            if ($existing) {
                $existing->expenseEntries()->delete();
                $existing->delete();
            }

            $cashflow = Cashflow::create([
                'record_date' => $request->record_date,
                'total_income' => $request->total_income,
                'total_tithes' => $request->total_tithes,
                'total_offering' => $request->total_offering,
                'total_others' => $request->total_others,
                'total_expenses' => $request->total_expenses,
                'net_balance' => $request->net_balance,
                'income_records' => $request->income_records,
            ]);

            foreach ($request->expense_entries as $entry) {
            $cashflow->expenseEntries()->create([
                'expense_name' => $entry['expense_name'] ?? 'Unnamed expense',
                'amount' => $entry['amount'] ?? 0,
                'is_auto' => isset($entry['is_auto']) ? (bool)$entry['is_auto'] : false,
                'note' => $entry['note'] ?? null,
            ]);
            }

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Records saved', 'cashflow_id' => $cashflow->id]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['success'=>false, 'message'=>'Server error', 'error'=>$e->getMessage()], 500);
        }
    }

    // simple archive list (recent saved dates)
    public function archiveList()
    {
        $list = Cashflow::orderBy('record_date', 'desc')
            ->limit(10)
            ->get(['id','record_date','total_income','net_balance']);
        return response()->json(['list' => $list]);
    }
}