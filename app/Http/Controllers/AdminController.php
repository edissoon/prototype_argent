<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // Show User Access page with users
    public function useraccess()
    {
        $users = User::all(); // Fetch all users
        return view('admin.useraccess', compact('users'));
    }

    // Create a new user
    public function createUser(Request $request)
    {
        $request->validate([
            'custom_id' => 'required|string|unique:users,custom_id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => ['required', Rule::in(['super_admin','treasurer','member'])],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['active','inactive'])],
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'custom_id' => $request->custom_id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully']);
    }

    // Update existing user
    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'custom_id' => 'required|string|unique:users,custom_id,'.$user->id,
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => ['required', Rule::in(['super_admin','treasurer','member'])],
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'status' => ['required', Rule::in(['active','inactive'])],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->custom_id = $request->custom_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->status = $request->status;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete user
    public function deleteUser(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
