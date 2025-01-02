<?php

namespace App\Http\Controllers;

use App\Models\Question_Choices;
use Illuminate\Http\Request;

class QuestionChoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all question choices with related employment question data
        $questionChoices = Question_Choices::with('employmentQuestion')->get();

        return response()->json($questionChoices, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employment_questions_ID' => 'required|exists:employment_questions,id',
            'choices' => 'required|string|max:255',
        ]);

        // Create a new question choice
        $questionChoice = Question_Choices::create($validated);

        return response()->json([
            'message' => 'Question choice created successfully.',
            'data' => $questionChoice,
        ], 201); // 201 indicates resource created
    }

    /**
     * Display the specified resource.
     */
    public function show(Question_Choices $questionChoice)
    {
        // Load related employment question data
        $questionChoice = $questionChoice->load('employmentQuestion');

        return response()->json($questionChoice, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question_Choices $questionChoice)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employment_questions_ID' => 'sometimes|exists:employment_questions,id',
            'choices' => 'sometimes|string|max:255',
        ]);

        // Update the question choice
        $questionChoice->update($validated);

        return response()->json([
            'message' => 'Question choice updated successfully.',
            'data' => $questionChoice,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question_Choices $questionChoice)
    {
        // Delete the question choice
        $questionChoice->delete();

        return response()->json([
            'message' => 'Question choice deleted successfully.',
        ], 200);
    }
}
