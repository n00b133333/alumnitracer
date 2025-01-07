<?php

namespace App\Http\Controllers;
use App\Models\User_employment_status;



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

    // Transform the result to group data by month
    $result = $data->groupBy('month')->map(function ($statuses) {
        return $statuses->map(function ($status) {
            return [
                'employment_status' => $status->employment_status,
                'count' => $status->status_count,
            ];
        });
    });

    return response()->json($result);
}




}