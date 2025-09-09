<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class HomeController extends Controller
{
    public function allProject()
    {
        $projects = Project::where('status', 'active')->latest()->get();
        return view('landing', compact('projects'));
    }
}