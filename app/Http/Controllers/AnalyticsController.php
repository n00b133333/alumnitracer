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
        // Fetch the latest employment status for each user with year
        $latestEmploymentStatus = DB::table('user_employment_statuses')
            ->select('user_ID', 'employment_status_ID', DB::raw('YEAR(created_at) as year'))
            ->whereIn('id', function ($query) {
                $query->select(DB::raw('MAX(id)'))
                    ->from('user_employment_statuses')
                    ->groupBy('user_ID');
            });
    
        // Retrieve job placements individually for each user
        $jobPlacements = DB::table('users')
            ->joinSub($latestEmploymentStatus, 'latest_status', function ($join) {
                $join->on('users.id', '=', 'latest_status.user_ID');
            })
            ->join('employment_statuses', 'latest_status.employment_status_ID', '=', 'employment_statuses.id')
            ->select(
                'users.id as user_id',
                'users.first_name as user_name',
                'employment_statuses.id as status_id',
                'employment_statuses.status as employment_status',
                'users.year as year'
                 // Include the year the employment status was created
            )
            ->get();
    
        return response()->json($jobPlacements);
    }
    
    
    public function getEmploymentStatusPerMonth()
    {
        $startYear = now()->subYears(5)->year; // Calculate 5 years ago
        $endYear = now()->year; // Current year

        $latestStatuses = DB::table('user_employment_statuses as ues1')
            ->select(
                'ues1.user_id',
                DB::raw('MONTH(ues1.created_at) as month'),
                DB::raw('YEAR(ues1.created_at) as year'),
                'ues1.employment_status_ID',
                DB::raw('MAX(ues1.created_at) as latest_status_date')
            )
            ->whereBetween(DB::raw('YEAR(ues1.created_at)'), [$startYear, $endYear])
            ->groupBy('ues1.user_id', 'year', 'month', 'ues1.employment_status_ID');

        $data = DB::table(DB::raw("({$latestStatuses->toSql()}) as latest_statuses"))
            ->mergeBindings($latestStatuses) // Bind the subquery's bindings
            ->join('employment_statuses', 'latest_statuses.employment_status_ID', '=', 'employment_statuses.id')
            ->select(
                'latest_statuses.year',
                'latest_statuses.month',
                'employment_statuses.status as employment_status',
                DB::raw('COUNT(latest_statuses.user_id) as status_count')
            )
            ->groupBy('latest_statuses.year', 'latest_statuses.month', 'employment_statuses.id', 'employment_statuses.status')
            ->orderBy('latest_statuses.year')
            ->orderBy('latest_statuses.month')
            ->get();

        $result = $data->groupBy(['year', 'month'])->map(function ($statusesByMonth, $year) {
            return $statusesByMonth->map(function ($statuses, $month,$year) {
                $filteredStatuses = $statuses->filter(function ($status) {
                    return $status->employment_status !== 'NeverEmployed';
                });

                $totalUsers = $filteredStatuses->sum('status_count');

                $employedCount = $filteredStatuses->where('employment_status', 'Employed')->sum('status_count');
                $unemployedCount = $filteredStatuses->where('employment_status', 'Unemployed')->sum('status_count');

                $employmentRate = $totalUsers > 0 ? ($employedCount / $totalUsers) * 100 : 0;
                $unemploymentRate = $totalUsers > 0 ? ($unemployedCount / $totalUsers) * 100 : 0;

                return [
                    'month' => Carbon::createFromFormat('m', $month)->format('F'),
                    'year' => $year, // Include the year attribute
                    'total_users' => $totalUsers,
                    'employed_users' => $employedCount,
                    'unemployed_users' => $unemployedCount,
                    'employment_rate' => round($employmentRate, 2),
                    'unemployment_rate' => round($unemploymentRate, 2),
                    'statuses' => $filteredStatuses->map(function ($status) use ($totalUsers) {
                        $percentage = $totalUsers > 0 ? ($status->status_count / $totalUsers) * 100 : 0;
                        return [
                            'employment_status' => $status->employment_status,
                            'count' => $status->status_count,
                            'percentage' => round($percentage, 2),
                        ];
                    })->values(),
                ];
            });
        });

        return response()->json($result);
    }

    private function addYearToData($data)
    {
        return $data->map(function ($item) {
            $item->year = now()->year; // Add year attribute to each response item
            return $item;
        });
    }

    public function getPresentEmploymentStatus()
    {
        $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', 'employment_answers.answer', '=', 'question_choices.choices')
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 1)
        ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
        ->get();
    
    
   
        return response()->json($data);
    }
    
    public function getPresentOccupation()
{
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 2); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.year',
            'users.first_name as user_name',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 2) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices', 'users.id', 'users.year','users.first_name')
        ->get();
    
    // Add year attribute
    return response()->json($data);
}

public function getPresentLineOfWork() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 5); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 5) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices', 'users.id', 'users.year','users.first_name')
        ->get();
    
    // Add year attribute
    return response()->json($data);
}

public function getPresentPlaceOfWork() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 6); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 6) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
        ->get();
    
    // Add year attribute
    return response()->json($data);
}
public function getPresentFirstJob() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 7); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 7) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
        ->get();
    
    // Add year attribute
    return response()->json($data);
}

    
public function getPresentReasonStaying() {
    $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 8); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 8) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices', 'users.year','users.id', 'users.first_name')
        ->get();
    
    // Add year attribute
    return response()->json($data);
}

    public function getITRelated() {
        $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 9); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as first_name',
            'users.year as year',
            'users.middle_name',
            'users.last_name',
            'users.student_ID as student_id',
            'users.email',
            'users.address',
            'users.contact_number',



            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 9) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices', 'users.id', 'users.first_name', 'users.year', 'users.middle_name',
        'users.last_name','users.student_ID',
            'users.email',
            'users.address','users.contact_number')
        ->get();

       

    // Return the processed data as JSON
    return response()->json($data);
}

    
    public function getPresentReasonForAccept() {
        $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 10); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 10) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
        ->get();
        
        
    
        return response()->json($data);
    }
    
    public function getPresentReasonForChanging() {
        $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 10); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 10) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices', 'users.year','users.id', 'users.first_name')
        ->get();
        
        
        
    
        return response()->json($data);
    }
    
    public function getPresentStayFirstJob() {
        $data = DB::table('question_choices')
        ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
        ->join('employment_answers', function($join) {
            $join->on('employment_answers.answer', '=', 'question_choices.choices')
                 ->where('employment_answers.employment_questions_ID', 12); // Filter answers by question ID
        })
        ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
        ->select(
            'question_choices.id as choice_id',
            'question_choices.choices',
            'users.id as user_id',
            'users.first_name as user_name',
            'users.year',
            DB::raw('COUNT(employment_answers.id) as answer_count'),
            DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
        )
        ->where('question_choices.employment_questions_ID', 12) // Filter by question ID in question_choices table
        ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
        ->get();
        
        
        
    
        return response()->json($data);
    }
    
public function getPresentHowFind() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 13); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 13) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices', 'users.id','users.year', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}

public function getPresentHowLong() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 14); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 14) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}

public function getPresentPositionFirst() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 15); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 15) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}


public function getPresentPositionPresent() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 16); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 16) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}

public function getPresentInitialGross() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 17); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 17) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices','users.year', 'users.id', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}



public function getRelevantCurriculum() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 18); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.year',
        'users.first_name as user_name',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 18) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices', 'users.id','users.year', 'users.first_name')
    ->get();
    
        
    return response()->json($data);
}

public function getPresentCompetencies() {
    $data = DB::table('question_choices')
    ->join('employment_questions', 'question_choices.employment_questions_ID', '=', 'employment_questions.id')
    ->join('employment_answers', function($join) {
        $join->on('employment_answers.answer', '=', 'question_choices.choices')
             ->where('employment_answers.employment_questions_ID', 19); // Filter answers by question ID
    })
    ->join('users', 'employment_answers.user_id', '=', 'users.id') // Ensure only matching users are included
    ->select(
        'question_choices.id as choice_id',
        'question_choices.choices',
        'users.id as user_id',
        'users.first_name as user_name',
        'users.year',
        DB::raw('COUNT(employment_answers.id) as answer_count'),
        DB::raw('MAX(employment_answers.created_at) as latest_answer_date')
    )
    ->where('question_choices.employment_questions_ID', 19) // Filter by question ID in question_choices table
    ->groupBy('question_choices.id', 'question_choices.choices', 'users.id', 'users.year','users.first_name')
    ->get();
    
        
    return response()->json($data);
}

}
