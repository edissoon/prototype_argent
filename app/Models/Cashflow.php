<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashflow extends Model
{
    use HasFactory;

    protected $table = 'cashflow';

    protected $fillable = [
        'record_date',
        'total_income',
        'tithes',
        'offering',
        'others',
        'total_expenses',
        'balance'
    ];

    protected $casts = [
        'record_date' => 'date',
        'total_income' => 'decimal:2',
        'tithes' => 'decimal:2',
        'offering' => 'decimal:2',
        'others' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'balance' => 'decimal:2'
    ];

    public static function getByDateRange($startDate, $endDate)
    {
        return self::whereBetween('record_date', [$startDate, $endDate])
                   ->orderBy('record_date', 'desc')
                   ->get();
    }

    public static function getLatest()
    {
        return self::orderBy('record_date', 'desc')->first();
    }

    public static function getCurrentMonthSummary()
    {
        $currentMonth = now()->format('Y-m');
        
        return self::whereRaw("DATE_FORMAT(record_date, '%Y-%m') = ?", [$currentMonth])
                   ->selectRaw('
                       SUM(total_income) as total_income,
                       SUM(tithes) as total_tithes,
                       SUM(offering) as total_offering,
                       SUM(others) as total_others,
                       SUM(total_expenses) as total_expenses,
                       SUM(balance) as total_balance
                   ')
                   ->first();
    }

    // Relationships
    public function incomeEntries()
    {
        return $this->hasMany(Income::class, 'record_date', 'record_date');
    }

    public function expenseEntries()
    {
        return $this->hasMany(Expenses::class, 'record_date', 'record_date');
    }
}