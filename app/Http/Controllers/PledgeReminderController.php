<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PledgeReminder;
use Carbon\Carbon;

class PledgeReminderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pledge_date' => 'required|date',
            'frequency' => 'required|in:first-sunday,weekly,monthly',
            'amount' => 'required|numeric|min:1',
            'note' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $pledgeReminder = PledgeReminder::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'start_date' => $request->pledge_date,
                'frequency' => $request->frequency,
                'amount' => $request->amount,
                'note' => $request->note,
                'is_active' => $request->is_active,
                'next_due_date' => $this->calculateNextDueDate($request->pledge_date, $request->frequency),
            ]
        );

        return redirect()->back()->with('success', 'Pledge reminder saved successfully!');
    }

    public function toggle(Request $request)
    {
        $pledgeReminder = PledgeReminder::where('user_id', auth()->id())->first();
        
        if ($pledgeReminder) {
            $pledgeReminder->is_active = !$pledgeReminder->is_active;
            $pledgeReminder->save();
            
            $status = $pledgeReminder->is_active ? 'activated' : 'deactivated';
            return redirect()->back()->with('success', "Pledge reminder {$status} successfully!");
        }

        return redirect()->back()->with('error', 'No pledge reminder found.');
    }

    private function calculateNextDueDate($startDate, $frequency)
    {
        $startDate = Carbon::parse($startDate);
        $today = Carbon::today();

        switch ($frequency) {
            case 'first-sunday':
                $nextDate = $startDate->copy();
                while ($nextDate->lte($today)) {
                    $nextDate->addMonth()->firstOfMonth();
                    while ($nextDate->dayOfWeek !== Carbon::SUNDAY) {
                        $nextDate->addDay();
                    }
                }
                break;

            case 'weekly':
                $nextDate = $startDate->copy();
                while ($nextDate->lte($today)) {
                    $nextDate->addWeek();
                }
                break;

            case 'monthly':
                $nextDate = $startDate->copy();
                while ($nextDate->lte($today)) {
                    $nextDate->addMonth();
                }
                break;

            default:
                $nextDate = $startDate->copy()->addWeek();
                break;
        }

        return $nextDate;
    }
}