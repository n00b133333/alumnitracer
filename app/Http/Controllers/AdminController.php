<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();
        return response()->json($admins, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin
        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Return success response
        return response()->json([
            'message' => 'Admin created successfully',
            'data' => $admin,
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Return detailed validation errors
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors(), // Detailed validation errors
        ], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        return response()->json([
            'message' => 'An error occurred while creating the admin',
            'error' => $e->getMessage(),
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        return response()->json($admin, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:admins,email,' . $admin->id,
            'password' => 'sometimes|string|min:8|confirmed',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $admin->update($validated);

        return response()->json([
            'message' => 'Admin updated successfully',
            'data' => $admin,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        $admin->delete();

        return response()->json([
            'message' => 'Admin deleted successfully',
        ], 200);
    }


    
    public function login(Request $request)
{
    // Validate the request input
    $request->validate([
        'email' => 'required',
        'password' => 'required|string|min:8',
    ]);

    // Find the user by email
    $user = Admin::where('email', $request->email)->first();

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
            'user' => $user, 
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
    $admin = Admin::findOrFail($id); // Assuming the admin is authenticated

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
