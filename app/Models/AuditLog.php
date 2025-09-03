<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'user_id',
        'user_name',
        'activity_type',
        'description',
        'page',
        'ip_address',
        'user_agent',
    ];
}