<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_answer extends Model
{

        use HasFactory;
        protected $table = 'employment_answers';
        protected $guarded = [];

        /**
         * Define the relationships for the foreign keys.
         */
        public function employmentStatusQuestion()
        {
            return $this->belongsTo(Employment_Status_Questions::class, 'employment_status_question_ID');
        }

        public function user()
        {
            return $this->belongsTo(User::class, 'user_ID');
        }

        public function userEmploymentStatus()
        {
            return $this->belongsTo(User_Employment_Status::class, 'user_employment_status_ID');
        }
    }


