<?php

namespace App\Http\Controllers;

use App\Helpers\FinanceHelper;
use Illuminate\Support\Facades\DB;

class TreasurerController extends Controller
{
    public function dashboard()
    {
        $overview = FinanceHelper::getFinancialOverview();
        
        return view('treasurer.home', $overview);
    }

    public function users()
    {
        return view('treasurer.users');
    }

    public function cshflw()
    {
        return view('treasurer.cshflw');
    }

    public function project()
    {
        return view('treasurer.projects');
    }

    public function savings()
    {
        return view('treasurer.savings');
    }

    public function audit()
    {
        return view('treasurer.audit');
    }

    public function reports()
    {
        return view('treasurer.reports');
    }
}