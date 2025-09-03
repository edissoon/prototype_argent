<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_date',
        'name',
        'amount',
        'is_auto'
    ];

    protected $casts = [
        'record_date' => 'date',
        'amount' => 'decimal:2',
        'is_auto' => 'boolean'
    ];

    // Relationship with main cashflow record
    public function cashflow()
    {
        return $this->belongsTo(Cashflow::class, 'record_date', 'record_date');
    }
}