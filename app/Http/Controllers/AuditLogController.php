<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'session_id' => 'required',
            'user_id' => 'required',
            'user_name' => 'required',
            'activity_type' => 'required',
            'description' => 'required',
            'page' => 'nullable|string',
            'ip_address' => 'nullable|string',
            'user_agent' => 'nullable|string',
        ]);

        // Add IP address automatically if not provided
        if (!$validated['ip_address']) {
            $validated['ip_address'] = $request->ip();
        }

        AuditLog::create($validated);

        return response()->json(['message' => 'Audit log saved.']);
    }

    public function index()
    {
        // Return logs with proper timestamp formatting
        $logs = AuditLog::latest()->get()->map(function ($log) {
            return [
                'id' => $log->id,
                'session_id' => $log->session_id,
                'user_id' => $log->user_id,
                'user_name' => $log->user_name,
                'activity_type' => $log->activity_type,
                'description' => $log->description,
                'page' => $log->page,
                'ip_address' => $log->ip_address,
                'user_agent' => $log->user_agent,
                'timestamp' => $log->created_at->toISOString(),
                'created_at' => $log->created_at,
                'updated_at' => $log->updated_at,
            ];
        });

        return response()->json($logs);
    }
}