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
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    public function archive($id, Request $request)
{
    // Find the alumni by ID
    $announcement = Announcement::findOrFail($id);

    // Update the announcement's status to 'Archived'
    $announcement->status = $request->status;
    $announcement->save();

    Logs::create([
        'title' => 'Changed Announcement Status.',
        'description' => 'Announcement status with ID of '.$announcement->id.' changed to '.$request->status,
        'admin_ID' => $request->user_ID
    ]);
    // Return a success response
    return response()->json(['message' => 'Announcement archived successfully']);
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
