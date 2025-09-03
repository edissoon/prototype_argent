<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.home');
    }

    public function useraccess()
    {
        return view('admin.useraccess');
    }

    public function userlogs()
    {
        return view('admin.userlogs');
    }

    public function users()
    {
        return view('admin.users');
    }

    public function createUser(Request $request) {}
    public function updateUser(Request $request, $id) {}
    public function deleteUser($id) {}
}