<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Donation;

class Project extends Model
{
    use HasFactory;

    protected $table = 'church_projects';
    protected $fillable = ['name', 'description', 'goal_amount', 'start_date', 'image_url', 'status', 'raised_amount'];

    public function donations()
    {
        return $this->hasMany(Donation::class, 'project_id');
    }

    public function getProgressPercentAttribute()
    {
        $goal = (float) $this->goal_amount;
        $raised = (float) $this->raised_amount;

        if ($goal <= 0) {
            return 0;
        }

        return (float) min(100, ($raised / $goal) * 100);
    }
}