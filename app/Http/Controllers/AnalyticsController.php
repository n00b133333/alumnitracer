<?php

namespace App\Http\Controllers;
use App\Models\User_employment_status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AnalyticsController extends Controller
{
    public function job_placements()
{

    $latestEmploymentStatus = DB::table('user_employment_statuses')
        ->select('user_ID', 'employment_status_ID')
        ->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('user_employment_statuses')
                ->groupBy('user_ID');
        });


    $jobPlacements = DB::table('users')
        ->joinSub($latestEmploymentStatus, 'latest_status', function ($join) {
            $join->on('users.id', '=', 'latest_status.user_ID');
        })
        ->join('employment_statuses', 'latest_status.employment_status_ID', '=', 'employment_statuses.id')
        ->select(
            'employment_statuses.id as status_id',
            'employment_statuses.status as employment_status',
            DB::raw('COUNT(users.id) as user_count')
        )
        ->groupBy('employment_statuses.id', 'employment_statuses.status')
        ->get();


    $totalUsers = DB::table('users')->count();

 
    $employmentStatusCounts = $jobPlacements->map(function ($item) use ($totalUsers) {
        $item->percentage = ($item->user_count / $totalUsers) * 100;
        return $item;
    });

    return response()->json($employmentStatusCounts);
}



public function getEmploymentStatusPerMonth()
{
    $data = DB::table('user_employment_statuses')
        ->join('employment_statuses', 'user_employment_statuses.employment_status_ID', '=', 'employment_statuses.id')
        ->select(
            DB::raw('MONTH(user_employment_statuses.created_at) as month'),
            'employment_statuses.status as employment_status',
            DB::raw('COUNT(user_employment_statuses.id) as status_count')
        )
        ->whereYear('user_employment_statuses.created_at', 2025)
        ->groupBy('month', 'employment_statuses.id', 'employment_statuses.status')
        ->orderBy('month')
        ->get();

    // Transform the result to include month names and employment statuses
    $result = $data->groupBy('month')->map(function ($statuses, $month) {
        return [
            'month' => Carbon::createFromFormat('m', $month)->format('F'), // Convert month number to full name
            'statuses' => $statuses->map(function ($status) {
                return [
                    'employment_status' => $status->employment_status,
                    'count' => $status->status_count,
                ];
            })->values(), // Ensure it's an array
        ];
    })->values(); // Reset indices for the outer collection

    return response()->json($result);
}

public function getPresentEmploymentStatus() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', 'employment_answers.answer', '=', 'question_choices.choices')
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 1) // Filter by question ID (e.g., 1)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}


public function getPresentOccupation() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 2); // Filter answers by question ID
        })
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 2) // Filter by question ID (in question_choices table)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}


public function getPresentLineOfWork() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', 'employment_answers.answer', '=', 'question_choices.choices')
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 5) // Filter by question ID (e.g., 1)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}

public function getPresentPlaceOfWork() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', 'employment_answers.answer', '=', 'question_choices.choices')
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 6) // Filter by question ID (e.g., 1)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}

public function getPresentFirstJob() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 7); // Filter answers by question ID
        })
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 7) // Filter by question ID (in question_choices table)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}

public function getPresentReasonStaying() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->leftJoin('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 7); // Filter answers by question ID
        })
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            DB::raw('COUNT(employment_answers.id) as answer_count'), // Count answers that match
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date') // Get the latest answer date for each user
        )
        ->where('question_choices.employment_questions_ID', 8) // Filter by question ID (in question_choices table)
        ->groupBy('question_choices.id', 'question_choices.choices')
        ->get();

    return response()->json($data);
}

}