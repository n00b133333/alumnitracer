<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_employment_status extends Model
{
    /** @use HasFactory<\Database\Factories\UserEmploymentStatusFactory> */
    use HasFactory;
        protected $guarded=[];


        protected $fillable = [
            'employment_status_ID',
            'user_ID',
        ];

        public function status ()
        {
            return $this->belongsTo(Employment_status::class, 'employment_status_ID');
        }

        public function user ()
        {
            return $this->belongsTo(User::class, 'user_ID');
        }

        public function answers ()
        {
            return $this->hasMany(Employment_answer::class, 'user_employment_status_ID');
        }
        
        
}
