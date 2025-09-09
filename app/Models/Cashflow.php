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
        'total_tithes',
        'total_offering',
        'total_others',
        'total_expenses',
        'net_balance',
        'income_records',
    ];

    protected $casts = [
        'record_date' => 'date',
        'income_records' => 'array',
        'total_income' => 'decimal:2',
        'total_tithes' => 'decimal:2',
        'total_offering' => 'decimal:2',
        'total_others' => 'decimal:2',
        'total_expenses' => 'decimal:2',
        'net_balance' => 'decimal:2',
    ];

    public function expenseEntries()
    {
        return $this->hasMany(CashflowExpenseEntry::class, 'cashflow_id');
    }
}