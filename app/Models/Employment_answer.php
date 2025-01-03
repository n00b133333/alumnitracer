<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_answer extends Model
{

        use HasFactory;
        protected $table = 'employment_answers';
        protected $guarded = [];

        protected $fillable = [
            'employment_questions_ID','user_ID', 'user_employment_status_ID', 'answer'
        ];

        /**
         * Define the relationships for the foreign keys.
         */
        public function question()
        {
            return $this->belongsTo(Employment_Questions::class, 'employment_questions_ID');
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


