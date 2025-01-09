<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AccountCreated;
use App\Models\Announcement;
use App\Models\Courses;
use App\Models\Logs;
use App\Models\User;
use App\Models\User_employment_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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


// public function uploadCSV(Request $request)
// {
//     try {
//         $request->validate([
//             'csv_file' => 'required|file|mimes:csv,txt|max:2048',
//         ]);


//         $file = $request->file('csv_file');
//         $path = $file->getRealPath();

//         // Open and parse the CSV file
//         if (($handle = fopen($path, 'r')) !== false) {
//             $header = fgetcsv($handle);
//             $requiredHeaders = [
//                 'first_name', 'middle_name', 'last_name', 'student_ID', 'birthday', 'sex',
//                 'civil_status', 'contact_number', 'address', 'email', 'password', 'course_ID'
//             ];

//             // Validate the CSV header
//             if ($header !== $requiredHeaders) {
//                 return response()->json([
//                     'message' => 'Invalid CSV header. Ensure the headers are: ' . implode(', ', $requiredHeaders),
//                 ], 400);
//             }

//             // Process each row
//             $users = [];
//             while (($data = fgetcsv($handle)) !== false) {
//                 $users[] = [
//                     'first_name' => $data[0],
//                     'middle_name' => $data[1],
//                     'last_name' => $data[2],
//                     'student_ID' => $data[3],
//                     'birthday' => $data[4],
//                     'sex' => $data[5],
//                     'civil_status' => $data[6],
//                     'contact_number' => $data[7],
//                     'address' => $data[8],
//                     'email' => $data[9],
//                     'password' => bcrypt($data[10]),
//                     'course_ID' => $data[11],
//                     'created_at' => now(),
//                     'updated_at' => now(),
//                 ];
//             }

//             fclose($handle);

//             User::insert($users);

//             return response()->json([
//                 'message' => 'Users imported successfully',
//                 'count' => count($users),
//             ], 201);
//         }

//         return response()->json([
//             'message' => 'Unable to read the CSV file',
//         ], 400);
//     } catch (\Exception $e) {
//         return response()->json([
//             'message' => 'An error occurred while uploading the CSV file',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }
public function uploadCSV(Request $request)
{
    // Validate the uploaded file
    $request->validate([
        'file' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('file');
    $path = $file->getRealPath();

    // Open the CSV file and read its content
    if (($handle = fopen($path, 'r')) !== false) {
        $header = fgetcsv($handle); // Get the header row

        // Map header fields to ensure it matches the columns in your CSV
        $expectedHeaders = [
            'first_name', 'middle_name', 'last_name', 'student_ID', 'birthday', 'sex',
            'civil_status', 'contact_number', 'address', 'region', 'province',
            'location', 'email', 'course_ID', 'specialization', 'year'
        ];

        // Check if the headers match
        if ($header !== $expectedHeaders) {
            return response()->json([
                'message' => 'Invalid CSV header format.',
            ], 400);
        }

        // Loop through the file and save each record
        while (($row = fgetcsv($handle)) !== false) {
            $data = array_combine($header, $row);

            // Check if the record already exists based on unique attributes (e.g., student_ID or email)
            $existingUser = User::where('student_ID', $data['student_ID'])
                                ->orWhere('email', $data['email'])
                                ->first();

            if ($existingUser) {
                // Skip this record if a duplicate is found
                continue;
            }

            $activationToken = Str::random(60);

            // Insert new user record
            $user = User::create([
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'student_ID' => $data['student_ID'],
                'birthday' => $data['birthday'],
                'sex' => $data['sex'],
                'civil_status' => $data['civil_status'],
                'contact_number' => $data['contact_number'],
                'address' => $data['address'],
                'region' => $data['region'],
                'province' => $data['province'],
                'location' => $data['location'],
                'email' => $data['email'],
                'course_ID' => $data['course_ID'],
                'specialization' => $data['specialization'],
                'year' => $data['year'],
                // 'password' => bcrypt('password'),
                'activation_token' => $activationToken,
                'token_expires_at' => now()->addHours(24)
            ]);

            Mail::to($user->email)->send(new AccountCreated($user));
        }

        fclose($handle);
    }

    return response()->json(['message' => 'CSV data uploaded successfully.'], 200);
}



public function official_list(Request $request)
{
    // Get the 'status' parameter from the request (defaults to 'Active' if not provided)


    // Retrieve users with the specified status and their related course
    $users = User::with(['course', 'employmentStatus.status'])
      ->addSelect(['status' => User_employment_status::select('employment_status_ID')
          ->whereColumn('user_ID', 'users.id')
          ->latest()
          ->limit(1)]) // Add the latest employment_status_ID as 'status'
      ->get();


    // Concatenate first, middle, and last names
    $users = $users->map(function ($user) {
        $user->full_name = $user->first_name . ' ' . $user->middle_name . ' ' . $user->last_name;
        return $user;
    });

    // Return the filtered users as a JSON response
    return response()->json($users);
}



}
