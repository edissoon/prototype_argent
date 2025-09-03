<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
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
    ];

    // Optional relationship
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function pledge()
    {
        return $this->belongsTo(Pledge::class, 'purpose_id')->where('purpose', 'pledge');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}