<?php

namespace App\Http\Controllers;

use App\Models\Employment_Status_Questions;
use App\Http\Requests\StoreEmployment_Status_QuestionsRequest;
use App\Http\Requests\UpdateEmployment_Status_QuestionsRequest;
use Illuminate\Http\Request;


class EmploymentStatusQuestionsController extends Controller
{
    public function index()
    {
        // Fetch all questions with related data
        $questions = Employment_Status_Questions::with(['employmentQuestion', 'employmentStatus'])->get();
        return response()->json($questions, 200);
    }

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'employment_question_ID' => 'required|exists:employment_questions,id',
            'employment_status_ID' => 'required|exists:employment_statuses,id',
        ]);

        $question = Employment_Status_Questions::create($validated);

        return response()->json([
            'message' => 'Employment status question created successfully',
            'question' => $question
        ], 201);
    }

    public function show($id)
    {
        // Fetch specific question with related data
        $question = Employment_Status_Questions::with(['employmentQuestion', 'employmentStatus'])->find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        return response()->json($question, 200);
    }

    public function update(Request $request, $id)
    {
        // Validate request data
        $validated = $request->validate([
            'employment_question_ID' => 'required|exists:employment_questions,id',
            'employment_status_ID' => 'required|exists:employment_statuses,id',
        ]);

        $question = Employment_Status_Questions::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->update($validated);

        return response()->json([
            'message' => 'Employment status question updated successfully',
            'question' => $question
        ], 200);
    }

    public function destroy($id)
    {
        $question = Employment_Status_Questions::find($id);

        if (!$question) {
            return response()->json(['message' => 'Question not found'], 404);
        }

        $question->delete();

        return response()->json(['message' => 'Employment status question deleted successfully'], 200);
    }
}

