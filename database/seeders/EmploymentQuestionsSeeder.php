<?php

namespace Database\Seeders;

use App\Models\Employment_Questions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmploymentQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Employment_Questions::create([
            'questions' => 'Name of Company or Organization including Address',
            'question_type' => 'text',
        ]);

        Employment_Questions::create([
            'questions' => 'Upload your company ID',
            'question_type' => 'file',
        ]);

        Employment_Questions::create([
            'questions' => 'Major line of business of the company you are presently employed in. Please choose one only.',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'Place of Work',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'Is this your FIRST job after college? If NO, proceed to Questions 26 and 27.',
            'question_type' => 'radio',
        ]);
        Employment_Questions::create([
            'questions' => 'What are the reasons for staying on the job? You may check more than one answer.',
            'question_type' => 'checkbox',
        ]);
        Employment_Questions::create([
            'questions' => 'Is your FIRST job related to the course you took up in college?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'What were your reasons for accepting the job? You may choose more than one answer.',
            'question_type' => 'checkbox',
        ]);

        Employment_Questions::create([
            'questions' => 'What were your reasons for changing the job? You may check more than one answer.',
            'question_type' => 'checkbox',
        ]);
        Employment_Questions::create([
            'questions' => 'How long did you stay in your FIRST job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'How did you find your FIRST job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'How long did it take you to land your FIRST job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'What is your job level position in your FIRST job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'What is your job level position in your PRESENT job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'What is your initial gross monthly earning in your FIRST job after college?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'Was the curriculum you had in college relevant to your FIRST job?',
            'question_type' => 'radio',
        ]);

        Employment_Questions::create([
            'questions' => 'What competencies learned in college did you find very useful in your FIRST job? You may check more than one answer.',
            'question_type' => 'checkbox',
        ]);

        Employment_Questions::create([
            'questions' => 'List down suggestions to further improve your course curriculum',
            'question_type' => 'text',
        ]);

        Employment_Questions::create([
            'questions' => 'Please state reason(s) why you are not yet employed. You may check more than one answer.',
            'question_type' => 'checkbox',
        ]);

        
    }
}
