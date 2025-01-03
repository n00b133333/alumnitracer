<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employment_status extends Model
{
    /** @use HasFactory<\Database\Factories\EmploymentStatusFactory> */
    protected $guarded=[];

    public function questions ()
    {

        return $this->hasMany(Employment_Questions::class, 'employment_status_ID');
    }
}
