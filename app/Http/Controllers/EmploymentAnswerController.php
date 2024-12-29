<?php

namespace App\Http\Controllers;

use App\Models\Employment_answer;
use Illuminate\Http\Request;

class EmploymentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all employment answers with related data
        $employmentAnswers = Employment_answer::with(['employmentStatusQuestion', 'user'])->get();

        return response()->json($employmentAnswers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employment_status_question_ID' => 'required|exists:employment_status_questions,id',
            'user_ID' => 'required|exists:users,id',
            'answer' => 'required|string|max:255',
        ]);

        // Create a new employment answer
        $employmentAnswer = Employment_answer::create($validated);

        return response()->json([
            'message' => 'Employment answer created successfully.',
            'data' => $employmentAnswer,
        ], 201); // 201 indicates resource created
    }

    /**
     * Display the specified resource.
     */
    public function show(Employment_answer $employment_answer)
    {
        // Return the specified employment answer with related data
        $employmentAnswer = $employment_answer->load(['employmentStatusQuestion', 'user']);

        return response()->json($employmentAnswer, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employment_answer $employment_answer)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employment_status_question_ID' => 'sometimes|exists:employment_status_questions,id',
            'user_ID' => 'sometimes|exists:users,id',
            'answer' => 'sometimes|string|max:255',
        ]);

        // Update the employment answer
        $employment_answer->update($validated);

        return response()->json([
            'message' => 'Employment answer updated successfully.',
            'data' => $employment_answer,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employment_answer $employment_answer)
    {
        // Delete the employment answer
        $employment_answer->delete();

        return response()->json([
            'message' => 'Employment answer deleted successfully.',
        ], 200);
    }
}
