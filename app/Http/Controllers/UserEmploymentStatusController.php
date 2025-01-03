<?php

namespace App\Http\Controllers;

use App\Models\User_employment_status;
use App\Http\Requests\StoreUser_employment_statusRequest;
use App\Http\Requests\UpdateUser_employment_statusRequest;
use Illuminate\Http\Request;

class UserEmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all user employment statuses
        $statuses = User_employment_status::all();
        return response()->json($statuses, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // If using a frontend, this can return a view
        return view('user_employment_statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_ID' => 'required|exists:users,id',
            'employment_status_ID' => 'required|exists:employment_statuses,id',
        ]);

        // Create a new user employment status record
        $status = User_employment_status::create($validatedData);

        return response()->json([
            'message' => 'User employment status created successfully',
            'data' => $status,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Retrieve a specific user employment status
        // $status = User_employment_status::find($id);

        $status = User_employment_status::with('answers.question', 'status')->find($id);

        if (!$status) {
            return response()->json(['message' => 'User employment status not found'], 404);
        }

        return response()->json($status, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Retrieve the status for editing
        $status = User_employment_status::find($id);

        if (!$status) {
            return redirect()->back()->with('error', 'User employment status not found');
        }

        return view('user_employment_statuses.edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_ID' => 'required|exists:users,id',
            'employment_status_ID' => 'required|exists:employment_statuses,id',
        ]);

        // Find the record and update
        $status = User_employment_status::find($id);

        if (!$status) {
            return response()->json(['message' => 'User employment status not found'], 404);
        }

        $status->update($validatedData);

        return response()->json([
            'message' => 'User employment status updated successfully',
            'data' => $status,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the record and delete
        $status = User_employment_status::find($id);

        if (!$status) {
            return response()->json(['message' => 'User employment status not found'], 404);
        }

        $status->delete();

        return response()->json(['message' => 'User employment status deleted successfully'], 200);
    }

}
