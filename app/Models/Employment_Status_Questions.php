<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_Status_Questions extends Model
{
    use HasFactory;
    protected $table = 'employment_status_questions';
    protected $fillable = [
        'employment_question_ID',
        'employment_status_ID',
    ];

    // Define relationships
    public function employmentQuestion()
    {
        return $this->belongsTo(Employment_Questions::class, 'employment_question_ID');
    }

    public function employmentStatus()
    {
        return $this->belongsTo(Employment_status::class, 'employment_status_ID');
    }
}
