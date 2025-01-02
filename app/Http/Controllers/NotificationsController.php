<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all notifications
        $notifications = Notifications::all();

        return response()->json($notifications, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'admin_ID' => 'required|exists:admins,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        // Create a new notification
        $notification = Notifications::create($validated);

        return response()->json([
            'message' => 'Notification created successfully.',
            'data' => $notification,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve a single notification
        $notification = Notifications::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found.'], 404);
        }

        return response()->json($notification, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'admin_ID' => 'sometimes|exists:admins,id',
            'title' => 'sometimes|string|max:255',
            'description' => 'nullable|string|max:255',
            'url' => 'nullable|string|max:255',
        ]);

        // Find the notification and update it
        $notification = Notifications::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found.'], 404);
        }

        $notification->update($validated);

        return response()->json([
            'message' => 'Notification updated successfully.',
            'data' => $notification,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the notification and delete it
        $notification = Notifications::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found.'], 404);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully.'], 200);
    }
}
