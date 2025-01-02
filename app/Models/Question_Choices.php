<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_Choices extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'question_choices';

    // Disable mass-assignment protection
    protected $guarded = [];

    /**
     * Define relationships for the foreign keys.
     */
    public function employmentQuestion()
    {
        return $this->belongsTo(Employment_Questions::class, 'employment_questions_ID');
    }
}
