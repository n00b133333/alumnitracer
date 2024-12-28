<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_status extends Model
{
    /** @use HasFactory<\Database\Factories\EmploymentStatusFactory> */
    protected $guarded=[];
    public function users()
    {
        return $this->hasMany(User::class, 'employment_status_ID');
    }
}
