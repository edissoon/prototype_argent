<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Donation extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 
        'name', 
        'email', 
        'phone', 
        'amount', 
        'payment_method', 
        'reference', 
        'purpose', 
        'notes', 
        'project_id'  
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function member()
    {
        return $this->belongsTo(\App\Models\User::class, 'member_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    // ✅ Add accessor for formatted amount
    public function getFormattedAmountAttribute()
    {
        return '₱' . number_format($this->amount, 2);
    }

    // ✅ Add accessor for status based on verification
    public function getStatusAttribute()
    {
        return 'pending'; // You can extend this based on your verification system
    }
}