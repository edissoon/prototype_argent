<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class FinanceHelper
{
    public static function getFinancialOverview()
        {
            return [
                'totalIncome' => DB::table('cashflow')->sum('total_income'),
                'totalExpense' => DB::table('cashflow')->sum('total_expenses'),
                'totalSavings' => DB::table('church_savings')->sum('amount'),
            ];
        }
}