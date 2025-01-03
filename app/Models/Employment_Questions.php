<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_Questions extends Model
{
    /** @use HasFactory<\Database\Factories\EmploymentQuestionsFactory> */
    protected $table = 'employment_questions';
    protected $guarded=[];


    public function questions()
    {
        return $this->belongsTo(Employment_status::class, 'employment_status_ID');
    
    }

    public function answers()
    {
        return $this->hasMany(Question_Choices::class, 'employment_questions_ID');
    
    }
}
