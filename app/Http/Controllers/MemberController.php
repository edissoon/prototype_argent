<?php

namespace App\Http\Controllers;

use App\Helpers\FinanceHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function memberDashboard()
    {
        $overview = FinanceHelper::getFinancialOverview();

        return view('member.home', $overview);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'ministry' => 'nullable|string|max:100',
        ]);

        // Update user
        $user->update($validated);

        return response()->json(['success' => true]);

    }

}