<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChurchSaving extends Model
{
        use HasFactory;

        protected $fillable = ['type', 'amount', 'note', 'balance_after'];

}
