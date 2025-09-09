<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashflowExpenseEntry extends Model
{
    use HasFactory;

    // match the table name created by your migration
    protected $table = 'cashflow_expense_entry';

    protected $fillable = [
        'cashflow_id',
        'expense_name',
        'amount',
        'is_auto',
        'note',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_auto' => 'boolean',
    ];

    public function cashflow()
    {
        return $this->belongsTo(Cashflow::class, 'cashflow_id');
    }
}