<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Courses;
use App\Models\Logs;
use App\Models\User;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    public function dashboard(Request $request)
{
    $users = User::selectRaw("
        SUM(CASE WHEN status = 'Active' THEN 1 ELSE 0 END) as active_count,
        SUM(CASE WHEN status = 'Archived' THEN 1 ELSE 0 END) as archive_count
    ")->first();
    $logs = Logs::where('admin_ID', $request->id)->get();

    $announcementsQuery = Announcement::where('status', 'Active');
    $courses = Courses::count();

    $coursesDetails = Courses::withCount('users')->get();
    $announcements = $announcementsQuery->limit(3)->get();
    $announcementsCount = $announcementsQuery->count();

    return response()->json([
        'active_count' => $users->active_count,
        'archive_count' => $users->archive_count,
        'announcements' => $announcements,
        'announcement_count' => $announcementsCount,
        'courses_count' => $courses,
        'courses_details' => $coursesDetails,
        'logs' => $logs,
    ]);
}

public function logs(Request $request)
{
    $logs = Logs::where('admin_ID', $request->id)->get();

    return response()->json([
        'logs' => $logs,
       
    ]);
}

}
