<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'record_date',
        'name',
        'tithes',
        'offering',
        'others',
        'note'
    ];

    protected $casts = [
        'record_date' => 'date',
        'tithes' => 'decimal:2',
        'offering' => 'decimal:2',
        'others' => 'decimal:2'
    ];

    // Relationship with main cashflow record
    public function cashflowRecord()
    {
        return $this->belongsTo(CashflowRecord::class, 'record_date', 'record_date');
    }
}