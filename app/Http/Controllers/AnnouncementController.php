<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Logs;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'Active');
        //
        $announcements = Announcement::where('status', $status)->orderBy('start_date', 'desc')->get();

        return response()->json([
            'announcements' => $announcements
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'announcement_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required|string',
        ]);
    
        try {
            // Create a new Announcement record using the validated data
            $announcement = Announcement::create([
                'announcement_title' => $validated['announcement_title'],
                'start_date' => \Carbon\Carbon::parse($validated['start_date'])->format('Y-m-d'), // Store as date only
                'end_date' => \Carbon\Carbon::parse($validated['end_date'])->format('Y-m-d'), // Store as date only
                'description' => $validated['description'],
            ]);
    
            // Log the creation of the announcement
            Logs::create([
                'title' => 'New Announcement Created.',
                'description' => 'Announcement created with an ID of ' . $announcement->id,
                'admin_ID' => $request->input('user_ID'),
                'new_value' => json_encode([
                    'announcement_title' => $announcement->announcement_title,
                    'start_date' => $announcement->start_date,
                    'end_date' => $announcement->end_date,
                    'description' => $announcement->description,
                ]), // Store the new announcement details as JSON
            ]);
    
            // Return success response
            return response()->json([
                'message' => 'Announcement added successfully.',
                'announcement' => $announcement,
            ], 201);
    
        } catch (\Exception $e) {
            // Return error response with exception details
            return response()->json([
                'message' => 'Failed to add announcement.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $announcement = Announcement::findOrFail($id);

        return response()->json([
            'announcements' => $announcement
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'announcement_title' => 'required|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date', // Ensure end date is after start date
            'description' => 'required|string',
        ]);
    
        // Find the announcement by its ID
        $announcement = Announcement::findOrFail($id); // If not found, it will throw a 404 error
    
        // Prepare the updated data
        $updatedData = [
            'announcement_title' => $request->input('announcement_title'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'description' => $request->input('description'),
        ];
    
        // Update the announcement with the new data
        $announcement->update($updatedData);
    
        // Log the changes
        Logs::create([
            'title' => 'Announcement Updated.',
            'description' => 'Announcement updated with ID of ' . $announcement->id,
            'admin_ID' => $request->input('user_ID'),
            'new_value' => json_encode($updatedData), // Store the updated fields as JSON
        ]);
    
        // Return a response indicating success
        return response()->json([
            'message' => 'Announcement updated successfully!',
            'announcement' => $announcement, // Optionally return the updated announcement
        ], 200);
    }
    

    public function archive($id, Request $request)
{
    // Validate the incoming status
    $validated = $request->validate([
        'status' => 'required|string|in:Archived,Active,Pending', // Ensure status is valid
    ]);

    // Find the announcement by ID
    $announcement = Announcement::findOrFail($id);

    // Update the announcement's status
    $announcement->status = $validated['status'];
    $announcement->save();

    // Log the status change
    Logs::create([
        'title' => 'Changed Announcement Status.',
        'description' => 'Announcement status with ID of ' . $announcement->id . ' changed to ' . $validated['status'],
        'admin_ID' => $request->input('user_ID'),
        'new_value' => json_encode(['status' => $validated['status']]), // Log the updated status as JSON
    ]);

    // Return a success response
    return response()->json(['message' => 'Announcement status updated successfully.']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        //
        $ann = Announcement::findOrFail($id);
        Logs::create([
            'title' => 'Announcement Deleted.',
            'description' => 'Announcement deleted with an ID of '.$ann->id,
            'admin_ID' => $request->user_ID
        ]);

      

        $ann->delete();

        return response()->json(data: ['message' => 'Announcement deleted successfully']);
    }
}
