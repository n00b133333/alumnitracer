<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreEmployment_QuestionsRequest;
use App\Http\Requests\UpdateEmployment_QuestionsRequest;
use App\Models\Employment_Questions;
use Illuminate\Http\Request;
class EmploymentQuestionsController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        // Retrieve all employment status questions from the database
        $questions = Employment_Questions::all();

        // Return the questions as a JSON response
        return response()->json($questions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate incoming request data
            $validatedData = $request->validate([
                'questions' => 'required|string|max:255',
            ]);

            // Create a new question and store it in the database
            $question = Employment_Questions::create($validatedData);

            // Return the created question as a JSON response
            return response()->json([
                'success' => true,
                'message' => 'Question created successfully.',
                'data' => $question,
            ], 201); // 201 indicates resource created
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'success' => false,
                'message' => 'Validation error.',
                'errors' => $e->errors(), // Detailed validation errors
            ], 422); // 422 indicates unprocessable entity
        } catch (\Exception $e) {
            // Handle other exceptions
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the question.',
                'error' => $e->getMessage(), // Include the exception message
            ], 500); // 500 indicates server error
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the question by its ID, or return a 404 if not found
        $question = Employment_Questions::with('answers')->findOrFail($id);

        // Return the question as a JSON response
        return response()->json($question);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $request->validate([
            'questions' => 'sometimes|required|string|max:255',
        ]);

        // Find the question by ID
        $question = Employment_Questions::findOrFail($id);

        // Update the question with new data
        $question->update($request->only(['questions']));

        // Return the updated question as a JSON response
        return response()->json($question);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the question by ID
        $question = Employment_Questions::findOrFail($id);

        // Delete the question from the database
        $question->delete();

        // Return a 204 No Content response indicating success
        return response()->json(null, 204);
    }
}
