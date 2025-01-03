<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentStatusQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $now = Carbon::now();
        // $questions = [
        //     ['employment_questions_ID' => 1, 'employment_status_ID' => 1, 'created_at' => $now, 'updated_at' => $now],
        //     ['employment_questions_ID' => 1, 'employment_status_ID' => 1, 'created_at' => $now, 'updated_at' => $now],
        // ];
       
        $questions1 = [];
        for ($i = 1; $i <= 20; $i++) {
            $questions1[] = [
                'employment_questions_ID' => $i,
                'employment_status_ID' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // For employment_status_ID 2 and 3, store question ID 21
        $questions2and3 = [];
        for ($i = 2; $i <= 3; $i++) {
            $questions2and3[] = [
                'employment_questions_ID' => 21,
                'employment_status_ID' => $i,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        // Insert both sets of data into the employment_status_questions table
        DB::table('employment_status_questions')->insert(array_merge($questions1, $questions2and3));
    }
}
