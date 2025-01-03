<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionChoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = Carbon::now();
        //
        $choices = [
            ['employment_questions_ID' => 1, 'choices' => 'Casual'],
            ['employment_questions_ID' => 1, 'choices' => 'Contractual'],
            ['employment_questions_ID' => 1, 'choices' => 'Self-employed'],
        ];

        $choices2 = [
            [
                'employment_questions_ID' => 2,
                'choices' => 'Officials of Government and Special - Interest Organizations, Corporate Executive, Managers, Managing Proprietors and Supervisors',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Professionals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Technicians and Associate Professionals',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Clerks',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Service workers and Shop and Market Sales Workers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Farmers, Forestry, Workers, and Fisherman',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Trades, and Related Workers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Plant and Machine Operators, and Assemblers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Laborers and Unskilled Workers',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Special Occupation',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 2,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];


        $choices5 = [
            [
                'employment_questions_ID' => 5,
                'choices' => 'Agriculture, Hunting, and Forestry',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Fishing',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Mining and Quarrying',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Manufacturing',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Electricity, Gas, and Water Supply',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Construction',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Wholesale and Retail Trade, Repair of motor vehicles, motorcycles and personal household goods',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Hotels and Restaurants',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Transport Storage and Communication',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Financial Intermediation',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Real State, Renting, and Business Activities',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Public Administration and Defense; Compulsory Social Security',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Education',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Health and Social Work',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Other community, Social and Personal Service Activities',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Private Households with Employed Persons',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 5,
                'choices' => 'Extra-territorial Organizations and Bodies',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];


        $choices6 = [
            [
                'employment_questions_ID' => 6,
                'choices' => 'Local',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 6,
                'choices' => 'Abroad',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices7 = [
            [
                'employment_questions_ID' => 7,
                'choices' => 'Yes',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 7,
                'choices' => 'No',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices8 = [
            [
                'employment_questions_ID' => 8,
                'choices' => 'Salaries and Benefits',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Career Challenge',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Related to special skill',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Related to course or program of study',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Proximity to residence',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Peer influence',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Family influence',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 8,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices9 = [
            [
                'employment_questions_ID' => 9,
                'choices' => 'Yes',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 9,
                'choices' => 'No',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices10 = [
            [
                'employment_questions_ID' => 10,
                'choices' => 'Salaries and Benefits',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 10,
                'choices' => 'Career Challenge',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 10,
                'choices' => 'Related to special skill',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 10,
                'choices' => 'Proximity to residence',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'employment_questions_ID' => 10,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices11 = [
            [
                'employment_questions_ID' => 11,
                'choices' => 'Salaries and Benefits',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 11,
                'choices' => 'Career Challenge',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 11,
                'choices' => 'Related to special skill',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 11,
                'choices' => 'Proximity to residence',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            
            [
                'employment_questions_ID' => 11,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices12 = [
            [
                'employment_questions_ID' => 12,
                'choices' => 'Less than a month',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => '1 to 6 months',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => '7 to 11 months',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => '1 year to less than 2 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => '2 years to less than 3 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => '3 years to less than 4 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 12,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices13 = [
            [
                'employment_questions_ID' => 13,
                'choices' => 'Response to an advertisement',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'As walk-in applicant',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Recommended by someone',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Information from friends',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Arranged by school\'s job placement officer',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Family business',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Job fair or Public Employment Service Office (PESO)',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 13,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices14 = [
            [
                'employment_questions_ID' => 14,
                'choices' => 'Less than a month',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => '1 to 6 months',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => '7 to 11 months',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => '1 year to less than 2 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => '2 years to less than 3 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => '3 years to less than 4 years',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 14,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices15 = [
            [
                'employment_questions_ID' => 15,
                'choices' => 'Rank or Clerical',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 15,
                'choices' => 'Professional, Technical or Supervisory',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 15,
                'choices' => 'Managerial or Executive',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 15,
                'choices' => 'Self-employed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices16 = [
            [
                'employment_questions_ID' => 16,
                'choices' => 'Rank or Clerical',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 16,
                'choices' => 'Professional, Technical or Supervisory',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 16,
                'choices' => 'Managerial or Executive',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 16,
                'choices' => 'Self-employed',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices17 = [
            [
                'employment_questions_ID' => 17,
                'choices' => 'Below Php 5,000.00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 17,
                'choices' => 'Php 5,000.00 to less than Php 10,000.00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 17,
                'choices' => 'Php 10,000.00 to less than Php 15,000.00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 17,
                'choices' => 'Php 15,000.00 to less than Php 20,000.00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 17,
                'choices' => 'Php 20,000.00 to less than Php 25,000.00',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 17,
                'choices' => 'Php 25,000.00 and above',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        
        $choices18 = [
            [
                'employment_questions_ID' => 18,
                'choices' => 'Yes',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 18,
                'choices' => 'No',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];


        $choices19 = [
            [
                'employment_questions_ID' => 19,
                'choices' => 'Communication Skills',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 19,
                'choices' => 'Human Relations Skills',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 19,
                'choices' => 'Entrepreneurial Skills',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 19,
                'choices' => 'Problem-solving Skills',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 19,
                'choices' => 'Critical Thinking Skills',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 19,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        $choices21 = [
            [
                'employment_questions_ID' => 21,
                'choices' => 'Advance or further study',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'Family concern and decided not to find a job',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'Health-related reason(s)',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'Lack of work experience',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'No job opportunity',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'Did not look for a job',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'employment_questions_ID' => 21,
                'choices' => 'Other',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        

        DB::table('question_choices')->insert($choices21);
    }
}
