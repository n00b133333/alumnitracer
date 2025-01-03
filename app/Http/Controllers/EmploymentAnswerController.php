<?php

namespace App\Http\Controllers;

use App\Models\Employment_answer;
use App\Models\User;
use App\Models\User_employment_status;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmploymentAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all employment answers with related data
        $employmentAnswers = Employment_answer::with(['employmentStatusQuestion', 'user', 'userEmploymentStatus'])->get();

        return response()->json($employmentAnswers, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     try {
    //         // Validate the incoming request data
    //         $validated = $request->validate([
    //             'employment_question_ID' => 'sometimes|exists:employment_questions,id',
    //             'user_ID' => 'sometimes|exists:users,id',
    //             'user_employment_status_ID' => 'sometimes|exists:user_employment_statuses,id',
    //             'answer' => 'sometimes|string|max:255',
    //         ]);

    //         // Create a new employment answer
    //         $employmentAnswer = Employment_answer::create($validated);

    //         return response()->json([
    //             'message' => 'Employment answer created successfully.',
    //             'data' => $employmentAnswer,
    //         ], 201); // 201 indicates resource created

    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Error storing employment answer',
    //             'error' => $e->getMessage(),
    //         ], 500);
    //     }
    // }

    public function store(Request $request)
{
    try {
        // Validate the incoming request data
        $validated = $request->validate([
            'user_ID' => 'required|exists:users,id',
            'status' => 'required|exists:employment_statuses,id',
            'answers' => 'required|array', // Ensure answers is an array
            'answers.*.id' => 'required|exists:employment_questions,id', // Each answer must have a valid question ID
            'answers.*.value' => 'required', // Ensure each answer has a value
            'files' => '',
        ]);

        // 1. Store or update the employment status first
        $userEmploymentStatus = User_employment_status::create([
            'user_ID' => $validated['user_ID'],
            'employment_status_ID' => $validated['status'],
        ]);
        

        // 2. Loop through the answers and store them
        $employmentAnswers = [];
        $now = Carbon::now();


        foreach ($validated['files'] as $file) {
            if ($request->hasFile("files.{$file['id']}.value")) {
                // If the answer is a file, upload it and store the file path
                $file = $request->file("answers.{$file['id']}.value");
                $filePath = $file->store('employment_answers', 'public'); // Store file in the 'employment_answers' directory under 'storage/app/public'

                $employmentAnswers[] = [
                    'user_ID' => $validated['user_ID'],
                    'employment_questions_ID' => $file['id'],
                    'user_employment_status_ID' => $userEmploymentStatus->id,
                    'answer' => $filePath, // Store the file path as the answer
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            } 
        }
        foreach ($validated['answers'] as $answerData) {
            // Check if the answer is an array (checkboxes), a file, or a single value
            if (is_array($answerData['value'])) {
                // If the answer is an array, loop through each value and store them one by one
                foreach ($answerData['value'] as $value) {
                    $employmentAnswers[] = [
                        'user_ID' => $validated['user_ID'],
                        'employment_questions_ID' => $answerData['id'],
                        'user_employment_status_ID' => $userEmploymentStatus->id,
                        'answer' => $value,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            } else {
                // If the answer is a single value, store it directly
                $employmentAnswers[] = [
                    'user_ID' => $validated['user_ID'],
                    'employment_questions_ID' => $answerData['id'],
                    'user_employment_status_ID' => $userEmploymentStatus->id,
                    'answer' => $answerData['value'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        // 3. Insert all the answers at once
        Employment_answer::insert($employmentAnswers);

        $user = User::with('employmentStatus.status')->findOrFail($validated['user_ID']);
        return response()->json([
            'message' => 'Employment status updated successfully.',
            'data' => $user,
        ], 201); // 201 indicates resource created

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error storing employment status',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Employment_answer $employment_answer)
    {
        // Return the specified employment answer with related data
        $employmentAnswer = $employment_answer->load(['employmentStatusQuestion', 'user', 'userEmploymentStatus']);

        return response()->json($employmentAnswer, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employment_answer $employment_answer)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employment_question_ID' => 'sometimes|exists:employment_questions,id',
            'user_ID' => 'sometimes|exists:users,id',
            'user_employment_status_ID' => 'sometimes|exists:user_employment_statuses,id',
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
