<?php

namespace App\Http\Controllers;

use App\Models\Employment_status;
use Illuminate\Http\Request;

class EmploymentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $employmentStatuses = Employment_status::with('questions.answers')->get();
            return response()->json([
                'message' => 'Employment statuses retrieved successfully',
                'data' => $employmentStatuses,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve employment statuses',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|string|max:255|unique:employment_statuses,status',
            ]);

            $employmentStatus = Employment_status::create($validated);

            return response()->json([
                'message' => 'Employment status created successfully',
                'data' => $employmentStatus,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create employment status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment_status $employment_status)
    {
        try {
            return response()->json([
                'message' => 'Employment status retrieved successfully',
                'data' => $employment_status,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve employment status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employment_status $employment_status)
    {
        try {
            $validated = $request->validate([
                'status_name' => 'required|string|max:255|unique:employment_statuses,status_name,' . $employment_status->id,
            ]);

            $employment_status->update($validated);

            return response()->json([
                'message' => 'Employment status updated successfully',
                'data' => $employment_status,
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update employment status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employment_status $employment_status)
    {
        try {
            $employment_status->delete();

            return response()->json([
                'message' => 'Employment status deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete employment status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
