<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'target_amount',
        'current_amount',
        'image_path',
        'status',
    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
    ];

    protected $appends = ['progress_percentage', 'is_completed'];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Get current amount - use database value, not calculated from donations
    public function getCurrentAmountAttribute($value)
    {
        return $value ?? 0;
    }

    // Calculate progress percentage
    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount <= 0) {
            return 0;
        }
        
        return min(100, round(($this->current_amount / $this->target_amount) * 100, 2));
    }

    // Check if project is completed based on target amount
    public function getIsCompletedAttribute()
    {
        return $this->current_amount >= $this->target_amount;
    }

    // Scope for active projects
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for public display (active projects only)
    public function scopePublic($query)
    {
        return $query->where('status', 'active')->orderBy('created_at', 'desc');
    }

    // Method to add donation amount
    public function addDonation($amount)
    {
        $this->increment('current_amount', $amount);
        
        // Auto-complete project if target is reached
        if ($this->current_amount >= $this->target_amount && $this->status === 'active') {
            $this->update(['status' => 'completed']);
        }
        
        return $this;
    }

    // Method to subtract donation (if refund needed)
    public function subtractDonation($amount)
    {
        $this->decrement('current_amount', $amount);
        
        // Reactivate project if it falls below target and was completed
        if ($this->current_amount < $this->target_amount && $this->status === 'completed') {
            $this->update(['status' => 'active']);
        }
        
        return $this;
    }
}