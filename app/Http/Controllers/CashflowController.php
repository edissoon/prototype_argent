<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cashflow;
use Carbon\Carbon;
use App\Models\CashflowRecord;


class CashflowController extends Controller
{
    public function index()
    {
        return view('cashflow.index');
    }

    public function getByDate($date)
    {
        try {
            $cashflow = Cashflow::where('record_date', $date)->first();
            
            if ($cashflow) {
                return response()->json([
                    'success' => true,
                    'data' => $cashflow
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No cashflow record found for this date'
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving cashflow data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function reports()
    {
        // Get recent cashflow records
        $recentRecords = Cashflow::orderBy('record_date', 'desc')
                                ->take(10)
                                ->get();

        // Get current month summary
        $currentMonthSummary = Cashflow::getCurrentMonthSummary();

        // Get yearly summary
        $currentYear = now()->year;
        $yearlySummary = Cashflow::whereYear('record_date', $currentYear)
                                ->selectRaw('
                                    SUM(total_income) as total_income,
                                    SUM(tithes) as total_tithes,
                                    SUM(offering) as total_offering,
                                    SUM(others) as total_others,
                                    SUM(total_expenses) as total_expenses,
                                    SUM(balance) as total_balance
                                ')
                                ->first();

        return view('cashflow.reports', compact(
            'recentRecords', 
            'currentMonthSummary', 
            'yearlySummary'
        ));
    }

    // Get main cashflow data for a specific date
    public function getData($date)
    {
        try {
            $record = CashflowRecord::where('record_date', $date)->first();
            
            if ($record) {
                return response()->json([
                    'success' => true,
                    'data' => $record
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No record found for this date'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving data: ' . $e->getMessage()
            ]);
        }
    }

    // Get income entries for a specific date
    public function getIncomeEntries($date)
    {
        try {
            $entries = CashflowIncomeEntry::where('record_date', $date)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'entries' => $entries
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving income entries: ' . $e->getMessage()
            ]);
        }
    }

    // Get expense entries for a specific date
    public function getExpenseEntries($date)
    {
        try {
            $entries = CashflowExpenseEntry::where('record_date', $date)
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'entries' => $entries
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving expense entries: ' . $e->getMessage()
            ]);
        }
    }

    // Get all previous records for archive
    public function getPreviousRecords()
    {
        try {
            $records = CashflowRecord::orderBy('record_date', 'desc')
                ->get(['record_date', 'total_income', 'total_expenses', 'balance']);

            return response()->json([
                'success' => true,
                'records' => $records
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving previous records: ' . $e->getMessage()
            ]);
        }
    }

    // Save main cashflow record
    public function save(Request $request)
    {
        try {
            // Validate incoming data
            $validatedData = $request->validate([
                'record_date' => 'required|date',
                'total_income' => 'required|numeric|min:0',
                'tithes' => 'required|numeric|min:0',
                'offering' => 'required|numeric|min:0',
                'others' => 'required|numeric|min:0',
                'total_expenses' => 'required|numeric|min:0',
                'balance' => 'required|numeric'
            ]);

            // Save or update cashflow record based on record_date
            $cashflow = Cashflow::updateOrCreate(
                ['record_date' => $validatedData['record_date']],
                [
                    'total_income' => $validatedData['total_income'],
                    'tithes' => $validatedData['tithes'],
                    'offering' => $validatedData['offering'],
                    'others' => $validatedData['others'],
                    'total_expenses' => $validatedData['total_expenses'],
                    'balance' => $validatedData['balance']
                ]
            );

            return response()->json([
                'success' => true,
                'message' => 'Cashflow record saved successfully!',
                'data' => $cashflow
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving cashflow record: ' . $e->getMessage()
            ], 500);
        }
    }

    // Save income entries
    public function saveIncomeEntries(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'entries' => 'required|array',
                'entries.*.record_date' => 'required|date',
                'entries.*.name' => 'required|string|max:255',
                'entries.*.tithes' => 'required|numeric|min:0',
                'entries.*.offering' => 'required|numeric|min:0',
                'entries.*.others' => 'required|numeric|min:0',
                'entries.*.note' => 'nullable|string'
            ]);

            $entries = $validatedData['entries'];
            $recordDate = $entries[0]['record_date'];

            // Delete existing entries for this date
            CashflowIncomeEntry::where('record_date', $recordDate)->delete();

            // Insert new entries
            foreach ($entries as $entry) {
                CashflowIncomeEntry::create($entry);
            }

            return response()->json([
                'success' => true,
                'message' => 'Income entries saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving income entries: ' . $e->getMessage()
            ]);
        }
    }

    // Save expense entries
    public function saveExpenseEntries(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'entries' => 'required|array',
                'entries.*.record_date' => 'required|date',
                'entries.*.name' => 'required|string|max:255',
                'entries.*.amount' => 'required|numeric|min:0',
                'entries.*.is_auto' => 'boolean'
            ]);

            $entries = $validatedData['entries'];
            $recordDate = $entries[0]['record_date'];

            // Delete existing manual entries for this date (keep auto-generated ones)
            CashflowExpenseEntry::where('record_date', $recordDate)
                ->where('is_auto', false)
                ->delete();

            // Insert new entries
            foreach ($entries as $entry) {
                CashflowExpenseEntry::create($entry);
            }

            return response()->json([
                'success' => true,
                'message' => 'Expense entries saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving expense entries: ' . $e->getMessage()
            ]);
        }
    }

    // Delete all records for a specific date
    public function deleteRecord($date)
    {
        try {
            // Delete main record
            CashflowRecord::where('record_date', $date)->delete();
            
            // Delete related income entries
            CashflowIncomeEntry::where('record_date', $date)->delete();
            
            // Delete related expense entries
            CashflowExpenseEntry::where('record_date', $date)->delete();

            return response()->json([
                'success' => true,
                'message' => 'All records for the date deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting records: ' . $e->getMessage()
            ]);
        }
    }
    
    public function getSummary()
    {
        // Get the most recent cashflow record by date
        $latest = Cashflow::orderBy('record_date', 'desc')->first();

        if ($latest) {
            return response()->json([
                'total_income' => $latest->total_income,
                'total_expenses' => $latest->total_expenses,
            ]);
        }

        // If no records exist yet
        return response()->json([
            'total_income' => 0,
            'total_expenses' => 0,
        ]);
    }

    public function getWeeklyIncome()
    {
        $now = Carbon::now();
        $monthStart = $now->copy()->startOfMonth();
        $monthEnd = $now->copy()->endOfMonth();

        // Get all income entries for the current month
        $weeklyData = DB::table('cashflow')
            ->select('record_date', 'total_income')
            ->whereBetween('record_date', [$monthStart->toDateString(), $monthEnd->toDateString()])
            ->get();

        // Initialize weeks array with 0
        $data = [0, 0, 0, 0, 0];

        foreach ($weeklyData as $entry) {
            $date = Carbon::parse($entry->record_date);

            // Get the week number relative to the month (1-5)
            $weekOfMonth = intval(ceil($date->day / 7));

            if ($weekOfMonth >= 1 && $weekOfMonth <= 5) {
                $data[$weekOfMonth - 1] += $entry->total_income;
            }
        }

        return response()->json([
            'labels' => ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'],
            'data' => $data
        ]);
    }
}