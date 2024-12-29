<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();

        // Return the users as a JSON response
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
        $user = User::findOrFail($id);

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
            'address' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'course_ID' => 'sometimes|required|exists:courses,id',
            
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user with new data
        $user->update($request->only([
            'first_name','middle_name', 'last_name', 'student_ID', 'birthday', 'address', 'email', 'password', 'course_ID'
        ]));

        // If password is updated, hash it
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
            $user->save();
        }

        // Return the updated user as a JSON response
        return response()->json($user);
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
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Find the user by email
    $user = User::where('email', $request->email)->first();

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

}
