<?php
namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use App\Models\User_employment_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Get the 'status' parameter from the request (defaults to 'Active' if not provided)
    $status = $request->get('status', 'Active');
    
    // Retrieve users with the specified status and their related course
    $users = User::with(['course', 'employmentStatus.status'])->where('status', $status)
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


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validate the incoming request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'sex' => 'required|string|max:255',
            'civil_status' => 'required|string|max:255',
            'contact_number' => 'required|string|max:11',
            'student_ID' => 'required|string|max:255|unique:users,student_ID',
            'birthday' => 'required|date',
            'address' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'course_ID' => 'required|exists:courses,id',
          
        ]);

        // Create a new user and store it in the database
        $user = User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'student_ID' => $validated['student_ID'],
            'birthday' => $validated['birthday'],
            'sex' => $validated['sex'],
            'contact_number' => $validated['contact_number'],
            'civil_status' => $validated['civil_status'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'course_ID' => $validated['course_ID'],
         
        ]);

        // Return the created user as a JSON response
        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return detailed validation errors
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors(),
        ], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json([
            'message' => 'An error occurred while creating the user',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the user by ID, or return a 404 if not found
        $user = User::with('statuses.status', 'statuses.answers', 'employmentStatus.status')->findOrFail($id);

        // Return the user as a JSON response
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'middle_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'student_ID' => 'sometimes|required|string|max:255|unique:users,student_ID,' . $id,
            'birthday' => 'sometimes|required|date',
            'sex' => 'sometimes|required|string|max:255',
            'civil_status' => 'sometimes|required|string|max:255',
            'contact_number' => 'sometimes|required|string|max:11',
            'address' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'course_ID' => 'sometimes|required|exists:courses,id',
            'status' => 'sometimes|required',
            'region' => 'sometimes|required|string|max:255',
            'province' =>'sometimes|required|string|max:255',
            'location' =>'sometimes|required|string|max:255',
            'specialization' =>'sometimes|required|string|max:255',
            'year' =>'sometimes|required|string|max:4',
            'honors' =>'sometimes|required|string|max:255',
            'prof_exams' =>'sometimes|required|json',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user with new data
        $user->update($request->only([
            'first_name','middle_name', 'last_name', 'student_ID', 'birthday', 'address', 'email', 'password', 'course_ID', 'sex', 'contact_number', 'civil_status', 'region', 'province', 'location', 'specialization', 'year', 'honors', 'prof_exams'
        ]));

        // If password is updated, hash it
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        // Return the updated user as a JSON response
        return response()->json([
            'message' => 'Profile Updated Successfully',
            'user' => $user->load('employmentStatus.status')
        ]);
    }

    public function archive(Request $request, $id)
{
    // Validate the incoming request
    $validated = $request->validate([
        'status' => 'required|string|in:Active,Archived', // Ensure valid status values
        'user_ID' => 'required|integer', // Validate the admin ID
    ]);

    try {
        // Find the alumni by ID or throw a 404 error
        $alumni = User::findOrFail($id);

        // Update the alumni's status
        $previousStatus = $alumni->status;
        $alumni->status = $validated['status'];
        $alumni->save();

        // Log the status change
        Logs::create([
            'title' => 'Changed Alumni Status',
            'description' => sprintf(
                'Alumni status with student number %s changed from %s to %s',
                $alumni->student_ID,
                $previousStatus,
                $validated['status']
            ),
            'admin_ID' => $validated['user_ID'],
            'new_value' => json_encode([
                'student_ID' => $alumni->student_ID,
                'previous_status' => $previousStatus,
                'new_status' => $validated['status'],
            ]), // Store the change details as JSON
        ]);

        // Return a success response
        return response()->json(['message' => 'Alumni status updated successfully.'], 200);

    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json([
            'message' => 'Failed to update alumni status.',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Delete the user from the database
        $user->delete();

        // Return a 204 No Content response indicating success
        return response()->json(null, 204);
    }


    public function login(Request $request)
{
    // Validate the request input
    $request->validate([
        'student_ID' => 'required',
        'password' => 'required|string|min:8',
    ]);

    // Find the user by email
    $user = User::with('course', 'employmentStatus.status')->where('student_ID', $request->student_ID)->first();

    // Check if user exists and the password matches
    if ($user && Hash::check($request->password, $user->password)) {
        // Revoke all previous tokens (optional, for security)
        $user->tokens()->delete();

        // Create a new token
        $token = $user->createToken('alumnitracer')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user, // Optionally include user details
        ], 200);
    }

    // Return unauthorized error response
    return response()->json(['error' => 'Invalid credentials'], 401);
}

public function change_password($id, Request $request) {
    // Validate the incoming request
    $request->validate([
        'password' => 'required|string|min:8', // Current password validation
        'new_password' => 'required|string|min:8', // New password validation
    ]);

    // Get the authenticated admin
    $admin = User::findOrFail($id); // Assuming the admin is authenticated

    // Check if the provided current password matches the admin's password
    if (!Hash::check($request->password, $admin->password)) {
        return response()->json(['error' => 'Current password is incorrect'], 400);
    }

    // Update the password
    $admin->password = bcrypt($request->new_password);
    $admin->save();

    // Respond with success
    return response()->json(['message' => 'Password successfully changed'], 200);
}


}
