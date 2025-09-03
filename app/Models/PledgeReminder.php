<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PledgeReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'start_date',
        'frequency',
        'amount',
        'note',
        'is_active',
        'next_due_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'next_due_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function calculateNextDueDate()
    {
        $startDate = Carbon::parse($this->start_date);
        $today = Carbon::today();

        switch ($this->frequency) {
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

    public function updateNextDueDate()
    {
        $this->next_due_date = $this->calculateNextDueDate();
        $this->save();
    }
}