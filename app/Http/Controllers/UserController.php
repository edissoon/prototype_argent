<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('member.home'); // Make sure this Blade file exists
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->ministry = $request->ministry;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated!');
    }
}
